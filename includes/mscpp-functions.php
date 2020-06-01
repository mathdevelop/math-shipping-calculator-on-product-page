<?php

function mscpp_scripts() {
    if(is_product()) {
        wp_enqueue_style('mscpp-style', plugins_url('assets/css/style.min.css', MSCPP_PATH));
        wp_enqueue_script('mscpp-script', plugins_url('assets/js/script.min.js', MSCPP_PATH), array('jquery'));
        wp_localize_script('mscpp-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}

function mscpp_template() {
    include_once dirname(MSCPP_PATH) . '/templates/mscpp-calculator.php';
}

function mscpp_calculate() {
    WC()->customer->set_shipping_postcode($_POST['postal_code']);

    $product = wc_get_product($_POST['product']);
    $variation_id = 0;
    $variation_data = [];

    if($product->is_type('variation')) {
        $variation_id = $product->get_id();
        $variation_data = wc_get_product_variation_attributes($variation_id);
    }

    $cart = clone WC()->cart;
	
	$cart->empty_cart();

    $cart->add_to_cart($_POST['product'], $_POST['quantity'], $variation_id, $variation_data);

    $packages = $cart->get_shipping_packages();

    $rates = current(WC()->shipping->calculate_shipping($packages))['rates'];

    $shipping_method = [];

    foreach($rates as $rate) {
		$label = $rate->get_label();
		$delivery_forecast = $rate->get_meta_data()['_delivery_forecast'] ?? '';
		
		if(empty($delivery_forecast)) {
			$custom_label = explode(' (', $label, 2);
			
			if(count($custom_label) > 1) {
				$custom_delivery_forecast = preg_replace('/[^0-9]/', '', $custom_label[1]);
				
				if(!empty($custom_delivery_forecast)) {
					$label = $custom_label[0];
					$delivery_forecast = $custom_delivery_forecast;
				}
			}
		}
		
        $shipping_method[] = ['label' => $label, 'cost' => $rate->get_cost(), 'delivery_forecast' =>  $delivery_forecast];
    }

    echo json_encode($shipping_method);

    wp_die();
}

add_action('wp_enqueue_scripts', 'mscpp_scripts');
add_action('woocommerce_before_add_to_cart_button', 'mscpp_template');
add_action('wp_ajax_mscpp_calculate', 'mscpp_calculate');
add_action('wp_ajax_nopriv_mscpp_calculate', 'mscpp_calculate');