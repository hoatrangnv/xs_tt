<?php
    class User extends CActiveRecord{

        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function findUserLogin($data){

            $conditions = "";
            $conditions.= " AND mobile = '".$data['mobile']."' AND password = '".$data['password']."'";

            $connect = Yii::app()->db;
            $sql = "SELECT * FROM user_veso WHERE 1 ".$conditions;

            $command = $connect->createCommand($sql);
            $row = $command->queryRow();

            return $row;
        }

        public function getDataByMobile($mobile){
            $sql = "SELECT * FROM user_veso WHERE mobile='" . mysql_escape_string($mobile) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->queryRow();
            return $row;
        }

        public function getDataByUsername($username){
            $sql = "SELECT * FROM chat_users WHERE username = '".trim($username)."' ";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }
        
        public function getDataById($id){
            $sql = "SELECT * FROM chat_users WHERE id = '".intval($id)."' ";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }

    }



