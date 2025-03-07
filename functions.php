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





















// $button_text = in_array($post->ID, $watchlist) ? 'حذف از واچلیست' : 'افزودن به واچلیست';
// echo '<button class="watchlist-btn button" data-post-id="' . $post->ID . '">' . $button_text . '</button>';



// 1. افزودن دکمه واچلیست به صفحه تکنویس
function add_watchlist_button() {
    if (is_single() && get_post_type() == 'post') {
        global $post;
        $user_id = get_current_user_id();
        $watchlist = get_user_meta($user_id, 'user_watchlist', true) ?: [];
        $button_text = in_array($post->ID, $watchlist) ? 'minus' : 'plus';
        echo '<p class="watchlist-btn button" data-post-id="' . $post->ID . '"><i class="fa-solid fa-heart-circle-' . $button_text . '"></i></p>';
    }
}

add_action('wp_footer', 'add_watchlist_button');

// 2. پردازش عملیات واچلیست با AJAX
function handle_watchlist_ajax() {
    if (!is_user_logged_in()) {
        wp_send_json_error('ابتدا وارد شوید');
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $watchlist = get_user_meta($user_id, 'user_watchlist', true) ?: [];

    if (in_array($post_id, $watchlist)) {
        $watchlist = array_diff($watchlist, [$post_id]);
        $message = 'از واچلیست حذف شد';
    } else {
        $watchlist[] = $post_id;
        $message = 'به واچلیست اضافه شد';
    }

    update_user_meta($user_id, 'user_watchlist', array_values($watchlist));
    wp_send_json_success($message);
}
add_action('wp_ajax_update_watchlist', 'handle_watchlist_ajax');

// 3. پردازش حذف مورد از واچلیست
function handle_remove_watchlist_ajax() {
    if (!is_user_logged_in()) {
        wp_send_json_error('دسترسی غیرمجاز');
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $watchlist = get_user_meta($user_id, 'user_watchlist', true) ?: [];

    if (($key = array_search($post_id, $watchlist)) !== false) {
        unset($watchlist[$key]);
        update_user_meta($user_id, 'user_watchlist', array_values($watchlist));
        wp_send_json_success('مورد از واچلیست حذف شد');
    }

    wp_send_json_error('خطا در حذف');
}
add_action('wp_ajax_remove_from_watchlist', 'handle_remove_watchlist_ajax');

// 4. نمایش واچلیست کاربر
function display_user_watchlist() {
    if (!is_user_logged_in()) {
        echo '<p>برای مشاهده واچلیست باید وارد شوید</p>';
        return;
    }

    $user_id = get_current_user_id();
    $watchlist = get_user_meta($user_id, 'user_watchlist', true) ?: [];

    if (empty($watchlist)) {
        echo '<p>واچلیست شما خالی است</p>';
        return;
    }

    echo '<ul class="watchlist-items">';
    foreach ($watchlist as $post_id) {
        $post = get_post($post_id);
        if ($post) {
            echo '<li>';
            echo '<a href="' . get_permalink($post_id) . '">' . $post->post_title . '</a>';
            echo '<button class="remove-from-watchlist button" data-post-id="' . $post_id . '">حذف</button>';
            echo '</li>';
        }
    }
    echo '</ul>';
}
add_shortcode('user_watchlist', 'display_user_watchlist');

// 5. لود فایل JavaScript و ارسال متغیرهای AJAX
function enqueue_watchlist_scripts() {
    wp_enqueue_script(
        'watchlist-script',
        get_template_directory_uri() . '/assets/js/wishlist.js',
        array('jquery'),
        null,
        true
    );

    // ارسال متغیر وضعیت لاگین
    wp_localize_script('watchlist-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'is_logged_in' => is_user_logged_in() ? '1' : '0' // اضافه کنید
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_watchlist_scripts');

// تابع شمارش پستهای واچلیست
function get_watchlist_count() {
    if (!is_user_logged_in()) return 0;
    $user_id = get_current_user_id();
    $watchlist = get_user_meta($user_id, 'user_watchlist', true) ?: [];
    return count($watchlist);
}










