<?php

add_action( 'admin_footer', 'ajax_submit' );

function ajax_submit() { ?>
	<script type="text/javascript" >


	jQuery('#add_new_cat').click(function(event) {
    event.preventDefault();
    var cat=jQuery('#cat_new_submit').val();
    jQuery.ajax(ajaxurl, {
        type: 'POST',
        data: {
            action: "new_category",
            name: cat,
        },
        success: function(res) {
            var response = JSON.parse(res.data)
            console.log(response);
            var preap="<option value='"+response.cat_id.toString() +"'>"+response.name+"</option>"
            jQuery('#writer_cat').prepend(preap);
            jQuery('#myModal2').hide();
            jQuery("#writer_cat").val(response.cat_id);
            console.log(preap);
        },
        error: function(err) {}
    })
});


    jQuery('#add_new').click(function(event) {
    event.preventDefault();
    var name=jQuery('#n_name').val();
    var fb_link=jQuery('#n_link').val();
    var cat=jQuery('#writer_cat').val();
    var image=attachment['id'];
    console.log(name,fb_link,cat,image);
    jQuery.ajax(ajaxurl, {
        type: 'POST',
        data: {
            action: "new_writer",
            name: name,
            fb_link: fb_link,
            cat: cat,
            image: image,
        },
        success: function(res) {
            var response = JSON.parse(res.data)
            jQuery('#myModal').remove();
            location.reload();
            
            
        },
        error: function(err) {}
    })
});
var post_id;
jQuery(".a_update").click(function(){
     var id = this.id;
     console.log(id);
     jQuery.ajax(ajaxurl, {
        type: 'POST',
        data: {
            action: "get_writer",
            post_id: id,
            },
        success: function(res) {
            var response = JSON.parse(res.data)
            console.log(response);
            jQuery("#u_name").val(response.name);
            jQuery("#u_link").val(response.fb_link);
            jQuery("#u_writer_cat").val(response.category.id);
            document.getElementById("myModal3").style.display = "block";
            post_id=response.id;
            //location.reload();
            
            
        },
        error: function(err) {}
    })
});


 jQuery('#update').click(function(event) {
    event.preventDefault();
    var name=jQuery('#u_name').val();
    var fb_link=jQuery('#u_link').val();
    var cat=jQuery('#u_writer_cat').val();
    var image=attachment['id'];
    console.log(post_id,name,fb_link,cat,image);
    jQuery.ajax(ajaxurl, {
        type: 'POST',
        data: {
            action: "update_writer",
            post_id: post_id,
            name: name,
            fb_link: fb_link,
            cat: cat,
            image: image
        },
        success: function(res) {
            var response = JSON.parse(res.data)
            console.log(response);
            jQuery('#myModa3').remove();
            location.reload();
            
            
        },
        error: function(err) {}
    })
});


 jQuery('#delete').click(function(event) {
    event.preventDefault();
    var id=jQuery('#delete').data("pid");
    jQuery.ajax(ajaxurl, {
        type: 'POST',
        data: {
            action: "delete_writer",
            post_id: id
        },
        success: function(res) {
            var response = JSON.parse(res.data)
            console.log(response);
            jQuery('#myModa3').remove();
            location.reload();
            
            
        },
        error: function(err) {}
    })
});
	</script> <?php
}

add_action( 'wp_ajax_new_category', 'add_new_category' );
add_action( 'wp_ajax_new_writer', 'add_new_writer' );
add_action( 'wp_ajax_get_writer', 'get_writer' );
add_action( 'wp_ajax_update_writer', 'update_writer' );
add_action( 'wp_ajax_delete_writer', 'delete_writer' );

function add_new_category() {
    $cat=[''];
    $category_name=$_POST['name'];
    $wpdocs_cat = array('cat_name' => $category_name, 'category_nicename' => sanitize_title($category_name), 'category_parent' => '48');
    $cat['cat_id']= wp_insert_category($wpdocs_cat);
    $cat['name']=get_cat_name($cat['cat_id']);
    wp_send_json_success(json_encode($cat));
	wp_die(); // this is required to terminate immediately and return a proper response
}


function add_new_writer(){
    $name=$_POST['name'];
    $fb_link=$_POST['fb_link'];
    $cat=$_POST['cat'];
    $image=$_POST['image'];
    $post_id=publish_writer_post($name,$cat);
    update_writer_field($post_id,$cat,$fb_link,$image);
    //wp_set_post_categories( $post_id, array( intval($cat) ) );
    wp_send_json_success(json_encode('success'));
}


function publish_writer_post($name,$cat){
        $postarr=array(
        'post_title'    => wp_strip_all_tags($name),
        'post_status'   => 'publish',
        'post_type'     => 'writers',
        'post_category' => array(intval($cat))
        );
        
        $post_id=wp_insert_post($postarr);
        if($post_id){
            return $post_id;
        }
        
    }

function update_writer_field($post_id,$cat,$fb,$image){
    update_field('facebook_link',$fb,$post_id);
    update_field('profile',$image,$post_id);
    update_field('catagory',$cat,$post_id);
    return true;
}
function get_writer(){
    $post_id=$_POST['post_id'];
    $writer_data=collect_writer_data($post_id);
    wp_send_json_success(json_encode($writer_data));
}

function update_writer(){
    $post_id=$_POST['post_id'];
    $name=$_POST['name'];
    $cat=$_POST['cat'];
    $fb_link=$_POST['fb_link'];
    $image=$_POST['image'];
    
    $updatePost = array(   
        'ID' => $post_id, // wordpress Id
        'post_title'    => $name, // Updated title
        'post_type' => 'writers',
        'post_status'   => 'publish',
        'post_category' => array(intval($cat))
    );

    $upd=wp_update_post($updatePost);
    $up=update_writer_field($post_id,$cat,$fb_link,$image);
    $update=[$upd,$up];
    wp_send_json_success(json_encode('success'));
}

function delete_writer(){
    $post_id=intval($_POST['post_id']);
    wp_delete_post( $post_id, true );
    wp_send_json_success(json_encode('success'));
}

?>

