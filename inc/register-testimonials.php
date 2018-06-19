<?php
/**
 * Black Owned Register Testimonal Post Type
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since  1.0.0 [<init>]
 * @package blackowned
 */

$labels = array(
	'name'                  => _x( 'Testimonials', 'Post Type General Name', 'blackowned' ),
	'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'blackowned' ),
	'menu_name'             => __( 'Testimonials', 'blackowned' ),
	'name_admin_bar'        => __( 'Testimonial', 'blackowned' ),
	'archives'              => __( 'Testimonial Archives', 'blackowned' ),
	'attributes'            => __( 'Item Attributes', 'blackowned' ),
	'parent_item_colon'     => __( 'Parent Item: Name', 'blackowned' ),
	'all_items'             => __( 'All Testimonials', 'blackowned' ),
	'add_new_item'          => __( 'Add New Testimonial', 'blackowned' ),
	'add_new'               => __( 'Add New Testimonial', 'blackowned' ),
	'new_item'              => __( 'New Testimonial', 'blackowned' ),
	'edit_item'             => __( 'Edit Testimonial', 'blackowned' ),
	'update_item'           => __( 'Update Testimonial', 'blackowned' ),
	'view_item'             => __( 'View Testimonial', 'blackowned' ),
	'view_items'            => __( 'View Testimonials', 'blackowned' ),
	'search_items'          => __( 'Search Item', 'blackowned' ),
	'not_found'             => __( 'Not found', 'blackowned' ),
	'not_found_in_trash'    => __( 'Not found in Trash', 'blackowned' ),
	'featured_image'        => __( 'Featured Avatar', 'blackowned' ),
	'set_featured_image'    => __( 'Set featured avatar', 'blackowned' ),
	'remove_featured_image' => __( 'Remove featured avatar', 'blackowned' ),
	'use_featured_image'    => __( 'Use as featured avatar', 'blackowned' ),
	'insert_into_item'      => __( 'Insert into Testimonial', 'blackowned' ),
	'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'blackowned' ),
	'items_list'            => __( 'Items list', 'blackowned' ),
	'items_list_navigation' => __( 'Items list navigation', 'blackowned' ),
	'filter_items_list'     => __( 'Filter items list', 'blackowned' ),
);
$args = array(
	'label'                 => __( 'Testimonial', 'blackowned' ),
	'description'           => __( 'Testimonials', 'blackowned' ),
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	'taxonomies'            => array( 'testimonial_tag' ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 5,
	'menu_icon'             => 'dashicons-format-quote',
	'show_in_admin_bar'     => true,
	'show_in_nav_menus'     => true,
	'can_export'            => true,
	'has_archive'           => true,
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	'capability_type'       => 'post',
	'show_in_rest'          => true,
);
register_post_type( 'testimonial_post', $args );

/**
 * Filter for title placeholder
 * @param  [title] $input [title input for name]
 * @return [string]        [New placeholder for title]
 * @since  1.0.0 [<init>]
 */
function custom_enter_title( $input ) {
    global $post_type;
    /**
     * Change Title to name on Testimonial Post Type
     * @since  1.0.0 [<init>]
     */
    if( is_admin() && 'Enter title here' == $input && 'testimonial_post' == $post_type )
        $input = 'Enter Full Name Here';
    return $input;
}
add_filter('gettext','custom_enter_title');