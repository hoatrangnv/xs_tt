<?php
class AboutController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Quản lý About','link'=>$url->createUrl("mobat/index"),'class'=>'');
    }
    public function actionIndex(){

        $result = AAbout::getContentAbout();
        $this->render("index",array("result"=>$result));
    }
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $data = $result = AAbout::getContentById($id);
        if($data['type'] == 1){
            $this->breadcrumbs[] = array('name'=>'Chỉnh sửa giới thiệu','link'=>"#",'class'=>'active');
        }else{
            $this->breadcrumbs[] = array('name'=>'Chỉnh sửa hướng dẫn','link'=>"#",'class'=>'active');
        }
        $this->render("edit",array("data"=>$data));

    }

    public function actionAjaxSaveAbout(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $description = isset($_POST["description"]) ? trim($_POST["description"]):"";

        $table = "xs_about";
        $data = array(
            "content"=>array("value"=>$description,"type"=>2),
            "id"=>array("value"=>$id,"type"=>1)
        );
        $result = CommonDB::updateRow($table,$data,array("id"));
        if($result >0){
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }
}
