<?php

/**
 * Plugin Name:       Write Manager
 * Plugin URI:        https://www.facebook.com/cjmadushka2
 * Description:       Manage your writing panel.
 * Version:           1.0
 * Author:            CJ Madushka
 * Author URI:        https://www.facebook.com/cjmadushka2
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       writer-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
include plugin_dir_path( __FILE__ ).'/inc/admin_page.php';
include plugin_dir_path( __FILE__ ).'/inc/writer_post_type.php';
include plugin_dir_path( __FILE__ ).'/inc/init.php';
include plugin_dir_path( __FILE__ ).'/inc/ajax.php';
include plugin_dir_path( __FILE__ ).'/inc/frontend.php';
add_action( 'admin_enqueue_scripts',  'enqueue_scripts'  );
function enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script(
			'frontend-cj-script',
			plugins_url( '/', __FILE__ ) . 'js/frontend.js',
			array( 'jquery' ),
			'2015-05-07'
		);
	}
	



    








?>