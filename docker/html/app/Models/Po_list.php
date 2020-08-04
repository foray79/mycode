<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class Po_list extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
}

    public function get_po_list()
    {
      //  $db = \Config\Database::connect();

        $query = $this->db->query('SELECT * FROM search_keyword ');

        $results = $query->getResult();
        return $results;
    }
    public function get_autokeyword()
    {
        $query = $this->db->query('SELECT seq_no,keyword,text,sorty FROM auto_keyword');

        $results = $query->getResult();
        return $results;
    }

    public function product($key)
    {
        $query = $this->db->query("SELECT po_title,po_idx,po_image,po_oprice FROM po_list where po_idx =".$key." limit 1");

        $rows = $query->getResult();
        $row = $rows[0];

        $return = array($row->po_title, $row->po_image,$row->po_oprice,$row->po_idx);

        return $return;
    }
    public function getprouct($param)
    {
        $po_idx = $param->po_idx;

        $row = null;

        foreach ($po_idx as $k => $v) {
            $key = trim($v);
            list($title, $image, $oprice, $po_idx) = $this->product($key);
            $rows = null;
            $rows = new \stdClass();
            $rows->po_idx = $po_idx;
            $rows->po_title = $title;
            $rows->po_image = $image;
            $rows->po_oprice = $oprice;
            $row[$k] = $rows;
        }
        return $row;
    }
    public function get_list($page=1)
    {
        $limit = ($page>0 and $page<10) ?  10*$page : 0;
        $query = $this->db->query("select po_title from po_list limit ".$limit.",20");
        $results = $query->getResult();
        return $results;

    }
    public function getData($page)
    {
        $page = ($page==0)? 1 : ($page-1)*2000;
        $sql=$this->db->query("SELECT po_title,po_idx,po_keyword as keyword FROM po_list po where
 po_status = 0 AND po_soldout = 0  AND po_type = '9' AND po_date <= NOW() limit $page ,2000");

        $results = $query->getResult();
        return $results;
    }
}