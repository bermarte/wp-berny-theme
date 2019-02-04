<?php 
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
        //include content.php
        get_template_part('content-gallery', get_post_format());
        ?>
 
 <?php
	} // end while
} // end if
else {
 echo '<p>there are no posts</p>';
}
get_footer();
?>

