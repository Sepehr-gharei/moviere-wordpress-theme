<!--============================  start comment container  ============================ -->
<div class="container mt-5">
    <div class="row">
        <div class="comment-section mt-5">
            <div class="header">
                <div class="row">
                    <div class="col-6 comment-text d-flex">
                        <img src="<?php echo get_template_directory_uri() . './assets/image/text-message-icon .svg' ?>"
                            alt="" />
                        <h2>نظرات</h2>
                    </div>
                    <div class="col-6 number-of-comment text-start">
                        <h3><span><?php echo get_comments_number(); ?></span> COMMENT</h3>
                    </div>
                </div>
            </div>
            <div class="body col-12 mt-4">
                <?php
                if (comments_open()): ?>
                    <?php if (is_user_logged_in()): ?>
                        <div class="col-12 form-container" id="comment-form">

                            <form action="<?php echo site_url() . '/wp-comments-post.php' ?>" id="commentform" method="post">

                                <div class="col-12 d-flex justify-content-between">

                                    <label class="pt-2 pb-4" for="comment-text">نظر خود را وارد نمایید</label>
                                    <!-- <div class="spoil d-flex pt-2 pb-4">
                                        <div class="caption px-3">حاوی اسپویل</div>
                                        <div class="checkbox-wrapper-17 d-flex">
                                            <input name="spoil-checkbox" type="checkbox" id="switch-17" /><label
                                                for="switch-17"></label>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="form-group">
                                    <textarea id="comment" name="comment" id="comment-text" class="form-control" rows="6"
                                        placeholder="نظر شما ..."></textarea>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="rating col-6 d-flex justify-content-start">
                                        <!-- <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label> -->
                                    </div>
                                    <div class="col-6 submit d-flex justify-content-end px-4">
                                        <div class="form-submit">
                                            <input name="submit" id="submit" class="btn btn-success" type="submit"
                                                value="ارسال دیدگاه ">

                                            <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                                            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                            <input type="hidden" id="_wp_unfiltered_html_comment_disabled"
                                                name="_wp_unfiltered_html_comment" value="<?php echo wp_create_nonce('') ?>">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    <?php else: ?>
                        <div class="login-for-comment text-center mt-1">
                            <p>برای ارسال دیدگاه اول باید وارد بشوید</p>
                            <div class="d-flex justify-content-center">
                                <a href="" class="login">ورود به حساب</a>
                                <a href="" class="register">ثبت نام</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert mt-2 alert-info w-100">ارسال دیدگاه امکان ندارد</div>
                <?php endif; ?>
                <?php comments_template(null, true); ?>
            </div>

        </div>
    </div>
</div>
<!--============================  end comment container  ============================ -->