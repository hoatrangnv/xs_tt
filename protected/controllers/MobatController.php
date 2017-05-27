<?php
    class MobatController extends Controller{

        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $this->breadcrumbs[] = array("link"=>Url::createUrl("mobat/index"),"title"=>"Số thần tài");
//            if(!isset($_SESSION['mobile_xstt'])){
//                $this->redirect(Url::createUrl("login/index"));
//            }
        }
        public function actionIndex(){
            $wday = date('w')+1;
            if($wday == 1) $wday = 8;
            $data = Provinces::getDataByWday($wday);
            $result = Mobat::getCurrentData();
            $this->render("index",array("data"=>$data,"result"=>$result));
        }

        public function actionHistory(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("mobat/history"),"title"=>"Lịch sử số thần tài");
            $province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) :1;
            $bien_ngay = isset($_GET['bien_ngay']) ? mysql_escape_string(trim($_GET['bien_ngay'])) :"";
            $maxRow = isset($_GET['maxRow']) ? intval($_GET['maxRow']) :5;

            if($maxRow <0) $maxRow = 1;
            if($maxRow >30) $maxRow = 30;
            $row = Provinces::getDataById($province_id);
            $provinceName = $row['name'];
            $region = $row['region'];

            if($region == 1){
                $table = "ketqua_mienbac";
            }else if($region == 2){
                $table = "ketqua_mientrung";
            }else  if($region == 3){
                $table = "ketqua_miennam";
            }
            $listProvince = Provinces::getListProvince();
            $result = Mobat::getDataByDateAndProvince($bien_ngay,$province_id,$maxRow);
            
            $str_bien_ngay = "";
            foreach($result as $key =>$value){
                $str_bien_ngay.=",'".$key."'";
            }
                 
            $str_bien_ngay = ltrim($str_bien_ngay,",");
            $data = Mobat::getResultByDate($table,$province_id,$str_bien_ngay);

            $this->render("history",array("listProvince"=>$listProvince,"result"=>$result,"province_id"=>$province_id,"bien_ngay"=>$bien_ngay,"provinceName"=>$provinceName,"region"=>$region,"data"=>$data));
        }

    }
