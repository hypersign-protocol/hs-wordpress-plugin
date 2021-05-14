<?php

/**
 * Plugin Name: Hypersign Authentcation
 * Description: Allow your users to login into your website without using passwordless.
 */


require_once 'routes/index.php';
require_once 'routes/heartbeat-api-pulse.php';

function func_load_vuescripts()
{
  wp_register_script('wp_jqueryjs', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
  wp_register_script('wp_qrcodejs', 'https://cdn.jsdelivr.net/npm/jquery.qrcode@1.0.3/jquery.qrcode.min.js');
  wp_register_script('hsutils', plugins_url('js/utils.js', __FILE__));
  wp_register_script('hypersign', plugins_url('js/hypersign.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'func_load_vuescripts');



//Add shortscode
function func_wp_vue()
{
  ///// Loading all scripts 
  wp_enqueue_script('wp_jqueryjs');
  wp_enqueue_script('wp_qrcodejs');
  wp_enqueue_script('hsutils');
  wp_enqueue_script('hypersign');
  $src = "<h3>Hypersign Login</h3></br><div id='qrcode'></div></br><h5>Scan QR code using Hypersign Wallet</h5>";
  return $src;
}

add_shortcode('hypersign', 'func_wp_vue');

// //// Heart beat - polling
$heartbeat_api_pulse = new Heartbeat_API_Pulse(__FILE__);
$heartbeat_api_pulse->version = '1.0.0';
$heartbeat_api_pulse->init();
