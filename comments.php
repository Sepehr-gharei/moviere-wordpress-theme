<div class="col-12 comment-container mt-3">


    <?php
    $args = [
        "callback" => "mr_theme_comment",
        "style" => "ul",

    ];
    wp_list_comments($args) ?>
</div>
<div class="comment-pagination text-center">
    <?php
    paginate_comments_links(array(

        'prev_text' => 'نمایش بیشتر',

    ))
        ?>
</div>
