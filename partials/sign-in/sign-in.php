<?php
// تنظیمات WP_Query برای گرفتن پست‌های دسته‌بندی "featured"
$args = array(
    'category_name' => 'featured-movies', // نام دسته‌بندی
    'posts_per_page' => 1,        // تعداد پست‌ها (-1 به معنای تمام پست‌ها)
);

// اجرای WP_Query
$featured_query = new WP_Query($args);

// بررسی وجود پست‌ها
if ($featured_query->have_posts()):
    while ($featured_query->have_posts()):
        $featured_query->the_post();
        // بررسی وجود تصویر تامبنیل
        if (has_post_thumbnail()):
            ?>
            <div class="item active">
            <?php if (has_post_thumbnail()) {
                        $thumbnail_url = get_the_post_thumbnail_url();
                        echo '<img  src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
                    }
                    ?>
                <div class="content w-100 mt-5">
                    <h2 class="text-center w-100">
                        <div class="d-flex sign-in-container justify-content-center">
                            <div class="d-none d-md-block img-container">
                               
                                    <?php
// لوپ برای نمایش پست‌های نوع 'casts' بر اساس تعداد تگ‌ها
$args = array(
    'post_type'      => 'casts', // نوع پست
    'posts_per_page' => 1,      // تمام پست‌ها
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    // آرایه‌ای برای ذخیره پست‌ها و تعداد تگ‌ها
    $posts_with_tags_count = array();

    // حلقه برای استخراج پست‌ها و تعداد تگ‌ها
    while ($query->have_posts()) {
        $query->the_post();
        $tags = get_the_tags(); // دریافت تگ‌های پست
        $tag_count = $tags ? count($tags) : 0; // تعداد تگ‌ها

        // اطلاعات پست و تعداد تگ‌ها را در آرایه ذخیره می‌کنیم
        $posts_with_tags_count[] = array(
            'id'        => get_the_ID(),
            'tag_count' => $tag_count,
        );
    }

    // مرتب‌سازی پست‌ها بر اساس تعداد تگ‌ها به صورت نزولی
    usort($posts_with_tags_count, function ($a, $b) {
        return $b['tag_count'] - $a['tag_count'];
    });

    // نمایش پست‌ها بر اساس ترتیب جدید
    foreach ($posts_with_tags_count as $post_info) {
        $post_id = $post_info['id'];
        $post = get_post($post_id); // دریافت پست بر اساس ID
        setup_postdata($post); // تنظیم داده‌های پست

        // نمایش تصویر تامبنیل
        if (has_post_thumbnail()) {
            if (has_post_thumbnail()) {
                $thumbnail_url = get_the_post_thumbnail_url();
                echo '<img class="w-100"  src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
            }
        }
    }

    wp_reset_postdata(); // بازگرداندن داده‌های پست به حالت اولیه
} 
?>
                                   
                            </div>
                            <div class="form-container">
                                <form id="signup-form" method="post">
                                    <div id="get_user_phone">
                                        <div class="input-item" id="user-phone-number">
                                            <label for="phone">شماره تلفن:</label>
                                            <input type="text" class="phone" value="" name="phone" />
                                        </div>
                                        <div class="input-item" id="varification-code">
                                            <label for="verification_code">کد تایید:</label>
                                            <input type="text" class="verification_code" name="verification_code" value="" />
                                        </div>
                                        <div class="button">
                                            <a href="" class="" id="send_code">ارسال کد تایید</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </h2>
                </div>
            </div>
            <?php
        endif;
    endwhile;
    // بازگرداندن داده‌های جهانی پست به حالت اولیه
    wp_reset_postdata();
else:
    echo '<p>هیچ پستی در دسته‌بندی "featured" وجود ندارد.</p>';
endif;
?>


