<?php
    class SearchController extends Controller{
        public function actionCreate(){
            //Search::createSearch();
            //Search::createSearchXoso999();
            Search::createSearchDreambook();
        }
        
        public function actionIndex(){
            $keyword = "Quá mừng rỡ, làm rách vé số trúng 100 triệu đồng";
            $page = 1;
            $search_type = 1;
            $num_per_page = 20;
            $category_id = 0;
            $content_id = 0;
            list($data,$max_page,$total) = Search::getDataSearch($keyword,$category_id,$content_id,$page,$num_per_page,$search_type);
            echo '<pre>';
            var_dump($data);die;
        }
    }
