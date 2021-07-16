<?php
function writers(){
    	register_post_type('writers', array(
            'support' => array('title','thumbnail'),
            'taxonomies'  => array( 'category' ),
		    'public' => true,
		    'labels' => array(
			    'name' => 'Writer',
                'add_new_item' => 'Add New Writers',
                'edit_item' => 'Edit Writers',
                'all_items' => 'All Writers',
                'single_name' => 'Writer'
		),
		    'menu_icon' => 'dashicons-edit-large',
	));
}
add_action('init', 'writers');
add_post_type_support( 'writer', 'thumbnail' );
?>