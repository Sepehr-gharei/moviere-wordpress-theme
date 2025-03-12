<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'category_name' => 'featured-movies', // دسته‌بندی 'featured'

);


$custom_query = new WP_Query($args);

$counter = 0; // شمارنده برای شناسایی اولین آیتم

if ($custom_query->have_posts()):
    while ($custom_query->have_posts()):
        $custom_query->the_post();
        $class = ($counter == 0) ? 'active' : ''; // فقط به اولین آیتم کلاس 'active' اضافه می‌شود
        ?>
        <div class="item <?php echo $class; ?>">
            <?php if (has_post_thumbnail()) {
                $thumbnail_url = get_the_post_thumbnail_url();
                echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
            }
            ?>
            <div class="content">
                <p>
                    <span> <?php
                    movie_data('imdbRating');
                    ?>/<span>10</span></span>
                    <img src="<?php echo get_template_directory_uri() . '/assets/image/IMDB_Logo_2016.svg' ?>" alt="" />
                </p>
                <h2>
                    <a href="<?php echo the_permalink() ?>">
                        <?php
                        movie_data('Title');
                        ?>
                        <span><?php
                        movie_data('Year');
                        ?>
                    </a></span>
                </h2>

            </div>
        </div>
        <?php
        $counter++; // شمارنده را افزایش دهید
    endwhile;
    wp_reset_postdata();
else:
    echo 'پستی یافت نشد.';
endif;
?>