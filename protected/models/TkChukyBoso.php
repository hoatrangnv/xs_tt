<?php
    class TkChukyBoso extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'thongke_chuky_boso';
        }

        public function getCountBosoIn40Times($province_id,$to_date=''){
            $cacheService = new CacheService("TkChukyBoso","getCountBosoIn40Times",$province_id,$to_date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $data_10 = array(); 
            $data_20 = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if($to_date!=""){
                    $conditions .= "AND end_date <= '".$to_date."'";
                }
                $sql = "SELECT end_date FROM thongke_chuky_boso WHERE province_id = ".intval($province_id)." 
                ".$conditions." GROUP BY end_date ORDER BY end_date DESC LIMIT 40";     
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                if(count($rows) >0){
                    $end_dates = "";
                    $date_10 = array("new"=>array(),"old"=>array());
                    $date_20 = array("new"=>array(),"old"=>array());
                    for($i=0;$i<count($rows);$i++){
                        if($i < 10){
                            $date_10["new"][] = $rows[$i]["end_date"];
                        }elseif($i >= 10 && $i < 20){
                            $date_10["old"][] = $rows[$i]["end_date"];
                        }
                        if($i < 20){
                            $date_20["new"][] = $rows[$i]["end_date"];
                        }elseif($i >= 20 && $i < 40){
                            $date_20["old"][] = $rows[$i]["end_date"];
                        }
                        $end_dates .= "'".$rows[$i]["end_date"]."',";
                    }

                    $sql = "SELECT count(id) as count,boso,end_date FROM thongke_chuky_boso 
                    WHERE province_id = ".intval($province_id)." AND end_date IN (".trim($end_dates,",").")
                    GROUP BY boso,end_date ORDER BY end_date DESC";
                    $command = $connect->createCommand($sql);
                    $data = $command->queryAll();
                    foreach($data as $key=>$value){
                        if(!isset($data_10[$value["boso"]])){
                            $data_10[$value["boso"]] = array("boso"=>$value["boso"],"new"=>0,"old"=>0);
                        }
                        if(!isset($data_20[$value["boso"]])){
                            $data_20[$value["boso"]] = array("boso"=>$value["boso"],"new"=>0,"old"=>0);
                        }
                        if(in_array($value["end_date"],$date_10["new"])){
                            $data_10[$value["boso"]]["new"] += intval($value["count"]);
                        }elseif(in_array($value["end_date"],$date_10["old"])){
                            $data_10[$value["boso"]]["old"] += intval($value["count"]);
                        }

                        if(in_array($value["end_date"],$date_20["new"])){
                            $data_20[$value["boso"]]["new"] += intval($value["count"]);
                        }elseif(in_array($value["end_date"],$date_20["old"])){
                            $data_20[$value["boso"]]["old"] += intval($value["count"]);
                        }
                    }
                    $data_10 = Common::multiSort($data_10,"new",1); 
                    $data_20 = Common::multiSort($data_20,"new",1);
                }else{
                    $data_10 = array();
                    $data_20 = array();
                }

                $a = array($data_10,$data_20);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }
            return $a;
        }

        public function getDataLotoGanInTimes($region_id,$province_id,$times,$to_date='',$limit=10){
            $times = intval($times);
            $cacheService = new CacheService("TkChukyBoso","getDataLotoGanInTimes",$region_id.$province_id."_".$times,$to_date.$limit);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                if($region_id==3){
                    $conditions_rs = " AND province_id = ".intval($province_id);
                    $table_rs = 'ketqua_miennam';
                    $table_tk = 'thongke_chuky_boso';
                }elseif($region_id==2){
                    $conditions_rs = " AND province_id = ".intval($province_id);
                    $table_rs = 'ketqua_mientrung';
                    $table_tk = 'thongke_chuky_boso';
                }else{
                    $conditions_rs = "";
                    $table_rs = 'ketqua_mienbac';
                    $table_tk = 'thongke_chuky_boso';
                }
                $sql = "SELECT ngay_quay FROM ".$table_rs." WHERE 1 ".$conditions_rs." ORDER BY ngay_quay DESC LIMIT ".$times."";
                $command = $connect->createCommand($sql);
                $result_ids = $command->queryColumn();

                $date_rule = end($result_ids);

                $conditions = " AND start_date >= '".$date_rule."'";

                $conditions .= !empty($to_date) ? "AND end_date <= '".$to_date."'" : "";


                $sql = "SELECT boso, start_date, end_date, length FROM ".$table_tk." WHERE 1 ".$conditions_rs." AND length >=6 
                ".$conditions." ORDER BY length DESC LIMIT ".$limit; 
                //echo $sql;die;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                $data = array();
                foreach($rows as $value){
                    if(!empty($data[$value["boso"]])){
                        if($value["length"] > $data[$value["boso"]]){
                            $data[$value["boso"]] = $value;
                        }
                    }else{
                        $data[$value["boso"]] = $value;
                    }
                }               
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);

            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataSearchByManyBoso($table,$bosos,$search){
            $str_key = implode("_",$bosos);
            $str_key .= implode("_",$search);    
            $str_boso = implode(",",$bosos);     
            $cacheService = new CacheService("TkChukyBoso","getDataSearchByManyBoso",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 

                $connect = Yii::app()->db;
                $conditions = "";

                if(!empty($str_boso)){
                    $conditions .= " AND boso IN (".$str_boso.")";
                }
                if(!empty($search["is_special"])){
                    $conditions .= " AND is_special=".intval($search["is_special"]);
                }
                if(!empty($search["province_id"]) && intval($search["province_id"]) >0){
                    $conditions .= " AND province_id = ".intval($search["province_id"]);
                }
                if(!empty($search["from_date"])){
                    $conditions .= " AND start_date >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND start_date <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                $sql = "SELECT boso,start_date,end_date,length FROM ".$table." WHERE 1 ".$conditions.""; 
                //echo $sql;die;  
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["boso"]][] = $value;
                }
                Yii::app()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);

            }else{
                $data = $cache;
            }

            return $data;
        }
    }
