<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ocr_wp
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer bg-inverse" role="contentinfo">

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
					<div id="footer-sidebar" class="secondary pull-right">
						<div id="footer-sidebar1">
						<?php
						if(is_active_sidebar('footer-sidebar-1')){
						dynamic_sidebar('footer-sidebar-1');
						}
						?>
						</div>
					
					</div><!-- .footer-sidebar -->
				</div> <!-- col-lg-12 -->
			</div><!-- .row -->
		</div><!-- .containr -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
