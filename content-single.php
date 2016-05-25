<?php
/**
 * @package ocr_wp
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="card">
		<div class="card-block">
		<h4 class="card-title"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h4>
			
				<?php if ( has_post_thumbnail() ) : ?>
				<?php  the_post_thumbnail( get_the_ID () , 'card-size' );  ?>
				<?php endif; ?>
			
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<div class="entry-meta">
					<?php ocr_wp_posted_on(); ?>
				</div><!-- .entry-meta -->
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
				<?php ocr_wp_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div> <!-- .entry-container -->
	</div> <!-- .card -->
</article><!-- #post-## -->
