<?php
    class Common{

        static public function getRandomResultMB(){
            $result = array();
            for($i=1;$i<=4;$i++){
                $result[$i] = rand(0,9).rand(0,9);
            }
            for($i=5;$i<=7;$i++){
                $result[$i] = rand(0,9).rand(10,99);
            }
            for($i=8;$i<=17;$i++){
                $result[$i] = rand(0,9).rand(100,999);
            }
            for($i=18;$i<=27;$i++){
                $result[$i] = rand(0,9).rand(1000,9999);
            }
            return $result;
        }

        static public function getRandomResultMN(){
            $result = array();
            $result[1] = rand(0,9).rand(0,9);
            $result[2] = rand(0,9).rand(10,99);
            for($i=3;$i<=6;$i++){
                $result[$i] = rand(0,9).rand(100,999);
            }
            for($i=7;$i<=17;$i++){
                $result[$i] = rand(0,9).rand(1000,9999);
            }
            $result[18] = rand(0,9).rand(10000,99999);
            return $result;
        }

        static public function getRandomResultMT(){
            $result = array();
            $result[1] = rand(0,9).rand(0,9);
            $result[2] = rand(0,9).rand(10,99);
            for($i=3;$i<=6;$i++){
                $result[$i] = rand(0,9).rand(100,999);
            }
            for($i=7;$i<=17;$i++){
                $result[$i] = rand(0,9).rand(1000,9999);
            }
            $result[18] = rand(0,9).rand(10000,99999);
            return $result;
        }

        static public function getDataDateByProvince($region,$province_id,$ngay_quay){
            $date_result = array();
            $time = strtotime($ngay_quay);
            $date_quay = getdate($time);
            $day_quay = Common::getWeekDay($date_quay["wday"]);
            if($region=="mn"){
                if($province_id==14){
                    if($day_quay["id"]==7){
                        $date_result[1] = date('d-m-Y',$time+2*86400);
                        $date_result[-1] = date('d-m-Y',$time-5*86400);   
                    }else{
                        $date_result[1] = date('d-m-Y',$time+5*86400);
                        $date_result[-1] = date('d-m-Y',$time-2*86400);
                    }
                }else{
                    $date_result[1] = date('d-m-Y',$time+7*86400);
                    $date_result[-1] = date('d-m-Y',$time-7*86400);
                }
            }elseif($region=="mt"){
                if($province_id==24){
                    if($day_quay["id"]==7){
                        $date_result[1]  = date('d-m-Y',$time+4*86400);
                        $date_result[-1] = date('d-m-Y',$time-3*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+3*86400);
                        $date_result[-1] = date('d-m-Y',$time-4*86400);
                    }
                }elseif($province_id==28){
                    if($day_quay["id"]==8){
                        $date_result[1]  = date('d-m-Y',$time+3*86400);
                        $date_result[-1] = date('d-m-Y',$time-4*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+4*86400);
                        $date_result[-1] = date('d-m-Y',$time-3*86400);
                    }
                }else{

                    $date_result[1] = date('d-m-Y',$time+7*86400);
                    $date_result[-1] = date('d-m-Y',$time-7*86400);
                }
            }else{        
                if($province_id==37){
                    if($day_quay["id"]==5){
                        $date_result[1]  = date('d-m-Y',$time+4*86400);
                        $date_result[-1] = date('d-m-Y',$time-3*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+3*86400);
                        $date_result[-1] = date('d-m-Y',$time-4*86400);
                    }
                }else{
                    $date_result[1] = date('d-m-Y',$time+7*86400);
                    $date_result[-1] = date('d-m-Y',$time-7*86400);
                }
            }
            return $date_result;
        }

        static public function getDataProvinceLive($region,$province,$time){
            $date_result = array();
            $date_quay = getdate($time);
            $day_quay = Common::getWeekDay($date_quay["wday"]);
            $time_live = LoadConfig::$region[$region]["hour_live"].':14:00';
            if($region=="mn"){
                if($province["id"]==14){
                    if($day_quay["id"]==7){
                        $date_result[1] = date('d-m-Y',$time+2*86400);
                        $date_result[-1] = date('d-m-Y',$time-5*86400);   
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-12*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+5*86400);
                        $date_result[-1] = date('d-m-Y',$time-2*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-9*86400);
                    }
                }else{
                    $date_result[1] = date('d-m-Y',$time+7*86400);
                    $date_result[-1] = date('d-m-Y',$time-7*86400);
                    $date_result[-2] = date('d-m-Y',$time-14*86400);
                    $date_result[-3] = date('d-m-Y',$time-21*86400);
                }
            }elseif($region=="mt"){  
                if($province["id"]==24){
                    if($day_quay["id"]==7){
                        $date_result[1]  = date('d-m-Y',$time+4*86400);
                        $date_result[-1] = date('d-m-Y',$time-3*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-10*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+3*86400);
                        $date_result[-1] = date('d-m-Y',$time-4*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-11*86400);
                    }
                }elseif($province["id"]==28){
                    if($day_quay["id"]==8){
                        $date_result[1]  = date('d-m-Y',$time+3*86400);
                        $date_result[-1] = date('d-m-Y',$time-4*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-11*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+4*86400);
                        $date_result[-1] = date('d-m-Y',$time-3*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-10*86400);
                    }
                }else{
                    $date_result[1] = date('d-m-Y',$time+7*86400);
                    $date_result[-1] = date('d-m-Y',$time-7*86400);
                    $date_result[-2] = date('d-m-Y',$time-14*86400);
                    $date_result[-3] = date('d-m-Y',$time-21*86400);
                }
            }else{        
                if($province["id"]==37){
                    if($day_quay["id"]==5){
                        $date_result[1]  = date('d-m-Y',$time+4*86400);
                        $date_result[-1] = date('d-m-Y',$time-3*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-10*86400);
                    }else{
                        $date_result[1] = date('d-m-Y',$time+3*86400);
                        $date_result[-1] = date('d-m-Y',$time-4*86400);
                        $date_result[-2] = date('d-m-Y',$time-7*86400);
                        $date_result[-3] = date('d-m-Y',$time-11*86400);
                    }
                }else{
                    $date_result[1] = date('d-m-Y',$time+7*86400);
                    $date_result[-1] = date('d-m-Y',$time-7*86400);
                    $date_result[-2] = date('d-m-Y',$time-14*86400);
                    $date_result[-3] = date('d-m-Y',$time-21*86400);
                }
            }
            return array($date_result,$time_live);
        }
        static function getRandomArray($rows,$number)
        {
            $results=array();
            $n=count($rows); 
            if($n==0) return $results;
            if($n==1) return $rows;  
            if($n>$number) $n=$number;

            $rand_keys=array_rand($rows,$n);
            if(count($rand_keys)>0 && is_array($rand_keys)){  
                foreach($rand_keys as $key=>$value){
                    $results[]= $rows[$value];
                } 
            } 
            else {
                $results[]=$rows[$rand_keys]; 
            }   
            return $results;    
        }
        static function multiSort($array,$field,$type=1)
        {
            $array_sort=array();
            if($array)
            {
                foreach($array as $key=>$row)
                {
                    $array_sort[$key]=$row[$field];
                }
                if($type==1)
                    array_multisort($array_sort,SORT_DESC,$array);
                else 
                    array_multisort($array_sort,SORT_ASC,$array); 
            }    
            return  $array;     
        }

        static function multiSortByDate($array,$type=1){
            foreach($array as $key=>$row)
            {
                $array_sort[$key]=$row[$field];
            }
        }
        static function getNumberDayByDate($date){
            return round((strtotime(date("Y-m-d")) - strtotime($date)) / (60 * 60 * 24)); 
        }

        static function getProvinceMB($time=""){
            if($time==""){
                $time = time();
            }
            $date = getdate($time);
            $d = Common::getWeekDay($date["wday"]); 
            return LoadConfig::$label_mb[$d["id"]];
        }

        static function getImgError(){
            return Yii::app()->params['static_url'].'/images/img-default.jpg';
        }

        static function getImage($nameImage, $folder, $date='', $type=''){      
            if($type!='')
                $nameImage=$type.'_'.$nameImage;
            if($date!='')
                return Yii::app()->params['urlImages'].$folder.'/'.date('Y', $date).'/'.date('md', $date).'/'.$nameImage;
            else
                return Yii::app()->params['urlImages'].$folder.'/'.$nameImage;
        }


        static function getStrMoThuong($province){
            $str = "";
            if($province["thu2"]==1){
                $str .= "thứ hai,";
            }elseif($province["thu3"]==1){
                $str .= "thứ ba,";
            }elseif($province["thu4"]==1){
                $str .= "thứ tư,";
            }elseif($province["thu5"]==1){
                $str .= "thứ năm,";
            }elseif($province["thu6"]==1){
                $str .= "thứ sáu,";
            }elseif($province["thu7"]==1){
                $str .= "thứ bảy,";
            }elseif($province["thu8"]==1){
                $str .= "chủ nhật,";
            }
            $str = rtrim($str,",");
            return $str;
        }
        static function getWeekDay($wday){
            switch($wday){
                case 0:
                    $value = array("id"=>8,"label"=>"Chủ nhật","alias"=>"chu-nhat");
                    break;
                case 1:
                    $value = array("id"=>2,"label"=>"Thứ hai","alias"=>"thu-hai");
                    break;
                case 2:
                    $value = array("id"=>3,"label"=>"Thứ ba","alias"=>"thu-ba");
                    break;
                case 3:
                    $value = array("id"=>4,"label"=>"Thứ tư","alias"=>"thu-tu");
                    break;
                case 4:
                    $value = array("id"=>5,"label"=>"Thứ năm","alias"=>"thu-nam");
                    break;
                case 5:
                    $value = array("id"=>6,"label"=>"Thứ sáu","alias"=>"thu-sau");
                    break;
                case 6:
                    $value = array("id"=>7,"label"=>"Thứ bảy","alias"=>"thu-bay");
                    break;
                default:
                    $value = array("id"=>0,"label"=>"");
                    break;
            }
            return $value;
        }
        static function getWeekDayBack($wday){
            switch($wday){
                case 8:
                    $value = array("id"=>0,"label"=>"Chủ nhật");
                    break;
                case 2:
                    $value = array("id"=>1,"label"=>"Thứ Hai");
                    break;
                case 3:
                    $value = array("id"=>2,"label"=>"Thứ Ba");
                    break;
                case 4:
                    $value = array("id"=>3,"label"=>"Thứ Tư");
                    break;
                case 5:
                    $value = array("id"=>4,"label"=>"Thứ Năm");
                    break;
                case 6:
                    $value = array("id"=>5,"label"=>"Thứ Sáu");
                    break;
                case 7:
                    $value = array("id"=>6,"label"=>"Thứ Bảy");
                    break;
                default:
                    $value = array("id"=>0,"label"=>"");
                    break;
            }
            return $value;
        }
        static function getDateFormat($time=0,$type=0){
            if($time==0) $time = time();
            $date = getdate($time);
            $arr = Common::getWeekDay($date["wday"]);
            if($type==0){
                $value = $arr["label"].', ngày '.date('d-m-Y',$time);
            }elseif($type==1){
                $value = '<strong class="s12">'.$arr["label"].' ,</strong> <strong class="clred s12">'.date('d-m-Y',$time).'</strong>';
            }elseif($type==2){
                $value = 'thứ '.$arr["label"]. ' ngày '.date('d',$time).' tháng '.date('m',$time).' năm '.date('Y',$time).'';
            }elseif($type==3){
                $value = $arr["label"].', ngày '.date('d-m-Y',$time);
            }elseif($type==4){
                $value = 'Mở thưởng <strong>'.$arr["label"].'</strong> ngày: <strong class="txt-day">'.date('d-m-Y',$time).'</strong>';
            }
            return $value;
        }

        static function getStringProvince($time,$provinces){
            if($time==0) $time = time();
            $date = getdate($time);
            $arr = Common::getWeekDay($date["wday"]);
            $data = array();
            foreach($provinces as $value){
                if($value["thu".$arr["id"]]==1){
                    $data[$value["region"]][] = $value["name"];
                }
            }
            return $data;
        }
        static function getLotoMB($rows){  
            $loto = array();
            for($i=0;$i<4;$i++){
                $loto[] = isset($rows["giai_bay_".($i+1)]) ? substr($rows["giai_bay_".($i+1)],-2,2):"";
            }        
            for($i=0;$i<3;$i++){
                $loto[] = isset($rows["giai_sau_".($i+1)]) ? substr($rows["giai_sau_".($i+1)],-2,2):"";
            }
            for($i=0;$i<6;$i++){
                $loto[] = isset($rows["giai_nam_".($i+1)]) ? substr($rows["giai_nam_".($i+1)],-2,2):"";
            }
            for($i=0;$i<4;$i++){
                $loto[] = isset($rows["giai_tu_".($i+1)]) ? substr($rows["giai_tu_".($i+1)],-2,2):"";
            }
            for($i=0;$i<6;$i++){
                $loto[] = isset($rows["giai_ba_".($i+1)]) ? substr($rows["giai_ba_".($i+1)],-2,2):"";
            }
            for($i=0;$i<2;$i++){
                $loto[] = isset($rows["giai_nhi_".($i+1)]) ? substr($rows["giai_nhi_".($i+1)],-2,2):"";
            }
            $loto[] = isset($rows["giai_nhat"]) ? substr($rows["giai_nhat"],-2,2):"";
            $loto[] = isset($rows["giai_dacbiet"]) ? substr($rows["giai_dacbiet"],-2,2):"";
            sort($loto);
            return $loto;
        }

        static function getDauduoiMB($rows){
            $loto = Common::getLotoMB($rows);
            $dauduoi = array();
            for($i=0;$i<=9;$i++){
                $boso = "";
                for($j=0;$j<count($loto);$j++){
                    if(substr($loto[$j],0,1)==$i){
                        $boso .= substr($loto[$j],1).',';
                    }
                }
                $dauduoi[$i] = trim($boso,",");
            }
            return $dauduoi;
        }

        static function getLotoMN($rows){
            $loto = array();
            $loto[] = isset($rows["giai_tam"]) ? substr($rows["giai_tam"],-2,2):""; 
            $loto[] = isset($rows["giai_bay"]) ? substr($rows["giai_bay"],-2,2):"";
            for($i=0;$i<3;$i++){
                $loto[] = isset($rows["giai_sau_".($i+1)]) ? substr($rows["giai_sau_".($i+1)],-2,2):"";
            }
            $loto[]    = isset($rows["giai_nam"])      ? substr($rows["giai_nam"],-2,2):"";
            for($i=0;$i<7;$i++){
                $loto[] = isset($rows["giai_tu_".($i+1)]) ? substr($rows["giai_tu_".($i+1)],-2,2):"";
            }
            for($i=0;$i<2;$i++){
                $loto[] = isset($rows["giai_ba_".($i+1)]) ? substr($rows["giai_ba_".($i+1)],-2,2):"";
            }
            $loto[] = isset($rows["giai_nhi"]) ? substr($rows["giai_nhi"],-2,2):"";
            $loto[] = isset($rows["giai_nhat"]) ? substr($rows["giai_nhat"],-2,2):"";
            $loto[] = isset($rows["giai_dacbiet"]) ? substr($rows["giai_dacbiet"],-2,2):"";
            sort($loto);
            return $loto; 
        }
        static function getDauduoiMN($rows){
            $loto = Common::getLotoMN($rows);
            $dauduoi = array();
            for($i=0;$i<=9;$i++){
                $boso = "";
                for($j=0;$j<count($loto);$j++){
                    if(substr($loto[$j],0,1)==$i){
                        $boso .= substr($loto[$j],1).',';
                    }
                }
                $dauduoi[$i] = trim($boso,",");
            }
            return $dauduoi;
        }

        static function getLotoMT($rows){
            $loto = array();
            $loto[] = isset($rows["giai_tam"]) ? substr($rows["giai_tam"],-2,2):""; 
            $loto[] = isset($rows["giai_bay"]) ? substr($rows["giai_bay"],-2,2):"";
            for($i=0;$i<3;$i++){
                $loto[] = isset($rows["giai_sau_".($i+1)]) ? substr($rows["giai_sau_".($i+1)],-2,2):"";
            }
            $loto[]    = isset($rows["giai_nam"])      ? substr($rows["giai_nam"],-2,2):"";
            for($i=0;$i<7;$i++){
                $loto[] = isset($rows["giai_tu_".($i+1)]) ? substr($rows["giai_tu_".($i+1)],-2,2):"";
            }
            for($i=0;$i<2;$i++){
                $loto[] = isset($rows["giai_ba_".($i+1)]) ? substr($rows["giai_ba_".($i+1)],-2,2):"";
            }
            $loto[] = isset($rows["giai_nhi"]) ? substr($rows["giai_nhi"],-2,2):"";
            $loto[] = isset($rows["giai_nhat"]) ? substr($rows["giai_nhat"],-2,2):"";
            $loto[] = isset($rows["giai_dacbiet"]) ? substr($rows["giai_dacbiet"],-2,2):"";
            sort($loto);
            return $loto;; 
        }
        static function getDauduoiMT($rows){
            $loto = Common::getLotoMT($rows);
            $dauduoi = array();
            for($i=0;$i<=9;$i++){
                $boso = "";
                for($j=0;$j<count($loto);$j++){
                    if(substr($loto[$j],0,1)==$i){
                        $boso .= substr($loto[$j],1).',';
                    }
                }
                $dauduoi[$i] = trim($boso,",");
            }
            return $dauduoi;
        }

        static function getRssMB($rows){
            $rss = "";
            $rss .= "DB: ".$rows["giai_dacbiet"]." ";
            $rss .= "1: ".$rows["giai_nhat"]." ";
            $rss .= "2: ".$rows["giai_nhi_1"]." - ".$rows["giai_nhi_2"]." ";
            $rss .= "3: ".$rows["giai_ba_1"]." - ".$rows["giai_ba_2"]." - ".$rows["giai_ba_3"]." - ".$rows["giai_ba_4"]." - ".$rows["giai_ba_5"]." - ".$rows["giai_ba_6"]." ";
            $rss .= "4: ".$rows["giai_tu_1"]." - ".$rows["giai_tu_2"]." - ".$rows["giai_tu_3"]." - ".$rows["giai_tu_4"]." ";
            //$rss .= "5: ".$rows["giai_nam_1"]." - ".$rows["giai_nam_2"]." - ".$rows["giai_nam_3"]." - ".$rows["giai_nam_4"]." - ".$rows["giai_nam_5"]." - ".$rows["giai_nam_6"]." ";
            //$rss .= "6: ".$rows["giai_sau_1"]." - ".$rows["giai_sau_2"]." - ".$rows["giai_sau_3"]." ";
            //$rss .= "7: ".$rows["giai_bay_1"]." - ".$rows["giai_bay_2"]." - ".$rows["giai_bay_3"]."  - ".$rows["giai_bay_4"]." ";

            return $rss;
        }

        static function getRssMN($rows){
            $rss = "";
            $rss .= "DB: ".$rows["giai_dacbiet"]." ";
            $rss .= "1: ".$rows["giai_nhat"]." ";
            $rss .= "2: ".$rows["giai_nhi"]." ";
            $rss .= "3: ".$rows["giai_ba_1"]." - ".$rows["giai_ba_2"]." ";
            $rss .= "4: ".$rows["giai_tu_1"]." - ".$rows["giai_tu_2"]." - ".$rows["giai_tu_3"]." - ".$rows["giai_tu_4"]." - ".$rows["giai_tu_5"]." - ".$rows["giai_tu_6"]." - ".$rows["giai_tu_7"]." ";
            //$rss .= "5: ".$rows["giai_nam"]." ";
            //$rss .= "6: ".$rows["giai_sau_1"]." - ".$rows["giai_sau_2"]." - ".$rows["giai_sau_3"]." ";
            //$rss .= "7: ".$rows["giai_bay"]." ";
            //$rss .= "8: ".$rows["giai_tam"]." ";

            return $rss;
        }
        static function getRssMT($rows){
            $rss = "";
            $rss .= "DB: ".$rows["giai_dacbiet"]." ";
            $rss .= "1: ".$rows["giai_nhat"]." ";
            $rss .= "2: ".$rows["giai_nhi"]." ";
            $rss .= "3: ".$rows["giai_ba_1"]." - ".$rows["giai_ba_2"]." ";
            $rss .= "4: ".$rows["giai_tu_1"]." - ".$rows["giai_tu_2"]." - ".$rows["giai_tu_3"]." - ".$rows["giai_tu_4"]." - ".$rows["giai_tu_5"]." - ".$rows["giai_tu_6"]." - ".$rows["giai_tu_7"]." ";
            //$rss .= "5: ".$rows["giai_nam"]." ";
            //$rss .= "6: ".$rows["giai_sau_1"]." - ".$rows["giai_sau_2"]." - ".$rows["giai_sau_3"]." ";
            //$rss .= "7: ".$rows["giai_bay"]." ";
            //$rss .= "8: ".$rows["giai_tam"]." ";

            return $rss;
        }

        static function cleanQuery($string)
        {        
            if(empty($string)) return $string;
            $string = mysql_escape_string(trim($string));

            $badWords = array(
                "/Select(.*)From/i"
                , "/Union(.*)Select/i"
                , "/Update(.*)Set/i"
                , "/Delete(.*)From/i"
                , "/Drop(.*)Table/i"
                , "/Insert(.*)Into/i"                
                , "/http/i"
                //, "/--/i"
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

        static function formatNumber($value){
            $str = number_format($value,0,"",".");
            return $str;
        } 
        public static function calculateDaysFromDate($date){
            $days = round((strtotime(date("Y-m-d")) - strtotime($date)) / (60 * 60 * 24));
            return $days;        
        }
        static function getRealIpAddr(){
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

        /* Hàm lấy introtext trong nội dung */
        static function getIntroText($str,$len,$more){
            if ($str=="" || $str==NULL) 
                return $str;
            if (is_array($str)) 
                return $str;
            $str = trim($str);
            if (strlen($str) <= $len) 
                return $str;
            $str = substr($str,0,$len);
            if ($str != "") 
            {
                if (!substr_count($str," ")) 
                {
                    if ($more) 
                        $str .= " ...";
                    return $str;
                }
                while(strlen($str) && ($str[strlen($str)-1] != " ")) 
                {
                    $str = substr($str,0,-1);
                }
                $str = substr($str,0,-1);
                if ($more) 
                    $str .= " ...";
            }
            return $str;
        }  

        static function getTextPerPage($content,$page,$row_per_page){
            $parttern = '/<p(.*)>/';
            preg_match_all($parttern,$content,$matches);
            if(!empty($matches[0])){
                $data = array();
                $total_block = count($matches[0]);
                $max_page = ceil($total_block/$row_per_page);

                for($i=($page-1)*$row_per_page;$i<$page*$row_per_page;$i++){
                    if(!empty($matches[0][$i])){
                        $data[] = $matches[0][$i];
                    }

                }
                if($data) $content = implode(" ",$data);

            }else{
                $total_block = 0;$max_page = 1;
            }
            return array($content,$max_page,$total_block);
        }

        function generate_slug($string) {
            $string = Common::change($string);
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U", "", $string);
            $string = strtolower(preg_replace('/[\s\-]+/', '-', trim(preg_replace('/[^\w\s\-]/', '', $string))));
            $slug = preg_replace("/[^A-Za-z0-9\-]/", "", $string);
            return $slug;
        }

        function generate_slug_search($string) {
            $string = Common::change($string);
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U", "", $string);
            $string = strtolower(preg_replace('/[\s\-]+/', '_', trim(preg_replace('/[^\w\s\-]/', '', $string))));
            $slug = preg_replace("/[^A-Za-z0-9\_]/", "", $string);
            return $slug;
        }

        function generate_slug_filename($string) {
            $string = Common::change($string);
            $string = preg_replace("/(^|&\S+;)|(<[^>]*>)/U", "", $string);
            $string = strtolower(preg_replace('/[\s\-]+/', '_', trim(preg_replace('/[^\w\s\-]/', '', $string))));
            $slug = preg_replace("/[^A-Za-z0-9\_]/", "", $string);
            return $slug;
        }

        function change($text) {
            $chars = array("a", "A", "e", "E", "o", "O", "u", "U", "i", "I", "d", "D", "y", "Y");
            $uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẵ", "ẳ", "� �");
            $uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẵ", "Ẳ", "� �");
            $uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
            $uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
            $uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ỡ", "ở", "� �");
            $uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ỡ", "Ở", "� �");
            $uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
            $uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
            $uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
            $uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
            $uni[10] = array("đ");
            $uni[11] = array("Đ");
            $uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
            $uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");

            for ($i = 0; $i <= 13; $i++) {
                $text = str_replace($uni[$i], $chars[$i], $text);
            }
            return $text;
        }

        static function validateEmail($email) {
            $atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]'; // allowed characters for part before "at" character
            $domain = '([-a-z0-9]*[a-z0-9]+)'; // allowed characters for part after "at" character
            $regex = '^'.$atom.'+'. // One or more atom characters.
            '(\.'.$atom.'+)*'. // Followed by zero or more dot separated sets of one or more atom characters.
            '@'. // Followed by an "at" character.
            '('.$domain.'{1,63}\.)+'. // Followed by one or max 63 domain characters (dot separated).
            $domain.'{2,63}'. // Must be followed by one set consisting a period of two
            '$'; // or max 63 domain characters.
            if(@eregi($regex,$email)) return true;
            else  return false;
        }

        static function validateMobile($mobile){
            $first = substr($mobile, 0, 1);
            if(!in_array($first,array(0,8))){
                return false;
            }else{
                return true;
            }
        }

        public static function getVitriBoso($giai,$boso,$x,$y,$region){
            if($region ==1){
                $vitri = LoadConfig::$positionResultMB[$giai];        
            } else if($region==2){
                $vitri = LoadConfig::$positionResultMT[$giai];
            } else if($region ==3){
                $vitri = LoadConfig::$positionResultMN[$giai];
            }
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

        public static function countDayFromDate($date){  
            $days = round((strtotime(date("d-m-Y")) - strtotime($date)) / (60 * 60 * 24));
            return $days;        
        }

        public static function getDateByWeek($w){
            $new_date = strtotime ('-'.$w.' week') ;
            $new_date = date ('Y-m-d' ,$new_date);        
            return $new_date;
        }

        static function getSumArrayGroup($array){
            $arr1 = array();
            $arr2= array();
            foreach($array as $value){
                $arr1[] = $value;
            }
            for($i=0;$i<count($arr1);$i++){
                $arr2[] = $arr1[$i] + $arr1[$i+1];
                $i = $i+1;
            }
            return $arr2;
        }

        static function getConsoMayman($search){
            $ip = Common::getRealIpAddr();

        }

        static function getFormatPhone($mobile_old,$type=1){
            $first = substr($mobile_old, 0, 1);
            if($first=="0"){
                $mobile = substr($mobile_old, 1, strlen($mobile_old) - 1);
            } else if($first="8"){
                $mobile = substr($mobile_old, 2, strlen($mobile_old) - 2);
            }
            if($type==1){
                $mobile = "84" . $mobile; 
            }else{
                $mobile = "0" . $mobile; 
            }

            return $mobile;
        }

        static function validateBoso($boso){
            $pattern = '/^[0-9]{2,2}$/';
            preg_match($pattern, $boso,$match);
            return $match;
        }

        static function sanitize_output($buffer)
        {
            mb_internal_encoding('utf-8');
            $buffer = preg_replace('!\s+!smi',' ',$buffer);
            return $buffer;
        }

        public function checkTelco($mobile)
        {        
            $first = substr($mobile, 0, 1);
            if($first=="0"){
                $mobile = substr($mobile, 1, strlen($mobile) - 1);
            } else if($first="8"){
                $mobile = substr($mobile, 2, strlen($mobile) - 2);
            }

            $mobile = "84" . $mobile;

            $patternViettel = "/^84(9[678]|16[2-9])[\d]{7}/";
            $patternMobi = "/^84(9[03]|12[01268])[\d]{7}/";
            $patternVina = "/^84(9[14]|12[34579])[\d]{7}/";
            $patternVnmobile = "/^84(9[2]|18[86])[\d]{7}/";
            $patternBeeline = "/^84(9[9]|19[9])[\d]{7}/";

            if(preg_match($patternViettel, $mobile)){
                $telco = "1";    
            } else if(preg_match($patternMobi, $mobile)){
                $telco = "2";
            } else if(preg_match($patternVina, $mobile)){
                $telco = "3";
            } else if(preg_match($patternVnmobile, $mobile)){
                $telco = "4";
            } else if(preg_match($patternBeeline, $mobile)){
                $telco = "5";
            } else {
                $telco = "0";
            }

            return $telco;    
        }

        public function getWeekOfMonth($timestamp)
        {
            $weekNum = date("W", $timestamp) - date("W",strtotime(date("Y-m-01", $timestamp)))+1;
            return $weekNum;
        }

        public function cUrl($url)
        {
            $curl_connection = curl_init($url);

            curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
            curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

            $result = curl_exec($curl_connection);

            curl_close($curl_connection);
            return $result;
        }

        function send_push_notification($registatoin_ids, $message) {

            // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';

            $fields = array(
                'registration_ids' => $registatoin_ids,
                'data' => $message,
            );
            /*echo '<pre>';
            var_dump($fields);die;*/
            $headers = array(
                'Authorization: key=AIzaSyC7UTU9eD8t8mnJ-XC-qariehVRtfr7kI8',
                'Content-Type: application/json'
            );
            //print_r($headers);
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            /*if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
            }*/

            // Close connection
            curl_close($ch);
            return $result;
        }

        function send_push_notification_ios($deviceToken,$message){        
            $result_msg = "";
            // Put your device token here (without spaces):
            //$deviceToken = 'c5194eb14ce52d505a4351cdbb2984ce64f5ea767b5ff85258040823f66f7564';

            // Put your private key's passphrase here:
            $passphrase = '123456';

            // Put your alert message here:
            //$message = 'My first push notification!';

            ////////////////////////////////////////////////////////////////////////////////

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', getcwd().'/ck.pem');
            stream_context_set_option($ctx, 'ssl', 'cafile', getcwd().'/entrust_2048_ca.cer');
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            // Open a connection to the APNS server         
            $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);

            $result_msg = 'Connected to APNS' . PHP_EOL;

            // Create the payload body
            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default'
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
            fclose($fp);
            if (!$result)
                $result_msg .= 'Message not delivered' . PHP_EOL;
            else
                $result_msg .= 'Message successfully delivered' . PHP_EOL;

            // Close the connection to the server
            return $result_msg;
        }

        public function bbcode_format($str){
            // Convert all special HTML characters into entities to display literally
            $str = strip_tags($str, "<strong><em><span><blockquote><p><pre><a><img>");
            // The array of regex patterns to look for
            $format_search =  array(
                '#\[table\](.*?)\[/table\]#is',
                '#\[tr\](.*?)\[/tr\]#is',
                '#\[td\](.*?)\[/td\]#is',
                '#\[p\](.*?)\[/p\]#is', // p ([p]text[/p]
                '#\[b\](.*?)\[/b\]#is', // Bold ([b]text[/b]
                '#\[i\](.*?)\[/i\]#is', // Italics ([i]text[/i]
                '#\[u\](.*?)\[/u\]#is', // Underline ([u]text[/u])
                '#\[s\](.*?)\[/s\]#is', // Strikethrough ([s]text[/s])
                '#\[quote\](.*?)\[/quote\]#is', // Quote ([quote]text[/quote])
                '#\[code\](.*?)\[/code\]#is', // Monospaced code [code]text[/code])
                '#\[size=([1-9]|1[0-9]|20)\](.*?)\[/size\]#is', // Font size 1-20px [size=20]text[/size])
                '#\[color=\#?([A-F0-9]{3}|[A-F0-9]{6})\](.*?)\[/color\]#is', // Font color ([color=#00F]text[/color])
                '#\[url=((?:ftp|https?)://.*?)\](.*?)\[/url\]#i', // Hyperlink with descriptive text ([url=http://url]text[/url])
                '#\[url\]((?:ftp|https?)://.*?)\[/url\]#i', // Hyperlink ([url]http://url[/url])
                '#\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]#i', // Image ([img]http://url_to_image[/img])
                '#\[img width=(.*?) height=(.*?)\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]#i' // Image ([img]http://url_to_image[/img])
            );
            // The matching array of strings to replace matches with
            $format_replace = array(
                '<table>$1</table>',
                '<tr>$1</tr>',
                '<td>$1</td>',
                '<p>$1</p>',
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<span style="text-decoration: underline;">$1</span>',
                '<span style="text-decoration: line-through;">$1</span>',
                '<blockquote class="clearfix"><p>$1</p><span class="absolute"></span></blockquote>',
                '<pre>$1</'.'pre>',
                '<span style="font-size: $1px;">$2</span>',
                '<span style="color: #$1;">$2</span>',
                '<a href="$1">$2</a>',
                '<a href="$1">$1</a>',
                '<img src="$1" alt="" />',
                '<img width="$1" height="$2" src="$3" alt="" />'
            );
            // Perform the actual conversion
            $str = preg_replace($format_search, $format_replace, $str);

            $symbol = LoadConfig::$symbol;  

            $icon = Common::genIcon();
            $str = str_replace($symbol, $icon, $str);

            // Convert line breaks in the <br /> tag
            $str = nl2br($str);
            return $str;
        }

        public static function genIcon(){
            
            $icon = array(
                0=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/20.gif">'
                , 1=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/2.gif">'                 
                , 2=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/21.gif">'                 
                , 3=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/23.gif">'                 
                , 4=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/100.gif">'                 
                , 5=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/48.gif">'                 
                , 6=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/19.gif">'                 
                , 7=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/1.gif">'                 
                , 8=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/6.gif">'                 
                , 9=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/4.gif">'                 
                , 10=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/5.gif">'                 
                , 11=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/3.gif">'                 
                , 12=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/18.gif">'                 
                , 13=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/17.gif">'                 
                , 14=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/47.gif">'                 
                , 15=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/10.gif">'                 
                , 16=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/7.gif">'                 
                , 17=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/8.gif">'                 
                , 18=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/9.gif">'                 
                , 19=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/12.gif">'                 
                , 20=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/42.gif">'                 
                , 21=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/36.gif">'                 
                , 22=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/113.gif">'                 
                , 23=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/114.gif">'
                , 24=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/11.gif">'                 
                , 25=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/13.gif">'                 
                , 26=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/16.gif">'                 
                , 27=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/15.gif">'                 
                , 28=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/102.gif">'
                , 29=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/14.gif">'                 
                , 30=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/22.gif">'                 
                , 31=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/24.gif">'                 
                , 32=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/25.gif">'                 
                , 33=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/26.gif">'                 
                , 34=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/27.gif">'                 
                , 35=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/101.gif">'                 
                , 36=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/103.gif">'                 
                , 37=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/104.gif">'                 
                , 38=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/105.gif">'                 
                , 39=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/28.gif">'                 
                , 40=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/29.gif">'                 
                , 41=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/30.gif">'                 
                , 42=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/31.gif">'                 
                , 43=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/32.gif">'                 
                , 44=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/33.gif">'                 
                , 45=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/34.gif">'                 
                , 46=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/35.gif">'                 
                , 47=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/37.gif">'                 
                , 48=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/38.gif">'                 
                , 49=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/39.gif">'                 
                , 50=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/40.gif">'                 
                , 51=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/41.gif">'                 
                , 52=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/43.gif">'                 
                , 53=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/44.gif">'                 
                , 54=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/45.gif">'                 
                , 55=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/46.gif">'                 
                , 56=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/109.gif">'                 
                , 57=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/110.gif">'                 
                , 58=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/111.gif">'                 
                , 59=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/112.gif">'                 
                , 60=>'<img border="0" src="' . Yii::app()->params["static_url"] . '/images/emotions/pirate_2.gif">'                                                  
            );
            return $icon;
        }
        
        function getCountDayGan($date,$province_id){  
            $num_days = 0;            
            $i = 0;
            $time = strtotime($date);
            while($time < time()){
                $date_quay = getdate($time);
                $day_quay = Common::getWeekDay($date_quay["wday"]);
                if($province_id==14){
                    if($day_quay["id"]==7 || $day_quay["id"]==2){
                        $num_days++;
                    }
                }elseif($province_id==24){
                    if($day_quay["id"]==7 || $day_quay["id"]==4){
                        $num_days++;
                    }
                    
                }elseif($province_id==28){
                    if($day_quay["id"]==8 || $day_quay["id"]==4){
                        $num_days++;
                    }
                }elseif($province_id==1){
                    $num_days++;
                }else{
                    $num_days = $num_days + 1/7;
                }
                $time = intval($time) + 86400;
            }
            $num_days = round($num_days);
            if($num_days <1) $num_days = 1;   
            return $num_days;
        }
    }

