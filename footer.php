<!-- ============================ start footer ============================ -->
<footer class="container-fluid footer mt-5">
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-between mb-3">
        <div class="d-md-block col-5 col-md-3 col-lg-2">
          <div class="col-9 mt-2 d-flex justify-content-start logo">

            <a href="<?php echo home_url() ?>"><img
                src="<?php echo get_template_directory_uri() . './assets/image/moviere-logo.png'; ?>" alt="" /></a>
          </div>
        </div>
        <div class="d-flex col-7 col-md-3 col-lg-3 align-items-center justify-content-end">
          <a class="custom-btn1" href="#scroll-top">
            بازگشت به بالا <i class="fa-solid fa-chevron-up"></i></a>
        </div>
      </div>
      <div class="col-6 col-md-4">
        <h5>عناوین برتر</h5>
        <ul>
          <li><a href="">250 فیلم imdb</a></li>
          <li><a href="">250 سریال imdb</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-4">
        <h5>دسته ها</h5>
        <ul>
          <li><a href="">فیلم ها</a></li>
          <li><a href="">سریال ها</a></li>
          <li><a href="">انیمه ها</a></li>
          <li><a href="">اخبار ها</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-4">
        <h5>راه های ارتباط</h5>
        <div class="social-icon">
          <ul class="nav">
            <li class="nav-item twitter">
              <a class="nav-link" href="#">
                <i class="fab fa-x-twitter"></i>
              </a>
            </li>
            <li class="nav-item instagram">
              <a class="nav-link" href="#">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <li class="nav-item facebook">
              <a class="nav-link" href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item telegram">
              <a class="nav-link" href="#">
                <i class="fab fa-telegram-plane"></i>
              </a>
            </li>
          </ul>
          <p>طهران - خیابون به زودی پلاک 021</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container copyright-text d-flex justify-content-center">
    <p>کلیه حقوق این سایت متعلق به سپهر قارئی میباشد .</p>
    <p>Copyright © 2024 All rights reserved</p>
  </div>
</footer>

<!-- ============================ end footer  ============================ -->
<?php wp_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#change-post-type .dropdown-item').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = this.getAttribute('href');
      });
    });
  });
</script>
</body>


</html>