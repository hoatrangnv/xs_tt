Đăng kí<br>
<form action="http://xosothantai.vn/kkt_api/XosoAPI.php" method="get"  ><br>
    <input type="hidden" name="action" value="register">
    Số điện thoại: <input type="text" name="mobile">  <br>
    Mã dịch vụ:<input type="text" name="service_type">   <br>
    <input type="submit" value="Đăng kí"/>                  <br>
</form>

Lấy mật khẩu<br>
<form action="http://xosothantai.vn/kkt_api/XosoAPI.php" method="get"  ><br>
    <input type="hidden" name="action" value="getPassword">
    Số điện thoại: <input type="text" name="mobile">  <br>
    <input type="submit" value="Lấy mật khẩu"/>                  <br>
</form>

Lấy kết quả<br>
<form action="http://xosothantai.vn/kkt_api/XosoAPI.php" method="get"  ><br>
    <input type="hidden" name="action" value="getKetquaxs">
    Mã tỉnh: <input type="text" name="province_id">  <br>
    Ngày quay: <input type="text" name="ngay_quay"> (Y-m-d) <br>
    <input type="submit" value="Lấy kết quả"/>      <br>
</form>

Lấy số thần tài<br>
<form action="http://xosothantai.vn/kkt_api/XosoAPI.php" method="get"  ><br>
    <input type="hidden" name="action" value="getSothantai">
    Mã tỉnh: <input type="text" name="province_id">  <br>
    <input type="submit" value="Lấy số thần tài"/>   <br>
</form>
