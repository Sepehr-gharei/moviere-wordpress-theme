<div class="container">
  <div class="row">
    <div class="wrapper-artist"></div>
    <div class="profile-artist">
      <section class="wrapper-artist col-12 d-block d-md-none">
        <article>
          <figure>
            <div class="profile">
              <img src="./assets/image/actors/30195091-l_30NAMA.webp" alt="" />
            </div>
          </figure>
          <figcaption>
            <div class="content">
              <div class="detail-artist">
                <div class="name">
                  <p>نام : Alfred Hitchcock</p>
                </div>
                <div class="profession">
                  <p>حرفه : کارگردان , نویسنده , بازیگر</p>
                </div>
              </div>
              <div class="bio-artist">
                <a href="">بیوگرافی</a>
              </div>
            </div>
          </figcaption>
        </article>
      </section>


      <div class="main-section">
        <div class="left-side">



          <div class="archive-title d-flex justify-content-between mb-2 mt-5">
            <div class="right-side d-flex align-items-center w-75">
              <div class="film-logo-svg">
                <svg id="#icon" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
                  text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd"
                  clip-rule="evenodd" viewBox="0 0 466.994 511.648">
                  <path fill="#eee"
                    d="M61.447 199.385h235.604c21.851 0 39.719 17.897 39.719 39.718v148.018c0 21.821-17.897 39.719-39.719 39.719h-72.77l52.85 84.808h-49.246l-57.646-77.467-58.221 77.467H62.145l52.548-84.808H61.447c-21.821 0-39.719-17.869-39.719-39.719V239.103c0-21.85 17.869-39.718 39.719-39.718zm1.017-158.376c34.499 0 62.465 27.966 62.465 62.465 0 34.498-27.966 62.464-62.465 62.464C27.966 165.938 0 137.972 0 103.474c0-34.499 27.966-62.465 62.464-62.465zM254.223 0c45.729 0 82.797 37.074 82.797 82.803s-37.068 82.804-82.797 82.804c-45.735 0-82.804-37.075-82.804-82.804S208.488 0 254.223 0zm105.101 378.919V251.415l107.67-63.464v256.135l-107.67-65.167z" />
                </svg>
              </div>
              <h2>فیلم و سریال ها</h2>
            </div>


            <div class="left-side d-flex align-items-center justify-content-end">
           
            </div>
          </div>


          <div class="container">
            <div class="row">

              <?php get_template_part('loop/casts/single/wrapper-film-profile', 'wrapper-film-profile') ?>


            </div>
          </div>
        </div>
        <div class="right-side">
          <section class="about-artist col-12 col-sm-6 col-md-4 mb-5 d-none d-md-block">
            <article>
              <figure>
                <div class="profile">
                  <?php if (has_post_thumbnail()) {
                    $thumbnail_url = get_the_post_thumbnail_url();
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
                  }
                  ?>
                </div>
              </figure>
              <figcaption>
                <div class="content">
                  <div class="detail-artist">
                    <p>نام : <?php echo get_the_title() ?></p>
                    <div class="d-flex">
                      <p>حرفه :
                      <div class="d-flex professions">
                        <?php
                        if (have_posts()):
                          while (have_posts()):
                            the_post();
                            if ('casts' === get_post_type()) { // بررسی کنید که post type برابر با "casts" باشد
                              $post_id = get_the_ID(); // دریافت ID پست جاری
                              $categories = get_the_terms($post_id, 'cast_category');
                              if (!empty($categories) && !is_wp_error($categories)) {

                                foreach ($categories as $category) {
                                  echo '<p>' . $category->name . '</p>';
                                }
                              }
                            }
                          endwhile;
                        endif;
                        ?>
                      </div>
                      </p>
                    </div>
                    <p>تعداد فیلم و سریال :
                      <?php
                      if (have_posts()):
                        while (have_posts()):
                          the_post();
                          if ('casts' === get_post_type()) { // بررسی کنید که post type برابر با "casts" باشد
                            $post_id = get_the_ID(); // دریافت ID پست جاری
                            $tags = get_the_terms($post_id, 'cast_tag');
                            if (!empty($tags) && !is_wp_error($tags)) {
                              $tag_count = count($tags); // شمارش تعداد برچسب‌ها
                              echo $tag_count;
                            }
                          }
                        endwhile;
                      endif;
                      ?>
                    </p>
                  </div>
                </div>
              </figcaption>
            </article>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>