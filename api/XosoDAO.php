<?php
	require_once("Config.php");
    date_default_timezone_set('Asia/Saigon');

    function register($mobile,$password)
    {
        $sql ="INSERT INTO user_veso(mobile,password) VALUES ('$mobile','$password') " ;
        $result = @mysql_query($sql);
        return $result;
    }

    function checkMobile($mobile)
    {
        $sql ="SELECT  mobile FROM user_veso  WHERE mobile = '$mobile'" ;
        $result = @mysql_query($sql);
        $rs = @mysql_fetch_row($result);
        return $rs[0];
    }

    function getPasswordByMobile($mobile)
    {
        $sql ="SELECT password FROM user_veso  WHERE mobile = '$mobile'" ;
        $result = @mysql_query($sql);
        $rs = @mysql_fetch_row($result);
        @mysql_close();
        return $rs[0];
    }

    function getRegionByProvinceId($province_id)
    {
        $sql = "SELECT region FROM province WHERE id = ".$province_id;
        $result = @mysql_query($sql);
        $rs = @mysql_fetch_row($result);
        return $rs[0];
    }

    function getResultByProvinceIdAndTime($table,$province_id,$ngay_quay){
        $sql ="SELECT  * FROM  ".$table." WHERE province_id = ".$province_id." AND ngay_quay = '".$ngay_quay."'";
        $result = @mysql_query($sql);
        $row =@mysql_fetch_assoc($result);
        return $row;
    }

    function getResultMB($rows){
        $result ="";
        $result .= "-".$rows["giai_dacbiet"];
        $result .= "-".$rows["giai_nhat"];
        for($i=0;$i<2;$i++){
            $result .= "-".$rows["giai_nhi_".($i+1)];
        }
        for($i=0;$i<6;$i++){
            $result .= "-".$rows["giai_ba_".($i+1)];
        }
        for($i=0;$i<4;$i++){
            $result .= "-".$rows["giai_tu_".($i+1)];
        }
        for($i=0;$i<6;$i++){
            $result .= "-".$rows["giai_nam_".($i+1)];
        }
        for($i=0;$i<3;$i++){
            $result .= "-".$rows["giai_sau_".($i+1)];
        }
        for($i=0;$i<4;$i++){
            $result .= "-".$rows["giai_bay_".($i+1)];
        }
        $rs = ltrim($result,"-");
        return $rs;
    }

    function getResultMN($rows){
        $result ="";
        $result .= "-".$rows["giai_dacbiet"];
        $result .= "-".$rows["giai_nhat"];
        $result .= "-".$rows["giai_nhi"];
        for($i=0;$i<2;$i++){
            $result .= "-".$rows["giai_ba_".($i+1)];
        }
        for($i=0;$i<7;$i++){
            $result .= "-".$rows["giai_tu_".($i+1)];
        }
        $result .= ",".$rows["giai_nam"];
        for($i=0;$i<3;$i++){
            $result .= "-".$rows["giai_sau_".($i+1)];
        }
        $result .= "-".$rows["giai_bay"];
        $result .= "-".$rows["giai_tam"];
        $rs = ltrim($result,"-");
        return $rs;
    }

    function getSothantaiByProvinceId($province_id,$bien_ngay)
    {
        $sql = "SELECT * FROM  xs_cau_dep WHERE province_id = ".$province_id." AND bien_ngay ='".$bien_ngay."'";
        $result = @mysql_query($sql);
        $data = array();
        while($value = @mysql_fetch_array($result)){
            $data['create_date'] = $value['bien_ngay'];
            if($value['type'] == 1){
                $arr = json_decode($value['boso'],true);
                $cs_loto ="";
                $cau_id_cs_loto ="";
                foreach($arr as $k =>$rs){
                    $cs_loto .= ",".$rs['boso'] ;
                    $cau_id_cs_loto .=",".$rs['cau_id'];
                }
                $data['capso_loto'] = ltrim($cs_loto,",");
            }
            if($value['type'] == 2){
                $arr = json_decode($value['boso'],true);
                $cs_db_cham="";
                $cau_id_cs_db_cham="";
                foreach($arr as $k =>$rs){
                    $cs_db_cham.=",".$rs['boso'] ;
                    $cau_id_cs_db_cham .=",".$rs['cau_id'];
                }
                $data['capso_dacbiet'] =ltrim($cs_db_cham,",");
            }

            if($value['type'] == 3){
                $arr = json_decode($value['boso'],true);
                $cs_dacbiet = "";
                $cau_id_cs_dacbiet = "";
                foreach($arr as $k =>$rs){
                    $cs_dacbiet .= ",".$rs['boso'] ;
                    $cau_id_cs_dacbiet .=",".$rs['cau_id'];
                }
                $data['capso_hainhay'] = ltrim($cs_dacbiet,",");
            }
        }
        return $data;
    }

    function getSmsContentProvinceId($province_id)
    {
        $create_date = date("Y-m-d",time());
        $sql = "SELECT * FROM  thongke_sms_content WHERE province_id = ".$province_id." AND DATE_FORMAT(create_date,'%Y-%m-%d') ='".$create_date."' ORDER BY id DESC LIMIT 5";
        $result = @mysql_query($sql);
        $data = array();
        while($value = @mysql_fetch_array($result)){
            if($value['type_tk'] == 1){
                $data['loto_ve_nhieu'] = $value['content'];
            }
            if($value['type_tk'] == 2){
                $data['loto_gan'] = $value['content'];
            }
            if($value['type_tk'] == 3){
                $data['dacbiet_gan'] = $value['content'];
            }
            if($value['type_tk'] == 4){
                $data['tong_dacbiet'] = $value['content'];
            }
            if($value['type_tk'] == 5){
                $data['cham_dacbiet'] = $value['content'];
            }
        }
        return $data;
    }

    function downloadFile($path){
        if(file_exists($path) && is_readable($path) && file_exists($path)){
            header("Content-Disposition: attachment; filename=".basename(str_replace(' ', '_', $path)));
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Type: application/java-archive");
            header("Content-Type: application/vnd.android.package-archive");
            header("Content-Description: File Transfer");
            header("Content-Length: " . filesize($path));
            flush(); // this doesn't really matter.
            $fp = fopen($path, "r");
            while (!feof($fp))
            {
                echo fread($fp, 65536);
                flush(); // this is essential for large downloads
            }
            fclose($fp);
            exit;
        } 
    }    
?>
