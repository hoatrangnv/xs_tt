<script type="text/javascript">
    $(function(){
        $( "#from_date" ).datepicker({
            dateFormat: 'dd-mm-yy',   
            changeMonth: true,
            changeYear: true,
            showAnim:'fold', 
            buttonText :false
        });
        $( "#to_date" ).datepicker({
            dateFormat: 'dd-mm-yy', 
            changeMonth: true,
            changeYear: true,
            showAnim:'fold', 
            buttonText :false
        });
        $( ".tt_dau_lt" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
        $( ".tt_duoi_lt" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
    });
</script>
<div class="">
    <div class="box">
        <h2 class="bg_red pad10-5">Kết quả thống kê theo đầu loto <?php echo $province["name"]?></h2>
        <div class="">
            <table cellspacing="0" cellpadding="0" border="0" class="magb25" width="100%">
                <tr>
                    <th class="pad0"><div class="ic ic-img2"></div></th>
                    <th><div class="w40">0</div></th>
                    <th><div class="w40">1</div></th>
                    <th><div class="w40">2</div></th>
                    <th><div class="w40">3</div></th>
                    <th><div class="w40">4</div></th>
                    <th><div class="w40">5</div></th>
                    <th><div class="w40">6</div></th>
                    <th><div class="w40">7</div></th>
                    <th><div class="w40">8</div></th>
                    <th><div class="w40">9</div></th>
                </tr>
                <?php 
                    $total = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0);
                    foreach($dau as $key=>$value){
                    ?>
                    <tr>
                        <td width="68" class="s12"><div class="w68"><?php echo date('d-m-Y',strtotime($key))?></div></td>
                        <?php 
                            for($i=0;$i<=9;$i++){

                                $giai = "";
                                $lan = 0;
                                if(!empty($value[$i])){   
                                    $g = '';
                                    for($j=0;$j < count($value[$i]);$j++){
                                        $g .= $value[$i][$j]["boso"].' - giai: '. implode(", ",json_decode($value[$i][$j]["giai"],true)).' & ';
                                        $lan = $value[$i][$j]["tan_so"] + $lan;
                                    }
                                    $giai = 'đầu '.$i.' về '.$lan.' lần ở các bộ số: '.$g;
                                    $total[$i] = $lan + $total[$i];
                                    $giai = rtrim($giai," & ");
                                }
                            ?>
                            <td class="<?php echo (isset($value[$i]) && $lan >0) ? 'tt_dau_lt' : 'bg_note'?>" title="<?php echo rtrim($giai,", ");?>">
                                <div class="w40"><?php echo $lan?></div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
                <?php if($total){?>
                    <tr class="row-rate">
                        <td><strong>Tổng</strong></td>
                        <?php 
                            for($i=0;$i<=9;$i++){
                                if(isset($total[$i])){
                                    $tong = $total[$i];
                                }else{
                                    $tong = 0;
                                }
                            ?>
                            <td>
                                <strong><?php echo $tong?></strong>
                                <div class="rate txt-center">
                                    <span style="height:<?php echo $tong;?>px" class="hrate"></span>
                                </div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
            </table>

        </div>

        <h2 class="bg_red pad10-5">Kết quả thống kê theo đuôi loto <?php echo $province["name"]?></h2>
        <div class="">
            <table cellspacing="0" cellpadding="0" border="0" class="magb25" width="100%">
                <tr>
                    <th class="pad0"><div class="ic ic-img5"></div></th>
                    <th><div class="w40">0</div></th>
                    <th><div class="w40">1</div></th>
                    <th><div class="w40">2</div></th>
                    <th><div class="w40">3</div></th>
                    <th><div class="w40">4</div></th>
                    <th><div class="w40">5</div></th>
                    <th><div class="w40">6</div></th>
                    <th><div class="w40">7</div></th>
                    <th><div class="w40">8</div></th>
                    <th><div class="w40">9</div></th>
                </tr>
                <?php 
                    $total = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0);
                    foreach($duoi as $key=>$value){
                    ?>
                    <tr>
                        <td width="68" class="s12"><div class="w68"><?php echo date('d-m-Y',strtotime($key))?></div></td>
                        <?php 
                            for($i=0;$i<=9;$i++){
                                $giai = "";
                                $lan = 0;
                                if(!empty($value[$i])){   
                                    $g = '';
                                    for($j=0;$j < count($value[$i]);$j++){
                                        $g .= $value[$i][$j]["boso"].' - giai: '. implode(", ",json_decode($value[$i][$j]["giai"],true)).' & ';
                                        $lan = $value[$i][$j]["tan_so"] + $lan;
                                    }
                                    $giai = 'đuôi '.$i.' về '.$lan.' lần ở các bộ số: '.$g;
                                    $total[$i] = $lan + $total[$i];
                                    $giai = rtrim($giai," & ");
                                }
                            ?>
                            <td class="<?php echo (isset($value[$i]) && $lan >0) ? 'tt_duoi_lt' : 'bg_note'?>" title="<?php echo rtrim($giai,", ");?>">
                                <div class="w40"><?php echo $lan?></div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
                <?php if($total){?>
                    <tr class="row-rate">
                        <td><strong>Tổng</strong></td>
                        <?php 
                            for($i=0;$i<=9;$i++){
                                if(isset($total[$i])){
                                    $tong = $total[$i];
                                }else{
                                    $tong = 0;
                                }
                            ?>
                            <td>
                                <strong><?php echo $tong?></strong>
                                <div class="rate txt-center">
                                    <span style="height:<?php echo $tong;?>px" class="hrate"></span>
                                </div>
                            </td>
                            <?php }?>
                    </tr>
                    <?php }?>
            </table>
        </div>
    </div>
      </div>