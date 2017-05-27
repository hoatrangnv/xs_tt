<?php
    class Chat extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function getDataByMaxId($max_id,$limit,$type=1){

            $cacheService = new CacheService("UserChat","getDataByMaxId",$type,$max_id,$limit);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key_cache); 
            $a = array();        
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                $conditions = "";
                if($max_id >0){
                    if($type==1){
                        $conditions.= " AND id > ".intval($max_id);
                    }else{
                        $conditions.= " AND id < ".intval($max_id);
                    } 
                    $ordering = " ORDER BY id DESC";
                }else{
                    $ordering = " ORDER BY id DESC";
                }


                $connect = Yii::app()->db;
                $sql = "SELECT id,user_id,content,create_date FROM chat_xosome WHERE 1 ".$conditions." ".$ordering." LIMIT ".$limit."";

                $command = $connect->createCommand($sql);
                $data = $command->queryAll();

                $data = Common::multiSort($data,"id",2);        
                $users = array();
                $arr_user = array();
                foreach($data as $value){
                    $arr_user[] = $value["user_id"];
                    $max_id = $value["id"];
                }

                if($arr_user){
                    $users = Chat::getDataByArrId($arr_user);
                }

                foreach($data as $key=>$value){
                    $data[$key]["fullname"] = "";
                    if(isset($users[$value["user_id"]])){
                        if(!empty($users[$value["user_id"]]["fullname"])){
                            $data[$key]["fullname"] = $users[$value["user_id"]]["fullname"]; 
                        }else{
                            $data[$key]["fullname"] =  $users[$value["user_id"]]["username"];
                        }
                    }
                }
                $a = array($data,$max_id);

                Yii::app ()->cache->set ( $key_cache, $a, ConstantsUtil::TIME_CACHE_3600);
            }else{
                $a = $cache;
            }
            return $a;
        }

        public function getDataByArrId($arr_ids){
            $str_key = implode("_",$arr_ids);
            $str_id = implode(",",$arr_ids);
            $cacheService = new CacheService("User","getDataByArrId",$str_key);
            $key = $cacheService->createKey();
            $cache = Yii::app ()->cache->get($key); 
            $data = array(); 
            $cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){ 
                if($str_id !=""){
                    $sql = "SELECT * FROM chat_users WHERE id IN (".trim($str_id).") AND status=1";         
                    $connect = Yii::app()->db;
                    $command = $connect->createCommand($sql);
                    $rows = $command->queryAll();
                    foreach($rows as $row){
                        $data[$row["id"]] = $row;
                    }
                    Yii::app ()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_3600);
                }

            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataByUsername($username){
            $sql = "SELECT * FROM chat_users WHERE username = '".trim($username)."' ";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }
        
        public function getDataById($id){
            $sql = "SELECT * FROM chat_users WHERE id = '".intval($id)."' ";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }

    }



