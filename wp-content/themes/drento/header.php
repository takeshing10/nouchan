<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package drento
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}
?>
<?php
	$hideSearch = get_theme_mod('drento_theme_options_hidesearch', '1');
	$showSocial = get_theme_mod('drento_theme_options_showsocial', '1');
	$facebookURL = get_theme_mod('drento_theme_options_facebookurl', '#');
	$twitterURL = get_theme_mod('drento_theme_options_twitterurl', '#');
	$googleplusURL = get_theme_mod('drento_theme_options_googleplusurl', '#');
	$linkedinURL = get_theme_mod('drento_theme_options_linkedinurl', '#');
	$instagramURL = get_theme_mod('drento_theme_options_instagramurl', '#');
	$youtubeURL = get_theme_mod('drento_theme_options_youtubeurl', '#');
	$pinterestURL = get_theme_mod('drento_theme_options_pinteresturl', '#');
	$tumblrURL = get_theme_mod('drento_theme_options_tumblrurl', '#');
	$vkURL = get_theme_mod('drento_theme_options_vkurl', '#');
	$imdbURL = get_theme_mod('drento_theme_options_imdburl', '');
	$twitchURL = get_theme_mod('drento_theme_options_twitchurl', '');
	$spotifyURL = get_theme_mod('drento_theme_options_spotifyurl', '');
	$whatsAppURL = get_theme_mod('drento_theme_options_whatsappurl', '');
?>
<div id="page" class="hfeed site">
	<?php if ($hideSearch == 1 ) : ?>
		<!-- Start: Search Form -->
		<div id="search-full" class="drentoSearchFull">
			<div class="search-container">
				<?php get_search_form(); ?>
			</div>
		</div>
		<!-- End: Search Form -->
	<?php endif; ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'drento' ); ?></a>
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>
		<header id="masthead" class="site-header">
			<?php
			if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div class="main-sidebar-box"><span></span></div>
				<div class="opacityBox"></div>
			<?php endif; ?>

			<div class="site-header-layout">
                <div class="site-branding">
					<?php
					if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					$drento_description = get_bloginfo( 'description', 'display' );
					if ( $drento_description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo $drento_description; /* // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
					<?php endif; ?>
                </div><!-- .site-branding -->
                <div class="site-sns-menu">
					<?php if ($showSocial == 1 ) : ?>
                        <div class="socialLine">
                            <!--				<div class="drentoSocial"><i class="fa fa-share-alt fa-2x"></i></div>-->
							<?php if (!empty($facebookURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($facebookURL); ?>" title="<?php esc_attr_e( 'Facebook', 'drento' ); ?>"><i class="fa fa-facebook fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($twitterURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($twitterURL); ?>" title="<?php esc_attr_e( 'Twitter', 'drento' ); ?>"><i class="fa fa-twitter fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($googleplusURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($googleplusURL); ?>" title="<?php esc_attr_e( 'Google Plus', 'drento' ); ?>"><i class="fa fa-google-plus fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Google Plus', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($linkedinURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($linkedinURL); ?>" title="<?php esc_attr_e( 'Linkedin', 'drento' ); ?>"><i class="fa fa-linkedin fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($instagramURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($instagramURL); ?>" title="<?php esc_attr_e( 'Instagram', 'drento' ); ?>"><i class="fa fa-instagram fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($youtubeURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($youtubeURL); ?>" title="<?php esc_attr_e( 'YouTube', 'drento' ); ?>"><i class="fa fa-youtube fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($pinterestURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($pinterestURL); ?>" title="<?php esc_attr_e( 'Pinterest', 'drento' ); ?>"><i class="fa fa-pinterest fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($tumblrURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($tumblrURL); ?>" title="<?php esc_attr_e( 'Tumblr', 'drento' ); ?>"><i class="fa fa-tumblr fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($vkURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($vkURL); ?>" title="<?php esc_attr_e( 'VK', 'drento' ); ?>"><i class="fa fa-vk fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'VK', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($imdbURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($imdbURL); ?>" title="<?php esc_attr_e( 'Imdb', 'drento' ); ?>"><i class="fa fa-imdb fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Imdb', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($twitchURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($twitchURL); ?>" title="<?php esc_attr_e( 'Twitch', 'drento' ); ?>"><i class="fa fa-twitch fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Twitch', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($spotifyURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($spotifyURL); ?>" title="<?php esc_attr_e( 'Spotify', 'drento' ); ?>"><i class="fa fa-spotify fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'Spotify', 'drento' ); ?></span></i></a>
							<?php endif; ?>
							<?php if (!empty($whatsAppURL)) : ?>
                                <a target="_blank" href="<?php echo esc_url($whatsAppURL); ?>" title="<?php esc_attr_e( 'WhatsApp', 'drento' ); ?>"><i class="fa fa-whatsapp fa-2x"><span class="screen-reader-text"><?php esc_html_e( 'WhatsApp', 'drento' ); ?></span></i></a>
							<?php endif; ?>
                            <a target="_blank" href="https://musubihiraku.net/" title="Homepage"><i class="fa fa-desktop fa-2x"><span class="screen-reader-text">Homepage</span></i></a>
                        </div>
					<?php endif; ?>

                    <div id="nav-toggle">
                        <div>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div id="gloval-nav">
                        <nav>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                        </nav>
                    </div><!-- /#gloval-nav -->
                </div>
            </div>
		</header><!-- #masthead -->
<script>
    (function($) {
        $(function () {
            $('#nav-toggle').on('click', function() {
                $('body').toggleClass('open');
            });
        });
    })(jQuery);
</script>
	<?php endif; ?>
	<div id="content" class="site-content">
