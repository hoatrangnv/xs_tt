<?php
    class StatisticController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $provinces = null;
        public $region = null;
        public $current_url = null;
        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $region = isset($_GET["region"]) ? trim($_GET["region"]):"";
            $all_province = Provinces::getAllData(1);
            $this->region = $region;

            if($region=="mien-nam"){
                foreach($all_province as $value){
                    if($value["region"]==3){
                        $provinces[$value["id"]] = $value;
                    }
                } 
            }elseif($region=="mien-trung"){
                foreach($all_province as $value){
                    if($value["region"]==2){
                        $provinces[$value["id"]] = $value;
                    }
                }
            }elseif($region=="mien-bac"){
                $provinces = array(1=>array("name"=>"Miền bắc","id"=>1,"region"=>1,"alias"=>"mien-bac"));
            }else{
                $provinces = array(1=>array("name"=>"Miền bắc","id"=>1,"region"=>1,"alias"=>"mien-bac"));
                foreach($all_province as $value){
                    if($value["region"] !=1){
                        $provinces[$value["id"]] = $value;
                    }
                }
            }

            $this->provinces = $provinces;
//            if(!isset($_SESSION['mobile_xstt'])){
//                $this->redirect(Url::createUrl("login/index"));
//            }
        }

        public function getDataChuKy($province_id,$rows,$rows_lientiep){
            $data = array();
            if($rows){
                foreach($rows as $key=>$value){
                    //if($value["end_date"] == "") $value["end_date"] = date('Y-m-d');
                    $data[$key] = array();
                    $data_length[$key] = Common::multiSort($rows[$key],"length",1);
                    $data_end_date[$key] = Common::multiSort($rows[$key],"start_date",1);
                    if(isset($data_length[$key][0])){
                        $data[$key]["start_date"] = $data_length[$key][0]["start_date"] !="" ? date('d-m-Y',strtotime($data_length[$key][0]["start_date"])) :"?";
                        $data[$key]["end_date"] = $data_length[$key][0]["end_date"] !="" ? date('d-m-Y',strtotime($data_length[$key][0]["end_date"])) : "?";
                        $data[$key]["length"] = $data_length[$key][0]["length"];
                    }else{
                        $data[$key]["start_date"] = "";
                        $data[$key]["end_date"] = "";
                        $data[$key]["length"] = -1;
                    }
                    if(isset($data_end_date[$key][0])){
                        if($data_end_date[$key][0]["end_date"] !=""){
                            $data[$key]["near_date"] = date('d-m-Y',strtotime($data_end_date[$key][0]["end_date"]));
                        }elseif($data_end_date[$key][0]["start_date"] !=""){
                            $data[$key]["near_date"] = date('d-m-Y',strtotime($data_end_date[$key][0]["start_date"]));
                        }
                        $data[$key]["gan"] = Common::getCountDayGan($data[$key]["near_date"],$province_id) - 1;
                    }else{
                        $data[$key]["near_date"] = "";
                        $data[$key]["gan"] = "";
                    }
                    if(isset($rows_lientiep[$key][0])){
                        $data[$key]["start_lt"] = $rows_lientiep[$key][0]["start_date"] !="" ? date('d-m-Y',strtotime($rows_lientiep[$key][0]["start_date"])):"?";
                        $data[$key]["end_lt"] = $rows_lientiep[$key][0]["end_date"] !="" ? date('d-m-Y',strtotime($rows_lientiep[$key][0]["end_date"])):"?";
                        $data[$key]["length_lt"] = $rows_lientiep[$key][0]["length"];
                    }else{
                        $data[$key]["start_lt"] = "";
                        $data[$key]["end_lt"] = "";
                        $data[$key]["length_lt"] = -1;
                    }                   
                    if(isset($data_length[$key][count($data_length)-1])){
                        $i = count($data_length[$key])-1;
                        $data[$key]["start_short"] = $data_length[$key][$i]["start_date"] !="" ? date('d-m-Y',strtotime($data_length[$key][$i]["start_date"])):"?";
                        $data[$key]["end_short"] = $data_length[$key][$i]["end_date"] !="" ? date('d-m-Y',strtotime($data_length[$key][$i]["end_date"])):"?";
                        $data[$key]["length_short"] = $data_length[$key][$i]["length"];
                    }else{
                        $data[$key]["start_short"] = "";
                        $data[$key]["end_short"] = "";
                        $data[$key]["length_short"] = -1;
                    }
                }
            }
            ksort($data);
            //var_dump($data);die;
            return $data;
        }

        public function actionChukyLoto(){
            $this->metaTitles = 'Thong ke chu ky loto, Xem bang thong ke chu ky loto tu 00 den 99';
            $this->metaKeywords = 'thong ke loto, chu ky loto, thong ke chu ky loto ';
            $this->metaDescription = 'Thống kê chu kỳ loto. Xem chi tiết Bảng thống kê chu kỳ loto các số từ 00 đến 99 theo từng tỉnh, miền chính xác nhất';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto");
            $provinces = $this->provinces;      
            $first_province = reset($provinces);
            $search["is_special"] = 0;$data = array();     
            $search["province_id"] = isset($_GET["province_id"]) ? intval($_GET["province_id"]):$first_province["id"];
            $boso = isset($_POST["boso"]) ? trim($_POST["boso"],","):"";
            $bosos = explode(",",$boso);    
            $search["from_date"] = isset($_POST["from_date"]) ? trim($_POST["from_date"]):date('d-m-Y',time()-86400*10);
            $search["to_date"] = isset($_POST["to_date"]) ? trim($_POST["to_date"]):date('d-m-Y',time());
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_chuky_boso";
                $table_lt = "thongke_boso_ve_lientiep";
            }elseif($province["region"]==3){
                $table = "thongke_chuky_boso";
                $table_lt = "thongke_boso_ve_lientiep";
            }else{
                $table = "thongke_chuky_boso";
                $table_lt = "thongke_boso_ve_lientiep";
            }
            
            $rows = TkChukyBoso::getDataSearchByManyBoso($table,$bosos,$search);
            $rows_lientiep = TkBosoLientiep::getDataSearchByManyBoso($table_lt,$bosos,$search);
            
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/chukyLoto"),"title"=>"Thống kê chu kỳ loto"); 
            if(isset($_GET["province_id"])){   
                if($province["id"]==1){
                    $this->redirect(Url::createUrl("statistic/chukyLoto",array("region"=>"mien-bac")));
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));        
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Thống kê chu kỳ loto ".$province["name"]); 
                if($this->current_url != $url){$this->redirect($url);exit;}

                $this->metaTitles = 'Thong ke chu ky loto '.str_replace("-"," ",$province["alias"]).' tu 00 den 99, Loto '.str_replace("-"," ",$province["alias"]);
                $this->metaKeywords = 'thong ke chu ky loto '.str_replace("-"," ",$province["alias"]).', thong ke loto '.str_replace("-"," ",$province["alias"]).'';
                $this->metaDescription = 'Thống kê chu kỳ loto '.$province["name"].'. Xem chi tiết Bảng thống kê chu kỳ loto '.$province["name"].' các bộ số từ 00 đến 99 chính xác nhất';
                $this->linkCanoncical = $url;
            }elseif(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê chu kỳ loto ".LoadConfig::$region_statistic[$_GET["region"]]); 
                $this->metaTitles = 'Thong ke chu ky loto '.str_replace("-"," ",$_GET["region"]).' tu 00 den 99, Loto '.str_replace("-"," ",$_GET["region"]);
                $this->metaKeywords = 'thong ke chu ky loto '.str_replace("-"," ",$_GET["region"]).', thong ke loto '.str_replace("-"," ",$_GET["region"]).'';
                $this->metaDescription = 'Thống kê chu kỳ loto '.LoadConfig::$region_statistic[$_GET["region"]].'. Xem chi tiết Bảng thống kê chu kỳ loto '.LoadConfig::$region_statistic[$_GET["region"]].' các bộ số từ 00 đến 99 chính xác nhất';
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/chukyLoto",array("region"=>$_GET["region"]));
            }
            $data = $this->getDataChuKy($province["id"],$rows,$rows_lientiep);

            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê chu kỳ loto '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê chu kỳ loto '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê chu kỳ loto';
            }

            $this->render("chuky_loto",
                array(
                    "provinces"=>$provinces
                    ,"province"=>$province
                    ,"boso"=>$boso
                    ,"search"=>$search
                    ,"data"=>$data
                    ,"region"=>$this->region
                )
            );
        }

        public function actionLotoGan(){
            $this->metaTitles = 'Thong ke loto gan, Xem thong ke tan suat loto gan';
            $this->metaKeywords = 'thong ke lo gan, thong ke loto gan, tan suat loto gan';
            $this->metaDescription = 'Xem thống kê loto gan 3 miền: Miền bắc, miền trung, miền nam. Chi tiết thống kê lo gan theo tỉnh hàng ngày';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan");
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_GET["province_id"]) ? intval($_GET["province_id"]):$first_province["id"];
            $search["biendo"] = isset($_POST["biendo"]) ? intval($_POST["biendo"]): 10;
            $province = $provinces[$search["province_id"]];
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/lotoGan"),"title"=>"Thống kê loto gan"); 
            if(isset($_GET["province_id"])){
                if($province["id"]==1){
                    $this->redirect(Url::createUrl("statistic/lotoGan",array("region"=>"mien-bac")));
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));        
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Thống kê loto gan ".$province["name"]); 
                if($this->current_url != $url){$this->redirect($url);exit;}

                $this->metaTitles = 'Thong ke loto gan '.str_replace("-"," ",$province["alias"]).', Xem thong ke lo gan '.str_replace("-"," ",$province["alias"]).'';
                $this->metaKeywords = 'thong ke lo gan '.str_replace("-"," ",$province["alias"]).', loto gan '.str_replace("-"," ",$province["alias"]).'';
                $this->metaDescription = 'Xem thống kê loto gan '.$province["name"].' nhanh nhất, chính xác nhất. Bảng chi tiết các bộ số thống kê gan';
                $this->linkCanoncical = $url;
            }elseif(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê loto gan ".LoadConfig::$region_statistic[$_GET["region"]]); 
                $this->metaTitles = 'Thong ke loto gan '.str_replace("-"," ",$_GET["region"]).', Xem thong ke lo gan '.str_replace("-"," ",$_GET["region"]).'';
                $this->metaKeywords = 'thong ke lo gan '.str_replace("-"," ",$_GET["region"]).', loto gan '.str_replace("-"," ",$_GET["region"]).'';
                $this->metaDescription = 'Xem thống kê loto gan '.LoadConfig::$region_statistic[$_GET["region"]].', Bảng thống kê lo gan kết quả xổ số trực tiếp '.LoadConfig::$region_statistic[$_GET["region"]].' chính xác.';
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/lotoGan",array("region"=>$_GET["region"]));
            }
            $data_gan = TkChukyBoso::getDataLotoGanInTimes($province["region"],$search["province_id"],$search["biendo"],"",100);
            $data_gan = Common::multiSort($data_gan,"length",1);
            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê chu kỳ loto gan '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê chu kỳ loto gan '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê chu kỳ loto gan';
            }

            $this->render("loto_gan",
                array(
                    "provinces"=>$provinces
                    ,"province"=>$province
                    ,"search"=>$search
                    ,"data_gan"=>$data_gan
                    ,"region"=>$this->region
                )
            );
        }

        public function actionDacbiet(){
            $this->metaTitles = 'Thong ke giai dac biet, Tong hop giai dac biet';
            $this->metaKeywords = 'thống kê giải đặc biệt, giải đặc biệt gần nhất';
            $this->metaDescription = 'Thống kê giải đặc biệt theo tuần, theo tháng, theo năm. Tổng hợp giải đặc biệt về gần nhất';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/dacbiet");
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_POST["province_id"]) ? intval($_POST["province_id"]):$first_province["id"];
            $search["month"] = isset($_POST["month"]) ? intval($_POST["month"]) : date('m',time());
            $search["year"] = isset($_POST["year"]) ? intval($_POST["year"]) : date('Y',time());
            $search["type_tk"] = isset($_POST["type_tk"]) ? intval($_POST["type_tk"]) : 0;
            $search["type"] = isset($_POST["type"]) ? intval($_POST["type"]) : 0;
            $province = $provinces[$search["province_id"]];
            if($search["type_tk"]==1){
                $search["month"] = 0;
            }

            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }
            
            $data = array();
            $rows = TkLoto::getDataDacbietSearchByTable($table,$search);
            if($search["type_tk"]==0){
                foreach($rows as $value){
                    if($value["day"] > 0 && $value["day"] <7){
                        $data[1]["thu".$value["thu"]] = $value;
                    }elseif($value["day"] >=7 && $value["day"] <14){
                        $data[2]["thu".$value["thu"]] = $value;
                    }elseif($value["day"] >=14 && $value["day"] <21){
                        $data[3]["thu".$value["thu"]] = $value;
                    }elseif($value["day"] >=21 && $value["day"] <28){
                        $data[4]["thu".$value["thu"]] = $value;
                    }else{
                        $data[5]["thu".$value["thu"]] = $value;
                    }
                }
            }else{
                foreach($rows as $value){
                    $data[$value["day"]][$value["month"]] = $value;
                }
            }
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/dacbiet"),"title"=>"Thống kê giải đặc biệt"); 
            if(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê giải đặc biệt ".LoadConfig::$region_statistic[$_GET["region"]]); 
            }

            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê giải đặc biệt '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê giải đặc biệt '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê giải đặc biệt';
            }

            $this->render("dacbiet",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"data"=>$data
                    ,"region"=>$this->region
                )
            );
        }


        public function actionDauduoiLoto(){
            $this->metaTitles = 'Thong ke dau duoi loto Mien bac - Mien trung - Mien nam';
            $this->metaKeywords = 'thong ke dau duoi mien bac, thong ke dau duoi mien trung, thong ke dau duoi mien nam';
            $this->metaDescription = 'Thống kê đầu đuôi loto 3 miền: Miền bắc, miền trung, miền nam và các tỉnh quay thưởng. Thống kê đầu, đuôi loto theo tuần, theo tháng, gần đây nhất';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiLoto");
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_POST["province_id"]) ? intval($_POST["province_id"]):$first_province["id"];
            $search["from_date"] = isset($_POST["from_date"]) ? trim($_POST["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_POST["to_date"]) ? trim($_POST["to_date"]):date('d-m-Y',time());
            $search["times"] = isset($_POST["times"]) ? intval($_POST["times"]):30;
            $search["type"] = isset($_POST["type"]) ? intval($_POST["type"]):0;
            if($search["type"]==1){
                $search["from_date"] = "";
                $search["to_date"] = "";
            }else{
                $search["times"] = 0;
            }
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }            
            $rows = TkLoto::getDataDauduoiSearchByTable($table,$search);
            $dau = array();$duoi = array();
            foreach($rows as $value){
                $dau[$value["ngay_quay"]][$value["dau_so"]][] = $value; 
                $duoi[$value["ngay_quay"]][$value["dit_so"]][] = $value; 
            }

            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/dauduoiLoto"),"title"=>"Thống kê đầu đuôi loto"); 
            if(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê đầu đuôi loto ".LoadConfig::$region_statistic[$_GET["region"]]); 
            }

            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê đầu đuôi loto '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê đầu đuôi loto '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê đầu đuôi loto';
            }

            $this->render("dauduoi_loto",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"dau"=>$dau
                    ,"duoi"=>$duoi
                    ,"region"=>$this->region
                )
            );
        }

        public function actionDauduoiLotoFull(){
            $this->layout = "main_full";
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_GET["province_id"]) ? intval($_GET["province_id"]):$first_province["id"];
            $search["from_date"] = isset($_GET["from_date"]) ? trim($_GET["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_GET["to_date"]) ? trim($_GET["to_date"]):date('d-m-Y',time());
            $search["times"] = isset($_GET["times"]) ? intval($_GET["times"]):30;
            $search["type"] = isset($_GET["type"]) ? intval($_GET["type"]):0;
            if($search["type"]==1){
                $search["from_date"] = "";
                $search["to_date"] = "";
            }else{
                $search["times"] = 0;
            }
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }            
            $rows = TkLoto::getDataDauduoiSearchByTable($table,$search);
            $dau = array();$duoi = array();
            foreach($rows as $value){
                $dau[$value["ngay_quay"]][$value["dau_so"]][] = $value; 
                $duoi[$value["ngay_quay"]][$value["dit_so"]][] = $value; 
            }
            $this->render("dauduoi_loto_full",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"dau"=>$dau
                    ,"duoi"=>$duoi
                    ,"region"=>$this->region
                )
            );
        }

        public function actionDauduoiDacbiet(){
            $this->metaTitles = 'Thong ke dau duoi giai dac biet, Dau duoi giai dac biet mien bac';
            $this->metaKeywords = 'thong ke dau giai dac biet, thong ke duoi giai dac biet, dau dit giai dac biet';
            $this->metaDescription = 'Thống kê đầu đuôi giải đặc biệt theo tuần, tháng, năm. Tổng hợp các thống kê đầu đít đặc biệt hàng ngày - Ketquaveso.com';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/dauduoiDacbiet");
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_POST["province_id"]) ? intval($_POST["province_id"]):$first_province["id"];
            $search["from_date"] = isset($_POST["from_date"]) ? trim($_POST["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_POST["to_date"]) ? trim($_POST["to_date"]):date('d-m-Y',time());
            $search["times"] = isset($_POST["times"]) ? intval($_POST["times"]):30;
            $search["type"] = isset($_POST["type"]) ? intval($_POST["type"]):0;
            $search["is_dacbiet"] = 1;
            if($search["type"]==1){
                $search["from_date"] = "";
                $search["to_date"] = "";
            }else{
                $search["times"] = 0;
            }
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }            
            $rows = TkLoto::getDataDauduoiSearchByTable($table,$search);
            $dau = array();$duoi = array();
            foreach($rows as $value){
                $dau[$value["ngay_quay"]][$value["dau_so"]][] = $value; 
                $duoi[$value["ngay_quay"]][$value["dit_so"]][] = $value; 
            }
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/dauduoiDacbiet"),"title"=>"Thống kê đầu đuôi đặc biệt"); 
            if(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê đầu đuôi đặc biệt ".LoadConfig::$region_statistic[$_GET["region"]]); 
            }

            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê đầu đuôi đặc biệt '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê đầu đuôi đặc biệt '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê đầu đuôi đặc biệt';
            }

            $this->render("dauduoi_dacbiet",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"dau"=>$dau
                    ,"duoi"=>$duoi
                    ,"region"=>$this->region
                )
            );
        }

        public function actionDauduoiDacbietFull(){
            $this->layout = "main_full";
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_GET["province_id"]) ? intval($_GET["province_id"]):$first_province["id"];
            $search["from_date"] = isset($_GET["from_date"]) ? trim($_GET["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_GET["to_date"]) ? trim($_GET["to_date"]):date('d-m-Y',time());
            $search["times"] = isset($_GET["times"]) ? intval($_GET["times"]):30;
            $search["type"] = isset($_GET["type"]) ? intval($_GET["type"]):0;
            $search["is_dacbiet"] = 1;
            if($search["type"]==1){
                $search["from_date"] = "";
                $search["to_date"] = "";
            }else{
                $search["times"] = 0;
            }
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }            
            $rows = TkLoto::getDataDauduoiSearchByTable($table,$search);
            $dau = array();$duoi = array();
            foreach($rows as $value){
                $dau[$value["ngay_quay"]][$value["dau_so"]][] = $value; 
                $duoi[$value["ngay_quay"]][$value["dit_so"]][] = $value; 
            }
            $this->render("dauduoi_dacbiet_full",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"dau"=>$dau
                    ,"duoi"=>$duoi
                    ,"region"=>$this->region
                )
            );
        }

        public function actionTansuatLoto(){
            $this->metaTitles = 'Thong ke tan suat loto tu 00 den 99, Tan suat loto';
            $this->metaKeywords = 'thong ke tan suat loto, tan suat loto';
            $this->metaDescription = 'Thống kê tần suất loto 3 miền: Miền bắc, miền trung, miền nam chính xác nhất. Xem chi tiết bảng thống kê tần suất loto các bộ số từ 00 đến 99';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto");
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_GET["province_id"]) ? intval($_GET["province_id"]):$first_province["id"];
            $search["from_date"] = isset($_POST["from_date"]) ? trim($_POST["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_POST["to_date"]) ? trim($_POST["to_date"]):date('d-m-Y',time());
            $search["times"] = isset($_POST["times"]) ? intval($_POST["times"]):30;
            $search["type"] = isset($_POST["type"]) ? intval($_POST["type"]):0;
            $boso = isset($_POST["boso"]) ? $_POST["boso"]:array();
            if(!$boso){
                for($i=0;$i<100;$i++){
                    $boso[] = $i<10 ? '0'.$i : $i;
                } 
            }
            $province = $provinces[$search["province_id"]];
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/tansuatLoto"),"title"=>"Thống kê tần suất loto"); 
            if(isset($_GET["province_id"])){
                if($province["id"]==1){
                    $this->redirect(Url::createUrl("statistic/tansuatLoto",array("region"=>"mien-bac")));
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));        
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Thống kê tần suất loto ".$province["name"]); 
                if($this->current_url != $url){$this->redirect($url);exit;}

                $this->metaTitles = 'Thong ke tan suat loto '.str_replace("-"," ",$province["alias"]).' tu 00-99, Tan suat loto '.str_replace("-"," ",$province["alias"]).'';
                $this->metaKeywords = 'thong ke tan suat loto '.str_replace("-"," ",$province["alias"]).', tan suat lo to '.str_replace("-"," ",$province["alias"]).'';
                $this->metaDescription = 'Thống kê tần suất loto '.$province["name"].' nhanh nhất, chính xác nhất. Xem bảng thống kê tần suất loto '.$province["name"].' các bộ số từ 00 đến 99 ngay';
                $this->linkCanoncical = $url;
            }elseif(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê tần suất loto ".LoadConfig::$region_statistic[$_GET["region"]]); 
                $this->metaTitles = 'Thong ke tan suat loto '.str_replace("-"," ",$_GET["region"]).' tu 00-99, Tan suat loto '.str_replace("-"," ",$_GET["region"]).'';
                $this->metaKeywords = 'thong ke tan suat loto '.str_replace("-"," ",$_GET["region"]).', tan suat lo to '.str_replace("-"," ",$_GET["region"]).'';
                $this->metaDescription = 'Thống kê tần suất loto '.LoadConfig::$region_statistic[$_GET["region"]].' nhanh nhất, chính xác nhất. Xem bảng thống kê tần suất loto '.LoadConfig::$region_statistic[$_GET["region"]].' các bộ số từ 00 đến 99 ngay';
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/tansuatLoto",array("region"=>$_GET["region"]));
            }

            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            } 
            $data = array();
            if($search["type"]==1){
                $search["to_date"] = "";
                $search["from_date"] = "";
            }else{
                $search["times"] = 0;
            }    
            $data = TkLoto::getDataCapBosoSearchByTable($table,$boso,$search); 
            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê tần suất loto '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê tần suất loto '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê tần suất loto';
            }

            $this->render("tansuat_loto",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"boso"=>$boso
                    ,"data"=>$data
                    ,"region"=>$this->region
                )
            );
        }

        public function actionTansuatLotoFull(){
            $this->layout = "main_full";
            $provinces = $this->provinces;
            $first_province = reset($provinces);
            $search["province_id"] = isset($_GET["province_id"]) ? intval($_GET["province_id"]):$first_province["id"];
            $search["from_date"] = isset($_GET["from_date"]) ? trim($_GET["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_GET["to_date"]) ? trim($_GET["to_date"]):date('d-m-Y',time());
            $search["times"] = isset($_GET["times"]) ? intval($_GET["times"]):30;
            $search["type"] = isset($_GET["type"]) ? intval($_GET["type"]):0;
            $boso = isset($_GET["boso"]) ? $_GET["boso"]:array();
            if(!$boso){
                for($i=0;$i<100;$i++){
                    $boso[] = $i<10 ? '0'.$i : $i;
                } 
            }
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }  
            $data = array();
            if($search["type"]==1){
                $search["to_date"] = "";
                $search["from_date"] = "";
            }else{
                $search["times"] = 0;
            }

            $data = TkLoto::getDataCapBosoSearchByTable($table,$boso,$search); 

            $this->render("tansuat_loto_full",
                array(
                    "search"=>$search
                    ,"provinces"=>$provinces
                    ,"province"=>$province
                    ,"boso"=>$boso
                    ,"data"=>$data
                    ,"region"=>$this->region
                )
            );
        }

        public function actionNhanh(){
            $this->metaTitles = 'Thong ke ket qua xo so, Thong ke nhanh ket qua xo so';
            $this->metaKeywords = 'thong ke nhanh ket qua xo so';
            $this->metaDescription = 'Thống kê nhanh cặp số hay về trong khoảng thời gian gần đây. Thống kê kết quả xổ số miền bắc, các tỉnh miền trung, miền nam giúp bạn chọn các cặp số may mắn';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/nhanh");
            $provinces = $this->provinces;     
            $first_province = reset($provinces); 
            $data = array();     
            $search["province_id"] = isset($_POST["province_id"]) ? intval($_POST["province_id"]):$first_province["id"];
            $search["is_dacbiet"] = isset($_POST["is_dacbiet"]) ? intval($_POST["is_dacbiet"]):0;
            $boso = isset($_POST["boso"]) ? trim($_POST["boso"],","):"";
            $bosos = explode(",",$boso);    
            $search["from_date"] = isset($_POST["from_date"]) ? trim($_POST["from_date"]):date('d-m-Y',time()-86400*30);
            $search["to_date"] = isset($_POST["to_date"]) ? trim($_POST["to_date"]):date('d-m-Y',time());
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }
            $rows = TkLoto::getDataQuickBosoSearchByTable($table,$bosos,$search);

            $data = array();
            foreach($rows as $key=>$value){
                $data[$key] = array();
                $data_end_date[$key] = Common::multiSort($rows[$key],"ngay_quay",1);
                $data[$key]["length"] = 0;
                for($i=0;$i<count($value);$i++){
                    $data[$key]["length"] += $value[$i]["tan_so"];
                }
                if(isset($data_end_date[$key][0])){
                    $data[$key]["near_date"] = date('d-m-Y',strtotime($data_end_date[$key][0]["ngay_quay"]));
                    $data[$key]["gan"] = Common::getCountDayGan($data[$key]["near_date"],$province["id"]);
                    $data[$key]["gan"] = $data[$key]["gan"] - 1;
                }else{
                    $data[$key]["near_date"] = "";
                    $data[$key]["gan"] = "";
                }
            }
            ksort($data);
            //var_dump($data);die;
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/nhanh"),"title"=>"Thống kê nhanh"); 
            if(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê nhanh ".LoadConfig::$region_statistic[$_GET["region"]]); 
            }

            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê nhanh '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê nhanh '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê nhanh';
            }

            $this->render("nhanh",
                array(
                    "provinces"=>$provinces
                    ,"province"=>$province
                    ,"boso"=>$boso
                    ,"search"=>$search
                    ,"data"=>$data
                    ,"region"=>$this->region
                )
            );
        }

        public function actionTonghop(){
            $this->metaTitles = 'Thong ke tong hop lo de, Thong ke tong chan loto, Thong ke tong le';
            $this->metaKeywords = 'thong ke xo so theo tong chan, thong ke xo so theo tong le';
            $this->metaDescription = 'Thống kê tổng hợp loto, kết quả vé số, thống kê tổng chẵn, tổng lẻ, bộ kép, đầu số, đít số giúp bạn lựa chọn được các cặp số may mắn cho mình hôm nay';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("statistic/tonghop");
            $provinces = $this->provinces;  
            $first_province = reset($provinces);     
            $data = array();     
            $search["province_id"] = isset($_POST["province_id"]) ? intval($_POST["province_id"]):$first_province["id"];
            $search["is_dacbiet"] = isset($_POST["is_dacbiet"]) ? intval($_POST["is_dacbiet"]):0;
            $search["type"] = isset($_POST["type"]) ? intval($_POST["type"]):1;
            $search["from_date"] = isset($_POST["from_date"]) ? trim($_POST["from_date"]):date('d-m-Y',time()-86400*10);
            $search["to_date"] = isset($_POST["to_date"]) ? trim($_POST["to_date"]):date('d-m-Y',time());
            $province = $provinces[$search["province_id"]];
            if($province["region"]==2){
                $table = "thongke_loto_mientrung";
            }elseif($province["region"]==3){
                $table = "thongke_loto_miennam";
            }else{
                $table = "thongke_loto_mienbac";
            }
            $rows = TkLoto::getDataGeneralBosoSearchByTable($table,$search);
            $data = array();
            foreach($rows as $key=>$value){
                $data[$key] = array();
                $data_end_date[$key] = Common::multiSort($rows[$key],"ngay_quay",1);
                $data[$key]["length"] = 0;
                for($i=0;$i<count($value);$i++){
                    $data[$key]["length"] += $value[$i]["tan_so"];
                }
                $data[$key]["boso"] = $key;
                if(isset($data_end_date[$key][0])){
                    $data[$key]["near_date"] = date('d-m-Y',strtotime($data_end_date[$key][0]["ngay_quay"]));
                    $data[$key]["gan"] = Common::getCountDayGan($data[$key]["near_date"],$province["id"]);
                    $data[$key]["gan"] = $data[$key]["gan"] - 1;
                }else{
                    $data[$key]["near_date"] = "";
                    $data[$key]["gan"] = "";
                }
            }
            ksort($data);

            if($search["type"]==11){
                $most_rows = Common::multiSort($data,"length",1); 
                $data = array();
                for($i=0;$i<=15;$i++){
                    if(isset($most_rows[$i])){
                        $data[$i] = $most_rows[$i];
                    } 
                }
            }elseif($search["type"]==12){
                $less_rows = Common::multiSort($data,"length",0); 
                $data = array();
                for($i=0;$i<=15;$i++){
                    if(isset($less_rows[$i])){
                        $data[$i] = $less_rows[$i];
                    } 
                }
            }elseif($search["type"]==9 || $search["type"]==10){
                ksort($data); 
            }
            $this->breadcrumbs[] = array("link"=>Url::createUrl("statistic/tonghop"),"title"=>"Thống kê tổng hợp"); 
            if(isset($_GET["region"])){
                $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>"Thống kê tổng hợp ".LoadConfig::$region_statistic[$_GET["region"]]); 
            }

            if(isset($_GET["province_id"])){
                $this->title_h1 = 'Thống kê tổng hợp '.$province["name"];
            }elseif(isset($_GET["region"])){
                $this->title_h1 = 'Thống kê tổng hợp '.(isset(LoadConfig::$region_statistic[$region]) ? LoadConfig::$region_statistic[$region] : "");
            }else{
                $this->title_h1 = 'Thống kê tổng hợp';
            }

            $this->render("tonghop",
                array(
                    "provinces"=>$provinces
                    ,"province"=>$province
                    ,"search"=>$search
                    ,"data"=>$data
                    ,"region"=>$this->region
                )
            );
        }
    }
