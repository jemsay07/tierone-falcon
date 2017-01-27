<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;
/**
* This will set the page full-width
* Template Name: full-width
*
* @package tierone
*/
get_header();
?>
	<div class="container">
		<div class="tier-site-white clearfix">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<main id="main" class="tier-site-main" role="main">
					<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'template-part/content-page','page' );  ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							?>

					<?php endwhile; // end of the loop. ?>
				</main>
			</div>
		</div>
	</div>
<?php get_footer(); ?>