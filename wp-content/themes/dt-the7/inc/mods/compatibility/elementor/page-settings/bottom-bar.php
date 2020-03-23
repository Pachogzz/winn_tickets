<?php
/**
 * @package The7
 */

namespace The7\Adapters\Elementor\Page_Settings;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

return [
	'args'     => [
		'label' => __( 'The7 bottom bar', 'the7mk2' ),
		'tab'   => Controls_Manager::TAB_SETTINGS,
	],
	'controls' => [
		'the7_document_show_bottom_bar_wa' => [
			'meta' => '_dt_elementor_bottom_bar_show',
			'args' => [
				'label'        => __( 'Display The7 bottom bar', 'the7mk2' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '1',
				'prefix_class' => 'elementor-',
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => '1',
				'separator'    => 'none',
			],
		],
	],
];
