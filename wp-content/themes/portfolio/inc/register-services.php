<?php

/*
 * Register Custom Post Type
 */

function bgn_register_services() {

  $labels = array(
    'name'                => _x( 'Service', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Services', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Service:', 'text_domain' ),
    'all_items'           => __( 'All Service', 'text_domain' ),
    'view_item'           => __( 'View Service', 'text_domain' ),
    'add_new_item'        => __( 'Add New Service', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'edit_item'           => __( 'Edit Service', 'text_domain' ),
    'update_item'         => __( 'Update Service', 'text_domain' ),
    'search_items'        => __( 'Search services', 'text_domain' ),
    'not_found'           => __( 'No services found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No services found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'services', 'text_domain' ),
    'description'         => __( 'Services information pages', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'revisions', 'page-attributes', ),
    'taxonomies'          => array( ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-tools',
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'services', $args );
}
add_action( 'init', 'bgn_register_services', 0 );
