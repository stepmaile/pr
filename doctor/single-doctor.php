<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
							<?php
							doc_posted_on();
							doc_posted_by();
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->

				<?php 

					if( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
				 
				?>

				<div class="entry-content">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'doc' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'doc' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<?php
					$value_rating = get_post_meta(get_the_ID(), '_custom_field_rating', true);
					echo 'Рейтинг: '.$value_rating.'<br>';
					$value_price = get_post_meta(get_the_ID(), '_custom_field_price', true);
					echo 'Стоимость: '.$value_price.'<br>';
					$value_experience = get_post_meta(get_the_ID(), '_custom_field_experience', true);
					echo 'Стаж: '.$value_experience.'<br>';

					$specialization = get_terms( ['specialization'] );
					echo 'Специализация: '.$specialization[0]->name.'<br>';
					$city = get_terms( ['city'] );
					echo 'Город: '.$city[0]->name;
				?>

			</article>

<?php
		endwhile; 
		?>

	</main>

<?php

get_footer();
