<?php namespace App\Controllers;


use App\Models\Po_list;

class Elastic extends BaseController
{
    public   $host;
    public   $port;
    public   $mode;
    public $index;
    public   $app;
    public function __construct()
    {
        $this->host = "elastic7";
        $this->port = 9200;
        $this->mode  = "GET";
        $this->index ="product1";
    }
    public function index()
    {
        echo view("elasitc");
    }
    //각각의 인덱스 생성
    public function setAuto_keyword()
    {
        $properties['properties']["keyword"] = array("type"=>"text" ,"fields"=>array("key_token"=>array("type"=>"text","analyzer"=>"custom_ngram")));
        $properties['properties']["original_text"] = array("type"=>"text");
        $properties['properties']["sorty"] = array("type"=>"integer");

        $tokenizer = array("custom_ngram"=>array("type"=>"ngram", "min_gram"=>2, "max_gram"=>3));

        $mapping["_doc"] = array("properties"=>$properties);//"_meta"=>array(),
        //$index[''] = $tokenizer;
        $index['mappings'] = $properties;
        $index['settings'] = array("number_of_shards"=>5,"number_of_replicas"=>1,"analysis"=>array("analyzer"=>array("custom_ngram"=>array("tokenizer"=>"custom_ngram")),"tokenizer"=>$tokenizer));
        $query_json =  json_encode($index);

        return $query_json;
    }
    public function setSearch_polist()
    {

        $properties['properties']["keyword"] = array("type"=>"text" ,"fields"=>array("key_token"=>array("type"=>"text","analyzer"=>"custom_ngram")));
        $properties['properties']["original_text"] = array("type"=>"text");
        $properties['properties']["ref_idx"] = array("type"=>"text");
        $properties['properties']["sorty"] = array("type"=>"integer");

        $tokenizer = array("custom_ngram"=>array("type"=>"ngram", "min_gram"=>2, "max_gram"=>3));

        $mapping["_doc"] = array("properties"=>$properties);//"_meta"=>array(),
        //$index[''] = $tokenizer;
        $index['mappings'] = $properties;
        $index['settings'] = array("number_of_shards"=>5,"number_of_replicas"=>1,"analysis"=>array("analyzer"=>array("custom_ngram"=>array("tokenizer"=>"custom_ngram")),"tokenizer"=>$tokenizer));
        $query_json =  json_encode($index);

        return $query_json;
    }
    public function veiw_index($query_json)
    {
        $data = json_decode($query_json);
        header('Content-Type: application/json;');
       print_r(json_encode($data,JSON_PRETTY_PRINT));
        exit;
    }
    public function make_index($query_json)
    {
        $mode="PUT";
        $cmd = "curl -X ".$mode."  '".$this->host.":".$this->port."/".$this->index.($this->app ? "/".$this->app."/1" : "")."?pretty' -H 'Content-Type: application/x-ndjson' -d '".$query_json."'";
        echo $cmd."<BR><BR>";

        echo system($cmd);
    }
    /* 인입 function */
    public function show($mode="search",$exec="view",$app="")
    {
        if($app!="" )$this->app = $app;
        if($mode =="search") {
            $this->index = "search";
            $query_json = $this->setSearch_polist();
        }
        else if($mode == "auto_keyword" or $mode == "autokeyword") {
            $this->index = "autokeyword";
            $query_json = $this->setAuto_keyword();
        }
        else $query_json = null;

        if($exec =="view")$this->veiw_index($query_json);
        else if($exec =='exec') $this->make_index($query_json);
        else exit;

    }
    //데이터 json 생성
    public function data($mode="search",$exec="view")
    {
        if($mode =="search") {
            $this->index = "search";
            $data = $this->makeproduct();
        }
        else if($mode == "auto_keyword" or $mode == "autokeyword") {
            $this->index = "autokeyword";
            $data = $this->makeautokeyword();
        }
        else $query_json = null;

        if($exec =="view" || $exec=="pretty") {
            header('Content-Type: application/json;');
            foreach ($data['index'] as $k => $item){
               if($exec=="pretty") {
                   print_r(json_encode($item, JSON_PRETTY_PRINT));
                   print_r(json_encode($data['json'][$k], JSON_PRETTY_PRINT));
               }
               else  {
                   echo json_encode($item)."\n";
                   echo json_encode($data['json'][$k])."\n";
               }
            }
            echo "\n";
            exit;
        }
        else if($exec =='exec') {
            $cmd = "curl http://webserver/elastic/data/".$this->index.($this->app ? "/".$this->app : "")."/view  > /var/www/".$this->index.".json";
            echo $cmd."<BR>";

            echo system($cmd);
        }
        else exit;

    }
    public function cupload($mode="search",$exec="view")
    {

        $cmd = "curl -X POST  '".$this->host.":".$this->port."/".$mode.($this->app ? "/".$this->app: "")."/_bulk?pretty' -H 'Content-Type: application/x-ndjson' --data-binary @/var/www/query.json";

        if($exec=="view") {
            echo $cmd . "<BR>";
        }elseif($exec=="exec") {
            header('Content-Type: application/json;');
            echo system($cmd);
        }
        exit;
    }
    //파일 bulk 업로드
    public function upload($mode="search",$exec="view")
    {

        $cmd = "curl -X POST  '".$this->host.":".$this->port."/".$mode.($this->app ? "/".$this->app: "")."/_bulk?pretty' -H 'Content-Type: application/x-ndjson' --data-binary @/var/www/".$mode.".json";

        if($exec=="view") {
            echo $cmd . "<BR>";
        }elseif($exec=="exec") {
            header('Content-Type: application/json;');
            echo system($cmd);
        }
        exit;
    }
    /*데이터 조회후 array로 리턴*/
    public function makeproduct()
    {
        $po = new Po_list();
        $list = $po->get_po_list();
        foreach ($list as $k => $v)
        {
            $index['index']['_id'] = $v->ref_idx;
            $json['keyword'] = $v->keyword;
            $json['ref_idx'] = $v->ref_idx;
            $json['sorty'] = $v->sorty;
            $json['original_text'] = $v->org_text;


            $return_data['index'][$k] = $index;
            $return_data['json'][$k] = $json;
        }
        return $return_data;
        exit;
    }
    public function makeautokeyword()
    {
        $po = new Po_list();
        $list = $po->get_autokeyword();

        foreach ($list as $k => $v)
        {
            if ($v->sorty == 1000) $v->sorty = (int)$v->sorty +mb_strlen($v->text);
            $index['index']['_id'] = $v->seq_no;
            $json['keyword'] = $v->keyword;
            $json['original_text'] = $v->text;
            $json['sorty'] = (int)$v->sorty;

           $return_data['index'][$k] = $index;
           $return_data['json'][$k] = $json;
        }
        return $return_data;
        exit;
    }
}
