<?php
    class StatisticResult extends CPortlet
    { 
        protected function renderContent(){

            if(Yii::app()->params["domain"]!="xoso999.com"){
                $day = date('Y-m-d',time());

                $data = Provinces::getDataInDay($day);    
                $control = Yii::app()->controller->id;
                $action = Yii::app()->controller->action->id;
                $regions_rule = array("mb","mn","mt");
                $region_id = "mb";
                if($control=="home"){
                    if($action=="miennam" || date('H',time())==LoadConfig::$region["mn"]["hour_live"]){
                        $regions_rule = array("mn","mt","mb");
                        $region_id = "mn";
                    }elseif($action=="mientrung" || date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
                        $regions_rule = array("mt","mn","mb");
                        $region_id = "mt";
                    }
                }  
                $this->render("statistic_result",
                    array(
                        "data"=>$data
                        ,"regions_rule"=>$regions_rule
                        ,"region_id"=>$region_id
                    )
                );
            }


        }
    }
