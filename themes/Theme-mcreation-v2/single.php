<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section id="page_projet">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		
			<div class="img_prez">
				<img src="<?php the_field('image_prez'); ?>" alt="<?php the_title();?>" />
			</div>
			<?php the_content(); ?>

		
		<a href="<?php the_field('lien_de_la_demo'); ?>"><button>Démo</button></a>
		
		<?php endwhile; ?>
		<?php else: ?>

			<!-- article -->
			<article>

				<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

			</article>
			<!-- /article -->

		<?php endif; ?>
	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
