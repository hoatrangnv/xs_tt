<script type="text/javascript">
    $(function(){
        $( "#bien_ngay" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            showAnim:'fold',
            buttonText :false
        });
    });
</script>
<div class="col-l">
    <script type="text/javascript">

        function ajaxLoadBuoccau(cau_id,boso){
            var strUrl = '<?php echo Url::createUrl("soicau/ajaxLoadBuoccau"); ?>';
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    cau_id:cau_id
                    ,boso:boso
                    ,province_name:$("#province_name").val()
                    ,region:$("#region").val()
                },
                success: function(msg){
                    $("#load_buoccau").html(msg);
                }
            });
        }
    </script>
    <div class="box">
        <div class="clearfix tab-optseach">
            <ul class="tab1 clearfix">
                <li class="active"><a title="Soi cầu loto" href="<?php echo Url::createUrl("soicau/index"); ?>"><strong>Soi cầu loto</strong></a></li>
                <li class=""><a title="Soi cầu đặc biệt" href="<?php echo Url::createUrl("soicau/dacbiet"); ?>"><strong>Soi cầu đặc biệt</strong></a></li>
                <li class=""><a title="Soi cầu 2 nháy" href="<?php echo Url::createUrl("soicau/hainhay"); ?>"><strong>Soi cầu 2 nháy</strong></a></li>
                <li class=" last"><a title="Soi cầu bạch thủ" href="<?php echo Url::createUrl("soicau/bachthu"); ?>"><strong>Soi cầu bạch thủ</strong></a></li>
            </ul>
        </div>
        <div class="box">
            <ul class="list-dot-red">
                <li>
                    <img width="6" height="6" src="http://images.ketquaveso.com/kqvs/desktop/images/bullet-red.png" alt="icon ve so">
                    Soi cầu lo to miền bắc: Cho phép bạn tìm ra cầu lô miền bắc bằng cách ghép nối từ các bộ số từ 00 đến 99 theo biên độ cầu 2 ngày hoặc cầu 3 ngày. Soi cầu lô Giúp bạn phân tích, dự đoán cầu lô miền bắc về ngày tiếp theo
                </li>
            </ul>
        </div>
        <form method="GET" action="<?php echo Url::createUrl("soicau/index"); ?>">
            <ul class="clearfix opt-soicau">
                <li class="in-block">
                    <p class="mag0"><strong>Chọn tỉnh</strong></p>
                    <select name="province">
                        <?php foreach($province_list as $key =>$value){?>
                            <option <?php if( $province_id == $key){ echo 'selected ="true"';} ?>  value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </li>
                <li class="in-block">
                    <p class="mag0"><strong>Biên độ ngày soi cầu</strong></p>
                    <select name="bien_do_ngay">
                        <option <?php if($bien_do_ngay ==3) echo 'selected=""';  ?> value="3">3 ngày</option>
                        <option <?php if($bien_do_ngay ==4) echo 'selected=""';  ?> value="4">4 ngày</option>
                        <option <?php if($bien_do_ngay ==5) echo 'selected=""';  ?> value="5">5 ngày</option>
                        <option <?php if($bien_do_ngay ==6) echo 'selected=""';  ?> value="6">6 ngày</option>
                        <option <?php if($bien_do_ngay ==7) echo 'selected=""';  ?> value="7">7 ngày</option>
                    </select>
                </li>
                <li class="in-block">
                    <p class="mag0"><strong>Ngày soi</strong></p>
                    <input id="bien_ngay" name="bien_ngay" value="<?php echo $bien_ngay?>" type="text" class="w25">
                </li>
            </ul>

            <div align="center">
                <button class="bt-green" type="submit"><strong>Xem kết quả</strong></button>
            </div>
        </form>
    </div>
    <input type="hidden" name="province_id" value="<?php echo $province_id; ?>">
    <input type="hidden" id="region" name="region" value="<?php echo $province_list[$province_id]['region']; ?>">
    <input type="hidden" id="province_name" name="province_name" value="<?php echo $province_list[$province_id]['name']; ?>">
    <div class="box">
        <div class="title-bor">
            <h2 class="s18">Soi cầu loto <?php echo $province_list[$province_id]['name']; ?> - cầu <?php echo $bien_do_ngay; ?> ngày</h2>
            <p class="mag0"><em>Click vào số trong hàng mà bạn muốn xem cầu chi tiết</em></p>
        </div>
        <div class="pad5">
            <ul class="list-scmn">
                <?php for($k =0;$k<=9;$k++){ ?>
                    <li class="bg_f6 clearfix">
                        <label class="fl <?php if($k%3==0){echo "bg_green";}else if($k%3==1){echo "bg_red";}else if($k%3==2){echo "bg_org";} ?>">Đầu <?=$k?></label>
                        <div class="clearfix">
                            <?php for($i=0;$i<=9;$i++){
                                if($result['bs_'.$k.$i] >0 ){?>
                                <a rel="nofollow" title="" href="#load_buoccau" onclick="ajaxLoadBuoccau('<?php echo $result['id'];?>','<?php echo $k.$i; ?>')"><strong><?php echo $k.$i; ?></strong></a>
                            <?php }} ?>
                        </div>
                    </li>
                <?php }?>


            </ul>
        </div>

        <div class="cau-mien" id="load_cau">

        </div>
        <div class="cau-loto-day" id="load_buoccau">

        </div>

    </div>

    <style>
        /*.adsense_bottom { width: 320px; height: 250px;}*/
        /*     @media(min-width:900px){ .adsense_bottom { width: 535px; height: 250px; text-align: center } }
            @media(max-width:899px){ .adsense_bottom { width: 320px; height: 250px; text-align: center } }*/
    </style>
</div>