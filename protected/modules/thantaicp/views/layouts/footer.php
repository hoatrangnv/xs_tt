<div id="footer">
    <div class="main">
        <h2>Copy right <a href="http://xosothantai.vn/"><em class="clorage">Xosothantai.vn</em></a></h2>
    </div>
</div>
<?php if(Yii::app()->params["showsql"]){ ?>
    <div class="showSql">                    
        <fieldset>
            <legend>Database Customer Care</legend>
            <?php echo Yii::app()->db->showSql; ?>
        </fieldset>
        
        <?php echo "<b>Thời gian tải trang:</b> ".sprintf('%0.5f',Yii::getLogger()->getExecutionTime())." giây"; ?>
    </div>
<?php } ?>