# ACF to WooCommerce REST API

**Version:** 1.0.0<br>
**Author:** NuoBiT Solutions, S.L.<br>
**License:** GPLv3 or later

## Description:

Enables the updating of Advanced Custom Fields (ACF) repeater fields via the WooCommerce REST API. This plugin allows seamless integration of ACF custom repeater fields with WooCommerce products, enabling modifications through RESTful API requests for more dynamic and customizable e-commerce solutions.

## Core Functionality:

- **ACF Repeater Field Handling**: Detects and processes ACF repeater fields from `meta_data` sent through the WooCommerce REST API, adding rows based on provided metadata and dynamically linking subfields to the WooCommerce product object.

- **Integration with WooCommerce REST API**: Utilizes the `woocommerce_rest_pre_insert_product_object` filter to hook into WooCommerce's product creation and update processes, making it compatible with API-driven product updates.

- **Customizable Metadata**: Supports flexible metadata structures within repeater fields, allowing subfields to be mapped and dynamically generated based on the number of rows specified in the API request.

## Use Cases:

- **Automated Product Updates**: Ideal for e-commerce platforms that rely on external sources or automated systems to update product information, including complex repeater structures, directly through the WooCommerce API.

- **Enhanced Product Customization**: Useful for stores that employ custom fields extensively, as it ensures ACF repeater data is accurately applied to products without manual intervention.

- **Data Synchronization**: Simplifies the integration of external systems with WooCommerce by facilitating the update of complex ACF field structures through API calls, reducing the need for direct database updates.

## Requirements:

- **Advanced Custom Fields (ACF) Plugin**: Required to define and manage custom fields, specifically repeater fields, for WooCommerce products.
- **WooCommerce**: Ensures compatibility with the WooCommerce REST API for handling product metadata updates.

## Installation:

1. Download the plugin files or clone the repository.
2. Upload the files to your WordPress `plugins` directory.
3. Activate the plugin through the WordPress admin dashboard.
4. Ensure you have configured ACF repeater fields for the desired WooCommerce products.

## Usage:

Once installed and activated, this plugin will automatically detect ACF repeater fields in WooCommerce product metadata sent via the REST API. Include `meta_data` with the appropriate keys and values in your API request to add or update repeater field data. 

## GitHub Repository:

[GitHub Repository](https://github.com/nuobit/acf-to-wc-rest-api)
