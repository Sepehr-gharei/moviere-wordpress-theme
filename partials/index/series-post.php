 <!-- ============================ start series slider  ============================ -->
 <div class="container mt-5">
      <div class="row">
        <div class="main-post-slider">
          <div class="header mb-4">
            <h2>
              <img src="<?php echo get_template_directory_uri() . '/assets/image/cinema.svg'?>" alt="" />
              <span>سریال های بروز شده</span>
            </h2>
          </div>
          <div class="swiper main-swiper-slider">
            <div class="swiper-wrapper">
          <?php get_template_part('loop/index/series-post-loop', 'series-post-loop') ?>
             
           
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================ end series slider  ============================ -->
 