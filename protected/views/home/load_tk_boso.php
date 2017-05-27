<div class="tit-mien clearfix">
    <h2 class="txt-center">
        Thống kê loto - xổ số <?php echo $first_province["name"]?> đến ngày 
        <?php 
            if(!isset($_GET["ngay_quay"]) || (isset($_GET["ngay_quay"]) && strtotime($_GET["ngay_quay"])==strtotime(date('d-m-Y')))){
                echo date('d-m-Y');
            }
        ?>
    </h2>
</div>
<ul class="list-loto-mb">
    <li>
        <h3 class="bg_ef"><strong>8 cặp số xuất hiện nhiều nhất trong vòng 10 lần quay gần đây</strong></h3>
        <ul>
            <?php 
                $i = 0;
                foreach($data_tk10 as $key=>$value){
                    $i++;
                    if($i <=8){
                    ?>
                    <li class="clearfix bg_f9">
                        <label class="fl">
                            <strong class="clred"><?php echo $value["boso"]?></strong>
                        </label>
                        <div class="fl">
                            <span class="in-block"><?php echo $value["new"]?> lần</span>
                            <em>
                                <?php 
                                    if($value["new"] > $value["old"]){
                                        echo "Tăng ".($value["new"] - $value["old"])." lần so với 10 lần trước";
                                    }elseif($value["new"] < $value["old"]){
                                        echo "Giảm ".($value["old"] - $value["new"])." lần so với 10 lần trước";
                                    }else{
                                        echo "Bằng so với lần trước";
                                    }
                                ?>

                            </em>
                        </div>
                    </li>
                    <?php }
            }?>
        </ul>
    </li>
    <?php if(empty($dudoan)){?>
        <li>
            <h3 class="bg_ef"><strong>8 cặp số xuất hiện nhiều nhất trong vòng 20 lần quay gần đây</strong></h3>
            <ul>
                <?php 
                    $i = 0;
                    foreach($data_tk20 as $key=>$value){
                        $i++;
                        if($i <=8){
                        ?>
                        <li class="clearfix bg_f9">
                            <label class="fl">
                                <strong class="clred"><?php echo $value["boso"]?></strong>
                            </label>
                            <div class="fl">
                                <span class="in-block"><?php echo $value["new"]?> lần</span>
                                <em>
                                    <?php 
                                        if($value["new"] > $value["old"]){
                                            echo "Tăng ".($value["new"] - $value["old"])." lần so với 20 lần trước";
                                        }elseif($value["new"] < $value["old"]){
                                            echo "Giảm ".($value["old"] - $value["new"])." lần so với 20 lần trước";
                                        }else{
                                            echo "Bằng so với lần trước";
                                        }
                                    ?>

                                </em>
                            </div>
                        </li>
                        <?php }
                }?>
            </ul>
        </li>
        <?php }?>
    <?php if($data_gan){?>
        <li>
            <h3 class="bg_ef"><strong><?php echo empty($dudoan) ? "Loto gan 10 lần mở thưởng gần đây": "Những cặp số không xuất hiện"?></strong></h3>
            <ul class="logo-gan">
                <?php foreach($data_gan as $value){?>
                    <li class="in-block gr-gray txt-center">
                        <strong class="clred"><?php echo $value["boso"]?></strong><br />
                        <span class="cl9 s12"><?php echo $first_province["region"]==1 ? Common::countDayFromDate(date('d-m-Y',strtotime($value["end_date"]))) : intval(Common::countDayFromDate(date('d-m-Y',strtotime($value["end_date"])))/7)?> lần</span>
                    </li>
                    <?php }?>

            </ul>
        </li>
        <?php }?>
</ul>