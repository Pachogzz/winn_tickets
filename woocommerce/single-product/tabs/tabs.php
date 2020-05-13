<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

 global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

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
				<li class="<?php echo esc_attr( $num ); ?>_tab" id="tab-title-<?php echo esc_attr( $num ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $num ); ?>">
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
							<a href="#">
								<?php echo $prefijoBoletos[$num] . "-" . $n; ?>
							</a>
						</li>
					<?php endfor; ?>
				</ul>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>

	</div>

<?php

if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
