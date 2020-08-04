<?php namespace App\Controllers;

use Elasticsearch\ClientBuilder;

class Elasticsearch extends BaseController
{

    public   $host;
    public   $port;
    public   $mode;
    public function __construct()
    {
        $this->host = "elastic7";
        $this->port = 9200;
        $this->mode  = "GET";
    }

    public function index()
    {

        echo "elastic search <BR>";
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'bank',
            'type'    => 'account',
            'body'  => ['city' => 'Limestone']
        ];

        $response = $client->index($params);
        print_r($response);


        //    $cmd = "curl -X".$mode." '".$this->host.":".$this->port."/bank/account/_search?q=city:Limestone&pretty'";
        //echo $cmd."<BR>";
        $rtn = system($cmd);

        echo "<pre>";
        print_R($rtn);
    }

    public function search($value="")
    {
        if($value=="")   $this->call('product/_search');
        else {
            $page = "0";
            $limit = "10";
            /*페이징*/
            /*
            $param['form'] = $page;
            $param['size'] = $limit;
            */
            /*정렬*/
            //$sorting = array("");
            //$param['sort'] = $sorting;
            /*하이라이트*/
            //$param['highlight'] = array("fields" => "", "pre_tags" => "", "post_tags" => "");

            /*조회 조건 설정*/
            $param['query']['match'] = array("po_title" => urlencode($value));
            $json_param = json_encode($param);
            $mode = "POST";
            $cmd = "curl -X" . $mode . " '" . $this->host . ":" . $this->port . "/product/_search?pretty' -H 'Content-Type:application/json' -d  '" . $json_param . "'"; //

            echo $cmd . "<BR>";
            echo "<pre>";
            $rtn = system($cmd);
            echo "<BR><BR><BR><BR>";
            print_r($rtn);
            echo "<BR><BR><BR><BR>";
        }
    }
    public function call($action="",$mode="")
    {
        if($action =="") return $this;
        if($mode !="") $this->mode = $mode;

        $last_char =  substr($action,-1,1);
        $cmd = "curl -X".$this->mode." '".$this->host.":".$this->port."/".$action.(($last_char =="&" || $last_char =="?")? "": "?")."pretty'";
        echo $cmd."<BR>";
        echo "<pre>";
        $rtn = system($cmd);

        $arr = json_decode($rtn);
        print_r($arr);
        echo "</pre>";
        echo "<BR><BR><BR><BR>";
        return $rtn;

    }
    private function 0_elastic_search($param)
    {
        $rtn="";
        $json_param = json_encode($param);
        $mode = "POST";
        $cmd = "curl -X" . $mode . " '" . $this->host . ":" . $this->port . "/".$this->index."/_search?pretty' -H 'Content-Type:application/json' -d  '" . $json_param . "'"; //

        if($this->type=="debug")   echo $cmd . "<BR>";
        //  echo "<pre>";
        $rtn = shell_exec($cmd);
        $return_arr = $data = array();
        $result = json_decode($rtn);

        //**parsing **//
        $total = $result->_shards->total;
        $succed = $result->_shards->successful;
        $fail = $result->_shards->failed;

        $datas = $result->hits->hits;
        foreach($datas as $k=>$v){
            $data[$k] = $v->_source;
        }
        if($total == $succed && $fail <1) $return_arr['return_code']="succeed";
        $return_arr['data'] = $data;
        return $return_arr;
    }
    public function 0_search($value="")
    {

        $this->tranjamo($value);
        $this->index = "search";
        if($value=="")   $this->call($this->index.'/_search');
        else {
            $page = "0";
            $limit = "10";
            /*페이징*/
            /*
            $param['from'] = $page;
            $param['size'] = $limit;
            */

            /*조회 조건 설정*/
            //$param['query']['match'] = array("po_title" => urlencode($value));

            /* ngram만 적용 조회*/
            $query ['sort']["sorty"] = array("order"=>"desc","unmapped_type"=>"integer"); //정렬
            $query ['query']['match'] = array("keyword.key_token" => $this->eng_value);  //and
            $param = $query;
            /*다중(And)검색 */
            //      $query ['must']['match'] = array("po_title" => $this->eng_value);  //and -반드시 포함
            //   $query ['should']['match'] = array("po_title" => $this->eng_value); //or
            /*범위검색*/
            // $filter['sorty'] = array("gte" => 1100); //lt,lte,gt
            //$param['query']['filter'] = $filter;

            // $param['query']['bool'] = $query;

            //     $this->elastic_search($param);
        }
    } //엘라스틱서치
     public function 0_call($action="",$mode="",$data="")
    {
        if($action =="") return $this;
        if($mode !="") $this->mode = $mode;

        $last_char =  substr($action,-1,1);
        $cmd = "curl -X".$this->mode." '".$this->host.":".$this->port."/".$action.(($last_char =="&" || $last_char =="?")? "": "?")."pretty'";
        if($this->mode == "POST" AND (count($data)>0 or strlen($data)>0) ) $cmd .= " -H 'Content-Type:application/json' -d '".json_encode($data)."'";

        $rtn = system($cmd);

        $arr = json_decode($rtn);
        if ($this->type == "array" || $this->type == "debug") {
            echo $cmd."<BR>";
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
            echo "<BR><BR><BR><BR>";
        }
        return $rtn;

    }
}
