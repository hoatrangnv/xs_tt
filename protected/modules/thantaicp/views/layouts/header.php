<?php $url = new Url()?>
<div id="header">
    <div class="main clearfix">
        <div class="header-r clearfix">
            Tài khoản cá nhân: <a href="<?php echo $url->createUrl("admin/profile")?>"><strong><?php echo Yii::app()->user->name;?></strong></a> 
            ( <a class="exit" href="<?php echo $url->createUrl("admin/logout")?>">Thoát</a> )
        </div>
        <!-- End main-->
    </div>
    <!-- End main-->
</div>
<!-- End header-->
<div id="menu-navi">
    <div class="main">
        <ul class="nav clearfix">    
            <li><a class="active" href="<?php echo $url->createUrl("home/index")?>"><span><strong><i class="home">&nbsp;</i></strong></span></a></li>
            

            <li><a href="<?php echo $url->createUrl("admin/profile")?>"><span><strong>QL admin</strong></span></a>
<!--                <ul class="menu-sub">-->
<!--                    <li><a href="--><?php //echo $url->createUrl("admin/index")?><!--">DS Admin</a></li>-->
<!--                    <li><a href="--><?php //echo $url->createUrl("adminLog/index")?><!--">QL Log</a></li>-->
<!--                </ul>-->
            </li>
            <li><a href="<?php echo $url->createUrl("mobat/index")?>"><span><strong>Mở bát</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php echo $url->createUrl("mobat/index")?>">Mở bát hôm nay</a></li>
                    <li><a href="<?php echo $url->createUrl("mobat/history")?>">Lịch sử Mở bát</a></li>
                </ul>
            </li>
            <li><a href="<?php echo $url->createUrl("about/index")?>"><span><strong>QL About</strong></span></a>

            </li>
            
        </ul>
    </div>
</div>
