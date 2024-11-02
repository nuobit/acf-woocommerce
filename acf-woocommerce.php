<?php
/**
 * Plugin Name: ACF WooCommerce
 * Plugin URI: https://github.com/yourusername/acf-to-wc-rest-api
 * Description: Handles updating Advanced Custom Fields (ACF) repeater fields through the WooCommerce REST API.
 * Version: 1.0.0
 * Author: NuoBiT Solutions, S.L.
 * Author URI: https://www.nuobit.com/
 * License: GPLv3 or later
 * Text Domain: acf-to-wc-rest-api
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html 
 */

// Exit if accessed directly outside of WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add a filter to modify the product object before it's inserted via the WooCommerce REST API
add_filter('woocommerce_rest_pre_insert_product_object', 'acf_repeater_to_woocommerce_rest_pre_insert_product_object', 10, 2);

/**
 * Handles updating ACF repeater fields through the WooCommerce REST API.
 *
 * @param WC_Product       $product The product object being inserted or updated.
 * @param WP_REST_Request  $request The request object from the REST API.
 * @return WC_Product The modified product object.
 */
function acf_repeater_to_woocommerce_rest_pre_insert_product_object( $product, $request ) {
    // Check if 'meta_data' is set and is an array in the request
    if ( isset( $request['meta_data'] ) && is_array( $request['meta_data'] ) ) {
        $meta_data = $request['meta_data'];
        $additional_meta = [];

        foreach ( $meta_data as $index => $meta ) {
            if ( !isset( $meta['key'] ) || !isset( $meta['value'] ) ) {
                continue;
            }

            // Get the ACF field key based on the field name and post ID
            $field_name = $meta['key'];
            $field = acf_get_field($field_name);

            if ($field && $field['type'] == 'repeater') {
                if (!is_numeric($meta['value'])) {
                    continue;
                }

                $num_rows = intval($meta['value']);

                if ($num_rows > 0) {
                    $additional_meta[] = [
                        'key' => "_" . $field_name,
                        'value' => $field['key']
                    ];
                    foreach ($field['sub_fields'] as $sub_field) {
                        for ($count = 0; $count < $num_rows; $count++) {
                            $additional_meta[] = [
                                'key' => "_{$field_name}_{$count}_{$sub_field['name']}",
                                'value' => $sub_field['key']
                            ];
                        }
                    }
                } else {
                    acf_update_value( null, $product->get_id(), $field );
                }
            }
        }

        $meta_data = array_merge( $meta_data, $additional_meta );

        foreach ( $meta_data as $meta ) {
            $product->update_meta_data( $meta['key'], $meta['value'], isset( $meta['id'] ) ? $meta['id'] : '' );
        }
    }

    return $product;
}
?>
