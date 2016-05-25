<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ocr_wp
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="card">
		<div class="card-block">
		<h4 class="card-title"><?php 
		if(is_home() || is_front_page()) : echo "Bienvenue sur le site de la ville de Nancy";
		else :
		the_title( '<h1 class="entry-title">', '</h1>' );
		endif;
		 ?>
		</h4>
			<div class="entry-img">
				<?php if ( has_post_thumbnail() ) : ?>
				<?php  the_post_thumbnail( get_the_ID(), 'card-size' );  ?>
				
				<?php endif; ?>
			</div>
		</div>
		<div class="entry-container">
			<header class="entry-header">
				
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'ocr_wp' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php edit_post_link( __( 'Edit', 'ocr_wp' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->
		</div> <!-- .entry-container -->
	</div> <!-- .card -->
</article><!-- #post-## -->
