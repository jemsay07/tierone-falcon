<?php
/**
* This will only display the Social Media .
*/

function tierone_social_media() {
	if ( get_theme_mod( 'display_social_media_top', 0 )  || get_theme_mod( 'display_social_media_bottom', 0 ) ) { ?>
	<ul class="top-social">
		<?php if( get_theme_mod( 'facebook_url', '' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'facebook_url', '' ) ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
		<?php } ?>

		<?php if( get_theme_mod( 'twitter_url', '' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'twitter_url', '' ) ); ?>" target="_blank"><i class="fa fa-twitter "></i></a></li>
		<?php } ?>

		<?php if( get_theme_mod( 'pinterest_url', '' ) ) { ?>	
			<li><a href="<?php echo esc_url( get_theme_mod( 'pinterest_url', '' ) ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
		<?php } ?>

		<?php if( get_theme_mod( 'google_plus_url', '' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'google_plus_url', '' ) ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
		<?php } ?>

		<?php if( get_theme_mod( 'youtube_url', '' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'youtube_url', '' ) ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
		<?php } ?>

		<?php if( get_theme_mod( 'linkedin_url', '' ) ) { ?>
			<li><a href="<?php echo esc_url( get_theme_mod( 'linkedin_url', '' ) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
		<?php } ?>
	</ul>
	<?php } 
}
?>
