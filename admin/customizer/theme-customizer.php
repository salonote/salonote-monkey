<?php
/*-------------------------------------------*/
/*	color setting
/*-------------------------------------------*/


add_theme_support( 'custom-background', array(
  'default-color' => 'FFFFFF',
) );

class Essence_Theme_Customize
   {

    public static function essence_customize_register($wp_customize) {
      
      global $color_customize_array;
				foreach($color_customize_array as $key => $value):
					//setting
					$wp_customize->add_setting( $key, array( 'default' => $value['default'],'sanitize_callback' => 'sanitize_hex_color' ) );
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key , array(
							'label' => $value['label_jp'],
							'section' => $value['section'],
							'settings' => $key,
					) ) );
				
					//realtime
					$wp_customize->get_setting( $key )->transport = 'postMessage';
				
				endforeach;
 
    }

}//Essence_Theme_Customize
add_action( 'customize_register' , array( 'Essence_Theme_Customize' , 'essence_customize_register' ) );



?>
