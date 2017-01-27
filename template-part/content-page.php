<?php
if ( !defined( 'ABSPATH' ) ) :
 exit; // Exit if accessed directly
endif;

/**
* Template part of displaying page content in page.php
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package tierone
*/
?>
<article id="post-<?php the_ID();?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<header class="page-entry-header">
		<?php the_title( '<h1 class="page-entry-title">', '</h1>' ); ?>
	</header> <!-- .page -->
	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'	=> '<div class="page-links">' . __( 'Pages:', 'tierone' ),
				'after'		=> '</div>'
			) );
		?>
	</div>
	<footer class="page-entry-footer">
		<?php edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html( 'Edit %s', 'tierone' ),
				'<span class="edit-link">',
				'</span>'
			)
		); ?>
	</footer>
</article>