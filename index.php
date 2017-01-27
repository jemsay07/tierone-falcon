<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* The main template file.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Tierone
*/
get_header();
?>
<div class="container">
	<div class=" clearfix tier-site-white tier-pad-top">
		<div class="col-md-8">
			<div id="primary" class="content-area row">
				<main id="main" class="tier-site-main tier-site-wrap" role="main" itemscope itemtype="http://schema.org/Blog">
					<?php
						if ( have_posts() ) :
							if ( ! is_home() && ! is_front_page() ) : ?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
					<?php
							endif;

							/* Start the magic loop */
							while ( have_posts() ) : the_post(); 
								/*
		                        * Include the Post-Format-specific template for the content.
		                        * If you want to override this in a child theme, then include a file
		                        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		                        */
		                        ?>
		                        <div class="col-md-6">
									<?php get_template_part( 'template-part/content', get_post_format() ); ?>
								</div>

								<?php

							endwhile;

							the_post_navigation();

						else:
							
							get_template_part( 'template-part/content', 'none' );

						endif;
					?>
					<span class="clearfix"></span>
				</main><!--#main-->
			</div><!--.col-md-8-->
		</div><!--.content-area-->
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div><!--.col-md-4-->
	</div>
</div><!--.container-->
<?php get_footer(); ?>