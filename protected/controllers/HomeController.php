<?php
    class HomeController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;

        public function init(){

        }

        public function actionError()
        {        
            $this->layout = false;
            $error = Yii::app()->errorHandler->error;  
            if((isset($_SESSION["user"]) && $_SESSION["user"]["username"]=="jokerluque") || $_SERVER["HTTP_HOST"]=="localhost"){
                echo '<pre>';
                var_dump($error);die;
            }     
            $this->render("error"
                , array(
                    "error"=>$error
                )            
            );
        }



        public function actionIndex(){  
            $this->metaTitles = 'KQXSMB-XSMN-XSMT nhanh nhất Việt Nam | Xổ số trực tiếp 3 miền';
            $this->metaKeywords = 'Kết quả xổ số, xổ số kiến thiết, xổ số, sổ xố; xo so kien thiet, ket qua xo so, xo so, so xo; xoso, soxo, kqxs, kqsx, xskt, so so, xo xo, xsmb, xsmn, kqxsmb, kqxsmn';
            $this->metaDescription = 'Kết quả xổ số trực tiếp nhanh nhất tại trường quay trên cả 3 miền. xosothantai.vn tường thuật xổ số miền Bắc, xổ số miền Trung, xổ số miền Nam uy tin trên 10 năm và chính xác nhất.';


            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/index");
            $region = LoadConfig::$region;
            $hour = date('H',time());
            
            if($hour==$region["mn"]["hour_live"]){   
                $this->actionMiennam();
            }elseif($hour==$region["mt"]["hour_live"]){
                
                $this->actionMientrung();
            }elseif($hour==$region["mb"]["hour_live"]){                        
                $this->actionMienbac();
            }else{
                $this->actionMienbac();
            }
        }

        public function actionMienbac(){     
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/index"),"title"=>"Trực tiếp xổ số"); 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/mienbac"),"title"=>"Xổ số miền bắc");
            if($this->metaTitles ==''){
                $this->metaTitles = 'Kết quả xổ số Miền Bắc trực tiếp| XSTT miền bắc-XSMB nhanh nhất';
                $this->metaKeywords = 'xo so truc tiep mien bac, xem tuong thuat truc tiep ket qua xo so mien bac, truc tiep ket qua xo so mien bac';
                $this->metaDescription = 'Tường thuật trực tiếp xổ số miền Bắc vào lúc 18h15 hàng ngày. xosothantai.vn tường thuật KQXSMB-XSMB-XSTD-XSHN tại trường quay nhanh nhất Việt Nam.';
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/mienbac");
            }

            if(date("H",time()) < LoadConfig::$region["mb"]["hour_live"]){
                $date = date('d-m-Y',time()-86400);
                $data = KetquaMienbac::getDataByDate($date);
                if(!$data){
                    $data = LoadConfig::$result_mb;
                    $data["ngay_quay"] = $date;
                }

            }elseif(date("H",time()) > LoadConfig::$region["mb"]["hour_live"]){
                $date = date('d-m-Y',time());
                $data = KetquaMienbac::getDataByDate($date);
                if(!$data){
                    $data = LoadConfig::$result_mb;
                    $data["ngay_quay"] = $date;
                }
            }else{
                $date = date('d-m-Y',time());
                $key_cache = "Service.veso.ketquamienbac.giai";
                //$cache = Yii::app()->cache->getMemCache()->get($key_cache);
                $cache = Yii::app ()->cache->get($key_cache);
                if($cache){
                    $data = $cache;
                }else{
                    $data = LoadConfig::$result_mb;
                }
            }
            $all_province = Provinces::getDataInDay($date);
            $provinces = $all_province[1];
            $loto = Common::getLotoMB($data);
            list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times(1,1);
            $data_gan = array();
            $this->render("mienbac",
                array(
                    "data"=>$data
                    ,"loto"=>$loto
                    ,"ngay_quay"=>$date
                    ,"data_tk10"=>$data_tk10
                    ,"data_tk20"=>$data_tk20
                    ,"data_gan"=>$data_gan
                    ,"provinces"=>$provinces
                )
            );
        }

        public function actionLoadKqMB(){
            $time1 = time();
            $date = date("Y-m-d",time());  
            $all_province = Provinces::getDataInDay($date);
            $provinces = $all_province[1];            
            $key_cache = "Service.veso.ketquamienbac.giai";
            $cache = Yii::app()->cache->get($key_cache);
            $time2 = time();
            if($cache){
                $data = $cache;     
            }else{             
                $data = LoadConfig::$result_mb;
            }
            $loto = Common::getLotoMB($data);
            $province = reset($provinces);
            $this->renderPartial("load_kqmb",array("data"=>$data,"loto"=>$loto,"province"=>$province));
        }
        
        public function actionMientrung(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/index"),"title"=>"Trực tiếp xổ số"); 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/mientrung"),"title"=>"Xổ số miền trung");
            if($this->metaTitles ==''){
                $this->metaTitles = 'Kết quả xổ số Miền Trung trực tiếp| XSTT miền Trung-XSMN nhanh nhất';
                $this->metaKeywords = 'xo so truc tiep mien trung, xem tuong thuat truc tiep ket qua xo so mien trung, truc tiep ket qua xo so mien trung';
                $this->metaDescription = 'Tường thuật trực tiếp xổ số miền Trung tất cả các tỉnh vào lúc 17h15p hàng ngày. xosothantai.vn tường thuật XSMT và KQXS tại trường quay các tỉnh nhanh nhất Việt nam ';
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/mientrung");
            }   

            if(date("H",time()) < LoadConfig::$region["mt"]["hour_live"]){
               
                $date = date('Y-m-d',time()-86400);
                $all_province = Provinces::getDataInDay($date);
                $provinces = $all_province[2];  
                krsort($provinces);
                $province_ids = array();
                foreach($provinces as $value){
                    $province_ids[] = $value["id"];
                }
                $data = KetquaMientrung::getDataByDate($date);
                foreach($provinces as $value){
                    if(empty($data[$value["id"]])){
                        $data[$value["id"]] = LoadConfig::$result_mt;
                        $data[$value["id"]]["ngay_quay"] = $date;
                    }
                }
            }elseif(date("H",time()) > LoadConfig::$region["mt"]["hour_live"]){
                
                $date = date('Y-m-d',time());
                $all_province = Provinces::getDataInDay($date);
                $provinces = $all_province[2];  
                krsort($provinces);
                $province_ids = array();
                foreach($provinces as $value){
                    $province_ids[] = $value["id"];
                }
                $data = KetquaMientrung::getDataByDate($date);
               
                foreach($provinces as $value){
                    if(empty($data[$value["id"]])){
                        $data[$value["id"]] = LoadConfig::$result_mt;
                        $data[$value["id"]]["ngay_quay"] = $date;
                    }
                }
            }else{
                
                $date = date('Y-m-d',time());
                $all_province = Provinces::getDataInDay($date);
                $provinces = $all_province[2];  
                krsort($provinces);
                $province_ids = array();
                foreach($provinces as $value){
                    $province_ids[] = $value["id"];
                }
                foreach($provinces as $value){
                    $key_cache = "Service.veso.ketquamientrung.tinh".$value["id"].".giai";  
                    $cache = Yii::app()->cache->get($key_cache); 
                    if($cache){
                        $data[$value["id"]] = $cache ;
                    }else{
                        $data[$value["id"]] = LoadConfig::$result_mt;
                        $data[$value["id"]]["ngay_quay"] = $date;
                    }
                }
            }       
            foreach($provinces as $value){
                $loto[$value["id"]] = Common::getLotoMT($data[$value["id"]]);
            }

            $first_province = reset($provinces);
            list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times($first_province["region"],$first_province["id"]);
            $data_gan = array();
            $this->render("mientrung",
                array(
                    "data"=>$data
                    ,"loto"=>$loto
                    ,"provinces"=>$provinces
                    ,"ngay_quay"=>$date
                    ,"first_province"=>$first_province
                    ,"province_ids"=>$province_ids
                    ,"data_tk10"=>$data_tk10
                    ,"data_tk20"=>$data_tk20
                    ,"data_gan"=>$data_gan
                )
            );
        }

        public function actionLoadKqMT(){
            $time1 = time();
            $data = array();
            $date = date("Y-m-d",time());
            $all_province = Provinces::getDataInDay($date);
            $provinces = $all_province[2];
            krsort($provinces);
            foreach($provinces as $key=>$value){       
                if($value){        
                    $key_cache = "Service.veso.ketquamientrung.tinh".$value["id"].".giai";  
                    $cache = Yii::app()->cache->get($key_cache); 
                    if($cache){
                        $data[$value["id"]] = $cache ;
                    }else{
                        $data[$value["id"]] = LoadConfig::$result_mt;
                    }
                    $loto[$value["id"]] = Common::getLotoMT($data[$value["id"]]);
                }
            }
            $time2 = time();
            $this->renderPartial("load_kqmt",array("data"=>$data,"loto"=>$loto,"provinces"=>$provinces,"ngay_quay"=>$date));
        }

        public function actionMiennam(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/index"),"title"=>"Trực tiếp xổ số"); 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/miennam"),"title"=>"Xổ số miền nam");
            if($this->metaTitles ==''){
                $this->metaTitles = 'Kết quả xổ số Miền Nam trực tiếp| XSTT miền Nam-XSMN nhanh nhất';
                $this->metaKeywords = 'xo so truc tiep mien nam, xem tuong thuat truc tiep ket qua xo so mien nam, truc tiep ket qua xo so mien nam';
                $this->metaDescription = 'Tường thuật trực tiếp xổ số miền Nam tất cả các tỉnh vào lúc 16h5p hàng ngày. xosothantai.vn tường thuật XSMN và KQXS các tỉnh tại trường quay nhanh nhất Việt nam ';
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/miennam");
            }

            if(date("H",time()) < LoadConfig::$region["mn"]["hour_live"]){
                $date = date('Y-m-d',time()-86400);     
                $all_province = Provinces::getDataInDay($date);
                $provinces = $all_province[3];
                krsort($provinces);
                $province_ids = array();
                foreach($provinces as $value){
                    $province_ids[] = $value["id"];
                }
                list($data,$date) = KetquaMiennam::getDataByProvinceIds($province_ids,$date);
                foreach($provinces as $value){
                    if(empty($data[$value["id"]])){
                        $data[$value["id"]] = LoadConfig::$result_mn;
                        $data[$value["id"]]["ngay_quay"] = $date;
                    }

                }
            }elseif(date("H",time()) > LoadConfig::$region["mn"]["hour_live"]){
                $date = date('Y-m-d',time());
                $all_province = Provinces::getDataInDay($date);
                $provinces = $all_province[3];
                krsort($provinces);
                $province_ids = array();
                foreach($provinces as $value){
                    $province_ids[] = $value["id"];
                }
                list($data,$date) = KetquaMiennam::getDataByProvinceIds($province_ids,$date);
                foreach($provinces as $value){
                    if(empty($data[$value["id"]])){
                        $data[$value["id"]] = LoadConfig::$result_mn;
                        $data[$value["id"]]["ngay_quay"] = $date;
                    }

                }
            }else{
                $date = date('Y-m-d',time());
                $all_province = Provinces::getDataInDay($date);
                $provinces = $all_province[3];
                krsort($provinces);
                $province_ids = array();
                foreach($provinces as $value){
                    $province_ids[] = $value["id"];
                }
                foreach($provinces as $value){
                    $key_cache = "Service.veso.ketquamiennam.tinh".$value["id"].".giai"; 
                    $cache = Yii::app()->cache->get($key_cache);                     
                    if($cache){
                        $data[$value["id"]] = $cache;
                    }else{
                        $data[$value["id"]] = LoadConfig::$result_mn;
                        $data[$value["id"]]["ngay_quay"] = $date;
                    }
                }
            }

            foreach($provinces as $value){ 
                $loto[$value["id"]] = Common::getLotoMN($data[$value["id"]]);
            }
            $first_province = reset($provinces);
            list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times($first_province["region"],$first_province["id"]);
            $data_gan = array();
            $this->render("miennam",
                array(
                    "data"=>$data
                    ,"loto"=>$loto
                    ,"provinces"=>$provinces
                    ,"ngay_quay"=>$date
                    ,"first_province"=>$first_province
                    ,"province_ids"=>$province_ids
                    ,"data_tk10"=>$data_tk10
                    ,"data_tk20"=>$data_tk20
                    ,"data_gan"=>$data_gan
                )
            );
        }

        public function actionLoadKqMN(){
            $time1 = time();
            $data = array();
            $date = date("Y-m-d",time());
            $all_province = Provinces::getDataInDay($date);
            $provinces = $all_province[3];
            krsort($provinces);
            foreach($provinces as $key=>$value){       
                if($value){        
                    $key_cache = "Service.veso.ketquamiennam.tinh".$value["id"].".giai"; 
                    $cache = Yii::app()->cache->get($key_cache);                  
                    if($cache){
                        $data[$value["id"]] = $cache;
                    }else{
                        $data[$value["id"]] = LoadConfig::$result_mn;
                    }
                    $loto[$value["id"]] = Common::getLotoMN($data[$value["id"]]);
                }
            }
            $time2 = time();
            $this->renderPartial("load_kqmn",array("data"=>$data,"loto"=>$loto,"provinces"=>$provinces,"ngay_quay"=>$date));
        }

        public function actionDientoan(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/dientoan"),"title"=>"Kết quả xổ số điện toán");
            $this->metaTitles = 'Kết quả xổ số Điện toán | KQXS Điện toán nhanh nhất';
            $this->metaKeywords = 'xs dien toan, xsdien toan';
            $this->metaDescription = 'Tường thuật trực tiếp xổ số điện toán tại Hội đồng XSTD-XSMB-XSHN tại số 1 Tăng Bạt Hổ. Mời quý vị đón xem';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/dientoan");

            list($dt123,$dt6x36,$thantai) = Dientoan::getDataByDate(); 
            $this->render("dientoan",array(
                "dt123"=>$dt123
                ,"dt6x36"=>$dt6x36
                ,"thantai"=>$thantai
            ));
        }


        public function actionLoadThongkeBoso(){
            $province_id = isset($_POST["province_id"]) ? intval($_POST["province_id"]):0;
            $first_province = Provinces::getDataById($province_id);
            if($first_province){
                list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times($first_province["region"],$first_province["id"]);
                $data_gan = array();
                $this->renderPartial("load_tk_boso",
                    array(
                        "first_province"=>$first_province
                        ,"data_tk10"=>$data_tk10
                        ,"data_tk20"=>$data_tk20
                        ,"data_gan"=>$data_gan
                    )
                );
            }
        }

        public function actionLastDientoan(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/dientoan"),"title"=>"Kết quả xổ số điện toán");
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/lastDientoan"),"title"=>"Kết quả xổ số điện toán hôm qua");
            $search["begin"] = "";
            $search["end"] = "";  
            $ngay_quay = date('d-m-Y',time()-86400);
            list($dt123,$dt6x36,$thantai) = Dientoan::getDataByDate($ngay_quay);  
            $this->metaTitles = 'Xo so dien toan hom qua - Xem ket qua xo so dien toan ngay hom qua';
            $this->metaKeywords = 'xo so dien toan, ket qua dien toan, xem ket qua xo so dien toan ngay';
            $this->metaDescription = 'Xổ số điện toán. Xem kết quả xổ số điện toán 123, xổ số điện toán 6x36, xổ số thần tài mở thưởng hàng ngày nhanh, chính xác';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/lastDientoan");
            $this->render("application.views.result.dientoan",
                array(
                    "dt123"=>$dt123
                    ,"dt6x36"=>$dt6x36
                    ,"thantai"=>$thantai
                    ,"ngay_quay"=>$ngay_quay
                    ,"search"=>$search
                )
            );
        }

        public function actionLastMienbac(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMienbac"),"title"=>"Kết quả xổ số miền bắc"); 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/lastMienbac"),"title"=>"Kết quả xổ số miền bắc hôm qua");

            $this->metaTitles = 'Xo so mien bac hom qua, Ket qua xo so mien bac hom qua';
            $this->metaKeywords = 'ket qua xo so mien bac, xo so mien bac ngay hom qua';
            $this->metaDescription = 'Xổ số miền bắc hôm qua. Xem kết quả xổ số miền bắc ngày hôm qua, ngày quay trước nhanh nhất trên xosothantai.vn';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/lastMienbac");
            $ngay_quay = date('d-m-Y',time()-86400);
            $data = KetquaMienbac::getDataByDate($ngay_quay);  
            if($data){               
                $data = array($data);
            }else{
                $data = LoadConfig::$result_mb;
                $data["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                $data = array($data);  
            }
            $max_page = 1;$page = 1;$total = 0;
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[1];
            $this->render("application.views.result.mienbac",
                array(
                    "data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"provinces_rg"=>$provinces_rg
                    ,"last"=>1
                )
            );
        }

        public function actionLastMiennam(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMiennam"),"title"=>"Kết quả xổ số miền nam"); 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/lastMiennam"),"title"=>"Kết quả xổ số miền nam hôm qua");

            $this->metaTitles = 'Xo so mien nam hom qua, Ket qua xo so mien nam hom qua';
            $this->metaKeywords = 'ket qua xo so mien nam, xo so mien nam ngay hom qua';
            $this->metaDescription = 'Xổ số miền nam hôm qua. Xem kết quả xổ số miền nam ngày hôm qua, ngày quay trước nhanh nhất trên xosothantai.vn';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/lastMiennam");
            $ngay_quay = date('d-m-Y',time()-86400);
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[3];
            $data = KetquaMiennam::getDataByDate($ngay_quay);
            if($data){
                $data = array($ngay_quay=>$data);
            }else{
                foreach($provinces_rg as $province){
                    $day = getdate(strtotime($ngay_quay));
                    if($province["thu".LoadConfig::$weekday[$day["wday"]]]==1){
                        $data[$ngay_quay][$province["id"]] = LoadConfig::$result_mn;
                        $data[$ngay_quay][$province["id"]]["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                        $data[$ngay_quay][$province["id"]]["province_id"] = $province["id"];
                    }
                }
            }
            $max_page = 1;$page = 1;$total = 0;
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[3];
            $this->render("application.views.result.miennam",
                array(
                    "provinces_rg"=>$provinces_rg
                    ,"data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"provinces_rg"=>$provinces_rg
                    ,"last"=>1
                    ,"province_ids_live"=>array()
                )
            );
        }
        public function actionLastMientrung(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMientrung"),"title"=>"Kết quả xổ số miền trung"); 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/lastMientrung"),"title"=>"Kết quả xổ số miền trung hôm qua");

            $this->metaTitles = 'Xo so mien trung hom qua, Ket qua xo so mien trung hom qua';
            $this->metaKeywords = 'ket qua xo so mien trung, xo so mien trung ngay hom qua';
            $this->metaDescription = 'Xổ số miền trung hôm qua. Xem kết quả xổ số miền trung ngày hôm qua, ngày quay trước nhanh nhất trên xosothantai.vn';
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/lastMientrung");
            $ngay_quay = date('d-m-Y',time()-86400);
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[2];
            $data = KetquaMientrung::getDataByDate($ngay_quay);
            if($data){
                $data = array($ngay_quay=>$data);
            }else{
                foreach($provinces_rg as $province){
                    $day = getdate(strtotime($ngay_quay));
                    if($province["thu".LoadConfig::$weekday[$day["wday"]]]==1){
                        $data[$ngay_quay][$province["id"]] = LoadConfig::$result_mt;
                        $data[$ngay_quay][$province["id"]]["ngay_quay"] = date('Y-m-d',strtotime($ngay_quay));
                        $data[$ngay_quay][$province["id"]]["province_id"] = $province["id"];
                    }
                }
            }
            $max_page = 1;$page = 1;$total = 0;
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[2];
            $this->render("application.views.result.mientrung",
                array(
                    "provinces_rg"=>$provinces_rg
                    ,"data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"provinces_rg"=>$provinces_rg
                    ,"last"=>1
                    ,"province_ids_live"=>array()
                )
            );
        }

        public function actionCalendar(){
            $this->metaTitles = 'Lich quay xo so, Lich mo thuong xo so 3 mien - bac - trung - nam';
            $this->metaKeywords = 'lich quay xo so, lich mo thuong xo so, lich quay xo so 3 mien, lich quay xo so hom nay';
            $this->metaDescription = 'Lịch quay xổ số 3 miền - miền bắc (18h14), miền trung (17h14), miền nam (16h14). Lịch mở thưởng các tỉnh quay ngày thứ 2,3,4,5,6,7,chủ nhật'; 
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/calendar");

            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/calendar"),"title"=>"Lịch quay kết quả xổ số");
            $all_province = Provinces::getAllData(1);
            $provinces = array();
            foreach($all_province as $value){
                for($i=2;$i<=8;$i++){
                    if($value["thu".$i]==1){
                        $provinces[$i][$value["region"]][$value["id"]] = $value;
                    }
                }
            }
            ksort($provinces);
            $this->render("calendar",array("provinces"=>$provinces));
        }

        public function actionGiavang(){
            $this->metaTitles = 'Lich quay xo so, Lich mo thuong xo so 3 mien - bac - trung - nam';
            $this->metaKeywords = 'lich quay xo so, lich mo thuong xo so, lich quay xo so 3 mien, lich quay xo so hom nay';
            $this->metaDescription = 'Lịch quay xổ số 3 miền - miền bắc (18h14), miền trung (17h14), miền nam (16h14). Lịch mở thưởng các tỉnh quay ngày thứ 2,3,4,5,6,7,chủ nhật'; 
            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("home/giavang");

            $this->breadcrumbs[] = array("link"=>Url::createUrl("home/giavang"),"title"=>"Giá Vàng");
            $this->render("gia_vang");
        }
    }
