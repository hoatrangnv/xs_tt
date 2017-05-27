<?php
    class KqthantaiController extends Controller{

        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $this->breadcrumbs[] = array("link"=>Url::createUrl("kqthantai/index"),"title"=>"KQXS thần tài");
//            if(!isset($_SESSION['mobile_xstt'])){
//                $this->redirect(Url::createUrl("login/index"));
//            }
        }
        public function actionIndex(){
            $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;
            $result = Kqthantai::getKqthantaiByLimit($limit);
            $this->render("index",array("result"=>$result,"limit" => $limit));
        }

    }
