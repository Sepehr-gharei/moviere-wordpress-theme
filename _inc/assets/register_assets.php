<?php
function register_assets()
{
    /* **************************** start register CSS *****************************/
    wp_register_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
    wp_enqueue_style('bootstrap-5');
    wp_register_style('main-style', get_stylesheet_directory_uri() . '/style.css', [], '1.0.0');
    wp_enqueue_style('main-style');
    wp_register_style('swiper-11', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11');
    wp_enqueue_style('swiper-11');
    wp_register_style('font-awsome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', [], '6.5.2');
    wp_enqueue_style('font-awsome');
    /* **************************** end register CSS *****************************/
    /* **************************** start register JS *****************************/
    wp_register_script('swiper-11', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true);
    wp_enqueue_script('swiper-11');

    wp_register_script('lateral', get_template_directory_uri() . './assets/js/lateral.js', [], '1.0.0', true);
    wp_enqueue_script('lateral');
 
    wp_register_script('swiper', get_template_directory_uri() . './assets/js/swiper.js', [], '1.0.0', true);
    wp_enqueue_script('swiper');
    wp_register_script('main', get_template_directory_uri() . './assets/js/main.js', [], '1.0.0', true);
    wp_enqueue_script('main');
    wp_register_script('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true);
    wp_enqueue_script('bootstrap-5');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', [], '3.6.0', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('ajax',get_template_directory_uri() . './assets/js/ajax.js', ['jquery'], '1.0.0', true);
    wp_localize_script('ajax','ajax',[
        'ajaxurl'=>admin_url('admin-ajax.php'),
        '_nonce'=> wp_create_nonce(),
    ]);
    wp_register_script('preloader', get_template_directory_uri() . './assets/js/preloader.js', [], '1.0.0', true);
    wp_enqueue_script('preloader');
    /* **************************** end register JS *****************************/
}
add_action('wp_enqueue_scripts', 'register_assets');