<!-- ============================ start latest news  ============================ -->
<div class="container">
  <div class="row">
    <div class="latest-news-container">
      <div class="header mb-4 mt-5 col-12">
        <h2>
          <img src="<?php echo get_template_directory_uri() . '/assets/image/earth-svgrepo-com.svg' ?>" alt="" />
          
          <span>اخرین اخبار ها</span>
        </h2>
      </div>
      <div class="contents d-md-flex">
      <?php get_template_part('loop/index/lastest-news-loop', 'lastest-news-loop') ?>

        
      </div>
    </div>
  </div>
</div>
<!-- ============================ end latest news  ============================ -->