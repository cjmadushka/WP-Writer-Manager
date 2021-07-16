<?php 
include plugin_dir_path( __FILE__ ).'/popup.php';
include plugin_dir_path( __FILE__ ).'/navigation.php';
function admin_page_func(){
   $paged = 1;
   if(isset($_GET['paged'])){
       $paged=intval($_GET['paged']);
   }else{
       $paged=1;
   }
    $args = array(
        'post_type' => 'writers',
        'post_status' => 'publish',
        'posts_per_page' => '10',
        'paged' => $paged,
    );
    $blog_posts = new WP_Query( $args );
    $pages=$blog_posts->max_num_pages;
    

?>
<div style="height:20px;"></div>
<div class="W_head">
<span style="font-size: 2rem;font-weight: 600;">Writers Manager</span>
<span style="margin: 2rem;"><span id="new" class="a_new btn btn-3">Add New</span></span>
</div>
<div style="height:20px;"></div>
<table width="100%" id="tabwriter" class="blueTable">
   <thead>
      <tr>
         <th>Profile</th>
         <th>Name</th>
         <th>Catagory</th>
         <th>Post Count</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tfoot>
      <tr>
         <td colspan="5">
            <?php navigation($pages,$paged); ?>
         </td>
      </tr>
   </tfoot>
   <tbody id="wrtbody">
        <tr>
            <?php if ( $blog_posts->have_posts() ) : 
            while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                $post_id = get_the_ID();
                writer_table_content($post_id);
            endwhile;
            endif; 
            ?>
      </tr>
   </tbody>
</table>
<style>html {
  scroll-behavior: smooth;
}table.blueTable{border:1px solid #1c6ea4;background-color:#eee;width:100%;text-align:left;border-collapse:collapse}.btn{color:#fff;cursor:pointer;font-size:2rem;font-weight:400;line-height:45px;margin:0 0 2em;max-width:160px;position:relative;text-decoration:none;text-transform:uppercase;width:100%}.btn-3{background:#3a9de3;border:1px solid #1f8cda;box-shadow:0 2px 0 #1f8cda,2px 4px 6px #2492e0;font-weight:900;letter-spacing:1px;transition:all 150ms linear}.actionclass{text-align:center}.btn-4{background:#e3403a;border:1px solid #da251f;box-shadow:0 2px 0 #d6251f,2px 4px 6px #e02a24;font-weight:900;letter-spacing:1px;transition:all 150ms linear}.btn-3:hover{background:#2679e0;border:1px solid rgba(0,0,0,.05);box-shadow:1px 1px 2px rgb(255 255 255 / 20%);color:#7dc8ec;text-decoration:none;text-shadow:-1px -1px 0 #1c6ec2;transition:all 250ms linear}.btn-4:hover{background:#e02c26;border:1px solid rgba(0,0,0,.05);box-shadow:1px 1px 2px rgb(255 255 255 / 20%);color:#ec817d;text-decoration:none;text-shadow:-1px -1px 0 #c2211c;transition:all 250ms linear}img.profile{border-radius:100%;border:solid 3px #3e84b2;position:relative;left:50%;transform:translateX(-50%)}.name{text-align:center;font-size:2rem;font-weight:900}.countpost{text-align:center;font-size:2rem;font-weight:900;text-decoration:none}.cat_wrap{text-align:center}table.blueTable td,table.blueTable th{border:1px solid #aaa;padding:3px 2px}table.blueTable tbody td{font-size:13px}table.blueTable tr:nth-child(even){background:#d0e4f5}table.blueTable thead{background:#1c6ea4;background:-moz-linear-gradient(top,#5592bb 0,#327cad 66%,#1c6ea4 100%);background:-webkit-linear-gradient(top,#5592bb 0,#327cad 66%,#1c6ea4 100%);background:linear-gradient(to bottom,#5592bb 0,#327cad 66%,#1c6ea4 100%);border-bottom:2px solid #444}table.blueTable thead th{font-size:15px;font-weight:700;color:#fff;border-left:2px solid #d0e4f5}table.blueTable thead th:first-child{border-left:none}table.blueTable tfoot{font-size:14px;font-weight:700;color:#fff;background:#d0e4f5;background:-moz-linear-gradient(top,#dcebf7 0,#d4e6f6 66%,#d0e4f5 100%);background:-webkit-linear-gradient(top,#dcebf7 0,#d4e6f6 66%,#d0e4f5 100%);background:linear-gradient(to bottom,#dcebf7 0,#d4e6f6 66%,#d0e4f5 100%);border-top:2px solid #444}table.blueTable tfoot td{font-size:14px}table.blueTable tfoot .links{text-align:right}table.blueTable tfoot .links a{display:inline-block;background:#1c6ea4;color:#fff;padding:2px 8px;border-radius:5px}</style>
<?php 
    
managing_popup();    

    
}


function writer_table_content($post_id){
    $writer_data=collect_writer_data($post_id);
    ?>
    <tr>
        <td width="20%" >
            <img width="150" height="150" class="profile" src="<?php echo $writer_data['profile'][0] ?>">
        </td>
        <td width="20%" >
            <div class="countpost"><?php echo $writer_data['name'] ?></div>
        </td>
        <td width="20%" >
            <div class="cat_wrap"><a class="countpost" href="<?php echo $writer_data['category']['cat_url'] ?>"><?php echo $writer_data['name'] ?></a></div>
        </td>
        <td width="20%" >
            <div class="countpost"><?php echo $writer_data['category']['cat_count'] ?></div>
        </td>
        <td width="20%" >
            <div class="actionclass">
                <span  id="<?php echo $post_id ?>" class="a_update btn btn-3">Update</span>
                <span  id="<?php echo $post_id ?>" class="a_delete btn btn-4">Delete</span>
            <div>
        </td>
    </tr>
<?php    
}

function managing_popup(){
    
 popup_new();
 popup_cat();
 popup_update();
 popup_delete();
 popup_scripts();
 popup_styles();
 }

?>