<?php
/**
-------------------------
GNU GPL COPYRIGHT NOTICES
-------------------------
**
* $Id$
*
* @author thangtt <thangtt@az24.com>
* @link http://www.az24.vn/
* @copyright Copyright &copy; 2009-2010 HDC.
*
*/
class StringUtils {

    public static function getTeaser($html) {
        //$html = $this->removeHTML ( $html );
        //$html = $this->cut_string ( $html, 300 );
        return $html;
    }

    public static function isValidEmail($email) {
        //return eregi ( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email );
    }
    public static function msgbox($title) {
        echo '<script>alert("' . $title . '")</script>';
    }

    public static function removeQuote($string) {
        $sting = trim ( $string );
        $sting = str_replace ( "\'", "'", $sting );
        $sting = str_replace ( "'", "''", $sting );
        return $string;
    }
    public static function getValueArray($value, $array, $default = '') {
        if (isset ( $array [$value] ))
            return $array [$value];
        return $default;
    }
    public static function mailcontact($arrayValue, $content) {
        foreach ( $arrayValue as $key => $value ) {
            $content = str_replace ( "{#" . $key . "#}", $value, $content );
        }
        return $content;
    }

    public static function randomkey($str, $keyword = 0) {
        $return = '';
        $strreturn = explode ( " ", trim ( $str ) );
        $i = 0;
        $listid = '';
        while ( $i < count ( $strreturn ) ) {
            $id = rand ( 0, count ( $strreturn ) );
            if (strpos ( $listid, '[' . $id . ']' ) === false) {
                if (isset ( $strreturn [$id] )) {
                    $return .= $strreturn [$id] . ' ';
                    $i ++;
                    if ($keyword == 1 && ($i % 2) == 0 && $i < count ( $strreturn ))
                        $return .= ',';
                    $listid .= '[' . $id . ']';
                }
            }
        }
        return $return;
    }
    public static function array_language() {
        return array (1 => "vn", 2 => "en" );
    }
    public static function random() {
        $rand_value = "";
        $rand_value .= rand ( 1000, 9999 );
        $rand_value .= chr ( rand ( 65, 90 ) );
        $rand_value .= rand ( 1000, 9999 );
        $rand_value .= chr ( rand ( 97, 122 ) );
        $rand_value .= rand ( 1000, 9999 );
        $rand_value .= chr ( rand ( 97, 122 ) );
        $rand_value .= rand ( 1000, 9999 );
        return $rand_value;
    }
    public static function str_encode($encodeStr = "") {
        $returnStr = "";
        if ($encodeStr == '')
            return $encodeStr;
        if (! empty ( $encodeStr )) {
            $enc = base64_encode ( $encodeStr );
            $enc = str_replace ( '=', '', $enc );
            $enc = str_rot13 ( $enc );
            $returnStr = $enc;
        }
        return $returnStr;
    }

    public static function str_decode($encodedStr = "", $type = 0) {
        $returnStr = "";
        $encodedStr = str_replace ( " ", "+", $encodedStr );
        if (! empty ( $encodedStr )) {
            $dec = str_rot13 ( $encodedStr );
            $dec = base64_decode ( $dec );
            $returnStr = $dec;
        }
        return $returnStr;
    }

    public static function getURLR($mod_rewrite = 1, $serverName = 0, $scriptName = 0, $fileName = 1, $queryString = 1, $varDenied = '') {
        if ($mod_rewrite == 1) {
            return $_SERVER ['REQUEST_URI'];
        } else {
            //return $this->getURL ( $serverName, $scriptName, $fileName, $queryString, $varDenied );
        }
    }
    //hàm get URL
    public static function getURL($serverName = 0, $scriptName = 0, $fileName = 1, $queryString = 1, $varDenied = '') {
        $url = '';
        $slash = '/';
        if ($scriptName != 0)
            $slash = "";
        if ($serverName != 0) {
            if (isset ( $_SERVER ['SERVER_NAME'] )) {
                $url .= 'http://' . $_SERVER ['SERVER_NAME'];
                if (isset ( $_SERVER ['SERVER_PORT'] ))
                    $url .= ":" . $_SERVER ['SERVER_PORT'];
                $url .= $slash;
            }
        }
        if ($scriptName != 0) {
            if (isset ( $_SERVER ['SCRIPT_NAME'] ))
                $url .= substr ( $_SERVER ['SCRIPT_NAME'], 0, strrpos ( $_SERVER ['SCRIPT_NAME'], '/' ) + 1 );
        }
        if ($fileName != 0) {
            if (isset ( $_SERVER ['SCRIPT_NAME'] ))
                $url .= substr ( $_SERVER ['SCRIPT_NAME'], strrpos ( $_SERVER ['SCRIPT_NAME'], '/' ) + 1 );
        }
        if ($queryString != 0) {
            $dau = 0;
            $url .= '?';
            reset ( $_GET );
            if ($varDenied != '') {
                $arrVarDenied = explode ( '|', $varDenied );
                while ( list ( $k, $v ) = each ( $_GET ) ) {
                    if (array_search ( $k, $arrVarDenied ) === false) {
                        $url .= (($dau == 0) ? '' : '&') . $k . '=' . urlencode ( $v );
                        $dau = 1;
                    }
                }
            } else {
                while ( list ( $k, $v ) = each ( $_GET ) )
                    $url .= '&' . $k . '=' . urlencode ( $v );
            }
        }
        $url = str_replace ( '"', '&quot;', strval ( $url ) );
        return $url;
    }
    //hàm tạo link khi cần thiết chuyển sang mod rewrite


    //loại bỏ hoạt động của các thẻ html, vô hiệu hóa
    public static function htmlspecialbo($str) {
        $arrDenied = array ('<', '>', '"' );
        $arrReplace = array ('&lt;', '&gt;', '&quot;' );
        $str = str_replace ( $arrDenied, $arrReplace, $str );
        return $str;
    }

    // loại bỏ các thẻ html, javascript
    public static function removeHTML($string) {
        $string = mb_convert_encoding ( $string, "UTF-8", "UTF-8" );
        $string = preg_replace ( '/<script.*?\>.*?<\/script>/si', ' ', $string );
        $string = preg_replace ( '/<style.*?\>.*?<\/style>/si', ' ', $string );
        $string = preg_replace ( '/<.*?\>/si', ' ', $string );
        $string = str_replace ( '&nbsp;', ' ', $string );
        $string = trim($string);
        //$string = html_entity_decode ($string);
        return $string;
    }

    // hàm redirect : 1 url
    public static function redirect($url, $http = 0) {
        $url = str_replace ( "'", "\'", $url );
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit ();
        exit ();
    }

    //hàm cắt chuổi
    public static function cut_string($str, $length) {
        if (mb_strlen ( $str, "UTF-8" ) > $length)
            return mb_substr ( $str, 0, $length, "UTF-8" ) . '...';
        else
            return $str;
    }
    public static function cutstring($str, $len, $more) {
        if ($str == "" || $str == NULL)
            return $str;
        if (strlen ( $str ) <= $len)
            return $str;
        $str = strip_tags ( $str );
        $str = trim ( $str );
        $str = substr ( $str, 0, $len );
        if ($str != "") {
            if (! substr_count ( $str, " " )) {
                if ($more)
                    $str .= " ...";
                return $str;
            }
            while ( strlen ( $str ) && ($str [strlen ( $str ) - 1] != " ") ) {
                $str = substr ( $str, 0, - 1 );
            }
            $str = substr ( $str, 0, - 1 );
            if ($more)
                $str .= " ...";
        }
        return $str;
    }
    public static function length($str) {
        return mb_strlen ( $str, "UTF-8" );
    }
    //
    public static function replaceMQ($text) {
        $text = str_replace ( "\'", "'", $text );
        $text = str_replace ( "'", "''", $text );
        return $text;
    }
    public static function RemoveSign($str) {
        $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

        $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
        return str_replace ( $coDau, $khongDau, $str );
    }
    public static function removeKey($string) {
        $string = trim ( preg_replace ( "/[^A-Za-z0-9àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸ]/i", " ", $string ) );
        $string = str_replace ( " ", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = mb_convert_encoding ( $string, "UTF-8", "UTF-8" );
        return $string;
    }

    public static function removeTitle($string, $keyReplace="") {
        $string = StringUtils::RemoveSign ( $string );
        //neu muon de co dau
        $string = trim ( preg_replace ( "/[^A-Za-z0-9]/i", " ", $string ) ); // khong dau
        $string = str_replace ( " ", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( "--", "-", $string );
        $string = str_replace ( $keyReplace, "-", $string );
        return $string;
    }

    public static function getKeyRef($query, $keyname = "q") {
        $strreturn = '';
        preg_match ( "#" . $keyname . "=(.*)#si", $query, $match );
        if (isset ( $match [1] ))
            $strreturn = preg_replace ( '#\&(.*)#si', "", $match [1] );
        return urldecode ( $strreturn );
    }
    //ham ma hoa
    public static function fSencode($encodeStr = "") {
        $returnStr = "";
        if (! empty ( $encodeStr )) {
            $enc = base64_encode ( $encodeStr );
            $enc = str_replace ( '=', '', $enc );
            $enc = str_rot13 ( $enc );
            $returnStr = $enc;
        }

        return $returnStr;
    }

    //ham giai mai
    public static function fSdecode($encodedStr = "", $type = 0) {
        $returnStr = "";
        $encodedStr = str_replace ( " ", "+", $encodedStr );
        if (! empty ( $encodedStr )) {
            $dec = str_rot13 ( $encodedStr );
            $dec = base64_decode ( $dec );
            $returnStr = $dec;
        }
        switch ($type) {
            case 0 :
                $returnStr = str_replace ( "\'", "'", $returnStr );
                $returnStr = str_replace ( "'", "''", $returnStr );
                return $returnStr;
                break;
            case 1 :
                return intval ( $returnStr );
                break;
            case 3 :
                return doubleval ( $returnStr );
                break;
        }
    }

    public static function int_to_words($x) {
//        $nwords = array ("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín", "mười", "mười một", "mười hai", "mười ba", "mười bốn", "mười lăm", "mười sáu", "mười bảy", "mười tám", "mười chín", "hai mươi", 30 => "ba mươi", 40 => "bốn mươi", 50 => "năm mươi", 60 => "sáu mươi", 70 => "bảy mươi", 80 => "tám mươi", 90 => "chín mươi" );
//        if (! is_numeric ( $x )) {
//            $w = '#';
//        } else if (fmod ( $x, 1 ) != 0) {
//                $w = '#';
//            } else {
//                if ($x < 0) {
//                    $w = 'minus ';
//                    $x = - $x;
//                } else {
//                    $w = '';
//                }
//                if ($x < 21) {
//                    $w .= $nwords [$x];
//                } else if ($x < 100) {
//                        $w .= $nwords [10 * floor ( $x / 10 )];
//                        $r = fmod ( $x, 10 );
//                        if ($r > 0) {
//                            $w .= ' ' . $nwords [$r];
//                        }
//                } else if ($x < 1000) {
//                        $w .= $nwords [floor ( $x / 100 )] . ' trăm';
//                        $r = fmod ( $x, 100 );
//                        if ($r > 0) {
//                            $w .= '  ' . $this->int_to_words ( $r );
//                        }
//                } else if ($x < 1000000) {
//                        $w .= $this->int_to_words ( floor ( $x / 1000 ) ) . ' ngàn';
//                        $r = fmod ( $x, 1000 );
//                        if ($r > 0) {
//                            $w .= ' ';
//                            if ($r < 100) {
//                                $w .= ' ';
//                            }
//                            $w .= $this->int_to_words ( $r );
//                    }
//                } else {
//                    $w .= $this->int_to_words ( floor ( $x / 1000000 ) ) . ' triệu';
//                    $r = fmod ( $x, 1000000 );
//                    if ($r > 0) {
//                        $w .= ' ';
//                        if ($r < 100) {
//                            $word .= ' ';
//                        }
//                        $w .= $this->int_to_words ( $r );
//                    }
//            }
//        }
//        return $w . '';
    }
    public static function word_limiter($text, $limit = 30, $chars = '') {

        $text = StringUtils::removeHTML($text);
        $text = stripslashes($text);

        if (strlen ( $text ) > $limit) {
            $text = mb_substr($text,0,$limit,'utf8');
            $text = $text.'&hellip;';
            /*$words = str_word_count ( $text, 2, $chars );
            echo $words[1];die;
            $words = array_reverse ( $words, TRUE );
            foreach ( $words as $length => $word ) {
            if ($length + strlen ( $word ) >= $limit) {
            array_shift ( $words );
            } else {
            break;
            }
            }
            $words = array_reverse ( $words );
            $text = implode ( " ", $words ) . '&hellip;';*/
        }
        return $text;
    }
    public static function htmlNormalize($text){
        //$text = '<strong><pre><script>aaaaaaaaaaaaaaaaaa</script></pre></strong>';
        //$text = StringUtils::removeHTML($text);
        //$text = stripslashes($text);

        //preg_match_all("/<script>(.*)<\/script>/u",$text,$output);
        //$text = str_replace("\n","<br />",$text);
        $text = str_replace('<script','<pre>&lt;script',$text);
        $text = str_replace('</script>','&lt;/script&gt;</pre>',$text);

        return $text;
    }

    public static function getDayVi($day){
        $day = intval($day);
        $day_vi = "";
        switch($day){
            case 0:
                $day_vi = 8;
                break;
            case 1:
                $day_vi = 2;
                break;
            case 2:
                $day_vi = 3;
                break;
            case 3:
                $day_vi = 4;
                break;
            case 4:
                $day_vi = 5;
                break;
            case 5:
                $day_vi = 6;
                break;
            case 6:
                $day_vi = 7;
                break;           
        }
        return $day_vi;
    }

    public static function getDayViPrint($day){
        $day = intval($day);
        $day_vi = "";
        switch($day){
            case 0:
                $day_vi = "CN";
                break;
            case 1:
                $day_vi = "T.2";
                break;
            case 2:
                $day_vi = "T.3";
                break;
            case 3:
                $day_vi = "T.4";
                break;
            case 4:
                $day_vi = "T.5";
                break;
            case 5:
                $day_vi = "T.6";
                break;
            case 6:
                $day_vi = "T.7";
                break;           
        }
        return $day_vi;
    }

    public static function getDayViText($day){ 
        $day = intval($day);
        $day_vi = "";
        switch($day){
            case 0:
                $day_vi = "Chủ nhật";
                break;
            case 1:
                $day_vi = "Thứ hai";
                break;
            case 2:
                $day_vi = "Thứ ba";
                break;
            case 3:
                $day_vi = "Thứ tư";
                break;
            case 4:
                $day_vi = "Thứ năm";
                break;
            case 5:
                $day_vi = "Thứ sáu";
                break;
            case 6:
                $day_vi = "Thứ bảy";
                break;           
        }
        return $day_vi;
    }

    public static function getDayByDate($date){ 
        $arrDate = explode("/",$date);

        $day = "";
        if(count($arrDate) >1){  
            $time = mktime(0,0,0,$arrDate[1],$arrDate[0],$arrDate[2]);         
            $date = getdate($time);
            $day = StringUtils::getDayViText($date["wday"]);
        }
        return $day;
    }

    public static function getVitriGiaiMienbac($giai)
    {
        switch($giai){
            case "giai_dacbiet": 
                $vitri = array(0,4);
                break;
            case "giai_nhat": 
                $vitri = array(5,9);
                break;
            case "giai_nhi_1": 
                $vitri = array(10,14);
                break;
            case "giai_nhi_2": 
                $vitri = array(15,19);
                break;
            case "giai_ba_1": 
                $vitri = array(20,24);
                break;
            case "giai_ba_2": 
                $vitri = array(25,29);
                break;
            case "giai_ba_3": 
                $vitri = array(30,34);
                break;
            case "giai_ba_4": 
                $vitri = array(35,39);
                break;
            case "giai_ba_5": 
                $vitri = array(40,44);
                break;
            case "giai_ba_6": 
                $vitri = array(45,49);
                break;
            case "giai_tu_1": 
                $vitri = array(50,53);
                break;
            case "giai_tu_2": 
                $vitri = array(54,57);
                break;
            case "giai_tu_3": 
                $vitri = array(58,61);
                break;
            case "giai_tu_4": 
                $vitri = array(62,65);
                break;
            case "giai_nam_1": 
                $vitri = array(66,69);
                break;
            case "giai_nam_2": 
                $vitri = array(70,73);
                break;
            case "giai_nam_3": 
                $vitri = array(74,77);
                break;
            case "giai_nam_4": 
                $vitri = array(78,81);
                break;
            case "giai_nam_5": 
                $vitri = array(82,85);
                break;
            case "giai_nam_6": 
                $vitri = array(86,89);
                break;
            case "giai_sau_1": 
                $vitri = array(90,92);
                break;
            case "giai_sau_2": 
                $vitri = array(93,95);
                break;
            case "giai_sau_3": 
                $vitri = array(96,98);
                break;
            case "giai_bay_1": 
                $vitri = array(99,100);
                break;
            case "giai_bay_2": 
                $vitri = array(101,102);
                break;
            case "giai_bay_3": 
                $vitri = array(103,104);
                break;
            case "giai_bay_4": 
                $vitri = array(105,106);
                break; 
        }
        return $vitri; 
    }

    public static function getVitriGiaiMiennam($giai){
        switch($giai){
            case "giai_dacbiet": 
                $vitri = array(0,5);
                break;
            case "giai_nhat": 
                $vitri = array(6,10);
                break;
            case "giai_nhi": 
                $vitri = array(11,15);
                break;
            case "giai_ba_1": 
                $vitri = array(16,20);
                break;
            case "giai_ba_2": 
                $vitri = array(21,25);
                break;
            case "giai_tu_1": 
                $vitri = array(26,30);
                break;
            case "giai_tu_2": 
                $vitri = array(31,35);
                break;
            case "giai_tu_3": 
                $vitri = array(36,40);
                break;
            case "giai_tu_4": 
                $vitri = array(41,45);
                break;
            case "giai_tu_5": 
                $vitri = array(46,50);
                break;
            case "giai_tu_6": 
                $vitri = array(51,55);
                break;
            case "giai_tu_7": 
                $vitri = array(56,60);
                break;
            case "giai_nam": 
                $vitri = array(61,64);
                break;           
            case "giai_sau_1": 
                $vitri = array(65,68);
                break;
            case "giai_sau_2": 
                $vitri = array(69,72);
                break;
            case "giai_sau_3": 
                $vitri = array(73,76);
                break;
            case "giai_bay": 
                $vitri = array(77,79);
                break;
            case "giai_tam": 
                $vitri = array(80,81);
                break; 
        }
        return $vitri; 
    }

    public static function getVitriGiaiMientrung($giai){
        switch($giai){
            case "giai_dacbiet": 
                $vitri = array(0,4);
                break;
            case "giai_nhat": 
                $vitri = array(5,9);
                break;
            case "giai_nhi": 
                $vitri = array(10,14);
                break;
            case "giai_ba_1": 
                $vitri = array(15,19);
                break;
            case "giai_ba_2": 
                $vitri = array(20,24);
                break;
            case "giai_tu_1": 
                $vitri = array(25,29);
                break;
            case "giai_tu_2": 
                $vitri = array(30,34);
                break;
            case "giai_tu_3": 
                $vitri = array(35,39);
                break;
            case "giai_tu_4": 
                $vitri = array(40,44);
                break;
            case "giai_tu_5": 
                $vitri = array(45,49);
                break;
            case "giai_tu_6": 
                $vitri = array(50,54);
                break;
            case "giai_tu_7": 
                $vitri = array(55,59);
                break;
            case "giai_nam": 
                $vitri = array(60,63);
                break;           
            case "giai_sau_1": 
                $vitri = array(64,67);
                break;
            case "giai_sau_2": 
                $vitri = array(68,71);
                break;
            case "giai_sau_3": 
                $vitri = array(72,75);
                break;
            case "giai_bay": 
                $vitri = array(76,79);
                break;
            case "giai_tam": 
                $vitri = array(80,81);
                break; 
        }
        return $vitri;
    }

    public static function printboso($giai,$boso,$x,$y,$region){
        if($region ==1){
            $vitri = StringUtils::getVitriGiaiMienbac($giai);        
        } else if($region==2){
                $vitri = StringUtils::getVitriGiaiMientrung($giai);
            } else if($region ==3){
                    $vitri = StringUtils::getVitriGiaiMiennam($giai);
                }

                //echo $vitri[0];die;
                $strboso = "";
        $vitri_do_x=-1;
        $vitri_do_y=-1;

        if($x>=$vitri[0]&&$x<=$vitri[1]){                      
            $vitri_do_x =$x - $vitri[0];  

        }  

        if($y>=$vitri[0]&&$y<=$vitri[1]){                      
            $vitri_do_y =$y - $vitri[0];     
        }

        for($i=0;$i<strlen($boso);$i++)
        {
            if($vitri_do_x==$i||$vitri_do_y==$i){
                $strboso .="<font color='red'>".substr($boso,$i,1)."</font>";  
            } else{
                $strboso .=substr($boso,$i,1);  
            } 
        }   

        return $strboso;              
    }

    public static function printLoto($ketqua,$mien){
        $arr_loto = array();
        if(isset($ketqua) || count($ketqua)>0){
            switch($mien){
                case 1:
                    //echo count($ketqua); die; 
                    for($i=0;$i<count($ketqua);$i++){
                        $arr_loto[$i][0] = isset($ketqua[$i]["giai_bay_1"]) ? substr($ketqua[$i]["giai_bay_1"],strlen($ketqua[$i]["giai_bay_1"])-2,2):""; 
                        $arr_loto[$i][1] = isset($ketqua[$i]["giai_bay_2"]) ? substr($ketqua[$i]["giai_bay_2"],strlen($ketqua[$i]["giai_bay_2"])-2,2):"";
                        $arr_loto[$i][2] = isset($ketqua[$i]["giai_bay_3"]) ? substr($ketqua[$i]["giai_bay_3"],strlen($ketqua[$i]["giai_bay_3"])-2,2):"";
                        $arr_loto[$i][3] = isset($ketqua[$i]["giai_bay_4"]) ? substr($ketqua[$i]["giai_bay_4"],strlen($ketqua[$i]["giai_bay_4"])-2,2):"";

                        $arr_loto[$i][4] = isset($ketqua[$i]["giai_sau_1"]) ? substr($ketqua[$i]["giai_sau_1"],strlen($ketqua[$i]["giai_sau_1"])-2,2):"";
                        $arr_loto[$i][5] = isset($ketqua[$i]["giai_sau_2"]) ? substr($ketqua[$i]["giai_sau_2"],strlen($ketqua[$i]["giai_sau_2"])-2,2):"";
                        $arr_loto[$i][6] = isset($ketqua[$i]["giai_sau_3"]) ? substr($ketqua[$i]["giai_sau_3"],strlen($ketqua[$i]["giai_sau_3"])-2,2):"";

                        $arr_loto[$i][7] = isset($ketqua[$i]["giai_nam_1"]) ? substr($ketqua[$i]["giai_nam_1"],strlen($ketqua[$i]["giai_nam_1"])-2,2):"";
                        $arr_loto[$i][8] = isset($ketqua[$i]["giai_nam_2"]) ? substr($ketqua[$i]["giai_nam_2"],strlen($ketqua[$i]["giai_nam_2"])-2,2):"";
                        $arr_loto[$i][9] = isset($ketqua[$i]["giai_nam_3"]) ? substr($ketqua[$i]["giai_nam_3"],strlen($ketqua[$i]["giai_nam_3"])-2,2):"";
                        $arr_loto[$i][10] = isset($ketqua[$i]["giai_nam_4"]) ? substr($ketqua[$i]["giai_nam_4"],strlen($ketqua[$i]["giai_nam_4"])-2,2):"";
                        $arr_loto[$i][11] = isset($ketqua[$i]["giai_nam_5"]) ? substr($ketqua[$i]["giai_nam_5"],strlen($ketqua[$i]["giai_nam_5"])-2,2):"";
                        $arr_loto[$i][12] = isset($ketqua[$i]["giai_nam_6"]) ? substr($ketqua[$i]["giai_nam_6"],strlen($ketqua[$i]["giai_nam_6"])-2,2):"";

                        $arr_loto[$i][13] = isset($ketqua[$i]["giai_tu_1"]) ? substr($ketqua[$i]["giai_tu_1"],strlen($ketqua[$i]["giai_tu_1"])-2,2):""; 
                        $arr_loto[$i][14] = isset($ketqua[$i]["giai_tu_2"]) ? substr($ketqua[$i]["giai_tu_2"],strlen($ketqua[$i]["giai_tu_2"])-2,2):"";
                        $arr_loto[$i][15] = isset($ketqua[$i]["giai_tu_3"]) ? substr($ketqua[$i]["giai_tu_3"],strlen($ketqua[$i]["giai_tu_3"])-2,2):"";
                        $arr_loto[$i][16] = isset($ketqua[$i]["giai_tu_4"]) ? substr($ketqua[$i]["giai_tu_4"],strlen($ketqua[$i]["giai_tu_4"])-2,2):"";

                        $arr_loto[$i][17] = isset($ketqua[$i]["giai_ba_1"]) ? substr($ketqua[$i]["giai_ba_1"],strlen($ketqua[$i]["giai_ba_1"])-2,2):"";
                        $arr_loto[$i][18] = isset($ketqua[$i]["giai_ba_2"]) ? substr($ketqua[$i]["giai_ba_2"],strlen($ketqua[$i]["giai_ba_2"])-2,2):"";
                        $arr_loto[$i][19] = isset($ketqua[$i]["giai_ba_3"]) ? substr($ketqua[$i]["giai_ba_3"],strlen($ketqua[$i]["giai_ba_3"])-2,2):"";
                        $arr_loto[$i][20] = isset($ketqua[$i]["giai_ba_4"]) ? substr($ketqua[$i]["giai_ba_4"],strlen($ketqua[$i]["giai_ba_4"])-2,2):"";
                        $arr_loto[$i][21] = isset($ketqua[$i]["giai_ba_5"]) ? substr($ketqua[$i]["giai_ba_5"],strlen($ketqua[$i]["giai_ba_5"])-2,2):"";
                        $arr_loto[$i][22] = isset($ketqua[$i]["giai_ba_6"]) ? substr($ketqua[$i]["giai_ba_6"],strlen($ketqua[$i]["giai_ba_6"])-2,2):"";

                        $arr_loto[$i][23] = isset($ketqua[$i]["giai_nhi_1"]) ? substr($ketqua[$i]["giai_nhi_1"],strlen($ketqua[$i]["giai_nhi_1"])-2,2):"";
                        $arr_loto[$i][24] = isset($ketqua[$i]["giai_nhi_2"]) ? substr($ketqua[$i]["giai_nhi_2"],strlen($ketqua[$i]["giai_nhi_2"])-2,2):"";

                        $arr_loto[$i][25] = isset($ketqua[$i]["giai_nhat"]) ? substr($ketqua[$i]["giai_nhat"],strlen($ketqua[$i]["giai_nhat"])-2,2):""; 
                        $arr_loto[$i][26] = isset($ketqua[$i]["giai_dacbiet"]) ? substr($ketqua[$i]["giai_dacbiet"],strlen($ketqua[$i]["giai_dacbiet"])-2,2):"";       
                    } break;
                case 2:
                    for($i=0;$i<count($ketqua);$i++){
                        $arr_loto[$i][0] = isset($ketqua[$i]["giai_tam"]) ? substr($ketqua[$i]["giai_tam"],strlen($ketqua[$i]["giai_tam"])-2,2):"";                
                        $arr_loto[$i][1] = isset($ketqua[$i]["giai_bay"]) ? substr($ketqua[$i]["giai_bay"],strlen($ketqua[$i]["giai_bay"])-2,2):""; 

                        $arr_loto[$i][2] = isset($ketqua[$i]["giai_sau_1"]) ? substr($ketqua[$i]["giai_sau_1"],strlen($ketqua[$i]["giai_sau_1"])-2,2):"";
                        $arr_loto[$i][3] = isset($ketqua[$i]["giai_sau_2"]) ? substr($ketqua[$i]["giai_sau_2"],strlen($ketqua[$i]["giai_sau_2"])-2,2):"";
                        $arr_loto[$i][4] = isset($ketqua[$i]["giai_sau_3"]) ? substr($ketqua[$i]["giai_sau_3"],strlen($ketqua[$i]["giai_sau_3"])-2,2):"";

                        $arr_loto[$i][5] = isset($ketqua[$i]["giai_nam"]) ? substr($ketqua[$i]["giai_nam"],strlen($ketqua[$i]["giai_nam"])-2,2):"";

                        $arr_loto[$i][6] = isset($ketqua[$i]["giai_tu_1"]) ? substr($ketqua[$i]["giai_tu_1"],strlen($ketqua[$i]["giai_tu_1"])-2,2):""; 
                        $arr_loto[$i][7] = isset($ketqua[$i]["giai_tu_2"]) ? substr($ketqua[$i]["giai_tu_2"],strlen($ketqua[$i]["giai_tu_2"])-2,2):"";
                        $arr_loto[$i][8] = isset($ketqua[$i]["giai_tu_3"]) ? substr($ketqua[$i]["giai_tu_3"],strlen($ketqua[$i]["giai_tu_3"])-2,2):"";
                        $arr_loto[$i][9] = isset($ketqua[$i]["giai_tu_4"]) ? substr($ketqua[$i]["giai_tu_4"],strlen($ketqua[$i]["giai_tu_4"])-2,2):"";
                        $arr_loto[$i][10] = isset($ketqua[$i]["giai_tu_5"]) ? substr($ketqua[$i]["giai_tu_5"],strlen($ketqua[$i]["giai_tu_5"])-2,2):"";
                        $arr_loto[$i][11] = isset($ketqua[$i]["giai_tu_6"]) ? substr($ketqua[$i]["giai_tu_6"],strlen($ketqua[$i]["giai_tu_6"])-2,2):"";
                        $arr_loto[$i][12] = isset($ketqua[$i]["giai_tu_7"]) ? substr($ketqua[$i]["giai_tu_7"],strlen($ketqua[$i]["giai_tu_7"])-2,2):"";

                        $arr_loto[$i][13] = isset($ketqua[$i]["giai_ba_1"]) ? substr($ketqua[$i]["giai_ba_1"],strlen($ketqua[$i]["giai_ba_1"])-2,2):"";
                        $arr_loto[$i][14] = isset($ketqua[$i]["giai_ba_2"]) ? substr($ketqua[$i]["giai_ba_2"],strlen($ketqua[$i]["giai_ba_2"])-2,2):"";

                        $arr_loto[$i][15] = isset($ketqua[$i]["giai_nhi"]) ? substr($ketqua[$i]["giai_nhi"],strlen($ketqua[$i]["giai_nhi"])-2,2):"";
                        $arr_loto[$i][16] = isset($ketqua[$i]["giai_nhat"]) ? substr($ketqua[$i]["giai_nhat"],strlen($ketqua[$i]["giai_nhat"])-2,2):"";
                        $arr_loto[$i][17] = isset($ketqua[$i]["giai_dacbiet"]) ? substr($ketqua[$i]["giai_dacbiet"],strlen($ketqua[$i]["giai_dacbiet"])-2,2):"";    
                    } break;
                case 3:
                    for($i=0;$i<count($ketqua);$i++){
                        $arr_loto[$i][0] = isset($ketqua[$i]["giai_tam"]) ? substr($ketqua[$i]["giai_tam"],strlen($ketqua[$i]["giai_tam"])-2,2):"";                
                        $arr_loto[$i][1] = isset($ketqua[$i]["giai_bay"]) ? substr($ketqua[$i]["giai_bay"],strlen($ketqua[$i]["giai_bay"])-2,2):""; 

                        $arr_loto[$i][2] = isset($ketqua[$i]["giai_sau_1"]) ? substr($ketqua[$i]["giai_sau_1"],strlen($ketqua[$i]["giai_sau_1"])-2,2):"";
                        $arr_loto[$i][3] = isset($ketqua[$i]["giai_sau_2"]) ? substr($ketqua[$i]["giai_sau_2"],strlen($ketqua[$i]["giai_sau_2"])-2,2):"";
                        $arr_loto[$i][4] = isset($ketqua[$i]["giai_sau_3"]) ? substr($ketqua[$i]["giai_sau_3"],strlen($ketqua[$i]["giai_sau_3"])-2,2):"";

                        $arr_loto[$i][5] = isset($ketqua[$i]["giai_nam"]) ? substr($ketqua[$i]["giai_nam"],strlen($ketqua[$i]["giai_nam"])-2,2):"";

                        $arr_loto[$i][6] = isset($ketqua[$i]["giai_tu_1"]) ? substr($ketqua[$i]["giai_tu_1"],strlen($ketqua[$i]["giai_tu_1"])-2,2):""; 
                        $arr_loto[$i][7] = isset($ketqua[$i]["giai_tu_2"]) ? substr($ketqua[$i]["giai_tu_2"],strlen($ketqua[$i]["giai_tu_2"])-2,2):"";
                        $arr_loto[$i][8] = isset($ketqua[$i]["giai_tu_3"]) ? substr($ketqua[$i]["giai_tu_3"],strlen($ketqua[$i]["giai_tu_3"])-2,2):"";
                        $arr_loto[$i][9] = isset($ketqua[$i]["giai_tu_4"]) ? substr($ketqua[$i]["giai_tu_4"],strlen($ketqua[$i]["giai_tu_4"])-2,2):"";
                        $arr_loto[$i][10] = isset($ketqua[$i]["giai_tu_5"]) ? substr($ketqua[$i]["giai_tu_5"],strlen($ketqua[$i]["giai_tu_5"])-2,2):"";
                        $arr_loto[$i][11] = isset($ketqua[$i]["giai_tu_6"]) ? substr($ketqua[$i]["giai_tu_6"],strlen($ketqua[$i]["giai_tu_6"])-2,2):"";
                        $arr_loto[$i][12] = isset($ketqua[$i]["giai_tu_7"]) ? substr($ketqua[$i]["giai_tu_7"],strlen($ketqua[$i]["giai_tu_7"])-2,2):"";

                        $arr_loto[$i][13] = isset($ketqua[$i]["giai_ba_1"]) ? substr($ketqua[$i]["giai_ba_1"],strlen($ketqua[$i]["giai_ba_1"])-2,2):"";
                        $arr_loto[$i][14] = isset($ketqua[$i]["giai_ba_2"]) ? substr($ketqua[$i]["giai_ba_2"],strlen($ketqua[$i]["giai_ba_2"])-2,2):"";

                        $arr_loto[$i][15] = isset($ketqua[$i]["giai_nhi"]) ? substr($ketqua[$i]["giai_nhi"],strlen($ketqua[$i]["giai_nhi"])-2,2):"";
                        $arr_loto[$i][16] = isset($ketqua[$i]["giai_nhat"]) ? substr($ketqua[$i]["giai_nhat"],strlen($ketqua[$i]["giai_nhat"])-2,2):"";
                        $arr_loto[$i][17] = isset($ketqua[$i]["giai_dacbiet"]) ? substr($ketqua[$i]["giai_dacbiet"],strlen($ketqua[$i]["giai_dacbiet"])-2,2):"";    
                    } break; 
            }
        }
        //echo count($arr_loto); die;
        return $arr_loto;      
    }

    public static function getTypeLoDoGame($type){
        $str="";
        Switch($type){
            case 1: $str = "Lo Game";
                break;
            case 2: $str = "Do Game";
                break;
            case 3: $str = "Xien Game";
                break;
        }
        return $str;
    }

    public static function getTypeAwards($type){
        $str="";
        Switch($type){
            case 1: $str = "Giải thưởng theo tuần";
                break;
            case 2: $str = "Giải thưởng theo tháng";
                break;
            case 3: $str = "Giải thưởng theo quý";
                break;
        }
        return $str;
    }

    public static function getIntroText($str,$len){
        $position = 0;
        $new_str = "";
        $total_len = strlen($str);
        $end = $total_len - $position;
        $i=0;  
        $test = array();
        if($total_len > $len){ 
            while($end > 0){
                $arr = StringUtils::getSubString($str,$position,$len);          
                $position = $arr['position'];           
                $new_str = $new_str.$arr['str'];
                $end = $total_len - $position;
                $i++;
            } 

        }else{
            $new_str = $str; 
        }
        return $new_str; 
    }

    public static function getSubString($str,$position,$len){ 
        $arr = array();

        $sub_str = substr($str,$position,$len);
        /*Kiểm tra chuỗi con có khoảng trắng không */
        $check = strpos($sub_str," ",1);        
        if($check > 0){            
            $sub_str = substr($str,$position,$check);
            $arr['str'] = $sub_str."<br/>";
            $arr['position'] = $position+$check+1;           
        }else{
            $arr['str'] = $sub_str."<br/>";
            $arr['position'] = $position + $len;    
        }
        return $arr;

    }

    public static function formatNumber($value){
        if($value < 1000)
        {
            $str = $value;
        }
        else
        {
            $str = number_format($value,0,"",".");
        }
        return $str;
    }

    public function remove_duplicate($list_id)
    {
        $list_id = explode(",", $list_id);
        $new_id = array();
        foreach($list_id as $value){
            if(!in_array($value, $new_id)){
                $new_id[] = intval($value);
            }
        }            
        $list_new_id = "";
        foreach($new_id as $value){
            $list_new_id .= $value.",";   
        }
        $list_new_id = rtrim($list_new_id, ",");
        return $list_new_id;
    }

    static function cleanQuery($string)
    {            
        $string = mysql_escape_string(trim($string));

        $badWords = array(
        "/Select(.*)From/i"
        , "/Union(.*)Select/i"
        , "/Update(.*)Set/i"
        , "/Delete(.*)From/i"
        , "/Drop(.*)Table/i"
        , "/Insert(.*)Into/i"                
        , "/http/i"
        , "/--/i"
        );

        $string = preg_replace($badWords, "", $string);

        return $string;
    }
    public function getCurrentUrl(){
        $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } 
        else 
        {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}

    