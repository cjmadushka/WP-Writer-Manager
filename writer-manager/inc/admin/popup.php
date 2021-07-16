<?php
function popup_new(){ 
    $args = array('child_of' => 48);
    $categories = get_categories( $args );
?><div id="myModal" class="modal">
    <form style="height:600px;" class="form">
        <span class="close">&times;</span>
        <h2 class="p_head">Add New</h2>
        <p type="Name:">
            <input id="n_name" placeholder="Writer's name here.."></input>
        </p>
        <p type="FB Link">
            <input id="n_link" placeholder="Facebook Profile Link"></input>
        </p>
        <p type="Category:">
            <select class="n_cat" style="width: 80%;" name="writer_cat" id="writer_cat">
                <?php
                foreach ($categories as $cate){
                ?>
                <option value="<?php echo $cate->term_id?>"><?php echo $cate->name ?></option>
                <?php } ?>
            </select>
            <span id="cat_new" class="btn btn-3" style="font-size: 1rem;">New</span>
            <?php echo frontend_media(1); ?>
        </p>
        <button id="add_new">Add Writer</button>
    </form>
    </div>
    
    
    
<?php }

function popup_cat(){ ?>
    <div id="myModal2" style="z-index:99;" class="modal">
                <form style="margin: calc(50vh - 120px) auto;height: 233px;" class="form">
        <span class="close2 close">&times;</span>
        <h2 class="p_head">Add New</h2>
        <p type="Cate. Name:">
            <input id="cat_new_submit" placeholder="Category Name"></input>
        </p>
        
        <button id="add_new_cat">Add Category</button>
    </form>
    
    </div>
<?php }


function popup_update(){ 
$args = array('child_of' => 48);
$categories = get_categories( $args );
?>
<div id="myModal3" class="modal">
    <form class="form">
        <span class="close close3">&times;</span>
        <h2 class="p_head">Update</h2>
        <p type="Name:">
            <input id="u_name" placeholder="Writer's name here.."></input>
        </p>
        <p type="FB Link">
            <input id="u_link" placeholder="Facebook Profile Link"></input>
        </p>
        <p type="Category:">
            <select class="n_cat" style="width: 80%;" name="writer_cat" id="writer_cat">
                <?php
                foreach ($categories as $cate){
                ?>
                <option value="<?php echo $cate->term_id?>"><?php echo $cate->name ?></option>
                <?php } ?>
            </select>
            <span id="cat_new_up" class="btn btn-3" style="font-size: 1rem;">New</span>
            <?php echo frontend_media(2); ?>
        </p>
        <button id="update">Update Writer</button>
    </form>
</div>
<?php 
}


function popup_delete(){
?>
<div id="myModal4" class="modal">
    <form class="form" style="height: 200px;width: 700px;">
        <span class="close close4">×</span>
        <h2 class="p_head">Delete</h2>
        <p class="del">Are you sure, you wanna delete this writer ?
        </p>
        
        <button id="delete" style="
">Delete Writer</button>
        <button id="cancel">Cancel</button></form>
</div>
<?php 
}

function popup_scripts(){ ?>
    <script>

var modal = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");
var modal3 = document.getElementById("myModal3");
var modal4 = document.getElementById("myModal4");
var btn = document.getElementById("new");cat_new
var btn2 = document.getElementById("cat_new");
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close2")[0];
var span3 = document.getElementsByClassName("close3")[0];
var span4 = document.getElementsByClassName("close4")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}
span2.onclick = function() {
  jQuery('#myModal2').hide();
}
span3.onclick = function() {
  modal3.style.display = "none";
}
span4.onclick = function() {
  modal4.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
        
jQuery('#add_new_cat').click(function(){
    jQuery('#cat_new_submit').val();
}); 

jQuery('#cancel').click(function(event){
    event.preventDefault();
    modal4.style.display = "none";
});
jQuery('#cat_new').click(function(event){
    jQuery('#myModal2').show();
});
jQuery('#cat_new_up').click(function(event){
    jQuery('#myModal2').show();
});

jQuery(".a_delete").click(function(){
     var id = this.id;
     modal4.style.display = "block";
     jQuery('#delete').attr('data-pid', id);
});
        
    </script>
    
<?php }

function popup_styles(){ ?>
    <style>#frontend-image {width: 150px;height: 150px;border-radius: 100%;}.form{width:340px;height:565px;background:#e6e6e6;border-radius:8px;box-shadow:0 0 40px -10px #000;margin:calc(50vh - 220px) auto;padding:20px 30px;max-width:calc(100vw - 40px);box-sizing:border-box;font-family:Montserrat,sans-serif;position:relative}.p_head{margin:10px 0;padding-bottom:10px;width:180px;color:#78788c;border-bottom:3px solid #78788c}input,select{width:100%;padding:10px;box-sizing:border-box;background:0 0;outline:0;resize:none;border:0;font-family:Montserrat,sans-serif;transition:all .3s;border-bottom:2px solid #bebed2}input:focus,select:focus{border-bottom:2px solid #78788c}p:before{content:attr(type);display:block;margin:28px 0 0;font-size:14px;color:#5a5a5a}button{float:right;padding:8px 12px;margin:8px 0 0;font-family:Montserrat,sans-serif;border:2px solid #78788c;background:0;color:#5a5a6e;cursor:pointer;transition:all .3s}button:hover{background:#78788c;color:#fff}</style>
    <style>.modal{display:none;position:fixed;z-index:1;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;background-color:rgba(0,0,0,.4)}.modal-content{background-color:#fefefe;margin:15% auto;padding:20px;border:1px solid #888;width:80%}.close{color:#aaa;float:right;font-size:28px;font-weight:700}.close:focus,.close:hover{color:#000;text-decoration:none;cursor:pointer}</style>
    <style>p.del{font-size:1.2rem;font-family:cursive;}button#delete{font-weight:700;margin-left:5px;}button#delete:hover{background:#ff2222;color:aliceblue;text-shadow:0 0 7px black;}</style>
<?php }

function frontend_media($atts) {
    $type=strval($atts);
	if ( current_user_can( 'upload_files' ) ) {
		$str = __( 'Select Cover Image', 'frontend-media' );
		return '<input id="frontend-button'.$type.'" type="button" value="' . $str . '" class="button" style="position: relative; z-index: 1;"><img style="left:50%;position: relative;transform: translateX(-50%);" width="150" height="150" id="frontend-image'.$type.'" />';
	}

	return __( 'Please Login To Upload', 'frontend-media' );
}

?>