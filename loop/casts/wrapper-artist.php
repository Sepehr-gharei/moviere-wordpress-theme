
<?php
// دریافت پارامترهای GET
$gender = isset($_GET['gender']) ? sanitize_text_field($_GET['gender']) : '';
$genre = isset($_GET['genre']) ? sanitize_text_field($_GET['genre']) : '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// تنظیمات لوپ برای پست‌های نوع "casts"
$args = array(
  'post_type' => 'casts', // نوع پست
  'posts_per_page' => 10, // تعداد پست‌ها در هر صفحه
  'paged' => $paged, // شماره صفحه فعلی
);

// اگر جنسیت انتخاب شده باشد، آن را به آرگومان‌ها اضافه کنید
if (!empty($gender)) {
  $args['meta_key'] = '_gender';
  $args['meta_value'] = $gender;
  $args['meta_compare'] = '=';
}

// اگر genre انتخاب شده باشد، آن را به آرگومان‌ها اضافه کنید
if (!empty($genre)) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'cast_category', // نام تاکسونومی
      'field' => 'slug',
      'terms' => $genre,
    ),
  );
}

// ایجاد یک نمونه از WP_Query با آرگومان‌های تعریف شده
$casts_query = new WP_Query($args);

// بررسی آیا پستی وجود دارد یا خیر
if ($casts_query->have_posts()):
  // شروع لوپ
  while ($casts_query->have_posts()):
    $casts_query->the_post();
    // نمایش محتوای هر پست
    ?>
    <section class="wrapper-artist col-12 col-sm-6 col-md-4 mb-5">
      <article>
        <figure>
          <div class="profile">
            <?php if (has_post_thumbnail()) {
              $thumbnail_url = get_the_post_thumbnail_url();
              echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
            }
            ?>
          </div>
        </figure>
        <figcaption>
          <div class="content">
            <div class="detail-artist">
              <div class="name">
                <p>نام : <?php the_title(); ?></p>
              </div>
              <div class="profession">
                <div class="d-flex">
                  <p>حرفه :
                  <div class="d-flex professions">
                    <?php
                    $post_id = get_the_ID(); // دریافت ID پست جاری
                    $categories = get_the_terms($post_id, 'cast_category');
                    if (!empty($categories) && !is_wp_error($categories)) {
                      foreach ($categories as $category) {
                        echo '<p>' . $category->name . '</p>';
                      }
                    }
                    ?>
                  </div>
                  </p>
                </div>
              </div>
            </div>
            <div class="bio-artist">
              <a href="<?php echo get_the_permalink() ?>">بیوگرافی</a>
            </div>
          </div>
        </figcaption>
      </article>
    </section>
    <?php
  endwhile;

  // Pagination
  echo '<div class="pagination">';
  echo paginate_links(array(
    'total' => $casts_query->max_num_pages,
    'current' => $paged,
    'prev_text' => 'قبلی',
    'next_text' => 'بعدی',
  ));
  echo '</div>';

  // بازنشانی پست‌ها به حالت اولیه
  wp_reset_postdata();
else:
  // اگر پستی یافت نشد
  ?>
  <p><?php esc_html_e('هیچ پستی یافت نشد.', 'textdomain'); ?></p>
  <?php
endif;
?>