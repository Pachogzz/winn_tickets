<?php
/*
 * Disable Download / Virtual checkbox on product dashboard
 */
function my_remove_product_type_options( $options ) {
	// Virtual product checkbox
	// if ( isset( $options['virtual'] ) ) {
	// 	unset( $options['virtual'] );
	// }
    
	// Downloable product checkbox
	if ( isset( $options['downloadable'] ) ) {
		unset( $options['downloadable'] );
	}
	return $options;
}
add_filter( 'product_type_options', 'my_remove_product_type_options' );

/*
 * Disable Download Tab from user my account page
 */
add_filter( 'woocommerce_account_menu_items', 'remove_downloads_my_account', 999 );
function remove_downloads_my_account( $items ) {
    unset($items['downloads']);
    unset($items['edit-address']);
    return $items;
}

/*
 * Disable autologin when create an new account
 */
add_filter( 'woocommerce_registration_auth_new_customer', '__return_false' );

/**
 * @snippet       Add First & Last Name to My Account Register Form - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// 1. ADD FIELDS
  
add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
  
function bbloomer_add_name_woo_account_registration() {
    ?>
  
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'Nombre(s)', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
  
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Apellidos', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
  
    <div class="clear"></div>
  
    <?php
}
  
// 2. VALIDATE FIELDS
  
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
  
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}
  
// 3. SAVE FIELDS
  
add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );
  
function bbloomer_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }
  
}

/*
 * Fix for styles on prices on product list on admin for woocommerce
 */
add_action('admin_head', 'custom_css_fix');
function custom_css_fix() {
  echo '<style>
    .wp-list-table .type-product .price.column-price{
        /*border: 1px solid red;*/
    }
    .wp-list-table .type-product .price.column-price #event_data_details .admin-none{
        /*border: 1px solid blue;*/
        display: none;
        visibility: hidden;
        opacity: 0;
    }
    .wp-list-table .type-product .price.column-price #event_data_details #event_data_details{
        /*border: 1px solid green;*/
    }
    .wp-list-table .type-product .price.column-price #event_data_details #event_data_details .event_data-columns:last-child{
        /*border: 3px solid purple;*/
    }
    .wp-list-table .type-product .price.column-price #event_data_details #event_data_details .event_data-columns:last-child .event_data-col:first-child{
        /*border: 3px solid orange;*/
        display: none;
        visibility: hidden;
        opacity: 0;
    }
    .wp-list-table .type-product .price.column-price #event_data_details #event_data_details .event_data-columns:last-child .event_data-col:last-child{
        /*border: 3px solid pink;*/
    }
    .wp-list-table .type-product .price.column-price #event_data_details #event_data_details .event_data-columns:last-child .event_data-col:last-child .event_data-title{
        /*border: 3px solid lightblue;*/
        display: none;
        visibility: hidden;
        opacity: 0;
    }
  </style>';
}

 /**
 Remove all possible fields
 **/
function wc_remove_checkout_fields( $fields ) {

    // Billing fields
    // unset( $fields['billing']['billing_first_name'] );
    // unset( $fields['billing']['billing_last_name'] );
    // unset( $fields['billing']['billing_email'] );
    // unset( $fields['billing']['billing_phone'] );
    unset( $fields['billing']['billing_company'] );
    unset( $fields['billing']['billing_address_1'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_city'] );
    unset( $fields['billing']['billing_state'] );
    unset( $fields['billing']['billing_country'] );
    unset( $fields['billing']['billing_postcode'] );

    // Shipping fields
    // unset( $fields['shipping']['shipping_first_name'] );
    // unset( $fields['shipping']['shipping_last_name'] );
    // unset( $fields['shipping']['shipping_email'] );
    // unset( $fields['shipping']['shipping_phone'] );
    unset( $fields['shipping']['shipping_company'] );
    unset( $fields['shipping']['shipping_address_1'] );
    unset( $fields['shipping']['shipping_address_2'] );
    unset( $fields['shipping']['shipping_city'] );
    unset( $fields['shipping']['shipping_state'] );
    unset( $fields['shipping']['shipping_country'] );
    unset( $fields['shipping']['shipping_postcode'] );

    // Order fields
    unset( $fields['order']['order_comments'] );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );