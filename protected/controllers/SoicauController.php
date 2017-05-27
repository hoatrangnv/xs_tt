<?php
    class SoicauController extends Controller{

        public function init(){
            $this->current_url = Common::getCurrentUrl();
            $this->breadcrumbs[] = array("link"=>Url::createUrl("soicau/index"),"title"=>"Soi cầu");
//            if(!isset($_SESSION['mobile_xstt'])){
//                $this->redirect(Url::createUrl("login/index"));
//            }
        }
        public function actionIndex(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("soicau/index"),"title"=>"Soi cầu loto");
            $province_id = isset($_GET['province']) ? intval($_GET['province']) : 1;
            $bien_do_ngay = isset($_GET['bien_do_ngay']) ? intval($_GET['bien_do_ngay']) : 3;
            $bien_ngay = isset($_GET['bien_ngay']) ? mysql_escape_string(trim($_GET['bien_ngay'])) : date('d-m-Y',time());
            $bien_ngay_en = date('Y-m-d',strtotime($bien_ngay));
            $wday = date('w')+1;
            if($wday == 1) $wday = 8;
            $province_list = Provinces::getListProvinceToday($wday);
            $result = Soicau::getCauByData($province_id,$bien_do_ngay,$bien_ngay_en,1);
            $this->render("index",array("province_list"=>$province_list,"result"=>$result,"province_id"=>$province_id,"bien_do_ngay"=>$bien_do_ngay,"bien_ngay"=>$bien_ngay));
        }

        public function actionDacbiet(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("soicau/dacbiet"),"title"=>"Soi cầu đặc biệt");
            $province_id = isset($_GET['province']) ? intval($_GET['province']) : 1;
            $bien_do_ngay = isset($_GET['bien_do_ngay']) ? intval($_GET['bien_do_ngay']) : 2;
            $bien_ngay = isset($_GET['bien_ngay']) ? mysql_escape_string(trim($_GET['bien_ngay'])) : date('d-m-Y',time());
            $bien_ngay_en = date('Y-m-d',strtotime($bien_ngay));
            $wday = date('w')+1;
            if($wday == 1) $wday = 8;
            $province_list = Provinces::getListProvinceToday($wday);
            $result = Soicau::getCauByData($province_id,$bien_do_ngay,$bien_ngay_en,2);
            $this->render("dacbiet",array("province_list"=>$province_list,"result"=>$result,"province_id"=>$province_id,"bien_do_ngay"=>$bien_do_ngay,"bien_ngay"=>$bien_ngay));
        }

        public function actionHainhay(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("soicau/index"),"title"=>"Soi cầu 2 nháy");
            $province_id = isset($_GET['province']) ? intval($_GET['province']) : 1;
            $bien_do_ngay = isset($_GET['bien_do_ngay']) ? intval($_GET['bien_do_ngay']) : 2;
            $bien_ngay = isset($_GET['bien_ngay']) ? mysql_escape_string(trim($_GET['bien_ngay'])) : date('d-m-Y',time());
            $bien_ngay_en = date('Y-m-d',strtotime($bien_ngay));
            $wday = date('w')+1;
            if($wday == 1) $wday = 8;

            $province_list = Provinces::getListProvinceToday($wday);
            $result = Soicau::getCauByData($province_id,$bien_do_ngay,$bien_ngay_en,3);
            $this->render("hainhay",array("province_list"=>$province_list,"result"=>$result,"province_id"=>$province_id,"bien_do_ngay"=>$bien_do_ngay,"bien_ngay"=>$bien_ngay));
        }

        public function actionBachthu(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("soicau/bachthu"),"title"=>"Soi cầu bạch thủ");
            $province_id = isset($_GET['province']) ? intval($_GET['province']) : 1;
            $bien_do_ngay = isset($_GET['bien_do_ngay']) ? intval($_GET['bien_do_ngay']) : 3;
            $bien_ngay = isset($_GET['bien_ngay']) ? mysql_escape_string(trim($_GET['bien_ngay'])) : date('d-m-Y',time());
            $bien_ngay_en = date('Y-m-d',strtotime($bien_ngay));
            $wday = date('w')+1;
            if($wday == 1) $wday = 8;
            $province_list = Provinces::getListProvinceToday($wday);
            $result = Soicau::getCauByData($province_id,$bien_do_ngay,$bien_ngay_en,4);
            $this->render("bachthu",array("province_list"=>$province_list,"result"=>$result,"province_id"=>$province_id,"bien_do_ngay"=>$bien_do_ngay,"bien_ngay"=>$bien_ngay));
        }

        public function actionDetail(){
            $this->breadcrumbs[] = array("link"=>Url::createUrl("soicau/detail"),"title"=>"Soi cầu chi tiết");
            $cau_id = isset($_GET['cau_id']) ? intval($_GET['cau_id']) :1;
            $boso = isset($_GET['boso']) ? $_GET['boso'] :"";
            $region = isset($_GET['region']) ? intval($_GET['region']) :1;
            $province_name = isset($_GET['province_name']) ? $_GET['province_name'] :"";


            if($region == 1){
                $table = "ketqua_mienbac";
            }else if($region == 2){
                $table = "ketqua_mientrung";
            }else  if($region == 3){
                $table = "ketqua_miennam";
            }

            $result = Soicau::getBuocCauByData($cau_id,$boso);
            $str_step_id="";
            $arrCau = array();
            for($i=1;$i<=7;$i++){
                if($result['b'.$i.'_id'] >0) {
                    $arrCau[] = $result['b'.$i.'_dau'].$result['b'.$i.'_dit'];
                    if(empty($str_step_id)){
                        $str_step_id = $result['b'.$i.'_id'];
                    }else{
                        $str_step_id.=",".$result['b'.$i.'_id'];
                    }
                }
            }
            $data = array();
            if(!empty($str_step_id)){
                $data = Soicau::getBuocCauDetailById($table,$str_step_id);
            }
            $this->render("detail",array("region"=>$region,"province_name"=>$province_name,"data"=>$data,"x"=>$result[x],"y"=>$result['y'],'arrCau'=>$arrCau));
        }

        public function actionAjaxLoadBuoccau(){
            $cau_id = isset($_POST['cau_id']) ? intval($_POST['cau_id']) :1;
            $boso = isset($_POST['boso']) ? $_POST['boso'] :"";
            $region = isset($_POST['region']) ? intval($_POST['region']) :1;
            $province_name = isset($_POST['province_name']) ? $_POST['province_name'] :"";
            if($region == 1){
                $table = "ketqua_mienbac";
            }else if($region == 2){
                $table = "ketqua_mientrung";
            }else  if($region == 3){
                $table = "ketqua_miennam";
            }

            $result = Soicau::getBuocCauByData($cau_id,$boso);
            $str_step_id="";
            $arrCau = array();
            for($i=1;$i<=7;$i++){
                if($result['b'.$i.'_id'] >0) {
                    $arrCau[] = $result['b'.$i.'_dau'].$result['b'.$i.'_dit'];
                    if(empty($str_step_id)){
                        $str_step_id = $result['b'.$i.'_id'];
                    }else{
                        $str_step_id.=",".$result['b'.$i.'_id'];
                    }
                }
            }
            $data = Soicau::getBuocCauDetailById($table,$str_step_id);
            if($region == 1){
                $html = $this->genHtmlMB($data,$result[x],$result['y'],$region,$arrCau,$boso);
            }else{
                $html = $this->genHtmlMN($data,$result[x],$result['y'],$region,$province_name,$arrCau,$boso);
            }

            echo $html;exit();

        }
        public function genHtmlMB($data, $x, $y, $region,$arrCau,$boso){
            $html="";
            foreach($data as $key => $value){
                $arr_loto = Common::getLotoMB($value);
                $loto ="";
                foreach($arr_loto as $k => $result){
                    if($result == $arrCau[$key-1]){
                        $result = "<font color='red'>".$result."</font>";
                    }
                    $loto.= ", ".$result;
                }
                $loto = ltrim($loto,",");
                if($key == 0){
                    $box ='<div class="box'.'">
                        <div class="pad5">
                            <div class="box-note">
                                <p>Chi tiết kết quả phân tích<font color="red"> 3 </font> ngày của Xổ số Miền Bắc cho cặp số <font color="red"> '.$boso.' </font> ra trong lần quay tới</p>
                                <p>Vị trí số ghép lên phân tích >> Vị trí 1: <font color="red"> '.($x+1).' </font>, Vị trí 2: <font color="red"> '.($y+1).' </font></p>

                            </div>
                        </div>
                    </div>';
                }else{
                    $box = "";
                }
                $html .= $box.'

                        <div class="box-loop'.'">
                            <div id="kq" class="one-city">


                       <table width="100%" cellspacing="0" cellpadding="0" border="0" class="kqmb">
                            <tbody>
                        <tr>
                                                        <td colspan="12" style="text-align: center" class="txt-giai"><span style="font-weight: bold">Kết Quả Miền Bắc</span><span style="color:#ff0000"> ngày '.date('d-m-Y',strtotime($value['create_date'])).'</span></td>
                                                    </tr>
                        <tr class="db">
                                                        <td class="txt-giai">Đặc biệt</td>
                                                        <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_dacbiet",$value['giai_dacbiet'],$x,$y,$region).'</strong></td>
                                                    </tr>
                                                    <tr class="bggiai bg_f6">
                                                        <td class="txt-giai">Giải nhất</td>
                                                        <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_nhat",$value['giai_nhat'],$x,$y,$region).'</strong></td>
                                                    </tr>
                                                     <tr>
                                                        <td class="txt-giai">Giải nhì </td>
                                                        <td colspan="6" class="number"><strong class="">'.StringUtils::printboso("giai_nhi_1",$value['giai_nhi_1'],$x,$y,$region).'</strong></td>
                                                    <td colspan="6" class="number"><strong class="">'.StringUtils::printboso("giai_nhi_2",$value['giai_nhi_2'],$x,$y,$region).'</strong></td>

                                                     </tr>
                                                     <tr class="giai3 bggiai bg_ef">
                                                        <td class="txt-giai" rowspan="2">Giải ba</td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_ba_1",$value['giai_ba_1'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_ba_2",$value['giai_ba_2'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_ba_3",$value['giai_ba_3'],$x,$y,$region).'</strong></td>
                                                    </tr>
                                                   <tr class="bggiai bg_ef">

                                                       <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_ba_4",$value['giai_ba_4'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_ba_5",$value['giai_ba_5'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_ba_6",$value['giai_ba_6'],$x,$y,$region).'</strong></td>

                                                    </tr>
                                                    <tr>
                                                        <td class="txt-giai">Giải tư</td>
                                                         <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_1",$value['giai_tu_1'],$x,$y,$region).'</strong></td>
                                                        <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_2",$value['giai_tu_2'],$x,$y,$region).'</strong></td>
                                                        <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_3",$value['giai_tu_3'],$x,$y,$region).'</strong></td>
                                                        <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_4",$value['giai_tu_4'],$x,$y,$region).'</strong></td>

                                                    </tr>

                                                    <tr class="giai5 bggiai bg_ef">
                                                        <td class="txt-giai" rowspan="2">Giải năm</td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_nam_1",$value['giai_nam_1'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_nam_2",$value['giai_nam_1'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_nam_3",$value['giai_nam_3'],$x,$y,$region).'</strong></td>
                                                    </tr>
                                                    <tr class="bggiai bg_ef">

                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_nam_4",$value['giai_nam_4'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_nam_5",$value['giai_nam_5'],$x,$y,$region).'</strong></td>
                                                        <td class="number" colspan="4"><strong class="">'.StringUtils::printboso("giai_nam_6",$value['giai_nam_6'],$x,$y,$region).'</strong></td>

                                                    </tr>
                                                    <tr>
                                                        <td class="txt-giai">Giải sáu</td>
                                                       <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_sau_1",$value['giai_sau_1'],$x,$y,$region).'</strong></td>
                                                        <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_sau_2",$value['giai_sau_2'],$x,$y,$region).'</strong></td>
                                                        <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_sau_3",$value['giai_sau_3'],$x,$y,$region).'</strong></td>

                                                    </tr>
                                                    <tr class="bggiai bg_ef">
                                                        <td class="txt-giai">Giải bảy</td>
                                                            <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_bay_1",$value['giai_bay_1'],$x,$y,$region).'</strong></td>
                                                      <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_bay_2",$value['giai_bay_2'],$x,$y,$region).'</strong></td>
                                                      <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_bay_3",$value['giai_bay_3'],$x,$y,$region).'</strong></td>
                                                      <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_bay_4",$value['giai_bay_4'],$x,$y,$region).'</strong></td>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" style="text-align: left" class="txt-giai"><span style="font-weight: bold">Kết quả :</span>'.$loto.'</td>
                                                    </tr>

                        </tbody>
                        </table>

                    </div>';
            }
            return $html;
        }

        public function genHtmlMN($data, $x, $y, $region,$province_name,$arrCau,$boso)
        {
            $title = "Kết quả ".$province_name;
            $html = "";
            foreach ($data as $key => $value) {
                $arr_loto = Common::getLotoMN($value);
                $loto ="";
                foreach($arr_loto as $k => $result){
                    if($result == $arrCau[$key-1]){
                        $result = "<font color='red'>".$result."</font>";
                    }
                    $loto.= ", ".$result;
                }
                $loto = ltrim($loto,",");
                if($key == 0){
                    $box ='
                    <div class="box'.'">
                        <div class="pad5">
                            <div class="box-note">
                                <p>Chi tiết kết quả phân tích<font color="red"> 3 </font> ngày của Xổ số <font color="red"> '.$province_name.' </font> cho cặp số <font color="red"> '.$boso.' </font> ra trong lần quay tới</p>
                                <p>Vị trí số ghép lên phân tích >> Vị trí 1: <font color="red"> '.($x+1).' </font>, Vị trí 2: <font color="red"> '.($y+1).' </font></p>

                            </div>
                        </div>
                    </div>';
                }else{
                    $box = "";
                }

                $html.= $box.'

                <div class="box-loop'.'">
                    <div id="kq" class="one-city">

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="kqmb">
                            <tbody>
                                <tr>
                                    <td colspan="12" style="text-align: center" class="txt-giai"><span style="font-weight: bold">'.$title.'</span><span style="color:#ff0000"> ngày '.date('d-m-Y',strtotime($value['create_date'])).'</span></td>
                                </tr>
                                <tr class="giai8">
                                    <td class="txt-giai">Giải tám</td>
                                    <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_tam",$value['giai_tam'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr class="bg_ef">
                                    <td class="txt-giai">Giải bảy</td>
                                    <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_bay",$value['giai_bay'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr>
                                    <td class="txt-giai">Giải sáu</td>
                                    <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_sau_1",$value['giai_sau_1'],$x,$y,$region).'</strong></td>
                                    <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_sau_2",$value['giai_sau_2'],$x,$y,$region).'</strong></td>
                                    <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_sau_3",$value['giai_sau_3'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr class="bg_ef">
                                    <td class="txt-giai">Giải năm</td>
                                    <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_nam",$value['giai_nam'],$x,$y,$region).'</strong></td>
                                </tr>

                                <tr class="giai4">
                                    <td rowspan="2" class="txt-giai">Giải bốn</td>
                                    <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_1",$value['giai_tu_1'],$x,$y,$region).'</strong></td>
                                    <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_2",$value['giai_tu_2'],$x,$y,$region).'</strong></td>
                                    <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_3",$value['giai_tu_3'],$x,$y,$region).'</strong></td>
                                    <td colspan="3" class="number"><strong class="">'.StringUtils::printboso("giai_tu_4",$value['giai_tu_4'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr>

                                    <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_tu_5",$value['giai_tu_5'],$x,$y,$region).'</strong></td>
                                    <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_tu_6",$value['giai_tu_6'],$x,$y,$region).'</strong></td>
                                    <td colspan="4" class="number"><strong class="">'.StringUtils::printboso("giai_tu_7",$value['giai_tu_7'],$x,$y,$region).'</strong></td>
                                </tr>

                                <tr class="bg_ef">
                                    <td class="txt-giai">Giải ba</td>
                                    <td colspan="6" class="number"><strong class="">'.StringUtils::printboso("giai_ba_1",$value['giai_ba_1'],$x,$y,$region).'</strong></td>
                                    <td colspan="6" class="number"><strong class="">'.StringUtils::printboso("giai_ba_2",$value['giai_ba_2'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr>
                                    <td class="txt-giai">Giải nhì</td>
                                    <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_nhi",$value['giai_nhi'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr class="bg_ef">
                                    <td class="txt-giai">Giải nhất</td>
                                    <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_nhat",$value['giai_nhat'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr class="db">
                                    <td class="txt-giai">Đặc biệt</td>
                                    <td colspan="12" class="number"><strong class="">'.StringUtils::printboso("giai_dacbiet",$value['giai_dacbiet'],$x,$y,$region).'</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="text-align: left" class="txt-giai"><span style="font-weight: bold">Kết quả :</span>'.$loto.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';
            }
            return $html;
        }

    }
