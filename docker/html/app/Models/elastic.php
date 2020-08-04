<?php


namespace App\Models;


class elastic
{
    public   $host;
    public   $port;
    public   $index;
    public   $cmd;
    public   $total;
    public   $succed;
    public   $fail;

    public function __construct()
    {
        $this->host = "elastic7";
        $this->port = 9200;
        $this->mode  = "GET";
        $this->index ="product1";
        $this->cmd = "";
    }
    private function elastic_search($param)
    {
        $rtn="";
        $json_param = json_encode($param);
        $mode = "POST";
        $cmd = "curl -X" . $mode . " '" . $this->host . ":" . $this->port . "/".$this->index."/_search?pretty' -H 'Content-Type:application/json' -d  '" . $json_param . "'"; //
        $this->cmd = $cmd;

        $rtn = shell_exec($cmd);
        $return_arr = $data = array();
        $result = json_decode($rtn);

        //**parsing **//
        $this->total = $result->_shards->total;
        $this->succed = $result->_shards->successful;
        $this->fail = $result->_shards->failed;

        $datas = $result->hits->hits;
        foreach($datas as $k=>$v){
            $data[$k] = $v->_source;
        }
        if($this->total == $this->succed && $this->fail <1) return  $data;
        else return "fail";
    }
}