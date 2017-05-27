<?php
    class Provinces extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'province';
        }

        public function getDataById($id){
            $cacheService = new CacheService("Provinces","getDataById",$id);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array(); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $sql = "SELECT * FROM province WHERE id = ".intval($id);
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryRow();
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataInDay($day,$type=0){
            $date = getdate(strtotime($day));
            $thu = Common::getWeekDay($date["wday"]);
            $cacheService = new CacheService("Provinces","getDataInDay",$day);
            $key_cache = $cacheService->createKey();      
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){  
                $sql = "SELECT * FROM province WHERE id<>1 AND thu".$thu["id"]."=1";   
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();                      
                Yii::app ()->cache->set ( $key_cache, $rows, ConstantsUtil::TIME_CACHE_900);     
            }else{
                $rows = $cache;
            }
            if($type==0){
                foreach($rows as $value){
                    $data[$value["region"]][$value["id"]] = $value; 
                    for($i=2;$i<=8;$i++){
                        if($value["thu".$i]==1){
                            $data[$value["region"]][$value["id"]]["live"][] = $i;
                        }
                    }
                }
            }elseif($type==1){
                foreach($rows as $value){
                    $data[$value["id"]] = $value; 
                    for($i=2;$i<=8;$i++){
                        if($value["thu".$i]==1){
                            $data[$value["id"]]["live"][] = $i;
                        }
                    }
                }
            }
            return $data;
        }
        

        public function getDataByWday($wday){
            $cacheService = new CacheService("Provinces","getDataByWday",$wday);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $sql = "SELECT * FROM province WHERE id<>1 AND thu".$wday."=1";  
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["region"]][$value["id"]] = $value; 
                    for($i=2;$i<=8;$i++){
                        if($value["thu".$i]==1){
                            $data[$value["region"]][$value["id"]]["live"][] = $i;
                        }
                    }
                }
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataInIds($provinces){  
            $ids = implode(",",$provinces);
            $str_key = implode("_",$provinces);
            $cacheService = new CacheService("Provinces","getDataInIds",$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){    
                $sql = "SELECT * FROM province WHERE id<>1 AND id IN (".$ids.")";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getAllData($type=0){
            $cacheService = new CacheService("Provinces","getAllData");
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $sql = "SELECT * FROM province WHERE id<>1";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();

                Yii::app ()->cache->set ( $key_cache, $rows, ConstantsUtil::TIME_CACHE_900);
            }else{
                $rows = $cache;
            }
            if($type==0){
                foreach($rows as $value){
                    $data[$value["region"]][$value["id"]] = $value;
                    for($i=2;$i<=8;$i++){
                        if($value["thu".$i]==1){
                            $data[$value["region"]][$value["id"]]["live"][] = $i;
                        }
                    } 
                }
            }elseif($type==1){
                foreach($rows as $value){
                    $data[$value["id"]] = $value; 
                    for($i=2;$i<=8;$i++){
                        if($value["thu".$i]==1){
                            $data[$value["id"]]["live"][] = $i;
                        }
                    }
                }
            }
            return $data;
        }

        public function getListProvince(){
            $cacheService = new CacheService("Provinces","getListProvince");
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache);
            $data = array();
            $data[1] = "Miền Bắc";
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $sql = "SELECT * FROM province WHERE id<>1 ";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    if($value["region"] != 1){
                        $data[$value["id"]] = $value['name'];
                    }
                }
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }
        public function getListProvinceToday($wday){
            $cacheService = new CacheService("Provinces","getListProvinceToday");
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache);
            $data = array();
            $data[1]['name'] = "Miền Bắc";
            $data[1]['region'] = "1";
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $sql = "SELECT * FROM province WHERE id<>1 AND thu".$wday."=1";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    if($value["region"] != 1){
                        $data[$value["id"]] = $value;
                    }
                }
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }
    }
