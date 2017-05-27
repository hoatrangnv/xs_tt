<?php
    class TkLoto extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'thongke_loto_mienbac';
        }

        public function getCountBosoIn40Times($region_id,$province_id,$to_date=''){
            $times = 40;
            $cacheService = new CacheService("TkLoto","getCountBosoIn40Times",$region_id,$province_id,$to_date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $data_10 = array(); 
            $data_20 = array();     
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $connect = Yii::app()->db;    
                if($region_id==3){
                    $conditions_rs = " AND province_id = ".intval($province_id);
                    $table_rs = 'ketqua_miennam';
                    $table_tk = 'thongke_loto_miennam';
                }elseif($region_id==2){
                    $conditions_rs = " AND province_id = ".intval($province_id);
                    $table_rs = 'ketqua_mientrung';
                    $table_tk = 'thongke_loto_mientrung';
                }else{
                    $conditions_rs = "";
                    $table_rs = 'ketqua_mienbac';
                    $table_tk = 'thongke_loto_mienbac';
                }

                if($to_date!=""){
                    $conditions_rs .= " AND ngay_quay <= '".$to_date."'";
                }
                $sql = "SELECT ngay_quay FROM ".$table_rs." WHERE 1 ".$conditions_rs." ORDER BY ngay_quay DESC LIMIT ".$times."";
                $command = $connect->createCommand($sql);
                $result_ids = $command->queryColumn();

                for($i=0;$i<count($result_ids);$i++){
                    if($i < 10){
                        $date_10 = $result_ids[$i];
                    }
                    if($i < 20){
                        $date_20 = $result_ids[$i];
                    }
                }   
                $date_rule = end($result_ids);   

                $conditions = "";
                $conditions = " AND ngay_quay >= '".$date_rule."'";
                $end_dates = "";

                $sql = "SELECT count(id) as tan_so, boso, ngay_quay FROM ".$table_tk." WHERE 1 ".$conditions_rs." ".$conditions."
                GROUP BY boso,ngay_quay ORDER BY tan_so DESC";
                //echo $sql;die;
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();   
                //var_dump($data);die;
                foreach($data as $key=>$value){
                    if(!isset($data_10[$value["boso"]])){
                        $data_10[$value["boso"]] = array("boso"=>$value["boso"],"new"=>0,"old"=>0);
                    }
                    if(!isset($data_20[$value["boso"]])){
                        $data_20[$value["boso"]] = array("boso"=>$value["boso"],"new"=>0,"old"=>0);
                    }
                    if($value["ngay_quay"] >= $date_10){
                        $data_10[$value["boso"]]["new"] += intval($value["tan_so"]);
                    }elseif($value["ngay_quay"] < $date_10 && $value["ngay_quay"] >= $date_20){
                        $data_10[$value["boso"]]["old"] += intval($value["tan_so"]);
                    }

                    if($value["ngay_quay"] >= $date_20){
                        $data_20[$value["boso"]]["new"] += intval($value["tan_so"]);
                    }elseif($value["ngay_quay"] < $date_20){
                        $data_20[$value["boso"]]["old"] += intval($value["tan_so"]);
                    }
                }
                $data_10 = Common::multiSort($data_10,"new",1); 
                $data_20 = Common::multiSort($data_20,"new",1);


                $a = array($data_10,$data_20);
                Yii::app ()->cache->set($key_cache, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }   
           
            return $a;
        }

        public function getDataBosoSearchByTable($table,$search){

            $str_key = implode("_",$search);
            $cacheService = new CacheService("TKLoto","getDataBosoSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array();      
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["boso"])){
                    $conditions .= " AND boso = '".$search["boso"]."'"; 
                }

                if(!empty($search["is_dacbiet"]) && intval($search["is_dacbiet"]) ==1){
                    $conditions .= " AND is_dacbiet = 1"; 
                }

                if(!empty($search["from_date"])){
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                if(!empty($search["times"])&& intval($search["times"]) >0){
                    if(intval($search["province_id"]) !=1){
                        $sql = "SELECT ngay_quay FROM ".$table." WHERE  province_id = ".intval($search["province_id"])." GROUP BY ngay_quay ORDER BY ngay_quay DESC LIMIT ".$search["times"];
                    }else{
                        $sql = "SELECT ngay_quay FROM ".$table." GROUP BY ngay_quay ORDER BY ngay_quay DESC LIMIT ".$search["times"];
                    }
                    $command = $connect->createCommand($sql);
                    $data_date = $command->queryAll();
                    $date = "";
                    foreach($data_date as $value){
                        $date .= "'".$value["ngay_quay"]."',";
                    }
                    if($date !=""){
                        $conditions .= " AND ngay_quay IN (".trim($date,",").")";
                    }
                }
                if(!empty($search["wday"])&& intval($search["wday"]) >0 && intval($search["wday"]) <8){
                    $conditions .= " AND thu = ".intval($search["wday"]);
                }
                $sql = "SELECT boso,thu,ngay_quay,giai,SUM(tan_so) as tan_so FROM ".$table." WHERE 1 ".$conditions." 
                GROUP BY ngay_quay,boso ORDER BY ngay_quay DESC ";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataDauduoiSearchByTable($table,$search){

            $str_key = implode("_",$search);
            $cacheService = new CacheService("TKLoto","getDataDauduoiSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["is_dacbiet"]) && intval($search["is_dacbiet"]) ==1){
                    $conditions .= " AND is_dacbiet = 1"; 
                }

                if(!empty($search["from_date"])){
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                if(!empty($search["times"])&& intval($search["times"]) >0){
                    if(intval($search["province_id"]) !=1){
                        $sql = "SELECT ngay_quay FROM ".$table." WHERE  province_id = ".intval($search["province_id"])." GROUP BY ngay_quay ORDER BY ngay_quay DESC LIMIT ".$search["times"];
                    }else{
                        $sql = "SELECT ngay_quay FROM ".$table." GROUP BY ngay_quay ORDER BY ngay_quay DESC LIMIT ".$search["times"];
                    }
                    $command = $connect->createCommand($sql);
                    $data_date = $command->queryColumn();
                    if($data_date){
                        $conditions .= " AND ngay_quay >= '".end($data_date)."' ";
                    }
                }

                $sql = "SELECT thu,ngay_quay,tan_so,dau_so,dit_so,boso,giai FROM ".$table." WHERE 1 ".$conditions." ORDER BY ngay_quay DESC ";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataDacbietSearchByTable($table,$search){
            $str_key = implode("_",$search);
            $cacheService = new CacheService("TKLoto","getDataDacbietSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "AND is_dacbiet=1";
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["month"]) && intval($search["month"]) >0){
                    $conditions .= " AND MONTH(`ngay_quay`) = ".$search["month"];
                }
                if(!empty($search["year"]) && intval($search["year"]) >0){
                    $conditions .= " AND YEAR(`ngay_quay`) = ".$search["year"];
                }

                $sql = "SELECT boso,thu,ngay_quay,tan_so,dau_so,dit_so,tong_bo,DAY(`ngay_quay`) as day ,MONTH(`ngay_quay`) as month 
                FROM ".$table." WHERE 1 ".$conditions." ORDER BY ngay_quay ASC ";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataTongSearchByTable($table,$search){
            $str_key = implode("_",$search);
            $cacheService = new CacheService("TKLoto","getDataTongSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = " AND tong_bo = ".intval($search["tong_bo"]);
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["is_dacbiet"]) && intval($search["is_dacbiet"])==1){
                    $conditions .= " AND is_dacbiet = ".intval($search["is_dacbiet"]); 
                }

                if(!empty($search["from_date"])){
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }

                $sql = "SELECT boso,ngay_quay 
                FROM ".$table." WHERE 1 ".$conditions." ORDER BY ngay_quay DESC ";
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["boso"]][] = $value;
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }           

        public function getDataTongByDateAndProvince($table,$province_id,$date){
            $cacheService = new CacheService("TKLoto","getDataTongByDateAndProvince",$table,$province_id.$date);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(intval($province_id) !=1){
                    $conditions = " AND province_id = ".intval($province_id); 
                }
                $date = date('Y-m-d',strtotime($date));
                $sql = "SELECT boso,tong_bo FROM  ".$table." WHERE ngay_quay = '".$date."' ".$conditions." 
                GROUP BY `boso` ORDER BY `tong_bo` ASC";
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["tong_bo"]][] = $value["boso"];
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }   

        public function getDataDaySearchByTable($table,$search){
            $str_key = implode("_",$search);
            $cacheService = new CacheService("TKLoto","getDataDaySearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["week"]) && intval($search["week"]) >0){
                    $conditions .= " AND ngay_quay >= '".Common::getDateByWeek($search["week"])."' "; 
                }
                if(!empty($search["wday"]) && intval($search["wday"]) >0){
                    $conditions .= " AND thu =".$search["wday"]; 
                }
                $sql = "SELECT boso,count(id) as total FROM ".$table." WHERE 1 ".$conditions." GROUP BY boso ORDER BY total DESC";
                $command = $connect->createCommand($sql);
                $data = $command->queryAll();
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }  

        public function getDataCapBosoSearchByTable($table,$boso,$search){

            $str_key = implode("_",$search);
            $str_key .= implode("_",$boso);
            $cacheService = new CacheService("TKLoto","getDataCapBosoSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            $cache = false; 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $connect = Yii::app()->db;
                $conditions = "";
                if($boso){
                    $str_boso = implode(",",$boso);
                    $conditions .= "AND boso IN (".$str_boso.")";
                }

                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["from_date"])){
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                if(!empty($search["times"])&& intval($search["times"]) >0){
                    if(intval($search["province_id"]) !=1){
                        $sql = "SELECT ngay_quay FROM ".$table." WHERE  province_id = ".intval($search["province_id"])." GROUP BY ngay_quay ORDER BY ngay_quay DESC LIMIT ".$search["times"];
                    }else{
                        $sql = "SELECT ngay_quay FROM ".$table." GROUP BY ngay_quay ORDER BY ngay_quay DESC LIMIT ".$search["times"];
                    }

                    $command = $connect->createCommand($sql);
                    $data_date = $command->queryColumn();
                    if($data_date){
                        $conditions .= " AND ngay_quay >= '".end($data_date)."' ";
                    }
                } 
                $sql = "SELECT boso,thu,ngay_quay,tan_so,dau_so,dit_so,giai FROM ".$table." WHERE 1 ".$conditions." ORDER BY ngay_quay DESC ";
                // echo $sql;die;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["ngay_quay"]][$value["boso"]] = $value;
                }     
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        } 

        public function getDataQuickBosoSearchByTable($table,$boso,$search){

            $str_key = implode("_",$search);
            $str_key .= implode("_",$boso);
            $cacheService = new CacheService("TKLoto","getDataQuickBosoSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                $connect = Yii::app()->db;

                if(!empty($boso)){
                    $str_boso = implode(",",$boso);
                    if(!empty($str_boso)){
                        $conditions .= "AND boso IN (".$str_boso.")"; 
                    }

                }

                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }

                if(!empty($search["from_date"])){
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                if(!empty($search["is_dacbiet"]) && intval($search["is_dacbiet"]) ==1){
                    $conditions .= " AND is_dacbiet = 1"; 
                }
                $sql = "SELECT boso,thu,ngay_quay,tan_so,dau_so,dit_so FROM ".$table." WHERE 1 ".$conditions."";

                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    $data[$value["boso"]][] = $value;
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);

            }else{
                $data = $cache;
            }
            return $data;
        }  

        public function getDataGeneralBosoSearchByTable($table,$search){

            $str_key = implode("_",$search);
            $cacheService = new CacheService("TKLoto","getDataGeneralBosoSearchByTable",$table,$str_key);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $data = array(); 
            if($cache == false || Yii::app()->params["cache_all"]==false){ 

                $connect = Yii::app()->db;
                $conditions = "";
                if(intval($search["province_id"]) !=1){
                    $conditions .= " AND province_id = ".intval($search["province_id"]); 
                }
                if(!empty($search["from_date"])){
                    $conditions .= " AND ngay_quay >= '".date('Y-m-d',strtotime($search["from_date"]))."'";
                }
                if(!empty($search["to_date"])){
                    $conditions .= " AND ngay_quay <= '".date('Y-m-d',strtotime($search["to_date"]))."'";
                }
                if(!empty($search["is_dacbiet"]) && intval($search["is_dacbiet"]) ==1){
                    $conditions .= " AND is_dacbiet = 1"; 
                }
                if($search["type"]==1){
                    $conditions .= " AND is_tongchan = 1";
                }elseif($search["type"]==2){
                    $conditions .= " AND is_tongle = 1";
                }elseif($search["type"]==3){
                    $conditions .= " AND is_bochanchan = 1";
                }elseif($search["type"]==4){
                    $conditions .= " AND is_bolele = 1";
                }elseif($search["type"]==5){
                    $conditions .= " AND is_bochanle = 1";
                }elseif($search["type"]==6){
                    $conditions .= " AND is_bolechan = 1";
                }elseif($search["type"]==7){
                    $conditions .= " AND is_bokep = 1";
                }elseif($search["type"]==8){
                    $conditions .= " AND is_bosatkep = 1";
                }
                $sql = "SELECT boso,thu,ngay_quay,tan_so,dau_so,dit_so FROM ".$table." WHERE 1 ".$conditions."";
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $value){
                    if($search["type"]==9){
                        $data[$value["dau_so"]][] = $value;
                    }elseif($search["type"]==10){
                        $data[$value["dit_so"]][] = $value;
                    }else{
                        $data[$value["boso"]][] = $value;
                    }
                }
                Yii::app ()->cache->set($key_cache, $data, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $data = $cache;
            }
            return $data;
        }
    }
