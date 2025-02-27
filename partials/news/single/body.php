<div class="container mt-5">
  <div class="latest-news-container latest-news-single">

    <div class="contents d-md-flex">
      <div class="row justify-content-around">
        <div class="item col-12">
          <div class="image-container image-container-single item col-12 p-2">
            <?php if (has_post_thumbnail()) {
              $thumbnail_url = get_the_post_thumbnail_url();
              echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
            }
            ?>
          </div>
          <div class="content-container d-flex flex-column justify-content-between flex-wrap item col-12 p-2">
            <div class="date-and-time-to-read d-flex py-3 d-flex justify-content-around">
              <div>
                <i class="fa-regular fa-calendar-days"></i> <?php echo human_time_diff_for_post(get_the_ID()) ?>
              </div>
              <div>
                <i class="fa-regular fa-clock"></i> زمان
                مطالعه:<?php echo calculateReadingTime(get_the_content()) ?>
              </div>
              <div class="view" >
              <?php
             
                    ?>
                  <i class="fa-regular fa-eye"></i>
                  تعداد بازدید :
                    <?php
                    echo get_post_views(get_the_ID());
                    ?>
                  
              </div>
            </div>
            <div class="text">
            
                <h4><?php the_title() ?></h4>
              
              <p>
                <?php the_content() ?>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>