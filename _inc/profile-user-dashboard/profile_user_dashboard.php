<?php

add_action('init', 'process_user_update_form');
function process_user_update_form() {
    if (isset($_POST['update_profile'])) {
        // اعتبارسنجی اولیه
        if (!is_user_logged_in()) {
            wp_die('شما باید وارد حساب کاربری خود شوید.');
        }

        $current_user = wp_get_current_user();
        if (!$current_user->exists()) {
            wp_die('اطلاعات کاربری موجود نیست.');
        }

        $user_id = $current_user->ID;

        // دریافت داده‌ها از فرم
        $nickname = sanitize_text_field($_POST['nickname']);
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $bio = sanitize_textarea_field($_POST['bio']);

        $password_changed = false;

        // بررسی پسورد
        if (!empty($old_password) && !empty($new_password)) {
            $check_password = wp_check_password($old_password, $current_user->user_pass, $user_id);
            if ($check_password) {
                wp_set_password($new_password, $user_id);
                $password_changed = true;
            } else {
                // اگر پسورد اشتباه باشد، کاربر به صفحه قبلی با پارامتر خطا هدایت می‌شود
                wp_redirect(add_query_arg('error-pass', 'wrong_password', home_url('/edit-profile')));
                exit;
            }
        }

        // بررسی و تغییر لقب
        if (!empty($nickname) && $nickname !== $current_user->nickname) {
            wp_update_user(array('ID' => $user_id, 'nickname' => $nickname));
        }

        // بررسی بایو
        if (!empty($bio)) {
            update_user_meta($user_id, 'bio', $bio);
        }

        // تعیین مسیر هدایت
        if ($password_changed) {
            wp_redirect(home_url() . "/login");
        } else {
            wp_redirect(home_url() . '/edit-profile');
        }
        exit;
    }
}
function disable_image_sizes($sizes) {
    unset($sizes['thumbnail']); // غیرفعال کردن Thumbnail
    unset($sizes['medium']);    // غیرفعال کردن Medium
    unset($sizes['large']);     // غیرفعال کردن Large
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'disable_image_sizes');