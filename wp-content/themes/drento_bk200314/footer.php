<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drento
 */

?>
	</div><!-- #content -->
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
		<footer id="colophon" class="site-footer smallPart">
			<div class="site-info">
				<?php
				$copyrightText = get_theme_mod('drento_theme_options_copyrighttext', '&copy; '.date('Y').' '. get_bloginfo('name'));
				if ($copyrightText || is_customize_preview()): ?>
					<span class="custom"><?php echo do_shortcode(wp_kses_post($copyrightText)); ?></span>
				<?php endif; ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	<?php endif; ?>
</div><!-- #page -->
<a href="#top" id="toTop" aria-hidden="true"><i class="fa fa-angle-up fa-3x"></i></a>
<?php wp_footer(); ?>

</body>
</html>
