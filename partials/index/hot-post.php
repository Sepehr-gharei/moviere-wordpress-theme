<!-- ============================ start hot post  ============================ -->
<div class="container mt-5">
  <div class="row">
    <div class="main-post-slider">
      <div class="header mb-4">
        <h2>
          <img src="<?php echo get_template_directory_uri() . '/assets/image/fire-icon.svg' ?>" alt="" />
          <span>داغ ترین فیلم ها</span>
        </h2>
      </div>
      <div class="swiper main-swiper-slider">
        <div class="swiper-wrapper">
          <?php get_template_part('loop/index/hot-post-loop', 'hot-post-loop') ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================ end hot post  ============================ -->