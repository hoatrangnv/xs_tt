<?php
class MobatController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Mở bát','link'=>$url->createUrl("mobat/index"),'class'=>'');
    }
    public function actionIndex(){
        $open_date = isset($_GET['open_date'])? $_GET['open_date'] : date('d-m-Y',time());
        $this->breadcrumbs[] = array('name'=>'Mở bát '.$open_date,'link'=>"#",'class'=>'active');
        $wday = date('w',strtotime($open_date))+1;
        if($wday == 1) $wday = 8;
        $data = AMobat::getDataByWday($wday);
        $result = AMobat::getDataByOpenDate($open_date);
        $this->render("index",array("data"=>$data,"result"=>$result,"open_date"=>$open_date));
    }
    public function actionHistory(){
        $this->breadcrumbs[] = array('name'=>'Lịch sử mở bát','link'=>"#",'class'=>'active');
        $wday = date('w')+1;
        if($wday == 1) $wday = 8;

        $row_per_page = 20; $arr_game_id = array();
        $open_date = isset($_GET["open_date"]) ? trim($_GET["open_date"]):"";
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

        $data = AMobat::getDataByWday($wday);
        $result = AMobat::getDataByOpenDate($open_date);
        list($max_page,$count,$data) = AMobat::getDataSearch($open_date,$page,$row_per_page);

        $this->render("history",array("max_page"=>$max_page,"count"=>$count,"data"=>$data,
            "open_date"=>$open_date,"page"=>$page));

    }

    public function actionAjaxDeleteMobat(){
        $open_date = isset($_POST["open_date"]) ? $_POST["open_date"]:"";
        if(!empty($open_date)){
            $table = "xs_mobat";
            $result = CommonDB::deleteRow($table,array("open_date"=>$open_date));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }

    public function actionAjaxSaveMobat(){
        $province = isset($_POST["province"]) ? intval($_POST["province"]):0;
        $str_csloto = isset($_POST["csloto"]) ? trim($_POST["csloto"]):"";
        $str_cdb = isset($_POST["chamdb"]) ? trim($_POST["chamdb"]):"";
        $str_csdacbiet = isset($_POST["csdacbiet"]) ? trim($_POST["csdacbiet"]):"";
        $open_date = isset($_POST["open_date"]) ? trim($_POST["open_date"]):date('d-m-Y',time());
        $create_user = Yii::app()->user->name;

        $data = AMobat::getDataByOpenDateAndProvince($open_date,$province);
        $table = "xs_mobat";
        if(count($data) > 0){
            $data = array(
                "capso_loto"=>array("value"=>$str_csloto,"type"=>2),
                "db_cham"=>array("value"=>$str_cdb,"type"=>2),
                "capso_dacbiet"=>array("value"=>$str_csdacbiet,"type"=>2),
                "open_date"=>array("value"=>$open_date,"type"=>2),
                "create_user"=>array("value"=>$create_user,"type"=>2),
                "province"=>array("value"=>$province,"type"=>1)
            );
            $result = CommonDB::updateRow($table,$data,array("province","open_date"));
        }else{

            $data = array(
                "capso_loto"=>array("value"=>$str_csloto,"type"=>2),
                "db_cham"=>array("value"=>$str_cdb,"type"=>2),
                "capso_dacbiet"=>array("value"=>$str_csdacbiet,"type"=>2),
                "open_date"=>array("value"=>$open_date,"type"=>2),
                "create_user"=>array("value"=>$create_user,"type"=>2),
                "province"=>array("value"=>$province,"type"=>1),
            );
            $result = CommonDB::insertRow($table,$data);
        }
        if($result >0){
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }
}
