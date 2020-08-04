<?php
namespace App\Models;

use CodeIgniter\Model;

class Mysql_Search  extends Model
{
    private $rtn;
    private $index='';
    public $sql='';
    private $limit;
    private $total_count;
    public function __construct($table = "search")
    {
        parent::__construct();
        $this->setTable($table);
        return $this;
    }
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getTotal_cnt()
    {
        return $this->total_count;
    }
    public function getAlldata($idx=0,$limits=0)
    {
        $row = new \stdClass();
        $limit = ($limits>0) ? " Limit 0,".$limits : "";
        if($idx>0) $where = "WHERE po_idx >=".$idx;
        else $where="";

        $sql="select po_idx,po_title,po_keyword,po_soldout,po_oInven from po_list ".$where.$limit;
        $query = $this->db->query($sql);
        $row = $query->getResult();
        return $row;
    }
    public function getkeyword($keyword)
    {

        $sql="select * from ".$this->index." where keyword like ('%".trim($keyword)."%')";
        $query = $this->db->query($sql);
        $row = $query->getResult();
        $this->sql = $sql;

        return $row;
    }

    public function makeQuery( $addword=null, $addquery = null)
    {
        $sql = $subquery="";
        $row = null;
        if($addword !== null){ //유사어 검색
            $subquery  = " or match(keyword) against('".trim($addword)."' IN BOOLEAN MODE) ";
        }
        if($addquery !== null) { //형태소값 검색
            $subquery .= isset($addquery[0]) ? " Or match(keyword) against('".trim($addquery[0])."' IN BOOLEAN MODE)" : "";
            $subquery .= isset($addquery[1]) ? " oR match(keyword) against('".trim($addquery[1])."' IN BOOLEAN MODE)" : "";
        }
        return $subquery;
        exit;

    }
    public function auto_complete($keyword)
    {
     //   $subquery = $this->makeQuery( $addword, $addquery);
        $sql="select text from ".$this->index." where match(keyword) against('".trim($keyword)."' IN BOOLEAN MODE) Order by sorty desc limit 0,20";

        $this->sql = $sql;
        if($sql != '') {

            $query = $this->db->query($sql);
            $row = $query->getResult();
        }
        else{
            $row = null;
        }
        return $row;
    }
    public function product_search($keyword , $addword=null, $addquery = null,$page)
    {
//        echo "MODEL product_search <BR>";
//        echo "keyword : $keyword <BR>";
//        echo "addquery : ".$addquery[0]." , ".$addquery[1]."<BR>";
//exit;
        $subquery = $this->makeQuery($addword, $addquery);
        $start = $page>1 ? ($page-1)*$this->limit : 0;
        $this->total_count($keyword, $subquery);
        $sql="select DISTINCT ref_idx from ".$this->index." where match(keyword) against('".trim($keyword)."' IN BOOLEAN MODE)".$subquery." limit $start,$this->limit";

        $this->sql = $sql;
        if($sql != '') {

            $query = $this->db->query($sql);
            $row = $query->getResult();
        }
        else{
            $row = null;
        }
        return $row;
    }
    public function total_count($keyword, $subquery="")
    {
        $sql="select count(*) as cnt from ".$this->index." where match(keyword) against('".trim($keyword)."' IN BOOLEAN MODE)".$subquery;

        $this->sql = $sql;
        if($sql != '') {

            $query = $this->db->query($sql);
            $row = $query->getResult();
        }
        $this->total_count = $row[0]->cnt;
    }

    public function existword($text,$ref_idx) //db 키워드 중복 체크
    {

        $row = new \stdClass();
        $sql = "SELECT seq_no from ".$this->index." WHERE keyword ='".$text."' AND ref_idx =".$ref_idx."  LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->getResult();
        if(isset($row[0]))$row = $row[0];


        echo "result".\Opis\Closure\serialize($row)."<BR>";
        if(isset($row->seq_no) and $row->seq_no>0) $this->rtn = $row->seq_no;
        else $this->rtn = 0;

        return $this;
        //exit;
    }
    public function setTable($table)
    {
        $this->index = $table;
        return $this;
    }
    public function setWord($data)
    {
        echo "set word : ".$data['keyword'];
        $this->existword($data['keyword'],$data['ref_idx']);
        echo "rtn : ".$this->rtn;
        if($this->rtn>0) {
            echo "<font color='red'>not insert > keyword: ".$data['keyword'].", ref_idx: ".$data['ref_idx'].", sorty : ".$data['sorty']."> seq_no:".$this->rtn."</font><BR>";
            return 0;

        }
        else{ //db 미존재시
            $seq_no = DB::table($this->index)->insertGetId ([ "keyword" =>$data['keyword'],"ref_idx" =>$data['ref_idx'],"sorty"=>$data['sorty'],"org_text"=>$data['org_text'] ],"seq_no");
            echo "<font color='blue'>insert > keyword: ".$data['keyword'].", ref_idx: ".$data['ref_idx'].", sorty : ".$data['sorty']."> seq_no:".$seq_no."</font><BR>";
            return $seq_no;
        }
    }
    //
    public function get_prd($idx=0)
    {
        if($idx==0) return ;
        $sql = "select po_title from po_list limit WHERE po_idx = ".$idx." limit 1";
        $query = $this->db->query($sql);
        $row = $query->getResult();
        return $row[0];
    }

    public function get_list($page=1)
    {
        $limit = ($page>0 and $page<10) ?  10*$page : 0;
        $sql = "select po_title from po_list limit ".$limit.",20";
        $query = $this->db->query($sql);
        $row = $query->getResult();
        return $row;
    }
    public function getData($page)
    {
        $page = ($page==0)? 1 : ($page-1)*2000;
        $sql="SELECT po_title,po_idx,po_keyword as keyword FROM po_list po where
 po_status = 0 AND po_soldout = 0  AND po_type = '9' AND po_date <= NOW() limit $page ,2000";
        echo $sql;
        $query = $this->db->query($sql);
        $row = $query->getResult();
        return $row;
    }
        //테스트 용 - 상품 정보 조회 쿼리
    public function getprouct($param)
    {
        $po_idx = $param->po_idx;

        $row = null;


        $sql = "select po_title,po_idx,po_sprice,po_image from po_list  WHERE po_idx IN  ( ". implode(",",$po_idx).")";

        $query = $this->db->query($sql);
        $row = $query->getResult();

        $rows = null;
        foreach($row as $k=>$v) {

            $data = new \stdClass();
            $data->po_idx = $v->po_idx;
            $data->po_title = $v->po_title;
            $data->po_image = $v->po_image;
            $data->po_oprice = $v->po_sprice;
            $rows[$k] = $data;
        }

        return $rows;
    }

}