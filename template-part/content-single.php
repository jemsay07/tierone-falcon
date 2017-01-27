<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;
/**
* This Template for displaying single post
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package tierone
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
	<link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
	<header class="single-entry-header">
		<?php the_title( '<h1 class="single-entry-title" itemprop="headline">','</h1>' ); ?>
		<div class="single-entry-meta">
			<?php tierone_meta_on(); ?> <!--show-the-meta-->
			<?php tierone_show_first_cat(); ?> <!--show-the-first-image-->
			<?php tierone_posted_on(); ?> <!--show-meta-tags-->
			<?php edit_post_link( __( 'Edit','tierone' ), '<span class="edit-link">', '</span>' );  ?>
		</div>
	</header>
	<?php tierone_featured_image(); ?>
	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tierone' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<footer class="single-entry-footer">
		<div class="row">
			<div class="col-md-7">
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tag_list = get_the_tag_list( '', __( ' ','tierone' ) );
					if ( '' !== $tag_list ) {
						echo '<div class="tier-tagged-title">';
							_e( 'Tags: ', 'tierone' );
						echo '</div>';
						echo '<div class="tier-tag-list">';
							echo $tag_list;
						echo '</div>';
					}
				?>
			</div>
			<div class="col-md-5">
				<?php if( get_theme_mod( 'tierone_social_sharing_setting', 0 ) ) : ?>
					<?php tierone_social_sharing(); ?>
				<?php endif; ?>
			</div>
		</div>
	</footer><!--.single-entry-footer-->	
</article><!--#post-->