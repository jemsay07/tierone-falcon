<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;
/**
* This will be displayed the customized comment section
*
* @package tierone
*/

function custome_comments_form(){
	
	global $required_text;
	global $user_identity;

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );


	$args = array(
	  'id_form'           => 'commentform',
	  'class_form'        => 'comment-form',
	  'id_submit'         => 'submit',
	  'class_submit'      => 'submit',
	  'name_submit'       => 'submit',
	  'title_reply'       => __( 'Leave a Reply' ),
	  'title_reply_to'    => __( 'Leave a Reply to %s' ),
	  'cancel_reply_link' => __( 'Cancel Reply' ),
	  'label_submit'      => __( 'Post Comment' ),
	  'format'            => 'xhtml',
	  'fields' => apply_filters( 'comment_form_default_fields', array(

		  'author' =>
		    '<p class="comment-form-author"><label class="sr-only" for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . '  placeholder="Name: "/></p>',

		  'email' =>
		    '<p class="comment-form-email"><label class="sr-only" for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' placeholder="Email: "/></p>',

		  'url' =>
		    '<p class="comment-form-url"><label class="sr-only" for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
		    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		    '" size="30" placeholder="Website: "/></p>',
		) ),


	  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
	    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
	    '</textarea></p>',

	  'must_log_in' => '<p class="must-log-in">' .
	    sprintf(
	      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
	      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
	    ) . '</p>',

	  'logged_in_as' => '<p class="logged-in-as">' .
	    sprintf(
	    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
	      admin_url( 'profile.php' ),
	      $user_identity,
	      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
	    ) . '</p>',

	  'comment_notes_before' => '<p class="comment-notes">' .
	    __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
	    '</p>',
	 
	);
	return $args;
}


?>