<?php
    /**
    * Controller is the customized base controller class.
    * All controller classes for this application should extend from this base class.
    */
    class Controller extends CController
    {
        public $metaDescription = null;
        public $metaKeywords = null;
        public $linkCanoncical = null;
        public $title = null;
        public $breadcrumbs = array();
        public $layout = 'main';
        public $noindex = 0;
        public $nofollow = 0;
        public $prevLink;
        public $nextLink;
        public $current_url;
        public $title_h1;
        protected function beforeAction($action)
        { 
            $url = Common::getCurrentUrl();
            $control = Yii::app()->controller->id;
            $host = $_SERVER["HTTP_HOST"];
            
            $this->prevLink = "";
            $this->nextLink = "";

            if(isset($_GET["detect_mobile"])){
                Yii::app()->params["detect_mobile"] = true;
            }
            return true;
        }
        
        public function redirect($url)
        {
            //echo $url;die;
            Header( "HTTP/1.1 301 Moved Permanently" ); //không có dòng này thì sẽ là dạng Redirect 302
            Header( "Location: ".$url,true,301 );
            exit();
        }

        public function checkSession(){
            $url = new Url();
            if(!isset($_SESSION["user"])){
                $this->redirect($url->createUrl("profile/login"));
            }
        }
}