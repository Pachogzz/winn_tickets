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
			'id'                => 'boletos_plugin_version',
			'value'             => get_post_meta( get_the_ID(), 'boletos_plugin_version', true ),
			'label'             => 'Plugin version',
			'description'       => 'Description when desc_tip param is not true'
		));
	 
		woocommerce_wp_textarea_input( array(
			'id'          => 'boletos_changelog',
			'value'       => get_post_meta( get_the_ID(), 'boletos_changelog', true ),
			'label'       => 'Changelog',
			'desc_tip'    => true,
			'description' => 'Prove the plugin changelog here',
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
 * Save
 */
add_action( 'woocommerce_process_product_meta', 'boletos_save_fields', 10, 2 );
function boletos_save_fields($id, $post){
 
 	if (!empty($_POST['boletos_tab'])) {
 		add_post_meta( $id, 'boletos_tab', $_POST['boletos_tab'] );
 	}
 
}


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