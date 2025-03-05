<!--  ============================ start title ============================   -->
<div class="container mt-5">
    <div class="row">
        <div class="archive-title d-flex justify-content-between mb-5">
            <div class="right-side d-flex align-items-center">
                <div class="film-logo-svg">
                    <svg id="#icon" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
                        text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 466.994 511.648">
                        <path fill="#eee"
                            d="M61.447 199.385h235.604c21.851 0 39.719 17.897 39.719 39.718v148.018c0 21.821-17.897 39.719-39.719 39.719h-72.77l52.85 84.808h-49.246l-57.646-77.467-58.221 77.467H62.145l52.548-84.808H61.447c-21.821 0-39.719-17.869-39.719-39.719V239.103c0-21.85 17.869-39.718 39.719-39.718zm1.017-158.376c34.499 0 62.465 27.966 62.465 62.465 0 34.498-27.966 62.464-62.465 62.464C27.966 165.938 0 137.972 0 103.474c0-34.499 27.966-62.465 62.464-62.465zM254.223 0c45.729 0 82.797 37.074 82.797 82.803s-37.068 82.804-82.797 82.804c-45.735 0-82.804-37.075-82.804-82.804S208.488 0 254.223 0zm105.101 378.919V251.415l107.67-63.464v256.135l-107.67-65.167z" />
                    </svg>
                </div>
                <h2>
                    عناوین مرتبط
                 
                </h2>
            </div>
           
        </div>
    </div>
</div>
<!--  ============================ end title  ============================ -->
<div class="container wrapper-fim-category">
    <div class="row">
        <?php

        
        // پارامترهای WP_Query
        $args = array(
            'post_type' => 'post', // نوع پست
            'posts_per_page' => 20, // تعداد پست‌ها در هر صفحه
            's' => $_GET['s'], // جستجوی عبارت "scarface" در عنوان و محتوا
        
        );


        // ایجاد یک نمونه از WP_Query
        $custom_query = new WP_Query($args);

        // شروع لوپ
        if ($custom_query->have_posts()):
            while ($custom_query->have_posts()):
                $custom_query->the_post();
                // محتوای هر پست
                ?>
                <section class="wrapper-film col-6 col-md-4 col-lg-3">
                    <div class="position-relative wrapper-header-slide">
                        <div class="top-info d-flex justify-content-between">
                            <div class="date"><?php
                            $movie_details = get_movie_details(get_post_meta(get_the_ID(), '_my_input_value_key', true));
                            if ($movie_details) {
                                $year = $movie_details->Year;
                                $number_string = strval($year);
                                $first_four_digits = substr($number_string, 0, 4);
                                echo $first_four_digits;
                            }
                            ?></div>
                            <div class="rating d-flex">
                                <img src="<?php echo get_template_directory_uri() . './assets/image/IMDB_Logo_2016.svg' ?>"
                                    alt="" />
                                <p><?php movie_data(data: 'imdbRating') ?><span>/10</span></p>
                            </div>
                        </div>
                        <a href="<?php the_permalink() ?>"> <img src="<?php movie_data('Poster') ?>"
                                alt="<?php movie_data('Title') ?>" /></a>
                        <h4 class="position-relative"><a href="<?php the_permalink() ?>"><?php movie_data('Title') ?></a></h4>
                    </div>
                </section>
                <?php
            endwhile;

            // Pagination
        
            // بازنشانی پست‌های اصلی
            wp_reset_postdata();

        endif;
        ?>
    </div>
</div>