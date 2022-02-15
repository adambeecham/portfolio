<?php

function bgn_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0]  = 'News';
	$submenu['edit.php'][10][0] = 'Add Article';
	$submenu['edit.php'][16][0] = 'Tags';
	echo '';
}

function bgn_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name               = 'Articles';
	$labels->singular_name      = 'Article';
	$labels->add_new            = 'Add Article';
	$labels->add_new_item       = 'Add Article';
	$labels->edit_item          = 'Edit Article';
	$labels->new_item           = 'Article';
	$labels->view_item          = 'View Article';
	$labels->search_items       = 'Search Articles';
	$labels->not_found          = 'No Articles found';
	$labels->not_found_in_trash = 'No Articles found in Trash';
	$labels->all_items          = 'All Articles';
	$labels->menu_name          = 'Articles';
	$labels->name_admin_bar     = 'Articles';
}

add_action( 'admin_menu', 'bgn_change_post_label' );
add_action( 'init', 'bgn_change_post_object' );

function bgn_menu_news_icon() {
	global $menu;
	foreach ( $menu as $key => $val ) {
		if ( __( 'News') == $val[0] ) {
			$menu[$key][6] = 'dashicons-admin-post';
		}
	}
}
add_action( 'admin_menu', 'bgn_menu_news_icon' );

function bgn_news_messages( $messages ) {
	global $post, $post_ID;

	$messages['post'] = array(
		0  => '',
		1  => sprintf( __( 'Article Updated. <a href="%s">View Article</a>' ), esc_url( get_permalink( $post_ID ) ) ),
		2  => __( 'Custom field updated.' ),
		3  => __( 'Custom field deleted.' ),
		4  => __( 'Article updated.' ),
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Article restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Article published. <a href="%s">View Article</a>' ), esc_url( get_permalink( $post_ID ) ) ),
		7  => __( 'Article saved.' ),
		8  => sprintf( __( 'Article submitted. <a target="_blank" href="%s">Preview Article</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9  => sprintf( __( 'Article scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Article</a>' ),
					date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Article draft updated. <a target="_blank" href="%s">Preview Article</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}
add_filter('post_updated_messages', 'bgn_news_messages');