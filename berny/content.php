<?php 
//from functions.php
my_plugin_init();
if ($GLOBALS['acf']) {
    $color = CFS()->get('color');
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
        <p>
            <?php 
            the_content();
            ?>
        </p>
    </div>
</div>
<hr class="my-hr">