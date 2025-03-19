<?php
add_action('wp_ajax_nopriv_wp_mr_auth_send_verification_code', 'wp_mr_auth_send_verification_code');
add_action('wp_ajax_nopriv_wp_mr_auth_verify_verification_code', 'wp_mr_auth_verify_verification_code');
add_action('wp_ajax_nopriv_wp_mr_register_user', 'wp_mr_register_user');
function wp_mr_auth_send_verification_code()
{
    if (isset($_POST['_nonce']) && !wp_verify_nonce($_POST['_nonce'])) {
        die('access denied');
    }
    $phone = sanitize_text_field($_POST['phone']);
    wp_mr_validate_phone($phone);
    wp_mr_is_phone_exist($phone);
    $verification_code = rand(100000, 999999);
    // ارسال پیامک 
    wp_mr_send_sms($verification_code, $phone, '311507');
    wp_mr_add_verification_code_phone($phone, $verification_code);
}
function wp_mr_auth_verify_verification_code()
{
    if (isset($_POST['_nonce']) && !wp_verify_nonce($_POST['_nonce'])) {
        die('access denied');
    }
    $verification_code = sanitize_text_field($_POST['verification_code']);
    wp_mr_validation_code($verification_code);
    wp_mr_verify_user_verification($verification_code);

}
function wp_mr_is_phone_exist($phone)
{
    $args = [
        'meta_key' => '_phone',
        'meta_value' => $phone,
        'compare' => '='
    ];
    $phone = new WP_User_Query($args);
    if ($phone->get_total()==1) {
        wp_send_json([
            'error' => true,
            'message' => 'شماره مورد نظر قبلا ثبت شده است'
        ], 403);
    }
    ;
}
function wp_mr_validation_code($verification_code)
{
    if ($verification_code == '') {
        wp_send_json([
            'error' => true,
            'message' => 'کد دریافتی را وارد نمایید'
        ], 403);
    }
    if (strlen($verification_code) != 6) {
        wp_send_json([
            'error' => true,
            'message' => 'طول کد تایید باید 6 کاراکتر باشد',
        ], 403);
    }
}
function wp_mr_verify_user_verification($verification_code)
{
    global $wpdb;
    $table = $wpdb->prefix . 'login_register_verify_code';
    $stmt = $wpdb->get_row($wpdb->prepare("SELECT verification_code,phone FROM {$table} WHERE verification_code = '%s'", $verification_code));
    if ($stmt) {
        $user_phone = $_SESSION['current_user_phone'] = $stmt->phone;

    } else {
        wp_send_json([
            'error' => true,
            'message' => 'کد تاییدیه معتبر نمیباشد',
        ], 403);
    }
    ;
}
function wp_mr_register_user()
{
    if (isset($_POST['_nonce']) && !wp_verify_nonce($_POST['_nonce'])) {
        die('access denied');
    }
    wp_mr_validate_user_register($_POST);

    $data = [
        'user_login' => apply_filters('pre_user_login', sanitize_text_field($_POST['user_name'])),
        'user_pass' => apply_filters('pre_user_pass', sanitize_text_field($_POST['user_password'])),
        'user_nicename' => apply_filters('pre_user_nicename', sanitize_text_field($_POST['user_name'])),
        'user_email' => apply_filters('pre_user_email', sanitize_text_field($_POST['user_email'])),
    ];
    $user_id = wp_insert_user($data);
    if (!is_wp_error($user_id)) {
        add_user_meta($user_id, '_phone', $_SESSION['current_user_phone']);
        // ارسال پیامک 
        wp_mr_send_sms($_POST['user_name'],$_SESSION['current_user_phone'], '311506');
        unset($_SESSION['current_user_phone']);
        unset($_SESSION['current_user_phone']);
        $credentials = array(
            'user_login'    =>$data['user_login'],
            'user_password' => $data['user_pass'],
            'remember'      => true // اگر بخواهید کاربر به خاطر شود، این مقدار را روی true قرار دهید
        );
    
        // احراز هویت کاربر
       wp_signon($credentials, is_ssl());
    } else {
        wp_send_json([
            'error' => true,
            'message' => 'خطایی در ثبت نام صورت گرفت',
        ], status_code: 403);
    }

}
function wp_mr_validate_phone($phone)
{
    if (!preg_match('/^(00|09|\+)[0-9]{8,12}$/', $phone)) {
        wp_send_json([
            'error' => true,
            'message' => 'لطفا شماره موبایل را وارد نمایید'
        ], 403);
    }
}
function wp_mr_validate_user_register($data)
{
    if ($data['user_name'] == '') {
        wp_send_json([
            'error' => true,
            'message' => 'نام خود را وارد نمایید',
        ], 403);
    }
    if (username_exists($data['user_name'])) {
        wp_send_json([
            'error' => true,
            'message' => 'این نام کاربری قبلا ثبت شده است',
        ], 403);
    }
    if (!is_email($data['user_email']) && $data['user_email'] == '') {
        wp_send_json([
            'error' => true,
            'message' => 'ایمیل معتبر وارد نمایید',
        ], 403);
    }

    if (email_exists($data['user_email'])) {
        wp_send_json([
            'error' => true,
            'message' => 'ایمیل مورد نظر قبلا ثبت شده است',
        ], 403);
    }
    if ($data['user_password'] == '') {
        wp_send_json([
            'error' => true,
            'message' => 'رمز عبور خود را وارد نمایید',
        ], 403);
    }
    if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z]).{7,24}$/', $data['user_password'])) {
        wp_send_json([
            'error' => true,
            'message' => 'رمز عبور شما باید شامل 6 حرف و حروف انگلیسی و اعداد باشد',
        ], 403);
    }
}
function wp_mr_add_verification_code_phone($phone, $verification_code)
{
    global $wpdb;
    $table = $wpdb->prefix . 'login_register_verify_code';
    $stmt = $wpdb->get_row($wpdb->prepare("SELECT phone FROM {$table} WHERE phone = '%s'", $phone));
    if ($stmt) {
        $data = [
            'verification_code' => $verification_code,
        ];
        $where = ['phone' => $phone];
        $format = ['%s'];
        $where_format = ['%s'];
        $wpdb->update($table, $data, $where, $format, $where_format);
    } else {
        $data = [
            'verification_code' => $verification_code,
            'phone' => $phone
        ];
        $format = ['%s', '%s'];
        $wpdb->insert($table, $data, $format);

    }


}