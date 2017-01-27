<?php
if( !defined( 'ABSPATH' ) ):
	exit;
endif;
/**
* Custom template tags for this theme
*
* @package tierone
*/
class Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // So you can call: my_excerpt('short');
  public static $types = array(
      'daniel-short' => 5,
      'bryan-short' => 15,
      'catstyle2-short' => 8,
      'short' => 25,
      'regular' => 55,
      'long' => 100
    );

  /**
   * Sets the length for the excerpt,
   * then it adds the WP filter
   * And automatically calls the_excerpt();
   *
   * @param string $new_length 
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55, $walang_rm = false) {
    Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'Excerpt::new_length');
      
    if ( $walang_rm == false ) {
        add_filter('the_excerpt', function($text) {
            $excerpt = '' . strip_tags($text) . '<a class="moretag " href="'. get_permalink() . '"> ' . wp_kses_post( get_theme_mod( 'read_more_text', 'Read More <i class="fa fa-angle-double-right"></i>' ) ) . '</a>';
            return $excerpt;
        });
    }
    
    remove_filter('the_excerpt', 'wpautop');

    Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

/* https://wordpress.org/support/topic/how-to-remove-the-from-the-excerpt#post-1000123 */
function trim_excerpt($text) {
    /* http://wordpress.stackexchange.com/questions/109358/hellip-appearing-instead-of#answer-114031 */
    return str_replace('[&hellip;]', '', $text);
}
add_filter('get_the_excerpt', 'trim_excerpt');

// An alias to the class
function tierone_excerpt($length = 55, $walang_read_more = false) {
    Excerpt::length($length, $walang_read_more);
}

/*Remove Excerpt*/
function tierone_excerpt_length($more){
    return ' ';
}
add_filter( 'excerpt_more','tierone_excerpt_length' );



function tierone_excerpt_max_charlength($charlength) {
  $excerpt = get_the_excerpt();
  $charlength++;

  if ( mb_strlen( $excerpt ) > $charlength ) {
    $subex = mb_substr( $excerpt, 0, $charlength - 5 );
    $exwords = explode( ' ', $subex );
    $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
    if ( $excut < 0 ) {
      echo mb_substr( $subex, 0, $excut );
    } else {
      echo $subex;
    }
    echo '[...]';
  } else {
    echo $excerpt;
  }
}


// automatically retrieve the first image from posts
function get_first_image($src = null) {
    global $post, $posts;
    $isnot = ($src) ? true : false;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all( '/<img .+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = $matches[1][0]; 
    if ( empty( $first_img ) ) :
        // defines a fallback imaage
        if(!file_exists($first_img)) :
        $first_img = get_template_directory_uri() . "/img/default/default.jpg";
        endif;
    endif;

    return $first_img;
}

/*http://stackoverflow.com/questions/7684771/how-check-if-file-exists-from-the-url#answer-7684862*/
function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}


if( ! function_exists( 'tierone_paging_nav' ) ){
/**
* Display navigation to next/previous set of posts when applicable.
*/
  function tierone_paging_nav(){
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS[ 'wp_query' ]->max_num_pages < 2 ) {
      return;
    }
    
    $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args = array();
    $url_parts = explode( '?', $pagenum_link  );

    if ( isset( $url_parts[1] ) ) {
      wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    /*Setup pagination nav*/
    $links = paginate_links( array( 
      'base'  => $pagenum_link,
      'format' => $format,
      'total' => $GLOBALS[ 'wp_query' ]->max_num_pages,
      'mid_size' => 3,
      'add_args' => array_map( 'urlencode', $query_args ),
      'prev_text' => __( '<span class="meta-nav-prev"></span> Previous', 'tierone' ),
      'next_text' => __( 'Next <span class="meta-nav-next"></span>', 'tierone' ),
      'type'      => 'list'
    ));
    ?>
    <nav class="navigation paging-navigation" role="navigation">
      <h1 class="screen-reader-text"><?php _e( 'Posts Navigation','tierone' ); ?></h1>
      <?php echo $links; ?>
    </nav>
    <?php

  }

}


if ( ! function_exists( 'tierone_posted_on' ) ) {
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function tierone_posted_on(){
		// Time
		$time_string = '<time class="entry-date published updated" itemprop="dateModified" datetime="%1$s">%2$s</time>';
		if( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ){
			$time_string = '<time class="entry-date published" itemprop="dateModified" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date(0) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date(0) ),
			esc_html( get_the_modified_date(0) )
		);

		// Date posted
		$posted_on = '<a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		
		// Author
		$byline = '<span class="author" itemprop="author"><a class="url n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		// return the output
		echo '<span class="posted-on">' . $posted_on . '</span> / <span class="byline">' . $byline . '</span>';
	}
}

/**
* Show the first category only
*/
if ( ! function_exists( 'tierone_show_first_cat' ) ) {

  function tierone_show_first_cat(){
    $cats = get_the_category();
    if ( ! empty( $cats ) ) :
      foreach ($cats as $cat) {
        if ($cat->parent == 0){
          echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" rel="bookmark" class="tier-cat" >' . esc_html( $cat->name ) . '</a>';
        }
      }
    endif;
  }
}

/**
* Display the schema for the author header
*/
if ( ! function_exists( 'tierone_meta_on' ) ) :
  function tierone_meta_on(){
    ?>
    <link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>">
    <meta itemprop="author" content="<?php the_author();?>">
    <meta itemprop="datePublished" content="<?php the_time('c'); ?> ">
    <meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
    <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
      <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
      if ( !empty( $custom_logo_id ) ) :  $meta_image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
        <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <link itemprop="url" href="<?php echo esc_url( $meta_image[0] ); ?>">
        </span>
      <?php endif; ?>
      <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
    </span>
    <?php
  }
endif;

/**
*
*/
function if_file_exists($image){
  stream_context_set_default(array('http' => array('method' => 'HEAD')));$headers = get_headers($image, 1);
  return stristr($headers[0], '200');
}

/**
* Remove hentry class
*/
function tierone_remove_hentry( $post_class ) {
  $post_class = array_diff( $post_class, array( 'hentry' ) );
  return $post_class;
}
add_filter( 'post_class', 'tierone_remove_hentry' );

/**
* Featured Image
*/
function tierone_featured_image(){
  if( post_password_required() || ! has_post_thumbnail() ){
    return;
  }
  if( is_singular() ) :
      if( get_theme_mod( 'show_article_featured_image', 1 ) ){
        ?>
        <figure class="article-featured-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
          <?php if (has_post_thumbnail() ) { ?>
          <link itemprop="url" href="<?php the_post_thumbnail_url(); ?>">
          <?php
              $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
              if (if_file_exists($file)) :
                  list($width, $height, $type, $attr) = getimagesize($file);  ?>
                  <meta itemprop="width" content="<?php echo $width; ?>">
                  <meta itemprop="height" content="<?php echo $height; ?>">
              <?php endif; ?>
          <?php } else { ?>
          <meta itemprop="url" content="<?php echo get_first_image(); ?>">
          <?php
              $file = get_first_image(); 
              if (if_file_exists($file)) :
                  list($width, $height, $type, $attr) = getimagesize($file);  ?>
                  <meta itemprop="width" content="<?php echo $width; ?>">
                  <meta itemprop="height" content="<?php echo $height; ?>">
              <?php endif; ?>
          <?php } ?>
          <?php the_post_thumbnail( 't-post-thumbnail-featured' ); ?>
        </figure>
        <?php
      } ?>
  <?php else : ?>
    <figure class="article-featured-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        <?php if (has_post_thumbnail() ) { ?>
        <link itemprop="url" href="<?php the_post_thumbnail_url(); ?>">
        <?php
            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
            if (if_file_exists($file)) :
                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                <meta itemprop="width" content="<?php echo $width; ?>">
                <meta itemprop="height" content="<?php echo $height; ?>">
            <?php endif; ?>
        <?php } else { ?>
        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
        <?php
            $file = get_first_image(); 
            if (if_file_exists($file)) :
                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                <meta itemprop="width" content="<?php echo $width; ?>">
                <meta itemprop="height" content="<?php echo $height; ?>">
            <?php endif; ?>
        <?php } ?>
        <?php the_post_thumbnail( 't-post-thumbnail-featured' ); ?>
      <a href="<?php get_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url" ><?php the_post_thumbnail( 't-post-thumbnail-featured', array( 'itemprop' => 'contentUrl' ) ); ?></a>
    </figure>
  <?php
  endif;
}

//Custom comment callback
function custom_comments_callback( $comment, $args, $depth ){
  $GLOBALS['comment'] = $comment; ?>
  <li id="li-comment-<?php comment_ID() ?>">
    <article id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-body' ); ?> itemprop="comment" itemscope="" itemtype="http://schema.org/Comment">
      <div class="comment-author">
        <?php echo get_avatar( $comment, 80 ); ?>
      </div>
      <div class="comment-details">
        <header class="comment-meta comment-metadata">
          <?php printf( __('<cite class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</cite> <span class="says">says:</span>'), get_comment_author_link() ); ?>
          <span class="comment-date">
            <meta itemprop="datePublished" content="<?php comment_date('c'); ?>">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"> <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
            <time datetime="<?php comment_date('c'); ?>"><?php get_comment_date(); ?></time>
          </span>
          <?php edit_comment_link( __( 'Edit', 'tierone' ), ' / ', '' ); ?>
        </header>
        <?php if ($comment->comment_approved == '0') : ?>
          <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
        <?php endif; ?>
        <div class="comment-content" itemprop="text">
          <?php comment_text() ?>
        </div>
        <div class="reply">
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
      </div>
    </article>
<?php
}

/**
* Return true if the blog is more than 1 category
*/

function tierone_cat_zoned(){
  // Get any existing copy of our transient data
  if ( false === ( $all_the_cat = get_transient( 'tierone_cat' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cat = get_categories( array(
      'fields'      => 'ids',
      'hide_empty'  => 1,
      'number'      => 2,
    ) );

    //count the number of categories that are attached to the posts.
    $all_the_cat = count( $all_the_cat );

    set_transient( 'tierone_cat',  $all_the_cat );
  }
  
  if( $all_the_cat > 1 ){
    return true;
  }else{
    return false;
  }

}
/**
 * Flush out the transients used in tierone_cat_zoned.
 */
function tierone_cat_transient_flusher(){
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  delete_transient( 'tierone_cat' );

}
add_action( 'edit_category', 'tierone_cat_transient_flusher' );
add_action( 'save_post', 'tierone_cat_transient_flusher' );


?>