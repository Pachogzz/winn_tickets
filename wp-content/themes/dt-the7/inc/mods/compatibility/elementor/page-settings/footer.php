<?php
/**
 * @package The7
 */

namespace The7\Adapters\Elementor\Page_Settings;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

return [
	'args'     => [
		'label' => __( 'Footer settings', 'the7mk2' ),
		'tab'   => Controls_Manager::TAB_SETTINGS,
	],
	'controls' => [
		'the7_document_show_footer_wa' => [
			'meta' => '_dt_footer_show',
			'args' => [
				'label'        => __( 'Hide Widgetized footer', 'the7mk2' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '1',
				'prefix_class' => 'elementor-',
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => '0',
				'separator'    => 'none',
			],
		],
		'the7_document_footer_wa_id'   => [
			'meta' => '_dt_footer_widgetarea_id',
			'args' => [
				'label'     => __( 'Footer widget area', 'the7mk2' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'sidebar_2',
				'options'   => 'presscore_get_widgetareas_options',
				'separator' => 'none',
				'condition' => [
					'the7_document_show_footer_wa' => [ '1', '' ],
				],
			],
		],
	],
];
