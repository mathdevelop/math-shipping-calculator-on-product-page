<?php

/**
 * Plugin Name: Math Shipping Calculator on Product Page
 * Plugin URI: https://github.com/mathdevelop/math-shipping-calculator-on-product-page
 * Description: Display a shipping calculator to your customer on the product page using any delivery method.
 * Version: 1.0.0
 * Author: Matheus Alves
 * Author URI: https://github.com/mathdevelop
 */

defined('ABSPATH') || exit;

if(!defined('MSCPP_PATH')) {
	define('MSCPP_PATH', __FILE__);
}

if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    include_once dirname(MSCPP_PATH) . '/includes/mscpp-functions.php';
}