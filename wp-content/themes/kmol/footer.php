<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package kmol
 * @since kmol 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer container_12" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'kmol_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'kmol' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'kmol' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'kmol' ), 'kmol', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>