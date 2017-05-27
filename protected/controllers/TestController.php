<?php
    class TestController extends Controller{

        public function actionIndex(){
            $sql = "SELECT id FROM tbl_chapter WHERE is_password=1";
            $command = Yii::app()->db_truyen->createCommand($sql);
            $data = $command->queryColumn();
            
            echo implode(",",$data);
        }
    }
