<?php
/*
Template Name: Page no Title 
*/
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
 
 <p><?php the_content(); ?></p>
 <hr>
 <?php
	} // end while
} // end if
else {
 echo '<p>there are no posts</p>';
}
get_footer();
?>