<?php
/**
 * Product Data: Boletos del Evento.
 * Autor: Iván Venegas
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


function render_meta_on_cart_item( $title = null, $cart_item = null, $cart_item_key = null ) {
    if( $cart_item_key && is_cart() ) {
        echo $title . '<dl class="">
                 	<dt class="">Boletos : </dt>
					 <dd class=""> ';

					foreach ($cart_item['tinvwl_formdata']['boleto'] as $key => $value) {
						echo $value .' - ';
					}
					 	
		echo '</dd></dl>';
    }else {
        echo $title;
    }
}
add_filter( 'woocommerce_cart_item_name', 'render_meta_on_cart_item', 1, 3 );

function tshirt_order_meta_handler( $item_id, $values, $cart_item_key ) {
    wc_add_order_item_meta( $item_id, "boleto", WC()->session->get( $cart_item_key.'boleto') );    
}
add_action( 'woocommerce_add_order_item_meta', 'tshirt_order_meta_handler', 1, 3 );

/* Extra fields on product admin page */
include get_stylesheet_directory() . '/inc/winn-event-data.php';