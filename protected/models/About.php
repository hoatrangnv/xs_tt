<?php
    class About extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'xs_about';
        }

        public function getContentByType($type){
            $cacheService = new CacheService("About","getContentByType".$type);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $sql = "SELECT * FROM xs_about WHERE type =".$type;
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $row = $command->queryRow();
                $data = $row;
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }


    }
