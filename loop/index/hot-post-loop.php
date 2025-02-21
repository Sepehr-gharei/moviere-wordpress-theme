<?php

$args = array(
    'posts_per_page' => 10,
    'category_name' => 'movies', // دسته‌بندی 'featured'
    'post_type' => 'post',
    'date_query' => array(
        array(
            'after' => '1 month ago',
        ),
    ),
    'orderby' => 'comment_count',
    'order' => 'DESC',
);
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
    <?php while ($the_query->have_posts()):
        $the_query->the_post(); ?>
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
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <div class="alert alert-info">تاکنون مطلبی ارسال نشده</div>
<?php endif; ?>