<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>

<script>
    function ajaxDeleteMobat(open_date){
        var strUrl = "<?=$url->createUrl("mobat/ajaxDeleteMobat") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa mở bát ngày này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {open_date:open_date},
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa mở bát thành công');
                        window.location = '<?php echo $url->createUrl("mobat/history")?>';
                    }else{
                        alert(msg);
                    }
                }
            });
        }
    }
</script>

<div class="main clearfix">
    <div class="box clearfix bottom30">
        <form method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Ngày mở </strong>:</label>
                    <div class="filltext">
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'open_date',
                            'id' => 'open_date',
                            'value' => $open_date,
                            // additional javascript options for the date picker plugin
                            'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'dd-mm-yy',
                            'changeYear' => 'true',
                            'changeMonth' => 'true',
                            'showOn' => 'both',
                            'buttonText' => '...'
                            ),
                            'htmlOptions' => array(
                            'style' => 'width:170px',
                            'class' => 'form',
                            ),
                            ));
                        ?>
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input type="submit" value=" Tìm kiếm" class="btn-bigblue"> 
                    </div>
                </li>

            </ul>
        </form> 
    </div>
    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả - 
                <a href="<?php echo $url->createUrl("news/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
            </div>
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="5%"><strong>Mã</strong></td>
                        <td width="8%"><strong>Người tạo</strong></td>
                        <td width="8%"><strong>Ngày tạo</strong></td>
                        <td width="11%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                            <td class="middle"><?php echo $key +1?></td>
                            <td><?php echo $value["create_user"]?></td>
                            <td><a href="<?php echo $url->createUrl("mobat/index",array("open_date"=>$value["open_date"]));  ?>"><?php echo $value["open_date"]?></a></td>
                            <td>
                            <a href="<?php echo $url->createUrl("mobat/index",array("open_date"=>$value["open_date"]))?>"> Sửa </a> |
                            <a href="javascript:void(0)" onclick="ajaxDeleteMobat('<?php echo $value["open_date"]?>')">  Xóa  </a>
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
        <div class="fillter clearfix">
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>