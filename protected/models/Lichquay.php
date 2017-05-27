<?php
class Lichquay extends CActiveRecord
{
    public function getLichquayInWeek()
    {
        $sql = "SELECT * FROM province WHERE id!=1";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;
    }   
}  
?>
