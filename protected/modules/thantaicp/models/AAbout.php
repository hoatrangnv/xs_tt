<?php
class AAbout extends CActiveRecord{

    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }

    public function tableName()
    {
        return 'xs_about';
    }

    public function getContentAbout(){
        $sql = "SELECT * FROM xs_about";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;
    }
    public function getContentById($id){
        $sql = "SELECT * FROM xs_about WHERE id =".$id;
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $row = $command->queryRow();
        return $row;
    }

}
