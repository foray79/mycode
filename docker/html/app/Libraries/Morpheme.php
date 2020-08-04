<?php


namespace App\Libraries;


/*형태소 분석기*/
class Morpheme
{
    protected $word;
    protected $lexical;
    protected $type;
    protected $host;
    protected $port;
    public $return; //형태소 분석 결과 (순수값)
    public $rtn; //디버깅용데이터

    public function __construct($lexical = "kkma")
    {
        $this->setLexical($lexical);
        $this->setClass();
        $this->setWord("");
        $this->host = "192.168.0.65";
        $this->port = ":8000";
    }

    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    public function setLexical($lexical)
    {
        $this->lexical = $lexical;
        return $this;
    }

    public function setClass($type = "null")
    {
        if ($type == "null" || $type == "detail") {
            $this->type = $type;
        }
        return $this;
    }

    public function analysis()
    {

        $add_param = "&lexical=" . $this->lexical;
        if ($this->type != 'null') $add_param .= "&result=" . $this->type;
        $url = "http://" . $this->host . $this->port . "/nlp?text=" . urlencode($this->word) . $add_param;


        $this->return = exec("curl " . $url);
//echo "<h2>".$url."<BR></h2>";
        //echo $this->return."</h2>";
        return $this;
    }

    public function getResult()
    {
        return $this->return;
    }

    public function getArrResult()
    {

        $r = preg_replace("/[\[|\]|\'|\s]/", "", $this->return);

        $_r = explode(",", $r);

        return $_r;
    }

    // 분석 결과 체크 .. 검색 자동완성에서 이용을 위한 고도화 처리
    public function check()
    {
        $k = null;
        $r = preg_replace("/[\[|\]|\'|\s]/", "", $this->return);
        $_r = explode(",", $r);
        $rcnt = count($_r);
        $wlen = mb_strlen($this->word);
        //echo "string length:" . $wlen . ", array count :" . $rcnt;

        $level = "";
        if ($rcnt == 1) { //자기 자신 또는 일부
            //$_r = array($this->word);
            $this->rtn['one'][$this->word] = $_r;

            $level = 'one';
        } elseif ($wlen < $rcnt) { //.. 글자수만큼 분석된 경우 즉 한자리씩 분할했을 경우
            //$_r = array($this->word);
            $_r = $this->delteOneword($_r);
            $this->rtn['over'][$this->word] = $_r;
            $level = 'over';
        } elseif ($wlen == $rcnt) { // 한글자로된 키워드가 존재하므로 해당 키워드는 삭제
            $_r = $this->delteOneword($_r);
            $this->rtn['mmm'][$this->word] = $_r;
            $level = 'mmm';
        } elseif (!in_array($this->word, $_r)) { //키워드에 자신이 없을때는 추가
            $_r = $this->delteOneword($_r);
            // array_push($_r, $this->word); -- 원 검색어 삭제로 인해..  개발정책
            $this->rtn['exclude'][$this->word] = $_r;
            $level = 'exclude';
        } else {
            $_r = $this->delteOneword($_r);
            $this->rtn['ok'][$this->word] = $_r;
            $level = 'ok';
        }

        if (count($_r) <= 0) $_r = array();
        //if (!in_array($this->word, $_r) )   array_push($_r,$this->word);

        //원 검색어는 제거
        $k = null;
        $k = array_search($this->word, $_r, false);

        if ($k !== false) {
            unset($_r[$k]);
        }

        //if($k>=0) unset($_r[$k]);
        //   echo $this->word."(".$level.")=>";

        return $_r;
    }

    //한글자 빼기
    public function delteOneword($r)
    {
        $rtn = array();
        foreach ($r as $word) {
            if (mb_strlen($word) > 1) $rtn[] = $word;
        }
        if (count($rtn) > 0) return array_filter($rtn);
        else return array();
    }

    // 분석 결과 체크 .. 검색 자동완성에서 이용을 위한 고도화 처리
    public function hight_tech_check()
    {
        $r = preg_replace("/[\[|\]|\'|\s]/", "", $this->return);
        $_r = explode(",", $r);
        $rcnt = count($_r);
        $wlen = mb_strlen($this->word);
        //echo "string length:" . $wlen . ", array count :" . $rcnt;

        $level = "";
        if ($rcnt == 1) { //자기 자신
            //$_r = array($this->word);
            $this->rtn['one'][$this->word] = $_r;

            $level = 'one';
        } elseif ($wlen < $rcnt) { //.. 글자수만큼 분석된 경우 즉 한자리씩 분할했을 경우
            //$_r = array($this->word);
            $_r = $this->delteOneword($_r);
            $this->rtn['over'][$this->word] = $_r;
            $level = 'over';
        } elseif ($wlen == $rcnt) { // 한글자로된 키워드가 존재하므로 해당 키워드는 삭제
            $_r = $this->delteOneword($_r);
            $this->rtn['mmm'][$this->word] = $_r;
            $level = 'mmm';
        } elseif (!in_array($this->word, $_r)) { //키워드에 자신이 없을때는 추가
            $_r = $this->delteOneword($_r);
            array_push($_r, $this->word);
            $this->rtn['exclude'][$this->word] = $_r;
            $level = 'exclude';
        } else {
            $_r = $this->delteOneword($_r);
            $this->rtn['ok'][$this->word] = $_r;
            $level = 'ok';
        }
        if (count($_r) <= 0) $_r = array();
        //if (!in_array($this->word, $_r) )   array_push($_r,$this->word);

        //원 검색어는 제거
        $k = array_search($this->word, $_r);
        if ($k >= 0) unset($_r[$k]);

        // echo $this->word."(".$level.")=>";   print_r($_r);
        return $_r;
    }
}