<?php
include_once("_inc/assets/register_assets.php");
include_once("_inc/theme/theme_setup.php");
include_once("_inc/meta-box/meta_box.php");
include_once("_inc/mr-theme-comment-body/mr_theme_comment_body.php");
include_once("helper/helper.php");
include_once("_inc/taxonimies/casts_taxonomy.php");
include_once("_inc/taxonimies/news_taxonomy.php");
include_once("_inc/subscribe/subscribe.php");
include_once("_inc/question-box/question_box.php");
include_once("_inc/admin-bar-css/style.php");
function custom_post_type_pagination($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('news')) {
        $query->set('posts_per_page', 4); // تعداد پست‌ها در هر صفحه
    }
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('casts')) {
        $query->set('posts_per_page', 6); // تعداد پست‌ها در هر صفحه
    }
}
add_action('pre_get_posts', 'custom_post_type_pagination');
function enqueue_custom_metabox_scripts() {
    
        wp_enqueue_script('custom-metabox-script', get_template_directory_uri() . './assets/js/custom-metabox.js', ['jquery'], null, true);
    
}
add_action('admin_enqueue_scripts', 'enqueue_custom_metabox_scripts');