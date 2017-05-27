<?php

	date_default_timezone_set('Asia/Saigon'); 
    require_once("XosoDAO.php");
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    if(!empty($action)) {
        switch ($action) {
            case "register" : {
                $mobile = isset($_GET['mobile']) ? mysql_escape_string($_GET['mobile']) : "";
                $password = rand(10000, 99999);
                if (empty($mobile)) {
                    $output['code'] = 3;
                    $output['message'] = "Số điện thoại không được để trống";
                    echo json_encode($output);
                    break;
                }
                $check = checkMobile($mobile);
                if (!empty($check)) {
                    $output['code'] = 4;
                    $output['message'] = "Số điện thoại đã được đăng ký";
                    echo json_encode($output);
                    break;
                }
                $result = register($mobile, $password);
                if ($result == true) {
                    $output['code'] = 1;
                    $output['message'] = "Đăng ký thành công";
                    $output['mobile'] = $mobile;
                    $output['password'] = $password;

                } else {
                    $output['code'] = 2;
                    $output['message'] = "Đăng ký bị lỗi";
                }
                echo json_encode($output);
                break;
            }
            case "genPassword" : {
                $mobile = isset($_GET['mobile']) ? mysql_escape_string($_GET['mobile']) : "";
                if (!empty($mobile)) {
                    $password = getPasswordByMobile($mobile);
                    if (empty($password)) {
                        $output['password'] = rand(10000, 99999);
                        register($mobile, $password, $service_type);
                        echo json_encode($output);
                        break;
                    }
                    $output['password'] = $password;
                    echo json_encode($output);
                }
                break;
            }
            case "getKetquaxs" : {
                $province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 1;
                $ngay_quay = isset($_GET['ngay_quay']) ? mysql_escape_string($_GET['ngay_quay']) : "";
                if ($province_id == 0) $province_id = 1;
                if (empty($ngay_quay)) {
                    $ngay_quay = date('Y-m-d', time());
                }
                $region = getRegionByProvinceId($province_id);

                if ($region == 1) {
                    $table = "ketqua_mienbac";
                } else if ($region == 2) {
                    $table = "ketqua_mientrung";
                } else if ($region == 3) {
                    $table = "ketqua_miennam";
                }
                $row = getResultByProvinceIdAndTime($table, $province_id, $ngay_quay);
                if ($region == 1) {
                    $result = getResultMB($row);
                } else {
                    $result = getResultMN($row);
                }
                $output['result'] = $result;
                echo json_encode($output);
                break;
            }
            case "getSothantai" : {
                $province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 1;
                if ($province_id == 0) $province_id = 1;
                $bien_ngay = date('Y-m-d', time());
                $output = getSothantaiByProvinceId($province_id, $bien_ngay);
                echo json_encode($output);
                break;
            }
            case "getThongkeSmsContent" : {
                $province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 1;
                if ($province_id == 0) $province_id = 1;
                $output = getSmsContentProvinceId($province_id);
                echo json_encode($output);
                break;
            }
        }
    }
?>
<?php
    if(isset($_GET['function'])&& !empty($_GET['function'])){
            switch($_GET['function']){
                case "register" : {
                    echo "
                        <h1".">Function: register</h1><i>Đăng kí user</i><h3>Danh sách tham số:</h3>
                        <UL>
                            <LI>action: register</LI>
                            <LI>method: GET</LI>
                            <LI>Tham số:<br/>
                                mobile: số điện thoại<br/>
                            </LI>
                        </UL>
                        <span>Ví dụ: <a href='http://xosothantai.vn/api/XosoAPI.php?action=register&mobile=0976796069' target='_blank'>register</a></span>";break;
                }
                case "genPassword" : {
                    echo "
                        <h1".">Function: genPassword</h1><i>Lấy mật khẩu</i><h3>Danh sách tham số:</h3>
                        <UL>
                            <LI>action: getPassword</LI>
                            <LI>method: GET</LI>
                            <LI>Tham số:<br/>
                                mobile: số điện thoại<br/>
                            </LI>
                        </UL>
                        <span>Ví dụ: <a href='http://xosothantai.vn/api/XosoAPI.php?action=genPassword&mobile=0974838181' target='_blank'>getPassword</a></span>";break;
                }
                case "getKetquaxs" : {
                    echo "
                        <h1".">Function: getKetquaxs</h1><i>Lấy kết quả xs</i><h3>Danh sách tham số:</h3>
                        <UL>
                            <LI>action: getKetquaxs</LI>
                            <LI>method: GET</LI>
                            <LI>Tham số:<br/>
                                province_id: mã tỉnh<br/>
                                ngay_quay: ngày quay<br/>
                            </LI>
                        </UL>
                        <span>Ví dụ: <a href='http://xosothantai.vn/api/XosoAPI.php?action=getKetquaxs&province_id=1&ngay_quay=2011-03-14' target='_blank'>getKetquaxs</a></span>";break;
                }
                case "getSothantai" : {
                    echo "
                        <h1".">Function: getSothantai</h1><i>Lấy sô thần tài</i><h3>Danh sách tham số:</h3>
                        <UL>
                            <LI>action: getSothantai</LI>
                            <LI>method: GET</LI>
                            <LI>Tham số:<br/>
                                province_id: mã tỉnh<br/>
                            </LI>
                        </UL>
                        <span>Ví dụ: <a href='http://xosothantai.vn/api/XosoAPI.php?action=getSothantai&province_id=1' target='_blank'>getSothantai</a></span>";break;
                }
                case "getThongkeSmsContent" : {
                    echo "
                        <h1".">Function: getThongkeSmsContent</h1><i>Lấy thống kê nội dung sms</i><h3>Danh sách tham số:</h3>
                        <UL>
                            <LI>action: getThongkeSmsContent</LI>
                            <LI>method: GET</LI>
                            <LI>Tham số:<br/>
                                province_id: mã tỉnh<br/>
                            </LI>
                        </UL>
                        <span>Ví dụ: <a href='http://xosothantai.vn/api/XosoAPI.php?action=getThongkeSmsContent&province_id=1' target='_blank'>getThongkeSmsContent</a></span>";break;
                }
            }
    }
?>
<?php
    $province_code = array(
        "mb"=>1
    ,"ag"=>2
    ,"bl"=>3
    ,"bt"=>4
    ,"bd"=>5
    ,"bp"=>6
    ,"bth"=>7
    ,"cm"=>8
    ,"ct"=>9
    ,"dl"=>10
    );
?>
