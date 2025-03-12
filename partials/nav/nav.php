<!-- ============================ start navbar ============================ -->
<header id="scroll-top">
  <!-- logo  -->
  <a href="<?php echo home_url() ?>">
    <div class="logo">
      <img src="<?php echo get_template_directory_uri() . '/assets/image/reLogo.png'; ?>" alt="" />
    </div>
  </a>
  <!-- nav -->
  <ul class="menu">
    <!-- home  -->
    <li class="d-none d-lg-block"><a href=" <?php echo home_url() ?>">خانه</a></li>

    <!-- categories -->
    <li class="d-none d-lg-block">
      <div class="category-menu">
        <button class="btn btn-secondary category-menu-toggle" type="button" id="category-menuButton1"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-layer-group"></i> فهرست ها
        </button>
        <ul class="dropdown-menu first-dropdown-menu">
          <li class="dropdown-item">
            <img src="<?php echo get_template_directory_uri() . '/assets/image/doucument-icon.svg'; ?>" alt="" />
            <span class="px-2">دسته ها</span>
            <ul class="dropdown-menu submenu">
              <div class="width-400px">
                <div class="row">
                  <div class="col-6 col-md-3 mx-3 my-2">
                    <li><a class="dropdown-item" href="<?php echo home_url() . 'category/film' ?>">فیلم</a></li>
                  </div>
                  <div class="col-6 col-md-3 mx-3 my-2">
                    <li><a class="dropdown-item" href="<?php echo home_url() . 'category/series' ?>">سریال</a></li>
                  </div>
                  <div class="col-6 col-md-3 mx-3 my-2">
                    <li><a class="dropdown-item" href="<?php echo home_url() . 'category/anime' ?>">انیمه</a></li>
                  </div>
                </div>
              </div>
            </ul>
          </li>
          <li class="dropdown-item">
            <img src="<?php echo get_template_directory_uri() . '/assets/image/film-icon.svg"'; ?> alt="" />
                <span class=" px-2">ژانر ها</span>
            <ul class="dropdown-menu submenu">
              <div class="width-400px">
                <div class="row">

                  <?php
                  $tags = get_tags(); // دریافت تمام تگ‌ها
                  
                  if ($tags) {
                    foreach ($tags as $tag) {
                      $tag_link = get_tag_link($tag->term_id); // دریافت لینک تگ
                      echo '<div class="col-6 col-md-3 mx-3 my-2"><li><a class="dropdown-item" href="' . esc_url($tag_link) . '">' . $tag->name . '</a></li></div>';
                    }
                  }
                  ?>


                </div>

              </div>
            </ul>
          </li>

        </ul>
      </div>
    </li>
    <!-- blog -->
    <li class="d-none d-lg-block"><a href="<?php echo home_url() . '/news' ?>">اخبار</a></li>
    <!-- actors -->
    <li class="d-none d-lg-block"><a href="<?php echo home_url() . '/casts' ?>">بازیگران</a></li>
    <nav class="navbar navbar-expand-md">

      <div class="collapse navbar-collapse" id="main-menu">
      </div>
    </nav>
    <!-- nav in small responsive  -->
    <div class="container-fluid nav-small-responsive d-lg-none">
      <div class="row">
        <div class="col-3 item">
          <div>
            <i class="fa fa-home"></i>
          </div>
          <div>
            <p>خانه</p>
          </div>
        </div>
        <div class="col-3 item">
          <!-- navbar -->
          <button class="navbar-toggler pt-1" id="header-navbar-buttom" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasdarkNavbar" aria-controls="offcanvasdarkNavbar" aria-label="Toggle navigation">
            <div>
              <i class="fas fa-layer-group"></i>
            </div>
            <div class="pt-1">
              <p>فهرست ها</p>
            </div>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasdarkNavbar"
            aria-labelledby="offcanvasdarkNavbarLabel">
            <div class="offcanvas-header">
              <img src="<?php echo get_template_directory_uri() . '/assets/image/reLogo.png' ?>" alt="" />
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"
                id="header-navbar-btn-close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    دسته ها
                  </a>
                  <ul class="dropdown-menu submenu">
                    <div class="width-400px">
                      <div class="row">
                        <div class="col-6 col-md-3 mx-3 my-2">
                          <li><a class="dropdown-item" href="<?php echo home_url() . 'category/film' ?>">فیلم</a></li>
                        </div>
                        <div class="col-6 col-md-3 mx-3 my-2">
                          <li><a class="dropdown-item" href="<?php echo home_url() . 'category/series' ?>">سریال</a>
                          </li>
                        </div>
                        <div class="col-6 col-md-3 mx-3 my-2">
                          <li><a class="dropdown-item" href="<?php echo home_url() . 'category/anime' ?>">انیمه</a></li>
                        </div>
                      </div>
                    </div>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    ژانر ها
                  </a>
                  <ul class="dropdown-menu submenu">
                    <div class="width-400px">
                      <div class="row">

                        <?php
                        $tags = get_tags(); // دریافت تمام تگ‌ها
                        
                        if ($tags) {
                          foreach ($tags as $tag) {
                            $tag_link = get_tag_link($tag->term_id); // دریافت لینک تگ
                            echo '<div class="col-6 col-md-3 mx-3 my-2"><li><a class="dropdown-item" href="' . esc_url($tag_link) . '">' . $tag->name . '</a></li></div>';
                          }
                        }
                        ?>
                      </div>

                    </div>
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </div>
        <div class="col-3 item">
          <div>
            <i class="fa-regular fa-newspaper"></i>
          </div>
          <div>
            <p><a href="<?php echo home_url() . '/news' ?>">اخبار</a></p>
          </div>
        </div>
        <div class="col-3 item">
          <div>
            <i class="fa-solid fa-person"></i>
          </div>
          <div>
            <p>بازیگران</p>
          </div>
        </div>
      </div>
    </div>


  </ul>

  <!-- search and login -->
  <div class="search-login d-flex justify-content-between">
    <div>
      <div id="myOverlay" class="overlay">
        <span class="closebtn" onclick="closeSearch()" title="Close Overlay"><i
            class="fa-solid fa-circle-xmark"></i></span>
        <div class="close-2-background" onclick="closeSearch()"></div>
        <div class="overlay-content">
          <form action="<?php bloginfo('url') ?>" method="get"  role="search" dir="ltr">
            <label for="search">Search for stuff</label>
            <input id="search" name="s" type="search" placeholder="Search..." autofocus required />
            <button type="submit">Go</button>
          </form>
        </div>
      </div>

      <svg class="svg-icon search-icon" onclick="openSearch()" aria-labelledby="title desc" role="img"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7">
        <title id="title">Search Icon</title>
        <desc id="desc">A magnifying glass icon.</desc>
        <g class="search-path" fill="none">
          <path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4" />
          <circle cx="8" cy="8" r="7" />
        </g>
      </svg>
    </div>
    <?php
    if (is_user_logged_in()):
      ?>
      <div class="justify-content-center d-flex profile-when-user-login">

        <div class="dropdown ">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-user"></i>
          </a>
          <ul class="dropdown-menu text-end " aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">داشبورد</a></li>
            <li><a class="dropdown-item" href="#">خرید اشتراک</a></li>
            <li><a class="dropdown-item" href="#">کیف پول من</a></li>
            <li><a class="dropdown-item" href="#">لیست تماشا</a></li>
            <li><a class="dropdown-item" href="#">ویرایش پروفایل</a></li>
            <li><a class="dropdown-item log-out " href="<?php echo wp_logout_url(home_url()) ?>">خروج</a></li>
          </ul>
        </div>

      </div>
    <?php else: ?>
      <a href=""> ورود | ثبت نام </a>
    <?php endif; ?>
  </div>


</header>
<!-- ============================ end  navbar ============================ -->