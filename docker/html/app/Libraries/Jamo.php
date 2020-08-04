<?php namespace App\Libraries;


class Jamo
{
    private $jaum;
    private $moun;
    private $bachim;
    private $ko2en;
    private $munja; //입력값
    private $change_text; //변경값
    private $ko_str;
    private $ko_first;
    private $ko_text; //영문-> 한글변환
    public function __construct()
    {

        $this->jaum = array('ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ');
        $this->moum = array('ㅏ', 'ㅐ', 'ㅑ', 'ㅒ', 'ㅓ', 'ㅔ', 'ㅕ', 'ㅖ', 'ㅗ', 'ㅘ', 'ㅙ', 'ㅚ', 'ㅛ', 'ㅜ', 'ㅝ', 'ㅞ', 'ㅟ', 'ㅠ', 'ㅡ', 'ㅢ', 'ㅣ');
        $this->bachim = array('', 'ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ','ㅋ', 'ㅌ', 'ㅍ', 'ㅎ');
        $this->ko2en = array( 'ㄱ' => 'r',
            'ㄲ' => 'R',
            'ㄳ' => 'rt',
            'ㄴ' => 's',
            'ㄵ' => 'sw',
            'ㄶ' => 'sg',
            'ㄷ' => 'e',
            'ㄸ' => 'E',
            'ㄹ' => 'f',
            'ㄺ' => 'fr',
            'ㄻ' => 'fa',
            'ㄼ' => 'fq',
            'ㄽ' => 'ft',
            'ㄾ' => 'fx',
            'ㄿ' => 'fv',
            'ㅀ' => 'fg',
            'ㅁ' => 'a',
            'ㅂ' => 'q',
            'ㅃ' => 'Q',
            'ㅄ' => 'qt',
            'ㅅ' => 't',
            'ㅆ' => 'T',
            'ㅇ' => 'd',
            'ㅈ' => 'w',
            'ㅉ' => 'W',
            'ㅊ' => 'c',
            'ㅋ' => 'z',
            'ㅌ' => 'x',
            'ㅍ' => 'v',
            'ㅎ' => 'g',
            'ㅏ' => 'k',
            'ㅐ' => 'o',
            'ㅑ' => 'i',
            'ㅒ' => 'O',
            'ㅓ' => 'j',
            'ㅔ' => 'p',
            'ㅕ' => 'u',
            'ㅖ' => 'P',
            'ㅗ' => 'h',
            'ㅘ' => 'hk',
            'ㅙ' => 'ho',
            'ㅚ' => 'hl',
            'ㅛ' => 'y',
            'ㅜ' => 'n',
            'ㅝ' => 'nj',
            'ㅞ' => 'np',
            'ㅟ' => 'nl',
            'ㅠ' => 'b',
            'ㅡ' => 'm',
            'ㅢ' => 'ml',
            'ㅣ' => 'l');
    }
    public function setText($text)
    {
        $this->change_text = $this->ko_str="";
        $this->munja = $text;
        return $this->exec_change();
        return $this;
    }
    public function auto_convert($text)
    {
        return  $this->is_ko($text) ? $this->ko_text: $text ;
    }
    public function is_ko($text)
    {
        $this->ko_text =$this->convert($text); //영어->한글
        $this->setText($this->ko_text);  // 한글->영어
        //  echo "<h1>  원문:".$text." , 한글로 변환:$this->ko_text , 다시 영어로:".$this->change_text.($this->change_text == $text ? "영어 입력" : "한글입력 ").", 리턴:".($this->change_text == $text ? $this->ko_text: $text)."</h1><BR>";
        if($this->change_text == $text) return true;//한->엉->한 변환 텍스트와 원본이 같다면.. 원문은 영문.
        else return false; //원문은 한글

    }
    public function getKeyword()
    {
        return $this->change_text;
    }
    public function getkoFirst()
    {
        return $this->ko_first;
    }
    public function exec_change()
    {
        $this->ko_first=$str="";
        for($i=0;$i<mb_strlen($this->munja);$i++)
        {
            $str = mb_substr($this->munja,$i,1);

            if($str >= '가' && $str <= '힣') {
                $munjaCode = $this->JS_charCodeAt($str, 0);
                /*
                // 0xAC00 => 한글 첫 글자인 '가'
                */
                $munjaBeonho = $munjaCode - 0xAC00;

                $jong = $munjaBeonho % 28;
                $jung = (($munjaBeonho - $jong) / 28) % 21;
                $cho = ((($munjaBeonho - $jong) / 28) - $jung) / 21;

                $this->ko_str .= "{$this->jaum[$cho]}";
                $this->ko_first .= "{$this->jaum[$cho]}";
                $this->ko_str .= "{$this->moum[$jung]}";
                $this->ko_str .= ($jong) ? "{$this->bachim[$jong]}" : '';

                $this->change_text .= $this->ko2en[$this->jaum[$cho]];
                $this->change_text .= $this->ko2en[$this->moum[$jung]];
                $this->change_text .= ($jong) ? $this->ko2en[$this->bachim[$jong]] : '';
                //echo $ko2en[$cho];
            } else if($str >= 'ㄱ' && $str <= 'ㅎ' &&  isset($this->ko2en[$str])){
                $this->change_text .= $this->ko2en[$str];
                $this->ko_first .= $str;
            } else {
                $this->ko_str .= $str;
                $this->ko_first .= $str;
                $this->change_text .= $str;
            }

        }
        return $this;
    }
    public function get_first_vowel(){
        return $this->ko_first;
    }
    private  function JS_charCodeAt($str, $index) {
        $utf16 = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
        return ord($utf16[$index*2]) + (ord($utf16[$index*2+1]) << 8);
    }
    //영타->한글로 변경
    public static function convert($str)
    {
        // 빈 문자열은 처리하지 않는다.

        if ($str == '') return '';
        if(is_array($str)) {
            $var = implode(" ",$str);
            $str = $var;
        }

        // 문자열을 한 글자씩 자른다.

        $chars = preg_split('//u', $str);

        // 변환 과정에 사용할 변수들.

        $interim = array();
        $last_char = 0;
        $skip_next = 0;

        // 각 문자를 처리한다.

        foreach ($chars as $i => $char)
        {
            // 겹자음, 겹모음 때문에 다음 문자를 건너뛰도록 설정한 경우.

            if ($skip_next)
            {
                $skip_next = 0;
                continue;
            }

            // 2바이트 이상의 문자는 그대로 반환한다.

            elseif (strlen($char) > 1)
            {
                $interim[] = $char;
                $last_char = 0;
            }

            // 숫자와 특수기호 등은 그대로 반환한다.

            elseif (!ctype_alpha($char))
            {
                $interim[] = $char;
                $last_char = 0;
            }

            // 그 밖의 문자는 한글로 변환한다.

            else
            {
                // 초성인 경우.

                if (($last_char == 0 || $last_char == 3) && isset(self::$charmap1[$char]))
                {
                    $interim[] = array(self::$charmap1[$char]);
                    $last_char = 1;
                    continue;
                }

                // 중성인 경우.

                if ($last_char == 1 && isset(self::$charmap2[$char]))
                {
                    // 겹모음 처리.

                    if (count($chars) > $i + 1)
                    {
                        $next_char = $chars[$i + 1];
                        if (isset(self::$charmap2[$char . $next_char]))
                        {
                            $skip_next = 1;
                            $char = $char . $next_char;
                        }
                    }

                    $interim[count($interim) - 1][] = self::$charmap2[$char];
                    $last_char = 2;
                    continue;
                }

                // 종성인 경우.

                if ($last_char == 2 && isset(self::$charmap3[$char]))
                {
                    // 겹자음 처리.

                    if (count($chars) > $i + 1)
                    {
                        $next_char = $chars[$i + 1];
                        if (isset(self::$charmap3[$char . $next_char]))
                        {
                            $skip_next = 1;
                            $char = $char . $next_char;
                        }
                    }

                    $interim[count($interim) - 1][] = self::$charmap3[$char];
                    $last_char = 3;
                    continue;
                }

                // 종성 후에 중성이 다시 나온 경우 앞의 종성을 초성으로 바꾼다.

                if ($last_char == 3 && isset(self::$charmap2[$char]))
                {
                    // 겹모음 처리.

                    if (count($chars) > $i + 1)
                    {
                        $next_char = $chars[$i + 1];
                        if (isset(self::$charmap2[$char . $next_char]))
                        {
                            $skip_next = 1;
                            $char = $char . $next_char;
                        }
                    }

                    if (isset($interim[count($interim) - 1][2]))
                    {
                        $last_batchim = $interim[count($interim) - 1][2];
                        $last_batchim = array_search($last_batchim, self::$charmap3);
                        if (strlen($last_batchim) == 1)
                        {
                            $interim[count($interim) - 1][2] = 0;
                            $interim[] = array(
                                self::$charmap1[$last_batchim],
                                self::$charmap2[$char],
                            );
                        }
                        elseif (strlen($last_batchim) == 2)
                        {
                            $interim[count($interim) - 1][2] = self::$charmap3[substr($last_batchim, 0, 1)];
                            $interim[] = array(
                                self::$charmap1[substr($last_batchim, 1, 1)],
                                self::$charmap2[$char],
                            );
                        }
                        $last_char = 2;
                    }
                    continue;
                }
            }
        }

        // 반환할 문자열을 조합한다.

        $output = '';
        foreach ($interim as $char)
        {
            // 한글인 경우 유니코드 코드 포인트 번호를 이용한다.

            if (is_array($char))
            {
                if (count($char) < 3)
                {
                    $char[] = 0;
                    $char[] = 0;
                }

                $char_index = ($char[0] * 21 * 28) + ($char[1] * 28) + $char[2] + 44032;
                $output .= html_entity_decode('&#' . $char_index . ';');
            }

            // 그 밖의 문자는 그대로 반환한다.

            else
            {
                $output .= $char;
            }
        }

        // 결과를 반환한다.

        return $output;
    }

    // 초성 목록.

    protected static $charmap1 = array(
        'r'  =>  0,  // ㄱ
        'R'  =>  1,  // ㄲ
        's'  =>  2,  // ㄴ
        'e'  =>  3,  // ㄷ
        'E'  =>  4,  // ㄸ
        'f'  =>  5,  // ㄹ
        'a'  =>  6,  // ㅁ
        'q'  =>  7,  // ㅂ
        'Q'  =>  8,  // ㅃ
        't'  =>  9,  // ㅅ
        'T'  => 10,  // ㅆ
        'd'  => 11,  // ㅇ
        'w'  => 12,  // ㅈ
        'W'  => 13,  // ㅉ
        'c'  => 14,  // ㅊ
        'z'  => 15,  // ㅋ
        'x'  => 16,  // ㅌ
        'v'  => 17,  // ㅍ
        'g'  => 18,  // ㅎ
    );

    // 중성 목록.

    protected static $charmap2 = array(
        'k'  =>  0,  // ㅏ
        'o'  =>  1,  // ㅐ
        'i'  =>  2,  // ㅑ
        'O'  =>  3,  // ㅒ
        'j'  =>  4,  // ㅓ
        'p'  =>  5,  // ㅔ
        'u'  =>  6,  // ㅕ
        'P'  =>  7,  // ㅖ
        'h'  =>  8,  // ㅗ
        'hk' =>  9,  // ㅘ
        'ho' => 10,  // ㅙ
        'hl' => 11,  // ㅚ
        'y'  => 12,  // ㅛ
        'n'  => 13,  // ㅜ
        'nj' => 14,  // ㅝ
        'np' => 15,  // ㅞ
        'nl' => 16,  // ㅟ
        'b'  => 17,  // ㅠ
        'm'  => 18,  // ㅡ
        'ml' => 19,  // ㅢ
        'l'  => 20,  // ㅣ
    );

    // 종성 목록.

    protected static $charmap3 = array(
        '0'  =>  0,  // 받침이 없는 경우
        'r'  =>  1,  // ㄱ
        'R'  =>  2,  // ㄲ
        'rt' =>  3,  // ㄳ
        's'  =>  4,  // ㄴ
        'sw' =>  5,  // ㄵ
        'sg' =>  6,  // ㄶ
        'e'  =>  7,  // ㄷ
        'f'  =>  8,  // ㄹ
        'fr' =>  9,  // ㄺ
        'fa' => 10,  // ㄻ
        'fq' => 11,  // ㄼ
        'ft' => 12,  // ㄽ
        'fx' => 13,  // ㄾ
        'fv' => 14,  // ㄿ
        'fg' => 15,  // ㅀ
        'a'  => 16,  // ㅁ
        'q'  => 17,  // ㅂ
        'qt' => 18,  // ㅄ
        't'  => 19,  // ㅅ
        'T'  => 20,  // ㅆ
        'd'  => 21,  // ㅇ
        'w'  => 22,  // ㅈ
        'c'  => 23,  // ㅊ
        'z'  => 24,  // ㅋ
        'x'  => 25,  // ㅌ
        'v'  => 26,  // ㅍ
        'g'  => 27,  // ㅎ
    );
}
