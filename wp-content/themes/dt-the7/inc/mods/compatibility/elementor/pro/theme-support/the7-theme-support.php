<?php
namespace  The7\Adapters\Elementor\Pro\ThemeSupport;

use ElementorPro\Modules\ThemeBuilder\Module;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class The7_Theme_Support {

	/**
	 * @param Locations_Manager $manager
	 */
	public function register_locations( $manager ) {
		$manager->register_core_location( 'header' );
		$manager->register_core_location( 'footer' );

		$theme_builder_module = Module::instance();
		$conditions_manager = $theme_builder_module->get_conditions_manager();

		$headers = $conditions_manager->get_documents_for_location( 'header' );
		$footers = $conditions_manager->get_documents_for_location( 'footer' );
		if ( ! empty( $headers )) {
			add_filter( 'presscore_show_header', [ $this, 'do_header' ], 0 );
		}
		if ( ! empty( $footers )) {
			add_filter( 'presscore_replace_footer', '__return_true' );
			add_action( 'presscore_before_footer_widgets', [ $this, 'do_footer' ], 0 );  //presscore_config_base_init
			add_action( 'presscore_config_base_init',  [ $this, 'overwrite_config_base_init' ]);
		}
	}

	public function overwrite_config_base_init() {
		$documents = Module::instance()->get_conditions_manager()->get_documents_for_location( 'footer' );
		foreach ( $documents as $document ) {
			$footer_enabled = true;
			$post_id        = $document->get_post()->ID;
			if ( metadata_exists( 'post', $post_id, '_dt_elementor_bottom_bar_show' ) ) {
				$footer_enabled = get_post_meta( $post_id, "_dt_elementor_bottom_bar_show", true );
			}

			presscore_config()->set( 'template.bottom_bar.enabled', $footer_enabled );
			break;
		}
	}

	public function do_header() {
		elementor_theme_do_location( 'header' );
		return false;
	}

	public function do_footer() {
		elementor_theme_do_location( 'footer' );
	}

	public function __construct() {
		add_action( 'elementor/theme/register_locations', [ $this, 'register_locations' ] );
	}
}
