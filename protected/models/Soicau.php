<?php
    class Soicau extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'soicau';
        }

        public function getCauByData($province_id,$bien_do_ngay,$bien_ngay,$type){
            $cacheService = new CacheService("Soicau","getCauByData".$province_id.$bien_do_ngay.$bien_ngay.$type);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache );
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $sql = "SELECT * FROM soicau WHERE bien_ngay ='".$bien_ngay."' AND province_id =".$province_id." AND bien_do_ngay =".$bien_do_ngay." AND type =".$type." ORDER BY id DESC";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $row = $command->queryRow();
                Yii::app ()->cache->set ( $key_cache, $row, ConstantsUtil::TIME_CACHE_900);
            }else{
                $row = $cache;
            }
            return $row;
        }

        public function getBuocCauByData($cau_id,$boso){
            $str_where = "";
            $str_where.= " AND boso = ".$boso." AND cau_id = ".$cau_id;

            $sql = "SELECT * FROM soicau_buoccau WHERE 1 ".$str_where." LIMIT 1";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();
            return $row;
        }

        public function getBuocCauDetailById($table,$str_step_id){
            $str_where = " AND id IN (".$str_step_id.")";
            $sql = "SELECT * FROM ".$table." WHERE 1 ".$str_where. " ORDER BY id DESC";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryAll();
            return $rows;
        }

    }
