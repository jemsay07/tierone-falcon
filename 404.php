<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;
/**
* The template for displaying 404 pages
*
* @package tierone
*/
get_header();
?>
<div class="error-404-wrap">
	<div class="container">
		<div id="primary" class="tier-site-white content-area">
			<main id="content" class="site-main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
				<section class="error-404 not-found">
					<div class="error-row">
						<div class="error-col-6">
							<img src="<?php echo get_template_directory_uri(); ?>/image/404/game-over-text.png">
						</div>
						<div class="error-col-4">
							<img src="<?php echo get_template_directory_uri(); ?>/image/404/mystery-box.png">
						</div>
					</div>
					<div class="error-button-wrap">
						<a class="error-btn" href="<?php echo esc_url( home_url('/') ); ?>" role="button">back to start</a>
					</div>
				</section>
			</main>
		</div>
	</div>
</div>
<?php get_footer(); ?>
