<?php
$per_page = isset($per_page) ? intval($per_page) : 5;
?>
<script type="text/javascript">
    function ajaxSaveComment(content_id,reply_id){
        var strUrl = "<?php echo Url::createUrl("comment/ajaxSaveComment") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                <?php if(!isset($_SESSION["user"])){?>
                    fullname:$("#fullname_"+reply_id).val(),
                    email:$("#email_"+reply_id).val(),
                <?php }?>
                comment:$("#comment_"+reply_id).val(),                
                content_id:content_id,
                reply_id:reply_id,
                table:'<?php echo $table?>'
            },
            success: function(msg){
                if(msg == 1){
                    alert('Bạn đã gửi tin thành công !Comment của bạn sẽ được kiểm duyệt trước khi hiển thị');
                    location.reload();
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
    function ajaxLoadComment(content_id,per_page){
        var strUrl = "<?php echo Url::createUrl("comment/ajaxLoadComment") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                per_page:per_page,              
                content_id:content_id,
                table:'<?php echo $table?>'
            },
            success: function(msg){
                $("#load_comment").html(msg);
            }         
        });
    }
</script>
<div class="box coment pad10-5">
    <?php if($comment){?>
        <ul>
            <?php foreach($comment as $com){?>
                <li><strong class="cl-org"><?php echo $com["create_user"]?></strong> (<?php echo date('d-m-Y H:i',$com['create_date'])?>): 
                    <em><?php echo $com["comment"]?></em>
                    <p><a rel="nofollow" title="" href="javascript:void(0)" class="gr-gray" onclick="showForm('area_reply_<?php echo $com["id"]?>')"><strong class="ic ic-reply">Trả lời</strong></a></p>
                    <ul class="post-coment" id="area_reply_<?php echo $com["id"]?>" style="display: none;">
                        <?php if(!isset($_SESSION["user"])){?>
                            <li>               
                                <label class="in-block">Họ tên:</label>
                                <div class="in-block"><input id="fullname_<?php echo $com["id"]?>" type="text"></div>
                            </li>
                            <li>
                                <label class="in-block">Email:</label>
                                <div class="in-block"><input id="email_<?php echo $com["id"]?>" type="text"></div>
                            </li>
                            <?php }?>
                        <li>
                            <label class="in-block">Nội dung:</label>
                            <div class="in-block">
                                <textarea id="comment_<?php echo $com["id"]?>"></textarea>
                            </div>
                        </li>
                        <li>
                            <label class="in-block"></label>
                            <div class="in-block">
                                <button id="button_save" class="bt-red" type="button" onclick="ajaxSaveComment('<?php echo $content_id?>','<?php echo $com["id"]?>')"><strong>Gửi</strong></button>
                            </div>
                            <div id="show_error" style="color: red;"></div>
                        </li>
                    </ul>
                    <?php if(isset($reply[$com["id"]])){?>
                        <ul class="coment-c2">
                            <?php foreach($reply[$com["id"]] as $value){?>
                                <li>
                                    <strong class="cl-green"><?php echo $value["create_user"]?>:</strong>
                                    <?php echo $value["comment"]?>
                                </li>
                                <?php }?>
                        </ul>   
                        <?php }?>
                </li>
                <?php }?>
        </ul>  
        <?php if(count($comment) >= $per_page){?>
        <div class="pad10-5 txt-center magb10">
            <a class="bt-green" title="" href="javascript:void(0)" rel="nofollow" onclick="ajaxLoadComment('<?php echo $content_id?>','<?php echo ($per_page + 5)?>')"><strong>Xem thêm</strong></a>
        </div> 
        <?php }?>
        <?php }?>

    <ul class="post-coment">
        <li class="first"><strong class="s18">Bình luận của bạn</strong></li>
        <?php if(!isset($_SESSION["user"])){?>
            <li>               
                <label class="in-block">Họ tên:</label>
                <div class="in-block"><input id="fullname_0" type="text"></div>
            </li>
            <li>
                <label class="in-block">Email:</label>
                <div class="in-block"><input id="email_0" type="text"></div>
            </li>
            <?php }?>
        <li>
            <label class="in-block">Nội dung:</label>
            <div class="in-block">
                <textarea id="comment_0"></textarea>
            </div>
        </li>
        <li>
            <label class="in-block"></label>
            <div class="in-block">
                <button id="button_save" class="bt-red" type="button" onclick="ajaxSaveComment('<?php echo $content_id?>',0)"><strong>Gửi</strong></button>
            </div>
            <div id="show_error" style="color: red;"></div>
        </li>
    </ul>
</div>