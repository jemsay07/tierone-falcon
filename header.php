<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* The header of our Theme
*
* This is the template displays the <head> section and everything up until <div id="primary">
*
*@link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
*@package Tierone
*/

?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php 
	$meta_tags = get_theme_mod( 'custom_meta', '' );
	if( !empty( $meta_tags ) ) :  echo $meta_tags; endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage" itemprop="mainContentOfPage">
	<header id="t-site-head" >
		<div class="container">
			<div class="tier-site-white">
				<div class="nav-top clearfix">
					<?php if( get_theme_mod( 'display_social_media_top', 0 ) ) : ?>
						<div class="col-xs-12 col-md-5">
							<?php tierone_social_media(); ?>
						</div>
					<?php endif; ?>
					<div class="col-xs-12 col-md-4 offset-md-3 pull-right">
						<div class="search-wrap"><?php get_search_form(); ?></div>
					</div>
				</div>
				<div class="nav-logo-wrap clearfix">
					<div class="col-md-5">
						<?php if ( function_exists( 'get_custom_logo' )  && has_custom_logo() ) :
								tierone_custom_logo();
							else :
								$desc = get_bloginfo( 'description', 'display');
								if ( $desc || is_customize_preview() ) :
							?>
								<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<p class="nav-desc site-description"><?php echo $desc; ?></p>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="col-md-7">
						<?php if ( is_active_sidebar( 'tier-site-ads670x70' ) ) {
								dynamic_sidebar( 'tier-site-ads670x70' );
							}
						?>
					</div>
				</div>
				<nav class="navbar navbar-default" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#tieroneMenu">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="tier-show-m nav-logo-wrap">
							<?php
								if ( function_exists( 'get_custom_logo' )  && has_custom_logo() ) :
									tierone_custom_logo();
								else :
									$desc = get_bloginfo( 'description', 'display');
									if ( $desc || is_customize_preview() ) :
								?>
									<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="bookmark"><?php echo bloginfo( 'name' ); ?></a></h1>
									<p class="nav-desc"><?php echo $desc; ?></p>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="collapse navbar-collapse" id="tieroneMenu">
						<?php
							if ( has_nav_menu( 'primary' ) ) {
								tierone_custom_menu();
							}
						?>

					<?php if( get_theme_mod( 'display_social_media_top', 0 ) ) : ?>
						<div class="tier-show-m">
							<?php tierone_social_media(); ?>
						</div>
					<?php endif; ?>
					</div>
				</nav>
			</div>
		</div>
	</header>
	<?php if ( ! is_front_page() && ! is_home() ) : ?>
		<div  class="breadcrumb-list">
			<div class="container">
				<div class="col-lg-12 col-md-12 tier-site-white">
					<?php echo  tierone_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>