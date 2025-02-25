<?php
function create_blog_post_type() {
    $labels = array(
        'name'               => _x( 'Blogs', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'Blog', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Blogs', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Blog', 'add new on admin bar', 'textdomain' ),
        'add_new'           => _x( 'Add New', 'blog', 'textdomain' ),
        'add_new_item'      => __( 'Add New Blog', 'textdomain' ),
        'new_item'          => __( 'New Blog', 'textdomain' ),
        'edit_item'         => __( 'Edit Blog', 'textdomain' ),
        'view_item'         => __( 'View Blog', 'textdomain' ),
        'all_items'         => __( 'All Blogs', 'textdomain' ),
        'search_items'      => __( 'Search Blogs', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Blogs:', 'textdomain' ),
        'not_found'         => __( 'No blogs found.', 'textdomain' ),
        'not_found_in_trash' => __( 'No blogs found in Trash.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'      => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'blog' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'taxonomies'         => array( 'category', 'post_tag' ), // افزودن دسته‌بندی و تگ
    );

    register_post_type( 'blog', $args );
}
add_action( 'init', 'create_blog_post_type' );
