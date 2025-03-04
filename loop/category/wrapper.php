<?php
// تنظیمات صفحه‌بندی
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // شماره صفحه فعلی

$category = checkCategory();
$order = isset($_GET['order']) ? $_GET['order'] : ''; // دریافت مقدار order از URL

// پارامترهای WP_Query
$args = array(
    'post_type' => 'post', // نوع پست
    'posts_per_page' => 4, // تعداد پست‌ها در هر صفحه
    'paged' => $paged, // شماره صفحه فعلی
    'category_name' => $category, // دسته‌بندی (اختیاری)
);

// تنظیمات مرتب‌سازی بر اساس مقدار order
switch ($order) {
    case 'old':
        $args['meta_key'] = '_movie_year';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        break;
    case 'new':
        $args['meta_key'] = '_movie_year';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;
    case 'rate':
        $args['meta_key'] = '_imdb_score';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;
    default:
        // اگر هیچ ترتیبی انتخاب نشده باشد، از ترتیب پیش‌فرض استفاده می‌شود
        break;
}

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
                        <img src="<?php echo get_template_directory_uri() . './assets/image/IMDB_Logo_2016.svg' ?>" alt="" />
                        <p><?php movie_data(data: 'imdbRating') ?><span>/10</span></p>
                    </div>
                </div>
                <a href="<?php the_permalink() ?>"> <img src="<?php movie_data('Poster') ?>" alt="<?php movie_data('Title') ?>" /></a>
                <h4 class="position-relative"><a href="<?php the_permalink() ?>"><?php movie_data('Title') ?></a></h4>
            </div>
        </section>
        <?php
    endwhile;

    // Pagination
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $custom_query->max_num_pages, // تعداد کل صفحات
        'current' => $paged, // صفحه فعلی
        'prev_text' => __('Previous', 'textdomain'), // متن لینک صفحه قبلی
        'next_text' => __('Next', 'textdomain'), // متن لینک صفحه بعدی
    ));
    echo '</div>';

    // بازنشانی پست‌های اصلی
    wp_reset_postdata();

else:
    // اگر پستی وجود نداشت
    echo '<p>' . __('No posts found.', 'textdomain') . '</p>';
endif;
?>