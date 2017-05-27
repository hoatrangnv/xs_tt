<?php
    class Comment extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'comment';
        }
        public function getDataByContentId($table,$content_id,$per_page=5){
            $cacheService = new CacheService("Comment","getDataByContentId",$table,$content_id);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            list($comment,$reply) = array(array(),array());
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;   
                $sql = "SELECT * FROM ".$table." WHERE status=1 
                AND reply_id=0 AND content_id = ".intval($content_id)." ORDER BY id DESC LIMIT ".$per_page."";
                $command = $connect->createCommand($sql);
                $comment = $command->queryAll();
                $comment_ids = array();
                foreach($comment as $value){
                    $comment_ids[] = $value["id"];
                }
                if($comment_ids){
                    $sql = "SELECT * FROM ".$table." WHERE status=1 AND reply_id IN (".implode(",",$comment_ids).")";
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                        $reply[$value["reply_id"]][] = $value; 
                    }
                }
                $a = array($comment,$reply);
                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_900);
            }else{
                $a = $cache;
            }
            return $a;
        }
    }
