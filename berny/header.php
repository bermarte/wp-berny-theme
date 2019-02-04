<!doctype html>
<html>
<?php 
    /* set CF */
    my_plugin_init();
    if ($GLOBALS['acf']) {
        change_Background();
        change_Background_Menu();
        change_color_text_Menu();
        change_color_paragraph();
        change_color_text_Cat();
        change_color_text_Link();
        change_HrColor();
    }
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $site = bloginfo('name'); $theme = wp_get_theme();echo $site.": ".$theme?></title>
    <?php wp_head(); ?>
</head>
<!-- each page with his class (body_class) -->
<?php
    if (is_front_page()){
        /* home pâge */
        $my_class = array('body-css'); 
    }
    else{
        $my_class = '';
    }
    
?>
<!-- pass the class name 'body-css' in the array (add zero, one or more classes) -->
<body <?php body_class($my_class); ?>>

    <div id="container" class="my-container">

        <header>
        
        <?php 
        $tagline = get_bloginfo('description'); 
        echo "<div id='tagline'>$tagline</div>";
        ?>

        <div class='row'>
        <div class='col-xs-12'>
        <?php 
            $args = array(
                'theme_location' => 'primary',
                 'menu_class' => 'mymenu'
            );
        ?>
    
        <img src="<?php header_image();?>" alt="" height="124" width="124" class="header-img" style="background-color:<?= $backcolor ?>" >
        <div class="menu-nav menu-nav-top">
        <?php
            /* primary: in functions.php */
            wp_nav_menu($args); 
        ?>
        </div>
        </div>
        
        </div>
        </header>
        
