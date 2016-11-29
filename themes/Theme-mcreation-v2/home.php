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

			<section class="page-general" id="profil" style="background-image: url('<?php the_field('fond_perso'); ?>');">

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


			<section class="page-general" id="realisation">
				<div id="owl-home" class="owl-carousel owl-theme">
					<?php 
						$loop = new WP_Query( array( 'post_type' => 'Portofolio', 'posts_per_page' => 4 ) );
						while ( $loop->have_posts() ) : $loop->the_post();
					?>
					<div class="item">	
						<div class="img_projet" style="background-image: url('');">
							<?php $name_projet = $loop->post_title();?>
							<a href="<?php echo esc_url( get_permalink( get_page_by_title( $name_projet ) ) ); ?>"><img src="<?php the_field('image');?>" /></a>
						</div>
					</div>
					<?php 
					endwhile;
					?>
				</div>

				<h1><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Portfolio' ) ) ); ?>">Voir toutes les réalisations</a></h1>

			</section>


			<section class="page-general" id="contact">

				<div class="contour">
					<div class="form">
						<?php if ( function_exists( 'smuzform_render_form' ) ) { smuzform_render_form('54'); } ?>
					</div>
				</div>
				
				<div class="contour">
					<p class="descrip_form">
						Ce formulaire permet une prise de contact directe. <br /></b>N'hésitez pas à l'utiliser pour une demande de création de site web, ou bien de participer à un de vos projets.<br /> Je vous repondrais par la suite avec l'adresse mail que vous allez indiquer dans le formulaire.
					</p>
				</div>
			</section>

			<?php endwhile; ?>
<?php get_footer(); ?>