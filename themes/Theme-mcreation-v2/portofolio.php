<?php /* Template Name: Portofolio  */ ?>

<?php get_header(); ?>
	<section class="page-general" id="portfolio" >
		
		<h2>Créations techniques</h2>
		<div class="loog_technique">
			<div id="owl-techn" class="owl-carousel owl-theme">
			<?php $loop = new WP_Query( array( 'post_type' => 'Portofolio', 'posts_per_page' => 1000, 'category_name' => 'technique' ) );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<div class="item">	
					<div class="img_projet_portofolio">
						<a href="<?php echo esc_url( get_permalink( $loop->id ) ); ?>"><img src="<?php the_field('image');?>" /></a>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
		
		<h2>Créations graphique</h2>
		<div class="loog_technique">
			<div id="owl-graph" class="owl-carousel owl-theme">
			<?php $loop = new WP_Query( array( 'post_type' => 'Portofolio', 'posts_per_page' => 1000, 'category_name' => 'graphisme	') );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
					<div class="item">
						<div class="img_projet_portofolio">
							<a href="<?php echo esc_url( get_permalink( $loop->id ) ); ?>"><img src="<?php the_field('image');?>" /></a>
						</div>
					</div>

			<?php endwhile; ?>
			</div>
		</div>
	</section>


<?php get_footer(); ?>