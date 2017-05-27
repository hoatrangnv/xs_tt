<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url"] ?>/css/print/print.css">
        <title>Bản in KQXS | In vé dò | In giấy dò kết quả xổ số <?php echo $province["name"]?></title>
    </head>
    <body>
        <?php $count_in = 4;?>
        <table align="center" border="0" cellpadding="0" cellspacing="0">
            <?php for($i=1;$i<=$count_in;$i++){?>
                <?php if($i%2==1){?><tr><?php }?> 
                    <td style="width: 360px; overflow: hidden;" valign="middle" align="center">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">  
                                    <p><span style="font-size: 15px"><span style="font-family: Times New Roman">
                                    <strong>KẾT QUẢ XỔ SỐ <?php echo $province["region"]==3 ? 'MIỀN NAM':'MIỀN TRUNG'?></strong>
                                    </span><br>
                                    </span><span style="font-size: 15px"><span><em>Khu vực <?php echo $province['name']?><br>
                                    <p style="text-align: right"><strong><em>Mở thưởng <?php echo Common::getDateFormat(strtotime($ngay_quay),3) ?></em></strong></p>
                                </td>
                            </tr>
                        </table>
                        <?php $this->renderPartial("load_province",array("data"=>$data,"province"=>$province))?>
                        <div style="text-align: right"><em><a href="http://www.ketquaveso.com/">www.ketquaveso.com</a> &nbsp;&nbsp; </em></div>
                    </td>
                    <?php if($i%2==1 && $i!=($count_in-1)){?>
                        <td valign="top" width="25" align="left"><div style="width:12px; height:25px; border-right:1px #333 solid"></div></td>
                        <?php }elseif($i==($count_in-1)){?>
                        <td valign="bottom" width="25" align="left"><div style="width:12px; height:25px; border-right:1px #333 solid"></div></td>
                        <?php }?>
                    <?php if($i%2==0){?>
                    </tr>
                    <?php }?> 
                <?php if($i%2==0 && $i != $count_in){?>
                    <tr>
                        <td valign="top" align="left"><div style="width:25px; height:12px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                        <td valign="top" align="left" height="25"><div style="width:11px; height:11px; border-right:1px #333 solid; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                        <td valign="top" align="right" height="1"><div style="width:25px; height:12px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                    </tr>
                    <?php }?>
                <?php }?>
        </table>      
    </body>
</html>