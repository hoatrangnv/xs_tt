<?php
    class DreambookController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url;

        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $this->breadcrumbs[] = array("link"=>Url::createUrl("dreambook/index"),"title"=>"Sổ mơ");  
        }


        public function actionIndex(){
            
            $this->metaTitles = 'Giải mã giấc mơ-Giải mộng chiêm bao| Đánh con gì theo chiêm bao';
            $this->metaKeywords = 'hom nay danh con gi, mo danh nhau danh con gi, bi ấn giấc mơ, giải mã chiêm bao, giải mã giấc mơ';
            $this->metaDescription = 'Nếu bạn mơ/chiêm bao điều gì, xosothantai.vn giải mã bí ẩn chiểm bao để quyết định ngày hôm nay đánh con gì';
            if(isset($_GET["page"])){
                $this->metaTitles = 'Giải mã giấc mơ-Giải mộng chiêm bao| Đánh con gì theo chiêm bao - trang '.$_GET["page"];
                $this->metaKeywords = 'hom nay danh con gi, mo danh nhau danh con gi, bi ấn giấc mơ, giải mã chiêm bao, giải mã giấc mơ';
                $this->metaDescription = 'Nếu bạn mơ/chiêm bao điều gì, xosothantai.vn giải mã bí ẩn chiểm bao để quyết định ngày hôm nay đánh con gì - trang '.$_GET["page"]; 
            }
            $row_per_page = 20;
            
            $page = isset($_GET["page"]) && intval($_GET["page"]) >0 ? intval($_GET["page"]):1; 
            $tukhoa = isset($_GET["tukhoa"]) ? trim($_GET["tukhoa"]):"";
            $search["first_word"] = isset($_GET["first_word"]) ? trim($_GET["first_word"]):"";
            if($tukhoa !=""){ 
            
                $this->noindex=1;
                if($page >1){
                    $this->metaTitles = 'Giai ma giac mo '.$tukhoa.', Mo thay '.$tukhoa.' | trang '.$page;
                    $this->metaKeywords = 'giai ma giac mo '.$tukhoa.', y nghia mo thay '.$tukhoa.'';
                    $this->metaDescription = 'Giải mã giấc mơ thấy '.$tukhoa.', Mơ thấy '.$tukhoa.' thì có điềm gì, ý nghĩa giấc mơ và đánh đề con gì.';

                }else{
                    $this->metaTitles = 'Giai ma giac mo '.$tukhoa.', Mo thay '.$tukhoa;
                    $this->metaKeywords = 'giai ma giac mo '.$tukhoa.', y nghia mo thay '.$tukhoa.'';
                    $this->metaDescription = 'Giải mã giấc mơ thấy '.$tukhoa.', Mơ thấy '.$tukhoa.' thì có điềm gì, ý nghĩa giấc mơ và đánh đề con gì.';

                }

                $this->breadcrumbs[] = array("link"=>Url::createUrl("dreambook/index",array("tukhoa"=>$tukhoa)),"title"=>$tukhoa);
               /* if(isset($_GET["page"])){
                    $url = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("tukhoa"=>$tukhoa,"page"=>$_GET["page"]));
                    if($this->current_url != $url){$this->redirect($url);exit;}
                }else{
                    $url = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("tukhoa"=>$tukhoa));
                    if($this->current_url != $url){$this->redirect($url);exit;}
                }  */
                $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("tukhoa"=>$tukhoa));
                list($data,$max_page,$total) = Dreambook::getDataSearchKeyword($tukhoa,$page,$row_per_page);
            }else{
               
                if(!empty($_GET["first_word"])){
                    $this->breadcrumbs[] = array("link"=>Url::createUrl("dreambook/index",array("first_word"=>$search["first_word"])),"title"=>"Bắt đầu bằng " .$search["first_word"]); 
                    $this->metaTitles = 'Sổ mơ số đề, Giải mã giấc mơ đánh lô đề chữ '.$_GET["first_word"];
                    $this->metaKeywords = 'so mo, so mo so de, giai ma giac mo';
                    $this->metaDescription = 'Sổ mơ lô đề bắt đầu bằng chữ '.$_GET["first_word"].'. Giải mã giấc mơ, ý nghĩa những giấc mơ qua những con số. ';

                    if($page >1){
                        $this->metaTitles = $this->metaTitles.' | trang '.$page;
                        $this->metaDescription = $this->metaDescription.' - trang '.$page;
                    }

                    $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("first_word"=>$search["first_word"]));

                    /*if(isset($_GET["page"]) && intval($_GET["page"]) > 1){
                        $url = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("first_word"=>$search["first_word"],"page"=>$_GET["page"]));
                        if($this->current_url != $url){$this->redirect($url);exit;}
                    }else{
                        $url = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("first_word"=>$search["first_word"]));
                        if($this->current_url != $url){$this->redirect($url);exit;}
                    } */
                    list($data,$max_page,$total) = Dreambook::getDataSearch($search,$page,$row_per_page);
                    
                    if($max_page >1){
                        $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("first_word"=>$search["first_word"],"page"=>$page+1));
                        if($page >1){
                            $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("first_word"=>$search["first_word"],"page"=>$page-1));
                        }
                    }
                }else{
            
                  /*  if(isset($_GET["page"]) && intval($_GET["page"]) > 1){
                        $url = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("page"=>$_GET["page"]));
                        if($this->current_url != $url){$this->redirect($url);exit;}
                    }else{
                        $url = Yii::app()->params["http_url"].Url::createUrl("dreambook/index");
                        if($this->current_url != $url){$this->redirect($url);exit;}
                    }     */

                    $this->linkCanoncical = Yii::app()->params["http_url"].Url::createUrl("dreambook/index");
                    list($data,$max_page,$total) = Dreambook::getDataSearch($search,$page,$row_per_page);
                    if($max_page >1){
                        $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("page"=>$page+1));
                        if($page >1){
                            $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("dreambook/index",array("page"=>$page-1));
                        }
                    }
                }
                


            }
            
            $this->render("index",
                array(
                    "data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"search"=>$search
                    ,"tukhoa"=>$tukhoa
                    ,"row_per_page"=>$row_per_page
                )
            );
        }

        public function actionDetail(){
            $tukhoa = "";
            $row_per_page = 5;
            $did = isset($_GET["did"]) ? intval($_GET["did"]):0;
            $data = Dreambook::getDataById($did);
            //var_dump($data);
            if(!$data){
                throw new CHttpException(405, "Không tồn tại giấc mộng này hoặc bài viết đã bị xóa"); 
            }
            $this->noindex = !empty($data["noindex"]) ? $data["noindex"] : 0;
            $this->nofollow = !empty($data["nofollow"]) ? $data["nofollow"] : 0;
            $this->metaTitles = $data["title_long"].' đánh con gì | Giải mã giấc mơ';
            $this->metaKeywords = 'so mo, so mo so de, giai ma giac mo, '.$data["title"];
            $this->metaDescription = 'Mơ thấy '.$data["title"].' đánh con gì? Giải mã giấc mơ '.$data["title"].' qua những con số để chọn những cặp số may mắn ngày hôm nay.';

            $data_other = array();
            list($data_other,$max_page,$total) = Search::getDataSearchDreambook($data["title"],1,$row_per_page);
            list($comment,$reply) = Comment::getDataByContentId("dream_book_comment",$did);
            $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>$data["title_long"]); 
            $this->render("detail",
                array(
                    "data"=>$data
                    ,"tukhoa"=>$tukhoa
                    ,"data_other"=>$data_other
                    ,"comment"=>$comment
                    ,"reply"=>$reply
                )
            );
        }

    }
