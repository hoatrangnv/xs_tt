<?php
    class Dreambook extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'dream_book';
        }
        
        public function getDataSearch($search,$page,$row_per_page){
            $str_key = implode("_",$search);
            $cacheService = new CacheService("Dreambook","getDataSearch",$str_key,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if(!empty($search["first_word"])){
                    $conditions .= " AND title LIKE '".$search["first_word"]."%' ";
                }
                $connect = Yii::app()->db;
                $sql = "SELECT count(id) as count FROM dream_book WHERE 1 ".$conditions."";                
                $command = $connect->createCommand($sql);
                $rows_count = $command->queryRow();
                $max_page = ceil($rows_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT id, title, result,alias FROM dream_book WHERE 1 ".$conditions." 
                ORDER BY id DESC LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                $a = array($data,$max_page,$rows_count["count"]);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getDataSearchKeyword($keyword,$page,$row_per_page){
            $arr_keyword = explode(" ",$keyword);
            $cacheService = new CacheService("Dreambook","getDataSearch",$keyword,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($arr_keyword){
                    foreach($arr_keyword as $value){
                        $conditions .= " AND title LIKE '%".$value."%' ";
                    }
                }
                $connect = Yii::app()->db;
                $sql = "SELECT count(id) as count FROM dream_book WHERE 1 ".$conditions."";                
                $command = $connect->createCommand($sql);
                $rows_count = $command->queryRow();
                $max_page = ceil($rows_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT id, title, result,alias FROM dream_book WHERE 1 ".$conditions." 
                ORDER BY id DESC LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                $a = array($data,$max_page,$rows_count["count"]);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getDataByTitles($arr_titles,$page,$row_per_page){
            $str_key = implode("_",$arr_titles);
            $cacheService = new CacheService("Dreambook","getDataByTitles",$str_key,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $titles ="";
                foreach($arr_titles as $value){
                    $titles .= "'".$value."',";
                }
                $conditions = "";
                if(trim($titles,",") !=""){
                    $conditions .= " AND title IN (".trim($titles,",").")";
                }else{
                    $conditions .= " AND title IN (0)";
                }
                $connect = Yii::app()->db;
                $sql = "SELECT count(id) as count FROM dream_book WHERE 1 ".$conditions."";            
                $command = $connect->createCommand($sql);
                $rows_count = $command->queryRow();
                $max_page = ceil($rows_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT id, title, result,alias FROM dream_book WHERE 1 ".$conditions." 
                ORDER BY id DESC LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                $a = array($data,$max_page,$rows_count["count"]);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getDataByIds($ids,$page,$row_per_page){
            $str_key = implode("_",$ids);
            $cacheService = new CacheService("Dreambook","getDataByIds",$str_key,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($ids){
                    $conditions .= " AND id IN (".implode(",",$ids).")";
                }else{
                    $conditions .= " AND id IN (0)";
                }
                $connect = Yii::app()->db;
                $sql = "SELECT count(id) as count FROM dream_book WHERE 1 ".$conditions."";            
                $command = $connect->createCommand($sql);
                $rows_count = $command->queryRow();
                $max_page = ceil($rows_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT id, title, result,alias FROM dream_book WHERE 1 ".$conditions." 
                ORDER BY id DESC LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                $a = array($data,$max_page,$rows_count["count"]);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
        
        public function getDataById($id){
            $cacheService = new CacheService("Dreambook","getDataById",$id);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 

                $connect = Yii::app()->db;
                $sql = "SELECT id, title_long, title, result,content,noindex,nofollow FROM dream_book WHERE id =".$id." ";
                $command = $connect->createCommand($sql);
                $data = $command->queryRow();
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }
    }
