<?php
    class AboutController extends Controller{

        public function actionIndex(){
            $this->layout = "main_full";
            $this->breadcrumbs[] = array("link"=>Url::createUrl("about/index"),"title"=>"GIỚI THIỆU");
            $data = About::getContentByType(1);
            $title = "Giới thiệu";
            $this->render("index",array("title"=>$title,"content"=>$data['content']));
        }

        public function actionGuide(){
            $this->layout = "main_full";
            $this->breadcrumbs[] = array("link"=>Url::createUrl("about/guide"),"title"=>"HƯỚNG DẪN SỬ DỤNG");
            $data = About::getContentByType(2);
            $title = "Hướng dẫn sử dụng";
            $this->render("index",array("title"=>$title,"content"=>$data['content']));
        }

    }
