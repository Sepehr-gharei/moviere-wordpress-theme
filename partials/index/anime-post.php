<!-- ============================ start anime post  ============================ -->



<div class="container mt-5">
  <div class="row">
    <div class="main-post-slider">
      <div class="header mb-4 mt-5 anime-post-header">
        <h2>
          <img src="<?php echo get_template_directory_uri() . './assets/image/anime-emoji-emoticon-2-svgrepo-com.svg'; ?>"
            alt="" />
          <span>جدید ترین انیمه ها</span>
        </h2>
      </div>
      <div class="swiper anime-swiper-slider">
        <div class="swiper-wrapper">

          <?php get_template_part('loop/index/anime-post-loop', 'anime-post-loop') ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================ end anime post  ============================ -->