<!-- ============================ hero header ============================ -->
<?php

?>
<div class="header-slider archive-header-slider">
    <!-- list Items -->
    <div class="list">






        <?php
      
       
        $category_name = checkCategory();

        $categories = get_terms(array(
            'taxonomy' => 'category',
            'name' => $category_name,
            'hide_empty' => false,
        ));

        if (!empty($categories) && !is_wp_error($categories)) {
            $category = $categories[0]; // اولین دسته با نام مشخص‌شده
            $category = $category->term_id;
        }
        $args = array(

            'posts_per_page' => 1,
            'category__and' => array($category, 1),

        );


        $custom_query = new WP_Query($args);


        if ($custom_query->have_posts()):
            while ($custom_query->have_posts()):
                $custom_query->the_post();
                ?>
                <div class="item active">
                    <?php if (has_post_thumbnail()) {
                        $thumbnail_url = get_the_post_thumbnail_url();
                        echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
                    }
                    ?>
                    <div class="content w-100">
                        <h2 class="text-center"><?php
                        if ($category_name == 'anime') {
                            echo 'انیمه';
                        }
                        if ($category_name == 'movies') {
                            echo 'فیلم';
                        }
                        if ($category_name == 'series') {
                            echo 'سریال';
                        }

                        ?></h2>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
      
        endif;
        ?>

    </div>
</div>
<!-- ============================ hero header ============================ -->