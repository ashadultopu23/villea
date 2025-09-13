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

class Themephi_Icon_Box_Widget extends \Elementor\Widget_Base {
	
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
		return 'tp-iconbox';
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
		return esc_html__( 'TP Icon Box', 'tp-elements' );
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
                'label' => esc_html__('Icon Box', 'tp-elements')
            ]
        );

		$this->add_control(
			'service_grid_source',
			[
				'label'   => esc_html__( 'Iconbox Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',				
				'options' => [
					'custom' => esc_html__('Custom', 'tp-elements'),
					'dynamic' => esc_html__('Dynamic', 'tp-elements')					
				],											
			]
		);

		$this->add_control(
			'service_grid_style',
			[
				'label'   => esc_html__( 'Iconbox Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => esc_html__('Style 1', 'tp-elements'),					
				],	
				'condition' => [
					'service_grid_source' => 'dynamic',
				],										
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
                    'svg'       => esc_html__('SVG Icon', 'tp-elements')
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

        $this->add_responsive_control(
            'icon_position',
            [
                'label'             => esc_html__( 'Icon Position', 'tp-elements' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'left'              => [
                        'title'             => esc_html__( 'Left', 'tp-elements' ),
                        'icon'              => 'eicon-h-align-left',
                    ],
                    'top'               => [
                        'title'             => esc_html__( 'Top', 'tp-elements' ),
                        'icon'              => 'eicon-v-align-top',
                    ],
                    'right'             => [
                        'title'             => esc_html__( 'Right', 'tp-elements' ),
                        'icon'              => 'eicon-h-align-right',
                    ],
                    'bottom'               => [
                        'title'             => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon'              => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class'      => 'icon-position%s-',
                'toggle'            => true,
                'default'           => 'top'
            ]
        );

        $this->add_responsive_control(
            'icon_vertical_position',
            [
                'label'             => esc_html__('Icon Vertical Alignment', 'tp-elements'),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'top'               => [
                        'title'             => esc_html__( 'Top', 'tp-elements' ),
                        'icon'              => 'eicon-v-align-top',
                    ],
                    'middle'            => [
                        'title'             => esc_html__( 'Middle', 'tp-elements' ),
                        'icon'              => 'eicon-v-align-middle',
                    ],
                    'bottom'            => [
                        'title'             => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon'              => 'eicon-v-align-bottom',
                    ]
                ],
                'prefix_class'      => 'v-alignment%s-',
                'toggle'            => true,
                'default'           => 'top',
                'condition'         => [
                    'icon_position'   => ['left', 'right']
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_box_align',
            [
                'label'             => esc_html__('Icon Box Alignment', 'tp-elements'),
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
                'prefix_class'      => 'alignment%s-',
                'toggle'            => true,
                'default'           => 'center'
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
            'title',
            [
                'label'         => esc_html__('Icon Box Title', 'tp-elements'),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => esc_html__('Title', 'tp-elements'),
                'placeholder'   => esc_html__('Enter Icon Box Title', 'tp-elements'),
                'separator'     => 'before',
				'condition' => [
					'service_grid_source' => 'custom',
				],	
            ]
        );

        $this->add_control(
            'info',
            [
                'label' => esc_html__('Icon Box Description', 'tp-elements'),
                'type' => Controls_Manager::WYSIWYG,
                'rows' => '10',
                'default' => '',
                'placeholder' => esc_html__('Enter Your Custom Description', 'tp-elements'),
				'condition' => [
					'service_grid_source' => 'custom',
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
				'condition' => [
					'service_grid_source' => 'custom',
				],
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
					'service_grid_source' => 'custom',
                ]
            ]
        );

        $this->add_responsive_control(
            'link_padding',
            [
                'label'         => esc_html__('Link Padding', 'tp-elements'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'     => [
                    '{{WRAPPER}} .icon-box-item-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'add_link' => 'yes',
					'service_grid_source' => 'custom',
                ]
            ]
        );

        $this->end_controls_section();

		
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Dynamic Settings', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'service_grid_source' => 'dynamic',
				],
			]
		);

		$this->add_control(
			'service_category',
			[
				'label'   => esc_html__( 'Category', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',	
			]
		);

		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Service Show Per Page', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'col_xxl',
            [
                'label'   => esc_html__( 'Desktops > 1399px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',        
            ]
            
        );
		$this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',        
            ]
            
        );

		$this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 4,
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',	        
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 768px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 6,         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                   
                ],
                'separator' => 'before',           
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 576px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 6,         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                  
                ],
                'separator' => 'before',          
            ] 
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 575px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 12,         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',          
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'services_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( '#', 'tp-elements' ),
				'condition' => [
					'service_grid_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'services_btn_link_open',
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
			'services_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICON,
				'options' => tp_framework_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',			
			]
		);

		$this->add_control(
		    'services_btn_icon_position',
		    [
		        'label' => esc_html__( 'Icon Position', 'tp-elements' ),
		        'type' => Controls_Manager::CHOOSE,
		        'label_block' => false,
		        'options' => [
		            'before' => [
		                'title' => esc_html__( 'Before', 'tp-elements' ),
		                'icon' => 'eicon-h-align-left',
		            ],
		            'after' => [
		                'title' => esc_html__( 'After', 'tp-elements' ),
		                'icon' => 'eicon-h-align-right',
		            ],
		        ],
		        'default' => 'after',
		        'toggle' => false,
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		    ]
		); 

		$this->add_control(
		    'services_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .services-btn-part .services-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
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

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'         => esc_html__('Icon Margins', 'tp-elements'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .icon-box-item .icon-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .icon-box-item .icon-container.background-type-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'     => [
                    'background_type' => 'color'
                ]
            ]
        );

        $this->end_controls_section();


        // ------------------------------------ //
        // ---------- Title Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'title_settings',
            [
                'label' => esc_html__('Title Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__('Title Typography', 'tp-elements'),
                'selector'  => '{{WRAPPER}} .icon-box-title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon-box-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Title Color on Hover', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon-box-item-link:hover .icon-box-title' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'add_link' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        // ---------------------------------------- //
        // ---------- Info Text Settings ---------- //
        // ---------------------------------------- //
        $this->start_controls_section(
            'text_settings',
            [
                'label' => esc_html__('Description Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label'     => esc_html__('Description Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon-box-info' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'info_typography',
                'label'     => esc_html__('Description Typography', 'tp-elements'),
                'selector'  => '{{WRAPPER}} .icon-box-info, {{WRAPPER}} .icon-box-info p'
            ]
        );

        $this->add_responsive_control(
            'info_margin',
            [
                'label'     => esc_html__('Space Between Title and Text', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-box-info' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


		//Button Style
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'iconbox_button_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'iconbox_button_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .services-btn-part .services-btn',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .services-btn',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .services-btn-part .services-btn',
		    ]
		);

		$this->add_control(
		    'hr',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_tab_button_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'link_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .services-btn-part .services-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'button_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn:hover, {{WRAPPER}} .services-btn-part .services-btn:focus' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn:hover, {{WRAPPER}} .services-btn-part .services-btn:focus' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn:hover, {{WRAPPER}} .services-btn-part .services-btn:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-btn-part .services-btn.icon-before:hover i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .services-btn-part .services-btn.icon-after:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

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

        $title              = $settings['title'];
        $info               = $settings['info'];
        $add_link           = $settings['add_link'];
        $link               = $settings['link'];

		?>

		<style>

		/********** Icon Box Elementor Widget **********/
		.tp_elements-icon-box-widget .icon-box-item-link {
		display: block;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-container {
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
		margin: 0 0 15px;
		width: 56px;
		height: 56px;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-container.background-type-color {
		-webkit-border-radius: 15px;
		border-radius: 15px;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-container img {
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
		.tp_elements-icon-box-widget .icon-box-item .icon-container .icon,
		.tp_elements-icon-box-widget .icon-box-item .icon-container .background {
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
		.tp_elements-icon-box-widget .icon-box-item .icon-container .icon svg,
		.tp_elements-icon-box-widget .icon-box-item .icon-container .background svg {
		display: block;
		width: 100%;
		height: 100%;
		-webkit-transition: fill 0.3s;
		transition: fill 0.3s;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-container .icon {
		z-index: 3;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-container i {
		position: relative;
		z-index: 3;
		-webkit-transition: color 0.3s, fill 0.3s;
		transition: color 0.3s, fill 0.3s;
		}
		.tp_elements-icon-box-widget .icon-box-item .content-container {
		display: block;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-box-title {
		margin: 0;
		font-weight: 600;
		letter-spacing: normal;
		-webkit-transition: color 0.3s;
		transition: color 0.3s;
		}
		.tp_elements-icon-box-widget .icon-box-item .icon-box-info:not(:first-child) {
		margin: 9px 0 0;
		}

		.elementor-widget-tp-iconbox.icon-position-top .icon-box-item {
		display: block;
		}
		.elementor-widget-tp-iconbox.icon-position-top.alignment-left .icon-box-item {
		text-align: left;
		}
		.elementor-widget-tp-iconbox.icon-position-top.alignment-right .icon-box-item {
		text-align: right;
		}
		.elementor-widget-tp-iconbox.icon-position-top.alignment-center .icon-box-item {
		text-align: center;
		}
		.elementor-widget-tp-iconbox.icon-position-left .icon-box-item {
		display: -webkit-box;
		display: -moz-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-flex-direction: row;
		-moz-flex-direction: row;
		-ms-flex-direction: row;
		flex-direction: row;
		-webkit-flex-wrap: nowrap;
		-moz-flex-wrap: nowrap;
		-ms-flex-wrap: nowrap;
		flex-wrap: nowrap;
		-webkit-justify-content: flex-start;
		-moz-justify-content: flex-start;
		-ms-justify-content: flex-start;
		justify-content: flex-start;
		-webkit-align-items: flex-start;
		-moz-align-items: flex-start;
		-ms-align-items: flex-start;
		align-items: flex-start;
		}
		.elementor-widget-tp-iconbox.icon-position-left.alignment-left .icon-box-item {
		-webkit-justify-content: flex-start;
		-moz-justify-content: flex-start;
		-ms-justify-content: flex-start;
		justify-content: flex-start;
		text-align: left;
		}
		.elementor-widget-tp-iconbox.icon-position-left.alignment-right .icon-box-item {
		-webkit-justify-content: flex-end;
		-moz-justify-content: flex-end;
		-ms-justify-content: flex-end;
		justify-content: flex-end;
		text-align: right;
		}
		.elementor-widget-tp-iconbox.icon-position-left.alignment-center .icon-box-item {
		-webkit-justify-content: center;
		-moz-justify-content: center;
		-ms-justify-content: center;
		justify-content: center;
		text-align: center;
		}
		.elementor-widget-tp-iconbox.icon-position-left.alignment-space-between .icon-box-item {
		-webkit-justify-content: space-between;
		-moz-justify-content: space-between;
		-ms-justify-content: space-between;
		justify-content: space-between;
		text-align: center;
		}
		.elementor-widget-tp-iconbox.icon-position-right .icon-box-item {
		display: -webkit-box;
		display: -moz-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-flex-direction: row-reverse;
		-moz-flex-direction: row-reverse;
		-ms-flex-direction: row-reverse;
		flex-direction: row-reverse;
		-webkit-flex-wrap: nowrap;
		-moz-flex-wrap: nowrap;
		-ms-flex-wrap: nowrap;
		flex-wrap: nowrap;
		-webkit-justify-content: flex-end;
		-moz-justify-content: flex-end;
		-ms-justify-content: flex-end;
		justify-content: flex-end;
		-webkit-align-items: flex-start;
		-moz-align-items: flex-start;
		-ms-align-items: flex-start;
		align-items: flex-start;
		}
		.elementor-widget-tp-iconbox.icon-position-right.alignment-left .icon-box-item {
		-webkit-justify-content: flex-end;
		-moz-justify-content: flex-end;
		-ms-justify-content: flex-end;
		justify-content: flex-end;
		text-align: left;
		}
		.elementor-widget-tp-iconbox.icon-position-right.alignment-right .icon-box-item {
		-webkit-justify-content: flex-start;
		-moz-justify-content: flex-start;
		-ms-justify-content: flex-start;
		justify-content: flex-start;
		text-align: right;
		}
		.elementor-widget-tp-iconbox.icon-position-right.alignment-center .icon-box-item {
		-webkit-justify-content: center;
		-moz-justify-content: center;
		-ms-justify-content: center;
		justify-content: center;
		text-align: center;
		}
		.elementor-widget-tp-iconbox.icon-position-right.alignment-space-between .icon-box-item {
		-webkit-justify-content: space-between;
		-moz-justify-content: space-between;
		-ms-justify-content: space-between;
		justify-content: space-between;
		text-align: center;
		}
		.elementor-widget-tp-iconbox.icon-position-bottom .icon-box-item {
		display: -webkit-box;
		display: -moz-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-flex-direction: column-reverse;
		-moz-flex-direction: column-reverse;
		-ms-flex-direction: column-reverse;
		flex-direction: column-reverse;
		-webkit-flex-wrap: nowrap;
		-moz-flex-wrap: nowrap;
		-ms-flex-wrap: nowrap;
		flex-wrap: nowrap;
		-webkit-justify-content: flex-end;
		-moz-justify-content: flex-end;
		-ms-justify-content: flex-end;
		justify-content: flex-end;
		-webkit-align-items: flex-start;
		-moz-align-items: flex-start;
		-ms-align-items: flex-start;
		align-items: flex-start;
		}
		.elementor-widget-tp-iconbox.icon-position-bottom.alignment-left .icon-box-item {
		-webkit-align-items: flex-start;
		-moz-align-items: flex-start;
		-ms-align-items: flex-start;
		align-items: flex-start;
		text-align: left;
		}
		.elementor-widget-tp-iconbox.icon-position-bottom.alignment-right .icon-box-item {
		-webkit-align-items: flex-end;
		-moz-align-items: flex-end;
		-ms-align-items: flex-end;
		align-items: flex-end;
		text-align: right;
		}
		.elementor-widget-tp-iconbox.icon-position-bottom.alignment-center .icon-box-item {
		-webkit-align-items: center;
		-moz-align-items: center;
		-ms-align-items: center;
		align-items: center;
		text-align: center;
		}
		.elementor-widget-tp-iconbox.v-alignment-top .icon-box-item {
		-webkit-align-items: flex-start;
		-moz-align-items: flex-start;
		-ms-align-items: flex-start;
		align-items: flex-start;
		}
		.elementor-widget-tp-iconbox.v-alignment-middle .icon-box-item {
		-webkit-align-items: center;
		-moz-align-items: center;
		-ms-align-items: center;
		align-items: center;
		}
		.elementor-widget-tp-iconbox.v-alignment-bottom .icon-box-item {
		-webkit-align-items: flex-end;
		-moz-align-items: flex-end;
		-ms-align-items: flex-end;
		align-items: flex-end;
		}


		</style>
		
		<?php if($settings['service_grid_source'] == 'dynamic'){ 

		$cat = $settings['service_category'];

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		if(empty($cat)){
			$best_wp = new wp_Query(array(
					'post_type'      => 'services',
					'posts_per_page' => $settings['per_page'],
					'paged'          => $paged					
			));	  
		}   
		else{
			$best_wp = new wp_Query(array(
				'post_type'      => 'services',
				'posts_per_page' => $settings['per_page'],
				'paged'          => $paged,
				'tax_query'      => array(
					array(
						'taxonomy' => 'service-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
					),
				)
			));	  
		} 
		$col_xxl = $settings['col_xxl'] ? $settings['col_xxl'] : '3';
		$col_xl = $settings['col_xl'] ? $settings['col_xl'] : '3';
		$col_lg = $settings['col_lg'] ? $settings['col_lg'] : '4';
		$col_md = $settings['col_md'] ? $settings['col_md'] : '6';
		$col_sm = $settings['col_sm'] ? $settings['col_sm'] : '6';
		$col_xs = $settings['col_xs'] ? $settings['col_xs'] : '12';

		?>
		<div class="tp_elements-icon-box-widget tp-icon-box-<?php echo esc_attr( $settings['service_grid_source'] ); ?>">
			<div class="row ">
				<?php
				while($best_wp->have_posts()): $best_wp->the_post();
				$post_id = get_the_ID();
				$image_url = get_post_meta( $post_id, 'service_thumb', true );		

				if('style1' == $settings['service_grid_style']){
					require plugin_dir_path(__FILE__)."/style1.php";
				}

				endwhile;
				wp_reset_query();  
				?>  
			</div>
			<?php 
				echo paginate_links(
					array(
						'total'      => $best_wp->max_num_pages,
						'type'       => 'list',
						'current'    => max( 1, $paged ),
						'prev_text'  => '<i class="fa fa-angle-left"></i>',
						'next_text'  => '<i class="fa fa-angle-right"></i>'
					)
				);
			?>
		</div>

		<?php 
		} else { ?>

		<div class="tp_elements-icon-box-widget">
            <?php
                $is_link = ($add_link == 'yes' && !empty($link) && $link['url'] !== '');
                if($is_link) {
                    $this->add_link_attributes( 'link', $link );
                    echo '<a class="icon-box-item-link" href="' . esc_url($link['url']) . '"';
                        $this->print_render_attribute_string('link');
                    echo '>';
                }
            ?>
            <div class="icon-box-item">

                <div class="icon-container<?php echo ( !empty($background_type) ? ' background-type-' . esc_attr($background_type) : '' ); ?>">
                    <?php
                    if ($icon_type == 'default') {
                        echo '<i class="' . esc_attr($default_icon['value']) . '"></i>';
                    }
                    if ($icon_type == 'svg') {
                        echo '<span class="icon">' . tp_elements_output_code($svg_icon) . '</span>';
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

                <div class="content-container">
                    <?php
                        if ($title !== '') {
                            echo '<h5 class="icon-box-title">';
                                echo '<span class="tp_elements-heading-content">' . tp_elements_output_code($title) . '</span>';
                            echo '</h5>';
                        }
                    ?>


                    <?php
                        if ($info !== '') {
                            echo '<div class="icon-box-info">';
                                echo tp_elements_output_code($info);
                            echo '</div>';
                        }
                    ?>

                </div>

				<?php if(!empty($settings['services_btn_text'])){ ?>
				<div class="services-btn-part">
					<?php if(!empty($settings['services_btn_text'])) : 
						$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
					?>

					<?php  
						$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
					?>
						<a class="services-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink();?>" <?php echo wp_kses_post( $link_open ); ?>>
							<span class="btn-txt"><?php echo wp_kses_post( $settings['services_btn_text'] );?></span>
							<?php if(!empty($settings['services_btn_icon'])) : ?>
								<i class="fa <?php echo esc_html( $settings['services_btn_icon'] );?>"></i>
							<?php endif; ?>
						</a>
					<?php else: ?>
					<?php endif;
					?>
					
				</div>
				<?php } ?>

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

	public function getCategories(){
        $cat_list = [];
             if ( post_type_exists( 'services' ) ) { 
              $terms = get_terms( array(
                 'taxonomy'    => 'service-category',
                 'hide_empty'  => true            
             ) ); 
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }

}
