<?php

// افزودن متاباکس
function add_subtitle_meta_box()
{
    add_meta_box(
        'subtitle_meta_box', // شناسه
        'وضعیت زیرنویس فیلم', // عنوان
        'display_subtitle_meta_box', // تابع نمایش محتوا
        '',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_subtitle_meta_box');

// نمایش محتوای متاباکس
function display_subtitle_meta_box($post)
{
    $subtitle_status = get_post_meta($post->ID, 'subtitle_status', true);
    ?>
    <label><input type="radio" name="subtitle_status" value="yes" <?php checked($subtitle_status, 'yes'); ?> />
        دارد</label><br>
    <label><input type="radio" name="subtitle_status" value="no" <?php checked($subtitle_status, 'no'); ?> /> ندارد</label>
    <?php
}

// ذخیره داده‌های متاباکس
function save_subtitle_meta_box_data($post_id)
{
    // بررسی معتبر بودن درخواست
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!isset($_POST['subtitle_status']))
        return;

    // ذخیره وضعیت زیرنویس
    update_post_meta($post_id, 'subtitle_status', $_POST['subtitle_status']);
}
add_action('save_post', 'save_subtitle_meta_box_data');


function mr_movie_id()
{
    add_meta_box(
        'my_metabox_id',          // شناسه متاباکس
        'enter movie ID',          // عنوان متاباکس
        'mr_movie_id_html',    // تابعی که محتوای متاباکس را تولید می‌کند
        '',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'mr_movie_id');

function mr_movie_id_html($post)
{
    // دریافت مقدار متای ذخیره‌شده
    $value = get_post_meta($post->ID, '_my_input_value_key', true);
    ?>
    <label for="my_input_field">فیلد من:</label>
    <input type="text" id="my_input_field" name="my_input_field" value="<?php echo esc_attr($value); ?>" size="25" />
    <?php
}

// ذخیره‌سازی داده‌های متاباکس
function save_mr_movie_id_html($post_id)
{
    if (!isset($_POST['my_input_field'])) {
        return;
    }
    $my_data = sanitize_text_field($_POST['my_input_field']);
    update_post_meta($post_id, '_my_input_value_key', $my_data);
}
add_action('save_post', 'save_mr_movie_id_html');



function add_movie_title_metabox()
{
    add_meta_box(
        'movie_title_metabox',
        __('نام فارسی فیلم', 'textdomain'),
        'display_movie_title_metabox',
        '',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_movie_title_metabox');

function display_movie_title_metabox($post)
{
    $movie_title = get_post_meta($post->ID, 'movie_title', true);
    echo '<label for="movie_title">';
    _e('نام فارسی فیلم', 'textdomain');
    echo '</label> ';
    echo '<input type="text" id="movie_title" name="movie_title" value="' . esc_attr($movie_title) . '" size="25" />';
}

function save_movie_title_metabox($post_id)
{
    if (array_key_exists('movie_title', $_POST)) {
        update_post_meta(
            $post_id,
            'movie_title',
            sanitize_text_field($_POST['movie_title'])
        );
    }
}
add_action('save_post', 'save_movie_title_metabox');







function imdb_score_meta_box()
{
    add_meta_box(
        'imdb_score',
        'IMDB Score',
        'imdb_score_meta_box_callback',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'imdb_score_meta_box');

function imdb_score_meta_box_callback($post)
{
    $meta_value = get_post_meta($post->ID, '_my_input_value_key', true);
    $movie_details = get_movie_details($meta_value);
    $imdb_score = isset($movie_details->imdbRating) ? $movie_details->imdbRating : '';

    // ذخیره نمره IMDB به عنوان متا داده
    update_post_meta($post->ID, '_imdb_score', $imdb_score);

    ?>
    <label for="imdb_score">IMDB Score:</label>
    <input type="text" id="imdb_score" value="<?php echo esc_attr($imdb_score); ?>" readonly />
    <?php
}



function  movie_year_meta_box()
{
    add_meta_box(
        'movie_year',
        'movie year',
        'movie_year_meta_box_callback',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'movie_year_meta_box');

function movie_year_meta_box_callback($post)
{
    $meta_value = get_post_meta($post->ID, '_my_input_value_key', true);
    $movie_details = get_movie_details($meta_value);
    $movie_year = isset($movie_details->Year) ? $movie_details->Year : '';

    // ذخیره نمره IMDB به عنوان متا داده
    update_post_meta($post->ID, '_movie_year',  $movie_year);

    ?>
    <label for="movie_year">IMDB Score:</label>
    <input type="text" id="movie_year" value="<?php echo esc_attr($movie_year); ?>" readonly />
    <?php
}




function add_gender_metabox() {
    add_meta_box(
        'gender_metabox', // ID متاباکس
        'جنسیت بازیگر', // عنوان متاباکس
        'render_gender_metabox', // تابعی که محتوای متاباکس را رندر می‌کند
        'casts', // پست تایپ مورد نظر
        'side', // موقعیت متاباکس (side, normal, advanced)
        'default' // اولویت نمایش متاباکس
    );
}
add_action('add_meta_boxes', 'add_gender_metabox');
function render_gender_metabox($post) {
    // دریافت مقدار فعلی متا فیلد
    $gender = get_post_meta($post->ID, '_gender', true);

    // ایجاد یک nonce برای امنیت
    wp_nonce_field('gender_metabox_nonce', 'gender_metabox_nonce');

    // ایجاد select option
    echo '<label for="gender">جنسیت بازیگر:</label>';
    echo '<select id="gender" name="gender">';
    echo '<option value="male"' . selected($gender, 'male', false) . '>مرد</option>';
    echo '<option value="female"' . selected($gender, 'female', false) . '>زن</option>';
    echo '</select>';
}
function save_gender_metabox($post_id) {
    // بررسی nonce برای امنیت
    if (!isset($_POST['gender_metabox_nonce']) || !wp_verify_nonce($_POST['gender_metabox_nonce'], 'gender_metabox_nonce')) {
        return;
    }

    // بررسی اینکه آیا کاربر مجاز به ذخیره‌سازی داده‌ها است
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // ذخیره‌سازی مقدار select option
    if (isset($_POST['gender'])) {
        update_post_meta($post_id, '_gender', sanitize_text_field($_POST['gender']));
    }
}
add_action('save_post', 'save_gender_metabox');


