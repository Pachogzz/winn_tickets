<?php
/**
 * Product Data: Boletos del Evento.
 *
 */


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
			<?php for($i=1; $i < $boletosTabs; $i++): ?>
				<p class="form-field dimensions_field">
					<label for="product_length">Boletos de la seccion: <?php echo $i; ?></label>
					<span class="wrap">
						<input id="boletos_prefijo" placeholder="Prefijo" class="input-text" type="text" name="prefijo_boletos[<?php echo $i; ?>]" value="<?php echo $prefijoBoletos[$i] ?>">
						<input id="boletos_cantidad" placeholder="Cantidad" class="input-text" type="text" name="cantidad_boletos[<?php echo $i; ?>]" value="<?php echo $cantidadBoletos[$i] ?>">
					</span>			
				</p>
			<?php endfor; ?>

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
	</style>';
}
