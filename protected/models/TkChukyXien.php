<?php
    class TkChukyXien extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'thongke_chuky_boso_xien2';
        }

        public function getDataSearchByBoso($boso1,$boso2,$search){
            $str_key = implode("_",$search);         
            $cacheService = new CacheService("TkChukyXien","getDataSearchByBoso",$boso1."_".$boso2,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($boso1 !="" && $boso2 !=""){
                    $connect = Yii::app()->db;
                    $conditions = " AND ((boso1 = '".trim($boso1)."' AND boso2 = '".trim($boso2)."')
                    OR (boso1 = '".trim($boso2)."' AND boso2 = '".trim($boso1)."'))";
                    if(!empty($search["province_id"]) && intval($search["province_id"]) >0){
                        $conditions .= " AND province_id = ".intval($search["province_id"]);
                    }
                    if(!empty($search["from_date"])){
                        $conditions .= " AND start_date >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                    }
                    if(!empty($search["to_date"])){
                        $conditions .= " AND start_date <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                    }
                    $sql = "SELECT boso1,boso2,start_date,end_date,length FROM thongke_chuky_boso_xien2 WHERE 1 ".$conditions."";   
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $value){
                        $data[$boso1.'-'.$boso2][] = $value;
                    }
                    Yii::app()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
                }
            }else{
                $data = $cache;
            }
            
            return $data;
        }
    }
