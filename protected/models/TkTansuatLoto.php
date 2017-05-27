<?php
    class TkTansuatLoto extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'thongke_tansuat_loto_mienbac';
        }
        
        public function getDataSearchByTable($table,$search){

            $str_key = implode("_",$search);
            $cacheService = new CacheService("TkTansuatLoto","getDataSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["times"])){
                    $conditions .= " AND khoang_thoigian = '".$search["times"]."'"; 
                }
                
                if(!empty($search["is_dacbiet"]) && intval($search["is_dacbiet"]) ==1){
                    $conditions .= " AND is_dacbiet = 1"; 
                }
                
                $sql = "SELECT MAX(bien_ngay) as max_bien_ngay FROM ".$table." WHERE 1 ".$conditions."";
                $command = $connect->createCommand($sql);
                $row = $command->queryRow();
                $max_bien_ngay = $row["max_bien_ngay"];
                $sql = "SELECT * FROM ".$table." WHERE 1 ".$conditions." AND bien_ngay = '".$max_bien_ngay."' ORDER BY so_ngay_ve DESC ";

                $command = $connect->createCommand($sql);
                $data = $command->queryAll();

                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }
    }
