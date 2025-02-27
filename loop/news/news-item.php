<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
$args = array(
    'posts_per_page' => 4,
    'post_type'      => 'news',
    'paged'          => $paged,
);
$the_query = new WP_Query($args);

?>

<?php if ($the_query->have_posts()): ?>
    <?php while ($the_query->have_posts()):
        $the_query->the_post(); ?>
        <div class="item col-12 col-md-5 m-2 py-2">
            <div class="image-container item col-12 p-2">
                <?php if (has_post_thumbnail()) {
                    $thumbnail_url = get_the_post_thumbnail_url();
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
                }
                ?>
            </div>
            <div class="content-container d-flex flex-column justify-content-between flex-wrap item col-12 p-2">
                <div class="text">
                    <a href="<?php the_permalink() ?>">
                        <h4><?php echo get_news_title(get_the_title()) ?></h4>
                    </a>
                    <p>
                        <?php echo get_news_content(get_the_content()) ?>
                    </p>
                </div>
                <div class="date-and-time-to-read d-flex">
                    <div class="col-6">
                        <i class="fa-regular fa-calendar-days"></i> <?php echo human_time_diff_for_post(get_the_ID()) ?>
                    </div>
                    <div class="col-6">
                        <i class="fa-regular fa-clock"></i> زمان مطالعه: <?php echo calculateReadingTime(get_the_content()) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <!-- Pagination -->
    <div class="pagination d-flex justify-content-center mt-4">
        <?php
        $big = 999999999; // عدد بزرگ برای جایگزینی % في لينک‌ها
        echo paginate_links(array(
            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'    => '?paged=%#%',
            'current'   => max(1, get_query_var('paged')),
            'total'     => $the_query->max_num_pages,
            'prev_text' => __('قبلی'),
            'next_text' => __('بعدی'),
        ));
        ?>
    </div>

    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <div class="alert alert-info">تاکنون مطلبی ارسال نشده</div>
<?php endif; ?>