<?php
    class KetquaMienbac extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'ketqua_mienbac';
        }
        
        public function getDataByDay($day){
            $cacheService = new CacheService("KetquaMienbac","getDataByDay",$day);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                $conditions .= " AND DAY(`ngay_quay`) = ".intval($day);
                $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";         
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

        public function getDataByDate($date="",$wdays=array()){
            $str_key = implode("_",$wdays);
            $cacheService = new CacheService("KetquaMienbac","getDataByDate",$date.$str_key);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array();   
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($wdays){
                    $wday_mysql = "";
                    foreach($wdays as $wday){
                        $wday_mysql .= LoadConfig::$weekday_mysql[$wday].',';
                    }
                    $conditions = " AND WEEKDAY(`ngay_quay`) IN (".trim($wday_mysql,",").")"; 
                }
                if($date==""){
                    $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT * FROM ketqua_mienbac WHERE ngay_quay = '".trim($date)."' ".$conditions;
                }          
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
        

        public function getDataInDates($from_date,$to_date,$wdays=array()){
            $str_key = implode("_",$wdays);
            $from_date = date('Y-m-d',strtotime($from_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $cacheService = new CacheService("KetquaMienbac","getDataInDates",$from_date.'_'.$to_date,$str_key);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array();    
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($wdays){
                    $wday_mysql = "";
                    foreach($wdays as $wday){
                        $wday_mysql .= LoadConfig::$weekday_mysql[$wday].',';
                    }
                    $conditions = " AND WEEKDAY(`ngay_quay`) IN (".trim($wday_mysql,",").")"; 
                }
                $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ".$conditions."
                AND ngay_quay >='".trim($from_date)."' AND ngay_quay <= '".trim($to_date)."' ORDER BY ngay_quay DESC";              
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
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
        public function getDataByWeekday($wday,$page,$row_per_page){
            $cacheService = new CacheService("KetquaMienbac","getDataByWeekday",$wday,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $wday_mysql = LoadConfig::$weekday_mysql[$wday];
                $conditions = " AND WEEKDAY(`ngay_quay`)=".$wday_mysql."";
                $connect = Yii::app()->db;

                $sql = "SELECT count(id) as count FROM ketqua_mienbac WHERE 1 ".$conditions."";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryRow();
                $max_page = ceil($row_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ".$conditions." ORDER BY ngay_quay DESC
                LIMIT ".$first.",".$row_per_page."";                            
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $key=>$value){
                    $data[$value["ngay_quay"]] = $value;
                }
                $a = array($data,$max_page,$row_count["count"]);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }  
            return $a;
        }  
        
        public function getDataListByWeekday($wdays,$page,$row_per_page){
            $str_key = implode("_",$wdays);
            $cacheService = new CacheService("KetquaMienbac","getDataList",$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($wdays){
                    $wday_mysql = "";
                    foreach($wdays as $wday){
                        $wday_mysql .= LoadConfig::$weekday_mysql[$wday].',';
                    }
                    $conditions = " AND WEEKDAY(`ngay_quay`) IN (".trim($wday_mysql,",").")"; 
                }
                $connect = Yii::app()->db;

                $sql = "SELECT count(id) as count FROM ketqua_mienbac WHERE 1";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryRow();
                $max_page = ceil($row_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ORDER BY ngay_quay DESC
                LIMIT ".$first.",".$row_per_page."";                            
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $key=>$value){
                    $data[$value["ngay_quay"]] = $value;
                }
                $a = array($data,$max_page,$row_count["count"]);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }

        public function getDataList($page,$row_per_page){
            $cacheService = new CacheService("KetquaMienbac","getDataList",$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;

                $sql = "SELECT count(id) as count FROM ketqua_mienbac WHERE 1";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryRow();
                $max_page = ceil($row_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ORDER BY ngay_quay DESC
                LIMIT ".$first.",".$row_per_page."";                            
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $key=>$value){
                    $data[$value["ngay_quay"]] = $value;
                }
                $a = array($data,$max_page,$row_count["count"]);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        public function getDataListByWday($wdays,$page,$row_per_page){
            $str_key = implode("_",$wdays);
            $cacheService = new CacheService("KetquaMienbac","getDataListByWday",$str_key,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if($wdays){
                    $wday_mysql = "";
                    foreach($wdays as $wday){
                        $wday_mysql .= LoadConfig::$weekday_mysql[$wday].',';
                    }
                    $conditions = " AND WEEKDAY(`ngay_quay`) IN (".trim($wday_mysql,",").")"; 
                }
                $sql = "SELECT count(id) as count FROM ketqua_mienbac WHERE 1 ".$conditions." ";
                $command = $connect->createCommand($sql);
                $row_count = $command->queryRow();
                $max_page = ceil($row_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT * FROM ketqua_mienbac WHERE 1 ".$conditions." ORDER BY ngay_quay DESC
                LIMIT ".$first.",".$row_per_page."";                            
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $key=>$value){
                    $data[$value["ngay_quay"]] = $value;
                }
                $a = array($data,$max_page,$row_count["count"]);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }

        public function getDataInIds($arr_ids){
            $str_key = implode("_",$arr_ids);
            $ids = implode(",",$arr_ids);
            $cacheService = new CacheService("KetquaMienbac","getDataInIds",$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($ids !=""){
                    $connect = Yii::app()->db;
                    $sql = "SELECT * FROM ketqua_mienbac WHERE id IN (".$ids.") ORDER BY ngay_quay ASC";                            
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
