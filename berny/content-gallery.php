<?php 
//from functions.php
my_plugin_init();
if ($GLOBALS['acf']) {
    $color = CFS()->get('color');
    $images = CFS()->get('images');
}
else{
    $color = "#d14f4f";
}
$varColor = adjustBrightness($color, 33);

?>

<div id="content" style="background:<?= $color ?>">

     
    <div class="thumbnail-img content">
        <?php the_post_thumbnail('thumbnail', array('class' => 'thumb'));?>
         <span class="next-2-thumb">
         <a href="<?php the_permalink() ?>">
         <?php the_title(); ?>
         </a>
         </span>
    </div>
    <small>Posted on: <?php the_time('F j, Y');?> at <?php the_time('g:i a'); ?>
 <?php 
   /* show only the category of the posts */
   $cats = get_the_category($post->ID);
  if( count($cats) ) {
        echo in;
        the_category();
  }
 ?>
 </small>
    <div class="content" style="background:<?= $varColor ?>">
            
            <div id="masonry">
            <?php 
            
            if(isset($images)) {

                
                foreach($images as $img) { 
                    $url = $img["image"];
                    $title = $img["TitleImageText"];
                    $txt = $img["imageText"];
                    echo "<a href='$url' class= 'item grid-sizer' data-sub-html='<h4>$title</h4><p>$txt</p>' data-exthumbimage='$url' data-src='$url'>";
                    echo "<img src='$url'  alt='' class='thumb-img' data-exthumbimage='$url' data-src='$url'>";
                    echo "</a>";
                } 
            }

            ?>
            </div>
        
    </div>
</div>
<hr class="my-hr">