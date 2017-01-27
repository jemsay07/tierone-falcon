<?php
if ( !defined( 'ABSPATH' ) ) :
	exti;
endif;
/**
* This template for displaying Comments
*
* The area of the page that contains both current comments
* and the comment form.
*
* @package tierone
*/

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<div itemprop="interactionStatistic" itemscope itemtype="http://schema.org/InteractionCounter" >
		<meta itemprop="interactionType" content="http://schema.org/CommentAction">
		<meta itemprop="userInteractionCount" content="<?php echo get_comments_number(); ?>">
	</div>
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'tierone' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? if so, show navigation ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'tierone' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tierone' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tierone' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; //check for comment navigation ?>
		<ol class="commentlist">
			<?php
				wp_list_comments( array(
					'style' => 'ol',
					'short_ping' => true,
					'callback' 	=> 'custom_comments_callback'
				) );
			?>
		</ol>

		<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? if so, show navigation ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'tierone' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tierone' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tierone' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; //check for comment navigation ?>
	<?php endif;  // have_comments() ?>

	<?php if( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comment"><?php _e( 'Comments are closed.', 'tierone' ); ?></p>
	<?php endif; ?>

	<?php comment_form( custome_comments_form() ); ?>
</div>