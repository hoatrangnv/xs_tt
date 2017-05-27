<?php
    class News extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'news_xosome';
        }

        public function getDataSearchPaging($keyword,$page,$row_per_page){
            $str_key = str_replace(" ","_",$keyword);
            $cacheService = new CacheService("News","getDataSearchPaging",$str_key,$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $arr_keyword = explode(" ",$keyword);
                $conditions = " AND status=1 AND publish_date < ".time();
                foreach($arr_keyword as $value){
                    $conditions .= " AND title LIKE '%".$value."%' ";
                }
                $connect = Yii::app()->db;
                $sql = "SELECT count(id) as count FROM news_xosome WHERE 1 ".$conditions."";                
                $command = $connect->createCommand($sql);
                $rows_count = $command->queryRow();
                $max_page = ceil($rows_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT id, title,alias,picture,introtext,hit,create_date FROM news_xosome WHERE 1 ".$conditions." 
                ORDER BY position DESC,id DESC LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                $a = array($data,$max_page,$rows_count["count"]);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }

        public function getDataOther($id,$limit){
            $cacheService = new CacheService("News","getDataOther",$id.'_'.$limit);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = " AND id <> ".intval($id)." AND status=1 AND publish_date < ".time();
                $connect = Yii::app()->db;
                $sql = "SELECT id, title,alias,picture,introtext,hit,create_date FROM news_xosome WHERE 1 ".$conditions." 
                ORDER BY id DESC LIMIT ".$limit."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataPaging($page,$row_per_page){

            $cacheService = new CacheService("News","getDataPaging",$page,$row_per_page);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 

                $conditions = " AND status=1 AND publish_date < ".time();
                $connect = Yii::app()->db;
                $sql = "SELECT count(id) as count FROM news_xosome WHERE 1 ".$conditions."";                
                $command = $connect->createCommand($sql);
                $rows_count = $command->queryRow();
                $max_page = ceil($rows_count["count"]/$row_per_page);
                $first = ($page-1)*$row_per_page;
                $sql = "SELECT id, title,alias,picture,introtext,hit,create_date FROM news_xosome WHERE 1 ".$conditions." 
                ORDER BY position DESC,id DESC LIMIT ".$first.",".$row_per_page."";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                $a = array($data,$max_page,$rows_count["count"]);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }


        public function updateHitById($id){

            $sql = "UPDATE news_xosome SET hit = hit +1 WHERE id = ".intval($id);
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }

        public function getDataById($id){

            $cacheService = new CacheService("News","getDataById",$id);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $sql = "SELECT id,title,alias,picture,introtext,description,hit,noindex,nofollow,
                meta_title,meta_keyword,meta_description,tags,create_date FROM news_xosome WHERE id =".$id." AND status=1 AND publish_date < ".time();
                $command = $connect->createCommand($sql);
                $data = $command->queryRow();
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }


        public function getDataByDayAndMonth($day,$month=0,$year=0){
            $table = "news_xosome";
            $cacheService = new CacheService("News","getDataByDayAndMonth",$day,$month,$year);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array();
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 

                $conditions = " AND status=1";
                if($month >0){
                    $year = $year >0 ? $year : date('Y'); 
                    $time = mktime(0,0,0,$month,1,$year);
                    $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    $end = mktime(0,0,0,$month,$num,$year);
                    $conditions .= " AND create_date >= ".$time;
                    $conditions .= " AND create_date <= ".$end;
                }else{
                    $conditions .= " AND create_date >= ".strtotime($day);
                }
                $connect = Yii::app()->db;
                $sql = "SELECT id,title,alias,create_date FROM ".$table." WHERE 1 ".$conditions." ORDER BY id DESC";
                //echo $sql;die;
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900); 
            }else{
                $data = $cache;
            }
            return $data;
        }
    }
