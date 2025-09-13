<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_How_Works_Widget extends \Elementor\Widget_Base {

 
    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'how-works';
    }

    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'TP How Works', 'tp-elements' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-grid';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_categories() {
        return [ 'pielements_category' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'works', 'platform' ];
    }
	protected function register_controls() {

        $this->start_controls_section(
            'work_section',
            [
                'label' => esc_html__('Work Style', 'tpcore'),
            ]
        );
        $this->add_control(
            'work_style',
            [
                'label' => esc_html__('Select Style', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__('Style 1', 'tpcore'),
                    'style-2' => esc_html__('Style 2', 'tpcore'),
                ],
                'default' => 'style-1',
            ]
        );
        $this->end_controls_section();

        // Platform Info Repeater
        $this->start_controls_section(
            'tp_platform_area',
            [
                'label' => esc_html__('Platform List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        // $repeater->add_control(
        //     'tp_platform_area_number', [
        //         'label' => esc_html__('Number', 'tpcore'),
        //         'type' => \Elementor\Controls_Manager::TEXT,
        //         'default' => esc_html__('17', 'tpcore'),
        //     ]
        // );

        /* Number Replaces with icon, text and svg start */
        
        $repeater->add_control(
            'icon_type',
            [
                'label'     => esc_html__('Type of Icon', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'   => esc_html__('Default Icon', 'tp-elements'),
                    'svg'       => esc_html__('SVG Icon', 'tp-elements'),
                    'custom'       => esc_html__('Custom Text', 'tp-elements'),
                ]
            ]
        );

        $repeater->add_control(
            'default_icon',
            [
                'label'                     => esc_html__('Icon', 'tp-elements'),
                'type'                      => Controls_Manager::ICONS,
                'label_block'               => false,
                'default'                   => [
                    'value'     => 'fas fa-star',
                    'library'   => 'fa-solid'
                ],
                'skin'                      => 'inline',
                'exclude_inline_options'    => ['svg'],
                'condition'                 => [
                    'icon_type' => 'default'
                ]
            ]
        );

        $repeater->add_control(
            'svg_icon',
            [
                'label'         => esc_html__('SVG Icon', 'tp-elements'),
                'description'   => esc_html__('Enter svg code', 'tp-elements'),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'condition'     => [
                    'icon_type'     => 'svg'
                ]
            ]
        );

        $repeater->add_control(
            'custom_text',
            [
                'label'         => esc_html__('Custom Text', 'tp-elements'),
                'description'   => esc_html__('Write Custom Text', 'tp-elements'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'condition'     => [
                    'icon_type'     => 'custom'
                ]
            ]
        );

        /* Number Replaces with icon, text and svg end */

        $repeater->add_control(
            'tp_platform_area_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'tp_platform_area_des',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => 'use after content like syamble or other icon',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Blocks infected website tracking programs and annoying.', 'tpcore'),
                'label_block' => true,
            ]
        ); 

		$repeater->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Text', 'tp-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Discover More', 'tp-elements' ),
			]
		);

        $repeater->add_control(
			'btn_icon',
			[
				'label'       => esc_html__( 'Icon', 'tp-elements' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

        $repeater->add_control(
			'btn_link',
			[
				'label'   => esc_html__( 'Link', 'tp-elements' ),
				'type'    => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				],
			]
		);

        $repeater->add_control(
            'tp_platform_active_switch',
            [
              'label'        => esc_html__( 'Platform Active', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_platform_area_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_platform_area_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_platform_area_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_platform_area_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_platform_area_title }}}',
            ]
        );

        $this->end_controls_section();

        // $this->start_controls_section(
		// 	'style_tab_number',
		// 	[
		// 		'label' => esc_html__( 'Tab Number', 'tp-elements' ),
		// 		'tab'   => Controls_Manager::TAB_STYLE,
		// 	]
		// );
        
        // $this->add_responsive_control(
		// 	'tab_number_margin',
		// 	[
		// 		'label'      => esc_html__( 'Margin', 'tp-elements' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors'  => [
		// 			'{{WRAPPER}} .tp-rep-num '      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );
        
        // $this->add_responsive_control(
		// 	'tab_number_padding',
		// 	[
		// 		'label'      => esc_html__( 'Padding', 'tp-elements' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors'  => [
		// 			'{{WRAPPER}} .tp-rep-num '      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name'     => 'tab_number_typo',
		// 		'selector' => '{{WRAPPER}} .tp-rep-num',
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name'     => 'tab_number_bg',
		// 		'types'    => [ 'classic', 'gradient' ],
		// 		'exclude'  => [ 'image' ],
		// 		'selector' => '{{WRAPPER}} .tp-rep-num',
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Border::get_type(),
		// 	[
		// 		'name'     => 'tab_number_border',
		// 		'selector' => '{{WRAPPER}} .tp-rep-num',
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'tab_number_border_radius',
		// 	[
		// 		'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors'  => [
		// 			'{{WRAPPER}} .tp-rep-num'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

        // $this->end_controls_section();

        // ----------------------------------- //
        // ---------- Item Settings ---------- //
        // ----------------------------------- //

        $this->start_controls_section(
			'style_item',
			[
				'label' => esc_html__( 'Item Settings', 'tp-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'item_height',
            [
                'label'     => esc_html__('Item Height', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 350,
                        'max'       => 1080
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .col-custom' => 'min-height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'space_between_text_icon',
            [
                'label'     => esc_html__('Space Between Icon & Title', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 5,
                        'max'       => 280
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-panel-content' => 'gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        
        $this->start_controls_tabs('itemtab_settings_tabs');

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'item_tab_normal',
                [
                    'label' => esc_html__('Normal', 'tp-elements')
                ]
            );
        
                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'item_text_typography',
                        'label'     => esc_html__('Text Typography', 'tp-elements'),
                        'selector' => '{{WRAPPER}} .col-custom .tp-rep-title',
                    ]
                );

                $this->add_control(
                    'item_text_color',
                    [
                        'label'     => esc_html__('Text Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .col-custom .tp-rep-title' => 'color: {{VALUE}};'
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'      => 'item_shadow',
                        'label'     => esc_html__('Item Shadow', 'tp-elements'),
                        'selector'  => '{{WRAPPER}} .col-custom'
                    ]
                );        

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'item_background_normal_color',
                        'label'     => esc_html__( 'Item Background', 'tp-elements' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'selector'  => '{{WRAPPER}} .col-custom',
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'item_border',
                        'selector' => '{{WRAPPER}} .col-custom',
                    ]
                );
        
                $this->add_responsive_control(
                    'item_radius',
                    [
                        'label'         => esc_html__('Item Border Radius', 'tp-elements'),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => ['px', '%', 'em'],
                        'selectors'     => [
                            '{{WRAPPER}} .col-custom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ],
                    ]
                );

            $this->end_controls_tab();

            // ----------------------- //
            // ------ Hover Tab ------ //
            // ----------------------- //
            $this->start_controls_tab(
                'item_active',
                [
                    'label' => esc_html__('Active', 'tp-elements')
                ]
            );

                    
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'item_text_typography_active',
                    'label'     => esc_html__('Text Typography', 'tp-elements'),
                    'selector' => '{{WRAPPER}} .col-custom.active .tp-rep-title',
                ]
            );

            $this->add_control(
                'item_text_color_active',
                [
                    'label'     => esc_html__('Text Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .col-custom.active .tp-rep-title' => 'color: {{VALUE}};'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'item_shadow_active',
                    'label'     => esc_html__('Item Shadow', 'tp-elements'),
                    'selector'  => '{{WRAPPER}} .col-custom.active'
                ]
            );        

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'item_background_normal_color_active',
                    'label'     => esc_html__( 'Item Background', 'tp-elements' ),
                    'types'     => [ 'classic', 'gradient' ],
                    'selector'  => '{{WRAPPER}} .col-custom.active',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'item_border_active',
                    'selector' => '{{WRAPPER}} .col-custom.active',
                ]
            );
    
            $this->add_responsive_control(
                'item_radius_active',
                [
                    'label'         => esc_html__('Item Border Radius', 'tp-elements'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .col-custom.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                ]
            );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        
        // ----------------------------------- //
        // ---------- Icon Settings ---------- //
        // ----------------------------------- //
        $this->start_controls_section(
            'icon_settings',
            [
                'label' => esc_html__('Icon Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('icon_settings_tabs');

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'icon_normal',
                [
                    'label' => esc_html__('Normal', 'tp-elements')
                ]
            );
        
                $this->add_responsive_control(
                    'icon_margin',
                    [
                        'label'         => esc_html__('Icon Margin', 'tp-elements'),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => ['px', '%', 'em'],
                        'selectors'     => [
                            '{{WRAPPER}} .icon-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );
    
                $this->add_responsive_control(
                    'icon_container_size',
                    [
                        'label'     => esc_html__('Icon Container Size', 'tp-elements'),
                        'type'      => Controls_Manager::SLIDER,
                        'range'     => [
                            'px'        => [
                                'min'       => 10,
                                'max'       => 280
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-container' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );

                $this->add_responsive_control(
                    'icon_size',
                    [
                        'label'     => esc_html__('Icon Size', 'tp-elements'),
                        'type'      => Controls_Manager::SLIDER,
                        'range'     => [
                            'px'        => [
                                'min'       => 5,
                                'max'       => 280
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-container i' => 'font-size: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'custom_text_typography',
                        'label'     => esc_html__('Typography', 'tp-elements'),
                        'selector' => '{{WRAPPER}} .icon-container span',
                    ]
                );

                $this->add_responsive_control(
                    'icon_svg_size',
                    [
                        'label'     => esc_html__('SVG Size', 'tp-elements'),
                        'type'      => Controls_Manager::SLIDER,
                        'range'     => [
                            'px'        => [
                                'min'       => 5,
                                'max'       => 200
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-container .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'icon_svg_border',
                        'selector' => '{{WRAPPER}} .icon-container',
                    ]
                );
        
                $this->add_responsive_control(
                    'icon_radius',
                    [
                        'label'         => esc_html__('Icon Border Radius', 'tp-elements'),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => ['px', '%', 'em'],
                        'selectors'     => [
                            '{{WRAPPER}} .icon-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'      => 'icon_shadow',
                        'label'     => esc_html__('Icon Shadow', 'tp-elements'),
                        'selector'  => '{{WRAPPER}} .icon-container'
                    ]
                );        

                $this->add_control(
                    'icon_color',
                    [
                        'label'     => esc_html__('Icon Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container i' => 'color: {{VALUE}};'
                        ],
                    ]
                );

                $this->add_control(
                    'text_color',
                    [
                        'label'     => esc_html__('Text Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container span' => 'color: {{VALUE}};'
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'text_gradient_color',
                        'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                            ]
                        ],
                        'types'     => [ 'gradient' ],
                        'selector'  => '{{WRAPPER}} .icon-container span',
                    ]
                );

                $this->add_control(
                    'icon_svg_color',
                    [
                        'label'     => esc_html__('SVG Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container .icon svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .icon-container .icon svg path' => 'fill: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'background_svg_color',
                    [
                        'label'     => esc_html__('SVG Background Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container svg' => 'fill: {{VALUE}};'
                        ],
                    ]
                );

                $this->add_control(
                    'background_normal_color',
                    [
                        'label'     => esc_html__('Background Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container' => 'background: {{VALUE}};'
                        ],
                    ]
                );

            $this->end_controls_tab();

            // ----------------------- //
            // ------ Hover Tab ------ //
            // ----------------------- //
            $this->start_controls_tab(
                'icon_hover',
                [
                    'label' => esc_html__('Active', 'tp-elements')
                ]
            );
            $this->add_responsive_control(
                'active_icon_margin',
                [
                    'label'         => esc_html__('Icon Margin', 'tp-elements'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .active .icon-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );
                                
            $this->add_responsive_control(
                'active_icon_container_size',
                [
                    'label'     => esc_html__('Icon Container Size', 'tp-elements'),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px'        => [
                            'min'       => 10,
                            'max'       => 280
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'active_icon_size',
                [
                    'label'     => esc_html__('Icon Size', 'tp-elements'),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px'        => [
                            'min'       => 5,
                            'max'       => 280
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container i' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'active_custom_text_typography',
                    'label'     => esc_html__('Typography', 'tp-elements'),
                    'selector' => '{{WRAPPER}} .active .icon-container span',
                ]
            );

            $this->add_responsive_control(
                'active_icon_svg_size',
                [
                    'label'     => esc_html__('SVG Size', 'tp-elements'),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px'        => [
                            'min'       => 5,
                            'max'       => 200
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'active_icon_svg_border',
                    'selector' => '{{WRAPPER}} .active .icon-container',
                ]
            );
    
            $this->add_responsive_control(
                'active_icon_radius',
                [
                    'label'         => esc_html__('Icon Border Radius', 'tp-elements'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .active .icon-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'active_icon_shadow',
                    'label'     => esc_html__('Icon Shadow', 'tp-elements'),
                    'selector'  => '{{WRAPPER}} .active .icon-container'
                ]
            );        

            $this->add_control(
                'active_icon_color',
                [
                    'label'     => esc_html__('Icon Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container i' => 'color: {{VALUE}};'
                    ],
                ]
            );

            $this->add_control(
                'active_text_color',
                [
                    'label'     => esc_html__('Text Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container span' => 'color: {{VALUE}};'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'active_text_gradient_color',
                    'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                    'fields_options' => [
                        'background' => [
                            'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                        ]
                    ],
                    'types'     => [ 'gradient' ],
                    'selector'  => '{{WRAPPER}} .active .icon-container span',
                ]
            );

            $this->add_control(
                'active_icon_svg_color',
                [
                    'label'     => esc_html__('SVG Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container .icon svg' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .active .icon-container .icon svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'active_background_svg_color',
                [
                    'label'     => esc_html__('SVG Background Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container svg' => 'fill: {{VALUE}};'
                    ],
                ]
            );

            $this->add_control(
                'active_background_normal_color',
                [
                    'label'     => esc_html__('Background Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .active .icon-container' => 'background: {{VALUE}};'
                    ],
                ]
            );

            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'style_button',
			[
				'label' => esc_html__( 'Button', 'tp-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'tp_btn_fullwidth_enable',
            [
              'label'        => esc_html__( 'Enable Button Fullwidth ?', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
              'prefix_class'      => 'tp_btn_fullwidth_enable-',
            ]
        );

        $this->add_responsive_control(
			'btn_align',
			[
				'label'     => esc_html__( 'Alignment', 'tp-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .helo--btn-wrapper' => 'text-align: {{VALUE}};',
				],
				'prefix_class'      => 'button-pro-align-',
				'separator' => 'before',
                'condition' => [
                    'tp_btn_fullwidth_enable!' => 'yes'
                ],
			]
		);

        $this->add_responsive_control(
			'btn_margin',
			[
				'label'      => esc_html__( 'Margin', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn-wrapper '      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .wc-btn-play',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .wc-btn-play',
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-play'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

    }

    protected function render() {

    $settings = $this->get_settings_for_display();  

    if ( ! empty( $settings['btn_link']['url'] ) ) {
        $this->add_link_attributes( 'btn_link', $settings['btn_link'] );
    }

    ?>

    <style>
        <?php if( $settings['tp_btn_fullwidth_enable'] !== 'yes' ) : ?>
        .button-pro-align-center .wc-btn-group {
			margin: 0 auto;
		}
		.button-pro-align-start .wc-btn-group {
			margin-right: auto;
		}
		.button-pro-align-end .wc-btn-group {
			margin-left: auto;
		}
        <?php endif; ?>

        .tp_btn_fullwidth_enable-yes .wc-btn-group {
            width: 100%;
        }
        .tp_btn_fullwidth_enable-yes .wc-btn-group .wc-btn-primary {
            width: 100%;
            justify-content: center;
        }

    </style>
    <div class="row-custom-wrapper overflow-hidden ">
        <div class="row-custom">
            <?php foreach ($settings['tp_platform_area_list'] as $key => $item) : $key = $key+1; $active = $item['tp_platform_active_switch'] ? 'active' : NULL; 
                $icon_type       = $item['icon_type'];
                $default_icon    = $item['default_icon'];
                $svg_icon        = $item['svg_icon'];
            ?>
            <div class="col-custom <?php echo esc_attr($active); ?>">
                <div class="tp-panel-item">
                    <div class="tp-panel-content">
                        <?php if(!empty($item['tp_platform_area_title'])) : ?>
                        <h4 class="tp-panel-title tp-rep-title child-<?php echo esc_attr($key);?>"><?php echo wp_kses_post($item['tp_platform_area_title']); ?></h4>
                        <?php endif; ?>
                        <?php // if(!empty($item['tp_platform_area_number'])) : ?>
                        <!-- <span class="tp-rep-num"><?php // echo wp_kses_post($item['tp_platform_area_number']); ?></span> -->
                        <?php // endif; ?>

                        <!-- number to icon start -->
                        <span class="icon-container">
                            <?php
                            if ($icon_type == 'default') {
                                echo '<i class="' . esc_attr($default_icon['value']) . '"></i>';
                            }
                            if ($icon_type == 'svg') {
                                echo '<span class="icon">' . tp_elements_output_code($svg_icon) . '</span>';
                            }
                            if ($icon_type == 'custom') {
                                echo '<span>' . $item['custom_text'] . '</span>';
                            }
                            ?>
                         </span>
                        <!-- number to icon end -->

                    </div>
                </div>
                <div class="tp-panel-item-2">
                    <div class="tp-panel-content-2">
                        <?php // if(!empty($item['tp_platform_area_number'])) : ?>
                        <!-- <span class="tp-rep-num"><?php // echo wp_kses_post($item['tp_platform_area_number']); ?></span> -->
                        <?php // endif; ?>

                        <!-- number to icon start -->
                         <span class="icon-container">
                            <?php
                            if ($icon_type == 'default') {
                                echo '<i class="' . esc_attr($default_icon['value']) . '"></i>';
                            }
                            if ($icon_type == 'svg') {
                                echo '<span class="icon">' . tp_elements_output_code($svg_icon) . '</span>';
                            }
                            if ($icon_type == 'custom') {
                                echo '<span>' . $item['custom_text'] . '</span>';
                            }
                            ?>
                         </span>
                        <!-- number to icon end -->

                        <div class="tp-panel-content-2-inner-text">
                            <?php if(!empty($item['tp_platform_area_title'])) : ?>
                            <h4 class="tp-panel-title-2 tp-rep-title"><?php echo wp_kses_post($item['tp_platform_area_title']); ?></h4>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_platform_area_des'])) : ?>
                            <p class="tp-rep-des"><?php echo wp_kses_post($item['tp_platform_area_des']); ?></p>
                            <?php endif; ?>
                            
                            <div class="helo--btn-wrapper ">

                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-group">
                                    <span class="wc-btn-primary">
                                        <?php echo esc_html( $item['btn_text'] ); ?>
                                    </span>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script type="text/javascript"> 
        jQuery(document).ready(function(){
                
            function mediaSize() { 
			/* Set the matchMedia */
			// if (window.matchMedia('(min-width: 768px)').matches) {
				const panels = document.querySelectorAll('.col-custom')
				panels.forEach(panel => {
					panel.addEventListener('mouseenter', () => {
						removeActiveClasses()
						panel.classList.add('active')
					})
				})
			
				function removeActiveClasses() {
					panels.forEach(panel => {
						panel.classList.remove('active')
					})
				}
		    };
		    /* Call the function */
		    mediaSize();
		    window.addEventListener('resize', mediaSize, false); 
        });
    </script>

    <?php 
    }
}
