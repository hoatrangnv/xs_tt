
<?php

    $url = new Url();

?>
<div class="main clearfix">
    <div class="admin clearfix">
        <div class="col30">
            <h1><strong>Admin</strong></h1>
            <ol>
                <li><a href="<?php echo $url->createUrl("admin/profile")?>">QL Admin</a></li>
                <li><a href="<?php echo $url->createUrl("mobat/index")?>">QL Mở bát</a></li>
                <li><a href="<?php echo $url->createUrl("about/index")?>">QL About</a></li>
            </ol>
        </div>
    </div>
</div>
