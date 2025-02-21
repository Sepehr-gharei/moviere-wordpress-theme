<?php
// گرفتن نام پست جاری و تبدیل به حروف کوچک
$current_post_title = strtolower(get_the_title());


$args = array(
    'post_type' => 'casts',
    'cast_tag' => $current_post_title,

);
$casts = new WP_Query($args);

// شروع لوپ برای نمایش تایتل‌های پست‌ها
if ($casts->have_posts()) {
    while ($casts->have_posts()) {
        $casts->the_post();
        ?>
        <div class="swiper-slide">
            <div class="position-relative swiper-header-slide">
                <?php if (has_post_thumbnail()) {
                    $thumbnail_url = get_the_post_thumbnail_url();
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
                }
                ?>
                <h4><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php echo get_the_title() ?></a></h4>
            </div>
        </div>
        <?php
    }
    wp_reset_postdata();
}

