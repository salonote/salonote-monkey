<?php

$field_key = 'essence_extention';
$field_arr = array(
  

	'use_content_fade' => array(
      'label' => __('Use Content FadeIn','salonote-essence'),
      'type' => 'checkbox',
  ),
	
	'use_lazy_load' => array(
      'label' => __('Use Lazy Load plugin','salonote-essence'),
      'type' => 'checkbox',
  ),
  
  'use_colorbox' => array(
      'label' => __('Use Colorbox','salonote-essence'),
      'type' => 'checkbox',
      'description' => __('Popup image when Click','salonote-essence'),
  ),
  
  'use_gallery' => array(
      'label' => __('Use Gallery Background','salonote-essence'),
      'type' => 'checkbox',
  ),
  'use_slick' => array(
      'label' => __('Use Slick Plugin','salonote-essence'),
      'type' => 'checkbox',
  ),
  
  'use_side_hover' => array(
      'label' => __('Use Side Hover Effect','salonote-essence'),
      'type' => 'checkbox',
  ),
  
  'fb_appid' => array(
      'label' => __('Facebook appID','salonote-essence'),
      'type' => 'text',
      'description' => __('Need show Facebook Plugin','salonote-essence'),
  ),
	'google_ad' => array(
      'label' => __('Google Adwords Code','salonote-essence'),
      'type' => 'textarea',
      'description' => __('You can use shortcode [GoogleAD]','salonote-essence'),
  ),
	'head_tag_admin' => array(
      'label' => __('Insert Head Tag exclude administrater','salonote-essence'),
      'type' => 'textarea',
  ),
	'head_tag_user' => array(
      'label' => __('Insert Head Tag global','salonote-essence'),
      'type' => 'textarea',
  ),
	
	'header_html_user' => array(
      'label' => __('Insert Header Html global','salonote-essence'),
      'type' => 'textarea',
  ),
  
  'error_page' => array(
      'label' =>  __('404 error page','salonote-essence'),
      'type'  => 'select',
      'selecter' => array(
							''  =>  __('','salonote-essence'),
			        '301(恒久的)' 	=>  __('301','salonote-essence'),
							'302(一時的)'  =>  __('302','salonote-essence'),
      )
  ),
  
);
?>

<div class="wrap">
<h1><?php _e('Theme Setting','salonote-essence'); ?></h1>
  

<form method="post" action="options.php">
    <?php settings_fields( 'essence-theme-option-extention' ); ?>
    <?php do_settings_sections( 'essence-theme-option-extention' ); ?>
    <table class="form-table">
      <?php
      $_options_value = !empty(get_option($field_key)) ? get_option($field_key) : '' ;
      //echo '<pre>'; print_r($_base_fields); echo '</pre>';
      essence_theme_opiton_form($field_key,$field_arr,$_options_value);
      ?>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>