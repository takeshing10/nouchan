<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package drento
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $postType = get_theme_mod('drento_theme_options_posttype', 'excerpt'); ?>
	<div class="drentoContentBox">
		<?php
			if ( '' != get_the_post_thumbnail() ) {
				echo '<figure class="entry-featuredImg"><a href="' .esc_url(get_permalink()). '" title="' .the_title_attribute('echo=0'). '">';
				the_post_thumbnail('drento-little-post', array( 'alt' => get_the_title()));
				echo '</a><figcaption></figcaption></figure>';
			}
		?>
		<div class="drentoContentText">
				<?php if($postType == 'fullpost'): ?>
					<div class="entry-content">
						<?php
						the_content( sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'drento' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						) );
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'drento' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span class="page-links-number">',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'drento' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
						?>
					</div><!-- .entry-summary -->
				<?php else : ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				<?php endif; ?>

			<footer class="entry-footer">
				<?php if($postType == 'excerpt'): ?>
					<span class="read-more"><a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'drento') ?></a><i class="fa spaceLeft fa-caret-right"></i></span>
				<?php endif; ?>
				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'drento' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link"><i class="fa fa-wrench spaceLeftRight"></i>',
						'</span>'
					);
				?>
			</footer><!-- .entry-footer -->
		</div><!-- .drentoContentText -->
	</div><!-- .drentoContentBox -->
</article><!-- #post-## -->
<!--<div class="drentoDiv"></div>-->
