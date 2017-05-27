<?php
    class LoginController extends Controller{

        public function init(){

        }
        public function actionIndex(){
            $this->layout ="login";

            $user_remember = "";
            $pass_remember = "";
            if(isset($_COOKIE["loginAuth"])){
                parse_str($_COOKIE["loginAuth"]);
            }
            $error = "";

            if(isset($_POST["mobile"]) && isset($_POST["password"])){
                $error .= (empty($_POST["mobile"]) || empty($_POST["password"])) ? "Tên đăng nhập hoặc mật khẩu không đúng" : "";
                $remember = isset($_POST["remember"]) ? 1 : 0;
                if(empty($error)) {
                    $mobile = trim(strip_tags($_POST["mobile"]));
                    $password = trim(strip_tags($_POST["password"]));

                    $data["password"] = mysql_escape_string($password);
                    $data["mobile"] = mysql_escape_string($mobile);
                    $result = User::findUserLogin($data);
                    if($result == false){
                        $error .= "Tên đăng nhập hoặc mật khẩu không đúng";
                    } else {
                        if($result["status"]==0){
                            $error .= "Tài khoản đã bị khóa";
                        } else if ($result["status"]==2){
                            $error .= "Tài khoản chưa được kích hoạt";
                        } else {
                            $_SESSION["mobile_xstt"] = $result["mobile"];
                            $_SESSION["remember"] = $remember;
                            if($remember==1){
                                $cookie_time = 20 * 365 * 24 * 60 * 60;
                                setcookie("loginAuth", 'user_remember=' . $result["mobile"] . '&pass_remember=' . $password, time() + $cookie_time, "/");
                            }
                            $this->redirect(Url::createUrl("home/index"));
                        }
                    }
                }
            }
            return $this->render("index",array("error"=>$error, "user_remember"=>$user_remember, "pass_remember"=>$pass_remember));
        }

        public function actionRegister(){
            $this->layout ="login";
            return $this->render("register");
        }

        public function actionCallback(){
            $mobile = isset($_GET["mobile"]) ? $_GET["mobile"] : "";

            $data = User::getDataByMobile($mobile);
            $table = "user_veso";
            $password = rand(10000,99999);
            if($data != false){
                if($data['cstatus'] != 1){
                    $data = array(
                        "mobile"=>array("value"=>$mobile,"type"=>2),
                        "cstatus"=>array("value"=>1,"type"=>1)
                    );
                    CommonDB::updateRow($table,$data,array("mobile"));
                    echo "2-".$data['mobile']."-".$data['password'];exit(0);

                }else{
                    echo "1-".$data['mobile']."-".$data['password'];exit(0);
                }
            }else{
                $pckcode = "xs7";
                $expired_date = date("d/m/Y",time()+604800);
                $channel_type = "sms";
                $cstatus = 1;
                $reqtype = 0;
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
                if($result > 0){
                    echo "3-".$mobile."-".$password;exit(0);
                }
            }
        }

        public function actionMobifone(){
            $sp_id = isset($_GET["sp_id"]) ? $_GET["sp_id"] : 0;
            $link = isset($_GET["link"]) ? $_GET["link"] : "";
            $key = "SincRqw0FvjUzsMT";
            $giaima= $this->aes128_ecb_decrypt("$key",base64_decode($link),"");
            $arr = explode("&",$giaima);
            $callback_url = str_replace(array('[',']')," ",$arr[3]);
            $callback_url = trim($callback_url," ");
            $this->redirect($callback_url);exit;
//            $respond = Common::curl($callback_url);
//            echo $respond;exit(0);
        }

        public function actionAjaxRegister(){
            $mobile = isset($_POST["mobile"]) ? $_POST["mobile"] : "";
            $clientTransId = isset($_POST["clientTransId"]) ? $_POST["clientTransId"] : 0;
            $packageCode = isset($_POST["packageCode"]) ? $_POST["packageCode"] : 0;
            $price = isset($_POST["price"]) ? $_POST["price"] : 0;
            $callBackUrl = isset($_POST["callBackUrl"]) ? $_POST["callBackUrl"] : "";

            $key = "SincRqw0FvjUzsMT";
            $text = "[".$clientTransId."]&[".$packageCode."]&[".$price."]&[".$callBackUrl."]";
            $link = base64_encode($this->aes128_ecb_encrypt("$key","$text",""));
            $url_confirm = "http://localhost/xosothantai/login/mobifone?sp_id=1&link=".$link;
            $respond = Common::curl($url_confirm);
            if(!empty($respond)){
                $_SESSION["mobile_xstt"] = $mobile;
            }
            echo $respond;die;
        }

//        public function actionRegister(){
//            $this->layout ="login_layout";
//
//            $data = array();
//            $error = "";
//            if(isset($_POST["mobile"])){
//                $data["mobile"] = trim(strip_tags($_POST["mobile"]));
//                $data["password"] = trim(strip_tags($_POST["password"]));
//                $data["password_retype"] = trim(strip_tags($_POST["password_retype"]));
//
//                if(empty($data["mobile"])){
//                    $error .= "<p>- Số điện thoại không thể rỗng</p>";
//                }
//
//                $error .= empty($data["password"]) ? "<p>- Mật khẩu không thể rỗng.</p>" : "";
//                $error .= empty($data["password_retype"]) ? "<p>- Mật khẩu xác nhận không thể rỗng.</p>" : "";
//                if(!empty($data["password"]) && !empty($data["password_retype"])){
//                    if($data["password_retype"] != $data["password"]){
//                        $error .= "<p>- Hai mật khẩu không trùng khớp</p>";
//                    }
//                }
//
//                $checkmobile = User::checkMobile($data['mobile']);
//                $error .= $checkmobile > 0 ? "<p>- Số điện thoại đã tồn tại</p>" : "";
//
//                /* check catpcha */
//                $code = trim(strip_tags($_POST["code"]));
//                $code_security = isset($_SESSION["code_security"]) ? $_SESSION["code_security"] : "";
//                if(empty($code)){
//                    $error .= "<p>- Bạn chưa nhập mã xác nhận</p>";
//                } else {
//                    $error .= $code!=$code_security ? "<p>- Bạn nhập mã xác thực không đúng</p>" : "";
//                }
//
//                if(empty($error)){
//
//                    $data["create_date"] = date('Y-m-d H:i:s');
//
//                    /* Insert vào db */
//                    unset($data["password_retype"]);
//                    $table = "user_veso";
//                    $data = array(
//                        "mobile"=>array("value"=>$data["mobile"],"type"=>2),
//                        "password"=>array("value"=>$data["password"],"type"=>2),
//                        "status"=>array("value"=>1,"type"=>1),
//                        "create_date"=>array("value"=>$data["create_date"],"type"=>2),
//                    );
//                    $result = CommonDB::insertRow($table,$data);
//                    if($result > 0){
//                        $_SESSION['mobile']   = $data["mobile"];
//                        $this->redirect(Url::createUrl("home/index"));
//                    }
//                }
//            }
//            return $this->render("register",array("error"=>$error, "data"=>$data));
//
//        }

        public function actionLogout()
        {

            if(isset($_SESSION["mobile_xstt"])){
                setcookie("loginAuth", '', 0, "/");
                unset($_SESSION["mobile_xstt"]);
            }
            if($_SERVER["HTTP_HOST"] !="localhost"){
                $this->redirect(Url::createUrl("home/index"));
            }else{
                $this->redirect(Url::createUrl("home/index"));
            }
        }

        function aes128_ecb_encrypt($key, $data, $iv) {
            if(16 !== strlen($key)) $key = hash('MD5', $key, true);
            if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
            $padding = 16 - (strlen($data) % 16);
            $data .= str_repeat(chr($padding), $padding);
            return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, $iv);
        }
        function aes256_ecb_encrypt($key, $data, $iv) {
            if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
            if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
            $padding = 16 - (strlen($data) % 16);
            $data .= str_repeat(chr($padding), $padding);
            return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, $iv);
        }
        function aes128_ecb_decrypt($key, $data, $iv) {
            if(16 !== strlen($key)) $key = hash('MD5', $key, true);
            if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
            $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, $iv);
            $padding = ord($data[strlen($data) - 1]);
            return substr($data, 0, -$padding);
        }
        function aes256_ecb_decrypt($key, $data, $iv) {
            if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
            if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
            $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, $iv);
            $padding = ord($data[strlen($data) - 1]);
            return substr($data, 0, -$padding);
        }

    }
