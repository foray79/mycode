<?php
namespace App\Controllers;


use App\Models\Po_list;
use App\Libraries\Jamo;
use App\Libraries;
use App\Models;

class Search extends BaseController
{
    public $web_server;
    public   $host;
    public   $port;
    public   $host2; //개발서버
    public   $port2;
    public   $mode;
    public $index;
    public $jamo;
    public $eng_value;
    public $first_jamo;
    public $word; //쿼리 처리 object

    public $forced;
    public $keyword;
    public $type;
    public $page;
    public $limit;

    public $total_row_count; // 검색 결과 총 데이터수
/*검색어 전처리 결과들*/
    public $input_text;// 입력된 검색어
    public $proceed_text; // 전처리 후 검색어.. 실 검색어(영문)
    public $proceed_ko_text; // 전처리 후 검색어.. 실 검색어(국문)
    public $en_Text; //상품명 영문으로 변경
    public $en2kr_Text ; //변경된 영문 한글로 변경
    public $orginal_text; //검색 원문
    public $addText; //동의어 추가
    public $more_word ;  //형태소 분석후 검색어
    public $fixed_str; //오타 교정 키워드
    
    protected $debug_mode; //디버그 타입용 로그
    protected $engine; //검색DB 설정

    public function __construct()
    {
        $this->web_server = "webserver";
        $this->host = "elastic7";
        $this->port = 9200;
        $this->mode  = "GET";
        $this->index ="product1";
        $this->eng_value="";
        $this->first_jamo = "";
        $this->host2 = "192.168.0.65";
        $this->port2 = ":8900";
         //검색엔진 설정
        $this->engine = "mysql";
        $this->word = new Libraries\Search($this->engine);
        $this->debug_mode[] ="검색엔진 : ".$this->engine;
        /*GET 데이터 */
        $this->forced = isset($_GET['force']) ? $_GET['force'] : 0;
        $this->keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $this->type = isset($_GET['type']) ? $_GET['type'] : "json";
        $this->force = $this->forced ? true : false;
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->page = ($this->page>1) ? $this->page : 1;
        $this->limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
        $this->limit = ($this->limit>20) ? $this->limit : 20;
    }

    public function index()
    {
        $this->home();
    }

    /*상품 정보 조회*/
    public function get_product_info($data)
    {
        $param = new \stdClass();
        foreach($data as $v){
            $param->po_idx[] = $v->ref_idx;
        }

        $search = new Models\Mysql_Search($this->index);
        $data =  $search->getprouct($param);

        return $data;
    }

    public function  view($index)
    {
        $this->call($index, "GET");
    }
    public function home()
    {
        $data['time'] = "?".date("YmdHis");
        echo view("home",$data);
    }

       public function result()
       {
           $cmd = "curl http://$this->web_server/api/search/?keyword=" . $this->keyword . "&type=json"; //api 통신
           $rtn = shell_exec($cmd);
           $return = (array)json_decode($rtn); //json 디코딩


           if (isset($return['return_code']) && $return['return_code'] == "200") {//성공
               $data['total_column'] = $return['total_column'];
               $placeholder = '"' . $this->keyword . '"(으)로 ' .  $data['total_column'] . '개의 상품이 검색되었습니다.';
               $data['placeholder'] = $data['total_column'] > 0 ? $placeholder : "검색어를 입력해주세요.";
               $data['time'] = "?" . date("YmdHis");
               $data['related'] = $return['related']; //this->similarKeyword
               $data['force_search'] = "";
               $data['data'] = $this->get_product_info($return['data']);
           } else { //통신실패
               $data['time'] = "?" . date("YmdHis");
               $data['data'] = $data['related']  = null;
               $data['force_search'] = "";
               $data['placeholder'] = "검색어를 입력해주세요.";
               $data['total_column'] = 0;
           }
echo $data['placeholder'];

           echo view("result", $data);
           exit;

       }
    //에러 발생시
    protected function error($mode,$detail_msg="")
    {
        $return_data['result_code'] = '400';
        $return_data['result_msg'] = 'fail';
        $return_data['detail_msg'] = $detail_msg;


        $this->print($mode, $return_data);

    }
    //포맷에 맞게 출력
    protected function print($mode="json", $return_data)
    {
        if ($mode == "json") {
            echo json_encode($return_data,JSON_UNESCAPED_UNICODE);
        } else if ($mode == "xml") {
            echo xml_convert($return_data);
        } else if ($mode == "array" or $mode == "debug") {
            echo "<pre>";
            print_r($return_data);
            echo "</pre>";
        } else if ($mode == "text" or $mode == "" or $mode == "csv") {
            foreach ($return_data['data'] as $k => $v) {
                $tmp[] = $v['keyword'];
            }
            echo implode(",", $tmp);
        } else {
            echo "<span class='message'><B>상품 조회에 실패 하였습니다.</b></span>";
        }
        exit;
        //return $this;
    }

}
