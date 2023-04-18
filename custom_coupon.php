<?php

/**
 * Plugin name:Custom Coupon
 * Plugin Description:Appling custom coupon for the products
 * version:1.0
 * Author:Sibi
 * Text Domain: custom-coupon
 */


defined('ABSPATH') or exit();
if (!file_exists(WP_PLUGIN_DIR . '/custom_coupon/vendor/autoload.php')) return;
require_once WP_PLUGIN_DIR . '/custom_coupon/vendor/autoload.php';
if ((!class_exists('Cc\App\Router')) || (!method_exists(\Cc\App\Router::class, 'hooks'))) return;
$router = new Cc\App\Router();
$router->hooks();

