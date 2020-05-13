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
 
	echo '<div id="boletos_product_data" class="panel woocommerce_options_panel">';

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
 
		woocommerce_wp_text_input( array(
			'id'                => 'prefijo_tabs',
			'value'             => get_post_meta( get_the_ID(), 'prefijo_tabs', true ),
			'label'             => 'Prefijo de la Tabs'
		));

		woocommerce_wp_text_input( array(
			'id'                => 'boletos_total',
			'value'             => get_post_meta( get_the_ID(), 'boletos_total', true ),
			'label'             => 'Total de boletos'
		));

		woocommerce_wp_text_input( array(
			'id'                => 'prefijo_boletos',
			'value'             => get_post_meta( get_the_ID(), 'prefijo_boletos', true ),
			'label'             => 'Prefijo de Boletos'
		));
	 
		woocommerce_wp_select( array(
			'id'          => 'boletos_ext',
			'value'       => get_post_meta( get_the_ID(), 'boletos_ext', true ),
			'wrapper_class' => 'show_if_downloadable',
			'label'       => 'File extension',
			'options'     => array( '' => 'Please select', 'zip' => 'Zip', 'gzip' => 'Gzip'),
		));
 
	echo '</div>';
 
}

/**
 * Save the custom fields.
 */
function save_boletos($post_id){

	if (!empty($_POST['boletos_tabs'])) {
		update_post_meta( $post_id, 'boletos_tabs', $_POST['boletos_tabs']);
	}

	if(!empty($_POST['prefijo_tabs'])){
		update_post_meta( $post_id, 'prefijo_tabs', $_POST['prefijo_tabs']);
	}
	
	if(!empty($_POST['boletos_total'])){
		update_post_meta( $post_id, 'boletos_total', $_POST['boletos_total']);
	}

	if(!empty($_POST['prefijo_boletos'])){
		update_post_meta( $post_id, 'prefijo_boletos', $_POST['prefijo_boletos']);
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
