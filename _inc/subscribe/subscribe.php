<?php
function add_custom_admin_menu() {
    add_menu_page(
        'اشتراکین',
        'اشتراکین',
        'manage_options',
        'subscriptions',
        'subscriptions_main_page',
        'dashicons-groups',
        6
    );

    add_submenu_page(
        'subscriptions',
        'اشتراک ها',
        'اشتراک ها',
        'manage_options',
        'subscriptions',
        'subscriptions_main_page'
    );

    add_submenu_page(
        'subscriptions',
        'کاربران اشتراکی',
        'کاربران اشتراکی',
        'manage_options',
        'subscription_users',
        'subscription_users_page'
    );

    add_submenu_page(
        'subscriptions',
        'اضافه کردن کاربر اشتراکی',
        'اضافه کردن کاربر اشتراکی',
        'manage_options',
        'add_subscription_user',
        'add_subscription_user_page'
    );
}
add_action('admin_menu', 'add_custom_admin_menu');

function subscriptions_main_page() {
    ?>
    <div class="wrap">
        <h1>اشتراک‌ها</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('subscriptions_group');
            do_settings_sections('subscriptions');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function subscription_users_page() {
    echo '<div class="wrap"><h1>کاربران اشتراکی</h1></div>';
}

function add_subscription_user_page() {
    echo '<div class="wrap"><h1>اضافه کردن کاربر اشتراکی</h1></div>';
}

function subscriptions_settings() {
    register_setting('subscriptions_group', 'subscription_options', 'subscriptions_sanitize');

    add_settings_section('subscriptions_section', 'مدیریت اشتراک‌ها', 'subscriptions_section_text', 'subscriptions');

    add_settings_field('base_subscription', 'اشتراک پایه', 'base_subscription_input', 'subscriptions', 'subscriptions_section');
    add_settings_field('silver_subscription', 'اشتراک نقره‌ای', 'silver_subscription_input', 'subscriptions', 'subscriptions_section');
    add_settings_field('gold_subscription', 'اشتراک طلایی', 'gold_subscription_input', 'subscriptions', 'subscriptions_section');
}
add_action('admin_init', 'subscriptions_settings');

function subscriptions_section_text() {
    echo '<p>قیمت‌های اشتراک‌ها را وارد کنید:</p>';
}

function base_subscription_input() {
    $options = get_option('subscription_options', array());
    $base_features = isset($options['base_features']) && is_array($options['base_features']) ? $options['base_features'] : [];

    echo '<label for="base_month1">قیمت ماه اول:</label>';
    echo '<input id="base_month1" name="subscription_options[base_month1]" value="' . esc_attr($options['base_month1'] ?? '') . '" />';
    echo '<br>';
    echo '<label for="base_month3">قیمت ماه سوم:</label>';
    echo '<input id="base_month3" name="subscription_options[base_month3]" value="' . esc_attr($options['base_month3'] ?? '') . '" />';
    echo '<br>';
    echo '<label for="base_year1">قیمت یک ساله:</label>';
    echo '<input id="base_year1" name="subscription_options[base_year1]" value="' . esc_attr($options['base_year1'] ?? '') . '" />';
    echo '<br>';

    echo '<label><input type="checkbox" name="subscription_options[base_features][]" value="دانلود مستقیم"' . (in_array('دانلود مستقیم', $base_features) ? ' checked' : '') . '> دانلود مستقیم</label><br>';
    echo '<label><input type="checkbox" name="subscription_options[base_features][]" value="تماشای آنلاین"' . (in_array('تماشای آنلاین', $base_features) ? ' checked' : '') . '> تماشای آنلاین</label><br>';
    echo '<label><input type="checkbox" name="subscription_options[base_features][]" value="اولویت درخواست فیلم"' . (in_array('اولویت درخواست فیلم', $base_features) ? ' checked' : '') . '> اولویت درخواست فیلم</label><br>';
}

function silver_subscription_input() {
    $options = get_option('subscription_options', array());
    $silver_features = isset($options['silver_features']) && is_array($options['silver_features']) ? $options['silver_features'] : [];

    echo '<label for="silver_month1">قیمت ماه اول:</label>';
    echo '<input id="silver_month1" name="subscription_options[silver_month1]" value="' . esc_attr($options['silver_month1'] ?? '') . '" />';
    echo '<br>';
    echo '<label for="silver_month3">قیمت ماه سوم:</label>';
    echo '<input id="silver_month3" name="subscription_options[silver_month3]" value="' . esc_attr($options['silver_month3'] ?? '') . '" />';
    echo '<br>';
    echo '<label for="silver_year1">قیمت یک ساله:</label>';
    echo '<input id="silver_year1" name="subscription_options[silver_year1]" value="' . esc_attr($options['silver_year1'] ?? '') . '" />';
    echo '<br>';

    echo '<label><input type="checkbox" name="subscription_options[silver_features][]" value="دانلود مستقیم"' . (in_array('دانلود مستقیم', $silver_features) ? ' checked' : '') . '> دانلود مستقیم</label><br>';
    echo '<label><input type="checkbox" name="subscription_options[silver_features][]" value="تماشای آنلاین"' . (in_array('تماشای آنلاین', $silver_features) ? ' checked' : '') . '> تماشای آنلاین</label><br>';
    echo '<label><input type="checkbox" name="subscription_options[silver_features][]" value="اولویت درخواست فیلم"' . (in_array('اولویت درخواست فیلم', $silver_features) ? ' checked' : '') . '> اولویت درخواست فیلم</label><br>';
}

function gold_subscription_input() {
    $options = get_option('subscription_options', array());
    $gold_features = isset($options['gold_features']) && is_array($options['gold_features']) ? $options['gold_features'] : [];

    echo '<label for="gold_month1">قیمت ماه اول:</label>';
    echo '<input id="gold_month1" name="subscription_options[gold_month1]" value="' . esc_attr($options['gold_month1'] ?? '') . '" />';
    echo '<br>';
    echo '<label for="gold_month3">قیمت ماه سوم:</label>';
    echo '<input id="gold_month3" name="subscription_options[gold_month3]" value="' . esc_attr($options['gold_month3'] ?? '') . '" />';
    echo '<br>';
    echo '<label for="gold_year1">قیمت یک ساله:</label>';
    echo '<input id="gold_year1" name="subscription_options[gold_year1]" value="' . esc_attr($options['gold_year1'] ?? '') . '" />';
    echo '<br>';

    echo '<label><input type="checkbox" name="subscription_options[gold_features][]" value="دانلود مستقیم"' . (in_array('دانلود مستقیم', $gold_features) ? ' checked' : '') . '> دانلود مستقیم</label><br>';
    echo '<label><input type="checkbox" name="subscription_options[gold_features][]" value="تماشای آنلاین"' . (in_array('تماشای آنلاین', $gold_features) ? ' checked' : '') . '> تماشای آنلاین</label><br>';
    echo '<label><input type="checkbox" name="subscription_options[gold_features][]" value="اولویت درخواست فیلم"' . (in_array('اولویت درخواست فیلم', $gold_features) ? ' checked' : '') . '> اولویت درخواست فیلم</label><br>';
}

function subscriptions_sanitize($input) {
    $new_input = array();
    foreach ($input as $key => $value) {
        if (is_array($value)) {
            $new_input[$key] = array_map('sanitize_text_field', $value);
        } else {
            $new_input[$key] = sanitize_text_field($value);
        }
    }
    return $new_input;
}