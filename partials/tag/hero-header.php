<!-- ============================ hero header ============================ -->
<?php

?>
<div class="header-slider archive-header-slider">
    <!-- list Items -->
    <div class="list">
        <?php
        $tag_name = checkTag();
        $tag = get_term_by('slug', $tag_name, 'post_tag');

        $args = array(
            'post_type' => 'post', // نوع پست
            'posts_per_page' => 1, // تعداد پست‌ها در هر صفحه
            'paged' => $paged, // شماره صفحه فعلی
            'tag_id' => $tag->term_id, // دسته‌بندی (اختیاری)
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
                        if ($tag_name == 'action') {
                            echo 'اکشن';
                        }
                        if ($tag_name == 'animation') {
                            echo 'انیمیشن';
                        }
                        if ($tag_name == 'biography') {
                            echo 'بیوگرافی';
                        }
                        if ($tag_name == 'historical') {
                            echo 'تاریخی';
                        }
                        if ($tag_name == 'horror') {
                            echo 'ترسناک';
                        }
                        if ($tag_name == 'crime') {
                            echo 'جنایی';
                        }
                        if ($tag_name == 'family') {
                            echo 'خانوادگی';
                        }
                        if ($tag_name == 'drama') {
                            echo 'درام';
                        }
                        if ($tag_name == 'mystery') {
                            echo 'رازآلود';
                        }
                        if ($tag_name == 'science-fiction') {
                            echo 'علمی تخیلی';
                        }
                        if ($tag_name == 'romance') {
                            echo 'عاشقانه';
                        }
                        if ($tag_name == 'fantasy') {
                            echo 'فانتزی';
                        }
                        if ($tag_name == 'comedy') {
                            echo 'کمدی';
                        }
                        if ($tag_name == 'adventure') {
                            echo 'ماجراجویی';
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