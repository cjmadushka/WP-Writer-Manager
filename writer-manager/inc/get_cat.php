<?php 
function category_solve($catid){
    $cat=get_category($catid);
    $catd=[];
    $catd['id']=$catid;
    $catd['cat_count']=$cat->category_count;
    $catd['cat_url']=get_category_link($catid);
    return $catd;
}


function collect_writer_data($post_id){
    $writer=[];
    $c=get_the_category($post_id);
    $writer['id']=$post_id;
    $writer['name']=get_the_title($post_id);
    $writer['fb_link']=get_field('facebook_link',$post_id);
    $writer['profile']=wp_get_attachment_image_src(get_field('profile',$post_id),'thumbnail');
    if($c[0]->term_id){$writer['category']=category_solve($c[0]->term_id);}else{
        $catd=[];
        $catd['id']='';
        $catd['cat_count']='';
        $catd['cat_url']='';
        $writer['category']=$catd;
    }
    return $writer;
}
?>