<?php
include plugin_dir_path( __FILE__ ).'/get_cat.php';
include plugin_dir_path( __FILE__ ).'admin/admin.php';
include plugin_dir_path( __FILE__ ).'/admin/setting.php';
add_action('admin_menu', 'writer_Admin_page');
function writer_Admin_page(){
    add_menu_page( 'Writer Manager', 'Writer Manager', 'manage_options', 'writer-manager', 'admin_page' ,'dashicons-edit-large',5);
    add_submenu_page('writer-manager','Settings', 'Settings','edit_themes', 'wr_setting','wr_setting' );
}

function wr_setting(){
    wr_setting_func();
}

function admin_page(){
    admin_page_func();
}
    



?>