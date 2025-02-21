<?php
function theme_setup()
{
    add_filter('show_admin_bar', '__return_false');
   
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_setup');
