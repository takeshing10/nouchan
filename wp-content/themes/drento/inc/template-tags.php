<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package drento
 */

if ( ! function_exists( 'drento_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function drento_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on"><i class="fa fa-clock-o spaceRight" aria-hidden="true"></i>' . $posted_on . '</span><span class="byline"><i class="fa fa-user spaceLeftRight" aria-hidden="true"></i>' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comments-o spaceLeftRight" aria-hidden="true"></i>';
		comments_popup_link( esc_html__( 'Leave a comment', 'drento' ), esc_html__( '1 Comment', 'drento' ), esc_html__( '% Comments', 'drento' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'drento_entry_category' ) ) :
function drento_entry_category() {
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
endif;

if ( ! function_exists( 'drento_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function drento_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( '', '' );
		if ( $tags_list ) {
			echo '<span class="tags-links">' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'drento' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link"><i class="fa fa-wrench spaceLeftRight"></i>',
		'</span>'
	);
}
endif;
