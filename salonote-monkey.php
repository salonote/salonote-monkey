<?php
/*
Plugin Name:salonote Monkey
Plugin URI:https://salonote.com
Description:Salonoteモンキー
Version: 1.0.0
Author:Healing Solutions
Author URI: https://www.healing-solutions.jp/
License: GPL2
*/

/*  Copyright 2016 Healing Solutions (email : info@healing-solutions.jp)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
     published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//プラグインのパスを設定
define('SALONOTE_HELPER__PLUGIN_PATH' , dirname(__FILE__)  );

class SALONOTE_HELPER__Class {

	function __construct() {

  //function 
  require( SALONOTE_HELPER__PLUGIN_PATH . '/inc/functions.php');
    
  require( SALONOTE_HELPER__PLUGIN_PATH . '/admin/customizer/theme-customizer.php');
  require( SALONOTE_HELPER__PLUGIN_PATH . '/admin/inc/color.php');

  //dashboard widget
  require_once( SALONOTE_HELPER__PLUGIN_PATH. '/lib/module/dashboard_ajax.php' ); 

  //plugins
  require_once( SALONOTE_HELPER__PLUGIN_PATH. '/plugins/search-engine-essence/search-engine-essence.php' );
  //require_once( get_template_directory(). '/lib/salonote-helper/plugins/categories-images/categories-images.php' );
  require_once( SALONOTE_HELPER__PLUGIN_PATH. '/plugins/words-check-essence/words-check-essence.php' );

	}
  
  function activation() {
      /* 有効にした時の処理 */
  } 
  function deactivation() {
      /* 停止にした時の処理 */  
  }
}
$obj = new SALONOTE_HELPER__Class();
