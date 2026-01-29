<?php get_header(); ?>
    <form id="filter-form" method="GET" action="#" class="form">
    <input type="hidden" id="ajax-url" value="<?php echo admin_url('admin-ajax.php'); ?>">

    <div class="specialization">
        <label class="" for="specialization">Специализация:</label>
        <select class="" id="specialization" name="specialization">
            <option value="">Все</option>
            <?php
            $event_terms = get_terms([
                'taxonomy' => 'specialization',
                'hide_empty' => false, 
            ]);
            if (!empty($event_terms) && !is_wp_error($event_terms)) {
                foreach ($event_terms as $term) {
                    echo '<option value="' . esc_attr($term->slug) . '" ' . selected($_GET['specialization'] ?? '', $term->slug, false) . '>' . esc_html($term->name) . '</option>';
                }
            }
            ?>
        </select>
    </div>
    
    <div class="city">
        <label class="" for="city">Город:</label>
        <select class="" id="city" name="city">
            <option value="" <?php selected($_GET['city'] ?? '', 'all', true); ?>>Все</option>
            <?php
            $event_terms = get_terms([
                'taxonomy' => 'city', 
                'hide_empty' => false, 
            ]);
            if (!empty($event_terms) && !is_wp_error($event_terms)) {
                foreach ($event_terms as $term) {
                    echo '<option value="' . esc_attr($term->slug) . '" ' . selected($_GET['city'] ?? '', $term->slug, false) . '>' . esc_html($term->name) . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <div class="star">
        <label class="" for="star">Рейтинг:</label>
        <select class="" id="star" name="star">
            <option value="all" <?php selected($_GET['star'] ?? '', 'all', true); ?>>Все</option>
            <option value="0" <?php selected($_GET['star'] ?? '', 0, true); ?>>0</option>
            <option value="1" <?php selected($_GET['star'] ?? '', 1, true); ?>>1</option>
            <option value="2" <?php selected($_GET['star'] ?? '', 2, true); ?>>2</option>
            <option value="3" <?php selected($_GET['star'] ?? '', 3, true); ?>>3</option>
            <option value="4" <?php selected($_GET['star'] ?? '', 4, true); ?>>4</option>
            <option value="5" <?php selected($_GET['star'] ?? '', 5, true); ?>>5</option>
            <?php
            $event_terms = get_terms([
                'taxonomy' => 'star', 
                'hide_empty' => false, 
            ]);
            if (!empty($event_terms) && !is_wp_error($event_terms)) {
                foreach ($event_terms as $term) {
                    echo '<option value="' . esc_attr($term->slug) . '" ' . selected($_GET['star'] ?? '', $term->slug, false) . '>' . esc_html($term->name) . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <button type="submit" class="filter-button">Поиск</button>
</form>


<?php
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
$city = (get_query_var('city')) ? get_query_var('city') : '';
$specialization = (get_query_var('specialization')) ? get_query_var('specialization') : '';
$star = isset($_GET['star']) ? sanitize_text_field($_GET['star']) : 'all';

$args = array(
    'posts_per_page' => 9,
    'order'      => 'DESC',
    'post_type'      => 'doctor',
    'paged'          => $paged,
    'city' => $city,
    'specialization' => $specialization
);

if (isset($star) && $star != 'all') {
    $args['meta_query'][] = [
        'key' => '_custom_field_rating',
        'value' => (int)$star,
        'compare' => 'LIKE',
    ];
}

$doctorsQuery = new WP_Query( $args );

if ( $doctorsQuery->have_posts() ) :
    while ( $doctorsQuery->have_posts() ) : $doctorsQuery->the_post(); ?>
        <article class="<?php post_class(); ?>">
            <h1><?php the_title(); ?></h1>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
            <a href="<?php the_permalink(); ?>">Читать далее</a> 
        </article>                  
    <?php endwhile;
endif; ?>
<?php
if(!$doctorsQuery->have_posts()){
    echo "<h2>Записей не найдено</h2>";
}
?>                    
<div class="page_nav">
    <?php
    $GLOBALS['wp_query']->max_num_pages = $doctorsQuery->max_num_pages;
    the_posts_pagination(array(
        'type'=>'inline',
        'screen_reader_text' => __( '' ),
        'format' => '?page=%#%',
        'current' => max( 1, get_query_var('page') ),
        'end_size'     => 1,
        'mid_size'     => 1,
        'prev_next'    => True,
        'prev_text'    => __('<i class="fa fa-angle-left"></i>'),
        'next_text'    => __('<i class="fa fa-angle-right"></i>'),
        'add_args'     => False
    ));
    ?>
</div>
<?php  wp_reset_postdata(); ?>


<?php get_footer(); ?>