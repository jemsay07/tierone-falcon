<?php
/**
* Social Sharing
*/

function tierone_social_sharing(){

	global $post;
	if(is_singular() || is_home()) : 

	    // Get current page URL 
	    $socialsharingURL = urlencode(get_permalink());

	    // Get current page title
	    $socialsharingTitle = str_replace( ' ', '%20', get_the_title());

	    $repSocialText = str_replace( '' , '-', get_the_title());
	    
	    // Get Post Thumbnail for pinterest
	    $socialsharingThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	    // Construct sharing URL without using any script
	    $twitterURL = 'https://twitter.com/intent/tweet?text='.$socialsharingTitle.'&amp;url='.$socialsharingURL;
	    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$socialsharingURL;
	    $googleURL = 'https://plus.google.com/share?url='.$socialsharingURL;
	    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$socialsharingURL.'&amp;title='.$socialsharingTitle;

	    // Based on popular demand added Pinterest too
	    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$socialsharingURL.'&amp;media='.$socialsharingThumbnail[0].'&amp;description='.$socialsharingURL;
	?>
	  <div class="dt-social">
	  	<h5>SHARE: </h5>
	    <a class="btn btn-social-icon btn-twitter popwindow " data-type="twitter" data-url="<?php echo $socialsharingURL; ?>" data-title="<?php echo $socialsharingTitle; ?>" href="javascript:void(0);" title="<?php echo $repSocialText; ?>" target="_blank" ><i class="fa fa-twitter"></i></a>
	    <a class="btn btn-social-icon btn-facebook popwindow " data-type="facebook" data-url="<?php echo $socialsharingURL; ?>" data-title="<?php echo $socialsharingTitle; ?>" href="javascript:void(0);" title="<?php echo $repSocialText; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
	    <a class="btn btn-social-icon btn-google popwindow " data-type="google" data-url="<?php echo $socialsharingURL; ?>" data-title="<?php echo $socialsharingTitle; ?>" href="javascript:void(0);" title="<?php echo $repSocialText; ?>" target="_blank"><i class="fa fa-google"></i></a>
	    <a class="btn btn-social-icon btn-linkedin popwindow " data-type="linkedin" data-url="<?php echo $socialsharingURL; ?>" data-title="<?php echo $socialsharingTitle; ?>" href="javascript:void(0);" title="<?php echo $repSocialText; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
	    <a class="btn btn-social-icon btn-pinterest popwindow " data-type="pinterest" data-url="<?php echo $socialsharingURL; ?>" data-title="<?php echo $socialsharingTitle; ?>" data-media="<?php echo $socialsharingThumbnail[0]; ?>" href="javascript:void(0);" title="<?php echo $repSocialText; ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
	  </div>

	<?php endif;
}
?>
