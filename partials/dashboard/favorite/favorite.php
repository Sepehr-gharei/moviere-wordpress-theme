<div class="dashboard">
    <div class="container">
        <div class="row mt-5 dashboard-row d-flex align-items-stretch">
            <!-- اضافه کردن align-items-stretch -->
            <?php get_template_part('partials/dashboard/right-side-dashboard', 'right-side-dashboard') ?>

            <!-- سمت چپ -->
            <div class="col-md-9 equal-height left-side">
                <div class="container">
                    <div class="row">
                        
                        <?php

    $user_id = get_current_user_id();
    $favorite = get_user_meta($user_id, 'user_favorite', true) ?: [];
    
    if (!empty($favorite)) {
      
        foreach ($favorite as $post_id) {
            $post = get_post($post_id);
            if ($post) {
                $movie_details = get_movie_details(get_post_meta($post_id, '_my_input_value_key', true));
    
                ?> 
                <section class="wrapper-dashboard-favorite col-6 col-sm-4 col-lg-3">
                            <div class="position-relative wrapper-header-slide">
                                <div class="top-info d-flex justify-content-between">
                                    <div class="date"><?php echo $movie_details->Year ?></div>
                                    <div class="rating d-flex">
                    <img src="<?php echo get_template_directory_uri() . './assets/image/IMDB_Logo_2016.svg' ?>" alt="" />
                                        <p><?php echo $movie_details->imdbRating ?><span>/10</span></p>
                                    </div>
                                </div>

                                <a href="<?php the_permalink($post_id) ?>">
                                                        <img src="<?php
                                                         echo $movie_details->Poster
                                                        ?>" alt="<?php
                                                        echo $movie_details->Title
                                                        ?>" />
                                                    </a>

                                <h4 class="position-relative"><a href="<?php the_permalink($post_id) ?>"><?php echo $movie_details->Title ?></a></h4>
                            </div>
                        </section>
                <?php
                
               
                // echo '<button class="remove-from-favorite button" data-post-id="' . $post_id . '">حذف</button>';
                
            }
        }
      
    } else {
        echo '<p>هیچ پستی در واچلیست شما وجود ندارد.</p>';
    }

?>
                    </div>
                </div>
            </div>

            <!-- سمت راست -->
        </div>
    </div>
</div>