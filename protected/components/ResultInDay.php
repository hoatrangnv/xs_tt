<?php
    class ResultInDay extends CPortlet
    { 
        protected function renderContent(){
            $date = getdate(time());
            $day = Common::getWeekDay($date["wday"]);
            $thu = "thu".$day["id"];
            $data = Provinces::getAllData();    
            $data[1] = Common::multiSort($data[1],$thu,1);
            $data[2] = Common::multiSort($data[2],$thu,1); 
            $data[3] = Common::multiSort($data[3],$thu,1); 

            $control = Yii::app()->controller->id;
            $action = Yii::app()->controller->action->id;
            $regions_rule = array("mb","mn","mt");
            $region_id = "mb";
            if(in_array($action,array("miennam","miennamWday","kqMiennam")) || date('H',time())==LoadConfig::$region["mn"]["hour_live"]){
                $regions_rule = array("mn","mt","mb");
                $region_id = "mn";
            }elseif(in_array($action,array("mientrung","mientrungWday","kqMientrung")) || date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
                $regions_rule = array("mt","mn","mb");
                $region_id = "mt";
            }
            $this->render("result_in_day",
                array(
                    "data"=>$data
                    ,"regions_rule"=>$regions_rule
                    ,"region_id"=>$region_id
                    ,"thu"=>$thu
            ));

        }
    }
