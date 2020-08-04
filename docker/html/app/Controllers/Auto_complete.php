<?php


namespace App\Controllers;


class Auto_complete extends Search
{
    public function __construct()
    {
        parent::__construct();
    }
    public function auto_complete()
    {
        $focded = isset($_GET['force']) ? $_GET['force'] : 0;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $this->type = isset($_GET['type']) ? $_GET['type'] : "";

         $this->pre_string($keyword,$focded);  //검색 텍스트 선처리

     //   $this->tranjamo($keyword); // $this->eng_value=,  $this->first_jamo
        $this->index = "autokeyword";

        $this->word->setTable("auto_keyword"); //인덱스 설정.

        if($this->fixed_str=="")  $this->error($this->type,"검색어 없음"."(원문 :$this->orginal_text)");// $this->call($this->index.'/_search');
        else {
            $result['return_code'] = "succeed";
            $this->word->setTable('auto_keyword');

            list($result['data'],$sql) = $this->word->auto_complete($this->fixed_str);

            $this->debug_mode[] =" Query: ". $sql;
            if($this->type == "debug") {

                echo "<h1>[DEBUG MODE]</h1><BR>".implode("<BR>",$this->debug_mode);
                print_r($result);
                exit;

            }else {
                $this->print($this->type, $result);
                exit;
            }

        }
    }
}