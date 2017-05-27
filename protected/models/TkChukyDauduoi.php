<?php
    class TkChukyDauduoi extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'thongke_chuky_dau';
        }

        public function getDataDauSearch($search){     
            $str_key = implode("_",$search);  
            $cacheService = new CacheService("TkChukyDauduoi","getDataDauSearch",$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $data_lt = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(!empty($search["province_id"]) && intval($search["province_id"]) >0){
                    $conditions .= " AND province_id = ".intval($search["province_id"]);
                }
                if(!empty($search["from_date"])){
                    $conditions .= " AND start_date >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND start_date <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }  
                $sql = "SELECT dau,start_date,end_date,length FROM thongke_chuky_dau 
                WHERE 1 ".$conditions." ORDER BY length DESC";   
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                $str_key_dau = "";
                foreach($rows as $value){
                    $str_key_dau .= $value["dau"].","; 
                    $data[$value["dau"]][] = $value;
                }

                if(!empty($str_key_dau)){
                    $sql = "SELECT dau,start_date,end_date,length FROM thongke_dau_ve_lientiep 
                    WHERE dau IN (".trim($str_key_dau,",").") ".$conditions." ORDER BY length DESC";
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                        $data_lt[$value["dau"]][] = $value;
                    }
                }


                $a = array($data,$data_lt);
                Yii::app()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }

            return $a;
        }

        public function getDataDuoiSearch($search){
            $str_key = implode("_",$search);   
            $cacheService = new CacheService("TkChukyDauduoi","getDataDuoiSearch",$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $data_lt = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(!empty($search["province_id"]) && intval($search["province_id"]) >0){
                    $conditions .= " AND province_id = ".intval($search["province_id"]);
                }
                if(!empty($search["from_date"])){
                    $conditions .= " AND start_date >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND start_date <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                $sql = "SELECT duoi,start_date,end_date,length FROM thongke_chuky_duoi 
                WHERE 1 ".$conditions." ORDER BY length DESC";   
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                $str_key_duoi = "";
                foreach($rows as $value){
                    $str_key_duoi .= $value["duoi"].","; 
                    $data[$value["duoi"]][] = $value;
                }
                if(!empty($str_key_duoi)){
                    $sql = "SELECT duoi,start_date,end_date,length FROM thongke_duoi_ve_lientiep 
                    WHERE duoi IN (".trim($str_key_duoi,",").") ".$conditions." ORDER BY length DESC";
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                        $data_lt[$value["duoi"]][] = $value;
                    }
                }
                $a = array($data,$data_lt);
                Yii::app()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }

            return $a;
        }

        public function getDataTongSearch($search){
            $str_key = implode("_",$search);   
            $cacheService = new CacheService("TkChukyDauduoi","getDataTongSearch",$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $data_lt = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(!empty($search["province_id"]) && intval($search["province_id"]) >0){
                    $conditions .= " AND province_id = ".intval($search["province_id"]);
                }
                if(!empty($search["from_date"])){
                    $conditions .= " AND start_date >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND start_date <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                $sql = "SELECT tong,start_date,end_date,length FROM thongke_chuky_tong_db 
                WHERE 1 ".$conditions." ORDER BY length DESC";   
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                $str_key_tong = "";
                foreach($rows as $value){
                    $str_key_tong .= $value["tong"].","; 
                    $data[$value["tong"]][] = $value;
                }
                if(!empty($str_key_tong)){
                    $sql = "SELECT tong,start_date,end_date,length FROM thongke_tong_db_ve_lientiep 
                    WHERE tong IN (".trim($str_key_tong,",").") ".$conditions." ORDER BY length DESC";
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                        $data_lt[$value["tong"]][] = $value;
                    }
                }

                $a = array($data,$data_lt);
                Yii::app()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }

            return $a;
        }
    }
