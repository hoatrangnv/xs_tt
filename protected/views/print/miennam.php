<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>In ve do mien bac</title>
        <link href="<?php echo Yii::app()->params["static_url"]?>/css/print/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
            if(count($provinces)==4){
                $style = "font-family:'Times New Roman', Times, serif";
            }else{
                $style = "";
            }
        ?>
        <table cellspacing="0" cellpadding="0" border="0" align="center" style="<?php echo $style;?>">
            <tbody>
                <tr>
                    <td style="width:360px; overflow:hidden" align="center" valign="middle">
                        <?php $this->renderPartial("load_kqmn",array("data"=>$data,"provinces"=>$provinces,"ngay_quay"=>$ngay_quay))?>
                    </td>
                    <td style="width:21px; min-width:21px;" align="left" valign="top"><div style="width:10px; height:21px; border-right:1px #333 solid"></div></td>
                    <td style="width:360px; overflow:hidden" align="center" valign="middle">
                        <?php $this->renderPartial("load_kqmn",array("data"=>$data,"provinces"=>$provinces,"ngay_quay"=>$ngay_quay))?>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top"><div style="width:21px; height:12px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                    <td align="left" height="25" valign="top"><div style="width:11px; height:11px; border-right:1px #333 solid; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                    <td align="right" height="1" valign="top"><div style="width:21px; height:12px; border-bottom:1px #333 solid; overflow:hidden"></div></td>
                </tr>
                <tr>
                    <td style="width:360px; overflow:hidden" align="center" valign="middle">
                        <?php $this->renderPartial("load_kqmn",array("data"=>$data,"provinces"=>$provinces,"ngay_quay"=>$ngay_quay))?>
                    </td>
                    <td style="width:21px; min-width:21px;" align="left" valign="top"><div style="width:10px; height:21px; border-right:1px #333 solid"></div></td>
                    <td style="width:360px; overflow:hidden" align="center" valign="middle">
                        <?php $this->renderPartial("load_kqmn",array("data"=>$data,"provinces"=>$provinces,"ngay_quay"=>$ngay_quay))?>
                    </td>
                </tr>
            </tbody>
        </table>
        <script language="javascript">
            window.print();
        </script>
    </body>
</html>
