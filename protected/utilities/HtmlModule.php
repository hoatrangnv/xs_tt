<?php
class HtmlModule{
    static function genHtmlMB($rows,$class="loading"){
        if(!$rows){
            $rows = array(
                "giai_bay_1" => "","giai_bay_2" => "","giai_bay_3" => "","giai_bay_4" => "",
                "giai_sau_1" => "","giai_sau_2" => "","giai_sau_3" => "",
                "giai_nam_1" => "","giai_nam_2" => "","giai_nam_3" => "","giai_nam_4" => "","giai_nam_5" => "","giai_nam_6" => "",
                "giai_tu_1" => "","giai_tu_2" => "","giai_tu_3" => "","giai_tu_4" => "",
                "giai_ba_1" => "","giai_ba_2" => "","giai_ba_3" => "","giai_ba_4" => "","giai_ba_5" => "","giai_ba_6" => "",
                "giai_nhi_1" => "","giai_nhi_2" => "",
                "giai_nhat" => "","giai_dacbiet" => "" 
            );
        }
        $html = '
            <table border="0" width="100%" cellspacing="0" cellpadding="0">                                                                                     
            <tr class="bg_gray">
            <td width="20%" class="text-left"><strong class="clred">Đặc biệt</strong></td>
            <td colspan="6"><span class="clred s18 '.($rows["giai_dacbiet"] == "" ? $class : '').'"><strong>'.$rows["giai_dacbiet"].'</strong></span></td>
            </tr>
            <tr>
            <td class="text-left"><strong>Giải nhất</strong></td>
            <td colspan="6"><strong class="s18 '.($rows["giai_nhat"] == "" ? $class : '').'">'.$rows["giai_nhat"].'</strong></td>
            </tr>
            <tr>
            <td class="text-left"><strong>Giải nhì</strong></td>
            <td colspan="3"><strong class="s18 '.($rows["giai_nhi_1"] == "" ? $class : '').'">'.$rows["giai_nhi_1"].'</strong></td>
            <td colspan="3"><strong class="s18 '.($rows["giai_nhi_2"] == "" ? $class : '').'">'.$rows["giai_nhi_2"].'</strong></td>
            </tr>
            <tr>
            <td class="text-left" rowspan="2"><strong>Giải ba</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_ba_1"] == "" ? $class : '').'">'.$rows["giai_ba_1"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_ba_2"] == "" ? $class : '').'">'.$rows["giai_ba_2"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_ba_3"] == "" ? $class : '').'">'.$rows["giai_ba_3"].'</strong></td>
            </tr>
            <tr>
            <td colspan="2"><strong class="s18 '.($rows["giai_ba_4"] == "" ? $class : '').'">'.$rows["giai_ba_4"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_ba_5"] == "" ? $class : '').'">'.$rows["giai_ba_5"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_ba_6"] == "" ? $class : '').'">'.$rows["giai_ba_6"].'</strong></td>
            </tr>
            <tr>
            <td class="text-left"><strong>Giải tư</strong></td>
            <td width="19%"><strong class="s18 '.($rows["giai_tu_1"] == "" ? $class : '').'">'.$rows["giai_tu_1"].'</td>
            <td colspan="2"><strong class="s18 '.($rows["giai_tu_2"] == "" ? $class : '').'">'.$rows["giai_tu_2"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_tu_3"] == "" ? $class : '').'">'.$rows["giai_tu_3"].'</strong></td>
            <td width="21%"><strong class="s18 '.($rows["giai_tu_4"] == "" ? $class : '').'">'.$rows["giai_tu_4"].'</strong></td>
            </tr>
            <tr>
            <td class="text-left" rowspan="2"><strong>Giải năm</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_nam_1"] == "" ? $class : '').'">'.$rows["giai_nam_1"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_nam_2"] == "" ? $class : '').'">'.$rows["giai_nam_2"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_nam_3"] == "" ? $class : '').'">'.$rows["giai_nam_3"].'</strong></td>
            </tr>
            <tr>
            <td colspan="2"><strong class="s18 '.($rows["giai_nam_4"] == "" ? $class : '').'">'.$rows["giai_nam_4"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_nam_5"] == "" ? $class : '').'">'.$rows["giai_nam_5"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_nam_6"] == "" ? $class : '').'">'.$rows["giai_nam_6"].'</strong></td>
            </tr>
            <tr>
            <td class="text-left"><strong>Giải sáu</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_sau_1"] == "" ? $class : '').'">'.$rows["giai_sau_1"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_sau_2"] == "" ? $class : '').'">'.$rows["giai_sau_2"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_sau_3"] == "" ? $class : '').'">'.$rows["giai_sau_3"].'</strong></td>
            </tr>
            <tr>
            <td class="text-left"><strong>Giải bảy</strong></td>
            <td><strong class="s18 '.($rows["giai_bay_1"] == "" ? $class : '').'">'.$rows["giai_bay_1"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_bay_2"] == "" ? $class : '').'">'.$rows["giai_bay_2"].'</strong></td>
            <td colspan="2"><strong class="s18 '.($rows["giai_bay_3"] == "" ? $class : '').'">'.$rows["giai_bay_3"].'</strong></td>
            <td><strong class="s18 '.($rows["giai_bay_4"] == "" ? $class : '').'">'.$rows["giai_bay_4"].'</strong></td>
            </tr>
            </table>
            ';
    
        return $html;
    } 
    static function getHtmlDauMB($loto,$link=""){  
        if($link==""){
            $link = Url::createUrl("home/index").'?type=1';  
        } 
        $html = '
        <table border="0" width="100%" cellspacing="0" cellpadding="0">                                                                                       
        <tr class=" bg_gray">
        <td width="35%">
        <select onchange="window.location=\''.$link.'\'">
        <option value="0" selected>Đầu</option>
        <option value="1">Đuôi</option>
        </select>
        </td>
        <td width="65%"><strong>Loto</strong></td>
        </tr>';
        for($i=0;$i<=9;$i++){
            $boso = "";
            for($j=0;$j<count($loto);$j++){
                if(substr($loto[$j],0,1)==$i){
                    $boso .= $loto[$j].', ';
                }               
            }
            $html .= '<tr>
            <td><strong class="s18">'.$i.'</strong></td>
            <td><strong class="s18">'.rtrim($boso,", ").'</strong></td>
            </tr>';
        }
        $html .= '</table>';
        return $html;
    }
    static function getHtmlDuoiMB($loto,$link=""){ 
        if($link==""){
            $link = Url::createUrl("home/index"); 
        }  
        $html = '
        <table border="0" width="100%" cellspacing="0" cellpadding="0">                                                                                       
        <tr class=" bg_gray">
        <td width="35%">
        <select onchange="window.location=\''.$link.'\'">
        <option value="0">Đầu</option>
        <option value="1" selected>Đuôi</option>
        </select>
        </td>
        <td width="65%"><strong>Loto</strong></td>
        </tr>';
        for($i=0;$i<=9;$i++){
            $boso = "";
            for($j=0;$j<count($loto);$j++){
                if(substr($loto[$j],-1,1)==$i){
                    $boso .= $loto[$j].', ';
                }
            }
            $html .= '<tr>
            <td><strong class="s18">'.$i.'</strong></td>
            <td><strong class="s18">'.rtrim($boso,", ").'</strong></td>
            </tr>';
        }
        $html .= '</table>';
        return $html;
    }

    static function genHtmlLotoMB($loto,$class="loading"){
        $html= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
        for($i=0;$i<3;$i++){
            $html .='<tr>';
            for($j=0;$j<9;$j++){
                $html .= '<td width="11%">
                <strong class="s14 '.($loto[($i*9) + $j] == "" ? $class : '').'">'.$loto[($i*9) + $j].'</strong>
                </td>'; 
            }
            $html .='</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    /* mien nam*/
    static function genHtmlMNMT($provinces,$rows,$class="loading"){
        foreach($provinces as $key=>$value){
            if(!isset($rows[$key]) || !$rows[$key]){
                $rows[$key] = array(
                    "giai_tam" => "","giai_bay" => "","giai_sau_1" => "","giai_sau_2" => "","giai_sau_3" => "","giai_nam" => "",
                    "giai_tu_1" => "","giai_tu_2" => "","giai_tu_3" => "","giai_tu_4" => "","giai_tu_5" => "",
                    "giai_tu_6" => "","giai_tu_7" => "","giai_ba_1" => "","giai_ba_2" => "","giai_nhi" => "","giai_nhat" => "",
                    "giai_dacbiet" => "","province_id"=>$key
                );
            }
        }
        foreach($rows as $key=>$value){
            $time = isset($value["ngay_quay"]) ? strtotime($value["ngay_quay"]):time();
            break;
        }            
        $day = getdate($time);
        $wday = Common::getWeekDay($day["wday"]);
        $html = '<table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>';                                                                                       
        $html .= '<tr class="bg_gray">';
        $html .= '<td width="'.floor(100 /(count($provinces)+1)).'%"><strong class="s16">'.$wday["label"].'</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td width="'.floor(100 /(count($provinces)+1)).'%"><strong class="s16 ">'.$provinces[$key]["name"].'</strong></td>';
        } 
        $html .= '</tr>';  

        $html .= '<tr>';
        $html .= '<td><strong class="s16 clred">Giải tám</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s24 clred '.($value["giai_tam"] == "" ? $class : '').'">'.$value["giai_tam"].'</strong></td>';
        } 
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><strong class="s16">Giải bảy</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_bay"] == "" ? $class : '').'">'.$value["giai_bay"].'</strong></td>';
        } 
        $html .= '</tr>';                                        
        $html .= '<tr>';
        $html .= '<td rowspan="3"><strong class="s16">Giải sáu</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_sau_1"] == "" ? $class : '').'">'.$value["giai_sau_1"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero no_bor_bottom"><strong class="s18 '.($value["giai_sau_2"] == "" ? $class : '').'">'.$value["giai_sau_2"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero no_bor_bottom"><strong class="s18 '.($value["giai_sau_3"] == "" ? $class : '').'">'.$value["giai_sau_3"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '</tr>'; 
        $html .= '<td><strong class="s16">Giải năm</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_nam"] == "" ? $class : '').'">'.$value["giai_nam"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td rowspan="7"><strong class="s16">Giải tư</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_tu_1"] == "" ? $class : '').'">'.$value["giai_tu_1"].'</strong></td>';
        } 
        $html .= '</tr>';
        for($i=2;$i<=7;$i++){
            $html .= '<tr>';
            foreach($rows as $key=>$value){
                $html .= '<td class="bottom_zero no_bor_bottom"><strong class="s18 '.($value["giai_tu_".$i] == "" ? $class : '').'">'.$value["giai_tu_".$i].'</strong></td>';
            } 
            $html .= '</tr>';    
        }
        $html .= '<tr>';
        $html .= '<td rowspan="2"><strong class="s16">Giải ba</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_ba_1"] == "" ? $class : '').'">'.$value["giai_ba_1"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero no_bor_bottom"><strong class="s18 '.($value["giai_ba_2"] == "" ? $class : '').'">'.$value["giai_ba_2"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><strong class="s16">Giải nhì</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_nhi"] == "" ? $class : '').'">'.$value["giai_nhi"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><strong class="s16">Giải nhất</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 '.($value["giai_nhat"] == "" ? $class : '').'">'.$value["giai_nhat"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><strong class="s16 clred">Giải đặc biệt</strong></td>';
        foreach($rows as $key=>$value){
            $html .= '<td class="bottom_zero"><strong class="s18 clred '.($value["giai_dacbiet"] == "" ? $class : '').'">'.$value["giai_dacbiet"].'</strong></td>';
        } 
        $html .= '</tr>';
        $html .= '</tbody></table>';      
        return $html;

    }
    static function genHtmlDauMTMN($province,$loto,$link="",$type=0){

        $html = '';
        $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        if($type==0){
            $html .= '<tr class="title_bggray">
            <td colspan="2"><strong class="s14">'.$province["name"].'</strong></td>
            </tr>';
        }
        $html .='<tr class="'.($type==0 ? 'title_gray' : 'bg_gray').'">
        <td width="37%" class="'.($type==0 ? 'bottom_zero' : 'text-left').'">
        <select onchange="window.location=\''.$link.'\'">
        <option value="0" selected>Đầu</option>
        <option value="1">Đuôi</option>
        </select>
        </td>
        <td width="63%" class="'.($type==0 ? 'bottom_zero' : 'text-left').'"><strong class="s14">Loto</strong></td>
        </tr>';
        for($i=0;$i<=9;$i++){
            $boso = "";
            for($j=0;$j<count($loto);$j++){
                if(substr($loto[$j],0,1)==$i){
                    $boso .= $loto[$j].', ';
                }               
            }
            $html .= '<tr>
            <td><strong class="s14">'.$i.'</strong></td>
            <td><strong class="s14">'.rtrim($boso,", ").'</strong></td>
            </tr>';
        }                       
        $html .= '</table>';
        return $html;
    }
    static function genHtmlDuoiMTMN($province,$loto,$link="",$type=0){

        $html = '';
        $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        if($type==0){
            $html .= '<tr class="title_bggray">
            <td colspan="2"><strong class="s14">'.$province["name"].'</strong></td>
            </tr>';
        }
        $html .='<tr class="'.($type==0 ? 'title_gray' : 'bg_gray').'">
        <td width="37%" class="'.($type==0 ? 'bottom_zero' : 'text-left').'">
        <select onchange="window.location=\''.$link.'\'">
        <option value="0">Đầu</option>
        <option value="1" selected>Đuôi</option>
        </select>
        </td>
        <td width="63%" class="'.($type==0 ? 'bottom_zero' : 'text-left').'"><strong class="s14">Loto</strong></td>
        </tr>';
        for($i=0;$i<=9;$i++){
            $boso = "";
            for($j=0;$j<count($loto);$j++){
                if(substr($loto[$j],-1,1)==$i){
                    $boso .= $loto[$j].', ';
                }
            }
            $html .= '<tr>
            <td><strong class="s14">'.$i.'</strong></td>
            <td><strong class="s14">'.rtrim($boso,", ").'</strong></td>
            </tr>';
        }                       
        $html .= '</table>';
        return $html;
    }

    static function getHtmlKQMNMT($data){
        $html = '';
        $html .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr class="bg_gray">
        <td width="20%" class="text-left"><strong class="clred">Đặc biệt</strong></td>
        <td colspan="6"><span class="clred s18"><strong>'.$data["giai_dacbiet"].'</strong></span></td>
        </tr>
        <tr>
        <td class="text-left"><strong>Giải nhất</strong></td>
        <td colspan="6"><strong class="s18">'.$data["giai_nhat"].'</strong></td>
        </tr>
        <tr>
        <td class="text-left"><strong>Giải nhì</strong></td>
        <td colspan="6"><strong class="s18">'.$data["giai_nhi"].'</strong></td>
        </tr>
        <tr>
        <td class="text-left"><strong>Giải Ba</strong></td>
        <td colspan="3"><strong class="s18">'.$data["giai_ba_1"].'</strong></td>
        <td colspan="3"><strong class="s18">'.$data["giai_ba_2"].'</strong></td>
        </tr>
        <tr>
        <td class="text-left" rowspan="2"><strong>Giải tư</strong></td>
        <td width="19%" height="10%"><strong class="s18">'.$data["giai_tu_1"].'</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_tu_2"].'</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_tu_3"].'</strong></td>
        <td width="21%" height="10%"><strong class="s18">'.$data["giai_tu_4"].'</strong></td>
        </tr>
        <tr>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_tu_5"].'</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_tu_6"].'</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_tu_7"].'</strong></td>
        </tr>
        <tr>
        <td class="text-left"><strong>Giải năm</strong></td>
        <td height="10%" colspan="6"><strong class="s18">'.$data["giai_nam"].'</strong></td>
        </tr>
        <tr>
        <td class="text-left"><strong>Giải sáu</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_sau_1"].'</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_sau_2"].'</strong></td>
        <td height="10%" colspan="2"><strong class="s18">'.$data["giai_sau_3"].'</strong></td>
        </tr>
        <tr>
        <td class="text-left"><strong>Giải bảy</strong></td>
        <td height="10%" colspan="6"><strong class="s18">'.$data["giai_bay"].'</strong></td>
        </tr>
        <tr>
        <td width="20%" class="text-left"><strong>Giải tám</strong></td>
        <td height="10%" colspan="6"><span class="s18"><strong>'.$data["giai_tam"].'</strong></span></td>
        </tr>
        </tbody>
        </table>';
        return $html;
    }
    static function genHtmlLotoMNMT($loto){
        $html= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
        for($i=0;$i<2;$i++){
            $html .='<tr>';
            for($j=0;$j<9;$j++){
                $html .= '<td width="11%">
                <strong class="s14">'.$loto[($i*9) + $j].'</strong>
                </td>'; 
            }
            $html .='</tr>';
        }
        $html .= '</table>';
        return $html;
    }
}
