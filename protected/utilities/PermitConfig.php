<?php
class PermitConfig{  
    public static $permission = array(
        "can_view"=>1,
        "can_create"=>2,
        "can_edit"=>4,
        "can_del"=>8,
    );
    public static $permission_module = array(
        1=>array("label"=>"QL Danh mục","value"=>"category"),

    );
    
    public static $category = array(
        "can_view"=>array("index"),
        "can_create"=>array("create","ajaxSaveCategory"),
        "can_edit"=>array("ajaxQuickUpdate","edit","ajaxUpdate"),
        "can_del"=>array("ajaxDelete"),
    );
    
}
    
