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
<div class="border-fixed border-top"></div>
<div class="border-fixed border-bottom"></div>
<div class="border-fixed border-left"></div>
<div class="border-fixed border-right"></div>
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
			<div class="site-branding">
				<?php
				if ( is_front_page() && is_home() ) : ?>
<!--					<h1 class="site-title"><a href="/" rel="home"><img src="/wp-content/uploads/2020/12/nou0.svg"></a></h1>-->
                    <h1 class="site-title"><a href="/" rel="home">脳ちゃんとタマ子</a></h1>
				<?php else : ?>
<!--					<p class="site-title"><a href="/" rel="home"><img src="/wp-content/uploads/2020/12/nou0.svg"></a></p>-->
                    <p class="site-title"><a href="/" rel="home">脳ちゃんとタマ子</a></p>
				<?php
                endif;
				$drento_description = get_bloginfo( 'description', 'display' );
				if ( $drento_description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $drento_description; /* // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<?php if ($showSocial == 1 ) : ?>
			<div class="socialLine">
				<div class="drentoSocial"><i class="fa fa-share-alt fa-2x"></i></div>
                <a href="https://www.instagram.com/ringo_takenaka/" target="_blank" title="Instagram"><i class="fa fa-instagram fa-lg"><span class="screen-reader-text">Instagram</span></i></a>
                <a href="https://twitter.com/ringo_musubi" target="_blank" title="Twitter"><i class="fa fa-twitter fa-lg"><span class="screen-reader-text">Twitter</span></i></a>
                <a href="https://musubihiraku.net/" target="_blank" title="Website"><i class="fa fa-desktop fa-lg"><span class="screen-reader-text">Website</span></i></a>
			</div>
			<?php endif; ?>

			<nav id="site-navigation" class="main-navigation">
				<!--?php if ($hideSearch == 1 ) : ?-->
<!--					<div class="drentoSearch"><i class="fa fa-search fa-2x"></i></div>-->
				<!--?php endif; ?-->
				<!--?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?-->
                    <a href="/category/main/?latest"><img src="/wp-content/uploads/2020/12/nou01.svg"></a>
                    <a href="/category/manual/"><img src="/wp-content/uploads/2020/12/nou02.svg"></a>
                    <a href="/profile"><img src="/wp-content/uploads/2020/12/nou03.svg"></a>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->
	<?php endif; ?>
	<div id="content" class="site-content">
