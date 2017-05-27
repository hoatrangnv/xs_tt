<?php
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    
?>
<div class="col-right">
    <div class="box">
        <?php
            $this->renderPartial("application.views.module.adsense_right");
            $this->renderPartial("application.views.module.box_chat");
            $this->renderPartial("application.views.module.live_xoso");
            $this->renderPartial("application.views.module.statistic");
        ?>
    </div>
    
</div>