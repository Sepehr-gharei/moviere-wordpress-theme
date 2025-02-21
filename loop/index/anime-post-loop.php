<?php
$args = [
    'post_type' => 'post',
    'posts_per_page' => 15,
    'category_name' => 'anime', // دسته‌بندی 'featured'
    

];
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
    <?php while ($the_query->have_posts()):
        $the_query->the_post(); ?>

        <section class="wrapper-film col-6 col-md-4 col-lg-3 swiper-slide">
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
                        <p dir="ltr"><?php
                        movie_data('imdbRating');
                        ?>
                            <span>/10</span>
                        </p>
                    </div>
                </div>


                <a href="<?php the_permalink() ?>">
                    <img src="<?php

                    movie_data(data: 'Poster');
                    ?>" alt="<?php
                    movie_data('Title');
                    ?>" />
                </a>

                <h4 class="position-relative"><a href=<?php the_permalink() ?>><?php
                  movie_data('Title');
                  ?></a></h4>
            </div>
        </section>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <div class="alert alert-info">تاکنون مطلبی ارسال نشده</div>
<?php endif; ?>