<?php 
/* new template ABOUT ME */
//from functions.php
my_plugin_init();
if ($acf) {
    $color = CFS()->get( 'color' );
}
else{
    $color = "#d14f4f";
}

$varColor = adjustBrightness($color, 33);
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
        ?>

<?php 
   /* show only the category of the posts */
   $cats = get_the_category($post->ID);
  if( count($cats) ) {
        echo in;
        the_category();
  }
       
 ?>
 
<div class="content" style="background:<?= $color ?>">
    <div class="content" style="background:<?= $varColor ?>">
        <p>
            <?php 
            the_content();
            ?>
        </p>
    </div>
    <a href="<?php the_permalink() ?>" class="text-white bg-secondary">
        <?php the_title(); ?>
    </a>
</div>

    <hr  class="my-hr">
    <?php
	} // end while
   
 
} // end if
else {
 echo '<p>there are no posts</p>';
}
?>

<?php
get_footer();
?>