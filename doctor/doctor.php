<?php
/*
Plugin Name: Doctor
Plugin URI: http://
Description: Plugin doctor post type
Version: 1.0
Author: ...
Author URI:http://
License: GPLv2
Textdomain: ....
*/

function create_doctor_posttype() {
    $labels = array(
        'name' => _x( 'Доктора', 'Тип записей Доктора', '' ),
        'singular_name' => _x( 'Доктора', 'Тип записей Доктор', '' ),
        'menu_name' => __( 'Доктора', '' ),
        'all_items' => __( 'Все Доктора', '' ),
        'view_item' => __( 'Смотреть Доктора', '' ),
        'add_new_item' => __( 'Добавить нового Доктора', '' ),
        'add_new' => __( 'Добавить нового', '' ),
        'edit_item' => __( 'Редактировать Доктора', '' ),
        'update_item' => __( 'Обновить Доктора', '' ),
        'search_items' => __( 'Искать Доктора', '' ),
        'not_found' => __( 'Не найдено', '' ),
        'not_found_in_trash' => __( 'Не найдено в корзине', '' ),
    );

    $args = array(
        'label' => __( 'doctor', '' ),
        'description' => __( 'Доктора', '' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies' => array( 'genres' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'rewrite' => array(
            'slug'       => 'doctor',
            'with_front' => false,
            'pages'      => true,
            'feeds'      => false,
            'feed'       => false
        ),
    );

    register_post_type( 'doctor', $args );

}
add_action( 'init', 'create_doctor_posttype', 0 );



add_action( 'init', 'create_specialization', 0 );
function create_specialization () {
$args = array(
    'label' => _x( 'Специализация', 'taxonomy general name' ),
    'labels' => array(
    'name' => _x( 'Специализации', 'taxonomy general name' ),
    'singular_name' => _x( 'R', 'taxonomy singular name' ),
    'menu_name' => __( 'Специализация' ),
    'all_items' => __( 'Все Специализации' ),
    'edit_item' => __( 'Изменить Специализацию' ),
    'view_item' => __( 'Просмотреть Специализацию' ),
    'update_item' => __( 'Обновить Специализацию' ),
    'add_new_item' => __( 'Добавить Специализацию' ),
    'new_item_name' => __( 'Название' ),
    'parent_item' => __( 'Родительская' ),
    'parent_item_colon' => __( 'Родительская:' ),
    'search_items' => __( 'Поиск Специализации' ),
    'popular_items' => null,
    'separate_items_with_commas' => null,
    'add_or_remove_items' => null,
    'choose_from_most_used' => null,
    'not_found' => __( 'Специализация не найдена.' ),
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'show_in_quick_edit' => true,
    'meta_box_cb' => null,
    'show_admin_column' => false,
    'description' => '',
    'hierarchical' => true,
    'update_count_callback' => '',
    'query_var' => true,
    'rewrite' => array(
    'slug' => 'specialization',
    'with_front' => false,
    'hierarchical' => true,
    'ep_mask' => EP_NONE,
),
    'sort' => null,
    '_builtin' => false,
);
    register_taxonomy( 'specialization', array('doctor'), $args );
}

add_action( 'init', 'create_city', 0 );
function create_city () {
$args = array(
    'label' => _x( 'Город', 'taxonomy general name' ),
    'labels' => array(
    'name' => _x( 'Города', 'taxonomy general name' ),
    'singular_name' => _x( 'R', 'taxonomy singular name' ),
    'menu_name' => __( 'Города' ),
    'all_items' => __( 'Все Города' ),
    'edit_item' => __( 'Изменить Город' ),
    'view_item' => __( 'Просмотреть Город' ),
    'update_item' => __( 'Обновить Город' ),
    'add_new_item' => __( 'Добавить Город' ),
    'new_item_name' => __( 'Название' ),
    'parent_item' => __( 'Родительская' ),
    'parent_item_colon' => __( 'Родительская:' ),
    'search_items' => __( 'Поиск Города' ),
    'popular_items' => null,
    'separate_items_with_commas' => null,
    'add_or_remove_items' => null,
    'choose_from_most_used' => null,
    'not_found' => __( 'Город не найден.' ),
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'show_in_quick_edit' => true,
    'meta_box_cb' => null,
    'show_admin_column' => false,
    'description' => '',
    'hierarchical' => true,
    'update_count_callback' => '',
    'query_var' => true,
    'rewrite' => array(
    'slug' => 'city',
    'with_front' => false,
    'hierarchical' => true,
    'ep_mask' => EP_NONE,
),
    'sort' => null,
    '_builtin' => false,
);
    register_taxonomy( 'city', array('doctor'), $args );
}


function add_custom_meta_box( string $post_type ): void {
    if (in_array($post_type, ['doctor'], true)) {
        add_meta_box(
            'custom_meta_box',
            __('мета-поля для “Доктора”', 'textdomain'),
            'render_custom_meta_box',
            $post_type,
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'add_custom_meta_box');

function render_custom_meta_box( WP_Post $post ): void {
    wp_nonce_field('custom_meta_box_nonce', 'custom_meta_box_nonce');
    $value = get_post_meta($post->ID, '_custom_field_experience', true);
    echo '<label for="custom_field_experience">';
    _e('Стаж врача:', 'textdomain');
    echo '</label> ';
    echo '<input type="text" id="custom_field_experience" name="custom_field_experience" value="' . esc_attr($value) . '" size="25" />';

    echo '<br>';
    $value = get_post_meta($post->ID, '_custom_field_price', true);
    echo '<label for="custom_field_price">';
    _e('Цена от:', 'textdomain');
    echo '</label> ';
    echo '<input type="text" id="custom_field_price" name="custom_field_price" value="' . esc_attr($value) . '" size="25" />';

    echo '<br>';
    $value = get_post_meta($post->ID, '_custom_field_rating', true);
    echo '<label for="custom_field_rating">';
    _e('Рейтинг (0-5):', 'textdomain');
    echo '</label> ';
    echo '<input type="number" id="custom_field_rating" name="custom_field_rating" value="' . esc_attr($value) . '" size="25" min="0" max="5" />';
}

function save_custom_meta_box_data( int $post_id ): void {
    if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], 'custom_meta_box_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_type']) && 'page' === $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    $custom_field_data = sanitize_text_field($_POST['custom_field_experience']);
    update_post_meta($post_id, '_custom_field_experience', $custom_field_data);

    $custom_field_data = sanitize_text_field($_POST['custom_field_price']);
    update_post_meta($post_id, '_custom_field_price', $custom_field_data);

    $custom_field_data = sanitize_text_field($_POST['custom_field_rating']);
    update_post_meta($post_id, '_custom_field_rating', $custom_field_data);
}
add_action('save_post', 'save_custom_meta_box_data');



function load_archive_template( $template ) {
    global $post;

    if ( !empty($post) && 'doctor' === $post->post_type && locate_template( array( 'archive-doctor.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . 'archive-doctor.php';
    } else {
        return plugin_dir_path( __FILE__ ) . 'archive-doctor.php';
    }

    return $template;
}

add_filter( 'archive_template', 'load_archive_template' );

function load_single_template( $template ) {
    global $post;

    if ( !empty($post) && 'doctor' === $post->post_type && locate_template( array( 'single-doctor.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . 'single-doctor.php';
    }

    return $template;
}

add_filter( 'single_template', 'load_single_template' );