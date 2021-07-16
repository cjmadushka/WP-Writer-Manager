<?php 


add_action( 'init', 'init' );
add_action( 'admin_init', 'wpdocs_remove_menus' );
function init() {
	load_plugin_textdomain(
		'writer-manager',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        
        
        
        add_shortcode('front_form', 'frontend_shortcode');
	    add_action('init', 'acf_reg_plugin', 20);
}

function wpdocs_remove_menus(){
remove_menu_page('edit.php?post_type=writers');
remove_menu_page('edit.php?post_type=acf-field-group');
}
 function acf_reg_plugin(){
     if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60e7422c83a2f',
	'title' => 'Writer Manager',
	'fields' => array(
		array(
			'key' => 'field_60e742a5d0321',
			'label' => 'Catagory',
			'name' => 'catagory',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'category',
			'field_type' => 'select',
			'allow_null' => 0,
			'add_term' => 1,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'id',
			'multiple' => 0,
		),
		array(
			'key' => 'field_60e74317d0322',
			'label' => 'Facebook Link',
			'name' => 'facebook_link',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_60e744662db76',
			'label' => 'profile',
			'name' => 'profile',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'writers',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'permalink',
		1 => 'the_content',
		2 => 'excerpt',
		3 => 'discussion',
		4 => 'comments',
		5 => 'revisions',
		6 => 'slug',
		7 => 'author',
		8 => 'format',
		9 => 'page_attributes',
		10 => 'featured_image',
		11 => 'tags',
		12 => 'send-trackbacks',
	),
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_60e743f1d0b70',
	'title' => 'Writer Post Selector',
	'fields' => array(
		array(
			'key' => 'field_60e743fdb0d03',
			'label' => 'Writer',
			'name' => 'writer',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'writers',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
 }


?>