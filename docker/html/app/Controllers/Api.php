<?php
namespace App\Controllers;


use App\Models\Po_list;
use App\Libraries\Jamo;
use App\Libraries;
use App\Models;
use vendor;

class api extends BaseController
{

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
    //한글을 영문으로 변경.
    protected function tranjamo($value)
    {
        if($value == "") return $this;
        $value = urldecode($value);

        $this->jamo = new Jamo();
        $this->jamo->setText($value);
        $this->eng_value=$this->jamo->getKeyword();
        $this->first_jamo = $this->jamo->get_first_vowel();

        return $this;
    }
    public function index()
    {
        $this->home();
    }
    public function pre_string($str,$force=false)
    {

        $this->orginal_text = $this->input_text = trim($str);  //원 검색어 , 원문 - 오탈자 교정시 제공할 원문

        $astart_time = $this->getmicrotime();
        $start_time = $this->getmicrotime();

        $jamo = new Jamo(); // 영문자 변경
        $this->force = $force ? true : false;
        $result['total_column'] = 0;

        if(mb_strlen($this->input_text)>0) $this->proceed_ko_text =  $jamo->auto_convert($this->input_text); //

        if (strlen($this->input_text) <= 0) { //조회할 키워드 글자수 체크
            $result['code'] = "keyword is null";
            return $result;
        }

        $this->input_text = $this->specialchar($this->input_text); //특수문자제거

        $end_time = $this->getmicrotime();
        $delay[0]  = $end_time-$start_time;


        $start_time = $this->getmicrotime();
        $this->morpheme($this->input_text); //형태소 분석 --검색이용

        $end_time = $this->getmicrotime();
        $delay[1]  = $end_time-$start_time;

        $start_time = $this->getmicrotime();
        //유사 키워드 찾기

        $end_time = $this->getmicrotime();
        $delay[6]  = $end_time-$start_time;

        /*

        $start_time = $this->getmicrotime();
        $_more_word =  $this->_morpheme($end_str,'low');// 형태소분석_only - 유사 키워드이용
        $end_time = $this->getmicrotime();
        $delay[2]  = $end_time-$start_time;
        */
        //  $_more_word =  $end_str;// 형태소분석_only - 유사 키워드이용


        $start_time = $this->getmicrotime();
        $jamo->setText($this->input_text);//영문으로 변경
        $this->en_Text = $jamo->getKeyword(); //영문자 변경값 리턴
        $this->en2kr_Text = $jamo->convert($this->en_Text);
        $jamo->is_ko($this->input_text);
        $is_ko = $jamo->auto_convert($this->input_text); // ? "true": "false";

        $koFirstText = $jamo->getkoFirst(); //초성 ..
        $this->debug_mode[] = "en_Text : $this->en_Text";
        $this->debug_mode[] = "en2kr_Text : $this->en2kr_Text";
        $this->debug_mode[] = "연관 검색어 요청 단어 : ".$is_ko;
        if ($this->force === false) $this->fixed_str = $this->error_keyword($this->en_Text); //오타 사전 적용~영문자로 비교처리
        else $this->fixed_str = $this->en_Text;//강제키워드 검색 (오타 미교정)기능 시엔 오타 치환을 하지 않는다.

        $this->proceed_ko_text = $jamo->auto_convert($this->fixed_str);
        $this->debug_mode[] = "오탈자 교정후 : $this->fixed_str($this->proceed_ko_text) , 오타 교정 : ".($this->force ? "F" : "T");
        $_more_word = is_array($this->fixed_str) ? implode(" ",$this->fixed_str) : $this->fixed_str; //연관 검색어 추출을 위한 단어 생성 .. 오타 처리 적용까지(형태소 분석 안함)
//여기서 유사키워드 - 나눠서 처리
        //  echo "오타 교정후 키워드 : ". $_more_word;


        $end_time = $this->getmicrotime();
        $delay[4]  = $end_time-$start_time;

        $start_time = $this->getmicrotime();

        //$_more_word = $jamo->convert($_more_word); //영자->한글로 변경


        $end_time = $this->getmicrotime();
        $delay[3]  = $end_time-$start_time;

        $start_time = $this->getmicrotime();
        $addText = $this->getsimilareword($this->fixed_str); //동의어 사전 확인
        if (strlen($addText) > 0) $this->addText = "+" . preg_replace("/\s+/", " +", $addText);
        $end_time = $this->getmicrotime();
        $delay[5]  = $end_time-$start_time;

        $this->proceed_text = "+" . preg_replace("/\s+/", " +", $this->fixed_str);

        $fix_Text = explode(" ", $this->fixed_str);
        $fix_Text = array_filter(array_unique($fix_Text));
        $this->proceed_text = "+" . implode(" +", $fix_Text);



        if ($this->fixed_str === $this->en_Text) {//오타 변환전후가 다르면 입력 값 원문으로 리턴해줌.
            $this->orginal_text = null;
        }
        if ($this->input_text == $this->proceed_ko_text) { //영타한글변환시엔 원문 리턴.
            $this->proceed_ko_text = null;
        }
        if (is_array($fix_Text)) {//동의어 사전 체크후
            $this->proceed_ko_text = $jamo->convert($this->fixed_str);
        }
        if ($this->input_text == $koFirstText && mb_strlen($koFirstText) <= 1) { //입력값과 초성이 동일하다면 즉 초성 한자만 입력 했을때는 자동완성안함.
            $this->debug_mode[] = " 초성 한글자 검색 취소== (" . mb_strlen($koFirstText) . ")";
            $result['code'] = "incorrect keyword";
            return $result;
        }

        $this->debug_mode[] = "입력검색어 : " . $this->input_text . ", 영문변환 : <u>" . $this->en_Text . "</u>,  오타(띄어쓰기) 처리 : " . ($force ? "오타 치환 기능 해제" : $this->fixed_str) . ", 실검색어 : " . $this->proceed_text . "(" . $this->proceed_ko_text . ")";
        $this->debug_mode[] = "키워드 자리수 : " . mb_strlen($str) . ",초성 추출 : " . $koFirstText . ", 초성 자리수 : " . mb_strlen($koFirstText);
        $this->debug_mode[] = ($this->orginal_text != '' ? ",원문 :" . $this->orginal_text : "");
        $this->debug_mode[] = ($this->addText === null ? "" : ", 유사어 포함 : " . $this->addText);
//        $this->debug_mode[] = (count($result['more_word']) <= 0) ? "<BR>" : "<BR> 형태소 분석 포함 : " . implode(",", $result['more_word']) . "<BR>";

        $this->debug_mode[] = "===  실행시간 체크 ===";
        $this->debug_mode[] = "검색어 한영변경 :".round($delay[0]/100,10);
        $this->debug_mode[] = "검색어 형태소분석: ".round($delay[1]/100,5);
        //$this->debug_mode[] = "유사키워드( 형태소분석): ".round($delay[2]/100,5)."<BR>";
        $this->debug_mode[] = "유사 키워드 통신 :".round($delay[3]/100,5);
        $this->debug_mode[] = "오타사전체크: ".round($delay[4]/100,5);
        $this->debug_mode[] = "동의어사전체크 : ".round($delay[5]/100,5);
        $this->debug_mode[] = "유사어검색 키워드 국문으로변경 : ".round($delay[6]/100,5);

        $this->debug_mode[] = "============================";
        return $this;
    }

    /*검색어 분석 func*/
    // 특수문자 처리
    public function specialchar($str)
    {
        $str = preg_replace("/[^a-zA-Z0-9가-핳\s]/", "", $str); //숫자,영문,한글,공백 제외 모두 삭제
        return $str;
    }
    //시간체크
    public function getmicrotime()
    {
        list($msec, $sec) = explode(' ', microtime());
        return ((float)$msec + (float)$sec);
    }
    //연관검색어
    public function similarKeyword($str)
    {

        $jamo = new Jamo();
        $arr_str = is_array($str) ? $str : explode(" ",$str);
        foreach($arr_str  as $k=> $arrtostr) {
            $arr_eng_str[$k] = $jamo->auto_convert($arrtostr);  // 자동변환 - 영문을 국문으로 변경.. 국문은 그대로 국문
        }

        $eng_str = implode(" ",$arr_eng_str);

        $url = "http://" . $this->host2 . $this->port2 . "/similar?text=" . urlencode($eng_str) . "&topn=5";
        //연관검색어 조회

        $rtn = exec("curl " . $url . "");

        $r = preg_replace("/[\[|\]|\'|\s]/", "", $rtn);
        $_r = explode(",", $r);


        return array($eng_str,$_r);
    }
    //유사어
    public function getsimilareword($word)
    {
        $cw = new Models\CustomWord();
        // $_similar = $cw->getSimilarword();
        $_similar = $similarword = $similarwords = null;
        $_spit_word = explode(" ", $word); //띄어쓰기로 단어 나누기

        $_similar = $cw->getSimilarword($_spit_word);

        $skey = array_keys($_similar);
        foreach ($skey as $k => $key) $skey[$k] = "/" . $key . "/";

        $svalue = array_values($_similar);
        $notequal = -1; // 유사어 존재 여부 체크

        foreach ($_spit_word as $k => $words) {
            $cwords = preg_replace($skey, $svalue, $words);
            $similarwords[$k] = $cwords;

        }

        //유사단어 치환후에도 입력어랑 같다면 유사어가 없다 판단하여 null 리턴
        if (md5(serialize($_spit_word)) === md5(serialize($similarwords))) $similarword = null;
        else $similarword = implode(" ", $similarwords);

        return $similarword;
    }
    //오타 사전
    public function error_keyword($word)
    {
        $error_word = array();

        $cw = new Models\CustomWord();
        if(is_array($word) ) $_str = $word;
        else $_str = explode(" ",$word);
        $debug_txt="[오타 처리]";

        foreach ($_str as $k => $str) {
            $debug_txt .=  "error_keyword str : $str";
            $error_keyword = $cw->error_word($str);
            //   print_R($error_keyword);
            $error_word[$k] = (isset($error_keyword[$str]) ? $error_keyword[$str] : $str );
            $debug_txt .= "=>".$error_word[$k];
        }
        $this->debug_mode[] = $debug_txt;
        //  echo "return data : ".implode( " ", $error_word);
        return count($error_word) >0? implode( " ", $error_word) : '';
        exit;


        $error_keywor_key = array_keys($error_keyword);
        $error_keywor_val = array_values($error_keyword);

        //  $str = str_replace($error_keywor_key, $error_keywor_val, $str);
        return $str;
    }
    //형태소 분석
    public function Morpheme($word)
    {
        $mp = new Libraries\Morpheme(); //형태소 분석
        $jamo = new Jamo(); // 영문자 변경
        $find_word="";
        $debug_data = $subquery = array();
        $rtn = $this->_morpheme($word,'high');


        if(count($rtn) ==1) {
            $str_return = implode("", $rtn);
            if (mb_strlen($str_return) < mb_strlen($word)) { // 분석결과 글자수가 원문보다 작을때.. 일부 키워드가 안왔다고 판다.
                $find_word = preg_replace("/$str_return/", "", $word);
            }
            if(mb_strlen($find_word)>0)  array_push($rtn,$find_word);
        }
        if (count($rtn) > 0) {
            $debuging = "[형태소 분석결과]<BR>  결과값: " . implode("/", $rtn)." 글자수 : ".mb_strlen(implode("",$rtn)).", 원문:".mb_strlen($word);

            foreach ($rtn as $k => $str) {
                /*분석값 한글=>영문자로 변경*/
                $jamo->setText($str);
                $kr2en_Text[$k] = $jamo->getKeyword(); //영문자 변경값 리턴

                $debug_data[] = "<BR>영문자 변경 : $str => $kr2en_Text[$k]";
                //tart_time = $this->getmicrotime();
                //  $koFirstText = $jamo->getkoFirst(); //초성 ..
                if ($this->force === false) {
                    $fix_str1[$k] = $this->error_keyword($kr2en_Text[$k]); //오타 사전 적용
                    $debug_data[] = " 오타 사전 적용 : " . $fix_str1[$k];
                } else {//강제키워드 검색 (오타 미교정)기능 시엔 오타 치환을 하지 않는다.
                    $fix_str1[$k] = $kr2en_Text[$k];
                    $debug_data[] = " 오타 사전 미적용 : " . $fix_str1[$k];
                }

                $addText[$k] = $this->getsimilareword($fix_str1[$k]); //동의어 사전 확인
                if ($addText[$k] != '') $debug_data[] = " 동의어 체크 :  $addText[$k]";
                $changeText[$k] = preg_replace("/\s+/", "", $fix_str1[$k]);
                if (count($addText) > 0) $addquery[$k] = preg_replace("/\s+/", "", $addText[$k]);
            }
            $changeText = array_filter(array_unique($changeText));
            $addquery = array_filter(array_unique($addquery));
            if (count($changeText) > 0) $debug_data[] = " 검색 조건1 : +" . implode(" +", $changeText);
            if (count($addquery) > 0) $debug_data[] = " 검색 조건2 : +" . implode(" +", $addquery);

            if (count($changeText) > 0) $subquery[] = " +" . implode(" +", $changeText);
            if (count($addquery) > 0) $subquery[] = " +  " . implode(" +", $addquery);
        } else {
            $debuging = "";
            $debug_data[] = "[형태소 분석결과] 결과없음";
            $debug_data[] = "추가 검색 단어 없음";
            $subquery = array();
        }

        if (is_array($debug_data) && count($debug_data) > 0) $this->debug_mode[] = implode("<BR>", $debug_data);
        //echo implode("<BR>",$this->debug_mode);
        $this->more_word =  $subquery;
        return $this;
    }
    public function _morpheme($word,$process ="high")
    {

        //echo "<BR>_morpheme str: $word<BR>";
        $max_length = 3 ; // 형태소 분석을 위한 최소 자리수.
        $pass=false;
        $mp = new Libraries\Morpheme(); //형태소 분석
        $jamo = new Jamo(); // 영문자 변경
        $rtn = $subquery = array();
        /*형태소 분석*/

        $_word = is_array($word) ? $word : explode(" ", $word);
        //  $_str = array_filter($_str);


        foreach ($_word as $word) {
            if (mb_strlen($word) > $max_length and $word != '') {
                $mp->setWord($word)->analysis();
                if (count($rtn) > 0) $rtn = array_merge($mp->check(), $rtn);
                else  $rtn = $mp->check();
                $pass=false;
            } else {
                // echo "<hr>limit word size</hr>";
                $pass=true;
                count($rtn) > 0 ? array_push($rtn, $word) : $rtn = array($word);
            }
        }

        if($pass) return $rtn;
        if($process=="high")
        {
            return $rtn;
        }else{ //low
            return $mp->getArrResult(); // 후처리 안함.
        }
    }

    //검색결과
    public function search_result($keyword="",$focded=0){
        $this->word->setTable("search_keyword"); //인덱스 설정.
        $this->pre_string($keyword,$focded);  //검색 텍스트 선처리
        //연관검색어
        list($this->_more_word,$this->similar) = $this->similarKeyword($this->fixed_str);
        $this->debug_mode[] = "연관 검색어: (".(is_array($this->_more_word) ? implode(" ",$this->_more_word) : $this->_more_word).") =>".( is_array($this->similar) ? implode(",",$this->similar) : $this->similar)."<BR>";

        $more_word = implode(" ",$this->more_word);
        $more_word = "+" . preg_replace("/\s+/", " +", $more_word);

        /*검색 쿼리 생성*/

        $this->tranjamo($keyword); // $this->eng_value=,  $this->first_jamo
        $this->index = "search";

        if($this->fixed_str=="")  $this->error($this->type,"검색어 없음"."(원문 :$this->orginal_text)"); //  $this->call($this->index.'/_search');
        else {
            $this->word->setLimit($this->limit);
            list($result['data'],$sql) = $this->word->product_search($this->proceed_text,$this->addText,$this->more_word);
            $this->total_row_count = $this->word->getTotal_cnt();
            $this->debug_mode[] =" Query: ". $sql;
            if(isset($result['data']) && count($result['data'])>0) $result['return_code'] = "200";
            else $result['return_code']="fail";
            //     $rtn = $this->elastic_search($query);
            if($result['return_code'] == "200") {
                if($this->type == "debug")  echo "</B>원문:$this->eng_value<BR><pre>";

                return  $result; //json_encode($result,JSON_UNESCAPED_UNICODE);

            }//통신 실패
            else{
                if($this->type == "debug") echo implode("<BR>",$this->debug_mode);
                else $this->error($this->type,"검색DB 실패");
            }
        }
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

    public function search()
    {
        $tdata = $data = $related = array();
        $total_column = 0;

        $tdata=$this->search_result($this->keyword,$this->forced);

        /*api 작성*/
        $data['return_code'] = $tdata['return_code'];
        $data['orgin_keyword'] = $this->keyword; //검색원문 제공 .. 오탈자 변경이 있다는뜻.
        $data['change_keyword'] = $this->proceed_ko_text; // 오탈자 수정한 검색어
        //$data['force_search']="";
        $data['total_column'] = $this->total_row_count;


        $data['data'] = $tdata['data'];
        $data['related'] = $this->similar;
        if($this->type =='debug') {
            echo implode("<BR>",$this->debug_mode);

            $this->print($this->type, $data);
        }else{
            $this->print($this->type, $data);
        }
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
            helper('xml');
            echo xml_convert($return_data);
        } else if ($mode == "array" or $mode == "debug") {
            echo "<pre>";
            print_r($return_data);
            echo "</pre>";
        } else if ( $mode == "csv") {
            foreach ($return_data['data'] as $k => $v) {
                $tmp[] = $v->ref_idx;
            }
            echo implode(",", $tmp);
        } else {
            $this->error("json", "정의된 문서 형식이 아닙니다.");
          //  echo "<span class='message'><B>상품 조회에 실패 하였습니다.</b></span>";
        }
        exit;
        //return $this;
    }
    public function test()
    {
        $focded = isset($_GET['force']) ? $_GET['force'] : 0;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $this->type = isset($_GET['type']) ? $_GET['type'] : "json";
        $this->force =false;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 20;

        /*             $this->Morpheme($keyword);
                    echo "===========<BR>";
        echo implode("<BR>",$this->debug_mode);
                echo "<BR>===========<BR>";
                //$add_query = $this->_morpheme($keyword,'low');
                echo "keyword : $keyword <BR>";
                echo "형태소 분석 : ";
                print_r($this->more_word);
                echo " <BR>";
                exit;*/
        $this->pre_string($this->keyword);
        echo "<BR>proceed_ko_text : $this->proceed_ko_text <BR>";
        echo "input_text : $this->input_text<BR>";
        echo "orginal_text : $this->orginal_text<BR>";
        echo "more_word : ".serialize($this->more_word)."<BR>";
        echo "MODEL product_search <BR>";
        echo "proceed_text : ".$this->proceed_text." <BR>";
        if(is_array($this->more_word)) {
            foreach ($this->more_word as $k => $moreword)
                echo "more_word : $k => $moreword <BR>";
        }
        $this->word->setTable("search_keyword"); //인덱스 설정.
        $this->word->setLimit($limit);
        list($data,$sql) = $this->word->product_search($this->proceed_text,$this->addText,$this->more_word,$page);
        echo " Query: ". $sql;
        echo "<BR>total row count:".$this->word->getTotal_cnt();

    }

    //자동완성
    public function auto_complete()
    {
     /*   $focded = isset($_GET['force']) ? $_GET['force'] : 0;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $this->type = isset($_GET['type']) ? $_GET['type'] : "";*/

        $this->pre_string($this->keyword,$this->force);  //검색어 텍스트 선처리

        //   $this->tranjamo($keyword); // $this->eng_value=,  $this->first_jamo
        $this->index = "autokeyword";

        $this->word->setTable("auto_keyword"); //인덱스 설정.

        if($this->fixed_str=="")  $this->error($this->type,"검색어 없음"."(원문 :$this->orginal_text)");// $this->call($this->index.'/_search');
        else {
            $result['return_code'] = "200";
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
