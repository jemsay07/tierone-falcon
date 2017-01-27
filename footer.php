<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* The Template for displaying for footer
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package tierone
*/
?>
		<footer class="tier-footer">
			<div class="container">
				<div class="tier-footer-socket main-widget-area row">
					<?php if( is_active_sidebar( 'tier-footer-a' ) || is_active_sidebar( 'tier-footer-b' ) || is_active_sidebar( 'tier-footer-c' ) ) : ?>
						<div class="col-md-4">
							<?php dynamic_sidebar( 'tier-footer-a' ); ?>
							<div class="social-media-footer">
								<?php  if( get_theme_mod( 'display_social_media_bottom',0 ) ) : 
										tierone_social_media();
									endif;
								?>
							</div>
						</div>
						<div class="col-md-4">
							<?php dynamic_sidebar( 'tier-footer-b' ); ?>
						</div>
						<div class="col-md-4">
							<?php dynamic_sidebar( 'tier-footer-c' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="tier-footer-cont">
				<div class="container">
					<?php $footer_editor = get_theme_mod( 'footer_editor','' );
						if ( !empty( $footer_editor ) ) {
							echo wp_kses_post( $footer_editor );
						}else{
							$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '"  title="' . esc_attr( get_bloginfo( 'blogname' ) ) . '"></a>';
							printf( __( '&#169; TIER. %1$s %2$s Blogsite Theme by Niel Rosini','tierone' ), date_i18n( 'Y' ), $site_link );
						}
					?>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
		<?php  $html_editor = get_theme_mod( 'custom_editor', '' );
		if( !empty( $html_editor ) ) :  echo $html_editor; endif; ?> <!--Html Editor-->
	</body>
</html>