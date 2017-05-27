<?php
    class ChatController extends Controller{

        public function actionLoadChat(){
            $limit = 10;
            $max_id = 0;
            list($data,$max_id) = Chat::getDataByMaxId($max_id,$limit);

            $this->renderPartial("load_chat",array("data"=>$data,"max_id"=>$max_id));
        }

        public function actionSaveChat(){
            $content = isset($_POST["content"]) ? trim($_POST["content"]) : "";

            $user_chat = isset($_SESSION["user_chat"]) ? $_SESSION["user_chat"] : array();
            if(!$user_chat){
                echo -1;exit;
            } 

            if(strlen($content)>1022 || strlen($content)<=0){
                echo -2;exit;
            } 
            $content = Common::bbcode_format($content);

            $data_insert = array(
                "user_id"=>array("value"=>$user_chat["id"],"type"=>1),
                "content"=>array("value"=>$content,"type"=>2),
                "create_date"=>array("value"=>time(),"type"=>1),
                "create_user"=>array("value"=>$user_chat["username"],"type"=>2),
            );

            $last_id = CommonDB::insertRow("chat_xosome",$data_insert);
            $limit = 10;
            $max_id = 0;
            if($last_id >0){
                $cacheService = new CacheService("UserChat","getDataByMaxId",1,$max_id,$limit);
                $key_cache = $cacheService->createKey();
                Yii::app()->cache->set($key_cache,false);

                $html = '<div class="chatid">
                <span class="time">['.date('d/m H:i').']</span>
                <strong class="userchat">'.$user_chat["fullname"].'</strong>: '.$content.' 
                </div>';
                echo $html;
            }



        }

        public function actionLoginFacebook(){
            if(isset($_GET["refer"])){
                $refer = trim($_GET["refer"]);
            }else{
                $refer = isset($_SERVER["HTTP_REFERER"]) ? trim($_SERVER["HTTP_REFERER"]) : Url::createUrl("home/index");
            }

            require_once(getcwd().'/protected/extensions/fb/facebook.php' ); //include fb sdk
            $return_url = Yii::app()->params["http_url"].Url::createUrl("home/index");
            $facebook = new Facebook(array(
                'appId' => Yii::app()->params["fb_app_id"],
                'secret' => Yii::app()->params["fb_app_secret"],
            ));

            $fbuser = $facebook->getUser();
            if ($fbuser) {
                try {
                    // Proceed knowing you have a logged in user who's authenticated.
                    $me = $facebook->api('/me'); //user
                    $uid = $facebook->getUser();
                }
                catch (FacebookApiException $e) 
                {
                    //echo error_log($e);
                    $fbuser = null;
                }
            }

            if (!$fbuser){
                $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$return_url, false));
                header('Location: '.$loginUrl);exit;
            }

            //user details
            $fullname = $me['first_name'].' '.$me['last_name'];
            $email = $me['email'];
            $id = $me['id'];

            $username = $email;
            $user = Chat::getDataByUsername($username);

            if(!$user){   
                $avatar = 'http://graph.facebook.com/'.$id.'/picture?type=square';
                $pass = 'vuivai@234';
                $password = md5(md5($pass));
                $data_insert = array(
                    "username"=>array("value"=>$username,"type"=>2),
                    "password"=>array("value"=>$password,"type"=>2),
                    "fullname"=>array("value"=>$fullname,"type"=>2),
                    "avatar"=>array("value"=>$avatar,"type"=>2),
                    "email"=>array("value"=>$email,"type"=>2),
                    "create_date"=>array("value"=>time(),"type"=>2),
                    "user_ip"=>array("value"=>Common::getRealIpAddr(),"type"=>2),
                    "is_facebook"=>array("value"=>1,"type"=>2),
                );
                $last_id = CommonDB::insertRow("chat_users",$data_insert);
                if($last_id >0){
                    $data_user = Chat::getDataById($last_id);
                    $_SESSION["user_chat"] = $data_user;
                }
            }else{
                $_SESSION["user_chat"] = $user; 
            }   
            //$refer = Yii::app()->params["http_url"].Url::createUrl("home/index");
            $this->redirect($refer); 
        }

        public function actionLoginGoogle(){
            $callback = 'http://xoso.me/chat/processGoogle'; 
            $url='https://www.google.com/accounts/o8/ud?openid.ns=http://specs.openid.net/auth/2.0&openid.ns.pape=http://specs.openid.net/extensions/pape/1.0&openid.ns.max_auth_age=300&openid.claimed_id=http://specs.openid.net/auth/2.0/identifier_select&openid.identity=http://specs.openid.net/auth/2.0/identifier_select&openid.return_to='.$callback.'&openid.realm='.$callback.'&openid.assoc_handle=ABSmpf6DNMw&openid.mode=checkid_setup&openid.ui.ns=http://specs.openid.net/extensions/ui/1.0&openid.ui.icon=true&openid.ns.ax=http://openid.net/srv/ax/1.0&openid.ax.mode=fetch_request&openid.ax.type.country=http://axschema.org/contact/country/home&openid.ax.type.email=http://axschema.org/contact/email&openid.ax.type.firstname=http://axschema.org/namePerson/first&openid.ax.type.language=http://axschema.org/pref/language&openid.ax.type.lastname=http://axschema.org/namePerson/last&openid.ax.required=country,email,firstname,language,lastname';
            $this->redirect($url);
        } 

        public function actionProcessGoogle(){
            $profile=array();    
            preg_match("/id=(.*)&openid.claimed_id/si",$url, $match);
            $profile['id']=$match[1];    

            preg_match("/first&openid.ext1.value.firstname=(.*)&openid.ext1.type.lastname/si",$url, $match);
            if(isset($match) && !empty($match))
                $profile['firstname']=$match[1];
            else
                $profile['firstname']='';
            preg_match("/last&openid.ext1.value.lastname=(.*)&openid.ext1.type.language/si",$url, $match);
            if(isset($match) && !empty($match))
                $profile['lastname']=$match[1];
            else
                $profile['lastname']='';

            $profile['full_name']=$profile['firstname'].' '.$profile['lastname'];
            //Lay email
            preg_match("/openid.ext1.value.email=(.*)&openid.ext1.type.country/si",$url, $match);
            // openid.ext1.type.email=http://axschema.org/contact/email&openid.ext1.value.email=ducnvna@gmail.com
            if(isset($match) && !empty($match))
                $email = $match[1];
            else {
                preg_match("/openid.ext1.value.email=(.*)/si",$url, $match);
                if(isset($match) && !empty($match))
                    $email = $match[1];
                else {
                    $email = '';
                }
            }
            $profile['email']=$email;
            var_dump($profile);die;
        }
    }
