<?php
    class Dientoan extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'ketqua_dientoan123';
        }

        public function getDataByDate($date=""){
            $cacheService = new CacheService("Dientoan","getDataByDate",$date);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                $connect = Yii::app()->db;
                if($date==""){
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ngay_quay FROM ketqua_dientoan123 
                    WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ngay_quay FROM ketqua_dientoan123 WHERE ngay_quay = '".trim($date)."' ".$conditions;
                }              
                $command = $connect->createCommand($sql);
                $dt_123 = $command->queryRow();
                if($date==""){
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ketqua_4,ketqua_5,ketqua_6,ngay_quay FROM ketqua_dientoan6x36
                    WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ketqua_4,ketqua_5,ketqua_6,ngay_quay FROM ketqua_dientoan6x36 
                    WHERE ngay_quay = '".trim($date)."' ".$conditions;
                } 
                $command = $connect->createCommand($sql);
                $dt_6x36 = $command->queryRow(); 
                if($date==""){
                    $sql = "SELECT ketqua,ngay_quay FROM ketqua_thantai
                    WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT ketqua,ngay_quay FROM ketqua_thantai 
                    WHERE ngay_quay = '".trim($date)."' ".$conditions;
                }        
                $command = $connect->createCommand($sql);
                $thantai = $command->queryRow();
                $a = array($dt_123,$dt_6x36,$thantai);
                Yii::app ()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getData123ByDate($date=""){
            $cacheService = new CacheService("Dientoan","getData123ByDate",$date);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                $connect = Yii::app()->db;
                if($date==""){
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ngay_quay FROM ketqua_dientoan123 
                    WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ngay_quay FROM ketqua_dientoan123 WHERE ngay_quay = '".trim($date)."' ".$conditions;
                }              
                $command = $connect->createCommand($sql);
                $dt_123 = $command->queryRow();
                Yii::app ()->cache->set($key, $dt_123, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $dt_123 = $cache;
            }
            return $dt_123;
        }
        
        public function getData6x36ByDate($date=""){
            $cacheService = new CacheService("Dientoan","getData6x36ByDate",$date);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                $connect = Yii::app()->db;
                if($date==""){
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ketqua_4,ketqua_5,ketqua_6,ngay_quay FROM ketqua_dientoan6x36
                    WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ketqua_4,ketqua_5,ketqua_6,ngay_quay FROM ketqua_dientoan6x36 
                    WHERE ngay_quay = '".trim($date)."' ".$conditions;
                } 
                $command = $connect->createCommand($sql);
                $dt_6x36 = $command->queryRow(); 
                Yii::app ()->cache->set($key, $dt_6x36, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $dt_6x36 = $cache;
            }
            return $dt_6x36;
        }
        
        public function getDataThantaiByDate($date=""){
            $cacheService = new CacheService("Dientoan","getDataThantaiByDate",$date);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                $connect = Yii::app()->db;
                if($date==""){
                    $sql = "SELECT ketqua,ngay_quay FROM ketqua_thantai
                    WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT 1";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT ketqua,ngay_quay FROM ketqua_thantai 
                    WHERE ngay_quay = '".trim($date)."' ".$conditions;
                }        
                $command = $connect->createCommand($sql);
                $thantai = $command->queryRow(); 
                Yii::app ()->cache->set($key, $thantai, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $thantai = $cache;
            }
            return $thantai;
        }

        public function getDataInDates($begin,$end){
            $cacheService = new CacheService("Dientoan","getDataInDates",$begin."_".$end);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $dt_123 = array();$dt_6x36 = array();$thantai = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($end !="" && $begin !=""){
                    $conditions = "";
                    $connect = Yii::app()->db;
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($begin))."' ";
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($end))."' ";
                    $sql = "SELECT ngay_quay,ketqua_1,ketqua_2,ketqua_3 FROM ketqua_dientoan123 WHERE 1 ".$conditions."";          
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                         $dt_123[$value["ngay_quay"]] = $value;
                    }
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ketqua_4,ketqua_5,ketqua_6,ngay_quay FROM ketqua_dientoan6x36 
                    WHERE 1 ".$conditions."";          
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                         $dt_6x36[$value["ngay_quay"]] = $value;
                    }
                    $sql = "SELECT ketqua,ngay_quay FROM ketqua_thantai WHERE 1 ".$conditions."";          
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                         $thantai[$value["ngay_quay"]] = $value;
                    }
                }
                $a = array($dt_123,$dt_6x36,$thantai);
                Yii::app ()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getData123InDates($begin,$end){
            $cacheService = new CacheService("Dientoan","getData123InDates",$begin."_".$end);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $dt_123 = array();$dt_6x36 = array();$thantai = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($end !="" && $begin !=""){
                    $conditions = "";
                    $connect = Yii::app()->db;
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($begin))."' ";
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($end))."' ";
                    $sql = "SELECT ngay_quay,ketqua_1,ketqua_2,ketqua_3 FROM ketqua_dientoan123 WHERE 1 ".$conditions."";          
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                         $dt_123[$value["ngay_quay"]] = $value;
                    }
                }
                
                Yii::app ()->cache->set($key, $dt_123, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $dt_123 = $cache;
            }
            return $dt_123;
        }
        
        public function getData6x36InDates($begin,$end){
            $cacheService = new CacheService("Dientoan","getData6x36InDates",$begin."_".$end);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $dt_123 = array();$dt_6x36 = array();$thantai = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($end !="" && $begin !=""){
                    $conditions = "";
                    $connect = Yii::app()->db;
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($begin))."' ";
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($end))."' ";
                    $sql = "SELECT ketqua_1,ketqua_2,ketqua_3,ketqua_4,ketqua_5,ketqua_6,ngay_quay FROM ketqua_dientoan6x36 
                    WHERE 1 ".$conditions."";          
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                         $dt_6x36[$value["ngay_quay"]] = $value;
                    }
                }
                
                Yii::app ()->cache->set($key, $dt_6x36, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $dt_6x36 = $cache;
            }
            return $dt_6x36;
        }
        
        public function getDataThantaiInDates($begin,$end){
            $cacheService = new CacheService("Dientoan","getDataThantaiInDates",$begin."_".$end);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $dt_123 = array();$dt_6x36 = array();$thantai = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($end !="" && $begin !=""){
                    $conditions = "";
                    $connect = Yii::app()->db;
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($begin))."' ";
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($end))."' ";
                    $sql = "SELECT ketqua,ngay_quay FROM ketqua_thantai WHERE 1 ".$conditions."";          
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                         $thantai[$value["ngay_quay"]] = $value;
                    }
                }
                
                Yii::app ()->cache->set($key, $thantai, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $thantai = $cache;
            }
            return $thantai;
        }
    }
