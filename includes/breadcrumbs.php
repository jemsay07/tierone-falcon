<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* This will display breadcrumbs
*/

function tierone_breadcrumbs(){
	
	/* Settings */
	$breadcrumb_class 	= 'breadcrumb';
	$breadcrumb_item_class = 'breadcrumb-item';
	$breadcrumb_id		= 'breadcrumbs';
	
	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	$custom_taxonomy    = 'product_cat';

	$home_title				= _(' Home' );
	$schema_url			= 'http://schema.org';
	$schema_item 		= 'item';
	$schema_item_elem		= 'itemListElement';
	$separator          = '&gt;';

	// Get the query & post information
	global $post,$wp_query; ?>

	<nav class="<?php echo $breadcrumb_class; ?>" itemprop="breadcrumb" itemscope itemtype="<?php echo $schema_url; ?>/BreadcrumbList">
		<?php
			// Do not display on the homepage
			if ( ! is_front_page() ) { ?>
				<!--  // Home page -->
				<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
					<meta itemprop="position" content="2"><a href="<?php echo get_home_url(); ?>" itemprop="<?php echo $schema_item; ?>"><?php echo $home_title; ?></a>
				</li>

				<?php
					if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
						
						if ( is_day() ) { ?>
							<!-- // Day archive -->

							<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="2"><a href="<?php echo get_year_link( get_the_time( 'Y' ) ); ?>" title="<?php echo get_the_time( 'Y' ); ?>" itemprop="<?php echo $schema_item; ?>"><?php echo get_the_time( 'Y' ); ?> : Archives</a>
							</li><!-- // Year link -->
							<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="3"><a href="<?php echo get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ); ?>" title="<?php echo get_the_time( 'M' ); ?>" itemprop="<?php echo $schema_item; ?>"><?php echo get_the_time( 'M' ); ?> : Archives</a>
							</li><!-- // Month link -->
							<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="4"><?php echo get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ); ?> : Archives
							</li><!-- // Day display -->
						<?php } elseif ( is_month() ) { ?>
							<!-- // Month Archive -->

							<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="2"><a href="<?php get_year_link( get_the_time( 'Y' ) ); ?>" title="<?php echo get_the_time( 'Y' ); ?>" itemprop="<?php echo $schema_item; ?>"><?php echo get_the_time( 'Y' ); ?> : Archives</a></a>
							</li><!-- // Year link -->
							<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="3"><?php echo get_the_time('M'); ?> : Archives
							</li><!-- // Month display -->
						<?php } elseif ( is_year() ) { ?>

							<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="2"><a title="<?php echo get_the_time('Y'); ?>" itemprop="<?php echo $schema_item; ?>"><?php echo get_the_time('Y'); ?> : Archives</a>
							</li><!-- // Display year archive -->
						<?php } else { ?>
							<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="2"><a title="<?php echo post_type_archive_title(); ?>" itemprop="<?php echo $schema_item; ?>"><?php echo get_the_time('Y'); ?> : Archives</a>
							</li>
						<?php }
					} elseif ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
						
						// If post is a custom post type
						$post_type 	= 	get_post_type();

						// If it is a custom post type display name and link
						if ( $post_type != 'post' ) {
							$post_type_object = get_post_type_object($post_type);
							$post_type_archive = get_post_type_archive_link($post_type); ?>

							<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								 <meta itemprop="position" content="2" /><a href="<?php echo $post_type_archive; ?>" itemprop="<?php echo $schema_item; ?>"><?php echo $post_type_object->labels->name; ?></a>
							</li>
						<?php } $custom_tax_name = get_queried_object()->name; ?>
						<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
							<meta itemprop="position" content="3" /><a itemprop="<?php echo $schema_item; ?>"><?php echo $custom_tax_name; ?></a>
						</li>
				<?php 
					} elseif ( is_single() ) {
			            // If post is a custom post type
			            $post_type = get_post_type();

			            // If it is a custom post type display name and link
			            if ( $post_type != 'post' ) {
			            	$post_type_object = get_post_type_object($post_type);
			            	$post_type_archive = get_post_type_archive_link($post_type); ?> 
			            	
			            	<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            		<meta itemprop="position" content="3" /><a href="<?php echo $post_type_archive; ?>" itemprop="<?php echo $schema_item; ?>"><?php echo $post_type_object->labels->name; ?></a>
			            	</li>
			            <?php
			            }
			            // Get post category info
			            $category = get_the_category();
			            if ( !empty( $category ) ) {
			            	// Get last category post is in
			                $last_category = array_values($category);
			                $last_category = end($last_category);
                  
			                // Get parent any categories and create array
			                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
			                $cat_parents = explode(',',$get_cat_parents);
                  
			                // Loop through parent categories and store in variable $cat_display
			                $cat_display = '';
			                foreach ( $cat_parents as $parents ) {
			                	$parents = preg_replace('/<a href="(.*?)">(.*?)<\/a>/', '<a href="$1"><span itemprop="name">$2</span></a>', $parents);
                    			$parents = str_replace( '<a', '<li itemprop="itemListElement" itemscope itemtype="' . $schema_url . '/ListItem">
                                                    	 <meta itemprop="position" content="2" />
                                                   	 	 <a itemprop="' . $schema_item . '" ', $parents );
                    			$parents = str_replace( '</a>', '</a> </lie>', $parents );
                    			$cat_display .= $parents;
			                }
			            }
			            // If it's a custom post type within a custom taxonomy
			            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
			            if( empty( $last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
			                   
			                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
			                $cat_id         = $taxonomy_terms[0]->term_id;
			                $cat_nicename   = $taxonomy_terms[0]->slug;
			                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
			                $cat_name       = $taxonomy_terms[0]->name;
			            }
			            // Check if the post is in a category
			            if ( !empty( $last_category ) ) {
			            	echo $cat_display; ?>
			            	<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            		<meta itemprop="position" content="3" /><a title="<?php echo $get_the_title; ?>"  itemprop="<?php echo $schema_item; ?>"><?php echo get_the_title(); ?></a>
			            	</li>
			            <?php } elseif ( !empty( $cat_id ) ) { ?>
			            	<li class="<?php echo $breadcrumb_item_class; ?>" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            		<meta itemprop="position" content="3" /><a href="<?php echo $cat_link; ?>" title="<?php echo $cat_name; ?>" itemprop="<?php echo $schema_item; ?>" ><?php echo $cat_name; ?></a>
			            	</li>
			            	<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            		<meta itemprop="position" content="4" /><a title="<?php echo $get_the_title; ?>" itemprop="<?php echo $schema_item; ?>"><?php get_the_title(); ?></a>
			            	</li>
			            <?php } else{ ?>
			            	<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            		<meta itemprop="position" content="3" /><a title="<?php echo $get_the_title; ?>" itemprop="<?php echo $schema_item; ?>"><?php get_the_title(); ?></a>
			            	</li>
			            <?php
			            }
					} elseif ( is_category() ) { ?>
		            	<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
		            		<meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>"><?php echo single_cat_title( '', false ); ?></a>
		            	</li><!-- // Category page -->
				<?php
					} elseif ( is_page() ) {

						// Standard page
						if ( $post->post_parent ) {
							// If child page, get parents
							$anc = get_post_ancestors( $post->ID );

							// Get parents in the right order
							$anc = array_reverse($anc);

							// Parent page loop
			                if ( !isset( $parents ) ) $parents = null;
			                foreach ( $anc as $ancestor ) {
			                    $parents .= '<li class="' . $breadcrumb_item_class . '" itemprop="' . $schema_item_elem . '" itemscope itemtype="' . $schema_url . '/ListItem">
			                                    <meta itemprop="position" content="2" />
			                                    <a itemprop="' . $schema_item . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '"><span itemprop="name">' . get_the_title($ancestor) . '</span></a>
			                                </li>';
			                }
			                // Display parent pages
			                echo $parents; ?>
			            	<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            		<meta itemprop="position" content="3" /><a itemprop="<?php echo $schema_item; ?>" title="<?php echo get_the_title(); ?>"><?php get_the_title(); ?></a>
			            	</li><!-- // Current page -->
						<?php
						} else{ ?>
							<!-- // Just display current page if not parents -->
							<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
								<meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>" ><?php echo get_the_title(); ?></a>
							</li>
						<?php
						}
					} elseif ( is_tag() ) {
						
						// Tag page

			            // Get tag information
			            $term_id        = get_query_var('tag_id');
			            $taxonomy       = 'post_tag';
			            $args           = 'include=' . $term_id;
			            $terms          = get_terms( $taxonomy, $args );
			            $get_term_id    = $terms[0]->term_id;
			            $get_term_slug  = $terms[0]->slug;
			            $get_term_name  = $terms[0]->name;
			         ?>
			         	<!-- // Display the tag name -->
			         	<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			         		<meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>" ><?php echo $get_term_name; ?></a>
			         	</li>
			         <?php
					} elseif ( is_author() ) {

						// Auhor archive
			            // Get the author information
			            global $author;
			            $userdata = get_userdata( $author ); ?>
			            <!-- // Display author name -->
			            <li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
			            	<meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>" title="<?php echo $userdata->display_name; ?>">Author : <?php echo $userdata->display_name; ?></a>
			            </li>
			    <?php } elseif ( get_query_var('paged') ){ ?>
					<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
						<meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>" title="Page <?php echo get_query_var('paged'); ?>">Author : <?php echo __('Page') . ' ' . get_query_var('paged') ; ?></a>
					</li><!-- // Paginated archives -->
				<?php } elseif ( is_search() ) { ?>
					<li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
						<meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>" title="Search results for : <?php echo get_search_query(); ?>">Search results for : <?php echo get_search_query() ; ?></a>
					</li><!-- // Search results page -->
				<?php } elseif ( is_404() ) { ?>
		            <li class="<?php echo $breadcrumb_item_class; ?> active" itemprop="<?php echo $schema_item_elem; ?>" itemscope itemtype="<?php echo $schema_url; ?>/ListItem">
		                <meta itemprop="position" content="2" /><a itemprop="<?php echo $schema_item; ?>" >Error 404</a>
		            </li>
				<?php } ?>
		<?php } ?>
	</nav>


	<?php
}


?>