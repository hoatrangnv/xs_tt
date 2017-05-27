<div class="col-l">
    
    <div class="box-dream box">    
        <h1 class="title-bor mag0"><strong>Lịch quay xổ số mở thưởng và mã tỉnh dùng cho nhắn tin</strong></h1>
        <div class="calendar">
            <ul class="bg_f9 clearfix">
                <li class="first fl"><h2>Mở thưởng</h2></li>
                <li class="fl">
                    <h2>Miền bắc (Mã: MB)</h2>
                    <span class="cl9">Quay lúc: <em class="clred">18h15'</em></span>
                </li>
                <li class="fl"><h2>Miền trung (Mã: MT)</h2> <span class="cl9">Quay lúc: <em class="clred">17h15'</em></span></li>
                <li class="fl"><h2>Miền nam (Mã: MN)</h2> <span class="cl9">Quay lúc: <em class="clred">16h15'</em></span></li>
            </ul>
            <?php foreach($provinces as $thu=>$province){?>
                <ul class="clearfix">
                    <li class="first fl"><h3><?php echo $thu==8 ? 'Chủ nhật':'Thứ '.$thu;?></h3></li>

                    <li class="fl">
                        <?php if(isset($province[1])){
                            foreach($province[1] as $key=>$value){
                                $url_province = Url::createUrl("result/mienbac",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                            ?>
                            <p><a title="Lịch quay thưởng <?php echo $value["name"]?>" href="<?php echo $url_province;?>"><?php echo $value["name"]?>: <span class="cl-org"><?php echo strtoupper($value["code"])?></span></a></p>  
                            <?php
                            }
                        }?>

                    </li>
                    <li class="fl">
                        <?php if(isset($province[2])){
                            foreach($province[2] as $key=>$value){
                                $url_province = Url::createUrl("result/mientrung",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                            ?>
                            <p><a title="Lịch quay thưởng <?php echo $value["name"]?>" href="<?php echo $url_province;?>"><?php echo $value["name"]?>: <span class="cl-org"><?php echo strtoupper($value["code"])?></span></a></p>  
                            <?php
                            }
                        }?>

                    </li>
                    <li class="fl">
                        <?php if(isset($province[3])){
                            foreach($province[3] as $key=>$value){
                                $url_province = Url::createUrl("result/miennam",array("province_name"=>$value["alias"],"province_id"=>$value["id"]));
                            ?>
                            <p><a title="Lịch quay thưởng <?php echo $value["name"]?>" href="<?php echo $url_province;?>"><?php echo $value["name"]?>: <span class="cl-org"><?php echo strtoupper($value["code"])?></span></a></p>  
                            <?php
                            }
                        }?>

                    </li>
                </ul>
                <?php }?>
        </div>
    </div>
    
    <?php $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"))?>
</div>