<?php
    $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
    $ngay_quay = isset($data["ngay_quay"]) ? date('d-m-Y',strtotime($data["ngay_quay"])) : $ngay_quay;
?>
<div class="kqmb">
    <div class="top-box">
        <div class="title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN BẮC</div>
        <div class="daily"><em>(Đại lý xổ số: <strong><?php echo $name;?></strong>)</em></div>
        <div class="day"><?php echo Common::getDateFormat(strtotime($ngay_quay),4) ?></div>

    </div>
    <div class="box-kq">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="bkqmienbac">
            <tr>
                <td valign="top" class="col-giai">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="giaidb">Giải <br> Đặc Biệt</td>
                        </tr>
                        <tr>
                            <td class="giai1">Giải nhất</td>
                        </tr>
                        <tr>
                            <td class="giai2">Giải nhì</td>
                        </tr>
                        <tr>
                            <td class="giai3">Giải ba</td>
                        </tr>
                        <tr>
                            <td class="giai4">Giải tư</td>
                        </tr>
                        <tr>
                            <td class="giai5">Giải năm</td>
                        </tr>
                        <tr>
                            <td class="giai6">Giải sáu</td>
                        </tr>
                        <tr>
                            <td class="giai7">Giải bảy</td>
                        </tr>
                    </table>
                </td>
                <td valign="top">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td width="100%" valign="top">
                                <table width="100%" cellspacing="0" cellpadding="0" class="col-right">
                                    <tr>
                                        <td class="giaidb"><div><?php echo !empty($data["giai_dacbiet"]) ? $data["giai_dacbiet"] : "&nbsp;"?></div></td>
                                    </tr>
                                    <tr>
                                        <td class="giai1"><div><?php echo !empty($data["giai_nhat"]) ? $data["giai_nhat"] : "&nbsp;"?></div></td>
                                    </tr>
                                    <tr>
                                        <td class="giai2">
                                            <div><?php echo !empty($data["giai_nhi_1"]) ? $data["giai_nhi_1"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_nhi_2"]) ? $data["giai_nhi_2"] : "&nbsp;"?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="giai3">
                                            <div><?php echo !empty($data["giai_ba_1"]) ? $data["giai_ba_1"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_ba_2"]) ? $data["giai_ba_2"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_ba_3"]) ? $data["giai_ba_3"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_ba_4"]) ? $data["giai_ba_4"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_ba_5"]) ? $data["giai_ba_5"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_ba_6"]) ? $data["giai_ba_6"] : "&nbsp;"?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="giai4">
                                            <div><?php echo !empty($data["giai_tu_1"]) ? $data["giai_tu_1"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_tu_2"]) ? $data["giai_tu_2"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_tu_3"]) ? $data["giai_tu_3"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_tu_4"]) ? $data["giai_tu_4"] : "&nbsp;"?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="giai5">
                                            <div><?php echo !empty($data["giai_nam_1"]) ? $data["giai_nam_1"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_nam_2"]) ? $data["giai_nam_2"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_nam_3"]) ? $data["giai_nam_3"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_nam_4"]) ? $data["giai_nam_4"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_nam_5"]) ? $data["giai_nam_5"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_nam_6"]) ? $data["giai_nam_6"] : "&nbsp;"?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="giai6">
                                            <div><?php echo !empty($data["giai_sau_1"]) ? $data["giai_sau_1"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_sau_2"]) ? $data["giai_sau_2"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_sau_3"]) ? $data["giai_sau_3"] : "&nbsp;"?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="giai7">
                                            <div><?php echo !empty($data["giai_bay_1"]) ? $data["giai_bay_1"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_bay_2"]) ? $data["giai_bay_2"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_bay_3"]) ? $data["giai_bay_3"] : "&nbsp;"?></div>
                                            <div><?php echo !empty($data["giai_bay_4"]) ? $data["giai_bay_4"] : "&nbsp;"?></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="bottom1"><strong>Nhận KQXS Miền Bắc Soạn: TT MB gửi 19008612</strong></div>
        <div class="bottom2"><strong>Kính Chúc Quý Khách May Mắn Phát Tài!..</strong></div>
    </div>
    <div class="bottom clearfix">
        <div class="fl">xoso.me</div>
        <div class="fr">Miền bắc - Ký hiệu <strong>MB</strong></div>
    </div>
</div>