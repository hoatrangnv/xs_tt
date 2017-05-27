<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php 
            $control = Yii::app()->controller->id;
            require_once("meta.php");
            $detect = new MobileDetect();
        ?>
    </head>
    <body>
        <div class="wrapper">
            <?php  require_once("header.php");?>

            <div class="content">
                <div class="main clearfix">
                    <?php echo $content;?>  
                    <?php 
                        require_once("right_center.php");
                        require_once("right.php");
                    ?>    
                </div>
            </div>     
            <?php require_once("footer.php");?>
        </div>  
        <style> 
            @media(max-width:499px){ .bnnsroll-r { display: none; } }
            @media(max-width:499px){ .bnnsroll-l { display: none; } }
        </style>
        <div class="bnnsroll-r">
            <?php if(!$detect->isMobile()){?>
                <?php }?>
        </div>
        <div class="bnnsroll-l">
            <?php if(!$detect->isMobile()){?>
                <?php }?>
        </div>
       
    </body>
</html>     
