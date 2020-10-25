<?php
/*
Plugin Name: Override woocommerce template
Plugin URI: http://www.learndash.com
Description: Override woocommerce template
Version: 1.6.0
Author: Prozoned
Author URI: http://www.learndash.com
Text Domain: prozoned_override_woocommerce_template
Doman Path: /languages/
*/


function myplugin_plugin_path() {

    // gets the absolute path to this plugin directory
  
    return untrailingslashit( plugin_dir_path( __FILE__ ) );
  }
  add_filter( 'woocommerce_locate_template', 'myplugin_woocommerce_locate_template', 10, 3 );
  
  
  
  function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
    global $woocommerce;
  
    $_template = $template;
  
    if ( ! $template_path ) $template_path = $woocommerce->template_url;
  
    $plugin_path  = myplugin_plugin_path() . '/woocommerce/';
  
    // Look within passed path within the theme - this is priority
    $template = locate_template(
  
      array(
        $template_path . $template_name,
        $template_name
      )
    );
  
    // Modification: Get the template from this plugin, if it exists
    if ( ! $template && file_exists( $plugin_path . $template_name ) )
      $template = $plugin_path . $template_name;
  
    // Use default template
    if ( ! $template )
      $template = $_template;
  
    // Return what we found
    return $template;
  }
?>