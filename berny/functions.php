 <?php
/*
include scripts
*/
function bermarte_theme_enqueue_styles() {
    /* 
    css id: custom-style-css ver. 1.0.0
    array: dependencies
    all: mobile, print etc.
    */
    $uri = get_template_directory_uri();
    //css
    wp_enqueue_style( 'bootstrap', $uri . '/css/bootstrap.min.css', array(), '4.0.0', 'all' );
    wp_enqueue_style( 'custom-style', $uri . '/css/style.css', array(), '1.0.0', 'all' );
    
    wp_enqueue_script( 'jquery-js', $uri . '/js/jquery-3.3.1.min.js', array(), '3.3.1', true );
    //gallery page
    if (is_page('190')) {
        
        //lightgallery
        
        wp_enqueue_style( 'lightgallery', $uri . '/css/lightgallery.min.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'custom-style_B', $uri . '/css/imgs.css', array(), '1.0.0', 'all' );
        
        //scripts
        
        wp_enqueue_script( 'lightgallery-js', $uri . '/js/lightgallery.min.js', array(), '1.6.11', true );
        wp_enqueue_script( 'lg-fullscreen', $uri . '/js/lg-fullscreen.min.js', array(), '1.1.0', true );
        wp_enqueue_script( 'lg-video', $uri . '/js/lg-thumbnail.min.js', array(), '1.1.0', true );
        wp_enqueue_script( 'lg-thumbnail', $uri . '/js/lg-zoom.min.js', array(), '1.1.0', true );
        wp_enqueue_script( 'masonry', $uri . '/js/masonry.pkgd.min.js', array(), '3.1.4', true );
        wp_enqueue_script( 'custom-script', $uri . '/js/my-gallery.js', array(), '1.0.0', true );
    }
    //home videos
    
    if (is_front_page()){ 
        wp_enqueue_script( 'iframe-script', $uri . '/js/iframe.js', array(), '1.0.0', true );
    
     } 
    
}
add_action( 'wp_enqueue_scripts', 'bermarte_theme_enqueue_styles' );

/* add menus */
function bermarte_theme_setup(){
    add_theme_support( 'menus' );
    /* Primary Navigation in Menu Settings */
    register_nav_menu( 'primary', 'Primary Navigation' );
    /* Footer menu */
    register_nav_menu( 'secondary', 'Footer Navigation' );
}
/* theme support */
/* hooks */
/* user can choose items after_setup_theme or init */
add_action( 'init', 'bermarte_theme_setup' );
/* user can change background */
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
/* featured image */
add_theme_support( 'post-thumbnails' );
/* style category links */
add_filter('the_category','add_class_to_category',10,3);
function add_class_to_category( $thelist, $separator, $parents){
    $class_to_add = 'my-category';
    return str_replace('<a href="', '<a class="' . $class_to_add . '" href="', $thelist);
}

/* 
plugins used in the theme:
custom-field-suite
photonic
wp-mail-smtp
wpforms-lite
*/


//https://wordpress.stackexchange.com/questions/54742/how-to-do-i-get-a-list-of-active-plugins-on-my-wordpress-blog-programmatically
/* check plugins */
function my_plugin_init(){
	$the_plugs = get_option('active_plugins'); 
    foreach($the_plugs as $key => $value) {
        $string = explode('/',$value);
        if ($string[0] == 'custom-field-suite'){
            $GLOBALS['acf'] = true;
        }
    }
}


/* post and pages colors variants */
function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $my_color) {
        $my_color   = hexdec($my_color); // Convert to decimal
        $my_color   = max(0,min(255,$my_color + $steps)); // Adjust color
        $return .= str_pad(dechex($my_color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }
    return $return;
}


//change background-color in CSS
//https://codex.wordpress.org/Function_Reference/wp_add_inline_style
function change_Div(){
    if ($GLOBALS['acf']) {
        $backcolor = CFS()->get('background-color');
    }
        $custom_css = "
                div{
                        background: {$backcolor};
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_Background(){
    add_action( 'wp_enqueue_scripts', 'change_Div' ); 
}

/* hr color Divide Blocks of text */
//box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8);
function change_Hr(){
    if ($GLOBALS['acf']) { 
        $hrcolor = CFS()->get('divisorColor');
    }
        $custom_css = "
                .my-hr{
                       box-shadow: inset 0 9px 9px -3px $hrcolor;
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_HrColor(){
    add_action( 'wp_enqueue_scripts', 'change_Hr' ); 
}

/* SPECIFIC FIX WEB SITE UI */
//hide CF for BLOG in UI
function my_admin_hide_cf() { 
    echo '
   <style>
   .postbox {display: none;}
   </style>';
}
//some text for the blog page (administrator)
function my_custom_footer_admin_text(){
    echo '
   <style>
   #my-blog{
        position: relative;
        bottom: 200px;
        padding: 20px;
        background-color: white;
        border: 1px solid #c9c8c8;
    }
   </style>
    <p id="my-blog" role="contentinfo">This page is empty. Check the first post on top to change the look of the blog page itself.</p>';
}

if ($_SERVER["QUERY_STRING"] == 'post=35&action=edit'){
    add_action('admin_footer', 'my_admin_hide_cf');
    add_filter('admin_footer_text', 'my_custom_footer_admin_text');
}

//hide part of CF for BLOG in UI
//you can change page background but only in the first post
function my_admin_hide_partof_cf() {   
    echo '
   <style>
   .field-background-color,
   #cfs_input_183,
   .field-pColor,
   #cfs_input_184,
   .field-aColor,
   .field-aHoverColor,
   .field-divisorColor
   {display: none;}
   
   </style>';
}

if ($_SERVER["QUERY_STRING"] == 'post=27&action=edit' or $_SERVER["QUERY_STRING"] == 'post=1&action=edit'
    or $_SERVER["QUERY_STRING"] == 'post=27&action=edit&message=1' or $_SERVER["QUERY_STRING"] == 'post=1&action=edit&message=1'){
    add_action('admin_footer', 'my_admin_hide_partof_cf');
}

/* change color menu */
function change_Menu(){
    if ($GLOBALS['acf']) {
        $backMenucolor = CFS()->get('menuColor');
    }
        $custom_css = "
                .menu-item a{
                        background: {$backMenucolor};
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_Background_Menu(){
    add_action( 'wp_enqueue_scripts', 'change_Menu' ); 
}

/* change TEXT color menu */
function change_TextMenu(){
    if ($GLOBALS['acf']) {
        $textMenucolor = CFS()->get('menuTextColor');
        $textMenuHovercolor = CFS()->get('menuTextHoverColor');
    }
        $custom_css = "
               .menu-nav a{
                        color: {$textMenucolor};
                }
               .menu-nav a:hover{
                        color: {$textMenuHovercolor};
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_color_text_Menu(){
    add_action( 'wp_enqueue_scripts', 'change_TextMenu' ); 
}

/* change CATEGORY color menu */
function change_catColors(){
    if ($GLOBALS['acf']) {
        //.my-category
        $textCatcolor = CFS()->get('catColor');
        $textCatHovercolor = CFS()->get('catTextHoverColor');
    }
    
        $custom_css = "
               .my-category{
                        color: {$textCatcolor};
                }
               .my-category:hover{
                        color: {$textCatHovercolor};
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_color_text_Cat(){
    add_action( 'wp_enqueue_scripts', 'change_catColors' ); 
}

/* change link colors */
function change_linkColors(){
    if ($GLOBALS['acf']) {
        //.my-category
        $textAcolor = CFS()->get('aColor');
        $textAHovercolor = CFS()->get('aHoverColor');
    }
        $custom_css = "
               p a:link,a:link,a
               {
                        color: {$textAcolor};
                }
               p a:hover,a:hover{
                        color: {$textAHovercolor};
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_color_text_Link(){
    add_action( 'wp_enqueue_scripts', 'change_linkColors' ); 
}

/* change paragraph text color (.content p) */
function change_paragraphColor(){
    if ($GLOBALS['acf']) {
        $pcolor = CFS()->get('pColor');
    }
    $custom_css = "
            .content p,
            small{
                        color: {$pcolor};
                }";
    wp_add_inline_style( 'custom-style', $custom_css );
}
function change_color_paragraph(){
    add_action( 'wp_enqueue_scripts', 'change_paragraphColor' ); 
}

/* hide CF field under Revisions field */
function hide_CF(){
    echo '
   <style>
   #postcustom {display: none;}
   </style>';
}

add_action('admin_footer', 'hide_CF');

//fix first post: you can change the look of the blog page
if ($_SERVER["QUERY_STRING"] == 'post=33&action=edit'){
    //cfs_input_183
    add_action('admin_footer', 'my_admin_show_partof_cf');

}
function my_admin_show_partof_cf() {   
    echo '
   <style>
   #cfs_input_183{display: block;}  
   </style>';
}

?>