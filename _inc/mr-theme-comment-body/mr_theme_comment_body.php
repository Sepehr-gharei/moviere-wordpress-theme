<?php
// عملیات لایک و دیسلایک با AJAX
function handle_like_dislike()
{
    check_ajax_referer('like_dislike_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error('لطفاً ابتدا لاگین کنید.');
    }

    $comment_id = intval($_POST['comment_id']);
    $action = sanitize_text_field($_POST['action_type']);
    $user_id = get_current_user_id();

    // بررسی اینکه آیا کاربر قبلاً به این کامنت رای داده است یا خیر
    $user_votes = get_user_meta($user_id, 'user_votes', true);
    if (empty($user_votes)) {
        $user_votes = array();
    }

    if (in_array($comment_id, $user_votes)) {
        wp_send_json_error('شما قبلاً به این کامنت رای داده‌اید.');
    }

    if ($action === 'like' || $action === 'dislike') {
        $meta_key = ($action === 'like') ? 'like_count' : 'dislike_count';
        $current_count = get_comment_meta($comment_id, $meta_key, true);

        if (!$current_count) {
            $current_count = 0;
        }

        $new_count = $current_count + 1;
        update_comment_meta($comment_id, $meta_key, $new_count);

        // ذخیره اطلاعات رای کاربر
        $user_votes[] = $comment_id;
        update_user_meta($user_id, 'user_votes', $user_votes);

        wp_send_json_success(array(
            'count' => $new_count
        ));
    }

    wp_send_json_error('عملیات نامعتبر.');
}
add_action('wp_ajax_like_dislike', 'handle_like_dislike');
add_action('wp_ajax_nopriv_like_dislike', 'handle_like_dislike');

// نمایش دکمه‌های لایک و دیسلایک در کامنت‌ها
function display_like_dislike_buttons($comment_id)
{
    $like_count = get_comment_meta($comment_id, 'like_count', true);
    $dislike_count = get_comment_meta($comment_id, 'dislike_count', true);

    $like_count = ($like_count) ? $like_count : 0;
    $dislike_count = ($dislike_count) ? $dislike_count : 0;

    echo '<div class="like-dislike-buttons">';
    echo '<button class="like-button" data-comment-id="' . esc_attr($comment_id) . '"><i class="fa fa-thumbs-up" aria-hidden="true"></i>' . esc_html($like_count) . '</button>';
    echo '<button class="dislike-button" data-comment-id="' . esc_attr($comment_id) . '"><i class="fa fa-thumbs-down" aria-hidden="true"></i>' . esc_html($dislike_count) . '</button>';
    echo '</div>';
}

// افزودن دکمه‌ها به قالب کامنت کاستوم

function mr_theme_comment($comment, $args)
{
    $comment = $GLOBALS['comment'];

    ?>
    <li id="comment-<?php echo $comment->comment_ID ?>" <?php comment_class() ?>>
        <div class="comment-item" id="comment-id-1">
            <div class="d-block d-lg-flex">
                <div class="col-12 col-lg-3 d-flex reply-and-prof align-items-center justify-content-around">
                    <a href="#comment-form" data-comment-id="<?php echo $comment->comment_ID; ?> "
                        class="col-6 d-flex justify-content-start justify-content-lg-center reply">
                        <i class="fa-solid fa-reply"></i>
                    </a>


                    <div class="col-6 d-flex justify-content-end justify-content-lg-start">
                        <?php echo get_avatar($comment->comment_author_email, 90, '', $comment->comment_author) ?>
                    </div>
                </div>
                <div class="col-12 col-lg-9
               
                ">

                    <div class="col-12 name-date d-flex">
                        <div class="name col-10 "><?php echo $comment->comment_author ?></div>
                        <div class="date col-2 text-center"><?php echo get_comment_date('j F, Y') ?></div>
                    </div>
                    <div class="col-12 text-like d-flex">
                        <div class="col-10 text position-relative">
                            <p class="" id="text">
                                <?php echo $comment->comment_content ?>
                            </p>
                            <div class="position-absolute d-none" id="spoil-alert">
                                <p>این کامت حاوی اسپویل میباشد !</p>
                                <div id="btn-show-spoil-comment">مشاهده کامنت</div>
                            </div>
                        </div>
                        <div class="like-dislike-container">
                            <?php display_like_dislike_buttons($comment->comment_ID); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php
}