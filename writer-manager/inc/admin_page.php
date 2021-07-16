<?php
include plugin_dir_path( __FILE__ ).'/get_cat.php';
include plugin_dir_path( __FILE__ ).'admin/admin.php';
include plugin_dir_path( __FILE__ ).'/admin/setting.php';
include plugin_dir_path( __FILE__ ).'/admin/license.php';
include plugin_dir_path( __FILE__ ).'/admin/deactive.php';
add_action('admin_menu', 'writer_Admin_page');
function writer_Admin_page(){
    add_menu_page( 'Writer Manager', 'Writer Manager', 'manage_options', 'writer-manager', 'admin_page' ,'dashicons-edit-large',5);
    add_submenu_page('writer-manager','Settings', 'Settings','edit_themes', 'wr_setting','wr_setting' );
    add_submenu_page('writer-manager','License', 'License','edit_themes', 'wr_license','wr_license' );
}

function wr_setting(){
     if(activated()){
     wr_setting_func();
}else{
    deactivated();
}
}
function wr_license(){
    wr_license_func();
}

function admin_page(){
    if(activated()){
    admin_page_func();
}else{
    deactivated();
}
    
    
}


?>
