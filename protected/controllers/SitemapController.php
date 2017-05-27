<?php
    class SitemapController extends Controller {
        public $layout = false;
        public function actionIndex(){
            /*$provinces = Provinces::getAllData(1);
            $date = getdate(time());
            $day = Common::getWeekDay($date["wday"]);
            $province_now = array();
            foreach($provinces as $key=>$value){
                if(in_array($day["id"],$value["live"])){
                    $province_now[$key]= $value;
                }
            }*/
            $this->render("index");
        } 

        public function actionResult(){
            $provinces = Provinces::getAllData(1);
            $date = getdate(time());
            $day = Common::getWeekDay($date["wday"]);
            $province_now = array();
            foreach($provinces as $key=>$value){
                if(in_array($day["id"],$value["live"])){
                    $province_now[$key]= $value;
                }
            }
            $this->render("result",array("provinces"=>$provinces,"province_now"=>$province_now));
        }

        public function actionThongke(){
            $all_province = Provinces::getAllData(1);
            $provinces = array(1=>array("name"=>"Miền bắc","id"=>1,"region"=>1,"alias"=>"mien-bac","live"=>array(2,3,4,5,6,7,8)));
            foreach($all_province as $value){
                if($value["region"] !=1){
                    $provinces[$value["id"]] = $value;
                }
            }
            $date = getdate(time());
            $day = Common::getWeekDay($date["wday"]);
            $province_now = array();
            foreach($provinces as $key=>$value){
                if(in_array($day["id"],$value["live"])){
                    $province_now[$key]= $value;
                }
            }
            $this->render("thong_ke",array("provinces"=>$provinces,"province_now"=>$province_now));
        }

        public function actionNews(){
            $day = date('d-m-Y',time());
            $provinces = Provinces::getAllData(1);
            $news = News::getDataByDayAndMonth($day,0,0,Yii::app()->params["domain"]);
            $this->render("news",array("provinces"=>$provinces,"news"=>$news));
        }

        public function actionMonth(){
            $day = date('d-m-Y',time());
            $month = isset($_GET["month"]) ? intval($_GET["month"]) : 0;
            $year = isset($_GET["year"]) ? intval($_GET["year"]) : 0;
            $provinces = Provinces::getAllData(1);
            $news = News::getDataByDayAndMonth($day,$month,$year);
            $this->render("month",array(
                "provinces"=>$provinces
                ,"news"=>$news
                ,"month"=>$month
                ,"year"=>$year
            ));
        }
    }
