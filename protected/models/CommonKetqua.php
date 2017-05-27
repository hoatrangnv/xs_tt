<?php
    class CommonKetqua extends CActiveRecord{
        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function UpdateKetquaMB($ngay_quay,$row_update,$connect,$table){  
            $sql = "SELECT id FROM ".$table." WHERE ngay_quay = '".trim($ngay_quay)."' ";
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();
            if(!$row){
                $data_insert = array(
                    "ngay_quay"=>array("value"=>$ngay_quay,"type"=>2),
                    "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                    "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                    "giai_nhi_1"=>array("value"=>$row_update["giai_nhi_1"],"type"=>2),
                    "giai_nhi_2"=>array("value"=>$row_update["giai_nhi_2"],"type"=>2),
                    "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                    "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                    "giai_ba_3"=>array("value"=>$row_update["giai_ba_3"],"type"=>2),
                    "giai_ba_4"=>array("value"=>$row_update["giai_ba_4"],"type"=>2),
                    "giai_ba_5"=>array("value"=>$row_update["giai_ba_5"],"type"=>2),
                    "giai_ba_6"=>array("value"=>$row_update["giai_ba_6"],"type"=>2),
                    "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                    "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                    "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                    "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                    "giai_nam_1"=>array("value"=>$row_update["giai_nam_1"],"type"=>2),
                    "giai_nam_2"=>array("value"=>$row_update["giai_nam_2"],"type"=>2),
                    "giai_nam_3"=>array("value"=>$row_update["giai_nam_3"],"type"=>2),
                    "giai_nam_4"=>array("value"=>$row_update["giai_nam_4"],"type"=>2),
                    "giai_nam_5"=>array("value"=>$row_update["giai_nam_5"],"type"=>2),
                    "giai_nam_6"=>array("value"=>$row_update["giai_nam_6"],"type"=>2),
                    "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                    "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                    "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                    "giai_bay_1"=>array("value"=>$row_update["giai_bay_1"],"type"=>2),
                    "giai_bay_2"=>array("value"=>$row_update["giai_bay_2"],"type"=>2),
                    "giai_bay_3"=>array("value"=>$row_update["giai_bay_3"],"type"=>2),
                    "giai_bay_4"=>array("value"=>$row_update["giai_bay_4"],"type"=>2),
                    "create_user"=>array("value"=>"Admin veso","type"=>2),
                    "create_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                ); 
                $last_id = CommonDB::insertRowOther($connect,$table,$data_insert);
            }else{
                $data_update = array(
                    "id"=>array("value"=>$row["id"],"type"=>1),
                    "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                    "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                    "giai_nhi_1"=>array("value"=>$row_update["giai_nhi_1"],"type"=>2),
                    "giai_nhi_2"=>array("value"=>$row_update["giai_nhi_2"],"type"=>2),
                    "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                    "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                    "giai_ba_3"=>array("value"=>$row_update["giai_ba_3"],"type"=>2),
                    "giai_ba_4"=>array("value"=>$row_update["giai_ba_4"],"type"=>2),
                    "giai_ba_5"=>array("value"=>$row_update["giai_ba_5"],"type"=>2),
                    "giai_ba_6"=>array("value"=>$row_update["giai_ba_6"],"type"=>2),
                    "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                    "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                    "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                    "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                    "giai_nam_1"=>array("value"=>$row_update["giai_nam_1"],"type"=>2),
                    "giai_nam_2"=>array("value"=>$row_update["giai_nam_2"],"type"=>2),
                    "giai_nam_3"=>array("value"=>$row_update["giai_nam_3"],"type"=>2),
                    "giai_nam_4"=>array("value"=>$row_update["giai_nam_4"],"type"=>2),
                    "giai_nam_5"=>array("value"=>$row_update["giai_nam_5"],"type"=>2),
                    "giai_nam_6"=>array("value"=>$row_update["giai_nam_6"],"type"=>2),
                    "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                    "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                    "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                    "giai_bay_1"=>array("value"=>$row_update["giai_bay_1"],"type"=>2),
                    "giai_bay_2"=>array("value"=>$row_update["giai_bay_2"],"type"=>2),
                    "giai_bay_3"=>array("value"=>$row_update["giai_bay_3"],"type"=>2),
                    "giai_bay_4"=>array("value"=>$row_update["giai_bay_4"],"type"=>2),
                    "modify_user"=>array("value"=>"Admin veso","type"=>2),
                    "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                ); 
                $result = CommonDB::updateRowOther($connect,$table,$data_update,array("id"));
                $last_id = $row["id"];
            }  
            return 2;
        }

        public function UpdateKetquaMBById($id,$row_update){
            $data_update = array(
                "id"=>array("value"=>$id,"type"=>1),
                "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                "giai_nhi_1"=>array("value"=>$row_update["giai_nhi_1"],"type"=>2),
                "giai_nhi_2"=>array("value"=>$row_update["giai_nhi_2"],"type"=>2),
                "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                "giai_ba_3"=>array("value"=>$row_update["giai_ba_3"],"type"=>2),
                "giai_ba_4"=>array("value"=>$row_update["giai_ba_4"],"type"=>2),
                "giai_ba_5"=>array("value"=>$row_update["giai_ba_5"],"type"=>2),
                "giai_ba_6"=>array("value"=>$row_update["giai_ba_6"],"type"=>2),
                "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                "giai_nam_1"=>array("value"=>$row_update["giai_nam_1"],"type"=>2),
                "giai_nam_2"=>array("value"=>$row_update["giai_nam_2"],"type"=>2),
                "giai_nam_3"=>array("value"=>$row_update["giai_nam_3"],"type"=>2),
                "giai_nam_4"=>array("value"=>$row_update["giai_nam_4"],"type"=>2),
                "giai_nam_5"=>array("value"=>$row_update["giai_nam_5"],"type"=>2),
                "giai_nam_6"=>array("value"=>$row_update["giai_nam_6"],"type"=>2),
                "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                "giai_bay_1"=>array("value"=>$row_update["giai_bay_1"],"type"=>2),
                "giai_bay_2"=>array("value"=>$row_update["giai_bay_2"],"type"=>2),
                "giai_bay_3"=>array("value"=>$row_update["giai_bay_3"],"type"=>2),
                "giai_bay_4"=>array("value"=>$row_update["giai_bay_4"],"type"=>2),
                "modify_user"=>array("value"=>"Admin veso","type"=>2),
                "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
            ); 
            $result = CommonDB::updateRow("ketqua_mienbac",$data_update,array("id"));
            return $result;
        }

        public function UpdateKetquaMN($province_id,$ngay_quay,$row_update,$connect,$table){
            $sql = "SELECT id FROM ".$table." WHERE ngay_quay = '".trim($ngay_quay)."' AND province_id = ".intval($province_id)." ";
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();

            if(!$row){
                $data_insert = array(
                    "province_id"=>array("value"=>$province_id,"type"=>1),
                    "ngay_quay"=>array("value"=>$ngay_quay,"type"=>2),
                    "giai_tam"=>array("value"=>$row_update["giai_tam"],"type"=>1),
                    "giai_bay"=>array("value"=>$row_update["giai_bay"],"type"=>2),
                    "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                    "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                    "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                    "giai_nam"=>array("value"=>$row_update["giai_nam"],"type"=>2),
                    "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                    "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                    "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                    "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                    "giai_tu_5"=>array("value"=>$row_update["giai_tu_5"],"type"=>2),
                    "giai_tu_6"=>array("value"=>$row_update["giai_tu_6"],"type"=>2),
                    "giai_tu_7"=>array("value"=>$row_update["giai_tu_7"],"type"=>2),
                    "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                    "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                    "giai_nhi"=>array("value"=>$row_update["giai_nhi"],"type"=>2),
                    "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                    "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                    "create_user"=>array("value"=>"Admin veso","type"=>2),
                    "create_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                ); 
                $last_id = CommonDB::insertRowOther($connect,$table,$data_insert);
            }else{
                $data_update = array(
                    "id"=>array("value"=>$row["id"],"type"=>1),
                    "province_id"=>array("value"=>$province_id,"type"=>1),
                    "giai_tam"=>array("value"=>$row_update["giai_tam"],"type"=>1),
                    "giai_bay"=>array("value"=>$row_update["giai_bay"],"type"=>2),
                    "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                    "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                    "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                    "giai_nam"=>array("value"=>$row_update["giai_nam"],"type"=>2),
                    "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                    "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                    "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                    "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                    "giai_tu_5"=>array("value"=>$row_update["giai_tu_5"],"type"=>2),
                    "giai_tu_6"=>array("value"=>$row_update["giai_tu_6"],"type"=>2),
                    "giai_tu_7"=>array("value"=>$row_update["giai_tu_7"],"type"=>2),
                    "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                    "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                    "giai_nhi"=>array("value"=>$row_update["giai_nhi"],"type"=>2),
                    "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                    "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                    "modify_user"=>array("value"=>"Admin veso","type"=>2),
                    "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $result = CommonDB::updateRowOther($connect,$table,$data_update,array("id"));
                $last_id = $row["id"];
            }
            return 2;
        }

        public function UpdateKetquaMNById($id,$row_update){
            $data_update = array(
                "id"=>array("value"=>$id,"type"=>1),
                "giai_tam"=>array("value"=>$row_update["giai_tam"],"type"=>2),
                "giai_bay"=>array("value"=>$row_update["giai_bay"],"type"=>2),
                "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                "giai_nam"=>array("value"=>$row_update["giai_nam"],"type"=>2),
                "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                "giai_tu_5"=>array("value"=>$row_update["giai_tu_5"],"type"=>2),
                "giai_tu_6"=>array("value"=>$row_update["giai_tu_6"],"type"=>2),
                "giai_tu_7"=>array("value"=>$row_update["giai_tu_7"],"type"=>2),
                "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                "giai_nhi"=>array("value"=>$row_update["giai_nhi"],"type"=>2),
                "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                "modify_user"=>array("value"=>"Admin veso","type"=>2),
                "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
            );    
            $result = CommonDB::updateRow("ketqua_miennam",$data_update,array("id"));
            return $result;
        }

        public function UpdateKetquaMT($province_id,$ngay_quay,$row_update,$connect,$table){ 
            $sql = "SELECT id FROM ".$table." WHERE ngay_quay = '".trim($ngay_quay)."' AND province_id = ".intval($province_id)." ";
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();
            if(!$row){
                $data_insert = array(
                    "province_id"=>array("value"=>$province_id,"type"=>1),
                    "ngay_quay"=>array("value"=>$ngay_quay,"type"=>2),
                    "giai_tam"=>array("value"=>$row_update["giai_tam"],"type"=>1),
                    "giai_bay"=>array("value"=>$row_update["giai_bay"],"type"=>2),
                    "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                    "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                    "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                    "giai_nam"=>array("value"=>$row_update["giai_nam"],"type"=>2),
                    "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                    "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                    "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                    "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                    "giai_tu_5"=>array("value"=>$row_update["giai_tu_5"],"type"=>2),
                    "giai_tu_6"=>array("value"=>$row_update["giai_tu_6"],"type"=>2),
                    "giai_tu_7"=>array("value"=>$row_update["giai_tu_7"],"type"=>2),
                    "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                    "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                    "giai_nhi"=>array("value"=>$row_update["giai_nhi"],"type"=>2),
                    "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                    "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                    "create_user"=>array("value"=>"Admin veso","type"=>2),
                    "create_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                ); 
                $last_id = CommonDB::insertRowOther($connect,$table,$data_insert);
            }else{
                $data_update = array(
                    "id"=>array("value"=>$row["id"],"type"=>1),
                    "province_id"=>array("value"=>$province_id,"type"=>1),
                    "giai_tam"=>array("value"=>$row_update["giai_tam"],"type"=>1),
                    "giai_bay"=>array("value"=>$row_update["giai_bay"],"type"=>2),
                    "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                    "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                    "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                    "giai_nam"=>array("value"=>$row_update["giai_nam"],"type"=>2),
                    "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                    "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                    "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                    "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                    "giai_tu_5"=>array("value"=>$row_update["giai_tu_5"],"type"=>2),
                    "giai_tu_6"=>array("value"=>$row_update["giai_tu_6"],"type"=>2),
                    "giai_tu_7"=>array("value"=>$row_update["giai_tu_7"],"type"=>2),
                    "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                    "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                    "giai_nhi"=>array("value"=>$row_update["giai_nhi"],"type"=>2),
                    "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                    "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                    "modify_user"=>array("value"=>"Admin veso","type"=>2),
                    "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $result = CommonDB::updateRowOther($connect,$table,$data_update,array("id"));
                $last_id = $row["id"];
            }
            return 2;
        }

        public function UpdateKetquaMTById($id,$row_update){
            $data_update = array(
                "id"=>array("value"=>$id,"type"=>1),
                "giai_tam"=>array("value"=>$row_update["giai_tam"],"type"=>1),
                "giai_bay"=>array("value"=>$row_update["giai_bay"],"type"=>2),
                "giai_sau_1"=>array("value"=>$row_update["giai_sau_1"],"type"=>2),
                "giai_sau_2"=>array("value"=>$row_update["giai_sau_2"],"type"=>2),
                "giai_sau_3"=>array("value"=>$row_update["giai_sau_3"],"type"=>2),
                "giai_nam"=>array("value"=>$row_update["giai_nam"],"type"=>2),
                "giai_tu_1"=>array("value"=>$row_update["giai_tu_1"],"type"=>2),
                "giai_tu_2"=>array("value"=>$row_update["giai_tu_2"],"type"=>2),
                "giai_tu_3"=>array("value"=>$row_update["giai_tu_3"],"type"=>2),
                "giai_tu_4"=>array("value"=>$row_update["giai_tu_4"],"type"=>2),
                "giai_tu_5"=>array("value"=>$row_update["giai_tu_5"],"type"=>2),
                "giai_tu_6"=>array("value"=>$row_update["giai_tu_6"],"type"=>2),
                "giai_tu_7"=>array("value"=>$row_update["giai_tu_7"],"type"=>2),
                "giai_ba_1"=>array("value"=>$row_update["giai_ba_1"],"type"=>2),
                "giai_ba_2"=>array("value"=>$row_update["giai_ba_2"],"type"=>2),
                "giai_nhi"=>array("value"=>$row_update["giai_nhi"],"type"=>2),
                "giai_nhat"=>array("value"=>$row_update["giai_nhat"],"type"=>2),
                "giai_dacbiet"=>array("value"=>$row_update["giai_dacbiet"],"type"=>2),
                "modify_user"=>array("value"=>"Admin veso","type"=>2),
                "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
            );     
            $result = CommonDB::updateRow("ketqua_mientrung",$data_update,array("id"));
        }

        public function UpdateKetquaDientoan123($ngay_quay,$row_update){
            $sql = "SELECT id FROM ketqua_dientoan123 WHERE ngay_quay = '".trim($ngay_quay)."'";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();
            if(!$row){
                $data_insert = array(
                    "ngay_quay"=>array("value"=>$ngay_quay,"type"=>2),
                    "ketqua_1"=>array("value"=>$row_update["ketqua_1"],"type"=>2),
                    "ketqua_2"=>array("value"=>$row_update["ketqua_2"],"type"=>2),
                    "ketqua_3"=>array("value"=>$row_update["ketqua_3"],"type"=>2),
                    "create_user"=>array("value"=>"Admin veso","type"=>2),
                    "create_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $last_id = CommonDB::insertRow("ketqua_dientoan123",$data_insert);
            }else{
                $data_update = array(
                    "id"=>array("value"=>$row["id"],"type"=>1),
                    "ketqua_1"=>array("value"=>$row_update["ketqua_1"],"type"=>2),
                    "ketqua_2"=>array("value"=>$row_update["ketqua_2"],"type"=>2),
                    "ketqua_3"=>array("value"=>$row_update["ketqua_3"],"type"=>2),
                    "modify_user"=>array("value"=>"Admin veso","type"=>2),
                    "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $result = CommonDB::updateRow("ketqua_dientoan123",$data_update,array("id"));
                $last_id = $row["id"];
            }
            return $last_id;
        }

        public function UpdateKetquaDientoan6x36($ngay_quay,$row_update){
            $sql = "SELECT id FROM ketqua_dientoan6x36 WHERE ngay_quay = '".trim($ngay_quay)."'";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();
            if(!$row){
                $data_insert = array(
                    "ngay_quay"=>array("value"=>$ngay_quay,"type"=>2),
                    "ketqua_1"=>array("value"=>$row_update["ketqua_1"],"type"=>2),
                    "ketqua_2"=>array("value"=>$row_update["ketqua_2"],"type"=>2),
                    "ketqua_3"=>array("value"=>$row_update["ketqua_3"],"type"=>2),
                    "ketqua_4"=>array("value"=>$row_update["ketqua_4"],"type"=>2),
                    "ketqua_5"=>array("value"=>$row_update["ketqua_5"],"type"=>2),
                    "ketqua_6"=>array("value"=>$row_update["ketqua_6"],"type"=>2),
                    "create_user"=>array("value"=>"Admin veso","type"=>2),
                    "create_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $last_id = CommonDB::insertRow("ketqua_dientoan6x36",$data_insert);
            }else{
                $data_update = array(
                    "id"=>array("value"=>$row["id"],"type"=>1),
                    "ketqua_1"=>array("value"=>$row_update["ketqua_1"],"type"=>2),
                    "ketqua_2"=>array("value"=>$row_update["ketqua_2"],"type"=>2),
                    "ketqua_3"=>array("value"=>$row_update["ketqua_3"],"type"=>2),
                    "ketqua_4"=>array("value"=>$row_update["ketqua_4"],"type"=>2),
                    "ketqua_5"=>array("value"=>$row_update["ketqua_5"],"type"=>2),
                    "ketqua_6"=>array("value"=>$row_update["ketqua_6"],"type"=>2),
                    "modify_user"=>array("value"=>"Admin veso","type"=>2),
                    "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $result = CommonDB::updateRow("ketqua_dientoan6x36",$data_update,array("id"));
                $last_id = $row["id"];
            }
            return $last_id;
        }

        public function UpdateKetquaThantai($ngay_quay,$row_update){
            $sql = "SELECT id FROM ketqua_thantai WHERE ngay_quay = '".trim($ngay_quay)."'";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $row = $command->queryRow();
            if(!$row){
                $data_insert = array(
                    "ngay_quay"=>array("value"=>$ngay_quay,"type"=>2),
                    "ketqua"=>array("value"=>$row_update["ketqua"],"type"=>2),
                    "create_user"=>array("value"=>"Admin veso","type"=>2),
                    "create_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $last_id = CommonDB::insertRow("ketqua_thantai",$data_insert);
            }else{
                $data_update = array(
                    "id"=>array("value"=>$row["id"],"type"=>1),
                    "ketqua"=>array("value"=>$row_update["ketqua"],"type"=>2),
                    "modify_user"=>array("value"=>"Admin veso","type"=>2),
                    "modify_date"=>array("value"=>date("Y-m-d H:i:s",time()),"type"=>2),
                );
                $result = CommonDB::updateRow("ketqua_thantai",$data_update,array("id"));
                $last_id = $row["id"];
            }
            return $last_id;
        }
    }
