<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php require_once("meta.php");?>
    </head>
    <body>
        <div class="wrapper">
            <?php require_once("header.php");?>
            <div class="content">
                <div class="main clearfix">
                    <?php echo $content;?>
                    <?php 
                        $control = Yii::app()->controller->id;
                    ?>
                </div>
            </div>
            <?php require_once("footer.php");?>
        </div>
    </body>
</html>       
