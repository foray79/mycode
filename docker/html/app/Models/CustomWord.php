<?php
namespace App\Models;

use CodeIgniter\Model;

class CustomWord extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //오타 사전
    public function error_word($word)
    {
        if(is_array($word))$sub_query = "keyword IN ('".implode("','",array_values($word))."')";
        else $sub_query = "keyword = '".$word."'";
        //  $error_keyword = array("fosemtmzodlvm"=>"fosemtmzpdlvm","fhxoco"=>"fhxpcp","fhxocp"=>"fhxpcp","ehlwl"=>"ehowl");
        $sql = "SELECT keyword,return_word from errorword where $sub_query limit 1";


        $query = $this->db->query($sql);
        $row = $query->getResult();

        if(count($row)>0 ) {
            foreach($row as $v){
                $_error[$v->keyword] = $v->return_word;
            }

            return $_error;
        }
        return array(""=>'');
    }
    //유사어
    /* * $word*/
    public function getSimilarword($word)
    {
        // $_similar = array("Rkvp" => "zkvp", "coffee" => "zjvl", "hepa" => "gpvk", "oven" => "dhqms", "gnfkdl" => "vmfkdl", "gnfkdlvos" => "vmfkdlvos", "gnfkdldj" => "vmfkdldj");

        $sql = "SELECT keyword,return_word from similarword where keyword IN ('".implode("','",array_values($word))."') limit 100";

        $query = $this->db->query($sql);
        $row = $query->getResult();

        if(count($row)>0 ) {
            foreach($row as $v){
                $_similar[$v->keyword] = $v->return_word;
            }
            return $_similar;
        }
        return array(""=>'');
    }
    //유의어 사전
    public function get_list()
    {
        $sql = "SELECT seq_no,keyword,miss_keyword from loanword";
        $query = $this->db->query($sql);
        $row = $query->getResult();
        return $row;

    }

    //사용자 정의 유사어 확인
    public function existword($data)
    {
        $row = new \stdClass();
        $sql = "SELECT seq_no from ".$this->table." WHERE keyword ='".$data['keyword']."' AND return_word = '".$data['return_word']."' AND type='".$data['type']."'  LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->getResult();
        if(isset($row[0]))$row = $row[0];

        echo "query : ".$sql."<BR>";
        echo "result : ".\Opis\Closure\serialize($row)."<BR>";
        if(isset($row->seq_no) and $row->seq_no>0) $this->rtn = $row->seq_no;
        else $this->rtn = 0;

        return $this;
        exit;
    }

}