<?php
    class Embed extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function getDataDateLimitByTableAndProvince($table,$province_id,$limit){
            $cacheService = new CacheService("Embed","getDataDateLimitByTable",$table."_".$province_id."_".$limit);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($province_id !=1){
                    $conditions .= " AND province_id = ".intval($province_id);
                }
                $sql = "SELECT ngay_quay FROM ".$table." WHERE 1 ".$conditions." ORDER BY ngay_quay DESC LIMIT ".$limit;           
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[] = date('d-m-Y',strtotime($value["ngay_quay"]));
                }
                Yii::app ()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }


        public function getDataByTableAndDateAndProvince($table,$date,$province_id){
            $cacheService = new CacheService("Embed","getDataByTableAndDateAndProvince",$table."_".$date."_".$province_id);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array();   
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($province_id !=1){
                    $conditions .= " AND province_id = ".intval($province_id);
                }
                if($date==""){
                    $sql = "SELECT * FROM ".$table." WHERE 1 ".$conditions." ORDER BY ngay_quay DESC";
                }else{
                    $date = date('Y-m-d',strtotime($date));
                    $sql = "SELECT * FROM ".$table." WHERE UNIX_TIMESTAMP(ngay_quay) = UNIX_TIMESTAMP('".trim($date)."') ".$conditions;
                }          
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $data = $command->queryRow();

                Yii::app ()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }                                                                                                                                                                                                                                                      
            return $data;
        }

        public function genHtmlEmbed($url,$layout=array()){ 
            if(!$layout) $layout = LoadConfig::$embed_default;   
            $html = '<script language="javascript"> var bg_color = "'.$layout["bg_color"].'";var tit_color = "'.$layout["tit_color"].'";var db_color = "'.$layout["db_color"].'";var width = "'.$layout["width"].'";var fsize = "'.$layout["fsize"].'";</script>';
            $html .= '<div id="box_nhung_ketquaveso"></div><meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><script type="text/javascript" src="'.Yii::app()->params["static_url"].'/js/jquery.min.js"></script><script src="'.$url.'"></script>';
            return $html;
        }

    }
