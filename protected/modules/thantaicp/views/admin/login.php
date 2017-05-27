<div class="admin">
    <div class="title-admin">
        <b>Đăng nhập quản trị</b>
    </div>
    <div class="admin-cont clearfix">
    <?php echo CHtml::beginForm()?>
        <label style="color: red; text-align: center;"><?php echo CHtml::errorSummary($model,"&nbsp;")?></label>
        <ul class="form">
            <li class="clearfix"><label>Tên đăng nhập:</label>
                <div class="filltext clearfix">
                    <p><?php echo CHtml::activeTextField($model,"username",array("class"=>"input1"));?>

                    </p>
                </div>
            </li>
            <li class="clearfix"><label>Mật khẩu</label>
                <div class="filltext clearfix">
                    <p>
                    <?php echo CHtml::activePasswordField($model,"password",array("class"=>"input1"));?>
                    </p>
                    <p>

                    <?php echo CHtml::activeCheckBox($model,"remember")?>
                    Nhớ mật khẩu</p>
                    <p><input type="submit" value="Đăng nhập"/></p>
                </div>
            </li>
        </ul>
    <?php echo CHtml::endForm();?>
    </div>
</div>