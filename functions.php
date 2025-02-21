<?php
include_once("_inc/assets/register_assets.php");
include_once("_inc/theme/theme_setup.php");
include_once("_inc/meta-box/meta_box.php");
include_once("_inc/mr-theme-comment-body/mr_theme_comment_body.php");
include_once("helper/helper.php");
include_once("_inc/taxonimies/casts_taxonomies.php");
function enqueue_second_thumbnail_scripts()
{
    global $pagenow, $post_type;
    if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && $post_type == 'post') {
        wp_enqueue_media();
        wp_enqueue_script(
            'second-thumbnail-js',
            get_template_directory_uri() . '/_inc/ajax_thumbnail_2/ajax_thumbnail_2.js',
            array('jquery'),
            '1.0',
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'enqueue_second_thumbnail_scripts');
function checkCategory()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

    // دریافت هاست (دامنه)
    $host = $_SERVER['HTTP_HOST'];

    // دریافت مسیر (Path)
    $path = $_SERVER['REQUEST_URI'];

    // ساخت URL کامل
    $url = $protocol . "://" . $host . $path;


    // جدا کردن لینک با استفاده از '/'
    $parts = explode('/', $url);

    // بررسی وجود 'anime' در آرایه
    if (in_array('anime', $parts)) {
        return 'anime';
    }
    if (in_array('movies', $parts)) {
        return 'movies';
    }
    if (in_array('series', $parts)) {
        return 'series';
    }
}

function checkTag()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

    // دریافت هاست (دامنه)
    $host = $_SERVER['HTTP_HOST'];

    // دریافت مسیر (Path)
    $path = $_SERVER['REQUEST_URI'];

    // ساخت URL کامل
    $url = $protocol . "://" . $host . $path;


    // جدا کردن لینک با استفاده از '/'
    $parts = explode('/', $url);

    // بررسی وجود 'anime' در آرایه
    if (in_array('action', $parts)) {
        return 'action';
    }
    if (in_array('animation', $parts)) {
        return 'animation';
    }
    if (in_array('biography', $parts)) {
        return 'biography';
    }
    if (in_array('historical', $parts)) {
        return 'historical';
    }
    if (in_array('horror', $parts)) {
        return 'horror';
    }
    if (in_array('crime', $parts)) {
        return 'crime';
    }
    if (in_array('family', $parts)) {
        return 'family';
    }
    if (in_array('drama', $parts)) {
        return 'drama';
    }
    if (in_array('mystery', $parts)) {
        return 'mystery';
    }
    if (in_array('science-fiction', $parts)) {
        return 'science-fiction';
    }
    if (in_array('romance', $parts)) {
        return 'romance';
    }
    if (in_array('fantasy', $parts)) {
        return 'fantasy';
    }
    if (in_array('comedy', $parts)) {
        return 'comedy';
    }
    if (in_array('adventure', $parts)) {
        return 'adventure';
    }

}