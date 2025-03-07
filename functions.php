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
function custom_post_type_pagination($query)
{
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('news')) {
        $query->set('posts_per_page', 1); // تعداد پست‌ها در هر صفحه
    }
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('casts')) {
        $query->set('posts_per_page', 1); // تعداد پست‌ها در هر صفحه
    }
    if (!is_admin() && $query->is_main_query()) {
        // بررسی اینکه آیا در صفحه آرشیو نوع پست 'news' یا صفحه دسته‌بندی هستیم
        if (is_post_type_archive('news') || is_category()) {
            $query->set('posts_per_page', 1); // تعداد پست‌ها در هر صفحه
        }
    }
}
add_action('pre_get_posts', 'custom_post_type_pagination');





















// $button_text = in_array($post->ID, $favorite) ? 'حذف از علاقه مندی' : 'افزودن به علاقه مندی';
// echo '<button class="favorite-btn button" data-post-id="' . $post->ID . '">' . $button_text . '</button>';



// 1. افزودن دکمه علاقه مندی به صفحه تکنویس
function add_favorite_button() {
    if (is_single() && get_post_type() == 'post') {
        global $post;
        $user_id = get_current_user_id();
        $favorite = get_user_meta($user_id, 'user_favorite', true) ?: [];
        $button_text = in_array($post->ID, $favorite) ? 'minus' : 'plus';
        echo '<p class="favorite-btn button" data-post-id="' . $post->ID . '"><i class="fa-solid fa-heart-circle-' . $button_text . '"></i></p>';
    }
}

add_action('wp_footer', 'add_favorite_button');

// 2. پردازش عملیات علاقه مندی با AJAX
function handle_favorite_ajax() {
    if (!is_user_logged_in()) {
        wp_send_json_error('ابتدا وارد شوید');
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $favorite = get_user_meta($user_id, 'user_favorite', true) ?: [];

    if (in_array($post_id, $favorite)) {
        $favorite = array_diff($favorite, [$post_id]);
        $message = 'از علاقه مندی حذف شد';
    } else {
        $favorite[] = $post_id;
        $message = 'به علاقه مندی اضافه شد';
    }

    update_user_meta($user_id, 'user_favorite', array_values($favorite));
    wp_send_json_success($message);
}
add_action('wp_ajax_update_favorite', 'handle_favorite_ajax');

// 3. پردازش حذف مورد از علاقه مندی
function handle_remove_favorite_ajax() {
    if (!is_user_logged_in()) {
        wp_send_json_error('دسترسی غیرمجاز');
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $favorite = get_user_meta($user_id, 'user_favorite', true) ?: [];

    if (($key = array_search($post_id, $favorite)) !== false) {
        unset($favorite[$key]);
        update_user_meta($user_id, 'user_favorite', array_values($favorite));
        wp_send_json_success('مورد از علاقه مندی حذف شد');
    }

    wp_send_json_error('خطا در حذف');
}
add_action('wp_ajax_remove_from_favorite', 'handle_remove_favorite_ajax');

// 4. نمایش علاقه مندی کاربر
function display_user_favorite() {
    if (!is_user_logged_in()) {
        echo '<p>برای مشاهده علاقه مندی باید وارد شوید</p>';
        return;
    }

    $user_id = get_current_user_id();
    $favorite = get_user_meta($user_id, 'user_favorite', true) ?: [];

    if (empty($favorite)) {
        echo '<p>علاقه مندی شما خالی است</p>';
        return;
    }

    echo '<ul class="favorite-items">';
    foreach ($favorite as $post_id) {
        $post = get_post($post_id);
        if ($post) {
            echo '<li>';
            echo '<a href="' . get_permalink($post_id) . '">' . $post->post_title . '</a>';
            echo '<button class="remove-from-favorite button" data-post-id="' . $post_id . '">حذف</button>';
            echo '</li>';
        }
    }
    echo '</ul>';
}
add_shortcode('user_favorite', 'display_user_favorite');

// 5. لود فایل JavaScript و ارسال متغیرهای AJAX
function enqueue_favorite_scripts() {
  
}
add_action('wp_enqueue_scripts', 'enqueue_favorite_scripts');

// تابع شمارش پستهای علاقه مندی
function get_favorite_count() {
    if (!is_user_logged_in()) return 0;
    $user_id = get_current_user_id();
    $favorite = get_user_meta($user_id, 'user_favorite', true) ?: [];
    return count($favorite);
}










