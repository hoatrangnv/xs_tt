<?php
    if(count($provinces)==4){
        $percent = '25%';
    }elseif(count($provinces)==3){
        $percent = '33%';
    }elseif(count($provinces)==2){
        $percent = '33%';
    }
    $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
    $date = getdate(strtotime($ngay_quay));
    $wday = Common::getWeekDay($date["wday"]);
?>
<div class="box-kq">
    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr>
            <td>
                <div class="top-box1">
                    <div class="title1">KẾT QUẢ XỔ SỐ MIỀN NAM - <?php echo str_replace("-","/",$ngay_quay);?></div> 
                    <div class="daily"><em>(Đại lý xổ số: <strong><?php echo $name;?></strong>)</em></div></div>
            </td>
        </tr>
        <tr>
            <td class="topsms"><b><i>www.xoso.me - Xo so 3 mien - xoso.me </i></b></td>
        </tr>
        <tr>
            <td valign="top">
                <div class="bkqmiennam">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td width="80" valign="top">
                                <table width="100%" cellspacing="0" cellpadding="0" class="leftcl">
                                    <tr><td class="thu"><?php echo $wday["label"]?></td></tr>
                                    <tr><td class="ngay"><?php echo $ngay_quay;?></td></tr>
                                    <tr><td class="giai8">Giải 8</td></tr>
                                    <tr><td class="giai7">Giải 7</td></tr>
                                    <tr><td class="giai6">Giải 6</td></tr>
                                    <tr><td class="giai5">Giải 5</td></tr>
                                    <tr><td class="giai4">Giải 4</td></tr>
                                    <tr><td class="giai3">Giải 3</td></tr>
                                    <tr><td class="giai2">Giải 2</td></tr>
                                    <tr><td class="giai1">Giải 1</td></tr>
                                    <tr><td class="giaidb"><strong>ĐB</strong></td></tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <?php foreach($provinces as $value){?>
                                            <td width="<?php echo $percent;?>" valign="top">
                                                <table width="100%" cellspacing="0" cellpadding="0" class="rightcl">
                                                    <tbody>
                                                    <tr>
                                                        <td class="tinh"><?php echo $value["name_print"] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="matinh"><?php echo strtoupper($value["code"]) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai8">
                                                            <div><?php echo isset($data[$value["id"]]["giai_tam"]) ? $data[$value["id"]]["giai_tam"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai7">
                                                            <div><?php echo isset($data[$value["id"]]["giai_bay"]) ? $data[$value["id"]]["giai_bay"]:"&nbsp;" ?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai6">
                                                            <div><?php echo isset($data[$value["id"]]["giai_sau_1"]) ? $data[$value["id"]]["giai_sau_1"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_sau_2"]) ? $data[$value["id"]]["giai_sau_2"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_sau_3"]) ? $data[$value["id"]]["giai_sau_3"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai5">
                                                            <div><?php echo isset($data[$value["id"]]["giai_nam"]) ? $data[$value["id"]]["giai_nam"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai4">
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_1"]) ? $data[$value["id"]]["giai_tu_1"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_2"]) ? $data[$value["id"]]["giai_tu_2"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_3"]) ? $data[$value["id"]]["giai_tu_3"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_4"]) ? $data[$value["id"]]["giai_tu_4"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_5"]) ? $data[$value["id"]]["giai_tu_5"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_6"]) ? $data[$value["id"]]["giai_tu_6"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_tu_7"]) ? $data[$value["id"]]["giai_tu_7"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai3">
                                                            <div><?php echo isset($data[$value["id"]]["giai_ba_1"]) ? $data[$value["id"]]["giai_ba_1"]:"&nbsp;" ?></div>
                                                            <div><?php echo isset($data[$value["id"]]["giai_ba_2"]) ? $data[$value["id"]]["giai_ba_2"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai2">
                                                            <div><?php echo isset($data[$value["id"]]["giai_nhi"]) ? $data[$value["id"]]["giai_nhi"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giai1">
                                                            <div><?php echo isset($data[$value["id"]]["giai_nhat"]) ? $data[$value["id"]]["giai_nhat"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="giaidb">
                                                            <div><?php echo isset($data[$value["id"]]["giai_dacbiet"]) ? $data[$value["id"]]["giai_dacbiet"]:"&nbsp;" ?></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php }?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top" style="text-align: center" class="bottom"><span class="vdbottom">Nhận KQXS các tỉnh Soạn: TT Mã Tỉnh gửi 19008612</span></td>
        </tr>
    </table>
</div>