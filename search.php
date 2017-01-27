<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* The template for displaying search result pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package tierone
*/

get_header();
?>
<div class="container">
	<div class=" clearfix tier-site-white">
		<div class="col-md-8">
			<section id="primary" class="content-area search">
				<main id="main" class="tier-site-main tier-site-wrap" role="main" itemscope="itemscope" itemtype="http://schema.org/Blog">
					<?php
						if ( have_posts() ) :
							if ( ! is_home() && ! is_front_page() ) : ?>
								<header class="search-page-header" >
									<h1 class="search-page-title" itemprop="headline"><?php printf( __( '<span class="search-title-span">Search Results for : </span> %s', 'tierone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
								</header>
					<?php
							endif;

							/* Start the magic loop */
							while ( have_posts() ) : the_post(); 

								/* Include the Post-Format-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Format name) and that will be used instead.
								*/

								get_template_part( 'template-part/content-search', 'search' );

							endwhile; ?>

							<div class="tier-pagination-nav">
								<?php the_posts_navigation(); ?>
							</div>

					<?php else:
							
							get_template_part( 'template-part/content', 'none' );

						endif;
					?>
					<span class="clearfix"></span>
				</main><!--#main-->
			</section><!--.col-md-8-->
		</div><!--.content-area-->
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div><!--.col-md-4-->
	</div>
</div><!--.container-->
<?php get_footer(); ?>