<?php 
function reviews_custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Google Reviews', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'review', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Google Reviews', 'text_domain' ),
		'name_admin_bar'        => __( 'Google Review', 'text_domain' ),
		'archives'              => __( 'Google Review Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Google Review:', 'text_domain' ),
		'all_items'             => __( 'All Google Reviews', 'text_domain' ),
		'add_new_item'          => __( 'Add New Google Review', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Google Review', 'text_domain' ),
		'edit_item'             => __( 'Edit Google Review', 'text_domain' ),
		'update_item'           => __( 'Update Google Review', 'text_domain' ),
		'view_item'             => __( 'View Google Review', 'text_domain' ),
		'search_items'          => __( 'Search Google Reviews', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into review', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this review', 'text_domain' ),
		'items_list'            => __( 'Google Reviews list', 'text_domain' ),
		'items_list_navigation' => __( 'Google Reviews list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter reviews list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'review', 'text_domain' ),
		'description'           => __( 'Google Review Posts', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-star-filled',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'review', $args );

}
add_action( 'init', 'reviews_custom_post_type', 0 );
function review_taxonomy() {
    register_taxonomy(
        'reviews',
        array('page','review', 'cases'),
        array(
            'hierarchical' => true,
            'label' => 'Google Reviews',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'reviews',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'review_taxonomy');
?>