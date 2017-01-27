<?php
if ( !defined( 'ABSPATH' ) ) :
 exit; // Exit if accessed directly
endif;

/**
* The sidebar containing the error widget area.
*
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package tierone
*/

if ( ! is_active_sidebar( 'tier-sidebar' ) ) {
	return;
}

?>
<div id="secondary" class="widget-area main-widget-area" role="complementary">
	<?php dynamic_sidebar( 'tier-sidebar' ); ?>
</div>
