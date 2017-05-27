<?php
    class ContentRight extends CPortlet
    { 
        protected function renderContent(){
            $live = "";
            if(date('H',time())==LoadConfig::$region["mn"]["hour_live"]){
                $live ="mn";
            }elseif(date('H',time())==LoadConfig::$region["mt"]["hour_live"]){
                $live ="mt";
            }elseif(date('H',time())==LoadConfig::$region["mb"]["hour_live"]){
                $live ="mb";
            }
            $this->render("content_right",array("live"=>$live));
            
        }
    }
