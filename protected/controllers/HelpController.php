<?php
    class HelpController extends Controller{
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url;
        public $provinces = null;
        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $provinces = array(1=>array("name"=>"Miền bắc","id"=>1,"region"=>1,"alias"=>"mien-bac"));
            $all_province = Provinces::getAllData(1);
            foreach($all_province as $value){
                if($value["region"] !=1){
                    $provinces[$value["id"]] = $value;
                }
            }
            $this->provinces = $provinces;
        }

        public function actionIndex(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("help/index"),"title"=>"Trang hỗ trợ");
            $this->metaDescription = "Trang trợ giúp, hỗ trợ thành viên xosothantai.vn . xosothantai.vn - Trang web cập nhật kết quả xổ số miền bắc, trung , nam nhanh nhất Việt Nam";
            $this->metaKeywords = "tro giup, thanh vien, ket qua xo so, ket qua ve so";
            $this->metaTitles = "Trang trợ giúp, hỗ trợ thành viên xosothantai.vn";               
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("help/index");
            $this->render("index",array());
        }

        public function actionDoithuong(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionNhankq(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionSoicau(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionLuatlo(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionLuatdo(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionLuatxien(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionHuongdanchoi(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionNaptien(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionBanggia(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionHuongdanin(){
            $this->redirect(Url::createUrl("help/index"));
        }
        public function actionBangMaTinh(){
            $this->redirect(Url::createUrl("home/calendar"));
        }

        public function actionDudoanKq(){
            $this->redirect(Url::createUrl("help/index"));
        }

        public function actionTicket(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("help/ticket"),"title"=>"Nhận sổ kết quả");
            $this->metaDescription = "Nhan so ket qua, ticket chinh xac nhat tu xosothantai.vn";
            $this->metaKeywords = "nhan so ket qua, ticket";
            $this->metaTitles = "Trang nhan so ket qua, ticket";               
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("help/ticket");
            $provinces = $this->provinces;
            $this->render("ticket",array("provinces"=>$provinces));
        }
        
        public function actionAjaxTicket(){
            $provinces = $this->provinces;
            $fullname = isset($_POST["fullname"]) ? Common::cleanQuery($_POST["fullname"]):"";
            $mobile = isset($_POST["mobile"]) ? Common::cleanQuery($_POST["mobile"]):"";
            $address = isset($_POST["address"]) ? Common::cleanQuery($_POST["address"]):"";
            $province_id = isset($_POST["province_id"]) ? intval($_POST["province_id"]):1;
            $type = isset($_POST["type"]) ? intval($_POST["type"]):1;
            $amount = isset($_POST["amount"]) ? intval($_POST["amount"]):1;
            $code = isset($_POST["code"]) ? trim($_POST["code"]):"";
            $session_code = (isset($_SESSION['secure_code']))? $_SESSION['secure_code'] : "";
            if($session_code != $code){   echo "Bạn nhập sai mã an toàn";exit; }
            if(empty($fullname)){
                echo '<p>- Bạn chưa nhập họ tên</p>';exit;
            }
            if(empty($mobile)){
                echo '<p>- Bạn chưa nhập số điện thoại</p>';exit;
            }
            if(!isset($provinces[$province_id])){
                echo '<p>- Không tồn tại tỉnh thành này</p>';exit;
            }
            if($amount <=0){
                echo '<p>- Số lượng phải lớn hơn 0</p>';exit;
            }
            
            $data_insert = array(
                 "fullname"=>array("value"=>$fullname,"type"=>2),
                 "mobile"=>array("value"=>$mobile,"type"=>2),
                 "address"=>array("value"=>$address,"type"=>2),
                 "province_id"=>array("value"=>$province_id,"type"=>1),
                 "province_name"=>array("value"=>$provinces[$province_id]["name"],"type"=>2),
                 "type"=>array("value"=>$type,"type"=>1),
                 "amount"=>array("value"=>$amount,"type"=>1),
                 "create_date"=>array("value"=>time(),"type"=>1),
            );
            $result = CommonDB::insertRow("ticket_ketqua",$data_insert);
            if($result >0){
                echo 1;
            }else{
                echo '<p>- Yêu cầu chưa xác nhận. Vui lòng thử lại</p>';exit;
            }
        }

    }
