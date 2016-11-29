<?php /* Template Name: Home  */ ?>

<?php get_header(); ?>

    <?php $query = new WP_Query(array('page_id' => 2, 'posts_per_page' => '1')); ?>
		<?php while ($query->have_posts()) : $query->the_post(); ?>

			<section class="page-general" id="home" style="background-image: url('<?php the_field('fond-header'); ?>');">
				
				<div class="titre_page">
					<h1><?php the_field('nom_prenom'); ?></h1>
					<h2><?php the_field('sous-titre'); ?></h2>
					<h3><?php the_field('sous-sous-titre'); ?></h3>
					<h4><?php the_field('age'); ?></h4>
				</div>
				
				<div class="r_s_page">
					<a href="<?php the_field('reseaux-sociaux-1'); ?>"><div></div></a>
					<a href="<?php the_field('reseaux-sociaux-2'); ?>"><div></div></a>
					<a href="<?php the_field('reseaux-sociaux-3'); ?>"><div></div></a>
				</div>
				
				<div class="fleche">
				
					<a href="#home-2"><img src="<?php echo get_template_directory_uri(); ?>/img/fleche_site.png" alt="fleche" /></a>
					
				</div>
			</section>

			<section class="page-general" id="home-2" style="background-image: url('<?php the_field('fond_perso'); ?>');">

				<div class="contour">
					<div class="photo_contour" style="background: url('<?php the_field('photo'); ?>');">
					</div>
				</div>
				
				<div class="contour">
				
					<div class="descrip">
						<p><?php the_field('descrip-1'); ?></p>
						<p><?php the_field('descrip-2'); ?></p>
						<p><?php the_field('descrip-3'); ?></p>
					</div>
				</div>
				
			</section>

			<section class="page-general" id="home-3">

				<?php 
					$loop = new WP_Query( array( 'post_type' => 'Portofolio', 'posts_per_page' => 4 ) );
					while ( $loop->have_posts() ) : $loop->the_post();
				?>
				<div class="img_projet" style="background-image: url('');">
					<img src="<?php the_field('image');?>" />
				</div>
				<?php 
				endwhile;
				?>
				
				
				<div class="img_projet" id="btn_plus">
				
					<a href="<?php get_page_link('portofolio'); ?>">Voir plus</a>
					
				</div>
			</section>

			<?php endwhile; ?>
<?php get_footer(); ?>