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
        $( ".tt_boso" ).tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });
    });
    function check_all(){                                                                                                                
        $("input[type='checkbox']").attr('checked', true);                        
    }

    function uncheck_all(){                          
        $("input[type='checkbox']").removeAttr("checked");                       
    }
</script>
<div class="">
    <div class="box">
        <?php $arr_boso = $boso; ?>
            <div class="scoll">
                <h2 class="bg_red pad10-5">Kết quả thống kê tần suất loto <?php echo $province["name"]?></h2>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mag0">
                    <tr>
                        <th class="pad0"><div class="ic ic-img3"></div></th>
                        <?php foreach($arr_boso as $boso){ $total[$boso] = 0; ?>
                            <th><div class="w40"><?php echo $boso;?></div></th>
                            <?php }?>
                    </tr>
                    <?php foreach($data as $key=>$value){ ?>
                        <tr>             
                            <td class="s12" width="68"><div class="w68"><?php echo date('d-m-Y',strtotime($key))?></div></td>

                            <?php    
                                foreach($arr_boso as $boso){

                                    if(isset($value[$boso]) && $value[$boso]["tan_so"] >0){
                                        $total[$boso] = $value[$boso]["tan_so"] + $total[$boso];
                                    }
                                    $giai = "";
                                    if(isset($value[$boso])){
                                        $giai = 'bộ số  '.$boso.' về '.$value[$boso]["tan_so"].' lần ở các giải: ';

                                        $g = json_decode($value[$boso]["giai"],true);
                                        $giai .= implode(", ",$g);
                                    }
                                ?>
                                <td class="<?php echo (isset($value[$boso]) && $value[$boso]["tan_so"] >0) ? 'bg_note tt_boso' : ''?>" title="<?php echo rtrim($giai,", ")?>">
                                    <div class="w40"><?php echo (isset($value[$boso]) && $value[$boso]["tan_so"] >0) ? $value[$boso]["tan_so"] : ''?></div>
                                </td>
                                <?php }?>
                        </tr>
                        <?php }?>
                    <tr>  
                        <td class="s12">Tổng số</td>
                        <?php foreach($total as $tong){?>
                            <td>
                                <div class="w40"><?php echo $tong?></div>
                            </td>
                            <?php }?>
                    </tr>  
                </table>
            </div>
    </div>
      </div>