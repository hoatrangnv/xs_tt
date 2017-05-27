<?php
    class Kqthantai extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'ketqua_thantai';
        }

        public function getKqthantaiByLimit($limit){
            $cacheService = new CacheService("Kqthantai","getKqthantaiByLimit".$limit);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache );
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $sql = "SELECT * FROM ketqua_thantai ORDER BY id DESC LIMIT ".$limit;
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                Yii::app ()->cache->set ( $key_cache, $rows, ConstantsUtil::TIME_CACHE_900);
            }else{
                $rows = $cache;
            }
            return $rows;
        }

    }
