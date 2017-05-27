<?php
class ThantaicpModule extends CWebModule
{
    public $defaultController = 'home';    

    public function init()
    {                         
        $this->setImport(
            array(
                'thantaicp.models.*',
                'thantaicp.components.*',
            )
        );    
        $this->defaultController = "home";
        $this->layout = 'main';
        $this->setComponents(
            array(
                'errorHandler' => array('errorAction' => 'home/index'),
                'user' => array(
                    'class' => 'CWebUser',
                    'loginUrl' => Yii::app()->createUrl('thantaicp/admin/login'),
                )
            )
        );
    }
}
