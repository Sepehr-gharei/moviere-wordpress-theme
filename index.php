<?php get_header(); ?>
<?php
if (is_user_logged_in()) {
    $user_id = get_current_user_id();
    $watchlist = get_user_meta($user_id, 'user_watchlist', true) ?: [];

    if (!empty($watchlist)) {
        foreach ($watchlist as $post_id) {
            $post = get_post($post_id);
            setup_postdata($post);
            ?>
            <div class="post-item">
                <?php if (has_post_thumbnail()): ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<p>هیچ پستی در واچلیست شما وجود ندارد.</p>';
    }
} else {
    echo '<p>برای مشاهده محتوا <a href="' . wp_login_url() . '">وارد شوید</a></p>';
}
?>
<?php get_template_part('partials/nav/nav', 'nav') ?>
<?php get_template_part('partials/index/movies-header', 'movie-header') ?>
<?php get_template_part('partials/index/hot-post', 'hot-post') ?>
<?php get_template_part('partials/index/subscribe-container', 'subscribe-container') ?>
<?php get_template_part('partials/index/anime-post', 'anime-post') ?>
<?php get_template_part('partials/index/question-box', 'question-box') ?>
<?php get_template_part('partials/index/series-post', 'series-post') ?>
<?php get_template_part('partials/index/latest-news', 'latest-news') ?>

<?php get_footer(); ?>