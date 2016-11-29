<?php /* Template Name: Portofolio  */ ?>

<?php get_header(); ?>
	<section class="page-general" id="portfolio" >
		
		<h2>Créations techniques</h2>
		<div class="loog_technique">
			<?php $loop = new WP_Query( array( 'post_type' => 'Portofolio', 'posts_per_page' => 1000, 'category_name' => 'technique' ) );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<div class="img_projet_portofolio" style="background-image: url('');">
						<a href="/portofolio/<?php  echo the_ID(); ?>"><img src="<?php the_field('image');?>" /></a>
					</div>

			<?php endwhile; ?>
		</div>
		
		<h2>Créations graphique</h2>
		<div class="loog_technique">
			<?php $loop = new WP_Query( array( 'post_type' => 'Portofolio', 'posts_per_page' => 1000, 'category_name' => 'graphisme	') );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<div class="img_projet_portofolio" style="background-image: url('');">
						<a href="<?php  get_page_by_title(the_title()); ?>"><img src="<?php the_field('image');?>" /></a>
					</div>

			<?php endwhile; ?>
		</div>
	</section>
<?php get_footer(); ?>