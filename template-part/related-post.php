<?php
/**
* This will be display the related post
*
* @package tierone
*/

global $post;
$related_post_per_page = get_theme_mod( 'related_post_count', 3 );

$related_post_query = new WP_Query( 
	array(
		'category__in' => wp_get_post_categories( $post->ID ),
		'post__not_in' => array( $post->ID ),
		'posts_per_page' => intval( $related_post_per_page ),
		'ignore_sticky_posts' => 1
	)
);

if ( $related_post_query->have_posts() ) { ?>
	<div class="tier-related-post">

		<div class="tier-block-title-wrap">
			<h2 class="tier-block-title">Related Post</h2>
		</div>
		<div class="tier-wrap-content tier-site-wrap">
			<?php while( $related_post_query->have_posts() ) : $related_post_query->the_post(); ?>
				<article class="tier-related-thumb">
					<link itemprop="relatedLink" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="tier-featured-image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 't-post-thumbnail-small' ); ?></a>
							<?php tierone_show_first_cat(); ?>
						</figure>
					<?php else : ?>
						<figure class="tier-featured-image">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-small.jpg"></a>
							<?php tierone_show_first_cat(); ?>
						</figure>
					<?php endif; ?>
					<header class="tier-entry-header">
						<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>'); ?>
						<div class="tier-entry-meta">
							<?php tierone_meta_on(); ?>
						</div>
					</header>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
<?php } ?>