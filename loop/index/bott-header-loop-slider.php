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
            <img src="<?php  
                movie_data('Poster');
            ?>" alt="" />
        </div>
        <?php
        $counter++; // شمارنده را افزایش دهید
    endwhile;
    wp_reset_postdata();
else:
    echo 'پستی یافت نشد.';
endif;
?>