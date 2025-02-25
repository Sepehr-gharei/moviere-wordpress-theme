<?php

function mr_register_casts_post_type(){
    $labels = array(
        'name'                  => 'casts',
        'singular_name'         => 'cast',
        'menu_name'             => 'هنرمندان',
        'name_admin_bar'        => 'هنرمند',
        'add_new'               => 'افزودن مطلب هنرمند جدید',
        'add_new_item'          => __( 'افزوندن هنرمندد جدید', 'textdomain' ),
        'new_item'              => __( 'هنرمند جدید', 'textdomain' ),
        'edit_item'             => __( 'ویرایش مطلب', 'textdomain' ),
        'view_item'             => __( 'مشاهنده', 'textdomain' ),
        'all_items'             => 'همه مطالب هنرمند',
        'search_items'          => __( 'جستجو هنرمند', 'textdomain' ),
        'parent_item_colon'     => __( 'والد مطلب:', 'textdomain' ),
        'not_found'             => __( 'هیچ مطلبی پیدا نشد.', 'textdomain' ),
        'not_found_in_trash'    => __( 'هیچ مطلبی در زباله دان پیدا نشد.', 'textdomain' ),
        'featured_image'        => 'تصویر شاخص',
        'set_featured_image'    => _x( 'گزینش تصویر شاخص', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'casts' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'comments','thumbnail' ),
    );

    register_post_type( 'casts', $args );
}
add_action('init','mr_register_casts_post_type');





function mr_register_casts_taxonomy(){
    $labels = array(
        'name'              => 'دسته بندی ها',
        'singular_name'     => 'دسته بندی',
        'search_items'      => __( 'Search Genres', 'textdomain' ),
        'all_items'         => __( 'All Genres', 'textdomain' ),
        'parent_item'       => __( 'Parent Genre', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
        'edit_item'         => __( 'Edit Genre', 'textdomain' ),
        'update_item'       => __( 'Update Genre', 'textdomain' ),
        'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
        'menu_name'         => 'دسته بندی هنرمندان',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'cast_category' ),
    );
    register_taxonomy( 'cast_category','casts', $args );
    unset( $args );
    unset( $labels );
    $labels = array(
        'name'              => 'برچسب ها',
        'singular_name'     => 'بر چسب',
        'search_items'      => __( 'Search Genres', 'textdomain' ),
        'all_items'         => __( 'All Genres', 'textdomain' ),
        'parent_item'       => __( 'Parent Genre', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
        'edit_item'         => __( 'Edit Genre', 'textdomain' ),
        'update_item'       => __( 'Update Genre', 'textdomain' ),
        'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
        'menu_name'         => 'برچسب هنرمندان',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'cast_tag' ),
    );

    register_taxonomy( 'cast_tag','casts', $args );

}
add_action('init','mr_register_casts_taxonomy');
