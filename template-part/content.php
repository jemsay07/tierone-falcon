<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* Template Part for displaying post.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package tierone
*/
?>
<article id="post-<?php the_ID();?>" <?php post_class( 'tier-post-item' );?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" >
	<?php 
	if ( has_post_thumbnail() ) : ?>
		<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-module-block', array( 'itemprop' => 'image' ) ); ?></a>
			<?php
              $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
              if (if_file_exists($file)) :
                  list($width, $height, $type, $attr) = getimagesize($file);  ?>
                  <meta itemprop="width" content="<?php echo $width; ?>">
                  <meta itemprop="height" content="<?php echo $height; ?>">
              <?php endif; ?>
		</figure>
	<?php else : ?>
		<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
			<a href="<?php the_permalink(); ?>" itemprop="url">
				<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-module-block.jpg" itemprop="image">
				<meta itemprop="width" content="370">
				<meta itemprop="height" content="250">
			</a>
		</figure>
	<?php endif; ?>
	<header class="tier-entry-header">
		<?php tierone_meta_on(); ?>
		<?php the_title( sprintf('<h2 class="tier-entry-title" itemprop="headline" ><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2> ' ); ?>
		<div class="tier-entry-meta">
			<?php tierone_show_first_cat(); ?>
			<?php tierone_posted_on(); ?>
		</div>
	</header>
	<div class="tier-entry-content">
		<?php 
			the_excerpt();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tierone' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article>