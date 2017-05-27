<?php $url = new Url(); ?>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
    function ajaxSaveAbout(){
        var id = '<?php echo $data["id"]?>';
        var strUrl = "<?=$url->createUrl("about/ajaxSaveAbout") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                description:CKEDITOR.instances.description.getData()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("about/index")?>';
                }else{
                    $("#show_error").html(msg);
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_save").removeAttr("disabled");
            }
        });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <ul class="form4">

            <li class="clearfix"><label><strong>Nội dung</strong>:</label>
                <div class="filltext">
                    <textarea id="description" name="description"><?php echo $data['content'] ?></textarea>
                     <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'description' );
                    </script>
                </div>
                
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" type="button" value=" Save " class="btn-bigblue" onclick="ajaxSaveAbout()">
                    &nbsp;
                    <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                </div>
            </li>
             <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext" style="color: red;" id="show_error"></div>
            </li>
        </ul>

    </div>
</div>