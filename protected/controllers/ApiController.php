<?php
    class ApiController extends Controller{

        public function actionGenPassword(){
            $mobile = isset($_GET['mobile']) ? mysql_escape_string($_GET['mobile']) : "";
            if (!empty($mobile)) {
                $data = User::getDataByMobile($mobile);
//                if ($data == false) {
//                    $output['password'] = rand(10000, 99999);
//                    $pckcode = "xs7";
//                    $expired_date = date("d/m/Y",time()+604800);
//                    $channel_type = "sms";
//                    $cstatus = 1;
//                    $reqtype = 0;
//                    $table = "user_veso";
//                    $data = array(
//                        "mobile"=>array("value"=>$mobile,"type"=>2),
//                        "password"=>array("value"=>$output['password'],"type"=>2),
//                        "pckcode"=>array("value"=>$pckcode,"type"=>2),
//                        "channel_type"=>array("value"=>$channel_type,"type"=>2),
//                        "cstatus"=>array("value"=>$cstatus,"type"=>1),
//                        "reqtype"=>array("value"=>$reqtype,"type"=>1),
//                        "expired_date"=>array("value"=>$expired_date,"type"=>2),
//                    );
//                    $result = CommonDB::insertRow($table,$data);
//                    if($result>0){
//                        echo $output['password'];
//                    }else{
//                        echo "0|Lỗi tạo tài khoản mới";
//                    }
//                    echo json_encode($output);exit(0);
//                }
                echo $data['password'];
            }
        }
        public function actionSubscriberNotify(){
            $mobile = isset($_GET['mobile']) ? mysql_escape_string($_GET['mobile']) : "";
            $pckcode = isset($_GET['pckcode']) ? mysql_escape_string($_GET['pckcode']) : "xs7";
            $expired_date = isset($_GET['expired']) ? mysql_escape_string($_GET['expired']) : date("d/m/Y",time()+604800);
            $channel_type = isset($_GET['type']) ? mysql_escape_string($_GET['type']) : "sms";
            $cstatus = isset($_GET['cstatus']) ? mysql_escape_string($_GET['cstatus']) :1;
            $reqtype = isset($_GET['reqtype']) ? mysql_escape_string($_GET['reqtype']) : 0;
            $table = "user_veso";
            $check = User::getDataByMobile($mobile);
            if ($check == false) {
                $password = rand(10000, 99999);
                $data = array(
                    "mobile"=>array("value"=>$mobile,"type"=>2),
                    "password"=>array("value"=>$password,"type"=>2),
                    "pckcode"=>array("value"=>$pckcode,"type"=>2),
                    "channel_type"=>array("value"=>$channel_type,"type"=>2),
                    "cstatus"=>array("value"=>$cstatus,"type"=>1),
                    "reqtype"=>array("value"=>$reqtype,"type"=>1),
                    "expired_date"=>array("value"=>$expired_date,"type"=>2),
                );
                $result = CommonDB::insertRow($table,$data);
            }else{
                $data = array(
                    "mobile"=>array("value"=>$mobile,"type"=>2),
                    "pckcode"=>array("value"=>$pckcode,"type"=>2),
                    "channel_type"=>array("value"=>$channel_type,"type"=>2),
                    "cstatus"=>array("value"=>$cstatus,"type"=>1),
                    "reqtype"=>array("value"=>$reqtype,"type"=>1),
                    "expired_date"=>array("value"=>$expired_date,"type"=>2),
                );
                $result = CommonDB::updateRow($table,$data,array("mobile"));
            }

            if($result>0){
                echo "1|Update thành công";
            }else{
                echo "0|Update không thành công";
            }
        }
        public function actionConfirmDaily(){
            $mobile = isset($_GET['mobile']) ? mysql_escape_string($_GET['mobile']) : "";
            $info = isset($_GET['info']) ? mysql_escape_string($_GET['info']) : "";
            $receive_sms = isset($_GET['status']) ? intval($_GET['status']) : 0;
            if($receive_sms >1 || $receive_sms < 0) $receive_sms = 0;
            $table = "user_veso";
            $data = array(
                "mobile"=>array("value"=>$mobile,"type"=>2),
                "receive_sms"=>array("value"=>$receive_sms,"type"=>1),
            );
            $result = CommonDB::updateRow($table,$data,array("mobile"));

            if($result>0){
                echo "1|Update thành công";
            }else{
                echo "0|Update không thành công";
            }
        }

    }
