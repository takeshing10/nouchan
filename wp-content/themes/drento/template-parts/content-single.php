<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package drento
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
		if ( '' != get_the_post_thumbnail() ) {
			echo '<div class="entry-featuredImgSingle">';
			the_post_thumbnail('drento-normal-post');
			echo '</div>';
		}
	?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'drento' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links-number">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'drento' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php drento_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

