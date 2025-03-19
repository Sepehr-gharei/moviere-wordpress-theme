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



function movie_year_meta_box()
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
    update_post_meta($post->ID, '_movie_year', $movie_year);

    ?>
    <label for="movie_year">IMDB Score:</label>
    <input type="text" id="movie_year" value="<?php echo esc_attr($movie_year); ?>" readonly />
    <?php
}




function add_gender_metabox()
{
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
function render_gender_metabox($post)
{
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
function save_gender_metabox($post_id)
{
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




function custom_series_download_add_meta_box()
{
    global $post;
    $categories = get_the_category($post->ID);
    $show_meta_box = false;

    foreach ($categories as $category) {
        if ($category->slug == 'series') {
            $show_meta_box = true;
            break;
        }
    }

    if ($show_meta_box) {
        add_meta_box(
            'custom_series_download_meta_box',       // Unique ID
            'Custom Series Download Links',       // Box title
            'custom_series_download_meta_box_html',  // Content callback, must be of type callable
            'post'                   // Post type
        );
    }
}
add_action('add_meta_boxes', 'custom_series_download_add_meta_box');

function custom_series_download_meta_box_html($post)
{
    wp_nonce_field('custom_series_download_save_meta_box_data', 'custom_series_download_meta_box_nonce');

    $season_data = get_post_meta($post->ID, '_season_data', true);
    ?>
    <div id="season-container">
        <?php
        if (!empty($season_data)) {
            foreach ($season_data as $index => $season) {
                ?>
                <div class="season">
                    <h4>فصل <?php echo $index + 1; ?></h4>
                    <div class="qualities">
                        <?php
                        if (!empty($season['qualities'])) {
                            foreach ($season['qualities'] as $quality_index => $quality) {
                                ?>
                                <div class="quality">
                                    <h5>کیفیت <?php echo $quality_index + 1; ?></h5>
                                    <label for="season_<?php echo $index; ?>_quality_<?php echo $quality_index; ?>">کیفیت:</label>
                                    <input type="text" name="season[<?php echo $index; ?>][qualities][<?php echo $quality_index; ?>][name]"
                                        id="season_<?php echo $index; ?>_quality_<?php echo $quality_index; ?>"
                                        value="<?php echo esc_attr($quality['name']); ?>" />
                                    <label for="season_<?php echo $index; ?>_quality_<?php echo $quality_index; ?>_subtitle">زیرنویس
                                        دارد:</label>
                                    <input type="checkbox"
                                        name="season[<?php echo $index; ?>][qualities][<?php echo $quality_index; ?>][subtitle]"
                                        id="season_<?php echo $index; ?>_quality_<?php echo $quality_index; ?>_subtitle" <?php echo isset($quality['subtitle']) && $quality['subtitle'] ? 'checked' : ''; ?> />
                                    <div class="episodes">
                                        <?php
                                        if (!empty($quality['episodes'])) {
                                            foreach ($quality['episodes'] as $ep_index => $episode) {
                                                ?>
                                                <div class="episode">
                                                    <p>قسمت <?php echo $ep_index + 1; ?>:</p>
                                                    <label
                                                        for="season_<?php echo $index; ?>_quality_<?php echo $quality_index; ?>_episode_<?php echo $ep_index; ?>_link">لینک:</label>
                                                    <input type="text"
                                                        name="season[<?php echo $index; ?>][qualities][<?php echo $quality_index; ?>][episodes][<?php echo $ep_index; ?>][link]"
                                                        id="season_<?php echo $index; ?>_quality_<?php echo $quality_index; ?>_episode_<?php echo $ep_index; ?>_link"
                                                        value="<?php echo esc_attr($episode['link']); ?>" />
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <button type="button" class="add-episode" data-season-index="<?php echo $index; ?>"
                                        data-quality-index="<?php echo $quality_index; ?>">افزودن قسمت</button>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <button type="button" class="add-quality" data-season-index="<?php echo $index; ?>">افزودن کیفیت</button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button type="button" id="add-season">افزودن فصل</button>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let seasonIndex = <?php echo empty($season_data) ? 0 : count($season_data); ?>;
            document.getElementById('add-season').addEventListener('click', function () {
                let container = document.getElementById('season-container');
                let div = document.createElement('div');
                div.classList.add('season');
                div.innerHTML = '<h4>فصل ' + (seasonIndex + 1) + '</h4>' +
                    '<div class="qualities"></div>' +
                    '<button type="button" class="add-quality" data-season-index="' + seasonIndex + '">افزودن کیفیت</button>';
                container.appendChild(div);
                seasonIndex++;
            });

            document.getElementById('season-container').addEventListener('click', function (event) {
                if (event.target.classList.contains('add-quality')) {
                    let seasonIndex = event.target.getAttribute('data-season-index');
                    let qualitiesDiv = event.target.previousElementSibling;
                    let qualityIndex = qualitiesDiv.children.length;
                    let div = document.createElement('div');
                    div.classList.add('quality');
                    div.innerHTML = '<h5>کیفیت ' + (qualityIndex + 1) + '</h5>' +
                        '<label for="season_' + seasonIndex + '_quality_' + qualityIndex + '">کیفیت:</label>' +
                        '<input type="text" name="season[' + seasonIndex + '][qualities][' + qualityIndex + '][name]" id="season_' + seasonIndex + '_quality_' + qualityIndex + '" />' +
                        '<label for="season_' + seasonIndex + '_quality_' + qualityIndex + '_subtitle">زیرنویس دارد:</label>' +
                        '<input type="checkbox" name="season[' + seasonIndex + '][qualities][' + qualityIndex + '][subtitle]" id="season_' + seasonIndex + '_quality_' + qualityIndex + '_subtitle" />' +
                        '<div class="episodes"></div>' +
                        '<button type="button" class="add-episode" data-season-index="' + seasonIndex + '" data-quality-index="' + qualityIndex + '">افزودن قسمت</button>';
                    qualitiesDiv.appendChild(div);
                }

                if (event.target.classList.contains('add-episode')) {
                    let seasonIndex = event.target.getAttribute('data-season-index');
                    let qualityIndex = event.target.getAttribute('data-quality-index');
                    let episodesDiv = event.target.previousElementSibling;
                    let episodeIndex = episodesDiv.children.length;
                    let div = document.createElement('div');
                    div.classList.add('episode');
                    div.innerHTML = '<p>قسمت ' + (episodeIndex + 1) + ':</p>' +
                        '<label for="season_' + seasonIndex + '_quality_' + qualityIndex + '_episode_' + episodeIndex + '_link">لینک:</label>' +
                        '<input type="text" name="season[' + seasonIndex + '][qualities][' + qualityIndex + '][episodes][' + episodeIndex + '][link]" id="season_' + seasonIndex + '_quality_' + qualityIndex + '_episode_' + episodeIndex + '_link" />';
                    episodesDiv.appendChild(div);
                }
            });
        });
    </script>
    <?php
}

function custom_series_download_save_meta_box_data($post_id)
{
    if (!isset($_POST['custom_series_download_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['custom_series_download_meta_box_nonce'], 'custom_series_download_save_meta_box_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['season'])) {
        update_post_meta($post_id, '_season_data', $_POST['season']);
    }
}
add_action('save_post', 'custom_series_download_save_meta_box_data');














function movie_link_meta_box_add()
{
    global $post;
    $categories = get_the_category($post->ID);
    $show_meta_box = true;

    foreach ($categories as $category) {
        if ($category->slug == 'series') {
            $show_meta_box = false;
            break;
        }
    }

    if ($show_meta_box) {
        add_meta_box(
            'movie_link_meta_box',       // Unique ID
            'Movie Link Meta Box',       // Box title
            'movie_link_meta_box_html',  // Content callback, must be of type callable
            'post'                       // Post type
        );
    }
}
add_action('add_meta_boxes', 'movie_link_meta_box_add');

function movie_link_meta_box_html($post)
{
    wp_nonce_field('movie_link_meta_box_save', 'movie_link_meta_box_nonce');

    $quality_data = get_post_meta($post->ID, '_quality_data', true);
    ?>
    <div id="quality-container">
        <?php
        if (!empty($quality_data)) {
            foreach ($quality_data as $index => $quality) {
                ?>
                <div class="quality">
                    <h4>کیفیت <?php echo $index + 1; ?></h4>
                    <label for="quality_<?php echo $index; ?>">کیفیت:</label>
                    <input type="text" name="quality[<?php echo $index; ?>][name]" id="quality_<?php echo $index; ?>"
                        value="<?php echo esc_attr($quality['name']); ?>" />
                    <label for="quality_<?php echo $index; ?>_subtitle">زیرنویس دارد:</label>
                    <input type="checkbox" name="quality[<?php echo $index; ?>][subtitle]"
                        id="quality_<?php echo $index; ?>_subtitle" <?php echo isset($quality['subtitle']) && $quality['subtitle'] ? 'checked' : ''; ?> />
                    <div class="episodes">
                        <?php
                        if (!empty($quality['episodes'])) {
                            foreach ($quality['episodes'] as $ep_index => $episode) {
                                ?>
                                <div class="episode">
                                    <p>قسمت <?php echo $ep_index + 1; ?>:</p>
                                    <label for="quality_<?php echo $index; ?>_episode_<?php echo $ep_index; ?>_link">لینک:</label>
                                    <input type="text" name="quality[<?php echo $index; ?>][episodes][<?php echo $ep_index; ?>][link]"
                                        id="quality_<?php echo $index; ?>_episode_<?php echo $ep_index; ?>_link"
                                        value="<?php echo esc_attr($episode['link']); ?>" />
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <button type="button" class="add-episode" data-quality-index="<?php echo $index; ?>">افزودن قسمت</button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button type="button" id="add-quality">افزودن کیفیت</button>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let qualityIndex = <?php echo empty($quality_data) ? 0 : count($quality_data); ?>;
            document.getElementById('add-quality').addEventListener('click', function () {
                let container = document.getElementById('quality-container');
                let div = document.createElement('div');
                div.classList.add('quality');
                div.innerHTML = '<h4>کیفیت ' + (qualityIndex + 1) + '</h4>' +
                    '<label for="quality_' + qualityIndex + '">کیفیت:</label>' +
                    '<input type="text" name="quality[' + qualityIndex + '][name]" id="quality_' + qualityIndex + '" />' +
                    '<label for="quality_' + qualityIndex + '_subtitle">زیرنویس دارد:</label>' +
                    '<input type="checkbox" name="quality[' + qualityIndex + '][subtitle]" id="quality_' + qualityIndex + '_subtitle" />' +
                    '<div class="episodes"></div>' +
                    '<button type="button" class="add-episode" data-quality-index="' + qualityIndex + '">افزودن قسمت</button>';
                container.appendChild(div);
                qualityIndex++;
            });

            document.getElementById('quality-container').addEventListener('click', function (event) {
                if (event.target.classList.contains('add-episode')) {
                    let qualityIndex = event.target.getAttribute('data-quality-index');
                    let episodesDiv = event.target.previousElementSibling;
                    let episodeIndex = episodesDiv.children.length;
                    let div = document.createElement('div');
                    div.classList.add('episode');
                    div.innerHTML = '<p>قسمت ' + (episodeIndex + 1) + ':</p>' +
                        '<label for="quality_' + qualityIndex + '_episode_' + episodeIndex + '_link">لینک:</label>' +
                        '<input type="text" name="quality[' + qualityIndex + '][episodes][' + episodeIndex + '][link]" id="quality_' + qualityIndex + '_episode_' + episodeIndex + '_link" />';
                    episodesDiv.appendChild(div);
                }
            });
        });
    </script>
    <?php
}

function movie_link_meta_box_save($post_id)
{
    if (!isset($_POST['movie_link_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['movie_link_meta_box_nonce'], 'movie_link_meta_box_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['quality'])) {
        update_post_meta($post_id, '_quality_data', $_POST['quality']);
    }
}
add_action('save_post', 'movie_link_meta_box_save');



// اضافه کردن فیلد Phone به پروفایل کاربری
function add_phone_to_profile($user)
{
    ?>
    <h3><?php _e("اطلاعات تماس", "textdomain"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="phone"><?php _e("شماره تلفن"); ?></label></th>
            <td>
                <input type="text" name="phone" id="phone"
                    value="<?php echo esc_attr(get_the_author_meta('phone', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e("لطفاً شماره تلفن خود را وارد کنید."); ?></span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_phone_to_profile');
add_action('edit_user_profile', 'add_phone_to_profile');

// ذخیره مقدار فیلد Phone در دیتابیس
function save_phone_to_profile($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    if (isset($_POST['phone'])) {
        update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
    }
}
add_action('personal_options_update', 'save_phone_to_profile');
add_action('edit_user_profile_update', 'save_phone_to_profile');

// اضافه کردن فیلد Phone به فرم ثبت نام
function add_phone_to_register_form()
{
    ?>
    <p>
        <label for="phone"><?php _e('شماره تلفن', 'textdomain'); ?><br />
            <input type="text" name="phone" id="phone" class="input" value="<?php echo esc_attr($_POST['phone'] ?? ''); ?>"
                size="25" /></label>
    </p>
    <?php
}
add_action('register_form', 'add_phone_to_register_form');

// اعتبارسنجی فیلد Phone در فرم ثبت نام
function validate_phone_on_registration($errors, $sanitized_user_login, $user_email)
{
    if (empty($_POST['phone'])) {
        $errors->add('phone_error', __('<strong>خطا</strong>: لطفاً شماره تلفن خود را وارد کنید.', 'textdomain'));
    } elseif (!preg_match('/^\d{10,15}$/', $_POST['phone'])) { // اعتبارسنجی فرمت شماره تلفن
        $errors->add('phone_invalid', __('<strong>خطا</strong>: شماره تلفن وارد شده معتبر نیست.', 'textdomain'));
    }
    return $errors;
}
add_filter('registration_errors', 'validate_phone_on_registration', 10, 3);

// ذخیره شماره تلفن در دیتابیس هنگام ثبت نام
function save_phone_on_registration($user_id)
{
    if (!empty($_POST['phone'])) {
        update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
    }
}
add_action('user_register', 'save_phone_on_registration');