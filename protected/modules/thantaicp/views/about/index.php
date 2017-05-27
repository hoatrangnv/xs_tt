<?php
    $url = new Url();
?>
<script type="text/javascript">
    function ajaxQuickUpdate(id){
        var status = 0;
        var isSex = 0;
        if($("#status_"+id).is(":checked")){
            status = 1;
        }
        if($("#isSex_"+id).is(":checked")){
            isSex = 1;
        }
        var strUrl = "<?=$url->createUrl("category/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                isSex:isSex,
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    location.reload();
                }else{
                    alert(msg);
                }
            }          
        });
    }

</script>         
<div class="main clearfix">

    <div class="box">

        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="5%">
                            <strong>Mã</strong>
                        </td>
                        <td width="20%"><strong>Loại</strong></td>
                        <td width="60%"><strong>Nội dung</strong></td>
                        <td width="15%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php foreach($result as $key=>$value){?>
                        <tr>
                            <td class="middle"><?php echo $value["id"]?></td>
                            <td><?php echo $value["type"] == 1 ? "Giới thiệu" : "Hướng dẫn sử dụng" ;?></td>
                            <td><?php echo $value["content"];?></td>
                            <td>
                                <a href="<?php echo $url->createUrl("about/edit",array("id"=>$value["id"]))?>"> Sửa </a>
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>

    </div>
        </div>