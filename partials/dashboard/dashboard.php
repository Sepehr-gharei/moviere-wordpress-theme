<i class="fas fa-bookmark-plus"></i>
<div class="dashboard">
  <div class="container">
    <div class="row mt-5 dashboard-row d-flex align-items-stretch">
      <!-- اضافه کردن align-items-stretch -->
      <?php get_template_part('partials/dashboard/right-side-dashboard', 'right-side-dashboard') ?>

      <!-- سمت چپ -->
      <div class="col-md-9 equal-height left-side">
        <div class="content mt-5">
          <div class="subscribe item-danger">
            <p>شما اشتراک فعال ندارید</p>
            <a href="">خرید اشتراک</a>
          </div>
          <div class="date-details">
            <div class="item">
              <p>تاریخ عضویت :</p>
              <p><?php $current_user = wp_get_current_user();
              $registration_date = $current_user->user_registered;

              // تبدیل تاریخ به فرمت جلالی
              echo wp_date('Y/m/d ', strtotime($registration_date)); ?></p>
            </div>
          </div>
          <div class="user-details">
            <div class="item">
              <p>ای پی شما :</p>
              <p>

                <?php
                function get_user_ip()
                {
                  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                  } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                  }
                  return $ip;
                }

                // نمایش آی‌پی
                echo esc_html(get_user_ip());
                ?>
              </p>
            </div>
            <div class="item">

              <p>ایمیل شما :</p>

              <p>

                <?php
             
                  $current_user = wp_get_current_user();

                  // نام کاربری
                
                  // ایمیل کاربر
                  $email = $current_user->user_email;

                  echo esc_html($email) . '<br>';
                
                ?>


              </p>
            </div>
            <div class="item">
              <p>نام شما :</p>

              <p>

                <?php
                
                echo esc_attr($current_user->nickname)

                
                ?>
              </p>
            </div>
          </div>
          <div class="user-counter">
            <div class="row justify-content-center user-counter-row">
              <div class="item col-12 col-sm-6 col-lg-4">
                <div class="d-flex">
                  <div class="img watch-list">


                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve">
                      <g>
                        <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1
    c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3
    l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4
    C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3
    s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4
    c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3
    C444.801,187.101,434.001,213.101,414.401,232.701z" />
                      </g>
                    </svg>
                  </div>
                  <div class="content-text">
                    <h4><?php
                    echo get_favorite_count();
                    ?>
                    </h4>
                    <p> علاقه مندی</p>
                  </div>
                </div>
                <div class="show">
                  <p>مشاهده</p>
                </div>
              </div>
              <div class="item col-12 col-sm-6 col-lg-4 ">
                <div class="d-flex">
                  <div class="img comment">
                 
                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M16.5 1.853c-8.133 0-14.75 5.663-14.75 12.624 0.045 2.863 1.132 5.465 2.896 7.45l-0.010-0.012c-0.608 2.418-1.844 4.491-3.525 6.104l-0.004 0.004c-0.22 0.225-0.355 0.534-0.355 0.873 0 0.691 0.56 1.252 1.252 1.252 0.089 0 0.175-0.009 0.259-0.027l-0.008 0.001c3.458-0.576 6.524-1.93 9.121-3.877l-0.054 0.039c1.547 0.517 3.328 0.816 5.179 0.817h0c8.133 0 14.75-5.664 14.75-12.625s-6.617-12.624-14.75-12.624zM16.5 24.602c-0.015 0-0.034 0-0.052 0-1.77 0-3.465-0.321-5.030-0.908l0.099 0.032c-0.045-0.011-0.1-0.020-0.155-0.025l-0.005-0c-0.085-0.025-0.182-0.041-0.283-0.045l-0.002-0c-0.074 0.005-0.142 0.016-0.207 0.033l0.008-0.002c-0.1 0.013-0.19 0.035-0.275 0.068l0.008-0.003c-0.079 0.039-0.146 0.081-0.209 0.129l0.003-0.002c-0.064 0.033-0.118 0.067-0.169 0.105l0.003-0.002c-1.371 1.186-3 2.115-4.789 2.69l-0.098 0.027c0.896-1.391 1.555-3.025 1.872-4.778l0.012-0.082c0.005-0.031-0.005-0.060-0.002-0.092 0.002-0.028 0.003-0.060 0.003-0.093 0-0.311-0.107-0.597-0.286-0.824l0.002 0.003c-0.019-0.023-0.025-0.051-0.046-0.073-1.617-1.608-2.626-3.826-2.652-6.28l-0-0.005c0-5.582 5.495-10.124 12.25-10.124s12.25 4.542 12.25 10.124-5.496 10.125-12.25 10.125zM25 10.75h-16c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h16c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0zM16 16.75h-7c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h7c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0z">
                      </path>
                    </svg>
                  </div>
                  <div class="content-text">
                    <h4>
                      <?php
                      if (is_user_logged_in()) {
                        $current_user_id = get_current_user_id();

                        // دریافت تعداد کامنتهای کاربر
                        $comment_count = get_comments(array(
                          'user_id' => $current_user_id,
                          'count' => true, // فقط تعداد را برگردان
                          'status' => 'approve' // فقط کامنتهای تاییدشده
                        ));

                        echo esc_html($comment_count);
                      }
                      ?>
                    </h4>
                    <p>کامنت ها</p>
                  </div>
                </div>
                <div class="show">
                  <p>مشاهده</p>
                </div>
              </div>
              <div class="item col-12 col-sm-6 col-lg-4 ">
                <div class="d-flex">
                  <div class="img ticket">
                    <svg viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink">
                      <path
                        d="M15.668 6.017c-0.957-3.557-3.863-6.017-7.168-6.017-3.295 0-6.212 2.464-7.168 6.017-0.747 0.082-1.332 0.712-1.332 1.483v4c0 0.625 0.382 1.16 0.924 1.385 0.194 1.747 1.663 3.115 3.461 3.115h2.707c0.207 0.581 0.757 1 1.408 1h3c0.827 0 1.5-0.673 1.5-1.5s-0.673-1.5-1.5-1.5h-3c-0.651 0-1.201 0.419-1.408 1h-2.707c-1.208 0-2.217-0.86-2.449-2h1.064v-1h1v-5h-1v-1h-0.606c0.913-2.961 3.352-5 6.106-5 2.762 0 5.193 2.037 6.106 5h-0.606v1h-1v5h1v1h1.506c0.824 0 1.494-0.673 1.494-1.5v-4c0-0.771-0.585-1.401-1.332-1.483zM8.5 15h3c0.275 0 0.5 0.224 0.5 0.5s-0.225 0.5-0.5 0.5h-3c-0.275 0-0.5-0.224-0.5-0.5s0.225-0.5 0.5-0.5zM2 12h-0.506c-0.272 0-0.494-0.224-0.494-0.5v-4c0-0.276 0.222-0.5 0.494-0.5h0.506v5zM16 11.5c0 0.276-0.222 0.5-0.494 0.5h-0.506v-5h0.506c0.272 0 0.494 0.224 0.494 0.5v4z" />
                    </svg>
                  </div>
                  <div class="content-text">
                    <h4>0</h4>
                    <p>تیکت ها</p>
                  </div>
                </div>
                <div class="show">
                  <p>مشاهده</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- سمت راست -->
    </div>
  </div>
</div>