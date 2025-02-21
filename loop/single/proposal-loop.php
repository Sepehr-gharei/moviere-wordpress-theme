<?php
// دریافت برچسب‌های پست جاری
$current_post_id = get_the_ID();
$current_post_tags = wp_get_post_tags($current_post_id);
$tag_ids = array();

if ($current_post_tags) {
    foreach ($current_post_tags as $tag) {
        $tag_ids[] = $tag->term_id;
    }

    // تنظیمات آرگومان‌های کوئری
    $args = array(
        'post_type' => 'post',
        'post__not_in' => array($current_post_id), // عدم نمایش پست جاری
        'posts_per_page' => 15, // تعداد پست‌های مورد نظر
        
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tag_ids,
                'operator' => 'IN',
            ),
        ),
    );

    // اجرای کوئری
    $query = new WP_Query($args);

    // بررسی وجود پست‌ها
    if ($query->have_posts()) {

        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="swiper-slide">
                <div class="position-relative swiper-header-slide">
                    <a href="<?php the_permalink() ?>">
                        <img src="<?php
                        movie_data('Poster');
                        ?>" alt="<?php
                        movie_data('Title');
                        ?>" />
                    </a>
                    <h4><a href=<?php the_permalink() ?>><?php
                      movie_data('Title');
                      ?></a></h4>
                    <span class="imdb">
                        <span><?php
                        movie_data('imdbRating');
                        ?>/
                            <p>10</p>
                        </span>
                        <img src="<?php echo get_template_directory_uri() . './assets/image/IMDB_Logo_2016.svg' ?>" alt="" />
                    </span>
                    <?php
                    // گرفتن وضعیت زیرنویس از متاباکس
                    $subtitle_status = get_post_meta(get_the_ID(), 'subtitle_status', true);

                    if ($subtitle_status) {
                        if ($subtitle_status === 'yes') {
                            echo '<span class="subtitle">
                    <i class="fa-solid fa-closed-captioning"></i>
                </span>';
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }

    } else {
        echo '<p>هیچ پستی یافت نشد.</p>';
    }

    // بازنشانی کوئری
    wp_reset_postdata();
} else {
    echo '<p>این پست برچسبی ندارد.</p>';
}
?>