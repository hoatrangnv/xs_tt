<?php
    class KetquaMientrung extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'ketqua_mientrung';
        }

        public function getDataByProvinceIds($province_ids,$date=""){
            $str_key = implode("_",$province_ids);
            $provinces = implode(",",$province_ids);
            $cacheService = new CacheService("KetquaMientrung","getDataByProvinceIds",$provinces,$date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $ngay_quay = $date;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($date==""){
                    if(in_array(24,$province_ids) && in_array(28,$province_ids)){
                        $sql = "SELECT * FROM ketqua_mientrung WHERE province_id IN (".$provinces.") 
                        AND ngay_quay =(SELECT ngay_quay FROM ketqua_mientrung WHERE province_id IN (28,24) GROUP BY ngay_quay HAVING COUNT(id)>=2 ORDER BY ngay_quay DESC LIMIT 1)";
                    }elseif(in_array(24,$province_ids)){
                        $sql = "SELECT * FROM ketqua_mientrung WHERE province_id IN (".$provinces.") 
                        AND ngay_quay =(SELECT MAX(ngay_quay) FROM ketqua_mientrung WHERE province_id IN (".$provinces.") AND province_id !=24)";
                    }elseif(in_array(28,$province_ids)){
                        $sql = "SELECT * FROM ketqua_mientrung WHERE province_id IN (".$provinces.") 
                        AND ngay_quay =(SELECT MAX(ngay_quay) FROM ketqua_mientrung WHERE province_id IN (".$provinces.") AND province_id !=28)";
                    }else{
                        $sql = "SELECT * FROM ketqua_mientrung WHERE province_id IN (".$provinces.") ORDER BY ngay_quay DESC LIMIT ".count($province_ids); 
                    } 
                }else{
                    $sql = "SELECT * FROM ketqua_mientrung WHERE province_id IN (".$provinces.") AND ngay_quay = '".trim($date)."' LIMIT ".count($province_ids);
                } 
                           
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $ngay_quay = $value["ngay_quay"];
                    $data[$value["province_id"]] = $value;
                }
                $a = array($data,$ngay_quay);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        function getDataDateByProvinceLimit($province_id,$limit){
            $cacheService = new CacheService("KetquaMientrung","getDataDateByProvinceLimit",$province_id,$limit);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = " AND province_id = ".intval($province_id);
                $sql = "SELECT ngay_quay FROM ketqua_mientrung WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT ".$limit;           
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($row as $value){
                    $data[] = date('d-m-Y',strtotime($value["ngay_quay"]));
                }
                if(!$data){
                    $data = 'cache_temp';
                }
                Yii::app ()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            if($data == 'cache_temp'){
                $data = array();   
            }
            return $data;
        }

        public function getDataByDate($date){
            $cacheService = new CacheService("KetquaMientrung","getDataByDate",$date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $ngay_quay = $date;
            
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $date = date('Y-m-d',strtotime($date));
                $sql = "SELECT * FROM ketqua_mientrung WHERE ngay_quay = '".trim($date)."'";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["province_id"]] = $value;
                }
                if(!$data){
                    $data = 'cache_temp';
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            if($data == 'cache_temp'){
                $data = array();   
            }
            return $data;
        }

        public function getDataInDatesByProvince($province_id,$from_date,$to_date){
            $cacheService = new CacheService("KetquaMientrung","getDataInDatesByProvince",$province_id,$from_date.'_'.$to_date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $sql = "SELECT * FROM ketqua_mientrung WHERE province_id = ".intval($province_id)." 
                AND ngay_quay >='".trim($from_date)."' AND ngay_quay <= '".trim($to_date)."' ORDER BY ngay_quay DESC";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                if(!$data){
                    $data = 'cache_temp';
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            if($data == 'cache_temp'){
                $data = array();   
            }
            return $data;
        }

        public function getDataByProvinceAndDate($province_id,$date=""){
            $cacheService = new CacheService("KetquaMientrung","getDataByProvinceAndDate",$province_id,$date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 

            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($date==""){
                    $sql = "SELECT * FROM ketqua_mientrung WHERE province_id = ".intval($province_id)." ORDER BY ngay_quay DESC";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT * FROM ketqua_mientrung WHERE province_id = ".intval($province_id)." 
                    AND ngay_quay = '".trim($date)."'";
                }
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryRow();
                if(!$data){
                    $data = 'cache_temp';
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            if($data == 'cache_temp'){
                $data = array();   
            }
            return $data;
        }
        
        public function getDataByProvinceAndDay($province_id,$day){
            $cacheService = new CacheService("KetquaMientrung","getDataByProvinceAndDay",$province_id.'_'.$day);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = " AND province_id = ".intval($province_id);
                $conditions .= " AND DAY(`ngay_quay`) = ".intval($day);
                $sql = "SELECT * FROM ketqua_mientrung WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";         
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryRow();
                if(!$data){
                    $data = 'cache_temp';
                }
                Yii::app ()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            if($data == 'cache_temp'){
                $data = array();   
            }
            return $data;
        }

        public function getDataByWeekday($wday,$provinces,$page,$row_per_page){
            $cacheService = new CacheService("KetquaMientrung","getDataByWeekday",$wday,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $wday_mysql = LoadConfig::$weekday_mysql[$wday];
                $conditions = " AND WEEKDAY(`ngay_quay`)=".$wday_mysql."";
                $connect = Yii::app()->db;
                $sql = "SELECT ngay_quay FROM ketqua_mientrung WHERE 1 ".$conditions." GROUP BY ngay_quay";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryAll();
                $total =  count($row_count);
                $max_page = ceil($total/$row_per_page);
                $first = ($page-1)*$row_per_page;       
                $sql = "SELECT ngay_quay FROM ketqua_mientrung WHERE 1 ".$conditions." GROUP BY ngay_quay ORDER BY ngay_quay DESC
                LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $row_dates = $command->queryAll();
                $dates = "";
                foreach($row_dates as $value){
                    $dates .= "'".$value["ngay_quay"]."',";
                }  
                $data = array();  
                if($dates !=""){
                    $sql = "SELECT * FROM ketqua_mientrung WHERE 1 AND ngay_quay IN (".rtrim($dates,",").") ORDER BY ngay_quay DESC";    
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                        $data[$value["ngay_quay"]][$value["province_id"]] = $value;
                    }
                } 
                $a = array($data,$max_page,$total);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }

        public function getDataList($page,$row_per_page){
            $cacheService = new CacheService("KetquaMientrung","getDataList",$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;

                $sql = "SELECT ngay_quay FROM ketqua_mientrung WHERE 1 GROUP BY ngay_quay ORDER BY ngay_quay DESC";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryAll();
                $total =  count($row_count);
                $first = ($page-1)*$row_per_page;
                $end = $page*$row_per_page;
                $dates = "";  
                for($i=$first;$i<$end;$i++){
                    $dates .= isset($row_count[$i]["ngay_quay"]) ? "'".$row_count[$i]["ngay_quay"]."'," : "";
                }
                $max_page = ceil($total/$row_per_page);
                $sql = "SELECT * FROM ketqua_mientrung WHERE ngay_quay IN (".trim($dates,",").") ORDER BY ngay_quay DESC";   

                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["ngay_quay"]][$value["province_id"]] = $value;
                }

                $a = array($data,$max_page,$total);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getDataListByProvince($province_id,$page,$row_per_page){
            $cacheService = new CacheService("KetquaMientrung","getDataListByProvince",$page,$row_per_page,$province_id);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = " AND province_id = ".intval($province_id);              
                $sql = "SELECT ngay_quay FROM ketqua_mientrung WHERE 1 ".$conditions." GROUP BY ngay_quay ORDER BY ngay_quay DESC";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryAll();
                $total =  count($row_count);
                $first = ($page-1)*$row_per_page;
                $dates = "";
                for($i=$first;$i<$row_per_page*($first+1);$i++){
                    $dates .= "'".$row_count[$i]["ngay_quay"]."',";
                }
                $max_page = ceil($total/$row_per_page);
                $sql = "SELECT * FROM ketqua_mientrung WHERE 1 ".$conditions." AND ngay_quay IN (".trim($dates,",").") ORDER BY ngay_quay DESC";   

                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["ngay_quay"]] = $value;
                }

                $a = array($data,$max_page,$total);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        public function getDataByProvinceInIds($province_id,$arr_ids){
            $str_key = implode("_",$arr_ids);
            $ids = implode(",",$arr_ids);
            $cacheService = new CacheService("KetquaMientrung","getDataByProvinceInIds",$province_id,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($ids != ""){
                    $connect = Yii::app()->db;
                    $sql = "SELECT * FROM ketqua_mientrung WHERE province_id = ".intval($province_id)." AND id IN (".$ids.") 
                    ORDER BY ngay_quay ASC";                            
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $key=>$value){
                        $data[$value["ngay_quay"]] = $value;
                    }
                    Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_900);
                }
            }else{
                $data = $cache;
            }
            return $data;
        }
    }
