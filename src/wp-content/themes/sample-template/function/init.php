<?php
/** create custom-post-type init function */
function nt_create_post_type($args) {
    if(!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['slug']) return;
    $post_type = $args['post_type'];
    $name = $args['name'];
    $single = $args['single'];
    $slug = $args['slug'];
    $icon = $args['menu_icon'];

    register_post_type($post_type, array(
        'labels' => array(
            'name' => __($name),
            'singular_name' => __($single),
            'add_new' => __('Add New '.$single),
            'add_new_item' => __('Add New '.$single),
            'edit_item' => __('Edit '.$single),
            'new_item' => __('New '.$single),
            'all_items' => __('All '.$name),
            'view_item' => __('View '.$single),
            'search_items' => __('Search '.$name),
            'not_found' => __('Not Found '.$single),
            'not_found_in_trash' => __('Not Found '.$single.' In Trash'),
            'parent_item_colon' => '',
            'menu_name' => __($name)
        ),
        'public' => true,
        'menu_icon' => $icon,
        'exclude_from_search' => false,
        'menu_position' => 6,
        'has_archive' => false,
        'taxonomies' => array($post_type),
        'rewrite' => array('slug' => $slug),
        'supports' => array('title', 'editor', 'excerpt', 'revisions', 'thumbnail', 'author')
    ));
}
function nt_create_taxonomy($args) {
    if(!is_array($args) || !$args['post_type'] || !$args['name'] || !$args['single'] || !$args['taxonomy'] || !$args['slug']) return;
    $post_type = $args['post_type'];
    $name = $args['name'];
    $single = $args['single'];
    $slug = $args['slug'];
    $taxonomy = $args['taxonomy'];

    $labels = array(
        'name' => __($name),
        'singular_name' => __($single),
        'search_items' => __('Search '.$name),
        'popular_items' => __('Popular '.$name),
        'all_items' => __('All '.$name),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit '.$single),
        'update_item' => __('Update '.$single),
        'add_new_item' => __('Add '.$single),
        'new_item_name' => __('New '.$single),
        'menu_name' => __($name),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $slug),
    );
    register_taxonomy($taxonomy, $post_type, $args);
}
/**------------------------------------------------ */

/** Menu **/
// register_nav_menus(
//     array(
//         'main_menu' => __( 'Header menu' ),
//     )
// );

/** theme option acf **/
// if( function_exists('acf_add_options_page') ) {
// 	acf_add_options_page(array(
//         'page_title'    => 'Theme Option',
//         'menu_title'    => 'Theme Option',
//         'menu_slug'     => 'Theme Option',
//         'parent_slug'   => '',
//         'position'      => false,
//         'icon_url'      => false,
//     ));
// }


function create_new_custom_post_type_and_taxonomy(){

    // Post type service
    // $args = array(
    //     "post_type" => 'service',
    //     "name" => "Service",
    //     "single" => "Service",
    //     "slug" => "service",
    //     'menu_icon' => 'dashicons-admin-comments',
    // );
    // nt_create_post_type($args);

    //taxonomy
    // $args = array(
    //     "post_type" => array('service'),
    //     "name" => "Categories",
    //     "single" => "Categories",
    //     "slug" => "categories_work",
    //     "taxonomy" => "categories_work",
    // );
    // nt_create_taxonomy($args);
}
add_action('init', 'create_new_custom_post_type_and_taxonomy');

?>