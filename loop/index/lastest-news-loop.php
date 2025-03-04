<?php

$args = array(
   'posts_per_page' => 6,  //برای مشاهده تغیر باید در functions.php هم post_per_page رو تغیر دهید به همین عدد 
  'post_type' => 'news',

);
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
  <?php while ($the_query->have_posts()):
    $the_query->the_post(); ?>
    <a class="d-flex align-items-center" href="<?php the_permalink() ?>">
      <div class="item col-12 col-md-6 d-xl-flex m-2 py-2">
        <div class="image-container w-100 item col-12 col-xl-7 p-2">
          <?php if (has_post_thumbnail()) {
            $thumbnail_url = get_the_post_thumbnail_url();
            echo '<img class="w-100 h-auto" src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
          }
          ?>
      
        </div>
        <div class="content-container d-flex flex-column justify-content-between flex-wrap item col-12 col-xl-5 p-2">
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
              <i class="fa-regular fa-clock"></i> زمان مطالعه:<?php echo calculateReadingTime(get_the_content()) ?>
            </div>
          </div>
        </div>
      </div>
    </a>



  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php else: ?>
  <div class="alert alert-info">تاکنون مطلبی ارسال نشده</div>
<?php endif; ?>