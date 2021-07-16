<?php
function  wr_license_func(){
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    if ( isset( $_GET['settings-updated'] ) ) {

        add_settings_error( 'wrl_messages', 'wrl_message', __( 'Settings Saved', 'wrl' ), 'updated' );
    }
 
    settings_errors( 'wrl_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'wrl' );
            do_settings_sections( 'wrl' );
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

function wrl_settings_init() {
    register_setting( 'wrl', 'wrl_license' );
    add_settings_section(
        'wrl_section_developers',
        __( 'Writer Manager License', 'wrl' ), 'wrl_section_developers_callback',
        'wrl'
    );
    add_settings_field(
        'wrl_field_pill', 
            __( 'License Key', 'wrl' ),
        'wrl_field_pill_cb',
        'wrl',
        'wrl_section_developers',
        array(
            'label_for'         => 'wrl_field_pill',
            'class'             => 'wrl_row',
            'wrl_custom_data' => 'custom',
        )
    );
}
 

add_action( 'admin_init', 'wrl_settings_init' );
 
function wrl_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Enter Your License Key', 'wrl' ); ?></p>
    <?php
}
 
function wrl_field_pill_cb( $args ) {

    $setting = get_option( 'wrl_license' );
    ?>
    <input type="text" name="wrl_license" id="wm_bc_img" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

function activated(){
    $key=get_option( 'wrl_license');
    if(strval($key)=='cjmadushka'){
        return true;
    }else{
        return false;
    }
}

?>