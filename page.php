<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;
/**
* This Template will display all pages.
* 
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package tierone
*/

get_header();
?>
<div class="tier-site-page">
	<div class="container">
		<div class="tier-site-white clearfix">
			<div class="col-md-8">
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
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div><!--.col-md-4-->
		</div>
	</div>
</div>

<?php get_footer(); ?>