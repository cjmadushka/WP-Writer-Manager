<?php
function wr_setting_func(){
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    if ( isset( $_GET['settings-updated'] ) ) {

        add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
    }
 
    settings_errors( 'wporg_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'wporg' );
            do_settings_sections( 'wporg' );
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

function wporg_settings_init() {
    register_setting( 'wporg', 'wporg_options' );
    add_settings_section(
        'wporg_section_developers',
        __( 'Writer Manager Settings', 'wporg' ), 'wporg_section_developers_callback',
        'wporg'
    );
    add_settings_field(
        'wporg_field_pill', 
            __( 'Profile Background Image', 'wporg' ),
        'wporg_field_pill_cb',
        'wporg',
        'wporg_section_developers',
        array(
            'label_for'         => 'wporg_field_pill',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        )
    );
}
 

add_action( 'admin_init', 'wporg_settings_init' );
 
function wporg_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Select Image For Profile Backdrop', 'wporg' ); ?></p>
    <?php
}
 
function wporg_field_pill_cb( $args ) {

    $setting = get_option( 'wporg_options' );
    ?>
    <input type="hidden" name="wporg_options" id="wm_bc_img" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
    echo frontend_medias();
    wm_stting_script();
}
 
function frontend_medias() {

	if ( current_user_can( 'upload_files' ) ) {
		$str = __( 'Select Cover Image', 'frontend-media' );
		return '<input id="frontend-btn" type="button" value="' . $str . '" class="button" style="position: relative; z-index: 1;"><img style="position: relative;display: block;padding-top: 30px;" width="300"  id="frontend-img" />';
	}

	return __( 'Please Login To Upload', 'frontend-media' );
}
function wm_stting_script(){
    ?><script>
    jQuery(document).ready( function() {
	var file_frame; 
	var imgsrc=jQuery( '#wm_bc_img' ).val();
	jQuery( '#frontend-img' ).attr('src', imgsrc);

	jQuery( '#frontend-btn' ).on( 'click', function( event ) {
		event.preventDefault();
		if ( file_frame ) {
			file_frame.open();
			return;
		} 

		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false 
		});

		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();
			jQuery( '#frontend-btn' ).hide();
			jQuery( '#frontend-img' ).attr('src', attachment.url);
			jQuery( '#wm_bc_img' ).val(attachment.url);
		});

		file_frame.open();
	});
    });
    
    </script>
    <?php
    
}



?>