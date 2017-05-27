<?php
$detect = new MobileDetect();
if(!$detect->isMobile()){
?>
<div id="fb-root"></div> 
<div class="fl">
    <div class="fb-like" data-href="<?php echo Common::getCurrentUrl()?>" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div>
    &nbsp;&nbsp;
    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo Common::getCurrentUrl();?>', 'facebook-share-dialog', 'width=626,height=436'); return false;">
        <img src="<?php echo Yii::app()->params["static_url"]?>/images/Share.png" alt="Share facebook"/>
    </a>
    &nbsp;&nbsp;
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <g:plusone></g:plusone>
</div>
<?php }?>