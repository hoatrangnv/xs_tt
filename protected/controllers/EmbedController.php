<?php
    class EmbedController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url;
        public $provinces = null;
        public function init(){
            $all_province = Provinces::getAllData(1);
            $provinces = array(1=>array("name"=>"Miền bắc","id"=>1,"region"=>1,"alias"=>"mien-bac"));  
            foreach($all_province as $value){
                if($value["region"] !=1){
                    $provinces[$value["id"]] = $value;
                }
            }
            $this->provinces = $provinces;
        }

        public function actionIndex(){
            $this->metaTitles = 'Ma nhung ket qua xo so, ma nhung ket qua mien bac, mien nam, mien trung';
            $this->metaKeywords = '';
            $this->metaDescription = '';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("embed/index");
            $this->breadcrumbs[] = array("link"=>Url::createUrl("embed/index"),"title"=>"Mã nhúng xosothantai.vn"); 
            $provinces = $this->provinces;
            $province_id = 1;
            $dates = Embed::getDataDateLimitByTableAndProvince("ketqua_mienbac",$province_id,30);
            $ngay_quay = reset($dates);
            $data = Embed::getDataByTableAndDateAndProvince("ketqua_mienbac",$ngay_quay,$province_id); 
            $this->render("index",
                array(
                    "provinces"=>$provinces
                    ,"data"=>$data
                    ,"dates"=>$dates
                    ,"province_id"=>$province_id
                    ,"ngay_quay"=>$ngay_quay
                )
            );
        }

        public function actionAjaxChange(){
            $province_id = isset($_POST["province_id"]) ? intval($_POST["province_id"]) : 1;    
            $provinces = $this->provinces;
            if(!isset($provinces)){
                throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống");
            }
            $layout["bg_color"] = isset($_POST["bg_color"]) ? trim($_POST["bg_color"]) : LoadConfig::$embed_default["bg_color"];
            $layout["tit_color"] = isset($_POST["tit_color"]) ? trim($_POST["tit_color"]) : LoadConfig::$embed_default["tit_color"];
            $layout["db_color"] = isset($_POST["db_color"]) ? trim($_POST["db_color"]) : LoadConfig::$embed_default["db_color"];
            $layout["width"] = isset($_POST["width"]) ? trim($_POST["width"]) : LoadConfig::$embed_default["width"];
            $layout["fsize"] = isset($_POST["fsize"]) ? trim($_POST["fsize"]) : LoadConfig::$embed_default["fsize"];

            $url = Yii::app()->params["http_url"].Url::createUrl("embed/code",array("province_id"=>$province_id));   
            $html = Embed::genHtmlEmbed($url,$layout);
            echo $html;
        }

        public function actionCode(){    
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]) : 1;    
            $ngay_quay = isset($_GET["ngay_quay"]) ? trim($_GET["ngay_quay"]) : "";
            $provinces = $this->provinces;

            if(!isset($provinces[$province_id])){
                throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống");
            }
            $province = $provinces[$province_id];
            $layout["bg_color"] = !empty($_GET["bg_color"]) ? trim($_GET["bg_color"]) : LoadConfig::$embed_default["bg_color"];
            $layout["tit_color"] = !empty($_GET["tit_color"]) ? trim($_GET["tit_color"]) : LoadConfig::$embed_default["tit_color"];
            $layout["db_color"] = !empty($_GET["db_color"]) ? trim($_GET["db_color"]) : LoadConfig::$embed_default["db_color"];
            $layout["width"] = !empty($_GET["width"]) ? trim($_GET["width"]) : LoadConfig::$embed_default["width"];
            $layout["fsize"] = !empty($_GET["fsize"]) ? trim($_GET["fsize"]) : LoadConfig::$embed_default["fsize"];
            if($province["region"]==3){
                $table = "ketqua_miennam";
            }elseif($province["region"]==2){
                $table = "ketqua_mientrung";
            }else{
                $table = "ketqua_mienbac";               
            }

            $dates = Embed::getDataDateLimitByTableAndProvince($table,$province_id,30);
            $ngay_quay = $ngay_quay != "" ? $ngay_quay : reset($dates);
            $data = Embed::getDataByTableAndDateAndProvince($table,$ngay_quay,$province_id);

            $this->renderPartial("view_embed",array(
                "dates"=>$dates,
                "data"=>$data,
                "ngay_quay"=>$ngay_quay,
                "provinces"=>$provinces,
                "province"=>$province,
                "province_id"=>$province_id,
                "layout"=>$layout
            ));
        }
    }
