<?php
    class Mobat extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }


        public function tableName() {                  
            return 'xs_mobat';
        }

        public function getCurrentData(){
            $cacheService = new CacheService("Mobat","getCurrentDataByProvinceId");
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache ); 
            $data = array(); 
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $sql = "SELECT * FROM xs_cau_dep WHERE bien_ngay ='".date('Y-m-d',time())."'";
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $key =>$value){
                    $data[$value['province_id']]['create_date'] = $value['create_date'];
                    if($value['type'] == 1){
                        $arr = json_decode($value['boso'],true);
                        $cs_loto ="";
                        $cau_id_cs_loto ="";
                        foreach($arr as $k =>$rs){
                            $cs_loto .= ",".$rs['boso'] ;
                            $cau_id_cs_loto .=",".$rs['cau_id'];
                        }
                        $data[$value['province_id']]['capso_loto'] = ltrim($cs_loto,",");
                        $data[$value['province_id']]['cau_id_capso_loto'] = ltrim($cau_id_cs_loto,",");
                    }
                    if($value['type'] == 2){
                        $arr = json_decode($value['boso'],true);
                        $cs_db_cham="";
                        $cau_id_cs_db_cham="";
                        foreach($arr as $k =>$rs){
                            $cs_db_cham.=",".$rs['boso'] ;
                            $cau_id_cs_db_cham .=",".$rs['cau_id'];
                        }
                        $data[$value['province_id']]['db_cham'] =ltrim($cs_db_cham,",");
                        $data[$value['province_id']]['cau_id_db_cham'] = ltrim($cau_id_cs_db_cham,",");
                    }

                    if($value['type'] == 3){
                        $arr = json_decode($value['boso'],true);
                        $cs_dacbiet = "";
                        $cau_id_cs_dacbiet = "";
                        foreach($arr as $k =>$rs){
                            $cs_dacbiet .= ",".$rs['boso'] ;
                            $cau_id_cs_dacbiet .=",".$rs['cau_id'];
                        }
                        $data[$value['province_id']]['capso_dacbiet'] = ltrim($cs_dacbiet,",");
                        $data[$value['province_id']]['cau_id_capso_dacbiet'] = ltrim($cau_id_cs_dacbiet,",");
                    }
                }
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }

        public function getDataByDateAndProvince($bien_ngay,$province_id,$maxRow){
            $cacheService = new CacheService("Mobat","getDataByDateAndProvince".$bien_ngay.$province_id,$maxRow);
            $key_cache = $cacheService->createKey();
            $cache = Yii::app ()->cache->get ( $key_cache );
            $data = array();
            $limit = $maxRow * 3;
            //$cache = false;
            if($cache == false || Yii::app()->params["cache_all"]==false){
                $str_where = "";
                if(!empty($bien_ngay)){
                    $str_where.= " AND bien_ngay ='".$bien_ngay."'";
                }

                $sql = "SELECT * FROM xs_cau_dep WHERE 1 ".$str_where." AND province_id = ".$province_id." ORDER BY id DESC LIMIT ".$limit;
                $connect = Yii::app()->db;
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                foreach($rows as $key =>$value){
                    $data[$value['bien_ngay']]['create_date'] = $value['create_date'];
                    if($value['type'] == 1){
                        $arr = json_decode($value['boso'],true);
                        $cs_loto ="";
                        $cau_id_cs_loto ="";
                        foreach($arr as $k =>$rs){
                            $cs_loto .= ",".$rs['boso'] ;
                            $cau_id_cs_loto .=",".$rs['cau_id'];
                        }
                        $data[$value['bien_ngay']]['capso_loto'] = ltrim($cs_loto,",");
                        $data[$value['bien_ngay']]['cau_id_capso_loto'] = ltrim($cau_id_cs_loto,",");
                    }
                    if($value['type'] == 2){
                        $arr = json_decode($value['boso'],true);
                        $cs_db_cham="";
                        $cau_id_cs_db_cham="";
                        foreach($arr as $k =>$rs){
                            $cs_db_cham.=",".$rs['boso'] ;
                            $cau_id_cs_db_cham .=",".$rs['cau_id'];
                        }
                        $data[$value['bien_ngay']]['db_cham'] =ltrim($cs_db_cham,",");
                        $data[$value['bien_ngay']]['cau_id_db_cham'] = ltrim($cau_id_cs_db_cham,",");
                    }

                    if($value['type'] == 3){
                        $arr = json_decode($value['boso'],true);
                        $cs_dacbiet = "";
                        $cau_id_cs_dacbiet = "";
                        foreach($arr as $k =>$rs){
                            $cs_dacbiet .= ",".$rs['boso'] ;
                            $cau_id_cs_dacbiet .=",".$rs['cau_id'];
                        }
                        $data[$value['bien_ngay']]['capso_dacbiet'] = ltrim($cs_dacbiet,",");
                        $data[$value['bien_ngay']]['cau_id_capso_dacbiet'] = ltrim($cau_id_cs_dacbiet,",");
                    }
                }
                Yii::app ()->cache->set ( $key_cache, $data, ConstantsUtil::TIME_CACHE_900);
            }else{
                $data = $cache;
            }
            return $data;
        }
        public function getResultByDate($table,$province_id,$str_bien_ngay){
            if($table == "ketqua_mienbac"){
              $str_where = " AND ngay_quay IN (".$str_bien_ngay.")";  
            }else{
                $str_where = " AND ngay_quay IN (".$str_bien_ngay.") AND province_id = ".$province_id;
            }
            
            $sql = "SELECT * FROM ".$table." WHERE 1 ".$str_where; 
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryAll();
            $data = array();
            foreach($rows as $key =>$value){
                $data[$value['ngay_quay']]= $value;
            }
            return $data;
        }

    }
