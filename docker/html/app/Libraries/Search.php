<?php


namespace App\Libraries;

use App\Models;

class Search
{
    private $engine ;
    private $index;
    private $data;
    private $query;
    private $limit;
    private $search;
    private $searchE;
    private $total_cnt;
    public function __construct($engine= "mysql")
    {
        $this->engine = $engine;
        return $this;
    }
    public function setLimit($limit)
    {
        $this->searchE->setLimit($limit);
        $this->limit = $limit;
        return $this;
    }
    public function getTotal_cnt()
    {
        $this->total_cnt = $this->searchE->getTotal_cnt();
        return $this->total_cnt;
    }
    private function setconnect($table)
    {
        if($this->engine =="elastic") {
            $this->searchE = new elastic();
        }else if($this->engine=="mysql"){
            $this->searchE = new Models\Mysql_Search($table);
        }
        return $this;
    }
    public function setTable($table)
    {
        $this->index = $table;
        $this->setconnect($table);

        return $this;
    }
    /*통합조회*/
    public function product_search($keyword , $addword=null,$addquery = null,$page=1)
    {
        $npage = $page;
        if ($this->engine == "mysql") {
            $this->mysql_search($keyword, $addword, $addquery,$npage);
        } else if ($this->engine = "elastic") {
            $this->elastic_Search($keyword, $addword, $addquery,$npage);
        }

        if(!isset($this->data) || count($this->data)<=0) $this->data = null;
        return array($this->data, $this->query);
    }
    //통합 자동완성
    public function auto_complete($keyword)
    {
//        $npage = $page;
        if ($this->engine == "mysql") {
            $this->mysql_autocomplete($keyword);
        } else if ($this->engine = "elastic") {
            $this->elastic_autocomplete($keyword);
        }

        if(!isset($this->data) || count($this->data)<=0) $this->data = null;
        return array($this->data, $this->query);
    }

    //====================private =================================//

    /*mysql 조회*/
    private function mysql_search($keyword , $addword=null,$addquery = null,$page)
    {

        $this->data = $this->searchE->product_search($keyword, $addword, $addquery,$page);
        $this->query = $this->searchE->sql;

        return $this;
    }
    private function mysql_autocomplete($keyword)
    {

        $this->data = $this->searchE->auto_complete($keyword);
        $this->query = $this->searchE->sql;

        return $this;
    }

    /*엘라스틱서치 조회*/
    //자동완성
    private function elastic_autocomplete($keyword)
    {
        $page = "0";
        $limit = "10";
        /*페이징*/

        $query['from'] = $page;
        $query['size'] = $limit;


        /*조회 조건 설정*/
        $query ['sort']["sorty"] = array("order"=>"desc","unmapped_type"=>"integer"); //정렬
        $query ['query']['match_phrase'] = array("keyword.key_token" => array("query"=>$this->eng_value));  //and

        $rtn = $search->elastic_search($query);

        if($rtn!="fail") {
            $this->data = $rtn;
            $this->query = $search->cmd;
        }
        return $this;
    }
    //상품검색
    private function elastic_Search($keyword,$addword=null,$addqeury=null,$pag=0)
    {
        $search = new elastic();
        $page = "0";
        $limit = "10";
        /*페이징*/

        $query['from'] = $page;
        $query['size'] = $limit;


        /*조회 조건 설정*/
        $query ['sort']["sorty"] = array("order"=>"desc","unmapped_type"=>"integer"); //정렬
        $query ['query']['match_phrase'] = array("keyword.key_token" => array("query"=>$keyword));  //and

        //$param = $query;
        $rtn = $search->elastic_search($query);

        if($rtn!="fail") {
            $this->data = $rtn;
            $this->query = $search->cmd;
        }
        return $this;
    }

}