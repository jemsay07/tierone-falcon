<?php
if ( !defined( 'ABSPATH' ) ) :
 exit; // Exit if accessed directly
endif;

/**
* This will display the single post
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package tierone
*/

get_header();
?>
<div class="tier-single-page">
	<div class="container">
		<div id="primary" class="content-area tier-site-white clearfix">
			<div class="col-md-8">
				<main id="main" class="tier-site-main" role="main">
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="tier-entry-content">

							<?php get_template_part( 'template-part/content-single','page' ); ?>

							<?php if( get_theme_mod( 'tierone_related_post_setting', 0 ) ) : ?>
								<?php get_template_part( 'template-part/related-post','related' ); ?>
							<?php endif; ?>
							
							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							?>
						</div>
					<?php endwhile; ?>
				</main><!--#main-->
			</div><!--.col-md-8-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div><!--.col-md-4-->
		</div><!--.content-area-->
	</div><!--.container-->
</div>
<?php get_footer(); ?>