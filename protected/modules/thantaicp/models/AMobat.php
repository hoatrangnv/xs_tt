<?php
class AMobat extends CActiveRecord{

    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }

    
    public function getDataByOpenDate($open_date){

        $data = array();
        $sql = "SELECT * FROM xs_mobat WHERE open_date ='".$open_date."'";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $key =>$value){
            $data[$value['province']] = $value;
        }
        return $data;
    }

    public function getDataSearch($open_date,$page,$row_per_page){
        $str_sql = "";
        $str_order = " ORDER BY id DESC ";
        $str_groupby = " GROUP BY open_date ";
        if(!empty($open_date)){
            $str_sql .= " AND open_date = '" . $open_date. "'";
        }
        $connect = Yii::app()->db;
        $sql = "SELECT open_date as count FROM xs_mobat WHERE 1 ".$str_sql.$str_groupby;
        $command = $connect->createCommand($sql);
        $data_count = $command->queryAll();
        $max_page = ceil(intval(count($data_count))/$row_per_page);
        $first = ($page - 1)*$row_per_page;
        $sql = "SELECT * FROM xs_mobat WHERE 1 ".$str_sql.$str_groupby.$str_order." LIMIT ".$first.",".$row_per_page;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return array($max_page,intval(count($data_count)),$data);
    }


    public function getDataByOpenDateAndProvince($open_date,$province){

        $data = array();
        $sql = "SELECT * FROM xs_mobat WHERE open_date ='".$open_date."' AND province = ".$province;
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $key =>$value){
            $data[$value['province']] = $value;
        }
        return $data;
    }

    public function getDataByWday($wday){
        $data = array();
        $sql = "SELECT * FROM province WHERE id<>1 AND thu".$wday."=1";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $value){
            $data[$value["region"]][$value["id"]] = $value;
        }
        return $data;
    }

}
