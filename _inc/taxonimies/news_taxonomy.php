<?php
function create_news_post_type() {
    $labels = array(
        'name'               => _x('اخبار', 'نام عمومی نوع پست', 'textdomain'),
        'singular_name'      => _x('خبر', 'نام مفرد نوع پست', 'textdomain'),
        'menu_name'          => __('اخبار', 'textdomain'),
        'name_admin_bar'     => __('خبر', 'textdomain'),
        'add_new'            => __('افزودن خبر جدید', 'textdomain'),
        'add_new_item'       => __('افزودن خبر جدید', 'textdomain'),
        'new_item'           => __('خبر جدید', 'textdomain'),
        'edit_item'          => __('ویرایش خبر', 'textdomain'),
        'view_item'          => __('مشاهده خبر', 'textdomain'),
        'all_items'          => __('همه اخبار', 'textdomain'),
        'search_items'       => __('جستجوی اخبار', 'textdomain'),
        'parent_item_colon'  => __('خبر مادر:', 'textdomain'),
        'not_found'          => __('هیچ خبری یافت نشد.', 'textdomain'),
        'not_found_in_trash' => __('هیچ خبری در زباله‌دان یافت نشد.', 'textdomain')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'news'),
        'capability_type'    => 'post',
        'has_archive'       => true,
        'hierarchical'      => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'taxonomies'         => array('news_category', 'news_tag'), // دسته‌بندی و برچسب‌های اختصاصی
        'menu_icon'          => 'dashicons-media-text', // آیکون در منو
    );

    register_post_type('news', $args);
}
add_action('init', 'create_news_post_type');
function create_news_taxonomies() {
    // دسته‌بندی اختصاصی
    register_taxonomy(
        'news_category', // نام دسته‌بندی
        'news', // نوع پست مرتبط
        array(
            'label' => __('دسته‌بندی اخبار', 'textdomain'),
            'rewrite' => array('slug' => 'news-category'),
            'hierarchical' => true, // مانند دسته‌بندی‌های معمولی
        )
    );

    // برچسب‌های اختصاصی
    register_taxonomy(
        'news_tag', // نام برچسب
        'news', // نوع پست مرتبط
        array(
            'label' => __('برچسب‌های اخبار', 'textdomain'),
            'rewrite' => array('slug' => 'news-tag'),
            'hierarchical' => false, // مانند برچسب‌های معمولی
        )
    );
}
add_action('init', 'create_news_taxonomies');