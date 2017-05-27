<?php
    class RssController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url;
        public $provinces;
        public function init(){
            $this->layout = false;
            $this->provinces = Provinces::getAllData(1);
            $this->current_url = Common::getCurrentUrl();
        }
        public function actionIndex(){
            $this->layout = "main";
            $this->metaTitles = 'Rss Kết quả xổ số - Cung cấp rss kết quả xổ số 3 miền';
            $this->metaKeywords = 'rss ket qua xo so, ma nhung ket qua xo so vao site, code lay ket qua xo so';
            $this->metaDescription = 'Cung cấp rss nhúng kết quả xổ số các tỉnh miền bắc, miền trung, miền nam vào website, Bog của bạn';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("rss/index");
            
            $this->breadcrumbs[] = array("link"=>Url::createUrl("rss/index"),"title"=>"RSS");
            
            $provinces = $this->provinces;
            $this->render("index",array("provinces"=>$provinces));
        }

        public function actionRegion(){
            $row_per_page = 4;
            $provinces = $this->provinces;
            $alias = isset($_GET["alias"]) ? trim($_GET["alias"]) : "";
            if(!isset(LoadConfig::$region_statistic[$alias])){
                throw new CHttpException(404, "Link không tồn tại");
            }
            if($alias=="mien-nam"){
                list($data,$max_page,$total) = KetquaMiennam::getDataList(1,$row_per_page);
                $title = "Kết Quả Xổ Số Miền Nam";
                $tit = "Kết quả xổ số miền nam mở thưởng lúc 16h14' hàng ngày";
                $action = "miennam";
            }elseif($alias=="mien-trung"){
                list($data,$max_page,$total) = KetquaMientrung::getDataList(1,$row_per_page);
                $title = "Kết Quả Xổ Số Miền Trung";
                $tit = "Kết quả xổ số miền trung mở thưởng lúc 17h14' hàng ngày";
                $action = "mientrung";
            }else{
                list($data,$max_page,$total) = KetquaMienbac::getDataList(1,$row_per_page);
                $title = "Kết Quả Xổ Số Miền Bắc";
                $tit = "Kết quả xổ số miền bắc mở thưởng lúc 18h14' hàng ngày";
                $action = "mienbac";
            }
            //var_dump($data);die;
            $this->render("region",
                array(
                    "data"=>$data
                    ,"provinces"=>$provinces
                    ,"title"=>$title
                    ,"action"=>$action
                    ,"tit"=>$tit
                )
            );
        }

        public function actionDetail(){
            $row_per_page = 4;
            $provinces = $this->provinces;
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]) : 0;
            if(!isset($provinces[$province_id])){
                throw new CHttpException(404, "Link không tồn tại");
            }
            $province = $provinces[$province_id];
            if($province["region"]==3){
                $tit = "Kết quả xổ số ".$province["name"]." mở thưởng lúc 16h14' hàng ngày";
                list($data,$max_page,$total) = KetquaMiennam::getDataListByProvince($province_id,1,$row_per_page);
            }elseif($province["region"]==2){
                $tit = "Kết quả xổ số ".$province["name"]." mở thưởng lúc 17h14' hàng ngày";
                list($data,$max_page,$total) = KetquaMientrung::getDataListByProvince($province_id,1,$row_per_page);
            }else{
                $tit = "Kết quả xổ số ".$province["name"]." mở thưởng lúc 18h14' hàng ngày";
                list($data,$max_page,$total) = KetquaMienbac::getDataListByWday($province["live"],1,$row_per_page);
            }
            $title = "Kết Quả Xổ Số ".$province["name"];
            $this->render("detail",
                array(
                    "data"=>$data
                    ,"province"=>$province
                    ,"title"=>$title
                    ,"tit"=>$tit
                )
            );
        }
}