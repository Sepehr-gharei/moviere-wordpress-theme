<?php
function mr_theme_comment($comment, $args)
{
    $comment = $GLOBALS['comment'];

    ?>
    <li id="comment-<?php echo $comment->comment_ID ?>" <?php comment_class() ?>>
        <div class="comment-item" id="comment-id-1">
            <div class="d-block d-lg-flex">
                <div class="col-12 col-lg-3 d-flex reply-and-prof align-items-center justify-content-around">
                    <a href="#comment-form" data-comment-id="<?php echo $comment->comment_ID; ?> "
                        class="col-6 d-flex justify-content-start justify-content-lg-center reply">
                        <i class="fa-solid fa-reply"></i>
                    </a>


                    <div class="col-6 d-flex justify-content-end justify-content-lg-start">
                        <?php echo get_avatar($comment->comment_author_email, 90, '', $comment->comment_author) ?>
                    </div>
                </div>
                <div class="col-12 col-lg-9
               
                ">

                    <div class="col-12 name-date d-flex">
                        <div class="name col-10 "><?php echo $comment->comment_author ?></div>
                        <div class="date col-2 text-center"><?php echo get_comment_date('j F, Y') ?></div>
                    </div>
                    <div class="col-12 text-like d-flex">
                        <div class="col-10 text position-relative">
                            <p class="" id="text">
                                <?php echo $comment->comment_content ?>
                            </p>
                            <div class="position-absolute d-none" id="spoil-alert">
                                <p>این کامت حاوی اسپویل میباشد !</p>
                                <div id="btn-show-spoil-comment">مشاهده کامنت</div>
                            </div>
                        </div>
                        <?php
                        $comment_id = $comment->comment_ID;
                        comments_like_dislike(comment_id: $comment_id);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php
}