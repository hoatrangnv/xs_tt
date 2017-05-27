<?php
    $list_icon = Common::genIcon();
    $refer = isset($_SERVER["HTTP_REFERER"]) ? trim($_SERVER["HTTP_REFERER"]) : Url::createUrl("home/index");
    $refer = rtrim($refer,"/");
?>

<div class="title"><strong>Thảo luận kết quả xổ số</strong></div>
<div class="bor">
    <div class="list-chat" id="list_chat">
        <?php foreach($data as $value){?>
            <div class="chatid">
                <span class="time">[<?php echo date('d/m H:i',$value["create_date"])?>]</span>
                <strong class="userchat"><?php echo $value["fullname"]?></strong>:  <?php echo $value["content"]?> 
            </div>
            <?php }?>
    </div>

    <?php if(!empty($_SESSION["user_chat"])){?>
        <div class="list-icchat" id="icon_chat">
            <?php 
                $i=0;
                foreach($list_icon as $key=>$icon){
                    $i++;
                    $symbol = LoadConfig::$symbol[$key];
                    if($i <34){
                    ?>
                    <a ref="nofollow" href="javascript:void(0)" onclick="addText('<?php echo $symbol;?>')"><?php echo $icon;?></a>
                    <?php }
            }?>
        </div>
        <div class="actionchat clearfix">
            <button class="bt-red" onclick="saveChat();" id="button_save"><strong>Gửi</strong></button>
            <div><input type="text" id="content"></div>
        </div>
        <?php }else{?>
        <div class="actionchat clearfix">
            <strong class="cllgin">Đăng nhập để thảo luận</strong>
            <a rel="nofollow" class="bt-face" href="javascript:callLoginFB();">Facebook</a>
            <!--<a class="bt-gg" href="#">Đăng nhập bằng Google</a>-->
        </div>
        <?php }?>
</div>
<script>
    function addText(val){
        var input = $( "#content" );
        input.val( input.val() + val );
    }
    function saveChat(){
        var strUrl = "<?php echo Url::createUrl("chat/saveChat") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {               
                content:$("#content").val()
            }, 
            success: function(msg){
                $("#content").val('');
                if(msg == -1){
                    alert('Vui lòng đăng nhập trước khi chat');
                }else if(msg==-2){   
                    alert('Nội dung chat không được để trống và tối đa 1024 ký tự');
                }else{
                    $("#list_chat").append(msg);
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#list_chat").animate({ scrollTop: $('#list_chat')[0].scrollHeight}, 1000);
                $("#button_save").removeAttr("disabled"); 
            }           
        });
    }
    function callLoginFB(){
        FB.login(function(response) {        
            if (response.status === "connected") 
            {
                FB.api('/me', function(data) {
                    if(data.email == null)
                    {
                        //Facbeook user email is empty, you can check something like this.
                        alert("You must allow us to access your email id!"); 
                    }else{
                        window.location = '<?php echo Yii::app()->params["http_url"].Url::createUrl("chat/loginFacebook") ?>';
                    }

                });
            }
            },
            {scope:'email,user_birthday,user_about_me,user_status,user_website'}); 
    }
    $(function(){
        $("#list_chat").animate({ scrollTop: $('#list_chat')[0].scrollHeight}, 1000);
        $("#icon_chat").keypress(function(e){
            switch(e.which){
                case 13: 
                    saveChat();
                    break;
                default:
                    break; 
            }
        }); 
        $("#content").keypress(function(e){
            switch(e.which){
                case 13: 
                    saveChat();
                    break;
                default:
                    break; 
            }
        });        
    }); 
</script>