<?php
$post_id = get_the_ID(); // یا به صورت دستی ID پست را مشخص کنید
$terms = get_the_terms($post_id, 'cast_tag');

$tags_array = array();

if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $tags_array[] = $term->name; // افزودن نام تگ به آرایه
    }
}
// نمایش آرایه تگ‌ها

$shows = array_map('strtolower', $tags_array);
// ایجاد حلقه سفارشی در وردپرس
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
);

$loop = new WP_Query($args);

if ($loop->have_posts()):
    while ($loop->have_posts()):
        $loop->the_post();
        $post_title = strtolower(get_the_title());

        // بررسی همخوانی نام پست با آرایه
        if (in_array($post_title, $shows)) {
            // نمایش پست
            ?>
            <section class="wrapper-film-profile-artist col-6 col-sm-4  col-lg-3">
                <div class="position-relative wrapper-header-slide">
                    <div class="top-info d-flex justify-content-between">
                        <div class="date"><?php
                        $movie_details = get_movie_details(get_post_meta(get_the_ID(), '_my_input_value_key', true));
                        if ($movie_details) {

                            $year = $movie_details->Year;

                            $number_string = strval($year);

                            // گرفتن چهار رقم اول
                            $first_four_digits = substr($number_string, 0, 4);

                            // نمایش نتیجه
                            echo $first_four_digits;

                        }

                        ?></div>
                        <div class="rating d-flex">
                            <img src="<?php echo get_template_directory_uri() . './assets/image/IMDB_Logo_2016.svg' ?>" alt="" />
                            <p><?php
                            movie_data('imdbRating');
                            ?><span>/10</span></p>
                        </div>
                    </div>

                    <a href="<?php the_permalink() ?>">
                        <img src="<?php

                        movie_data(data: 'Poster');
                        ?>" alt="<?php
                        movie_data('Title');
                        ?>" />
                    </a>

                    <h4 class="position-relative"><a href="<?php the_permalink() ?>">
                    <?php
                    movie_data('Title');
                    ?>
                    </a></h4>
                </div>
            </section>
            <?php
        }
    endwhile;

endif;

// بازنشانی داده‌های پست
wp_reset_postdata();


