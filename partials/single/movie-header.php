<!-- ============================ start header single post ============================ -->

<div class="header-single-post">
  <!-- list Items -->
  <div class="list">
    <div class="item">
      <?php if (has_post_thumbnail()) {
        $thumbnail_url = get_the_post_thumbnail_url();
        echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
      }
      ?>
      <div class="content">
        <div class="row">
          <div class="thumbnail col-12 col-md-4">
            <img src="<?php
            movie_data(data: 'Poster');
            ?>" alt="" />
          </div>
          <div class="text col-12 col-md-8">
            <div class="col-12 d-flex">
              <div class="name col-7">
                <h2>دانلود
                  <?php
                  if (in_category('anime')) {
                    echo 'انیمه';
                  } elseif (in_category(category: 'series')) {
                    echo 'سریال';
                  } else {
                    echo 'فیلم';
                  }
                  ?>
                  <?php
                  movie_data('Title');

                  ?>
                </h2>
                <h4><?php
                echo get_post_meta(get_the_ID(), 'movie_title', true);
                ?></h4>
              </div>
              <div class="left-side col-5" dir="ltr">
                <img src="<?php echo get_template_directory_uri() . '/assets/image/IMDB_Logo_2016.svg' ?>" alt="" />
                <div class="d-flex mt-3 num">
                  <strong><?php
                  movie_data('imdbRating');
                  ?></strong><small>/10</small>
                  <span><?php
                  movie_data('imdbVotes');
                  ?></span>
                </div>
                <div class="favorite">
                  <?php
                  // در فایل functions.php پوسته یا پلاگین
                  echo add_favorite_button();
                  ?>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex">
              <div class="col-6 col-md-5">
                <div class="genre">
                  <i class="fa-solid fa-folder-open"></i>
                  <p>ژانر :
                    <?php
                    $post_tags = get_the_tags();
                    if ($post_tags) {
                      foreach ($post_tags as $tag) {
                        ?>
                        <a href="<?php echo home_url() . '\tag' . '/' . $tag->slug ?>"><?php echo $tag->name ?></a>

                        <?php
                      }
                    } else {
                      movie_data('Genre');
                    }
                    ?>
                  </p>
                </div>
                <div class="director">
                  <i class="fa-solid fa-user-astronaut"></i>
                  <p> <?php
                  $movie_details = get_movie_details(get_post_meta(get_the_ID(), '_my_input_value_key', true));
                  if ($movie_details) {
                    if ($movie_details->Director == 'N/A') {
                      echo 'نویسنده : ' . $movie_details->Writer;

                    } else {
                      echo 'کارگردان : ' . $movie_details->Director;

                    }


                  }
                  ?></p>
                </div>
                <div class="stars">
                  <i class="fa-solid fa-people-group"></i>
                  <p>ستارگان : <?php
                  movie_data('Actors');
                  ?></p>
                </div>
              </div>
              <div class="col-6 col-md-4">
                <div class="date">
                  <i class="fa-regular fa-calendar-days"></i>
                  <p>سال ساخت : <?php
                  movie_data('Year');
                  ?></p>
                </div>
                <div class="review">
                  <i class="fa-regular fa-eye"></i>
                  <p>تعداد بازدید :
                    <?php
                    echo get_post_views(get_the_ID());
                    ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================ end header single post ============================ -->