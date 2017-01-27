<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* Register widget Area
*
* @link http://codex.wordpress.org/Function_Reference/register_sidebar
*
* @package tierone
*/

function tierone_widget_init(){

	//Register Main Widget
	register_sidebar( array(
		'name'		=>	__( 'Main Sidebar', 'tierone' ),
		'id'		=> 'tier-sidebar',
		'description' =>'',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</aside>',
		'before_title' 	=> '<div class="widget-header"><h2 class="widget-title">',
		'after_title' 	=> '</h2></div>'
	) );

	//Register 670x70
	register_sidebar(array(
		'name'          => __( 'Frontpage: Ads 670x70', 'tierone' ),
		'id'            => 'tier-site-ads670x70',
		'description'   => __('Shows the advertisement in the top right of the page', 'tierone'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	) );
	
	//Register Front Module
    register_sidebar( array(
        'name'          => __( 'Front Page: Module Section', 'tierone' ),
        'id'            => 'tier-module-section',
        'description'   => __('Show the module section', 'tierone'),
        'before_widget' => '',
        'after_widget'  => '',
		'before_title' 	=> '',
		'after_title' 	=> ''
    ) );	

    //Register Front Page
    register_sidebar( array(
        'name'          => __( 'Front Page: Tierone Section', 'tierone' ),
        'id'            => 'tier-front-section',
        'description'   => __('Add Widget to show list of tierone from category at Front Page Section', 'tierone'),
        'before_widget' => '',
        'after_widget'  => '',
		'before_title' 	=> '',
		'after_title' 	=> ''
    ) );

	//Register Footer Position A
	register_sidebar(array(
		'name'          => __( 'Footer Position A', 'tierone' ),
		'id'            => 'tier-footer-a',
		'description'   => __('Add widgets to Show widgets at Footer Position A', 'tierone'),
		'before_widget' => '<aside id="%1$s" class="widget site-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title' 	=> '<div class="widget-header"><h2 class="widget-title">',
		'after_title' 	=> '</h2></div>'
	) );

	//Register Footer Position B
	register_sidebar(array(
		'name'          => __( 'Footer Position B', 'tierone' ),
		'id'            => 'tier-footer-b',
		'description'   => __('Add widgets to Show widgets at Footer Position B', 'tierone'),
		'before_widget' => '<aside id="%1$s" class="widget site-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title' 	=> '<div class="widget-header"><h2 class="widget-title">',
		'after_title' 	=> '</h2></div>'
	) );

	//Register Footer Position C
	register_sidebar(array(
		'name'          => __( 'Footer Position C', 'tierone' ),
		'id'            => 'tier-footer-c',
		'description'   => __('Add widgets to Show widgets at Footer Position C', 'tierone'),
		'before_widget' => '<aside id="%1$s" class="widget site-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title' 	=> '<div class="widget-header"><h2 class="widget-title">',
		'after_title' 	=> '</h2></div>'
	) );
}
add_filter( 'widgets_init', 'tierone_widget_init' );


/**
* WP Admin Script
*/
function tier_media_scripts( $hook ){

	if ( 'widgets.php' != $hook) {
		return;
	}

	wp_enqueue_style( 'wp-color-picker' );

	//Update style with in admin
	wp_enqueue_style( 'tierone-widgets', get_template_directory_uri() . '/includes/widgets/widgets.css' );

	wp_enqueue_media();
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'tierone-media-upload', get_template_directory_uri() . '/includes/widgets/widgets.js', array( 'jquery' ), ' ' , true);


}
add_action( 'admin_enqueue_scripts', 'tier_media_scripts');


/**
* Ads670x70
*/
class tierone_add670x70 extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_add670x70',
			__( 'Tierone: Ads 670x70', 'tierone' ),
			array( 
				'description' => __( 'Advertise with the size of 670x70', 'tierone' )
			)
		);
	}

	public function widget( $args, $instance ){
		
		$title     		= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$ads_image_path  = isset( $instance[ 'ads_image' ] ) ? $instance[ 'ads_image' ] : '';
		$ads_link		 = isset( $instance[ 'ads_link' ] ) ? $instance[ 'ads_link' ] : '';
		$ads_link_type	 = isset( $instance[ 'ads_link_type' ] ) ? $instance[ 'ads_link_type' ] : '';

		if ( empty( $title ) ) {
			$title = __( 'Advertisement', 'tierone' );
		}

		if ( empty( $ads_image_path ) ) {
			$ads_image_path = '';
		}

		if ( empty( $ads_link ) ) {
			$ads_link = esc_url( home_url( '/' ) );
		}

		if ( $ads_link_type == 'nofollow' ) {
			$ads_link_type = 'nofollow';
		}else{
			$ads_link_type = 'dofollow';
		}
		?>
			<a href="<?php echo esc_url( $ads_link ); ?>"  title="<?php echo esc_attr( $title );?>" rel="<?php echo esc_attr( $ads_link_type ); ?>" rel="bookmark"><img src="<?php echo esc_url( $ads_image_path ); ?>" alt="<?php esc_attr( $title );?>" ></a>
		<?php

	}

	public function form( $instance ){

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'              => '',
                'ads_link'           => '',
                'ads_image'          => '',
                'ads_link_type'      => ''
            )
        );
		?>
		<div id="tierone-ads670x70">
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tierone' ); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Advertisement Title', 'tierone' ); ?>" >
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'ads_link' ); ?>"><?php _e( 'Ads Link:', 'tierone' ); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'ads_link' ); ?>" name="<?php echo $this->get_field_name( 'ads_link' ); ?>" value="<?php echo esc_url( $instance[ 'ads_link' ] ); ?>" placeholder="<?php _e( 'Advertisement Links', 'tierone' ); ?>" >
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'ads_link_type' ); ?>"><?php _e( 'Links Type:', 'tierone' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'ads_link_type' ); ?>" name="<?php echo $this->get_field_name( 'ads_link_type' ); ?>">
					<option value="nofollow" <?php selected( $instance['ads_link_type'], 'nofollow' ); ?> >No follow</option>
					<option value="dofollow" <?php selected( $instance['ads_link_type'], 'dofollow' ); ?> >Do Follow</option>
				</select>
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'ads_image' ); ?>"><?php _e( 'Ads Image:', 'tierone' ); ?></label>

				<?php $tier_ads_image = $instance[ 'ads_image' ];
					if ( !empty( $tier_ads_image ) ) : ?>
						<img src="<?php echo $tier_ads_image; ?>"/>
				<?php else: ?>
						<img src="" />
				<?php endif; ?>
				<input type="hidden" class="tier-custom-media-image" id="<?php echo $this->get_field_id( 'ads_image' ); ?>" name="<?php echo $this->get_field_name( 'ads_image' ); ?>" value="<?php echo esc_attr( $instance[ 'ads_image' ] );?>">
				<input type="button" class="tier-image-upload tier-custom-media-image" id="custom_media_button" name="<?php echo $this->get_field_name( 'ads_image' ); ?>" value="<?php _e( 'Select Image', 'tierone' ); ?>" >
				
			</div>
		</div>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

        $instance               = $old_instance;
        $instance['title']      = strip_tags( stripslashes( $new_instance['title'] ) );
        $instance['ads_link']   = strip_tags( stripslashes( $new_instance['ads_link'] ) );
        $instance['ads_link_type']  = strip_tags( $new_instance['ads_link_type'] );
        $instance['ads_image']  = strip_tags( $new_instance['ads_image'] );
        return $instance;

    }
}

/**
* Ads300x250
*/
class tierone_add300x250 extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_add300x250',
			__( 'Tierone: Ads 300x250', 'tierone' ),
			array( 
				'description' => __( 'Advertise with the size of 300x250', 'tierone' )
			)
		);
	}

	public function widget( $args, $instance ){
		
		$title     		= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$ads_image_path  = isset( $instance[ 'ads_image' ] ) ? $instance[ 'ads_image' ] : '';
		$ads_link		 = isset( $instance[ 'ads_link' ] ) ? $instance[ 'ads_link' ] : '';
		$ads_link_type	 = isset( $instance[ 'ads_link_type' ] ) ? $instance[ 'ads_link_type' ] : '';

		if ( empty( $title ) ) {
			$title = __( 'Advertisement', 'tierone' );
		}

		if ( empty( $ads_image_path ) ) {
			$ads_image_path = '';
		}

		if ( empty( $ads_link ) ) {
			$ads_link = esc_url( home_url( '/' ) );
		}

		if ( $ads_link_type == 'nofollow' ) {
			$ads_link_type = 'nofollow';
		}else{
			$ads_link_type = 'dofollow';
		}
		?>
			<aside class="widget"><a href="<?php echo esc_url( $ads_link ); ?>" title="<?php echo esc_attr( $title ); ?>" rel="<?php echo esc_attr( $ads_link_type ); ?>"><img src="<?php echo esc_url( $ads_image_path ); ?>" alt="<?php echo esc_attr( $title ); ?>"></a>
			</aside>
		<?php

	}

	public function form( $instance ){

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'              => '',
                'ads_link'           => '',
                'ads_image'          => '',
                'ads_link_type'      => ''
            )
        );
		?>
		<div class="tierone-ads300x250">
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tierone' ); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Advertisement Title', 'tierone' ); ?>" >
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'ads_link' ); ?>"><?php _e( 'Ads Link:', 'tierone' ); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'ads_link' ); ?>" name="<?php echo $this->get_field_name( 'ads_link' ); ?>" value="<?php echo esc_url( $instance[ 'ads_link' ] ); ?>" placeholder="<?php _e( 'Advertisement Links', 'tierone' ); ?>" >
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'ads_link_type' ); ?>"><?php _e( 'Links Type:', 'tierone' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'ads_link_type' ); ?>" name="<?php echo $this->get_field_name( 'ads_link_type' ); ?>">
					<option value="nofollow" <?php selected( $instance['ads_link_type'], 'nofollow' ); ?> ><?php _e( 'No Follow', 'tierone' ); ?></option>
					<option value="dofollow" <?php selected( $instance['ads_link_type'], 'dofollow' ); ?> ><?php _e( 'Do Follow', 'tierone' ); ?></option>
				</select>
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'ads_image' ); ?>"><?php _e( 'Ads Image:', 'tierone' ); ?></label>

				<?php $tier_ads_image = $instance[ 'ads_image' ];
					if ( !empty( $tier_ads_image ) ) : ?>
						<img src="<?php echo $tier_ads_image; ?>"/>
				<?php else: ?>
						<img src="" />
				<?php endif; ?>
				<input type="hidden" class="tier-custom-media-image" id="<?php echo $this->get_field_id( 'ads_image' ); ?>" name="<?php echo $this->get_field_name( 'ads_image' ); ?>" value="<?php echo esc_attr( $instance[ 'ads_image' ] );?>">
				<input type="button" class="tier-image-upload tier-custom-media-image" id="custom_media_button" name="<?php echo $this->get_field_name( 'ads_image' ); ?>" value="<?php _e( 'Select Image', 'tierone' ); ?>" >
				
			</div>
		</div>
		<?php
	}


	public function update( $new_instance, $old_instance ){
		$instance               = $old_instance;
        $instance['title']      = strip_tags( stripslashes( $new_instance['title'] ) );
        $instance['ads_link']   = strip_tags( stripslashes( $new_instance['ads_link'] ) );
        $instance['ads_link_type']  = strip_tags( $new_instance['ads_link_type'] );
        $instance['ads_image']  = strip_tags( $new_instance['ads_image'] );
        return $instance;
	}
}

/**
* Multiple banner will be showned
*/
class tierone_custom_banner extends WP_Widget{
	
	public function __construct() {
		parent::__construct( 
			'tierone_custom_banner',
			__( 'Custom Banner','tierone' ),
			array(
				'discription' => __( 'Display multiple ads', 'tierone' )
			)
		);
	}

	public function widget( $args, $instance ){
		$title     		= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$ads_title 		= isset( $instance[ 'ads_title' ] ) ? $instance[ 'ads_title' ] : '';
		$ads_alt 		= isset( $instance[ 'ads_alt' ] ) ? $instance[ 'ads_alt' ] : '';
		$ads_image_path  = isset( $instance[ 'ads_image' ] ) ? $instance[ 'ads_image' ] : '';
		$ads_link		 = isset( $instance[ 'ads_link' ] ) ? $instance[ 'ads_link' ] : '';
		$ads_new_tab	 = isset( $instance[ 'ads_new_tab' ] ) ? $instance[ 'ads_new_tab' ] : '';

		if ( empty( $title ) ) {
			$title = __( 'Multiple Promo Ads', 'tierone' );
		}

		?>
		<aside class="tierone-multiple-banner tier-wrap-block">
			<div class="widget-header">
				<h2 class="widget-title"><?php echo $title; ?></h2>
			</div>
			<div class="clearfix tier-block-parent tier-site-wrap">
				<?php 
				$count = 0;
				foreach ( @$instance['ads'] as $ind => $ad) { 

					$count++; 

					if ( ! empty( $ad['ads_image'] ) ) {
						$ads_image_path = esc_url( $ad['ads_image'] );
					}else{
						$ads_image_path = '';
					}

					if ( empty( $ad['ads_link'] ) ) {
						$ads_link = esc_url( home_url( '/' ) );
					}else{
						$ads_link = esc_url( do_shortcode( $ad['ads_link'] ) );
					}

					if ( $ad['ads_new_tab'] == 'on' ) {
						$ads_new_tab = "_blank";
					}
					?>
					<div class="tier-multi-banner">
						<a href="<?php echo  $ads_link; ?>" title="<?php echo esc_attr( $ad['ads_title'] ); ?>" target="<?php echo $ads_new_tab; ?>"><img src="<?php echo esc_url( $ads_image_path ); ?>" title="<?php echo esc_attr( $ad['ads_title'] ); ?>" alt="<?php echo esc_attr( $ad['ads_alt'] ); ?>"></a>
					</div>
				<?php } ?>
			</div>
		</aside>
		<?php
	}
	public function form( $instance ){
        $instance = wp_parse_args(
            (array) $instance, array(
                'title'              => '',
                'ads_title'              => '',
                'ads_alt'              => '',
                'ads_link'           => '',
                'ads_image'      => '',
                'ads_new_tab'      => '',
                'ads'      => ''
            )
        );

	?>
		<div class="tierone-pupolar-post" >
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tierone' ); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' );?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title', 'tierone' );?>">
			</div>
			<div class="tierone-admin-group">
				<label>&nbsp;</label><input type="button" class="addElment" value="Add Button">
			</div>
			<div class="banner-wrap tierone-admin-group">
				 <?php $add = 0; 
				 	if ( is_array( $instance['ads'] ) ) :
				 		foreach ($instance['ads'] as $ad) : $add++; ?>
				 		<div class='tierone-accordion' id="promo-<?php echo $add; ?>">
				 			<div class='tierone-accordion-header'> 
					 			<label class='accordion active'>Banner: <?php echo  $ad[ 'ads_title' ]; ?></label>
					 			<span class='removeElem'>Close</span>
				 			</div>
				 			<div class='tierone-accordion-body show'>
				 				<div class="tierone-admin-group">
									<label for="<?php echo $this->get_field_id( 'ads_title' ); ?>"><?php _e( 'Title:','tierone' ); ?></label>
									<input type="text" id="<?php echo $this->get_field_id( 'ads_title' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_title' );?>[]" value="<?php echo  $ad[ 'ads_title' ]; ?>">
				 				</div>
				 				<div class="tierone-admin-group">
									<label for="<?php echo $this->get_field_id( 'ads_alt' ); ?>"><?php _e( 'Alt Title:','tierone' ); ?></label>
									<input type="text" id="<?php echo $this->get_field_id( 'ads_alt' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_alt' );?>[]" value="<?php echo  $ad[ 'ads_alt' ]; ?>">
				 				</div>
				 				<div class="tierone-admin-group">
									<label for="<?php echo $this->get_field_id( 'ads_link' ); ?>"><?php _e( 'Ads Link:','tierone' ); ?></label>
									<input type="text" id="<?php echo $this->get_field_id( 'ads_link' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_link' );?>[]" value="<?php echo  $ad[ 'ads_link' ]; ?>" placeholder="<?php _e( 'Adds Links', 'tierone' );?>">
				 				</div>
								<div class="tierone-admin-group">
									<label for="<?php echo $this->get_field_id( 'ads_image' ); ?>"><?php _e( 'Ads Image:', 'tierone' ); ?></label>
									<input type="text"  class="tier-custom-media-image" id="<?php echo $this->get_field_id( 'ads_image' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_image' ); ?>[]" value="<?php echo esc_attr( $ad['ads_image'] ); ?>">
								</div>
				 				<div class="tierone-admin-group">
									<label for="<?php echo $this->get_field_id( 'ads_new_tab' ); ?>"><?php _e( 'Open in new tab:','tierone' ); ?></label>
									<input type="checkbox" <?php checked( $ad['ads_new_tab'], 'on' ); ?> id="<?php echo $this->get_field_id( 'ads_new_tab' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_new_tab' ); ?>[]">
				 				</div>
				 			</div>
				 		</div>
				 		<?php
				 		endforeach;
				 	endif;
				 ?>
			</div>
		</div>
		<script type="text/javascript">
			var data_count = "<?php echo $add; ?>";
		    jQuery( '.addElment' ).on( 'click', function(){
		        container ="<div class='tierone-accordion' id='promo-" + data_count + "'>";
		            container += "<div class='tierone-accordion-header'>";
		                container += "<label class='accordion'>Banner</label>";
		                container += "<span class='removeElem'>Close</span>";
		            container += "</div>";
		            container += "<div class='tierone-accordion-body' >";
		                container += '<div class="tierone-admin-group">';
		                    container += '<label for="<?php echo $this->get_field_id( 'ads_title' ); ?>[]">Title:</label>';
		                    container += '<input type="text" id="<?php echo $this->get_field_id( 'ads_title' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_title' ); ?>[]" value="<?php echo  $instance[ 'ads_title' ]; ?>" >';
		                container += '</div>';
		                container += '<div class="tierone-admin-group">';
		                    container += '<label for="<?php echo $this->get_field_id( 'ads_alt' ); ?>[]">Alt Title:</label>';
		                    container += '<input type="text" id="<?php echo $this->get_field_id( 'ads_alt' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_alt' ); ?>[]" value="<?php echo  $instance[ 'ads_alt' ]; ?>" >';
		                container += '</div>';
		                container += '<div class="tierone-admin-group">';
		                    container += '<label for="<?php echo $this->get_field_id( 'ads_link' ); ?>[]">Ads Link:</label>';
		                    container += '<input type="text" id="<?php echo $this->get_field_id( 'ads_link' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_link' ); ?>[]" value="<?php echo  $instance[ 'ads_link' ]; ?>" placeholder="Adds Links" >';
		                container += '</div>';
	         			container += '<div class="tierone-admin-group">';
							container += '<label for="<?php echo $this->get_field_id( 'ads_image' ); ?>"><?php _e( 'Ads Image:', 'tierone' ); ?></label>';
		                    container += '<input type="text" class="tier-custom-media-image" id="<?php echo $this->get_field_id( 'ads_image' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_image' ); ?>[]" value="<?php echo $instance[ 'ads_image' ]; ?>">';
						container += '</div>';
	         			container += '<div class="tierone-admin-group">';
							container += '<label for="<?php echo $this->get_field_id( 'ads_new_tab' ); ?>"><?php _e( 'Open in new tab:','tierone' ); ?></label>';
		                    container += '<input type="checkbox" <?php checked( $instance['ads_new_tab'], 'on' ); ?> id="<?php echo $this->get_field_id( 'ads_new_tab' ); ?>[]" name="<?php echo $this->get_field_name( 'ads_new_tab' ); ?>[]">';
						container += '</div>';

		            container += "</div>";
		        container +="</div>";
		        data_count++;

		        jQuery(".banner-wrap").append( container );

		        jQuery( '.removeElem' ).on( 'click', function(){
		           jQuery( this ).closest('div').parent().remove();
		        });
		       
	            jQuery('div.banner-wrap').unbind().on('click', 'label.accordion', function(e){
	                e.preventDefault();
	                jQuery(this).toggleClass('active').parent().parent().find('.tierone-accordion-body').toggleClass('show');
	                return false;
	            });


		    });
		</script>
	<?php
	}
	public function update( $new_instance, $old_instance ){

        $instance = array();
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['ads_title']      = strip_tags( $new_instance['ads_title'] );
        $instance['ads_alt']      	= strip_tags( $new_instance['ads_alt'] );
        $instance['ads_link']       = ( ! empty( $new_instance['ads_link'] ) ) ? strip_tags( $new_instance['ads_link'] ) : '';

        $instance['ads'] = array();

         for($i=0; $i < (count($new_instance['ads_link'])); $i++){
             if(!empty($new_instance['ads_link']) ){
                $ad = array();

                 if(!empty($new_instance['imgads1'])){

                   $ads_image =  esc_url( $new_instance['ads_image'] );

                 }else{

                   $ads_image  = esc_url( $new_instance['ads_image'][$i] );
                    
                 }


				$ad[ 'ads_title' ]		= $new_instance[ 'ads_title' ][$i];
				$ad[ 'ads_alt' ]		= $new_instance[ 'ads_alt' ][$i];
				$ad[ 'ads_link' ]		= $new_instance[ 'ads_link' ][$i];
				$ad[ 'ads_new_tab' ]	= $new_instance[ 'ads_new_tab' ][$i];
				$ad[ 'ads_image' ]		= $ads_image;
                    
                $instance['ads'][] = $ad;
            }
        }
        return $instance;

	}
}

/**
* Popular Post
*/
class tierone_popular_post extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_popular_post',
			__( 'Tierone: Popular Post', 'tierone' ),
			array(
				'description' => __( 'Display the popular post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){
		$title 		= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$no_of_post = ( ! empty( $instance['no_of_post'] ) ) ? (int)( $instance['no_of_post'] ) : 3;

		if ( empty( $title ) ) {
			$title 	= __( 'Popular Post', 'tierone' );
		}

		$tier_popular_post = new WP_Query( array(
			'ignore_sticky_posts'   => 1,
			'posts_per_page' 		=> $no_of_post,
			'post_status' 			=> 'publish',
			'orderby' 				=> 'comment_count',
			'order'					=> 'desc'
		) );
		?>
			<div class="tier-pupolar-post tier-wrap-block">
				<div class="widget-header">
					<h2 class="widget-title"><?php echo esc_attr( $title ); ?></h2>
				</div>
				<?php if( $tier_popular_post->have_posts() ){ ?>
					<?php while( $tier_popular_post->have_posts() ) : $tier_popular_post->the_post(); ?>
						<div class="clearfix tier-block-parent">
							<div class="col-xs-12 col-sm-12 col-md-4">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="tier-featured-image">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 't-post-thumbnail-small' ); ?></a>
									</figure>
								<?php else : ?>
									<figure class="tier-featured-image">
										<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-small.jpg"> </a>
									</figure>
								<?php endif; ?>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-8">
								<header class="tier-entry-header">
									<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>' ); ?>
									<div class="tier-entry-meta">
										<span class="poste-on"><a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark"><?php the_time( 'F j, Y' ); ?></a></span>
										<div class="byline"><span class="author"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></div>
									</div>
								</header>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } ?>
			</div>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args( 
			(array) $instance, array(
				'title' => ''
			)
		);
		$no_of_post = ! empty( $instance[ 'no_of_post' ] ) ? absint( $instance[ 'no_of_post' ] ) : 3;
		?>
			<div class="tierone-pupolar-post" >
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'tierone' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title', 'tierone' ); ?>">
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'no_of_post' ); ?>"><?php _e( 'No of Post:' ,'tierone' ); ?></label>
					<input type="number" id="<?php echo $this->get_field_id( 'no_of_post' ); ?>" name="<?php echo $this->get_field_name( 'no_of_post' ); ?>" value="<?php echo esc_attr( $no_of_post ); ?>">
				</div>
			</div>
		<?php
	}
	public function update( $new_instance, $old_instance ){
		$instance 		= $old_instance;
		$instance[ 'title' ] 	= strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		$no_of_post = ( ! empty( $instance['no_of_post'] ) ) ? (int)( $instance['no_of_post'] ) : 3;
		return $instance;
	}
}

/**
* Random Post
*/
class tierone_random_post extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_random_post',
			__( 'Tierone: Random Post', 'tierone' ),
			array(
				'description' => __( 'This will display a random post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){
		global $post;
		$title 			= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';

		if( empty( $title ) ){
			$title = __( 'Random Post', 'tierone' );
		}

		$tier_random_post = new WP_Query( array(
			'post_status' 	 => 'post',
			'posts_per_page' => '4',
			'orderby'		 => 'rand'
		) );
		?>
			<aside class="tier-random-post tier-wrap-block">
				<div class="widget-header">
					<h2 class="widget-title"><?php echo esc_attr( $title ); ?></h2>
				</div>
				<?php if( $tier_random_post->have_posts() ) : ?>
					<div class="clearfix row tier-block-parent tier-site-wrap">
						<?php while( $tier_random_post->have_posts() ) : $tier_random_post->the_post(); ?>
							<div class="col-xs-12 col-sm-12 col-md-6 tier-random-col">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="tier-featured-image">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 't-post-thumbnail-small' ); ?></a>
									</figure>
								<?php else : ?>
									<figure class="tier-featured-image">
										<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-small.jpg"> </a>
									</figure>
								<?php endif; ?>
								<header class="tier-entry-header">
									<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>' ); ?>
								</header>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</aside>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args( 
			(array) $instance, array(
				'title' => '',
				'post_status' => '',
				'posts_per_page' => '4'
			) 
		);
		?>
			<div class="tierone-random-post" >
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tierone' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title','tierone' ); ?>" >
				</div>
			</div>
		<?php
	}
	public function update( $new_instance, $old_instance ){
		$instance 		= $old_instance;
		$instance[ 'title' ] 				= strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		return $instance;
	}
}

/**
* Custome Archive
*/
class tierone_custom_archive extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_custom_archive',
			__( 'Tierone: Custom Archive', 'tierone' ),
			array(
				'description' => __( 'Display monthly archive of your site\'s posts', 'tierone' )
			)
		);
	}

	public function widget($args,$instance){
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
		$show_counts = isset( $instance['show_counts'] ) ? $instance['show_counts'] : '';

		if ( empty( $title ) ) {
			$title = __( 'Archives', 'tierone' );
		}
		?>
		<aside class="tier-pupolar-post tier-wrap-block tier-widget-archive">
			<div class="widget-header">
				<h2 class="widget-title"><?php echo esc_attr( $title ); ?></h2>
			</div>
			<?php
			global $wpdb;
			$year_prev = null;
			$months = $wpdb->get_results(	"SELECT DISTINCT MONTH( post_date ) AS month ,
											YEAR( post_date ) AS year,
											COUNT( id ) as post_count FROM $wpdb->posts
											WHERE post_status = 'publish' and post_date <= now( )
											and post_type = 'post'
											GROUP BY month , year
											ORDER BY post_date DESC");
			foreach($months as $month) :
				$year_current = $month->year;
				if ($year_current != $year_prev){
					if ($year_prev != null){?>
					</ul>
					<?php } ?>
				<div class="arch-title"><h3><?php echo $month->year; ?></h3></div>
				<ul class="tier-archive-list">
				<?php } ?>
				<li>
					<a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>">
						<span class="tier-archive-month"><?php echo date("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span>
						<?php if ( $show_counts == "on" ) : ?>
						<span class="tier-archive-count"><?php echo $month->post_count; ?></span>
						<?php endif; ?>
					</a>
				</li>
			<?php $year_prev = $year_current;
			endforeach;
			?>
			</ul>
			<span class="clearfix"></span>
		</aside>
		<?php
	}

	public function form($instance){
		$instance = wp_parse_args(
			(array) $instance, array(
				'title' => '',
				'show_counts' => ''
			)
		);
	?>
	<div class="tier-archive">
		<div class="tierone-admin-group">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'tierone' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Title for Featured Posts', 'tierone' ); ?>">
		</div>
		<div class="tierone-admin-group">
			<label for="<?php echo $this->get_field_id( 'show_counts' ) ?>" ><?php _e( 'Show post counts','tierone' ); ?></label>
			<input type="checkbox" <?php checked( $instance[ 'show_counts' ], 'on'  ); ?> id="<?php echo $this->get_field_id( 'show_counts' ); ?>" name="<?php echo $this->get_field_name( 'show_counts' ); ?>">
		</div>
	</div>
	<?php
	}

	public function update($new_instance, $old_instance){
		$instance  = $old_instance;
		$instance['title']  =  strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['show_counts']    = $new_instance['show_counts'];
		return $instance;
	}
}


/**
* Module Post
*/
class tierone_module_post extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_module_post',
			__( 'Tierone: Module Post', 'tierone' ),
			array(
				'description' 	=> __( 'Display the module post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){

		global $post;
		$title 		=	isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $category1      = isset( $instance[ 'category1' ] ) ? $instance[ 'category1' ] : '';

		$featured_post_a = new WP_Query( array(
			'post_type'		=> 'post',
			'category__in'  => $category1,
			'posts_per_page' => '5'
		) );
		?>
		<div class="tier-module" itemscope itemtype="http://schema.org/Blog">
			<?php if( $featured_post_a->have_posts() ) : $count = 1; ?>
				<?php while ( $featured_post_a->have_posts() ) : $featured_post_a->the_post(); ?>
					<?php if ( $count == 1 ) { ?>
						<div class="tier-module-t1">
					<?php } elseif ( $count == 3 ) {?> 
						<div class="tier-module-t2">
					<?php } ?>
							<article class="module-thumb" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" >
								<?php 
								if ( has_post_thumbnail() ) : ?>
									<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-module-top', array( 'itemprop' => 'image' ) ); ?></a>
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
											<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-module-top.jpg" itemprop="image">
											<meta itemprop="width" content="540">
											<meta itemprop="height" content="360">
										</a>
									</figure>
								<?php endif; ?>
								<div class="tier-module-overlay">
									<div class="tier-entry-meta">
										<?php tierone_meta_on(); ?>
										<?php tierone_show_first_cat(); ?>
									</div>
									<div class="tier-module-o-content">
										<?php the_title( sprintf('<h1 itemprop="headline" ><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1> ' ); ?>
									</div>
								</div>
							</article>
					<?php if ( $count == 2 || $count == 5 ) { ?> 
						</div> 
					<?php } $count++; ?>
				<?php endwhile; ?>
				<?php  wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e( 'Sorry, no posts found in selected category', 'tierone' ); ?></p>
			<?php endif; ?>
		</div>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args( 
			(array) $instance, array(
				'title' 	=> '',
				'category1' 	=> ''
			)
		);
		?>
		<div class="tierone-module" >
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'title' ); ?>" ><?php _e( 'Title:','tierone' ); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Module Title', 'tierone' ); ?>">
			</div>
			<div class="tierone-admin-group">
				<label for="<?php echo $this->get_field_id( 'category1' ); ?>" ><?php _e( 'Category 1:','tierone' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'category1' ); ?>" name="<?php echo $this->get_field_name( 'category1' ); ?>">
					<?php foreach( get_terms( 'category','parent=0&hide_empty=0' ) as $term) { ?>
						<option <?php selected( $instance['category1'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<?php
	}
	public function update( $new_instance,$old_instance ){
		$instance 	= $old_instance;
		$instance['title'] = strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		$instance['category1'] = $new_instance[ 'category1' ];
		return $instance;
	}

}
/**
* Block Module A
*/
class tierone_module_block_a extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_module_block_a',
			__( 'Tierone: Front Page Module A', 'tierone' ),
			array(
				'description' => __( 'Posts display layout A for recently published post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){
		global $post;
		$title 		=	isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$category  	= 	isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

		$tierone_module_a = new WP_Query( array(
			'post_type' 	 => 'post',
			'category__in'	 => $category,
			'posts_per_page' => 3
		));
		?>
		<div class="tier-wrap-block t-block-one">
			<div class="tier-block-title-wrap">
				<?php if( !empty( $title ) ){ ?>
					<h2 class="tier-block-title"><?php echo esc_attr( $title ); ?></h2>
				<?php } ?>
			</div>
			<div class="tier-wrap-content row">
				<?php if( $tierone_module_a->have_posts() ) : $count = 1; ?>
					<?php while ( $tierone_module_a->have_posts() ) : $tierone_module_a->the_post(); ?>
						<?php if( $count == 1 ){ ?>
							<article class="clearfix tier-block-parent" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
								<div class="col-md-6">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-module-block', array( 'itemprop' => 'image' ) ); ?></a>
											<?php tierone_show_first_cat(); ?>
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
											<?php tierone_show_first_cat(); ?>
										</figure>
									<?php endif; ?>
								</div>
								<div class="col-md-6">
									<header class="tier-entry-header">
										<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<div class="tier-entry-meta">
											<?php tierone_meta_on(); ?>
											<?php tierone_posted_on(); ?>
										</div>
									</header>
									<div class="tier-entry-content">
										<?php $excerpt = get_the_excerpt();
	                                    $limit   = "200";
	                                    $pad     = "...";

	                                    if( strlen( $excerpt ) <= $limit ) {
	                                        echo esc_html( $excerpt );
	                                    } else {
	                                    $excerpt = substr( $excerpt, 0, $limit ) . $pad;
	                                        echo esc_html( $excerpt );
	                                    }
	                                    ?>
									</div>
								</div>
							</article><!--tier-block-parent-->
						<?php }else{ ?>
							<article class="tier-block-am clearfix" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
								<div class="col-md-4">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-medium-small', array( 'itemprop' => 'image' ) ); ?></a>
											<?php tierone_show_first_cat(); ?>
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
												<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-medium-small.jpg" itemprop="image">
												<meta itemprop="width" content="213">
												<meta itemprop="height" content="142">
											</a>
											<?php tierone_show_first_cat(); ?>
										</figure>
									<?php endif; ?>
								</div>
								<div class="col-md-8">
									<header class="tier-entry-header">
										<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<div class="tier-entry-meta">
											<?php tierone_meta_on(); ?>
											<?php tierone_posted_on(); ?>
										</div>
									</header>
									<div class="tier-entry-content">
										<?php $excerpt = get_the_excerpt();
	                                    $limit   = "150";
	                                    $pad     = " [...]";

	                                    if( strlen( $excerpt ) <= $limit ) {
	                                        echo esc_html( $excerpt );
	                                    } else {
	                                    $excerpt = substr( $excerpt, 0, $limit ) . $pad;
	                                        echo esc_html( $excerpt );
	                                    }
	                                    ?>
									</div>
								</div>
							</article><!--tier-block-am-->
						<?php } $count++; ?>
					<?php endwhile;?>
					<?php  wp_reset_postdata(); ?>
				<?php endif; ?>
			</div><!--tier-wrap-content-->
		</div>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args(
			(array) $instance, array(
				'title' 	  => '',
				'category'    => '',
				'no_of_posts' => '3'
			)
		);
		?>
			<div class="tier-module-a">
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tierone' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title','tierone' ); ?>" >
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'tierone' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" >
						<?php foreach( get_terms( 'category','parent=0&hide_empty=0' ) as $term) { ?>
							<option <?php selected( $instance['category'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		<?php
	}
	public function update( $new_instance, $old_instance ){
		$instance 		= $old_instance;
		$instance[ 'title' ] 	= strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		$instance[ 'category' ] =  $new_instance['category'];
		return $instance;
	}
}

/**
* Block Module B
*/
class tierone_module_block_b extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_module_block_b',
			__( 'Tierone: Front Page Module B', 'tierone' ),
			array(
				'description' 	=> __( 'Posts display layout b for recently published post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){
		global $post;

		$title 		=	isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$category1  	= 	isset( $instance[ 'category1' ] ) ? $instance[ 'category1' ] : '';
		$category2  	= 	isset( $instance[ 'category2' ] ) ? $instance[ 'category2' ] : '';

		$tierone_module_b_1 = new WP_Query( array(
			'post_type' 	 => 'post',
			'category__in'	 => $category1,
			'posts_per_page' => 3
		));
		$tierone_module_b_2 = new WP_Query( array(
			'post_type' 	 => 'post',
			'category__in'	 => $category2,
			'posts_per_page' => 3
		));
		?>
		<div class="tier-wrap-block tier-block-two">
			<div class="tier-block-title-wrap">
				<?php if( !empty( $title ) ){ ?>
					<h2 class="tier-block-title"><?php echo esc_attr( $title ); ?></h2>
				<?php } ?>
			</div>
			<div class="tier-wrap-content row">
				<div class="col-md-6">
					<?php if( $tierone_module_b_1->have_posts() ) : $count_module_b_1 = 1; ?>
						<?php while ( $tierone_module_b_1->have_posts() ) : $tierone_module_b_1->the_post(); ?>
							<?php if( $count_module_b_1 == 1 ){ ?>
								<article class="tier-block-parent" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
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
										<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
											<a href="<?php the_permalink(); ?>" itemprop="url">
												<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-module-block.jpg" itemprop="image">
												<meta itemprop="width" content="370">
												<meta itemprop="height" content="250">
											</a>
										</figure>
									<?php endif; ?>
									<header class="tier-entry-header">
										<div class="tier-entry-meta">
											<?php tierone_show_first_cat(); ?>
											<?php tierone_meta_on(); ?>
											<?php tierone_posted_on(); ?>
										</div>
										<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>' ); ?>
									</head>
									<div class="tier-entry-content">
										<?php $excerpt = get_the_excerpt();
	                                    $limit   = "160";
	                                    $pad     = "...";

	                                    if( strlen( $excerpt ) <= $limit ) {
	                                        echo esc_html( $excerpt );
	                                    } else {
	                                    $excerpt = substr( $excerpt, 0, $limit ) . $pad;
	                                        echo esc_html( $excerpt );
	                                    }
	                                    ?>
									</div>
								</article>

								<article class="tier-block-am row clearfix" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
							<?php } else { ?>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<?php if ( has_post_thumbnail() ) : ?>
											<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-module-block', array( 'itemprop' => 'image' ) ); ?></a>
												<?php tierone_show_first_cat(); ?>
												<?php
									              $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
									              if (if_file_exists($file)) :
									                  list($width, $height, $type, $attr) = getimagesize($file);  ?>
									                  <meta itemprop="width" content="<?php echo $width; ?>">
									                  <meta itemprop="height" content="<?php echo $height; ?>">
									              <?php endif; ?> 
											</figure>
										<?php else : ?>
											<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
												<a href="<?php the_permalink(); ?>" itemprop="url">
													<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-module-block.jpg" itemprop="image">
													<meta itemprop="width" content="370">
													<meta itemprop="height" content="250">
												</a>
												<?php tierone_show_first_cat(); ?>
											</figure>
										<?php endif; ?>
										<header class="tier-entry-header">
											<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>' ); ?>
											<div class="tier-entry-meta">
												<?php tierone_meta_on(); ?>
											</div>
										</header>
									</div>
								
							<?php } $count_module_b_1++; ?>
						<?php endwhile;?>
						</article><!--tier-block-am-->
						<?php  wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
				<div class="col-md-6">
					<?php if( $tierone_module_b_2->have_posts() ) : $count_module_b_2 = 1; ?>
						<?php while ( $tierone_module_b_2->have_posts() ) : $tierone_module_b_2->the_post(); ?>
							<?php if( $count_module_b_2 == 1 ){ ?>
								<article class="tier-block-parent" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
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
										<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
											<a href="<?php the_permalink(); ?>" itemprop="url">
												<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-module-block.jpg" itemprop="image">
												<meta itemprop="width" content="370">
												<meta itemprop="height" content="250">
											</a>
										</figure>
									<?php endif; ?>
									<header class="tier-entry-header">
										<div class="tier-entry-meta">
											<?php tierone_show_first_cat(); ?>
											<?php tierone_meta_on(); ?>
											<?php tierone_posted_on(); ?>
										</div>
										<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>' ); ?>
									</head>
									<div class="tier-entry-content">
										<?php $excerpt = get_the_excerpt();
	                                    $limit   = "160";
	                                    $pad     = "...";

	                                    if( strlen( $excerpt ) <= $limit ) {
	                                        echo esc_html( $excerpt );
	                                    } else {
	                                    $excerpt = substr( $excerpt, 0, $limit ) . $pad;
	                                        echo esc_html( $excerpt );
	                                    }
	                                    ?>
									</div>
								</article>

								<article class="tier-block-am row clearfix" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
							<?php } else { ?>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<?php if ( has_post_thumbnail() ) : ?>
											<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-module-block', array( 'itemprop' => 'image' ) ); ?></a>
												<?php tierone_show_first_cat(); ?>
												<?php
									              $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
									              if (if_file_exists($file)) :
									                  list($width, $height, $type, $attr) = getimagesize($file);  ?>
									                  <meta itemprop="width" content="<?php echo $width; ?>">
									                  <meta itemprop="height" content="<?php echo $height; ?>">
									              <?php endif; ?> 
											</figure>
										<?php else : ?>
											<figure class="tier-featured-image tier-mod-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
												<a href="<?php the_permalink(); ?>" itemprop="url">
													<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-module-block.jpg" itemprop="image">
													<meta itemprop="width" content="370">
													<meta itemprop="height" content="250">
												</a>
												<?php tierone_show_first_cat(); ?>
											</figure>
										<?php endif; ?>
										<header class="tier-entry-header">
											<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) , '</a></h2>' ); ?>
											<div class="tier-entry-meta">
												<?php tierone_meta_on(); ?>
											</div>
										</header>
									</div>
								
							<?php } $count_module_b_2++; ?>
						<?php endwhile;?>
						</article><!--tier-block-am-->
						<?php  wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div><!--tier-wrap-content-->
		</div>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args(
			(array) $instance, array(
				'title' 	  => '',
				'category1'    => '',
				'category2'    => '',
				'no_of_posts' => '3'
			)
		);
		?>
			<div class="tier-module-a">
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tierone' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title','tierone' ); ?>" >
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'category1' ); ?>"><?php _e( 'Category 1:', 'tierone' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'category1' ); ?>" name="<?php echo $this->get_field_name( 'category1' ); ?>" >
						<?php foreach( get_terms( 'category','parent=0&hide_empty=0' ) as $term) { ?>
							<option <?php selected( $instance['category1'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'category2' ); ?>"><?php _e( 'Category 2:', 'tierone' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'category2' ); ?>" name="<?php echo $this->get_field_name( 'category2' ); ?>" >
						<?php foreach( get_terms( 'category','parent=0&hide_empty=0' ) as $term) { ?>
							<option <?php selected( $instance['category2'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		<?php
	}
	public function update( $new_instance, $old_instance ){
		$instance 		= $old_instance;
		$instance[ 'title' ] 	= strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		$instance[ 'category1' ] =  $new_instance['category1'];
		$instance[ 'category2' ] =  $new_instance['category2'];
		return $instance;
	}
}

/**
* Block Module C
*/
class tierone_module_block_c extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_module_block_c',
			__( 'Tierone: Front Page Module C', 'tierone' ),
			array(
				'description' => __( 'Posts display layout c for recently published post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){

		global $post;
		$title 			= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$category 		= isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$no_of_post 	= isset( $instance[ 'no_of_post' ] ) ? $instance[ 'no_of_post' ] : '';
		$random_posts 	= isset( $instance[ 'random_posts' ] ) ? $instance[ 'random_posts' ] : '';

		if( $random_posts == "on" ){
			$random_posts = "rand";
		}

		$tierone_module_c = new WP_Query( array(
			'post_type' 	 => 'post',
			'category__in' 	 => $category,
			'posts_per_page' => $no_of_post,
			'orderby'		 => $random_posts
		) );
		?>
		<div class="tier-wrap-block tier-block-thrid">
			<div class="tier-block-title-wrap">
				<?php if( !empty( $title ) ){ ?>
					<h2 class="tier-block-title"><?php echo esc_attr( $title ); ?></h2>
				<?php } ?>
			</div>
			<div class="tier-wrap-content tier-site-wrap row">
				<?php if( $tierone_module_c->have_posts() ){ ?>
					<?php while(  $tierone_module_c->have_posts() ) :  $tierone_module_c->the_post(); ?>
						<div class="col-xs-12 col-sm-12 col-md-6 tier-block-parent">
							<article class="row tier-block-parent" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-small', array( 'itemprop' => 'image' ) ); ?></a>
											<?php tierone_show_first_cat(); ?>
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
												<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-small.jpg" itemprop="image">
												<meta itemprop="width" content="160">
												<meta itemprop="height" content="107">
											</a>
											<?php tierone_show_first_cat(); ?>
										</figure>
									<?php endif; ?>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<header class="tier-entry-header">
										<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<div class="tier-entry-meta">
											<?php tierone_meta_on(); ?>
										</div>
									</header>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
					<?php  wp_reset_postdata(); ?>
				<?php }else{ ?>
					<div class="col-md-12">
						<p><?php _e( 'Sorry, no posts found in selected category', 'tierone' ); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args( 
			(array) $instance , array(
				'title' 		=> '',
				'post_type' 	=> '',
				'category' 		=> '',
				'no_of_post' 	=> '6'
			)
		);
		?>
			<div class="tier-module-c">
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tierone' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title', 'tierone' ); ?>">
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:','tierone' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'category' ) ?>" name="<?php echo $this->get_field_name( 'category' ) ?>">
						<?php foreach( get_terms( 'category','parent=0&hide_empty=0' ) as $terms ) {?>
							<option <?php selected( $instance['category'], $terms->term_id ); ?> value="<?php echo $terms->term_id;?>"><?php echo $terms->name; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'no_of_post' ); ?>"><?php _e( 'No of post:','tierone' ); ?></label>
					<input type="number" id="<?php echo $this->get_field_id( 'no_of_post' ) ?>" name="<?php echo $this->get_field_name( 'no_of_post' ) ?>" value="<?php echo esc_attr( $instance[ 'no_of_post' ] ); ?>">
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'random_posts' ); ?>"><?php _e( 'Random Post:','tierone' ); ?></label>
					<input type="checkbox" <?php checked( $instance['random_posts'], 'on' ); ?> id="<?php echo $this->get_field_id( 'random_posts' ); ?>" name="<?php echo $this->get_field_name( 'random_posts' ); ?>">
				</div>
			</div>
		<?php
	}
	public function update( $new_instance, $old_instance ){
		$instance 		= $old_instance;
		$instance[ 'title' ] 		= strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		$instance[ 'category' ] 	= $new_instance[ 'category' ];
		$instance[ 'no_of_post' ] 	= $new_instance[ 'no_of_post' ];
		$instance[ 'random_posts' ] = $new_instance[ 'random_posts' ];
		return $instance;
	}
}

/**
* Block Module D
*/
class tierone_module_block_d extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'tierone_module_block_d',
			__( 'Tierone: Front Page Module D', 'tierone' ),
			array(
				'description' => __( 'Posts display layout d for recently published post', 'tierone' )
			)
		);
	}
	public function widget( $args, $instance ){

		global $post;
		$title 			= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$category 		= isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$no_of_post 	= isset( $instance[ 'no_of_post' ] ) ? $instance[ 'no_of_post' ] : '';


		$tierone_module_d = new WP_Query( array(
			'post_type' 	 => 'post',
			'category__in' 	 => $category,
			'posts_per_page' => $no_of_post
		) );
		?>
		<div class="tier-wrap-block tier-block-fourth">
			<div class="tier-block-title-wrap">
				<?php if( !empty( $title ) ){ ?>
					<h2 class="tier-block-title"><?php echo esc_attr( $title ); ?></h2>
				<?php } ?>
			</div>
			<div class="tier-wrap-content tier-site-wrap">
				<?php if( $tierone_module_d->have_posts() ){ ?>
					<?php while(  $tierone_module_d->have_posts() ) :  $tierone_module_d->the_post(); ?>
						<article class="row tier-block-parent" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
							<div class="col-md-5">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="tier-featured-image" itemprop="image" itemscope itemType="http://schema.org/ImageObject">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="url"><?php the_post_thumbnail('t-post-thumbnail-medium-small', array( 'itemprop' => 'image' ) ); ?></a>
										<?php tierone_show_first_cat(); ?>
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
											<img src="<?php echo get_template_directory_uri(); ?>/image/default/dt-featured-post-medium-small.jpg" itemprop="image">
											<meta itemprop="width" content="370">
											<meta itemprop="height" content="250">
										</a>
										<?php tierone_show_first_cat(); ?>
									</figure>
								<?php endif; ?>
							</div>
							<div class="col-md-7">
								<header class="tier-entry-header">
									<?php the_title( sprintf( '<h2 class="entry-title tier-mod-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									<div class="tier-entry-meta">
										<?php tierone_meta_on(); ?>
										<?php tierone_posted_on(); ?>
									</div>
								</header>
								<div class="tier-entry-content">
									<?php $excerpt = get_the_excerpt();
                                    $limit   = "250";
                                    $pad     = " [...]";

                                    if( strlen( $excerpt ) <= $limit ) {
                                        echo esc_html( $excerpt );
                                    } else {
                                    $excerpt = substr( $excerpt, 0, $limit ) . $pad;
                                        echo esc_html( $excerpt );
                                    }
                                    ?>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
					<?php  wp_reset_postdata(); ?>
				<?php }else{ ?>
					<div class="col-md-12">
						<p><?php _e( 'Sorry, no posts found in selected category', 'tierone' ); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
	public function form( $instance ){
		$instance = wp_parse_args( 
			(array) $instance , array(
				'title' 		=> '',
				'post_type' 	=> '',
				'category' 		=> '',
				'no_of_post' 	=> '3'
			)
		);
		?>
			<div class="tier-module-d">
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tierone' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" placeholder="<?php _e( 'Title', 'tierone' ); ?>">
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:','tierone' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'category' ) ?>" name="<?php echo $this->get_field_name( 'category' ) ?>">
						<?php foreach( get_terms( 'category','parent=0&hide_empty=0' ) as $terms ) {?>
							<option <?php selected( $instance['category'], $terms->term_id ); ?> value="<?php echo $terms->term_id;?>"><?php echo $terms->name; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="tierone-admin-group">
					<label for="<?php echo $this->get_field_id( 'no_of_post' ); ?>"><?php _e( 'No of post:','tierone' ); ?></label>
					<input type="number" id="<?php echo $this->get_field_id( 'no_of_post' ) ?>" name="<?php echo $this->get_field_name( 'no_of_post' ) ?>" value="<?php echo esc_attr( $instance[ 'no_of_post' ] ); ?>">
				</div>
			</div>
		<?php
	}
	public function update( $new_instance, $old_instance ){
		$instance 		= $old_instance;
		$instance[ 'title' ] 		= strip_tags( stripslashes( $new_instance[ 'title' ] ) );
		$instance[ 'category' ] 	= $new_instance[ 'category' ];
		$instance[ 'no_of_post' ] 	= $new_instance[ 'no_of_post' ];
		return $instance;
	}
}

function tierone_register_widgets(){
	register_widget( 'tierone_add670x70' );
	register_widget( 'tierone_add300x250' );
	register_widget( 'tierone_custom_banner' );
	register_widget( 'tierone_popular_post' );
	register_widget( 'tierone_random_post' );
	register_widget( 'tierone_custom_archive' );
	register_widget( 'tierone_module_post' );
	register_widget( 'tierone_module_block_a' );
	register_widget( 'tierone_module_block_b' );
	register_widget( 'tierone_module_block_c' );
	register_widget( 'tierone_module_block_d' );
}

add_action( 'widgets_init', 'tierone_register_widgets' );


?>