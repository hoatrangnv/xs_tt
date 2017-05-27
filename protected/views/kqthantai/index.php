
<div class="col-l">
    <div class="box-kq">
        <div class="box">
            <div class="clearfix tab-optseach">
                <ul class="tab1 clearfix" id="areas_result">
                    <li class="active"><a title="Xổ số điện toán" href="<?php echo Url::createUrl("kqthantai/index")?>"><strong>Kết quả xố số thần tài</strong></a></li>
                </ul>
            </div>
            <form method="POST">
                <ul class="col-25-75 pad10-5">
                    <li>
                        <label class="in-block"><strong>Số ngày xem</strong></label>
                        <div class="in-block">
                            <select name="limit">
                                <option <?php if($limit ==5) echo 'selected=""';  ?> value="5">5 ngày</option>
                                <option <?php if($limit ==10) echo 'selected=""';  ?> value="10">10 ngày</option>
                                <option <?php if($limit ==15) echo 'selected=""';  ?> value="15">15 ngày</option>
                                <option <?php if($limit ==20) echo 'selected=""';  ?> value="20">20 ngày</option>
                                <option <?php if($limit ==25) echo 'selected=""';  ?> value="25">25 ngày</option>
                                <option <?php if($limit ==30) echo 'selected=""';  ?> value="30">30 ngày</option>
                            </select>
                            <em>(Số lần mở thưởng gần đây nhất ) </em>
                        </div>
                    </li>
                    <li>
                        <label class="in-block"></label>
                        <div class="in-block">
                            <button class="bt-green" type="submit"><strong>Xem kết quả</strong></button>
                        </div>
                    </li>
                </ul>
            </form>
            <ul class="dientoan clearfix">
                <?php foreach($result as $key => $value){ ?>
                <li class="last">
                    <h2 class="pad10-5"><strong>Kết Quả Xổ Số Thần Tài ngày <?php echo date('d-m-Y',strtotime($value["ngay_quay"]))?></strong></h2>
                    <div>
                        <span><?php echo $value["ketqua"]?></span>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>