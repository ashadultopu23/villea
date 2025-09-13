<?php
/**
 * ElementorIconbox Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\REPEATER;
use Elementor\Utils;
use Elementor\Group_Control_Background;

class Themephi_Icon_Widget extends \Elementor\Widget_Base {
	
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
		return 'tp-icon';
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
		return esc_html__( 'TP Icon', 'tp-elements' );
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
		return 'glyph-icon flaticon-shipping-and-delivery-1';
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Icon Settings', 'tp-elements')
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_responsive_control(
            'icon_align',
            [
                'label'             => esc_html__('Alignment', 'tp-elements'),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'left'              => [
                        'title'             => esc_html__('Left', 'tp-elements'),
                        'icon'              => 'eicon-text-align-left',
                    ],
                    'center'            => [
                        'title'             => esc_html__('Center', 'tp-elements'),
                        'icon'              => 'eicon-text-align-center',
                    ],
                    'right'             => [
                        'title'             => esc_html__('Right', 'tp-elements'),
                        'icon'              => 'eicon-text-align-right',
                    ],
                    'space-between'     => [
                        'title'             => esc_html__('Space Between', 'tp-elements'),
                        'icon'              => 'eicon-justify-space-between-h',
                    ],
                ],
                'toggle'            => true,
                'default'           => 'center',
                'selectors' => [
					'{{WRAPPER}} .icon-item' => 'text-align: {{VALUE}};',
				],
            ]
        );
  
        $this->add_control(
            'background_type',
            [
                'label'     => esc_html__('Type of Background', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'              => esc_html__('None', 'tp-elements'),
                    'svg'               => esc_html__('SVG', 'tp-elements'),
                    'image'             => esc_html__('Image', 'tp-elements'),
                    'color'             => esc_html__('Color', 'tp-elements')
                ]
            ]
        );

        $this->add_control(
            'svg_background',
            [
                'label'         => esc_html__('SVG Background', 'tp-elements'),
                'description'   => esc_html__('Enter svg code', 'tp-elements'),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => '',
                'condition'     => [
                    'background_type' => 'svg'
                ]
            ]
        );

        $this->start_controls_tabs('background_settings_tabs');

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'background_normal',
                [
                    'label'     => esc_html__('Normal', 'tp-elements'),
                    'condition' => [
                        'background_type' => ['image', 'color']
                    ]
                ]
            );

                $this->add_control(
                    'bg_image',
                    [
                        'label'     => esc_html__('Choose Background Image', 'tp-elements'),
                        'type'      => Controls_Manager::MEDIA,
                        'default'   => [],
                        'condition' => [
                            'background_type' => 'image'
                        ]
                    ]
                );

				$this->add_control(
                    'bg_color',
                    [
                        'label'     => esc_html__('Background Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'background_type' => 'color',
                        ]
                    ]
                );

            $this->end_controls_tab();

            // ----------------------- //
            // ------ Hover Tab ------ //
            // ----------------------- //
            $this->start_controls_tab(
                'background_hover',
                [
                    'label'     => esc_html__('Hover', 'tp-elements'),
                    'condition' => [
                        'background_type' => ['image', 'color'],
                    ]
                ]
            );

                $this->add_control(
                    'bg_image_hover',
                    [
                        'label'     => esc_html__('Choose Background Image', 'tp-elements'),
                        'type'      => Controls_Manager::MEDIA,
                        'default'   => [],
                        'condition' => [
                            'background_type' => 'image'
                        ]
                    ]
                );

				$this->add_control(
                    'bg_hover_color',
                    [
                        'label'     => esc_html__('Background Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container:hover' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'background_type' => 'color',
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_control(
			'btn_link_open',
			[
				'label'   => esc_html__( 'Open New Window', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'tp-elements'),
					'yes' => esc_html__( 'Yes', 'tp-elements'),
				],
			]
		);

        $this->add_control(
            'add_link',
            [
                'label'         => esc_html__('Add Link', 'tp-elements'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'return_value'  => 'yes',
                'label_off'     => esc_html__('No', 'tp-elements'),
                'label_on'      => esc_html__('Yes', 'tp-elements'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'         => esc_html__('Image Box Link', 'tp-elements'),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'default'       => [
                    'url'           => '',
                    'is_external'   => 'true',
                ],
                'placeholder'   => esc_html__( 'http://your-link.com', 'tp-elements' ),
                'condition' => [
                    'add_link' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

		// Style Control 

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
                    '{{WRAPPER}} .icon-container' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_background_size',
            [
                'label'     => esc_html__('Icon Background Size', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 10,
                        'max'       => 280
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-container .background' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'background_type' => 'svg'
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
                'condition' => [
                    'icon_type' => 'default'
                ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'custom_text_typography',
				'selector' => '{{WRAPPER}} .icon-container span',
                'condition' => [
                    'icon_type' => 'custom',
                ],
			]
		);

        $this->add_responsive_control(
            'icon_svg_size',
            [
                'label'     => esc_html__('Icon Size', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 5,
                        'max'       => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-container .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'icon_type' => 'svg'
                ]
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

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'         => esc_html__('Icon Margins', 'tp-elements'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .icon-item .icon-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'         => esc_html__('Icon Border Radius', 'tp-elements'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .icon-item .icon-container.background-type-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    'background_type' => 'color'
                ]
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

                $this->add_control(
                    'icon_color',
                    [
                        'label'     => esc_html__('Icon Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container i' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'icon_type' => 'default'
                        ]
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
                        'condition' => [
                            'icon_type' => 'custom',
                        ]
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
                        'condition' => [
                            'icon_type' => 'custom',
                        ]
                    ]
                );

                $this->add_control(
                    'icon_svg_color',
                    [
                        'label'     => esc_html__('Icon Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container .icon svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .icon-container .icon svg path' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'icon_type' => 'svg'
                        ]
                    ]
                );

                $this->add_control(
                    'background_svg_color',
                    [
                        'label'     => esc_html__('Background SVG Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container .background svg' => 'fill: {{VALUE}};'
                        ],
                        'condition' => [
                            'background_type' => 'svg',
                        ]
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
                        'condition' => [
                            'background_type' => 'color',
                        ]
                    ]
                );

            $this->end_controls_tab();

            // ----------------------- //
            // ------ Hover Tab ------ //
            // ----------------------- //
            $this->start_controls_tab(
                'icon_hover',
                [
                    'label' => esc_html__('Hover', 'tp-elements')
                ]
            );

                $this->add_control(
                    'icon_color_hover',
                    [
                        'label'     => esc_html__('Icon Color on Hover', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}}:hover .icon-container i' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'icon_type' => 'default'
                        ]
                    ]
                );

                $this->add_control(
                    'text_hover_color',
                    [
                        'label'     => esc_html__('Text Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .icon-container:hover span' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'icon_type' => 'custom',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'text_hover_gradient_color',
                        'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                        'fields_options' => [
                            'background' => [
                                'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                            ]
                        ],
                        'types'     => [ 'gradient' ],
                        'selector'  => '{{WRAPPER}} .icon-container:hover span',
                        'condition' => [
                            'icon_type' => 'custom',
                        ]
                    ]
                );

                $this->add_control(
                    'icon_svg_color_hover',
                    [
                        'label'     => esc_html__('Icon Color on Hover', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}}:hover .icon-container .icon svg' => 'fill: {{VALUE}};'
                        ],
                        'condition' => [
                            'icon_type' => 'svg'
                        ]
                    ]
                );

                $this->add_control(
                    'background_svg_color_hover',
                    [
                        'label'     => esc_html__('Background SVG on Hover', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}}:hover .icon-container .background svg' => 'fill: {{VALUE}};'
                        ],
                        'condition' => [
                            'background_type' => 'svg'
                        ]
                    ]
                );

                $this->add_control(
                    'background_normal_color_hover',
                    [
                        'label'     => esc_html__('Background Color on Hover', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}}:hover .icon-container' => 'background: {{VALUE}};'
                        ],
                        'condition' => [
                            'background_type' => 'color'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'decoration_settings',
            [
                'label' => esc_html__('Decoration Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control(
            'enable_decoration',
            [
                'label'         => esc_html__('Enable Decoration ?', 'tp_plugin'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'return_value'  => 'on',
                'label_off'     => esc_html__('No', 'tp_plugin'),
                'label_on'      => esc_html__('Yes', 'tp_plugin'),
                'separator'     => 'before',

            ]
        );

        $this->add_control(
            'add_decoration',
            [
                'label'         => esc_html__('Select Decoration', 'tp_plugin'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
				'options' => [
					'border-top-left' => esc_html__( 'Top Left', 'tp_plugin' ),
					'border-top-right'  => esc_html__( 'Top Right', 'tp_plugin' ),
					'border-bottom-left' => esc_html__( 'Bottom Left', 'tp_plugin' ),
					'border-bottom-right' => esc_html__( 'Bottom Right', 'tp_plugin' ),
                    'inside-border-bottom-right' => esc_html__( 'Inside Bottom Right', 'tp_plugin' ),
                    'inside-border-bottom-left' => esc_html__( 'Inside Bottom Left', 'tp_plugin' ),
                ],
                'separator'     => 'before',
                'condition' => [ 
                    'enable_decoration' => 'on'
                 ],
            ]
        );

        
		$this->add_control(
			'box_shadow_offset_y',
			[
				'label' => esc_html__( 'Box Shadow Offset Y', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .tp-border-decoration-border-bottom-left, {{WRAPPER}} .tp-border-decoration-border-bottom-right, {{WRAPPER}} .tp-border-decoration-border-top-left, {{WRAPPER}} .tp-border-decoration-border-top-right' => '--box-shadow-offset-y: {{SIZE}}{{UNIT}};',
				],
                'condition' => [ 
                    'enable_decoration' => 'on'
                ],
			]
		);

        $this->add_control(
            'decoration_color',
            [
                'label' => esc_html__('Decoration Color', 'tp_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-border-decoration-border-bottom-left, {{WRAPPER}} .tp-border-decoration-border-bottom-right, {{WRAPPER}} .tp-border-decoration-border-top-left, {{WRAPPER}} .tp-border-decoration-border-top-right' => '--box-shadow-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'enable_decoration' => 'on'
                ],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'decoration_border',
				'selector' => '{{WRAPPER}} .tp-border-decoration-border-bottom-left, {{WRAPPER}} .tp-border-decoration-border-bottom-right, {{WRAPPER}} .tp-border-decoration-border-top-left, {{WRAPPER}} .tp-border-decoration-border-top-right',
                'condition' => [ 
                    'enable_decoration' => 'on'
                ],
			]
		);

        $this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        $icon_type       = $settings['icon_type'];
        $default_icon    = $settings['default_icon'];
        $svg_icon        = $settings['svg_icon'];

        $background_type = $settings['background_type'];

        if ( $background_type == 'svg' ) {
            $svg_background = $settings['svg_background'];
        }
        if ( $background_type == 'image' ) {
            $bg_image = !empty($settings['bg_image']['url']) ? $settings['bg_image'] : array();
        }

        $add_link           = $settings['add_link'];
        $link               = $settings['link'];

		?>

		<style>

		/********** Icon Box Elementor Widget **********/
		.tp_elements-icon-widget .icon-item-link {
		    display: block;
		}
		.tp_elements-icon-widget .icon-item .icon-container {
            -webkit-flex-shrink: 0;
            -moz-flex-shrink: 0;
            -ms-flex-shrink: 0;
            flex-shrink: 0;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-justify-content: center;
            -moz-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
            -webkit-align-items: center;
            -moz-align-items: center;
            -ms-align-items: center;
            align-items: center;
            position: relative;
            width: 56px;
            height: 56px;
		}
		.tp_elements-icon-widget .icon-item .icon-container img {
            position: absolute;
            display: block;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            -o-object-fit: contain;
            object-fit: contain;
            -webkit-transition: opacity 0.3s;
            transition: opacity 0.3s;
		}
		.tp_elements-icon-widget .icon-item .icon-container .icon,
		.tp_elements-icon-widget .icon-item .icon-container .background {
            position: absolute;
            display: block;
            left: 50%;
            right: auto;
            top: 50%;
            bottom: initial;
            width: 100%;
            height: 100%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
		}
		.tp_elements-icon-widget .icon-item .icon-container .icon svg,
		.tp_elements-icon-widget .icon-item .icon-container .background svg {
            display: block;
            width: 100%;
            height: 100%;
            -webkit-transition: fill 0.3s;
            transition: fill 0.3s;
		}
		.tp_elements-icon-widget .icon-item .icon-container .icon {
		    z-index: 3;
		}
		.tp_elements-icon-widget .icon-item .icon-container i, .tp_elements-icon-widget .icon-item .icon-container span {
            position: relative;
            z-index: 3;
            -webkit-transition: color 0.3s, fill 0.3s;
            transition: color 0.3s, fill 0.3s;
		}

        /*  Decoration Style  */
        .tp-border-decoration-border-bottom-left {
            position: absolute;
            right: 100%;
            bottom: 0;
            border-top-right-radius: 0px;
            background-color: transparent;
            z-index: 3;
            content: "";
            width: 20px;
            height: 40px;
            border-bottom-right-radius: 20px;
            --box-shadow-color: #7c2626;
            --box-shadow-offset-y: 20px;
            box-shadow: 0 var(--box-shadow-offset-y) 0 0 var(--box-shadow-color);
        }
        .tp-border-decoration-border-bottom-right { 
            position: absolute;
            left: 100%;
            bottom: 0;
            border-top-right-radius: 0px;
            background-color: transparent;
            z-index: 3;
            content: "";
            width: 20px;
            height: 40px;
            border-bottom-left-radius: 20px;
            --box-shadow-color: #7c2626;
            --box-shadow-offset-y: 20px;
            box-shadow: 0 var(--box-shadow-offset-y) 0 0 var(--box-shadow-color);
        }
        .tp-border-decoration-border-top-left {
            position: absolute;
            right: 100%;
            top: 0;
            border-top-right-radius: 0px;
            background-color: transparent;
            z-index: 3;
            content: "";
            width: 20px;
            height: 40px;
            border-bottom-left-radius: 20px;
            --box-shadow-color: #7c2626;
            --box-shadow-offset-y: 20px;
            box-shadow: 0 var(--box-shadow-offset-y) 0 0 var(--box-shadow-color);
            transform: rotate(180deg);
        }
        .tp-border-decoration-border-top-right {
            position: absolute;
            left: 100%;
            top: 0;
            border-top-right-radius: 0px;
            background-color: transparent;
            z-index: 3;
            content: "";
            width: 20px;
            height: 40px;
            border-bottom-right-radius: 20px;
            --box-shadow-color: #7c2626;
            --box-shadow-offset-y: 20px;
            box-shadow: 0 var(--box-shadow-offset-y) 0 0 var(--box-shadow-color);
            transform: rotate(180deg);
        }

        .tp_elements-icon-widget {
            position: relative;
            z-index: 1;
            line-height: 1;
        }

        .icon-container i, .icon-container svg, .icon-container span {
            transition: 0.4s;
            position: relative;
        }

        .icon-container:hover i, .icon-container:hover svg, .icon-container:hover span {
            animation: tfLeftToRight 0.4s forwards;
        }

        .icon-container span {
            background-clip: text;
            -webkit-background-clip: text;
            -moz-background-clip: text;
            text-decoration: none;
            color: transparent;
        }


        @keyframes tfLeftToRight {
            49% {
                transform: translateX(50%) translateY(-50%);
            }
            50% {
                opacity: 0;
                transform: translateX(-50%) translateY(50%);
            }
            51% {
                opacity: 1;
            }
        }


		</style>
		
		<div class="tp_elements-icon-widget">

            <?php 
                if (!empty($settings['enable_decoration']) && !empty($settings['add_decoration'])) { 
                    foreach ( $settings['add_decoration'] as $item ) {
                        echo '<span class="tp-border-decoration-' . $item . ' "></span>';
                    }
                }
                $is_link = ($add_link == 'yes' && !empty($link) && $link['url'] !== '');
                if($is_link) {
                    $link_open = $settings['btn_link_open'] == 'yes' ? 'target=_blank' : '';
                    $this->add_link_attributes( 'link', $link );
                    echo '<a class="icon-item-link" href="' . esc_url($link['url']) . '"';
                        $this->print_render_attribute_string('link');
                    echo ' ' .wp_kses_post( $link_open ). ' >';
                }
            ?>
            <div class="icon-item">

                <div class="icon-container<?php echo ( !empty($background_type) ? ' background-type-' . esc_attr($background_type) : '' ); ?>">
                    <?php
                    if ($icon_type == 'default') {
                        echo '<i class="' . esc_attr($default_icon['value']) . '"></i>';
                    }
                    if ($icon_type == 'svg') {
                        echo '<span class="icon">' . tp_elements_output_code($svg_icon) . '</span>';
                    }
                    if ($icon_type == 'custom') {
                        echo '<span>' . $settings['custom_text'] . '</span>';
                    }

                    if ($background_type == 'image') {
                        if (!empty($bg_image['url'])) {
                            echo '<img class="icon-container-bg-image" src="' . esc_url($bg_image['url']) . '" alt="' . esc_html__('Background Image', 'tp-elements') . '" />';
                        }
                    }
                    if ($background_type == 'svg' && !empty($svg_background)) {
                        echo '<span class="background">' . tp_elements_output_code($svg_background) . '</span>';
                    }
                    ?>
                </div>

            </div>
            <?php 
                if($is_link) {                   
                    echo '</a>';
                }
            ?>
        </div>

		<?php
	}
}
