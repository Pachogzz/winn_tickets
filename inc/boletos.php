<?php

add_filter('woocommerce_product_data_tabs', 'boletos_product_settings_tabs' );
function boletos_product_settings_tabs( $tabs ){
 
	//unset( $tabs['inventory'] );
 
	$tabs['boletos'] = array(
		'label'    => 'Boletos',
		'target'   => 'boletos_product_data',
		'priority' => 21,
	);
	return $tabs;
 
}
 
/*
 * Tab content
*/
add_action( 'woocommerce_product_data_panels', 'boletos_product_panels' );
function boletos_product_panels(){


	$boletosTabs = get_post_meta( get_the_ID(), 'boletos_tabs', true );
	$boletosTabs = $boletosTabs +1;

	$prefijoTabs = get_post_meta( get_the_ID(), 'prefijo_tabs', true );
	$prefijoBoletos = get_post_meta( get_the_ID(), 'prefijo_boletos', true );
	$cantidadBoletos = get_post_meta( get_the_ID(), 'cantidad_boletos', true );

	$stock = get_post_meta( get_the_ID(), '_stock', true );
	$cantidadTotal = "";
	$suma = 0;

	foreach ($cantidadBoletos as $key => $value) {
		$suma += $value;
	}

	$cantidadTotal = $stock - $suma;
 
	echo '<div id="boletos_product_data" class="panel woocommerce_options_panel">';

		echo '<div class="options_group">';

			woocommerce_wp_select( array(
				'id'          => 'boletos_tabs',
				'value'       => get_post_meta( get_the_ID(), 'boletos_tabs', true ),
				'label'       => 'Cuantas Secciones',
				'options'     => array( 
					'' => 'Seleccionar', 
					'1' => '1', 
					'2' => '2', 
					'3' => '3', 
					'4' => '4', 
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11', 
					'12' => '12', 
					'13' => '13', 
					'14' => '14', 
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
					'21' => '21',
					'22' => '22',
					'23' => '23',
					'24' => '24',
					'25' => '25',
					'26' => '26'
				),
			));
		echo '</div>';
 
		echo '<div class="options_group">';
			for ($i=1; $i < $boletosTabs; $i++) { 
				woocommerce_wp_text_input( array(
					'id'                => 'prefijo_tabs[' . $i . ']',
					'value'             => $prefijoTabs[$i],
					'label'             => 'Prefijo de la Seccion: ' . $i
				));
			}
		echo '</div>';
	

		?>

			<?php if($cantidadTotal == 0): ?>
				
			<?php else: ?>
					<?php if( $cantidadTotal >= 0): ?>
						<div style="background-color: #ff0000; color: #fff; padding: 10px;">
							Restante de boletos: <strong><?php echo $cantidadTotal; ?></strong>
						</div>
					<?php elseif($cantidadTotal < 0): ?>
						<div style="background-color: #ff0000; color: #fff; padding: 10px;">
							El total de boletos no coincide con el stock en inventario
						</div>
					<?php endif; ?>
			<?php endif; ?>
			

			<?php for($i=1; $i < $boletosTabs; $i++): ?>
				<p class="form-field dimensions_field">
					<label for="product_length">Boletos de la seccion: <?php echo $i; ?></label>
					<span class="wrap">
						<input id="boletos_prefijo" placeholder="Prefijo" class="input-text" type="text" name="prefijo_boletos[<?php echo $i; ?>]" value="<?php echo $prefijoBoletos[$i] ?>">
						<input id="boletos_cantidad" placeholder="Cantidad" class="input-text" type="text" name="cantidad_boletos[<?php echo $i; ?>]" value="<?php echo $cantidadBoletos[$i] ?>">
					</span>
				</p>
			<?php endfor; ?>
			<hr>
			<div style="margin-left:15px; margin-bottom:20px;">
				<h3><?php echo "Total boletos: " . $suma;?></h3>
			</div>

		<?php
 
	echo '</div>';
 
}

/**
 * Save the custom fields.
 */
function save_boletos($post_id){
	if(!empty($_POST['boletos_tabs'])){
		update_post_meta( $post_id, 'boletos_tabs', $_POST['boletos_tabs']);
	}

	if (!empty($_POST['prefijo_tabs'])) {
		update_post_meta( $post_id, 'prefijo_tabs', $_POST['prefijo_tabs']);
	}

	if(!empty($_POST['prefijo_boletos'])){
		update_post_meta( $post_id, 'prefijo_boletos', $_POST['prefijo_boletos']);
	}

	if(!empty($_POST['cantidad_boletos'])){
		update_post_meta( $post_id, 'cantidad_boletos', $_POST['cantidad_boletos']);
	}

}
add_action( 'woocommerce_process_product_meta_simple', 'save_boletos'  );
add_action( 'woocommerce_process_product_meta_variable', 'save_boletos'  );


/**
 * Icon CSS
 */
add_action('admin_head', 'boletos_css_icon');
function boletos_css_icon(){
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.boletos_options.boletos_tab a:before{
		content: "\f486";
	}
	#woocommerce-product-data ul.wc-tabs li.eventodata_options.eventodata_tab a:before{
		content: "\f119";
	}
	</style>';
}


function tabs_boletos() {


	$boletosTabs = get_post_meta( get_the_ID(), 'boletos_tabs', true );
	$prefijoTabs = get_post_meta( get_the_ID(), 'prefijo_tabs', true );

	$prefijoBoletos = get_post_meta( get_the_ID(), 'prefijo_boletos', true );
	$cantidadBoletos = get_post_meta( get_the_ID(), 'cantidad_boletos', true );

	$tabs = $boletosTabs + 1;

	$noBoletos = $product->stock_quantity / $boletosTabs;

	global $woocommerce;
	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {

        if (!empty($cart_item['boleto'])) {
            $boletos = count($cart_item['boleto']);
            $boletos = (string) $boletos;
            $woocommerce->cart->set_quantity($cart_item_key, $boletos);
        }
		
	}

	?>
		<div class="woocommerce-tabs wc-tabs-wrapper" style="margin-bottom:40px; border-bottom:1 px solid #000;">
			<ul class="tabs wc-tabs" role="tablist">
				<?php foreach($prefijoTabs as $num => $tab): ?>
					<li class="<?php echo esc_attr( $num ); ?>_tab active" id="tab-title-<?php echo esc_attr( $num ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $num ); ?>">
						<a href="#tab-<?php echo esc_attr( $num ); ?>">
							<?php echo $tab; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php foreach($prefijoTabs as $num => $tab): ?>
				<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $num ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $num ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $num ); ?>">
					<ul class="list-boletos">
						<?php for($n = 1; $n < $cantidadBoletos[$num] + 1; $n++) : ?>
							<li>
								<label><input id="trigger" type="checkbox" name="boleto[]" value="<?php echo $prefijoBoletos[$num] . '-' . $n; ?>" /><span><?php echo $prefijoBoletos[$num] . "-" . $n; ?></span></label>
							</li>
						<?php endfor; ?>
					</ul>
				</div>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_product_after_tabs' ); ?>

		</div>

	<?php
}

add_action( 'woocommerce_before_add_to_cart_button', 'tabs_boletos' );
// add_action( 'woocommerce_after_single_product_summary', 'tabs_boletos');



/**
 * Add custom cart item data
 */
function plugin_republic_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if( isset( $_POST['boleto'] )){
        $cart_item_data['boleto'] = $_POST['boleto'];
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'plugin_republic_add_cart_item_data', 10, 3 );

/**
 * Add custom cart item data to cart
 */
function plugin_republic_get_item_data( $item_data, $cart_item_data ) {
    if( isset( $cart_item_data['boleto'])){

        foreach ($cart_item_data['boleto'] as $boleto) {
            $totalBoletos .= $boleto . ", ";
        }

        $item_data[] = array(
            'key' => __( 'Boleto'),
            'value' => $totalBoletos,
        );
    }
    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'plugin_republic_get_item_data', 10, 2 );

/**
 * Add custom cart item data to emails
 */
// function plugin_republic_order_item_name( $product_name, $item ) {
//     if( isset( $item['pr_field'] ) ) {
//         $product_name .= sprintf(
//             '<ul><li>%s: %s</li></ul>',
//                 __( 'Your name', 'plugin_republic' ),
//                 esc_html( $item['pr_field'] )
//             );
//     }
//     return $product_name;
//    }
// add_filter( 'woocommerce_order_item_name', 'plugin_republic_order_item_name', 10, 2 );


/**
* Add custom field to the checkout page
*/
add_action('woocommerce_after_order_notes', 'custom_checkout_field');
function custom_checkout_field($checkout){

	global $woocommerce;
	$items = $woocommerce->cart->get_cart();

	foreach ($items as $key => $value) {
		$boletos = $value['boleto'];
	}

	foreach ($boletos as $boleto) {

		echo '<div id="custom_checkout_field"><h4>' . __('Boleto') . " " . $boleto . '</h4>';

			woocommerce_form_field('custom_field_name', array(
				'type' => 'text',
				'class' => array(
					'my-field-class form-row-wide'
				),
				'label' => __('Nombre')
			),
			$checkout->get_value('custom_field_name'));

			woocommerce_form_field('custom_field_name', array(
				'type' => 'text',
				'class' => array(
					'my-field-class form-row-wide'
				),
				'label' => __('Apellido')
			),
			$checkout->get_value('custom_field_name'));

			woocommerce_form_field('custom_field_name', array(
				'type' => 'text',
				'class' => array(
					'my-field-class form-row-wide'
				),
				'label' => __('Teléfono')
			),
			$checkout->get_value('custom_field_name'));

			woocommerce_form_field('custom_field_name', array(
				'type' => 'text',
				'class' => array(
					'my-field-class form-row-wide'
				),
				'label' => __('Correo')
			),
			$checkout->get_value('custom_field_name'));

		echo '</div>';

	}

}

/**
* Update the value given in custom field
*/
add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');
function custom_checkout_field_update_order_meta($order_id){

	if (!empty($_POST['custom_field_name'])) {
		update_post_meta($order_id, 'Some Field', sanitize_text_field($_POST['custom_field_name']));
	}
	
}
add_action( 'woocommerce_add_order_item_meta', 'tshirt_order_meta_handler', 1, 3 );