<?php
    class PrintController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url;
        public $provinces;

        public function init(){
            $this->layout = false;
            $this->current_url = Common::getCurrentUrl();
            $this->provinces = Provinces::getAllData();
        }
        
        public function actionKetqua(){
            $this->redirect(Url::createUrl("print/index"));
        }

        public function actionPrint(){
            $this->layout = "main";
            $this->render("print");
        }

        public function actionIndex(){
            $ngay_quay = isset($_GET["ngay_quay"]) ? trim($_GET["ngay_quay"]):"";
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]):0;
            $region = isset($_GET["region"]) ? intval($_GET["region"]):1;
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            if($region==3){
                if($province_id==0){
                    $url = Url::createUrl("print/miennam",array("ngay_quay"=>$ngay_quay,"name"=>$name));  
                }else{
                    $url = Url::createUrl("print/miennam",array("ngay_quay"=>$ngay_quay,"province_id"=>$province_id,"name"=>$name)); 
                }
            }elseif($region==2){
                if($province_id==0){
                    $url = Url::createUrl("print/mientrung",array("ngay_quay"=>$ngay_quay,"name"=>$name));  
                }else{
                    $url = Url::createUrl("print/mientrung",array("ngay_quay"=>$ngay_quay,"province_id"=>$province_id,"name"=>$name)); 
                }
            }else{
                if($province_id==0){
                    $url = Url::createUrl("print/mienbac",array("ngay_quay"=>$ngay_quay,"name"=>$name));  
                }else{
                    $url = Url::createUrl("print/mienbac",array("ngay_quay"=>$ngay_quay,"province_id"=>$province_id,"name"=>$name)); 
                }
            }
            $this->redirect($url);
        }

        public function actionMienbac(){
            $ngay_quay = isset($_GET["ngay_quay"]) ? trim($_GET["ngay_quay"]):"";
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]):0;
            if(isset($_GET["province_id"])){
                if(!isset($this->provinces[1][$province_id])){
                    throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống");
                }
                $province = $this->provinces[1][$province_id];
                $day = getdate(strtotime($ngay_quay));
                if(date("H",time()) == LoadConfig::$region["mb"]["hour_live"] && $ngay_quay==date('d-m-Y') && in_array(LoadConfig::$weekday[$day["wday"]],$province["live"])){
                    $key_cache = "Service.veso.ketquamienbac.giai"; 
                    $cache = Yii::app()->cache->getMemCache()->get($key_cache);                     
                    if($cache){
                        $data = $cache;
                    }else{
                        $data = LoadConfig::$result_mb;
                    }
                    $data["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                }else{
                    $data = KetquaMienbac::getDataByDate($ngay_quay,$province["live"]);
                }
            }else{
                $province = array();

                if(date("H",time()) == LoadConfig::$region["mb"]["hour_live"] && $ngay_quay==date('Y-m-d')){                 
                    $key_cache = "Service.veso.ketquamienbac.giai";
                    $cache = Yii::app()->cache->getMemCache()->get($key_cache);
                    if($cache){
                        $data = $cache;     
                    }else{             
                        $data = LoadConfig::$result_mb;
                    }
                    $data["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                }else{
                    $data = KetquaMienbac::getDataByDate($ngay_quay);
                }

            }   
            $this->render("mienbac",array("data"=>$data,"province"=>$province,"ngay_quay"=>$ngay_quay));
        }

        public function actionMiennam(){
            $ngay_quay = isset($_GET["ngay_quay"]) ? trim($_GET["ngay_quay"]):date('d-m-Y',time());
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]):0;

            if(isset($_GET["province_id"])){
                if(!isset($this->provinces[3][$province_id])){
                    throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống miền nam");
                }
                $province = $this->provinces[3][$province_id];
                $day = getdate(strtotime($ngay_quay));
                if(date("H",time()) == LoadConfig::$region["mn"]["hour_live"] && $ngay_quay==date('d-m-Y') && in_array(LoadConfig::$weekday[$day["wday"]],$province["live"])){
                    $key_cache = "Service.veso.ketquamiennam.tinh".$province["id"].".giai"; 
                    $cache = Yii::app()->cache->getMemCache()->get($key_cache);                     
                    if($cache){
                        $data = $cache;
                    }else{
                        $data = LoadConfig::$result_mn;
                    }
                    $data["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                }else{
                    $data = KetquaMiennam::getDataByProvinceAndDate($province_id,$ngay_quay);
                }

                $this->render("province",array("data"=>$data,"province"=>$province,"ngay_quay"=>$ngay_quay));
            }else{
                $provinces = array();
                foreach($this->provinces[3] as $key=>$value){
                    $day = getdate(strtotime($ngay_quay));
                    if($value["thu".LoadConfig::$weekday[$day["wday"]]]==1){
                        $provinces[$key] = $value;
                    }
                }

                if(date("H",time()) == LoadConfig::$region["mn"]["hour_live"] && $ngay_quay==date('d-m-Y')){
                    foreach($provinces as $key=>$value){       
                        if($value){        
                            $key_cache = "Service.veso.ketquamiennam.tinh".$value["id"].".giai"; 
                            $cache = Yii::app()->cache->getMemCache()->get($key_cache);                     
                            if($cache){
                                $data[$value["id"]] = $cache;
                            }else{
                                $data[$value["id"]] = LoadConfig::$result_mn;
                            }
                            $data[$value["id"]]["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                        }
                    }
                }else{
                    $data = KetquaMiennam::getDataByDate($ngay_quay);
                }

                $this->render("miennam",array("data"=>$data,"provinces"=>$provinces,"ngay_quay"=>$ngay_quay));
            }

        }

        public function actionMientrung(){
            $ngay_quay = isset($_GET["ngay_quay"]) ? trim($_GET["ngay_quay"]):date('d-m-Y',time());
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]):0;

            if(isset($_GET["province_id"])){
                if(!isset($this->provinces[2][$province_id])){
                    throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống miền trung");
                }
                $province = $this->provinces[2][$province_id];
                $day = getdate(strtotime($ngay_quay));
                if(date("H",time()) == LoadConfig::$region["mt"]["hour_live"] && $ngay_quay==date('d-m-Y') && in_array(LoadConfig::$weekday[$day["wday"]],$province["live"])){
                    $key_cache = "Service.veso.ketquamientrung.tinh".$province["id"].".giai"; 
                    $cache = Yii::app()->cache->getMemCache()->get($key_cache);                     
                    if($cache){
                        $data = $cache;
                    }else{
                        $data = LoadConfig::$result_mt;
                    }
                    $data["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                }else{
                    $data = KetquaMientrung::getDataByProvinceAndDate($province_id,$ngay_quay);
                }
                $this->render("province",array("data"=>$data,"province"=>$province,"ngay_quay"=>$ngay_quay));
            }else{
                $provinces = array();
                foreach($this->provinces[2] as $key=>$value){
                    $day = getdate(strtotime($ngay_quay));
                    if($value["thu".LoadConfig::$weekday[$day["wday"]]]==1){
                        $provinces[$key] = $value;
                    }
                } 
                if(date("H",time()) == LoadConfig::$region["mt"]["hour_live"] && $ngay_quay==date('d-m-Y')){
                    foreach($provinces as $key=>$value){       
                        if($value){        
                            $key_cache = "Service.veso.ketquamientrung.tinh".$value["id"].".giai"; 
                            $cache = Yii::app()->cache->getMemCache()->get($key_cache);                     
                            if($cache){
                                $data[$value["id"]] = $cache;
                            }else{
                                $data[$value["id"]] = LoadConfig::$result_mt;
                            }
                            $data[$value["id"]]["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                        }
                    }
                }else{
                    $data = KetquaMientrung::getDataByDate($ngay_quay);
                }
                $this->render("mientrung",array("data"=>$data,"provinces"=>$provinces,"ngay_quay"=>$ngay_quay));
            }

        }
    }
