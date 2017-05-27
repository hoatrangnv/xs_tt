<script type="text/javascript">
    $(function(){

        $( "#ngay_quay" ).datepicker({
            dateFormat: 'dd-mm-yy', 
            changeMonth: true,
            changeYear: true,
            showAnim:'fold', 
            buttonText :false
        });
    });
</script>
<div class="col-l">
    <div class="box suport-print">
        <h1 class="title-bor nobor mag0"><strong>IN VÉ DÒ - (IN BẢNG KẾT QUẢ XỔ SỐ)</strong></h1>
        <div class="pad10-5 bgfeefc4 mag0">
            <form action="<?php echo Url::createUrl("print/index")?>" target="print" method="GET">
                <ul class="magb10 txt-center">
                    <li class="in-block mag-r15">
                        <p class="mag0"><strong>Miền</strong></p>
                        <div class="in-block">
                            <select style="width:133px" name="region">
                                <option value="1">Miền Bắc</option>
                                <option value="2">Miền Trung</option>
                                <option value="3">Miền Nam</option>
                            </select>
                        </div>
                    </li>
                    <li class="in-block mag-r15">
                        <p class="mag0"><strong>Ngày</strong></p>
                        <div class="in-block">
                            <input type="text" name="ngay_quay" id="ngay_quay" value="<?php echo date('d-m-Y')?>">
                        </div>
                    </li>
                    <li class="in-block">
                        <button type="submit" class="bt-red"><strong>In vé dò</strong></button>
                    </li>

                </ul>
            </form>
            <p><em>Chọn miền, chọn ngày và bấm "In Vé Dò".</em></p>
        </div>
        <div class="box">                    
            <div class="box-nd pad10">
                <h3 class="bg_green pad5 magb10">Hướng Dẫn In Vé Dò Kết Quả Xổ Số</h3>

                <p>- xosothantai.vn ngoài thế mạnh là một hệ thống websites tường thuật trực tiếp từng giải kết quả xổ số toàn quốc còn cung cấp tính năng In vé dò với mục đích đơn giản nhất cho anh chị em Đại Lý Vé Số in nhanh nhất KQXS trực tiếp hàng ngày hoặc in một ngày bất kỳ chỉ cần 1 cái bấm chuột từ kho dữ liệu chính xác, đầy đủ nhiều năm và cập nhật thường xuyên của Minh Ngọc mà không phải lưu trữ</p>
                <div class="title-c1"><strong>Hướng dẫn thiết lập ban đầu & In:</strong></div>
                <ul class="magb10">
                    <li class="pad5"><img width="8" height="9" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet1.png">
                    <strong>I/ Yêu cầu:</strong>
                        <ul>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                Để in KQXS trước tiên bạn phải có 1 máy in đã cài đặt và thiết lập khổ giấy A4
                            </li>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                Phiên bản này thiết kế mở rộng tương thích với trình duyệt Internet Explorer, Chrome và Mozilla Firefox
                            </li>
                        </ul>
                    </li>

                    <li class="pad5"><img width="8" height="9" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet1.png">
                    <strong> II/ Thiết lập trang In :</strong> (Chỉ làm 1 lần đầu tiên, sau đó máy tính của bạn tự lưu thiết lập này)
                        <ul>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                Hướng dẫn với trình duyệt Internet Explorer các trình duyệt khác cơ bản cũng tương tự, riêng với Chrome thì bạn chọn chế độ canh lề tối thiểu và bỏ "Đầu và chân trang" đi là ok.
                            </li>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                Trên trang bạn thấy dưới mỗi bảng KQXS đều có nút In vé dò bạn click vào đó và chọn loại, Hộp thoại Print hiện lên > Lần đầu này bạn nhấn Cancel > Vào File >> Page Setup... > Chọn khổ giấy A4, chọn canh lề các bên = 0 (nhiều máy in không cho canh lề = 0 thì bạn chọn thông số nhỏ nhất) >> Các thông số khung Headers and Footers thiết lập Empty >> Click OK >đóng. Vào Vào File >> Print Preview... > Xem lại thử trang in có hợp lý chưa, nếu chưa ok vui lòng xem lại hướng dẫn và xem thêm Thiết lập khổ giấy A4 cho máy in nếu tất cả ok in test thử 1 tờ.
                            </li>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                 Thế là xong, máy tính của bạn đã lưu lại thiết lập, từ giờ về sau muốn in bảng KQXS bạn chỉ cần Click  In vé dò , chọn loại bản in và Enter (Nếu in Kết Quả Trực Tiếp thì vào xem trực tiếp đến giải cuối cùng Click  In vé dò và Enter).
                            </li>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                 Muốn in nhanh KQXS của 1 ngày bất kỳ: Từ menu chính >click vào In vé dò  > chọn Miền > Chọn ngày > > Chọn loại >Click In Vé Dò > Enter là có ngay KQXS của ngày đó.
                            </li>
                        </ul>
                    </li>
                    
                    <li class="pad5"><img width="8" height="9" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet1.png">
                    <strong><em>Lưu ý</em></strong>
                        <ul>
                            <li>
                                <img width="8" height="8" class="mag-r5" alt="bullet" src="<?php echo Yii::app()->params["static_url"]?>/images/bulet3.png">
                                Vì bản in khi đang tường thuật trực tiếp và bản in kết quả đã xổ thiết kế khác nhau nên bạn phải làm thiết lập ban đầu trên mỗi trang
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>