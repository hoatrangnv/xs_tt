<?php
    class LoadConfig{
        static public $string_wday = array(
            2=>"Thứ hai"
            ,3=>"Thứ ba"
            ,4=>"Thứ tư"
            ,5=>"Thứ năm"
            ,6=>"Thứ sáu"
            ,7=>"Thứ bảy"
            ,8=>"Chủ nhật"
        );

        static public $string_token ='api#ve%so';
        static public $category_news = array(
            1=>"Tin tức",
            2=>"Dự đoán",
            3=>"Kết quả theo miền",
            4=>"Kết quả theo tỉnh",
            5=>"Video",
            6=>"Tử vi",
            7=>"Xem tướng",
            8=>"Bóng đá",
            9=>"Game",
            10=>"App",
            11=>"Nhạc chờ",
        );

        static public $tuvi_cat = array(
            1=>array("name"=>"Tử vi hàng ngày","alias"=>"tu-vi-hang-ngay","meta_title"=>"Tử vi hàng ngày 12 cung hoàng đạo - Xem bói tử vi","meta_keyword"=>"tu vi hang ngay, tu vi 12 cung hoang dao, tu vi hang tuan","meta_desc"=>"Tử vi hàng ngày 12 cung hoàng đạo. Xem tình cảm, vận hạn, tốt xấu, những điều may mắn trong ngày của các cung hoàng đạo"),
            2=>array("name"=>"Xem vận hạn","alias"=>"xem-van-han","meta_title"=>"Xem vận hạn theo ngày tháng năm sinh năm 2014 - 2013","meta_keyword"=>"xem van han theo tuoi, xem van han theo ngay sinh, van han theo nam sinh","meta_desc"=>"Vận hạn của các tuổi Đinh mão, Mậu thìn, Nhâm Thân, Giáp tuất,…được cập nhật liên tục. Xem vận hạn theo ngày tháng năm sinh trong năm 2013 - 2014"),
            3=>array("name"=>"Xuất hành khai trương","alias"=>"xuat-hanh-khai-truong","meta_title"=>"Xem ngày xuất hành khai trương năm giáp ngọ 2013","meta_keyword"=>"xuat hanh ngay nao dep, khai truong cua hang ngay nao dep, khai truong cong ty vao ngay nao","meta_desc"=>"Xem ngày xuất hành khai trương năm 2013 - 2014. Tư vấn những ngày đẹp cho xuất hành, ngày tốt lành để khai trương cửa hàng, công ty…"),
            4=>array("name"=>"Xem tuổi xây nhà","alias"=>"xem-tuoi-xay-nha","meta_title"=>"Xem tuổi xây nhà năm 2014, Xem năm hợp tuổi xây nhà","meta_keyword"=>"xem ngay hop tuoi xay nha, tuoi nao nen xay nha nam 2014","meta_desc"=>"Giúp bạn xem ngày, xem giờ, Chọn ngày làm nhà, ngày động thổ, ngày cất nóc theo tháng và năm, xem hợp tuổi làm nhà"),
            5=>array("name"=>"Xem ngày tốt xấu","alias"=>"xem-ngay-tot-xau","meta_title"=>"Xem ngay tot xau nam 2014, Xem ngay tot xau trong thang","meta_keyword"=>"xem ngay tot xau trong thang, xem ngay tot xau trong nam","meta_desc"=>"Xem ngày tốt xấu trong tuần, tháng, năm để biết việc kiêng nên, hung cát cưới xin, xây nhà, chuyển nhà, khai trương, làm nhà, cưới hỏi..."),
            6=>array("name"=>"Xem tuổi vợ chồng","alias"=>"xem-tuoi-vo-chong","meta_title"=>"Xem tuoi vo chong hop nhau, Xem tuoi vo chong de sinh con trai con gai","meta_keyword"=>"xem tuoi vo chong theo cung menh, xem tuoi vo chong de sinh con theo y muon","meta_desc"=>"Giúp bạn xem tuổi vợ chồng hợp nhau, xem tuổi vợ chồng năm nào cưới, năm nào sinh con trai, con gái để hợp mệnh, hợp tuổi với bố mẹ"),
            7=>array("name"=>"Xem năm sinh con","alias"=>"xem-nam-sinh-con","meta_title"=>"Xem năm sinh con trai con gái hợp tuổi bố mẹ - Theo ý muốn","meta_keyword"=>"xem nam sinh con hop tuoi bo me, xem nam sinh con theo y muon","meta_desc"=>"Giúp bạn xem năm sinh con trai, con gái theo ý muốn. Sinh con trai con gái hợp tuổi bố mẹ, sinh con trai con gái theo ý muốn"),
            8=>array("name"=>"Chọn tuổi xông đất","alias"=>"chon-tuoi-xong-dat","meta_title"=>"chọn tuổi xông đất năm 2014 - Giáp Ngọ","meta_keyword"=>"chon tuoi xong dat 2014,xem tuoi xong dat nam 2014","meta_desc"=>"Chọn tuổi xông đất năm 2014 hợp tuổi gia chủ, tuổi giám đốc.")
        );

        static public $xemtuong_cat = array(
            1=>array("name"=>"Xem nốt ruồi","alias"=>"not-ruoi","meta_title"=>"Xem nốt ruổi trên cơ thể - đàn ông, phụ nữ","meta_keyword"=>"xem nốt ruồi trên cơ thể đàn ông,xem nốt ruồi trên cơ thể phụ nữ","meta_desc"=>"Xem nốt ruồi trên cơ thể đàn ông, phụ nữ dự đoán vận mệnh, công danh sự nghiệp, tình duyên"),
            2=>array("name"=>"Xem tướng cơ thể","alias"=>"tuong-co-the","meta_title"=>"Xem tướng trên cơ thể - đàn ông, phụ nữ ","meta_keyword"=>"Xem tướng trên cơ thể đàn ông,Xem tướng trên cơ thể phụ nữ","meta_desc"=>"Xem tướng trên cơ thể của đàn ông, phụ nữ.Xem tướng chỉ tay, nốt ruồi trên cơ thể"),
            3=>array("name"=>"Xem chỉ tay","alias"=>"chi-tay","meta_title"=>"Xem chỉ tay - công danh, sự nghiệp, tình duyên, sinh đạo","meta_keyword"=>"xem chỉ tay đoán tương lai,xem chỉ tay hôn nhân,xem chỉ tay đường sinh đạo","meta_desc"=>"Xem chỉ tay dự đoán đường công danh, sự nghiệp, tình yêu, hôn nhân chính xác")
        );

        static public $bongda_cat = array(
            1=>array("name"=>"Tin tức bóng đá","alias"=>"tin-tuc-bong-da","meta_title"=>"Tin tuc bong da moi nhat, tin chuyen nhuong","meta_keyword"=>"tin bong da moi nhat, tin chuyen nhuong moi nhat, chuyen nhuong cau thu","meta_desc"=>"Tổng hợp tin tức bóng đá việt nam, tin bóng đá ngoại hạng anh, tay ban nha, bóng đá châu âu, Tin chuyển nhượng cầu thủ mùa giải mới…"),
            //2=>array("name"=>"Dự đoán kết quả bóng đá","alias"=>"du-doan-ket-qua-bong-da","meta_title"=>"Du doan ket qua tran dau toi nay, Du doan ket qua bong da dem nay","meta_keyword"=>"du doan ket qua tran dau, du doan ket qua tran dem nay, du doan ket qua tran toi nay","meta_desc"=>"Dự đoán kết quả bóng đá tất cả các trận của giải bóng đá ngoại hạng anh, Tây ban nha, C1, Seri A, Champion league…"),
            3=>array("name"=>"Link sopcast","alias"=>"link-sopcast","meta_title"=>"Link sopcast bong da hom nay, Link sopcast K+1 - Vtv3 - bong da tv","meta_keyword"=>"link sopcast tran dem nay, link sopcast hd, link sopcast bong da, link sopcast trực tuyến","meta_desc"=>"Link sopcast xem bóng đá hôm nay, cập nhật hàng ngày link sopcast hd online, K+1, xem trực tiếp bóng đá trên K+, VTV3, VTV2 của truyền hình…"),
            4=>array("name"=>"Lịch phát sóng bóng đá","alias"=>"lich-phat-song-bong-da","meta_title"=>"Lịch phát sóng bóng đá trên kênh K+ - VTV3 - Bong da tv hôm na","meta_keyword"=>"lich phat song bong da, lich phat song bong da kenh k+, lich ngoai hang anh, lich wordcup, lich seagame","meta_desc"=>"Lịch phát sóng bóng đá - trên kênh truyền hình VtV3, K+, Bóng đá TV, VTC...Các giải Ngoại hạng anh, Ý, Pháp, Tây Ban Nha được cập nhật liên tục"),
            5=>array("name"=>"World cup","alias"=>"world-cup",
                "meta_title_xs999"=>"World cup 2014 - Lịch thi đấu, lịch phát sóng, kết quả, Bảng xếp hạng",
                "meta_keyword_xs999"=>"world cup 2014,  world cup 2014 brazil, wc 2014, wc2014",
                "meta_desc_xs999"=>"World cup 2014: Chuyên lịch phát sóng, kết quả, bảng xếp hạng, lịch thi đấu các trận vòng bảng A, B, C, D, E, F, G, H, tứ kết, chung kết, bán kết world cup 2014 Brazil",
                "meta_title"=>"World cup 2014 - Tin nhanh, Video, Lịch thi đấu, Kết quả",
                "meta_keyword"=>"world cup 2014, worldcup 2014, wc2014, wc 2014",
                "meta_desc"=>"World cup 2014: Tin nhanh nhất, lịch phát sóng các trận đấu trên truyền hình, lịch thi đấu 64 trận world cup, kết quả, bảng xếp hạng cập nhật nhanh, chính xác."

            )

        );

        static public $game_cat = array(
            1=>array("name"=>"Game cho Android","alias"=>"game-cho-android","meta_title"=>"Game cho Android - Tai game android mien phi - Game android Offline","meta_keyword"=>"game cho android, game android cho dien thoai, tai game android apk","meta_desc"=>"Game cho android. Tải file apk game android miễn phí cho điện thoại, Tổng hợp các game download cho android An toàn - Tốc độ - Miễn phí."),
            2=>array("name"=>"Game cho IOS","alias"=>"game-cho-ios","meta_title"=>"Game cho IOS - Tai game IOS mien phi - Game IOS Offline","meta_keyword"=>"game cho ios, game ios online, game ios offline, download file apk cho game ios","meta_desc"=>"Game cho IOS. Tải file apk game IOS miễn phí cho điện thoại, Tổng hợp các game download cho IOS An toàn - Tốc độ - Miễn phí."),
            3=>array("name"=>"Game cho Windows","alias"=>"game-cho-windows","meta_title"=>"Game cho Windows - Tai game Windows mien phi - Game Windows offline","meta_keyword"=>"game windows mien phi, game windows online, game windows offline, file game windows","meta_desc"=>"Game cho Windows. Tải file game Windows miễn phí cho điện thoại, Tổng hợp các game download cho Windows An toàn - Tốc độ - Miễn phí."),
            4=>array("name"=>"Game cho Java","alias"=>"game-cho-java","meta_title"=>"Game cho Java - Tai game Java mien phi - Game Java offline","meta_keyword"=>"game Java mien phi, game Java online, game Java offline, file jar, jad","meta_desc"=>"Game cho Java. Tải file game Java miễn phí cho điện thoại, Tổng hợp các game download cho Java An toàn - Tốc độ - Miễn phí."),
        );

        static public $status = array(
            1=>"Hiển thị",
            0=>"Không hiển thị"
        );

        static public $region = array(
            "mb"=>array("hour_live"=>18,"id"=>1,"name"=>"Miền Bắc","action"=>"mienbac")
            ,"mt"=>array("hour_live"=>17,"id"=>2,"name"=>"Miền Trung","action"=>"mientrung")
            ,"mn"=>array("hour_live"=>16,"id"=>3,"name"=>"Miền Nam","action"=>"miennam")
        );    
        static public $label_region = array(
            1=>"Miền Bắc"
            ,2=>"Miền Trung"
            ,3=>"Miền Nam"
        );
        static public $label_alias = array(
            1=>"mien-bac"
            ,2=>"mien-trung"
            ,3=>"mien-nam"
        );
        static public $region_statistic = array(
            "mien-bac"=>"miền bắc"
            ,"mien-trung"=>"miền trung"
            ,"mien-nam"=>"miền nam"
        );
        static public $province_mb = array(
            1=>array("id"=>1,"live"=>array(2,5),"name"=>"Hà Nội","code"=>"MB","thu2"=>1,"thu3"=>0,"thu4"=>0,"thu5"=>1,"thu6"=>0,"thu7"=>0,"thu8"=>0),
            2=>array("id"=>2,"live"=>array(3),"name"=>"Quảng Ninh","code"=>"MB","thu2"=>0,"thu3"=>1,"thu4"=>0,"thu5"=>0,"thu6"=>0,"thu7"=>0,"thu8"=>0),
            3=>array("id"=>3,"live"=>array(4),"name"=>"Bắc Ninh","code"=>"MB","thu2"=>0,"thu3"=>0,"thu4"=>1,"thu5"=>0,"thu6"=>0,"thu7"=>0,"thu8"=>0),
            4=>array("id"=>4,"live"=>array(6),"name"=>"Hải Phòng","code"=>"MB","thu2"=>0,"thu3"=>0,"thu4"=>0,"thu5"=>0,"thu6"=>1,"thu7"=>0,"thu8"=>0),
            5=>array("id"=>5,"live"=>array(7),"name"=>"Nam Định","code"=>"MB","thu2"=>0,"thu3"=>0,"thu4"=>0,"thu5"=>0,"thu6"=>0,"thu7"=>1,"thu8"=>0),
            6=>array("id"=>6,"live"=>array(8),"name"=>"Thái Bình","code"=>"MB","thu2"=>0,"thu3"=>0,"thu4"=>0,"thu5"=>0,"thu6"=>0,"thu7"=>0,"thu8"=>1),
        );

        static public $wday = array(
            "thu-hai"=>2,
            "thu-ba"=>3,
            "thu-tu"=>4,
            "thu-nam"=>5,
            "thu-sau"=>6,
            "thu-bay"=>7,
            "chu-nhat"=>8,
        );  
        static public $label_mb = array(
            2=>"Hà Nội",
            3=>"Quảng Ninh",
            4=>"Bắc Ninh",
            5=>"Hà Nội",
            6=>"Hải Phòng",
            7=>"Nam Định",
            8=>"Thái Bình",
        );

        static public $weekday_back = array(
            2=>1,3=>2,4=>3,5=>4,6=>5,7=>6,8=>0
        );
        static public $weekday = array(
            0=>8,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7
        );

        static public $weekday_mysql = array(
            2=>0,3=>1,4=>2,5=>3,6=>4,7=>5,8=>6
        );

        static public $result_mb = array(
            "giai_bay_1" => "","giai_bay_2" => "","giai_bay_3" => "","giai_bay_4" => "",
            "giai_sau_1" => "","giai_sau_2" => "","giai_sau_3" => "",
            "giai_nam_1" => "","giai_nam_2" => "","giai_nam_3" => "","giai_nam_4" => "","giai_nam_5" => "","giai_nam_6" => "",
            "giai_tu_1" => "","giai_tu_2" => "","giai_tu_3" => "","giai_tu_4" => "",
            "giai_ba_1" => "","giai_ba_2" => "","giai_ba_3" => "","giai_ba_4" => "","giai_ba_5" => "","giai_ba_6" => "",
            "giai_nhi_1" => "","giai_nhi_2" => "",
            "giai_nhat" => "","giai_dacbiet" => ""
        );

        static public $result_mn = array(
            "giai_tam" => "","giai_bay" => "","giai_sau_1" => "","giai_sau_2" => "","giai_sau_3" => "","giai_nam" => "",
            "giai_tu_1" => "","giai_tu_2" => "","giai_tu_3" => "","giai_tu_4" => "","giai_tu_5" => "",
            "giai_tu_6" => "","giai_tu_7" => "","giai_ba_1" => "","giai_ba_2" => "","giai_nhi" => "","giai_nhat" => "",
            "giai_dacbiet" => ""
        );

        static public $result_mt = array(
            "giai_tam" => "","giai_bay" => "","giai_sau_1" => "","giai_sau_2" => "","giai_sau_3" => "","giai_nam" => "",
            "giai_tu_1" => "","giai_tu_2" => "","giai_tu_3" => "","giai_tu_4" => "","giai_tu_5" => "",
            "giai_tu_6" => "","giai_tu_7" => "","giai_ba_1" => "","giai_ba_2" => "","giai_nhi" => "","giai_nhat" => "",
            "giai_dacbiet" => ""
        );

        static public $type_soicau = array(
            1=>"Cầu xuôi liên tục",
            2=>"Cầu xuôi cách 1 lần quay",
            3=>"Cầu xuôi cách 2 lần quay",
            4=>"Cầu xuôi cách 3 lần quay",
        );

        static public $positionResultMB = array(
            "giai_bay_1" => array(99,100),"giai_bay_2" => array(101,102),"giai_bay_3" => array(103,104),"giai_bay_4" =>array(105,106),
            "giai_sau_1" => array(90,92),"giai_sau_2" => array(93,95),"giai_sau_3" => array(96,98),
            "giai_nam_1" => array(66,69),"giai_nam_2" => array(70,73),"giai_nam_3" => array(74,77),
            "giai_nam_4" => array(78,81),"giai_nam_5" => array(82,85),"giai_nam_6" => array(86,89),
            "giai_tu_1" => array(50,53),"giai_tu_2" => array(54,57),"giai_tu_3" => array(58,61),"giai_tu_4" => array(62,65),
            "giai_ba_1" => array(20,24),"giai_ba_2" => array(25,29),"giai_ba_3" => array(30,34),
            "giai_ba_4" => array(35,39),"giai_ba_5" => array(40,44),"giai_ba_6" => array(45,49),
            "giai_nhi_1" => array(10,14),"giai_nhi_2" => array(15,19),
            "giai_nhat" => array(5,9),"giai_dacbiet" => array(0,4)
        );

        static public $positionResultMN = array(
            "giai_tam" =>array(80,81),"giai_bay" =>array(77,79),"giai_sau_1" =>array(65,68),"giai_sau_2" =>array(69,72),
            "giai_sau_3" =>array(73,76),"giai_nam" =>array(61,64),
            "giai_tu_1" =>array(26,30),"giai_tu_2" =>array(31,35),"giai_tu_3" =>array(36,40),"giai_tu_4" =>array(41,45),
            "giai_tu_5" =>array(46,50),
            "giai_tu_6" =>array(51,55),"giai_tu_7" =>array(56,60),"giai_ba_1" =>array(16,20),"giai_ba_2" =>array(21,25),
            "giai_nhi" =>array(11,15),"giai_nhat" =>array(6,10),
            "giai_dacbiet" =>array(0,5)
        );
        static public $positionResultMT = array(
            "giai_tam" =>array(80,81),"giai_bay" =>array(77,79),"giai_sau_1" =>array(65,68),"giai_sau_2" =>array(69,72),
            "giai_sau_3" =>array(73,76),"giai_nam" =>array(61,64),
            "giai_tu_1" =>array(26,30),"giai_tu_2" =>array(31,35),"giai_tu_3" =>array(36,40),"giai_tu_4" =>array(41,45),
            "giai_tu_5" =>array(46,50),
            "giai_tu_6" =>array(51,55),"giai_tu_7" =>array(56,60),"giai_ba_1" =>array(16,20),"giai_ba_2" =>array(21,25),
            "giai_nhi" =>array(11,15),"giai_nhat" =>array(6,10),
            "giai_dacbiet" =>array(0,5)
        );

        static public $capLoto = array(
            "01,10","02,20","03,30","04,40","05,50","06,60","07,70","08,80","09,90","11,88","12,21","13,31","14,41","15,51"
            ,"16,61","17,71","18,81","19,91","22,77","23,32","24,42","25,52","26,62","27,72","28,82","29,92","33,66","34,43"
            ,"35,53","36,63","37,73","38,83","39,93","44,55","45,54","46,64","47,74","48,84","49,94","56,65","57,75","58,85"
            ,"59,95","67,76","68,86","69,96","78,87","79,97","89,98","00,99"
        );

        static public $general_statitic = array(
            1=>"Thống kê tổng chẵn"
            ,2=>"Thống kê tổng lẻ"
            ,3=>"Thống kê bộ chẵn chẵn"
            ,4=>"Thống kê bộ lẻ lẻ"
            ,5=>"Thống kê bộ chẵn lẻ"
            ,6=>"Thống kê bộ lẻ chẵn"
            ,7=>"Thống kê bộ kép"
            ,8=>"Thống kê bộ sát kép"
            ,9=>"Thống kê theo đầu số"
            ,10=>"Thống kê theo đít số"
            ,11=>"Thống kê 15 số về nhiều nhất"
            ,12=>"Thống kê 15 số về ít nhất"
        );

        static public $earn_money_type      = array(
            1=>"Trúng Lo Game"
            ,2=>"Trúng Do Game"
            ,3=>"Trúng Xien Game"
            ,4=>"Nạp Sms"
            ,5=>"Nạp Card"            
            ,6=>"Nạp Charging"            
            ,7=>"Admin nạp"            
        );

        static public $spend_money_type      = array(
            1=>"Chơi Lo Game"
            ,2=>"Chơi Do Game"
            ,3=>"Chơi Xien Game"
            ,4=>"Mua Dịch Vụ Soi Cầu"
            ,5=>"Mua Dịch Vụ Nhận Kết Quả"
            ,6=>"Đổi Thưởng"      
            ,7=>"Admin trừ"      
        );

        static public $telco_card = array(
            "vinaphone"=>"VNP"
            ,"mobifone"=>"VMS"
            ,"viettel"=>"VTT"
            ,"fpt"=>"FPT"
            ,"vcoin"=>"VTC"
            ,"megacard"=>"MGC"
        );   

        /* lodo game*/
        static public $lodo_game = array(
            1=>"Lo Game",
            2=>"Do Game",
            3=>"Xiên Game",
        );

        static public $point_lo = array(
            1,2,5,10,20,40,50,60,80,100,200
        );
        static public $money_lo = 23000;

        static public $money_do = array(
            2000,5000,10000,20000,30000,50000,100000,200000,300000,500000
        );

        static public $embed_default = array(
            "bg_color"=>"#e35346","tit_color"=>"#fff","db_color"=>"#000000","width"=>"300px","fsize"=>"14px"
        );

        static public $type_product = array(
            1=>"Thẻ cào",2=>"Điện thoại"
        );

        static public $short_giai = array(
            "GDB"=>"giải đặc biệt",
            "G1"=>"giải nhất",
            "G2"=>"giải nhì",
            "G21"=>"giải nhì",
            "G22"=>"giải nhì",
            "G31"=>"giải ba",
            "G32"=>"giải ba",
            "G33"=>"giải ba",
            "G34"=>"giải ba",
            "G35"=>"giải ba",
            "G36"=>"giải ba",
            "G41"=>"giải tư",
            "G42"=>"giải tư",
            "G43"=>"giải tư",
            "G44"=>"giải tư",
            "G45"=>"giải tư",
            "G46"=>"giải tư",
            "G47"=>"giải tư",
            "G5"=>"giải năm",
            "G51"=>"giải năm",
            "G52"=>"giải năm",
            "G53"=>"giải năm",
            "G54"=>"giải năm",
            "G55"=>"giải năm",
            "G56"=>"giải năm",
            "G61"=>"giải sáu",
            "G62"=>"giải sáu",
            "G63"=>"giải sáu",
            "G7"=>"giải bảy",
            "G71"=>"giải bảy",
            "G72"=>"giải bảy",
            "G73"=>"giải bảy",
            "G74"=>"giải bảy",
            "G8"=>"giải tám",
        );

        static public $page_seo = array(
            "home-index"=>array("id"=>1,"title"=>"Trang chủ"),
            "home-mienbac"=>array("id"=>2,"title"=>"Trực tiếp kết quả miền bắc"),
            "home-mientrung"=>array("id"=>3,"title"=>"Trực tiếp kết quả miền trung"),
            "home-miennam"=>array("id"=>4,"title"=>"Trực tiếp kết quả miền nam"),
            "home-dientoan"=>array("id"=>5,"title"=>"Trang chủ điện toán"),
            "home-lastMienbac"=>array("id"=>6,"title"=>"Kết quả miền bắc hôm qua"),
            "home-lastMientrung"=>array("id"=>7,"title"=>"Kết quả miền trung hôm qua"),
            "home-lastMiennam"=>array("id"=>8,"title"=>"Kết quả miền nam hôm qua"),
            "home-calendar"=>array("id"=>9,"title"=>"Lịch quay kết quả"),
            "result-mienbac"=>array("id"=>10,"title"=>"Kết quả miền bắc theo tỉnh"),
            "result-mientrung"=>array("id"=>11,"title"=>"Kết quả miền trung theo tỉnh"),
            "result-miennam"=>array("id"=>12,"title"=>"Kết quả miền nam theo tỉnh"),
            "result-dientoan123"=>array("id"=>13,"title"=>"Kết quả điện toán 123"),
            "result-dientoan6x36"=>array("id"=>14,"title"=>"Kết quả điện toán 6x36"),
            "result-thantai"=>array("id"=>15,"title"=>"Kết quả điện toán thần tài"),
            "result-kqMienbac"=>array("id"=>16,"title"=>"Danh sách kết quả miền bắc"),
            "result-kqMientrung"=>array("id"=>17,"title"=>"Danh sách kết quả miền trung"),
            "result-kqMiennam"=>array("id"=>18,"title"=>"Danh sách kết quả miền nam"),
            "result-mienbacWday"=>array("id"=>19,"title"=>"Kết quả miền bắc theo thứ"),
            "result-mientrungWday"=>array("id"=>20,"title"=>"Kết quả miền trung theo thứ"),
            "result-miennamWday"=>array("id"=>21,"title"=>"Kết quả miền nam theo thứ"),
            "result-day"=>array("id"=>1,"title"=>"Kết quả 3 miền"),
            "statistic-chukyLoto"=>array("id"=>22,"title"=>"Thống kê chu kỳ loto"),
            "statistic-chukyDacbiet"=>array("id"=>23,"title"=>"Thống kê chu kỳ đặc biệt"),
            "statistic-chukyXien"=>array("id"=>24,"title"=>"Thống kê chu kỳ xiên"),
            "statistic-lotoGan"=>array("id"=>25,"title"=>"Thống kê loto gan"),
            "statistic-tansoNhipLoto"=>array("id"=>26,"title"=>"Thống kê tần số nhịp loto"),
            "statistic-dacbiet"=>array("id"=>27,"title"=>"Thống kê giải đặc biệt"),
            "statistic-tongBoso"=>array("id"=>28,"title"=>"Thống kê theo tổng"),
            "statistic-day"=>array("id"=>29,"title"=>"Thống kê theo ngày"),
            "statistic-tonghopDacbiet"=>array("id"=>30,"title"=>"Thống kê tổng hợp giải đặc biệt"),
            "statistic-dauduoiLoto"=>array("id"=>31,"title"=>"Thống kê đầu đuôi Loto"),
            "statistic-dauduoiDacbiet"=>array("id"=>32,"title"=>"Thống kê đầu đuôi đặc biệt"),
            "statistic-tansuatCapLoto"=>array("id"=>33,"title"=>"Thống kê tần suất cặp loto"),
            "statistic-tansuatLoto"=>array("id"=>34,"title"=>"Thống kê tần suất loto"),
            "statistic-tansuatBoso"=>array("id"=>35,"title"=>"Thống kê tần suất bộ số"),
            "statistic-nhanh"=>array("id"=>36,"title"=>"Thống kê nhanh"),
            "statistic-tonghop"=>array("id"=>37,"title"=>"Thống kê tổng hợp"),
            "soicau-index"=>array("id"=>38,"title"=>"Soi cầu loto"),
            "soicau-dacbiet"=>array("id"=>39,"title"=>"Soi cầu đặc biệt"),
            "soicau-hainhay"=>array("id"=>40,"title"=>"Soi cầu hai nháy"),
            "quayso-index"=>array("id"=>41,"title"=>"Quay thử"),
            "quayso-conso"=>array("id"=>42,"title"=>"Con số may mắn"),
            "video-index"=>array("id"=>43,"title"=>"Video clip"),
            "dreambook-index"=>array("id"=>44,"title"=>"Sổ mơ"),
            "news-index"=>array("id"=>45,"title"=>"Tin tức"),
            "tuvi-index"=>array("id"=>46,"title"=>"Tử vi"),
            "xemtuong-index"=>array("id"=>47,"title"=>"Xem tướng"),
            "bongda-live"=>array("id"=>48,"title"=>"Trực tiếp bóng đá"),
            "bongda-index"=>array("id"=>49,"title"=>"Danh mục bóng đá"),
        );

        static public $domain = array(
            0=>"ketquaveso.com",
            1=>"xoso999.com",
        );    

        static public $event_tuvi = array(
            1=>array("title"=>"Tử vi tuổi tý 2014","alias"=>"tu-vi-tuoi-ty","meta_title"=>"Tử vi tuổi tý năm 2014, Tử vi trọn đời tuổi tý nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi ty, tu vi tron doi tuoi ty, tu vi tuoi ty 2014 nam mang, tu vi tuoi ty 2014 nu mang, xem van han tuoi ty","meta_desc"=>"Tử vi tuổi tý năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm tý nữ mạng - nam mạng năm 2014 chính xác"),
            2=>array("title"=>"Tử vi tuổi sửu 2014","alias"=>"tu-vi-tuoi-suu","meta_title"=>"Tử vi tuổi sửu năm 2014, Tử vi trọn đời tuổi sửu nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi suu, tu vi tron doi tuoi suu, tu vi tuoi suu 2014 nam mang, tu vi tuoi suu 2014 nu mang, xem van han tuoi suu","meta_desc"=>"Tử vi tuổi sửu năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm sửu nữ mạng - nam mạng năm 2014 chính xác"),
            3=>array("title"=>"Tử vi tuổi dần 2014","alias"=>"tu-vi-tuoi-dan","meta_title"=>"Tử vi tuổi dần năm 2014, Tử vi trọn đời tuổi dần nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi dan, tu vi tron doi tuoi dan, tu vi tuoi dan 2014 nam mang, tu vi tuoi dan 2014 nu mang, xem van han tuoi dan","meta_desc"=>"Tử vi tuổi dần năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm dần nữ mạng - nam mạng năm 2014 chính xác"),
            4=>array("title"=>"Tử vi tuổi mão 2014","alias"=>"tu-vi-tuoi-mao","meta_title"=>"Tử vi tuổi mão năm 2014, Tử vi trọn đời tuổi mão nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi mao, tu vi tron doi tuoi mao, tu vi tuoi mao 2014 nam mang, tu vi tuoi mao 2014 nu mang, xem van han tuoi mao","meta_desc"=>"Tử vi tuổi mão năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm mão nữ mạng - nam mạng năm 2014 chính xác"),
            5=>array("title"=>"Tử vi tuổi thìn 2014","alias"=>"tu-vi-tuoi-thin","meta_title"=>"Tử vi tuổi thìn năm 2014, Tử vi trọn đời tuổi thìn nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi thin, tu vi tron doi tuoi thin, tu vi tuoi thin 2014 nam mang, tu vi tuoi thin 2014 nu mang, xem van han tuoi thin","meta_desc"=>"Tử vi tuổi thìn năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm thìn nữ mạng - nam mạng năm 2014 chính xác"),
            6=>array("title"=>"Tử vi tuổi tỵ 2014","alias"=>"tu-vi-tuoi-ty","meta_title"=>"Tử vi tuổi tỵ năm 2014, Tử vi trọn đời tuổi tỵ nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi ty, tu vi tron doi tuoi ty, tu vi tuoi ty 2014 nam mang, tu vi tuoi ty 2014 nu mang, xem van han tuoi ty","meta_desc"=>"Tử vi tuổi tỵ năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm tỵ nữ mạng - nam mạng năm 2014 chính xác"),
            7=>array("title"=>"Tử vi tuổi ngọ 2014","alias"=>"tu-vi-tuoi-ngo","meta_title"=>"Tử vi tuổi ngọ năm 2014, Tử vi trọn đời tuổi ngọ nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi ngo, tu vi tron doi tuoi ngo, tu vi tuoi ngo 2014 nam mang, tu vi tuoi ngo 2014 nu mang, xem van han tuoi ngo","meta_desc"=>"Tử vi tuổi ngọ năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm ngọ nữ mạng - nam mạng năm 2014 chính xác"),
            8=>array("title"=>"Tử vi tuổi mùi 2014","alias"=>"tu-vi-tuoi-mui","meta_title"=>"Tử vi tuổi mùi năm 2014, Tử vi trọn đời tuổi mùi nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi mui, tu vi tron doi tuoi mui, tu vi tuoi mui 2014 nam mang, tu vi tuoi mui 2014 nu mang, xem van han tuoi mui","meta_desc"=>"Tử vi tuổi mùi năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm mùi nữ mạng - nam mạng năm 2014 chính xác"),
            9=>array("title"=>"Tử vi tuổi thân 2014","alias"=>"tu-vi-tuoi-than","meta_title"=>"Tử vi tuổi thân năm 2014, Tử vi trọn đời tuổi thân nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi than, tu vi tron doi tuoi than, tu vi tuoi than 2014 nam mang, tu vi tuoi than 2014 nu mang, xem van han tuoi than","meta_desc"=>"Tử vi tuổi thân năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm thân nữ mạng - nam mạng năm 2014 chính xác"),
            10=>array("title"=>"Tử vi tuổi dậu 2014","alias"=>"tu-vi-tuoi-dau","meta_title"=>"Tử vi tuổi dậu năm 2014, Tử vi trọn đời tuổi dậu nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi dau, tu vi tron doi tuoi dau, tu vi tuoi dau 2014 nam mang, tu vi tuoi dau 2014 nu mang, xem van han tuoi dau","meta_desc"=>"Tử vi tuổi dậu năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm dậu nữ mạng - nam mạng năm 2014 chính xác"),
            11=>array("title"=>"Tử vi tuổi tuất 2014","alias"=>"tu-vi-tuoi-tuat","meta_title"=>"Tử vi tuổi tuất năm 2014, Tử vi trọn đời tuổi tuất nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi tuat, tu vi tron doi tuoi tuat, tu vi tuoi tuat 2014 nam mang, tu vi tuoi tuat 2014 nu mang, xem van han tuoi tuat","meta_desc"=>"Tử vi tuổi tuất năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm tuất nữ mạng - nam mạng năm 2014 chính xác"),
            12=>array("title"=>"Tử vi tuổi hợi 2014","alias"=>"tu-vi-tuoi-hoi","meta_title"=>"Tử vi tuổi hợi năm 2014, Tử vi trọn đời tuổi hợi nam mạng - nữ mạng","meta_keyword"=>"tu vi tuoi hoi, tu vi tron doi tuoi hoi, tu vi tuoi hoi 2014 nam mang, tu vi tuoi hoi 2014 nu mang, xem van han tuoi hoi","meta_desc"=>"Tử vi tuổi hợi năm 2014. Xem tử vi trọn đời, vận hạn, kiêng kỵ, cưới hỏi, tuổi làm nhà của người sinh năm hợi nữ mạng - nam mạng năm 2014 chính xác"),
            13=>array("title"=>"Đặt tên cho con 2014","alias"=>"dat-ten-cho-con","meta_title"=>"Đặt tên cho con năm 2014 giáp ngọ, Đặt tên cho con trai con gái 2014","meta_keyword"=>"dat ten cho con trai, dat ten cho con gai, ten hay, ten hop tuoi bo me","meta_desc"=>"Đặt tên cho con năm 2014 giáp ngọ. Tư vấn đặt tên cho con trai con gái hợp mệnh, hợp tuổi bố mẹ, Tên hay cho bé."),
        );

        static public $event_news = array(
            3=>array("title"=>"Lời chúc hay nhất","alias"=>"loi-chuc-hay-nhat","meta_title"=>"Lời chúc hay nhất - Lời chúc ý nghĩa nhất - Tin nhắn tình yêu","meta_keyword"=>"loi chuc hay nhat, loi chuc y nghia nhat, loi chuc ngu ngon, loi chuc buoi sang, tin nhan hay, tin nhan yeu thuong","meta_desc"=>"Lời chúc sinh nhật hay nhất, lời chúc ngủ ngon, chúc buổi sáng, chúc mừng các ngày lễ trong năm tặng bạn bè, người yêu thương ý nghĩa nhất. Tin nhắn yêu thương"),
            1=>array("title"=>"Tết nguyên đán 2014","alias"=>"tet-nguyen-dan-2014","meta_title"=>"Lời chúc tết 2014, sms chúc mừng năm mới 2014, Tết 2014","meta_keyword"=>"sms chuc tet, loi chuc tet 2014, tin nhan chuc mung nam moi 2014","meta_desc"=>"Lời chúc tết 2014 hay nhất. Tổng hợp lời chúc tết tặng ông bà bố mẹ ý nghĩa, tin nhắn chúc mừng năm mới độc đáo"),
            2=>array("title"=>"Lời chúc valentine 2014","alias"=>"loi-chuc-valentine-2014","meta_title"=>"Lời chúc valentine hay nhất, sms valentine tặng người yêu","meta_keyword"=>"valentine 2014, loi chuc valentine, tin nhan valentine, sms valentine","meta_desc"=>"Lời chúc valentine 2014 hay nhất. Tổng hợp những lời chúc valentine ý nghĩa ngọt ngào gửi tặng bạn gái, người yêu. Sms valentine độc đáo"),
        );

        static public $symbol = array(
            0=>':(('
            , 1=>':('     
            , 2=>':))'     
            , 3=>'/:)'     
            , 4=>':)]'     
            , 5=>'&lt;):)'     
            , 6=>'&gt;:)'     
            , 7=>':)'
            , 8=>'&gt;:D&lt;'
            , 9=>':D'
            , 10=>';;)'
            , 11=>';)'
            , 12=>'#:-S'
            , 13=>':-S'
            , 14=>'&gt;:P'
            , 15=>':P'
            , 16=>':-/'
            , 17=>':x'
            , 18=>':"&gt;'
            , 19=>'=(('
            , 20=>':-SS'
            , 21=>'&lt;:-P'
            , 22=>':-bd'
            , 23=>'^#(^'
            , 24=>':-*'
            , 25=>':-O'
            , 26=>'B-)'
            , 27=>':>'
            , 28=>'~X('
            , 29=>'X('
            , 30=>':|'
            , 31=>'=))'
            , 32=>'O:-)'
            , 33=>':-B'
            , 34=>'=;'
            , 35=>':-c'
            , 36=>':-h'
            , 37=>':-t'
            , 38=>'8-&gt;'
            , 39=>'I-)'
            , 40=>'8-|'
            , 41=>'L-)'
            , 42=>':-&'
            , 43=>':-$'
            , 44=>'[-('
            , 45=>':O)'
            , 46=>'8-}'
            , 47=>'(:|'
            , 48=>'=P~'
            , 49=>':-?'
            , 50=>'#-o'
            , 51=>'=D&gt;'
            , 52=>'@-)'
            , 53=>':^o'
            , 54=>':-w'
            , 55=>':-&lt;'
            , 56=>'X_X'
            , 57=>':!!'
            , 58=>'\m/'
            , 59=>':-q'
            , 60=>':ar!'
        );     

    }

