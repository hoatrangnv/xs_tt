<?php
    $control = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $ca = $control.'_'.$action;
?>
<div class="box-chat" id="load_chat"></div>
<script>
    function loadChat(){
        var strUrl = "<?php echo Url::createUrl("chat/loadChat") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {               
            },
            success: function(msg){
                $("#load_chat").html(msg);
            }           
        });
    }
    $(document).ready(function(){
      //  loadChat(); 
    });   
</script>
