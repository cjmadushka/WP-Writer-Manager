<?php
add_filter( 'the_content', 'profile_frontend' );
function profile_frontend($cont){
    if(is_single()){
        $post_id=get_the_ID();
        $writer_id=get_field('writer',$post_id);
        if($writer_id){
            $writer=collect_writer_data($writer_id);
            $c=prepare_content($writer);
            $cont=$cont.$c;
            return $cont;
        }else{
            return $cont;
        }
    
    }else{
        return $cont;
    }
    
}

function prepare_content($writer){
    ob_start();
    $uc=get_bloginfo('wpurl').'/wp-content/plugins/writer-manager/img/background.webp';
    
    ?>
    <div class="card">
  <div class="banner">
    <img src="<?php echo  $writer['profile'][0] ?>">
  </div>
  <div class="menu">
    
  </div>
  <h2 class="name"><?php echo  $writer['name'] ?></h2>
  <div class="title">Writer</div>
  <div class="actions">
    <div class="follow-info">
      <h2><a href="#"><span><?php echo  $writer['category']['cat_count'] ?></span><small>Articles</small></a></h2>
      
    </div>
    <div class="follow-btn">
      <button onclick="location.href='<?php echo  $writer['fb_link'] ?>'" type="button">facebook</button>
    </div>
  </div>
  <div class="Articles">
      <button onclick="location.href='<?php echo $writer['category']['cat_url'] ?>'" type="button">Articles</button>
    </div>
</div>
<style>
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,400i,700");
body {
    font-family: 'Montserrat';
}.card .menu .opener:hover {
  background-color: #f2f2f2;
}.card .actions .follow-info h2 a:hover {
  background-color: #636363;
}.card .actions .follow-info h2 a:hover span {
  color: #ffd01a;
}.card .actions .follow-btn button:hover {
  background-color: #00adff;
  transform: scale(1.1);
}.card .actions .follow-btn button:active {
  background-color: #00adff;
  transform: scale(1);
}Article button {
    color: black!important;
    font-weight: bold;
    font-size: larger;
    background-color: #ffd01a;
    width: 100%;
    border: none;
    padding: 1rem;
    outline: none;
    box-sizing: border-box;
    border-radius: 50% 50% 0 0;
    text-shadow: 1px 1px 5px #947400;
    transition: 300ms;
}.Articles {
    order: 100;
    margin-top: 15px;
}Article button:hover {
    border-radius: 10% 10% 0 0;
}
.card {
    background-color: #3b3b3b;
    max-width: 360px;
    min-width: 360px;
    margin-top: 40px;
    position: relative;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border-radius: 2rem;
    box-shadow: 0px 1rem 1.5rem rgb(0 0 0 / 50%);
    left: 50%;
    transform: translateX(-50%);
}
.card .banner {
    background-image: url(<?php echo get_option( 'wporg_options',$uc );  ?>);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 11rem;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    box-sizing: border-box;
}.card .banner img {
    background-color: #fff;
    width: 8rem;
    height: 8rem;
    box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 30%);
    border-radius: 50%;
    transform: translateY(50%);
    transition: transform 200ms cubic-bezier(0.18, 0.89, 0.32, 1.28);
}.card .menu {
    width: 100%;
    height: 5.5rem;
    padding: 1rem;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    position: relative;
    box-sizing: border-box;
}.card h2.name {
    text-align: center;
    padding: 0 2rem 0.5rem;
    margin: 0;
    color: #fff6eb;
}.card .title {
    color: #a0a0a0;
    font-size: 0.85rem;
    text-align: center;
    padding: 0 2rem 1.2rem;
}.card .actions {
    padding: 0 2rem 1.2rem;
    display: flex;
    flex-direction: column;
    order: 99;
}.card .actions .follow-info {
    padding: 0 0 1rem;
    display: flex;
}.card .actions .follow-info h2 {
    text-align: center;
    width: 100%;
    margin: 0;
    padding-left: 40px;
    padding-right: 40px;
    box-sizing: border-box;
}.card .actions .follow-info h2 a {
    text-decoration: none;
    padding: 0.8rem;
    display: flex;
    flex-direction: column;
    border-radius: 0.8rem;
    transition: background-color 100ms ease-in-out;
}.card .actions .follow-info h2 a span {
    color: #ffd01a;
    font-weight: bold;
    transform-origin: bottom;
    transition: color 100ms ease-in-out;
}.card .actions .follow-info h2 a small {
    color: #d8d1d1;
    font-size: 0.85rem;
    font-weight: normal;
}.card .actions .follow-btn button {
    color: antiquewhite!important;
    font-weight: bold;
    font-size: larger;
    background-color: #1aaaff;
    width: 100%;
    border: none;
    padding: 1rem;
    outline: none;
    box-sizing: border-box;
    border-radius: 1.5rem/50%;
    text-shadow: 2px 2px 3px black;
    transition: background-color 100ms ease-in-out, transform 200ms cubic-bezier(0.18, 0.89, 0.32, 1.28);
}.card .banner svg:hover {
    transform: translateY(50%) scale(1.3);
}
</style>
    
<?php
$output = ob_get_contents();
ob_end_clean();
return $output;
    
}

?>