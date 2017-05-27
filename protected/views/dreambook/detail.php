
<div class="col-l">
    <div class="box-dream box">    
        <h1 class="title-bor mag0"><strong><?php echo $data["title_long"]?></strong></h1>
        <div class="search-dream bg_f9">   
            <div class="box-search clearfix">
                <form method="GET" action="<?php echo Url::createUrl("dreambook/index")?>">
                    <div class="bor-1 fl"><input name="tukhoa" type="search" value="<?php echo $tukhoa !="" ? $tukhoa : ''?>"></div>
                    <button class="fl" type="submit"><strong>Tìm kiếm</strong></button>
                </form>
            </div>
            <div class="cl9 mag-l5">Tìm với từ bắt đầu:</div>
            <ul class="list-charter txt-center">
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ a" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"a"))?>"><strong>A</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ b" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"b"))?>"><strong>B</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ c" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"c"))?>"><strong>C</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ d" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"d"))?>"><strong>D</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ e" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"e"))?>"><strong>E</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ f" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"f"))?>"><strong>F</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ g" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"g"))?>"><strong>G</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ h" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"h"))?>"><strong>H</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ i" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"i"))?>"><strong>I</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ j" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"j"))?>"><strong>J</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ k" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"k"))?>"><strong>K</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ l" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"l"))?>"><strong>L</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ m" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"m"))?>"><strong>M</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ m" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"n"))?>"><strong>N</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ o" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"o"))?>"><strong>O</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ p" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"p"))?>"><strong>P</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ q" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"q"))?>"><strong>Q</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ r" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"r"))?>"><strong>R</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ s" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"s"))?>"><strong>S</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ t" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"t"))?>"><strong>T</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ u" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"u"))?>"><strong>U</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ v" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"v"))?>"><strong>V</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ x" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"x"))?>"><strong>X</strong></a></li>
                <li class="in-block"><a title="Sổ mơ bắt đầu với từ y" href="<?php echo Url::createUrl("dreambook/index",array("first_word"=>"y"))?>"><strong>Y</strong></a></li>
            </ul>
            <div class="table-dream">
                <ul class="gr-yellow txt-center">
                    <li class="percent-50"><strong>Bạn mơ thấy gì</strong></li>
                    <li class="percent-50"><strong>Cặp số tương ứng</strong></li>
                </ul>
                <ul class="list-dream">
                    <li class="txt-center nobor">

                        <div class="in-block text-dream percent-50"><strong class="clred s18"><?php echo $data["title"]?></strong></div>
                        <div class="in-block num-dream percent-50"><strong class="cl-green s18"><?php echo $data["result"]?></strong></div>
                    </li>

                </ul>
                <div class="cont-dream pad10-5">
                    <p class="mag0"><?php echo $data["content"]?></p>
                </div>

            </div>
        </div>
    </div>
    <?php $this->renderPartial("application.views.layouts.adsend",array("position"=>"top"))?>
    <div class="box sugges-dream">
        <h2 class="title-bor s18">Gợi ý mơ thấy</h2>
        <ul>
            <?php 
                foreach($data_other as $value){
                    if($value["id"] !=$data["id"]){
                        $link_detail = Url::createUrl("dreambook/detail",array("alias"=>$value["alias"],"did"=>$value["id"]));
                    ?>
                    <li>
                        <label class="percent-50 in-block">
                            <a href="<?php echo $link_detail;?>" title="<?php echo $value["title"]?>"><strong class="clred"><?php echo $value["title"]?></strong></a>
                        </label>
                        <div class="in-block"><strong class="cl-green"><?php echo $value["result"]?></strong></div>
                    </li>
                    <?php }
            }?>
        </ul>
    </div>  
    <div id="load_comment">
        <?php $this->renderPartial("application.views.comment.load_comment",array("table"=>"dream_book_comment","comment"=>$comment,"reply"=>$reply,"content_id"=>$data["id"]))?>
    </div>
    </div>