<?php
    class NewsController extends Controller{
        public $layout = "main";
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $metaTitles = null;
        public $current_url;
        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $this->breadcrumbs[] = array("link"=>Url::createUrl("news/index"),"title"=>"Tin tức"); 
        }

        public function actionIndex(){
            $this->metaTitles = 'Tin tuc xo so trong ngay, Tin xo so 3 mien bac - trung - nam';
            $this->metaKeywords = 'Tin hot xo so, tin trung thuong xo so';
            $this->metaDescription = 'Tổng hợp tin tức xổ số hot nhất 3 miền, tin hot các tỉnh thành trong ngày. Thông tin trúng thưởng xổ số, đổi số trúng thưởng, đại gia vé số trên - ketquaveso.com';

            $category_id = 0;
            $content_id = 0;
            $row_per_page = 20;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $page = isset($_GET["page"]) && $_GET["page"] >1 ? intval($_GET["page"]) : 1;
            if($keyword !=""){
                list($data,$max_page,$total) = News::getDataSearchPaging($keyword,$page,$row_per_page);
                $title = 'Tin tức: '.$keyword;
                $path = Url::createUrl("news/index",array("keyword"=>$keyword));
                $this->linkCanoncical = Yii::app()->params["http_url"].$path;
                if($max_page >1){
                    if($page <$max_page){
                        $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("news/index",array("keyword"=>$keyword,"page"=>$page+1));
                    }
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("news/index",array("keyword"=>$keyword,"page"=>$page-1));
                    }
                }
            }else{
                list($data,$max_page,$total) = News::getDataPaging($page,$row_per_page);
                $title = 'Tin tức xổ số';
                $path = Url::createUrl("news/index");
                $this->linkCanoncical = Yii::app()->params["http_url"].$path;

                if($max_page >1){
                    if($page <$max_page){
                        $this->nextLink = Yii::app()->params["http_url"].Url::createUrl("news/index",array("page"=>$page+1));
                    }
                    if($page >1){
                        $this->prevLink = Yii::app()->params["http_url"].Url::createUrl("news/index",array("page"=>$page-1));
                    }
                }
            }
            if($page >1){
                $this->metaTitles = "".$this->metaTitles." | Trang ".$page."";
                $this->metaDescription = "".$this->metaDescription." - Trang ".$page." ";
            }

            $this->render("index",
                array(
                    "data"=>$data
                    ,"max_page"=>$max_page
                    ,"total"=>$total
                    ,"page"=>$page
                    ,"title"=>$title
                    ,"path"=>$path
                    ,"keyword"=>$keyword
                )
            );
        }
        
        
        public function actionDetail(){
            $row_per_page = 20;

            $news_id = isset($_GET["news_id"]) ? intval($_GET["news_id"]):0;
            $data = News::getDataById($news_id);
            if(!$data){
                throw new CHttpException(405, "Không tồn tại tin này hoặc tin đã bị xóa");
            }    
            $this->noindex = !empty($data["noindex"]) ? $data["noindex"] : 0;
            $this->nofollow = !empty($data["nofollow"]) ? $data["nofollow"] : 0;

            News::updateHitById($news_id);    
            $this->breadcrumbs[] = array("link"=>$this->current_url,"title"=>$data["title"]);        
            $data_other = News::getDataOther($news_id,5);

            $this->metaTitles = !empty($data["meta_title"]) ? $data["meta_title"] : StringUtils::RemoveSign($data["title"]). ' | Tin tuc xo so';
            $this->metaKeywords = !empty($data["meta_keyword"]) ? $data["meta_keyword"] : StringUtils::RemoveSign($data["title"]). ', Tin tuc xo so';
            $this->metaDescription = !empty($data["meta_description"]) ? $data["meta_description"] : $data["introtext"];

            $this->render("detail",
                array(
                    "data"=>$data
                    ,"data_other"=>$data_other
                )
            );
        }
}