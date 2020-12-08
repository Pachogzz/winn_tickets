<?php

/**
 * Move outside tab the description of single product
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
function woocommerce_template_product_description() {
  wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_product_thumbnails_columns', 'woocommerce_template_product_description', 60 );
// add_action( 'woocommerce_product_meta_end', 'woocommerce_template_product_description', 20 );

/**
 * Event Data: Datos extra del Evento.
 * Autor: Pacho Gonzalez
 */

add_filter('woocommerce_product_data_tabs', 'datosevento_settings_tabs' );
function datosevento_settings_tabs( $tabs ){
 
	$tabs['eventodata'] = array(
		'label'    => 'Datos del evento',
		'target'   => 'eventodata_product_data',
		'priority' => 20,
	);
	return $tabs;
 
}
	/*
	 * Tab content
	*/
	add_action( 'woocommerce_product_data_panels', 'eventodata_panels' );
	function eventodata_panels(){

		$day_evento 		= get_post_meta( get_the_ID(), '_day-evento', true );
		$num_evento 		= get_post_meta( get_the_ID(), '_num-evento', true );
		$month_evento 		= get_post_meta( get_the_ID(), '_month-evento', true );
		$hour_evento 		= get_post_meta( get_the_ID(), '_hour-evento', true );
		$year_evento 		= get_post_meta( get_the_ID(), '_year-evento', true );
		$live_evento 		= get_post_meta( get_the_ID(), '_live-evento', true );
		$rand_evento 		= get_post_meta( get_the_ID(), '_rand-evento', true );
	 
		echo '<div id="eventodata_product_data" class="panel woocommerce_options_panel">';
	 
			echo '<div class="options_group">
					<p class="form-field dimensions_field">
						<span class="wrap">';

					woocommerce_wp_select( array(
						'id'		=> '_day-evento',
						'label'		=> 'Día del evento:',
						'options'	=> array(
									'Lunes'		=> __('Lunes', 'woocommerce'),
									'Martes'	=> __('Martes', 'woocommerce'),
									'Miércoles'	=> __('Miércoles', 'woocommerce'),
									'Jueves'	=> __('Jueves', 'woocommerce'),
									'Viernes'	=> __('Viernes', 'woocommerce'),
									'Sabado'	=> __('Sabado', 'woocommerce'),
									'Domingo'	=> __('Domingo', 'woocommerce'),
							)
						)
					);

					woocommerce_wp_select( array(
						'id'		=> '_num-evento',
						'label'		=> 'Día del evento (#):',
						'options'	=> array(
									'1'		=> __('1', 'woocommerce'),
									'2'		=> __('2', 'woocommerce'),
									'3'		=> __('3', 'woocommerce'),
									'4'		=> __('4', 'woocommerce'),
									'5'		=> __('5', 'woocommerce'),
									'6'		=> __('6', 'woocommerce'),
									'7'		=> __('7', 'woocommerce'),
									'8'		=> __('8', 'woocommerce'),
									'9'		=> __('9', 'woocommerce'),
									'10'	=> __('10', 'woocommerce'),
									'11'	=> __('11', 'woocommerce'),
									'12'	=> __('12', 'woocommerce'),
									'13'	=> __('13', 'woocommerce'),
									'14'	=> __('14', 'woocommerce'),
									'15'	=> __('15', 'woocommerce'),
									'16'	=> __('16', 'woocommerce'),
									'17'	=> __('17', 'woocommerce'),
									'18'	=> __('18', 'woocommerce'),
									'19'	=> __('19', 'woocommerce'),
									'20'	=> __('20', 'woocommerce'),
									'21'	=> __('21', 'woocommerce'),
									'22'	=> __('22', 'woocommerce'),
									'23'	=> __('23', 'woocommerce'),
									'24'	=> __('24', 'woocommerce'),
									'25'	=> __('25', 'woocommerce'),
									'26'	=> __('26', 'woocommerce'),
									'27'	=> __('27', 'woocommerce'),
									'28'	=> __('28', 'woocommerce'),
									'29'	=> __('29', 'woocommerce'),
									'30'	=> __('30', 'woocommerce'),
									'31'	=> __('31', 'woocommerce')
							)
						)
					);

					woocommerce_wp_select( array(
						'id'		=> '_month-evento',
						'label'		=> 'Mes del evento:',
						'options'	=> array(
									'Enero'			=> __('Enero', 'woocommerce'),
									'Febrero'		=> __('Febrero', 'woocommerce'),
									'Marzo'			=> __('Marzo', 'woocommerce'),
									'Abril'			=> __('Abril', 'woocommerce'),
									'Mayo'			=> __('Mayo', 'woocommerce'),
									'Junio'			=> __('Junio', 'woocommerce'),
									'Julio'			=> __('Julio', 'woocommerce'),
									'Agosto'		=> __('Agosto', 'woocommerce'),
									'Septiembre'	=> __('Septiembre', 'woocommerce'),
									'Octubre'		=> __('Octubre', 'woocommerce'),
									'Noviembre'	=> __('Noviembre', 'woocommerce'),
									'Diciembre'	=> __('Diciembre', 'woocommerce'),
							)
						)
					);
					
					woocommerce_wp_select( array( 
						'id'		=> '_hour-evento', 
						'label'		=> __( 'Seleccione la hora', 'woocommerce' ), 
						'options'	=> array(
									'00:00 am'	=> __( '00:00 am', 'woocommerce' ),
									'00:15 am'	=> __( '00:15 am', 'woocommerce' ),
									'00:30 am'	=> __( '00:30 am', 'woocommerce' ),
									'00:45 am'	=> __( '00:45 am', 'woocommerce' ),
									'01:00 am'	=> __( '01:00 am', 'woocommerce' ),
									'01:15 am'	=> __( '01:15 am', 'woocommerce' ),
									'01:30 am'	=> __( '01:30 am', 'woocommerce' ),
									'01:45 am'	=> __( '01:45 am', 'woocommerce' ),
									'02:00 am'	=> __( '02:00 am', 'woocommerce' ),
									'02:15 am'	=> __( '02:15 am', 'woocommerce' ),
									'02:30 am'	=> __( '02:30 am', 'woocommerce' ),
									'02:45 am'	=> __( '02:45 am', 'woocommerce' ),
									'03:00 am'	=> __( '03:00 am', 'woocommerce' ),
									'03:15 am'	=> __( '03:15 am', 'woocommerce' ),
									'03:30 am'	=> __( '03:30 am', 'woocommerce' ),
									'03:45 am'	=> __( '03:45 am', 'woocommerce' ),
									'04:00 am'	=> __( '04:00 am', 'woocommerce' ),
									'04:15 am'	=> __( '04:15 am', 'woocommerce' ),
									'04:30 am'	=> __( '04:30 am', 'woocommerce' ),
									'04:45 am'	=> __( '04:45 am', 'woocommerce' ),
									'05:00 am'	=> __( '05:00 am', 'woocommerce' ),
									'05:15 am'	=> __( '05:15 am', 'woocommerce' ),
									'05:30 am'	=> __( '05:30 am', 'woocommerce' ),
									'05:45 am'	=> __( '05:45 am', 'woocommerce' ),
									'06:00 am'	=> __( '06:00 am', 'woocommerce' ),
									'06:15 am'	=> __( '06:15 am', 'woocommerce' ),
									'06:30 am'	=> __( '06:30 am', 'woocommerce' ),
									'06:45 am'	=> __( '06:45 am', 'woocommerce' ),
									'07:00 am'	=> __( '07:00 am', 'woocommerce' ),
									'07:15 am'	=> __( '07:15 am', 'woocommerce' ),
									'07:30 am'	=> __( '07:30 am', 'woocommerce' ),
									'07:45 am'	=> __( '07:45 am', 'woocommerce' ),
									'08:00 am'	=> __( '08:00 am', 'woocommerce' ),
									'08:15 am'	=> __( '08:15 am', 'woocommerce' ),
									'08:30 am'	=> __( '08:30 am', 'woocommerce' ),
									'08:45 am'	=> __( '08:45 am', 'woocommerce' ),
									'09:00 am'	=> __( '09:00 am', 'woocommerce' ),
									'09:15 am'	=> __( '09:15 am', 'woocommerce' ),
									'09:30 am'	=> __( '09:30 am', 'woocommerce' ),
									'09:45 am'	=> __( '09:45 am', 'woocommerce' ),
									'10:00 am'	=> __( '10:00 am', 'woocommerce' ),
									'10:15 am'	=> __( '10:15 am', 'woocommerce' ),
									'10:30 am'	=> __( '10:30 am', 'woocommerce' ),
									'10:45 am'	=> __( '10:45 am', 'woocommerce' ),
									'11:00 am'	=> __( '11:00 am', 'woocommerce' ),
									'11:15 am'	=> __( '11:15 am', 'woocommerce' ),
									'11:30 am'	=> __( '11:30 am', 'woocommerce' ),
									'11:45 am'	=> __( '11:45 am', 'woocommerce' ),
									'12:00 pm'	=> __( '12:00 pm', 'woocommerce' ),
									'12:15 pm'	=> __( '12:15 pm', 'woocommerce' ),
									'12:30 pm'	=> __( '12:30 pm', 'woocommerce' ),
									'12:45 pm'	=> __( '12:45 pm', 'woocommerce' ),
									'01:00 pm'	=> __( '01:00 pm', 'woocommerce' ),
									'01:15 pm'	=> __( '01:15 pm', 'woocommerce' ),
									'01:30 pm'	=> __( '01:30 pm', 'woocommerce' ),
									'01:45 pm'	=> __( '01:45 pm', 'woocommerce' ),
									'02:00 pm'	=> __( '02:00 pm', 'woocommerce' ),
									'02:15 pm'	=> __( '02:15 pm', 'woocommerce' ),
									'02:30 pm'	=> __( '02:30 pm', 'woocommerce' ),
									'02:45 pm'	=> __( '02:45 pm', 'woocommerce' ),
									'03:00 pm'	=> __( '03:00 pm', 'woocommerce' ),
									'03:15 pm'	=> __( '03:15 pm', 'woocommerce' ),
									'03:30 pm'	=> __( '03:30 pm', 'woocommerce' ),
									'03:45 pm'	=> __( '03:45 pm', 'woocommerce' ),
									'04:00 pm'	=> __( '04:00 pm', 'woocommerce' ),
									'04:15 pm'	=> __( '04:15 pm', 'woocommerce' ),
									'04:30 pm'	=> __( '04:30 pm', 'woocommerce' ),
									'04:45 pm'	=> __( '04:45 pm', 'woocommerce' ),
									'05:00 pm'	=> __( '05:00 pm', 'woocommerce' ),
									'05:15 pm'	=> __( '05:15 pm', 'woocommerce' ),
									'05:30 pm'	=> __( '05:30 pm', 'woocommerce' ),
									'05:45 pm'	=> __( '05:45 pm', 'woocommerce' ),
									'06:00 pm'	=> __( '06:00 pm', 'woocommerce' ),
									'06:15 pm'	=> __( '06:15 pm', 'woocommerce' ),
									'06:30 pm'	=> __( '06:30 pm', 'woocommerce' ),
									'06:45 pm'	=> __( '06:45 pm', 'woocommerce' ),
									'07:00 pm'	=> __( '07:00 pm', 'woocommerce' ),
									'07:15 pm'	=> __( '07:15 pm', 'woocommerce' ),
									'07:30 pm'	=> __( '07:30 pm', 'woocommerce' ),
									'07:45 pm'	=> __( '07:45 pm', 'woocommerce' ),
									'08:00 pm'	=> __( '08:00 pm', 'woocommerce' ),
									'08:15 pm'	=> __( '08:15 pm', 'woocommerce' ),
									'08:30 pm'	=> __( '08:30 pm', 'woocommerce' ),
									'08:45 pm'	=> __( '08:45 pm', 'woocommerce' ),
									'09:00 pm'	=> __( '09:00 pm', 'woocommerce' ),
									'09:15 pm'	=> __( '09:15 pm', 'woocommerce' ),
									'09:30 pm'	=> __( '09:30 pm', 'woocommerce' ),
									'09:45 pm'	=> __( '09:45 pm', 'woocommerce' ),
									'10:00 pm'	=> __( '10:00 pm', 'woocommerce' ),
									'10:15 pm'	=> __( '10:15 pm', 'woocommerce' ),
									'10:30 pm'	=> __( '10:30 pm', 'woocommerce' ),
									'10:45 pm'	=> __( '10:45 pm', 'woocommerce' ),
									'11:00 pm'	=> __( '11:00 pm', 'woocommerce' ),
									'11:15 pm'	=> __( '11:15 pm', 'woocommerce' ),
									'11:30 pm'	=> __( '11:30 pm', 'woocommerce' ),
									'11:45 pm'	=> __( '11:45 pm', 'woocommerce' )
							)
						)
					);

					woocommerce_wp_select( array(
						'id'		=> '_year-evento',
						'label'		=> 'Año del evento:',
						'options'	=> array(
									'2020'	=> __('2020', 'woocommerce'),
									'2021'	=> __('2021', 'woocommerce'),
									'2022'	=> __('2022', 'woocommerce'),
									'2023'	=> __('2023', 'woocommerce'),
									'2024'	=> __('2024', 'woocommerce'),
									'2025'	=> __('2025', 'woocommerce'),
									'2026'	=> __('2026', 'woocommerce'),
									'2027'	=> __('2027', 'woocommerce'),
									'2028'	=> __('2028', 'woocommerce'),
									'2029'	=> __('2029', 'woocommerce'),
									'2030'	=> __('2030', 'woocommerce'),
									'2031'	=> __('2031', 'woocommerce'),
									'2032'	=> __('2032', 'woocommerce'),
									'2033'	=> __('2033', 'woocommerce'),
									'2034'	=> __('2034', 'woocommerce'),
									'2035'	=> __('2035', 'woocommerce'),
									'2036'	=> __('2036', 'woocommerce'),
									'2037'	=> __('2037', 'woocommerce'),
									'2038'	=> __('2038', 'woocommerce'),
									'2039'	=> __('2039', 'woocommerce'),
									'2040'	=> __('2040', 'woocommerce'),
									'2041'	=> __('2041', 'woocommerce'),
									'2042'	=> __('2042', 'woocommerce'),
									'2043'	=> __('2043', 'woocommerce'),
									'2044'	=> __('2044', 'woocommerce'),
									'2045'	=> __('2045', 'woocommerce'),
									'2046'	=> __('2046', 'woocommerce'),
									'2047'	=> __('2047', 'woocommerce'),
									'2048'	=> __('2048', 'woocommerce'),
									'2049'	=> __('2049', 'woocommerce'),
									'2050'	=> __('2050', 'woocommerce')
							)
						)
					);

					woocommerce_wp_textarea_input( array(
						'id'                => '_rand-evento',
						'value'             => $rand_evento ,
						'label'             => 'Ubicación del evento:'
					));

					woocommerce_wp_text_input( array(
						'id'                => '_live-evento',
						'value'             => $live_evento ,
						'label'             => 'Liga del livestream:'
					));
			echo '</span>
				</p>
			</div>';
	 
		echo '</div>';
	 
	}
	/**
	 * Save the custom fields.
	 */
	function save_eventodata( $post_id ){

		$product = wc_get_product( $post_id );

		$day_evento = $_POST['_day-evento'];
		if(!empty( $day_evento )){
			update_post_meta( $post_id, '_day-evento', esc_attr( $day_evento ));
		}
		$num_evento = $_POST['_num-evento'];
		if(!empty( $num_evento )){
			update_post_meta( $post_id, '_num-evento', esc_attr( $num_evento ));
		}
		$month_evento = $_POST['_month-evento'];
		if(!empty( $month_evento )){
			update_post_meta( $post_id, '_month-evento', esc_attr( $month_evento ));
		}
		$hour_evento = $_POST['_hour-evento'];
		if(!empty( $hour_evento )){
			update_post_meta( $post_id, '_hour-evento', esc_attr( $hour_evento ));
		}
		$year_evento = $_POST['_year-evento'];
		if(!empty( $year_evento )){
			update_post_meta( $post_id, '_year-evento', esc_attr( $year_evento ));
		}
		$live_evento = $_POST['_live-evento'];
		if (!empty( $live_evento )){
			update_post_meta( $post_id, '_live-evento', esc_attr( $live_evento ));
		}
		if ($live_evento == ""){
			update_post_meta( $post_id, '_live-evento', esc_attr( $live_evento ));
		}
		$rand_evento = $_POST['_rand-evento'];
		if (!empty( $rand_evento )){
			update_post_meta( $post_id, '_rand-evento', esc_html( $rand_evento ));
		}
		if ($rand_evento == ""){
			update_post_meta( $post_id, '_rand-evento', esc_html( $rand_evento ));
		}

	}
	add_action( 'woocommerce_process_product_meta', 'save_eventodata'  );
	// add_action( 'woocommerce_process_product_meta_simple', 'save_eventodata'  );
	// add_action( 'woocommerce_process_product_meta_variable', 'save_eventodata'  );

	/**
	 * Show info on product page
	 */
	function data_eventos() {

		$_url 			= get_stylesheet_directory_uri();
		$_day_evt 		= get_post_meta( get_the_ID(), '_day-evento', true );
		$_num_evt 		= get_post_meta( get_the_ID(), '_num-evento', true );
		$_month_evt 	= get_post_meta( get_the_ID(), '_month-evento', true );
		$_hour_evt 		= get_post_meta( get_the_ID(), '_hour-evento', true );
		$_year_evt 		= get_post_meta( get_the_ID(), '_year-evento', true );
		$_rand_evt 		= get_post_meta( get_the_ID(), '_rand-evento', true );
		$_live_evt 		= get_post_meta( get_the_ID(), '_live-evento', true );

		echo 	"<div id='event_data_details' class='event_data-details first_part'>
					<div class='event_data-columns'>
						<div class='event_data-col event_data-icon'>
							<!--i class='fa fa-calendar fa-2x' aria-hidden='true'></i-->
							<img src='" . $_url . "/assets/img/icons/ticket-icon-date.png' alt=''>
						</div>
						<div class='event_data-col event_data-text'>
							<h5 class='event_data-title'>" . __('Fecha del evento') . "</h5>
							<span>" . $_day_evt. " " . $_num_evt . " " . __(' de ') . " " . $_month_evt . " " . __('del') . " " . $_year_evt . ", " . $_hour_evt . ".</span>
						</div>
					</div>
					<div class='event_data-columns'>
						<div class='event_data-col event_data-icon'>
							<!--i class='fa fa-map-marker fa-2x' aria-hidden='true'></i-->
							<img src='" . $_url . "/assets/img/icons/ticket-icon-location.png' alt=''>
						</div>
						<div class='event_data-col event_data-text'>
							<h5 class='event_data-title'>" . __('Ubicación') . "</h5>
							<span>" . $_rand_evt . "</span>					
						</div>
					</div>"
		;
		if (!empty( $_live_evt )) {
			echo 	"<div class='event_data-columns'>
						<div class='event_data-col event_data-icon'>
							<!--i class='fa fa-video-camera fa-2x' aria-hidden='true'></i-->
							<img src='" . $_url . "/assets/img/icons/ticket-icon-live.png' alt=''>
						</div>
						<div class='event_data-col event_data-text'>
							<h5 class='event_data-title'>" . __('Liga al livestream') . "</h5>
							<span><a href='" . $_live_evt . "' class='btn' target='_blank'>Ir al stream</a></span>					
						</div>
					</div>";
		}
		echo "</div>";
	}
	// add_action( 'woocommerce_product_options_general_product_data', 'data_eventos' );
	add_action( 'woocommerce_single_product_summary', 'data_eventos' );
	// add_action( 'woocommerce_process_product_meta', 'data_eventos' );

/**
 * Change HTML layout of price tags
 */
add_filter( 'woocommerce_get_price_html', 'event_add_title_price', 99, 2 ); 
function event_add_title_price( $price, $product ){

	// global $product;
	// $cantidadBoletos = get_post_meta( get_the_ID(), 'cantidad_boletos', true );

	// foreach ($cantidadBoletos as $key => $value) {
	// 	$total += $value;
	// }


	$query = new WC_Order_Query( array(
		'status' => 'completed',
		'return' => 'ids',
	));

	$orders = $query->get_orders();

	$data = array();
	$n = 0;

	foreach ($orders as $id) {
		$order = wc_get_order($id);

		foreach ($order->get_items() as $item_key => $item ){

			if($item->get_product_id() == get_the_ID()){
				$boletosComprados = get_post_meta($id, 'boletos_comprados', true);

				foreach ($boletosComprados as $bc => $value) {
					$data[$n] = $value;
					$n++;
				}
			}
			
		}
	}

	$total = count($data);

	$cantidad = $total + $product->stock_quantity;
	$comprados = $cantidad - $product->stock_quantity;

	if($total != $product->stock_quantity){
		$porcentaje = ((float)$comprados * 100) / $cantidad; // Regla de tres
    	$porcentaje = round($porcentaje, 0);  // Quitar los decimales

	}else{
		$porcentaje = 0;
	}

	$_url = get_stylesheet_directory_uri();

	echo "<div id='event_data_details' class='event_data-details second_part'>
			<div class='event_data-columns admin-none'>
				<div class='event_data-col event_data-icon'>
					<!--i class='fa fa-tachometer fa-2x' aria-hidden='true'></i-->
					<img src='" . $_url . "/assets/img/icons/ticket-icon-progress.png' alt=''>
				</div>
				<div class='event_data-col event_data-text'>
					<h5 class='event_data-title'>" . __('Estatus de ocupación: ') . $porcentaje . "%</h5>
					<progress id='progress2' max='". $cantidad . "' value='". $comprados ."' style='margin:10px 0 0;' ></progress>
				</div>
			</div>";
    
    $price = '
			<div class="event_data-columns">
				<div class="event_data-col event_data-icon">
					<!--i class="fa fa-dollar fa-2x" aria-hidden="true"></i-->
					<img src="' . $_url . '/assets/img/icons/ticket-icon-price.png" alt="">
				</div>
				<div class="event_data-col event_data-text">
					<h5 class="event_data-title">' . __('Costo por ticket') . '</h5>
					<span>
    ' . $price;
    return $price;
}

add_filter( 'woocommerce_get_price_suffix', 'event_add_price_suffix', 99, 4 );
function event_add_price_suffix( $html, $product, $price, $qty ){
    $html .= '
					</span>
				</div>
			</div>
		</div>
   	';
    return $html;
}

/**
 * Add data "DATE" to prduct grid
 */
function event_add_data_date_product_grid (){
	$_num_evt 		= get_post_meta( get_the_ID(), '_num-evento', true );
	$_month_evt 	= get_post_meta( get_the_ID(), '_month-evento', true );
	$_year_evt 		= get_post_meta( get_the_ID(), '_year-evento', true );
	
	echo "<div class='product_grid_data'>
		<span><i class='fa fa-calendar' aria-hidden='true'></i> " . $_month_evt . " " . $_num_evt . ", " . $_year_evt . "</span>
	</div>";
}
add_action('woocommerce_after_shop_loop_item','event_add_data_date_product_grid');