<!-- ============================ subscribe Start ================================== -->
<section class="mt-5">
  <div class="container">
    <div class="subscribe-container">
      <!-- ============================ Page Title Start================================== -->
      <div class="page-title-subscribe mb-5">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="header mb-4">
              <h2>
                <img src="<?php echo get_template_directory_uri() . '/assets/image/diamond-svgrepo-com.svg'; ?>"
                  alt="" />
                <span> اشتراک ها </span>
              </h2>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================ Page Title End ================================== -->
      <?php $subscription_options = get_option('subscription_options', array()); ?>
      <div class="row">
        <!-- Single Package -->
        <div class="col-lg-4 col-md-4">
          <div class="packages_wrapping">
            <div class="packages_headers">
              <i class="lni-layers"></i>
              <h4 class="packages_pr_title">اشتراک پایه</h4>
              <span class="packages_price-subtitle">با اشتراک پایه شروع کنید!</span>
            </div>

            <div class="packages_middlebody">
              <ul>

                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['base_features']) && is_array($subscription_options['base_features']) && in_array('دانلود مستقیم', $subscription_options['base_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span>دانلود مستقیم</span>
                </li>

                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['base_features']) && is_array($subscription_options['base_features']) && in_array('تماشای آنلاین', $subscription_options['base_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span> تماشای انلاین</span>
                </li>

                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['base_features']) && is_array($subscription_options['base_features']) && in_array('اولویت درخواست فیلم', $subscription_options['base_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span> اولویت درخواست فیلم</span>
                </li>
              </ul>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around "><small>1 ماه</small><?php echo $subscription_options['base_month1'] . ' تومان '?></a>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>3 ماه</small><?php echo $subscription_options['base_month3'] . ' تومان '?></a>
            </div>
            <div class="packages_bottombody"> 
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>1 سال</small><?php echo $subscription_options['base_year1'] . ' تومان '?></a>
            </div>
          </div>
        </div>

        <!-- Single Package -->
        <div class="col-lg-4 col-md-4">
          <div class="packages_wrapping recommended">
            <div class="packages_headers">
              <i class="lni-diamond"></i>
              <h4 class="packages_pr_title">اشتراک نقره ای</h4>
              <span class="packages_price-subtitle">با اشتراک نقره ای شروع کنید!</span>
            </div>

            <div class="packages_middlebody">
              <ul>

                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['silver_features']) && is_array($subscription_options['silver_features']) && in_array('دانلود مستقیم', $subscription_options['silver_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span>دانلود مستقیم</span>
                </li>

                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['silver_features']) && is_array($subscription_options['silver_features']) && in_array('تماشای آنلاین', $subscription_options['silver_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span> تماشای انلاین</span>
                </li>

                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['silver_features']) && is_array($subscription_options['silver_features']) && in_array('اولویت درخواست فیلم', $subscription_options['silver_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span> اولویت درخواست فیلم</span>
                </li>
              </ul>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>1 ماه</small><?php echo $subscription_options['silver_month1'] . ' تومان '?></a>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>3 ماه</small><?php echo $subscription_options['silver_month3'] . ' تومان '?></a>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>1 سال</small><?php echo $subscription_options['silver_year1'] . ' تومان '?></a>
            </div>
          </div>
        </div>

        <!-- Single Package -->
        <div class="col-lg-4 col-md-4">
          <div class="packages_wrapping">
            <div class="packages_headers">
              <i class="lni-invention"></i>
              <h4 class="packages_pr_title">اشتراک طلایی</h4>
              <span class="packages_price-subtitle">با اشتراک طلایی شروع کنید!</span>
            </div>
            <div class="packages_middlebody">
              <ul>
                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['gold_features']) && is_array($subscription_options['gold_features']) && in_array('دانلود مستقیم', $subscription_options['gold_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span></span>
                  <span>دانلود مستقیم</span>
                </li>
                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['gold_features']) && is_array($subscription_options['gold_features']) && in_array('تماشای آنلاین', $subscription_options['gold_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span> تماشای انلاین</span>
                </li>
                <li class="d-flex justify-content-center">
                  <?php
                  if (isset($subscription_options['gold_features']) && is_array($subscription_options['gold_features']) && in_array('اولویت درخواست فیلم', $subscription_options['gold_features'])) {
                    echo '<i class="fa-regular fa-circle-check"></i>';
                  } else {
                    echo '<i class="fa-regular fa-circle-xmark"></i>';
                  }
                  ?>
                  <span> اولویت درخواست فیلم</span>
                </li>
              </ul>
            </div>

            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>1 ماه</small>
                  <?php echo $subscription_options['gold_month1'] . ' تومان '?></a>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>3 ماه </small>
                <?php echo $subscription_options['gold_month3'] . ' تومان '?></a>
            </div>
            <div class="packages_bottombody">
              <a href="#" class="btn-pricing d-flex justify-content-around"><small>1 سال</small><?php echo $subscription_options['gold_year1'] . ' تومان '?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ============================ subscribe End ================================== -->