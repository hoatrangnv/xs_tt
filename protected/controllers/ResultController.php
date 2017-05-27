<?php
    class ResultController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url = null;

        public function init(){
            $this->current_url = Common::getCurrentUrl();
        }

        public function actionIndex(){
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]):0;

            $province = Provinces::getDataById($province_id);

            if($province['region']==3){

                $link_province = Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));
            }elseif($province['region']==2){

                $link_province = Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));
            }else{

                $link_province = Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"province_id"=>$province["id"]));
            }
            $this->redirect($link_province);
        }

        public function actionLoadKqProvince(){
            $province_id = isset($_GET["province_id"]) ? intval($_GET["province_id"]):0;
            $rg = isset($_GET["rg"]) ? trim($_GET["rg"]):"";

            if($rg=="mn"){
                $province = Provinces::getDataById($province_id);
                if($province){
                    $key = "Service.veso.ketquamiennam.tinh".$province_id.".giai";  
                    $cache = Yii::app()->cache->getMemCache()->get($key); 
                    if($cache){
                        $data = $cache ;
                    }else{
                        $data = LoadConfig::$result_mn;
                    }
                    $loto = Common::getLotoMT($data);
                    $this->renderPartial("load_kq_tinh",array("data"=>$data,"loto"=>$loto,"province"=>$province));
                }
            }elseif($rg=="mt"){
                $province = Provinces::getDataById($province_id);
                if($province){
                    $key = "Service.veso.ketquamientrung.tinh".$province_id.".giai";  
                    $cache = Yii::app()->cache->getMemCache()->get($key); 
                    if($cache){
                        $data = $cache ;
                    }else{
                        $data = LoadConfig::$result_mt;
                    }
                    $loto = Common::getLotoMT($data);
                    $this->renderPartial("load_kq_tinh",array("data"=>$data,"loto"=>$loto,"province"=>$province));
                }
            }else{
                $key = "Service.veso.ketquamienbac.giai";
                $cache = Yii::app()->cache->getMemCache()->get($key);
                if($cache){
                    $data = $cache;     
                }else{             
                    $data = LoadConfig::$result_mb;
                }
                $province = Provinces::getDataById($province_id);
                $loto = Common::getLotoMB($data);
                $this->renderPartial("application.views.home.load_kqmb",array("data"=>$data,"loto"=>$loto,"province"=>$province));
            }
        }
        public function actionDientoan(){

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = "";
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            } 
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/dientoan"),"title"=>"Kết quả điện toán");  
            if(!empty($ngay_quay)){
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                $url = Yii::app()->params["http_url"].Url::createUrl("result/dientoan",array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay)))); 
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số điện toán ngày ".$ngay_quay."");       
                if($this->current_url != $url){$this->redirect($url);exit;} 

                $this->metaTitles = 'Xo so dien toan ngay '.str_replace("-","/",$ngay_quay).', Ket qua xo so dien toan '.str_replace("-","/",$ngay_quay).'';
                $this->metaKeywords = 'xo so dien toan '.str_replace("-","/",$ngay_quay).', xem ket qua xo so dien toan ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Xổ số điện toán ngày '.str_replace("-","/",$ngay_quay).'. Xem kết quả xổ số điện toán hàng ngày nhanh nhất - xoso.me';
                $this->linkCanoncical = $url;
            }else{
                $url = Yii::app()->params["http_url"].Url::createUrl("result/dientoan");        
                if($this->current_url != $url){$this->redirect($url);exit;}
                
                $this->metaTitles = 'Kết quả xổ số Điện toán của hội đồng Xổ số thủ đô';
                $this->metaKeywords = '';
                $this->metaDescription = 'Trang cung cấp thông tin KQXS điện toán-XS Điện toán, bạn có thể xem kết quả mới nhất hoặc tra cứu theo từng ngày mà bạn đã mua.';
                $this->linkCanoncical = $url;
            }

            list($dt123,$dt6x36,$thantai) = Dientoan::getDataByDate($ngay_quay);   
            $this->render("dientoan",
                array(
                    "dt123"=>$dt123
                    ,"dt6x36"=>$dt6x36
                    ,"thantai"=>$thantai
                    ,"ngay_quay"=>$ngay_quay
                )
            );
        }

        public function actionMienbac(){

            $rg="mb";
            $province_id = isset($_GET["province_id"])  ? intval($_GET["province_id"])  :0;

            $page = isset($_GET["page"]) && intval($_GET["page"]) > 1 ? intval($_GET["page"]) : 1; 

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = "";
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            }   

            $all_province = Provinces::getAllData();
            if(!isset($all_province[1][$province_id])){
                if(isset($all_province[2][$province_id])){
                    if(!empty($ngay_quay)){
                        $url_province = Url::createUrl("result/mientrung",array("province_name"=>$all_province[2][$province_id]["alias"],"code"=>$all_province[2][$province_id]["code"],"province_id"=>$all_province[2][$province_id]["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                    }else{
                        $url_province = Url::createUrl("result/mientrung",array("province_name"=>$all_province[2][$province_id]["alias"],"code"=>$all_province[2][$province_id]["code"],"province_id"=>$all_province[2][$province_id]["id"]));        
                    }
                 //   $this->redirect($url_province);
                }elseif(isset($all_province[3][$province_id])){
                    if(!empty($ngay_quay)){
                        $url_province = Url::createUrl("result/miennam",array("province_name"=>$all_province[3][$province_id]["alias"],"code"=>$all_province[3][$province_id]["code"],"province_id"=>$all_province[3][$province_id]["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                    }else{
                        $url_province = Url::createUrl("result/miennam",array("province_name"=>$all_province[3][$province_id]["alias"],"code"=>$all_province[3][$province_id]["code"],"province_id"=>$all_province[3][$province_id]["id"]));        
                    }
                  //  $this->redirect($url_province);
                }else{
                    throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống");
                }
            }
            $province = $all_province[1][$province_id];
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMienbac"),"title"=>"Kết quả xổ số miền bắc");

            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"])),"title"=>"Xổ số ".$province["name"]."");
            $wday = Common::getWeekDayBack($province["live"][0]);  

            $this->metaTitles = $province["meta_title_xsme"] != "" ? $province["meta_title_xsme"] :  'Xo so '.str_replace("-"," ",$province["alias"]).' - Truc tiep ket qua xo so '.str_replace("-"," ",$province["alias"]).' hom nay';
            $this->metaKeywords = $province["meta_keyword_xsme"] != "" ? $province["meta_keyword_xsme"] :  'xo so '.str_replace("-"," ",$province["alias"]).', xo so mien bac, xem ket qua xo so '.str_replace("-"," ",$province["alias"]).'';
            $this->metaDescription = $province["meta_description_xsme"] != "" ? $province["meta_description_xsme"] :  'Xổ số '.$province["name"].'. Tường thuật trực tiếp kết quả xổ số miền bắc mở thưởng 18h14 '.$wday['label'].' hàng tuần tại '.$province["name"].' nhanh nhất. xosothantai.vn -Trang xổ số hàng đầu VN ';

            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));



            if(!empty($ngay_quay)){      
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                if(date('Y',strtotime($ngay_quay))<=2012){
                    $this->noindex=1;
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số ".$province["name"]." ngày ".$ngay_quay."");
             //   if($this->current_url != $url){$this->redirect($url);exit;} 

                $this->metaTitles = 'KQXS '.$province["name"].' ngay '.str_replace("-","/",$ngay_quay).', Kết quả XS '.strtoupper($province["code"]).' ngày '.str_replace("-","/",$ngay_quay).' - KQXS '.strtoupper($province["code"]).' ngày '.str_replace("-","/",$ngay_quay).' ';
                $this->metaKeywords = 'xo so '.str_replace("-"," ",$province["alias"]).' ngay '.str_replace("-","/",$ngay_quay).', xem ket qua xo so '.str_replace("-"," ",$province["alias"]).' ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Mời quý vị xem kết quả xổ số '.$province["name"].' ngày '.str_replace("-","/",$ngay_quay).' - KQXS '.$province["name"].' ngày '.str_replace("-","/",$ngay_quay).'. xosothantai.vn trang web xem kết quả xổ số trực tuyến hàng đầu Việt Nam ';
                $this->linkCanoncical = $url;
                $data = KetquaMienbac::getDataByDate($ngay_quay,$province["live"]);
 
                $loto = $data ? Common::getLotoMB($data) : array();
                list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times(1,1);
                $data_gan = TkChukyBoso::getDataLotoGanInTimes(1,10);
                $this->render("index",
                    array(
                        "data"=>$data
                        ,"data_tk10"=>$data_tk10
                        ,"data_tk20"=>$data_tk20
                        ,"data_gan"=>$data_gan
                        ,"ngay_quay"=>$ngay_quay
                        ,"province"=>$province
                        ,"loto"=>$loto
                        ,"rg"=>$rg
                    )
                );
            }else{
                $row_per_page = 10;
                if($page >1){
                    $this->metaTitles = $this->metaTitles.' | trang'.$page;
                    $this->metaDescription = $this->metaDescription.' - trang '.$page;
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page));        
                    //if($this->current_url != $url){$this->redirect($url);exit;}
                    $this->linkCanoncical = $url;
                }else{
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));        
                  //  if($this->current_url != $url){$this->redirect($url);exit;}
                }

                list($data,$max_page,$total) = KetquaMienbac::getDataListByWday($province["live"],$page,$row_per_page);
                if($max_page >1){
                    $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page+1));
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("result/mienbac",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page-1));
                    }
                }
                foreach($data as $value){
                    $loto[$value["id"]] = Common::getLotoMB($value);
                }
                $this->render("index_list",
                    array(
                        "data"=>$data
                        ,"page"=>$page
                        ,"row_per_page"=>$row_per_page
                        ,"max_page"=>$max_page
                        ,"total"=>$total
                        ,"province"=>$province
                        ,"loto"=>$loto
                        ,"rg"=>$rg
                    )
                );
            }
        }

        public function actionMiennam(){
            $rg="mn";
            $province_id = isset($_GET["province_id"])  ? intval($_GET["province_id"])  :0;
            $page = isset($_GET["page"]) && intval($_GET["page"]) > 1 ? intval($_GET["page"]) : 1;

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = "";
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            }

            $all_province = Provinces::getAllData();   
            if(!isset($all_province[3][$province_id])){
                if(isset($all_province[2][$province_id])){
                    if(!empty($ngay_quay)){
                        $url_province = Url::createUrl("result/mientrung",array("province_name"=>$all_province[2][$province_id]["alias"],"code"=>$all_province[2][$province_id]["code"],"province_id"=>$all_province[2][$province_id]["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                    }else{
                        $url_province = Url::createUrl("result/mientrung",array("province_name"=>$all_province[2][$province_id]["alias"],"code"=>$all_province[2][$province_id]["code"],"province_id"=>$all_province[2][$province_id]["id"]));        
                    }
                    //$this->redirect($url_province);
                }elseif(isset($all_province[1][$province_id])){
                    if(!empty($ngay_quay)){
                        $url_province = Url::createUrl("result/mienbac",array("province_name"=>$all_province[1][$province_id]["alias"],"code"=>$all_province[1][$province_id]["code"],"province_id"=>$all_province[1][$province_id]["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                    }else{
                        $url_province = Url::createUrl("result/mienbac",array("province_name"=>$all_province[1][$province_id]["alias"],"code"=>$all_province[1][$province_id]["code"],"province_id"=>$all_province[1][$province_id]["id"]));        
                    }
                  //  $this->redirect($url_province);
                }else{
                    throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống");
                }
            }

            $province = $all_province[3][$province_id];
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMiennam"),"title"=>"Kết quả xổ số miền nam");

            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"])),"title"=>"Xổ số ".$province["name"]."");
            $wday = Common::getWeekDayBack($province["live"][0]);
            $this->metaTitles = $province["meta_title_xsme"] != "" ? $province["meta_title_xsme"] :  'Xo so '.str_replace("-"," ",$province["alias"]).' - Truc tiep ket qua xo so '.str_replace("-"," ",$province["alias"]).' hom nay';
            $this->metaKeywords = $province["meta_keyword_xsme"] != "" ? $province["meta_keyword_xsme"] :  'xo so '.str_replace("-"," ",$province["alias"]).', xo so mien nam, xem ket qua xo so '.str_replace("-"," ",$province["alias"]).'';
            $this->metaDescription = $province["meta_description_xsme"] != "" ? $province["meta_description_xsme"] :  'Xổ số '.$province["name"].'. Tường thuật trực tiếp kết quả xổ số '.$province["name"].' mở thưởng 17h14 '.$wday["label"].' hàng tuần nhanh nhất. xosothantai.vn -Trang xổ số hàng đầu VN ';

            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));

            if(!empty($ngay_quay)){
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                if(date('Y',strtotime($ngay_quay))<=2012){
                    $this->noindex=1;
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số ".$province["name"]." ngày ".$ngay_quay."");
               // if($this->current_url != $url){$this->redirect($url);exit;} 

                $this->metaTitles = 'KQXS '.$province["name"].' ngay '.str_replace("-","/",$ngay_quay).', Kết quả XS '.strtoupper($province["code"]).' ngày '.str_replace("-","/",$ngay_quay).' - KQXS '.strtoupper($province["code"]).' ngày '.str_replace("-","/",$ngay_quay).' ';
                $this->metaKeywords = 'xo so '.str_replace("-"," ",$province["alias"]).' ngay '.str_replace("-","/",$ngay_quay).', xem ket qua xo so '.str_replace("-"," ",$province["alias"]).' ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Mời quý vị xem kết quả xổ số '.$province["name"].' ngày '.str_replace("-","/",$ngay_quay).' - KQXS '.$province["name"].' ngày '.str_replace("-","/",$ngay_quay).'. xosothantai.vn trang web xem kết quả xổ số trực tuyến hàng đầu Việt Nam ';
                $this->linkCanoncical = $url;
                $data = KetquaMiennam::getDataByProvinceAndDate($province_id,$ngay_quay);

                $loto = $data ? Common::getLotoMN($data) : array();
                list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times(3,$province_id);
                $data_gan = TkChukyBoso::getDataLotoGanInTimes($province_id,10);

                $this->render("index",
                    array(
                        "data"=>$data
                        ,"data_tk10"=>$data_tk10
                        ,"data_tk20"=>$data_tk20
                        ,"data_gan"=>$data_gan
                        ,"ngay_quay"=>$ngay_quay
                        ,"province"=>$province
                        ,"loto"=>$loto
                        ,"rg"=>$rg
                    )
                );
            }else{
                if($page >1){
                    $this->metaTitles = $this->metaTitles.' | trang'.$page;
                    $this->metaDescription = $this->metaDescription.' - trang '.$page;
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page));        
                    $this->linkCanoncical = $url;
                    //if($this->current_url != $url){$this->redirect($url);exit;}
                }else{
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));        
                    //if($this->current_url != $url){$this->redirect($url);exit;}
                }


                $row_per_page = 10;
                list($data,$max_page,$total) = KetquaMiennam::getDataListByProvince($province_id,$page,$row_per_page);

                if($max_page >1){
                    $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page+1));
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("result/miennam",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page-1));
                    }
                }

                foreach($data as $value){
                    $loto[$value["id"]] = Common::getLotoMN($value);
                }
                $this->render("index_list",
                    array(
                        "data"=>$data
                        ,"page"=>$page
                        ,"row_per_page"=>$row_per_page
                        ,"max_page"=>$max_page
                        ,"total"=>$total
                        ,"province"=>$province
                        ,"loto"=>$loto
                        ,"rg"=>$rg
                    )
                );
            }

        }

        public function actionMientrung(){
            $rg="mt";
            $province_id = isset($_GET["province_id"])  ? intval($_GET["province_id"])  :0;
            $page = isset($_GET["page"]) && intval($_GET["page"]) > 1 ? intval($_GET["page"]) : 1;

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = "";
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            }

            $all_province = Provinces::getAllData();
            if(!isset($all_province[2][$province_id])){
                if(isset($all_province[3][$province_id])){
                    if(!empty($ngay_quay)){
                        $url_province = Url::createUrl("result/miennam",array("province_name"=>$all_province[3][$province_id]["alias"],"code"=>$all_province[3][$province_id]["code"],"province_id"=>$all_province[3][$province_id]["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                    }else{
                        $url_province = Url::createUrl("result/miennam",array("province_name"=>$all_province[3][$province_id]["alias"],"code"=>$all_province[3][$province_id]["code"],"province_id"=>$all_province[3][$province_id]["id"]));        
                    }
                //    $this->redirect($url_province);
                }elseif(isset($all_province[1][$province_id])){
                    if(!empty($ngay_quay)){
                        $url_province = Url::createUrl("result/mienbac",array("province_name"=>$all_province[1][$province_id]["alias"],"code"=>$all_province[1][$province_id]["code"],"province_id"=>$all_province[1][$province_id]["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                    }else{
                        $url_province = Url::createUrl("result/mienbac",array("province_name"=>$all_province[1][$province_id]["alias"],"code"=>$all_province[1][$province_id]["code"],"province_id"=>$all_province[1][$province_id]["id"]));        
                    }
                  //  $this->redirect($url_province);
                }else{
                    throw new CHttpException(405, "Không tồn tại tỉnh thành này trong hệ thống");
                }
            }
            $province = $all_province[2][$province_id];
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMientrung"),"title"=>"Kết quả xổ số miền trung");

            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"])),"title"=>"Xổ số ".$province["name"]."");
            $wday = Common::getWeekDayBack($province["live"][0]);
            $this->metaTitles = $province["meta_title_xsme"] != "" ? $province["meta_title_xsme"] :  'Xo so '.str_replace("-"," ",$province["alias"]).' - Truc tiep ket qua xo so '.str_replace("-"," ",$province["alias"]).' hom nay';
            $this->metaKeywords = $province["meta_keyword_xsme"] != "" ? $province["meta_keyword_xsme"] :  'xo so '.str_replace("-"," ",$province["alias"]).', xo so mien trung, xem ket qua xo so '.str_replace("-"," ",$province["alias"]).'';
            $this->metaDescription = $province["meta_description_xsme"] != "" ? $province["meta_description_xsme"] :  'Xổ số '.$province["name"].'. Tường thuật trực tiếp kết quả xổ số '.$province["name"].' mở thưởng 17h14 '.$wday["label"].' hàng tuần nhanh nhất. xos.me -Trang xổ số hàng đầu VN ';

            $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));
            if(!empty($ngay_quay)){
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                if(date('Y',strtotime($ngay_quay))<=2012){
                    $this->noindex=1;
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));        
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số ".$province["name"]." ngày ".$ngay_quay."");
               // if($this->current_url != $url){$this->redirect($url);exit;} 

                $this->metaTitles = 'KQXS '.$province["name"].' ngay '.str_replace("-","/",$ngay_quay).', Kết quả XS '.strtoupper($province["code"]).' ngày '.str_replace("-","/",$ngay_quay).' - KQXS '.strtoupper($province["code"]).' ngày '.str_replace("-","/",$ngay_quay).' ';
                $this->metaKeywords = 'xo so '.str_replace("-"," ",$province["alias"]).' ngay '.str_replace("-","/",$ngay_quay).', xem ket qua xo so '.str_replace("-"," ",$province["alias"]).' ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Mời quý vị xem kết quả xổ số '.$province["name"].' ngày '.str_replace("-","/",$ngay_quay).' - KQXS '.$province["name"].' ngày '.str_replace("-","/",$ngay_quay).'. xosothantai.vn trang web xem kết quả xổ số trực tuyến hàng đầu Việt Nam ';
                $this->linkCanoncical = $url;
                $data = KetquaMientrung::getDataByProvinceAndDate($province_id,$ngay_quay);
                $loto = $data ? Common::getLotoMT($data) : array();
                list($data_tk10,$data_tk20) = TkLoto::getCountBosoIn40Times(2,$province_id);
                $data_gan = TkChukyBoso::getDataLotoGanInTimes($province_id,10);
                $this->render("index",
                    array(
                        "data"=>$data
                        ,"data_tk10"=>$data_tk10
                        ,"data_tk20"=>$data_tk20
                        ,"data_gan"=>$data_gan
                        ,"ngay_quay"=>$ngay_quay
                        ,"province"=>$province
                        ,"loto"=>$loto
                        ,"rg"=>$rg
                    )
                );
            }else{
                if($page >1){
                    $this->metaTitles = $this->metaTitles.' | trang'.$page;
                    $this->metaDescription = $this->metaDescription.' - trang '.$page;
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page));        
                 //   if($this->current_url != $url){$this->redirect($url);exit;}
                    $this->linkCanoncical = $url;
                }else{
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"]));        
                 //   if($this->current_url != $url){$this->redirect($url);exit;}
                }

                if($max_page >1){
                    $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page+1));
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("result/mientrung",array("province_name"=>$province["alias"],"code"=>$province["code"],"province_id"=>$province["id"],"page"=>$page-1));
                    }
                }

                $row_per_page = 10;
                list($data,$max_page,$total) = KetquaMientrung::getDataListByProvince($province_id,$page,$row_per_page);

                foreach($data as $value){
                    $loto[$value["id"]] = Common::getLotoMT($value);
                }
                
                $this->render("index_list",
                    array(
                        "data"=>$data
                        ,"page"=>$page
                        ,"row_per_page"=>$row_per_page
                        ,"max_page"=>$max_page
                        ,"total"=>$total
                        ,"province"=>$province
                        ,"loto"=>$loto
                        ,"rg"=>$rg
                    )
                );
            }

        }

        public function actionKqMienbac(){  

            $row_per_page =4;
            $page = isset($_GET["page"]) && intval($_GET["page"]) >0 ? intval($_GET["page"]) : 1;

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = date('d-m-Y');
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            }

            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMienbac"),"title"=>"Kết quả xổ số miền bắc");
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[1];
            $this->metaTitles = 'KQXSMB | Kết quả xố số miền Bắc Nhanh nhất-XSMB nhanh nhất';
            $this->metaKeywords = 'KQXSMB, KQSXMB, SXMB, XSMB, XSTD, SXTD, XSHN, SXHN, xs mienBac, sx mienbac, XSKTMB, XSKT MienBac, SXKTMB, SXKT MienBac';
            $this->metaDescription = 'Kết quả xổ số miền Bắc nhanh và chính xác nhất Việt Nam. xosothantai.vn cung cấp dữ liệu XSMB-KQXSMB từ năm 2000 đến nay và được đánh giá trang kết quả xổ số hàng đầu';
            if(isset($_GET["ngay"])){
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                if(date('Y',strtotime($ngay_quay))<=2012){
                    $this->noindex=1;
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac",array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));  
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số miền bắc ngày ".$ngay_quay);      
                //if($this->current_url != $url){$this->redirect($url);exit;} 
                $str_data = Common::getStringProvince(strtotime($ngay_quay),$provinces_rg);                
                $this->metaTitles = 'Ket qua xo so mien bac ngay '.str_replace("-","/",$ngay_quay).' | kqxsmb '.str_replace("-","/",$ngay_quay).'';
                $this->metaKeywords = 'ket qua xo so mien bac hang ngay, xem ket qua xo so mien bac theo ngay, xo so mien bac ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Kết quả xổ số miền bắc ngày '.str_replace("-","/",$ngay_quay).'. Xem kết quả xố số miền bắc mở thưởng '.Common::getDateFormat(strtotime($ngay_quay),2).' trên xosothantai.vn';
                $this->linkCanoncical = $url;  
                
                $province_now = Provinces::getDataInDay($ngay_quay);   
                  
            }else{
                if(isset($_GET["page"])){
                    if($page <=1){
                        $this->redirect(Url::createUrl("result/kqMienbac"));
                    }
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac",array("page"=>$page));        
                    if($this->current_url != $url){$this->redirect($url);exit;}

                    $this->metaTitles = $this->metaTitles . ' - trang '.$page;
                    $this->metaKeywords = $this->metaKeywords . ', trang '.$page;
                    $this->metaDescription = $this->metaDescription .' - trang '.$page;
                    $this->linkCanoncical = $url;
                }else{
                    $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac");
                    //$url = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac");        
                    //if($this->current_url != $url){$this->redirect($url);exit;}
                }
                
                $province_now = Provinces::getDataInDay(date('d-m-Y'));

            }
            $province_mb = reset($province_now[1]);
            if(!empty($_GET["ngay"])){
                $data = KetquaMienbac::getDataByDate($ngay_quay); 

                if($data){ 
                    $data = array($data);
                }
                $max_page = 1;$page = 1;$total = 0;
            }else{
                list($data,$max_page,$total) = KetquaMienbac::getDataList($page,$row_per_page);
                if($max_page >1){
                    $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac",array("page"=>$page+1));
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("result/kqMienbac",array("page"=>$page-1));
                    }
                }
            }

            $this->render("mienbac",
                array(
                    "data"=>$data
                    ,"provinces_rg"=>$provinces_rg
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"province_mb"=>$province_mb
                    ,"ngay_quay"=>$ngay_quay
                )
            );
        } 

        public function actionKqMiennam(){
            $row_per_page =4;
            $page = isset($_GET["page"]) && intval($_GET["page"]) >0 ? intval($_GET["page"]) : 1;

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = date('d-m-Y');
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            }

            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMiennam"),"title"=>"Kết quả xổ số miền nam");
            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[3];
            $this->metaTitles = 'KQXSMN | Kết quả xố số miền Nam Nhanh nhất-XSMN nhanh nhất';
            $this->metaKeywords = 'xo so mien nam, kqxs mien nam, kqxsmn, xsmn, xs mien nam, ket qua mien nam';
            $this->metaDescription = 'Kết quả xổ số miền Nam nhanh và chính xác nhất Việt Nam. xosothantai.vn cung cấp dữ liệu XSMN-KQXSMN từ năm 2000 đến nay và được đánh giá trang kết quả xổ số hàng đầu';
            if(isset($_GET["ngay"])){
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                if(date('Y',strtotime($ngay_quay))<=2012){
                    $this->noindex=1;
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam",array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));   
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số miền nam ngày ".$ngay_quay);           
               // if($this->current_url != $url){$this->redirect($url);exit;} 

                $str_data = Common::getStringProvince(strtotime($ngay_quay),$provinces_rg);  
                $this->metaTitles = 'Ket qua xo so mien nam ngay '.str_replace("-","/",$ngay_quay).', Kqxs mien nam '.str_replace("-","/",$ngay_quay).'';
                $this->metaKeywords = 'ket qua xo so mien nam hang ngay, xem ket qua xo so mien nam theo ngay, ket qua xo so mien nam ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Kết quả xổ số miền nam ngày '.str_replace("-","/",$ngay_quay).'. Xem kết quả xổ số '.implode(",",$str_data[3]).' '.Common::getDateFormat(strtotime($ngay_quay),2).' trên xosothantai.vn';
                $this->linkCanoncical = $url; 
            }else{
                if(isset($_GET["page"])){
                    if($page <=1){
                        $this->redirect(Url::createUrl("result/kqMiennam"));
                    }
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam",array("page"=>$page));        
                  //  if($this->current_url != $url){$this->redirect($url);exit;}

                    $this->metaTitles = $this->metaTitles . ' - trang '.$page;
                    $this->metaKeywords = $this->metaKeywords . ', trang '.$page;
                    $this->metaDescription = $this->metaDescription . ' - trang '.$page;
                    $this->linkCanoncical = $url;
                }else{
                    //$url = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam");        
                    //if($this->current_url != $url){$this->redirect($url);exit;}
                    $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam");
                }
                
                
            }
            $province_ids_live = array();
            if(!empty($_GET["ngay"])){
                $data = KetquaMiennam::getDataByDate($ngay_quay);
                foreach($provinces_rg as $province){
                    $day = getdate(strtotime($ngay_quay));
                    if($province["thu".LoadConfig::$weekday[$day["wday"]]]==1){
                        $province_ids_live[] = $province["id"];
                    }
                }
                if($data){
                    $data = array($ngay_quay=>$data);
                }
                $max_page = 1;$page = 1;$total = 0;
            }else{
                list($data,$max_page,$total) = KetquaMiennam::getDataList($page,$row_per_page);
                if($max_page >1){
                    $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam",array("page"=>$page+1));
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("result/kqMiennam",array("page"=>$page-1));
                    }
                }
            }       

            $this->render("miennam",
                array(
                    "provinces_rg"=>$provinces_rg
                    ,"data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"province_ids_live"=>$province_ids_live
                    ,"ngay_quay"=>$ngay_quay
                )
            );
        }

        public function actionKqMientrung(){
            $row_per_page =4;
            $page = isset($_GET["page"]) && intval($_GET["page"]) >0 ? intval($_GET["page"]) : 1;

            $ngay = isset($_GET["ngay"]) ? intval($_GET["ngay"]) : 0;
            $thang = isset($_GET["thang"]) ? intval($_GET["thang"]) : 0;
            $nam = isset($_GET["nam"]) ? intval($_GET["nam"]) : 0;
            $int_ngay = mktime(0,0,0,$thang,$ngay,$nam);
            if($int_ngay < strtotime('31-12-2008') || $int_ngay > strtotime('01-01-'.(date('Y')+1))){
                $ngay_quay = date('d-m-Y');
            }else{
                $ngay_quay = date('d-m-Y',$int_ngay);
            }

            $all_province = Provinces::getAllData();
            $provinces_rg = $all_province[2];
            $this->breadcrumbs[] = array("link"=>Url::createUrl("result/kqMiennam"),"title"=>"Kết quả xổ số miền trung");
            $this->metaTitles = 'KQXSMT | Kết quả xố số miền Trung nhanh nhất-XSMT nhanh nhất';
            $this->metaKeywords = 'xo so mien trung, kqxs mien trung, kqxsmt, xsmt, xs mien trung, ket qua mien trung';
            $this->metaDescription = 'Kết quả xổ số miền Nam nhanh và chính xác nhất Việt Nam. xosothantai.vn cung cấp dữ liệu XSMT-KQXSMT từ năm 2000 đến nay và được đánh giá trang kết quả xổ số hàng đầu';
            if(isset($_GET["ngay"])){
                $ngay_quay = date('d-m-Y',strtotime($ngay_quay));
                if(date('Y',strtotime($ngay_quay))<=2012){
                    $this->noindex=1;
                }
                $url = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung",array("ngay"=>date('d',strtotime($ngay_quay)),"thang"=>date('m',strtotime($ngay_quay)),"nam"=>date('Y',strtotime($ngay_quay))));  
                $this->breadcrumbs[] = array("link"=>$url,"title"=>"Kết quả xổ số miền trung ngày ".$ngay_quay);                 
            //    if($this->current_url != $url){$this->redirect($url);exit;} 

                $str_data = Common::getStringProvince(strtotime($ngay_quay),$provinces_rg);
                $this->metaTitles = 'Ket qua xo so mien trung ngay '.str_replace("-","/",$ngay_quay).', Kqxs mien trung '.str_replace("-","/",$ngay_quay).'';
                $this->metaKeywords = 'ket qua xo so mien trung hang ngay, xem ket qua xo so mien trung theo ngay, ket qua xo so mien trung ngay '.str_replace("-","/",$ngay_quay).'';
                $this->metaDescription = 'Kết quả xổ số miền trung ngày '.str_replace("-","/",$ngay_quay).'. Xem kết quả xổ số '.implode(",",$str_data[2]).' '.Common::getDateFormat(strtotime($ngay_quay),2).' trên xosothantai.vn';
                $this->linkCanoncical = $url; 
            }else{
                if(isset($_GET["page"])){
                    if($page <=1){
                        $this->redirect(Url::createUrl("result/kqMientrung"));
                    }
                    $url = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung",array("page"=>$page));        
                //    if($this->current_url != $url){$this->redirect($url);exit;}

                    $this->metaTitles = $this->metaTitles . ' - trang '.$page;
                    $this->metaKeywords = $this->metaKeywords.', trang '.$page;
                    $this->metaDescription = $this->metaDescription.' - trang '.$page;
                    $this->linkCanoncical = $url;
                }else{
                    //$url = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung");        
                    //if($this->current_url != $url){$this->redirect($url);exit;}
                    $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung");
                }
                
            }
            $province_ids_live = array();                                      
            if(!empty($_GET["ngay"])){
                $data = KetquaMientrung::getDataByDate($ngay_quay);
                foreach($provinces_rg as $province){
                    $day = getdate(strtotime($ngay_quay));
                    if($province["thu".LoadConfig::$weekday[$day["wday"]]]==1){
                        $province_ids_live[] = $province["id"];
                    }
                }
                if($data){
                    $data = array($ngay_quay=>$data);
                }
                $max_page = 1;$page = 1;$total = 0;
            }else{     
                list($data,$max_page,$total) = KetquaMientrung::getDataList($page,$row_per_page);
                if($max_page >1){
                    $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung",array("page"=>$page+1));
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("result/kqMientrung",array("page"=>$page-1));
                    }
                }

            }  

            $this->render("mientrung",
                array(
                    "provinces_rg"=>$provinces_rg
                    ,"data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"province_ids_live"=>$province_ids_live
                    ,"ngay_quay"=>$ngay_quay
                )
            );
        }

    }
