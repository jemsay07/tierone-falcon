<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;
/**
* This will show the archive of this template
*
*
*
* @package tierone
*/
get_header(); ?>
<div class="tier-archive-page">
	<div class="container">
		<div id="primary" class="content-area tier-site-white clearfix">
			<div class="col-md-8">
				<main id="main" class="tier-site-main" role="main" itemscope itemtype="http://schema.org/Blog">
					<?php if ( have_posts() ) : ?>
						<header class="archive-page-header">
							<?php the_archive_title( '<h2 class="archive-page-title">','</h2>' ); ?>
							<?php the_archive_description( '<div class="taxonomy-description"','</div>' ); ?>
							<div class="tier-archive-browse-wrap">
								<h3 class="tier-arch-title">Browse By: </h3>
								<div id="categories" class="tier-arc-dropdown">
									<?php 
									$args = array(
										'show_option_none' => 'Select Category',
										'orderby'	=> 'ID',
										'order'		=> 'ASC',
										'class'		=> 'archive-postform'
									);
									wp_dropdown_categories( $args ); ?>
									<script type="text/javascript">
										<!--
										var dropdown = document.getElementById("cat");
										function onCatChange() {
											if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
												location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
											}
										}
										dropdown.onchange = onCatChange;
										-->
									</script>
								</div>
								<div class="tier-arc-dropdown">
									<select class="archive-dropdown" name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
									  <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
									  <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => false) ); ?>
									</select>
								</div>
							</div>
						</header>
						<div class="row tier-site-wrap">
							<?php while( have_posts() ) : the_post();?>
								<div class="col-md-6">
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
										<!-- <div class="tier-entry-content">
											<?php the_excerpt(); ?>
										</div> -->
									</article>
								</div>
							<?php endwhile;?>

							<?php wp_reset_postdata(); ?>
						</div>
						<?php tierone_paging_nav(); ?>
					<?php else : ?>

						<p><?php _e( 'Sorry, no posts matched your criteria.', 'tierone' ); ?></p>

					<?php endif;?>
				</main><!--#main-->
			</div><!--.content-area-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div><!--.col-md-4-->
		</div>
	</div><!--.container-->
</div>
<?php get_footer(); ?>