<?php
/**
 * Pricing table widget class
 *
 */
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\REPEATER;
use Elementor\Utils;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Pricing_Table_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'tp-price-table';
    }   

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'TP Pricing Table', 'tp-elements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'pricing', 'table', 'package', 'product', 'plan' ];
    }

	protected function register_controls() {

        
        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Price Item', 'neuros_plugin')
            ]
        );

        $this->add_control(
            'block_type',
            [
                'label'     => esc_html__('Price Item Type', 'neuros_plugin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'standard',
                'options'   => [
                    'standard'  => esc_html__('Standard', 'neuros_plugin'),
                    'wide'      => esc_html__('Wide', 'neuros_plugin')
                ]
            ]
        );

        $this->add_control(
            'block_style',
            [
                'label'     => esc_html__('Price Item Style', 'neuros_plugin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''      => esc_html__('Default', 'neuros_plugin'),
                    'alt'   => esc_html__('Alternative', 'neuros_plugin')
                ]
            ]
        );

        $this->add_control(
            'active_block_status',
            [
                'label'         => esc_html__('Highlight this block?', 'neuros_plugin'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('No', 'neuros_plugin'),
                'label_on'      => esc_html__('Yes', 'neuros_plugin'),
                'return_value'  => 'yes',
                'default'       => 'no'
            ]
        );

        $this->add_control(
            'title',
            [
                'label'     => esc_html__('Title', 'neuros_plugin'),
                'type'      => Controls_Manager::TEXT,
                'default'   => ''
            ]
        );

        $this->add_control(
            'item_label',
            [
                'label'     => esc_html__('Label', 'neuros_plugin'),
                'type'      => Controls_Manager::TEXT,
                'default'   => ''
            ]
        );        

        $this->add_control(
            'description',
            [
                'label'         => esc_html__('Short Description', 'neuros_plugin'),
                'description'   => esc_html__('Enter description', 'neuros_plugin'),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => ''
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => esc_html__('Image', 'neuros_plugin'),
                'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'block_type' => 'standard'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => [
                    'block_type' => 'standard'
                ]
            ]
        );

        $this->add_control(
            'currency',
            [
                'label'         => esc_html__('Currency', 'neuros_plugin'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => '$',
                'separator'     => 'before'
            ]
        );

        $this->add_control(
            'currency_position',
            [
                'label'     => esc_html__('Currency Position', 'neuros_plugin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'before',
                'options'   => [
                    'before'    => esc_html__('Before Price', 'neuros_plugin'),
                    'after'     => esc_html__('After Price', 'neuros_plugin')
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label'     => esc_html__('Price', 'neuros_plugin'),
                'type'      => Controls_Manager::TEXT,
                'default'   => ''
            ]
        );

        $this->add_control(
            'period',
            [
                'label'         => esc_html__('Period', 'neuros_plugin'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('month', 'neuros_plugin')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label'         => esc_html__( 'Text', 'neuros_plugin' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter Text', 'neuros_plugin' ),
            ]
        );

        $repeater->add_control(
            'is_active',
            [
                'label'         => esc_html__('Highlight this field', 'neuros_plugin'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('No', 'neuros_plugin'),
                'label_on'      => esc_html__('Yes', 'neuros_plugin'),
                'return_value'  => 'yes',
                'default'       => 'no'
            ]
        );

        $this->add_control(
            'custom_fields',
            [
                'label'         => esc_html__('Custom Fields', 'neuros_plugin'),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'prevent_empty' => true,
                'separator'     => 'before',
                'default'       => [
                    [
                        'text'      => '',
                        'is_active' => 'no'
                    ]
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Price Button', 'neuros_plugin')
            ]
        );

        $this->add_control(
			'btn_style',
			[
				'label'     => esc_html__( 'Style', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style6',
				'options'   => [
					'style1' => esc_html__( ' Button Style 1', 'tp-elements' ),
					'style2' => esc_html__( ' Button Style 2', 'tp-elements' ),
					'style3' => esc_html__( ' Button Style 3', 'tp-elements' ),
					'style4' => esc_html__( ' Button Style 4', 'tp-elements' ),
					'style5' => esc_html__( ' Button Style 5', 'tp-elements' ),
					'style6' => esc_html__( ' Button Style 6', 'tp-elements' ),
				],
				'separator' => 'after',
			]
		);

        $this->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Text', 'tp-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Discover More', 'tp-elements' ),
			]
		);

		$this->add_control(
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

		$this->add_control(
			'btn_icon_position',
			[
				'label'     => esc_html__( 'Icon Position', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'row',
				'options'   => [
					'row'         => esc_html__( 'After', 'tp-elements' ),
					'row-reverse' => esc_html__( 'Before', 'tp-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} .btn-text-flip' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'btn_style' => 'style3',
				],
			]
		);

		$this->add_control(
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
					'{{WRAPPER}} .price-item-button-container' => 'justify-content: {{VALUE}};',
				],
				'prefix_class'      => 'button-pro-align-',
				'separator' => 'before',
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


        // ----------------------------------------- //
        // ---------- Price Item Settings ---------- //
        // ----------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Price Item Settings', 'neuros_plugin'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => esc_html__('Item Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-title,
                     {{WRAPPER}} .price-item .price-item-container,
                     {{WRAPPER}} .price-item .price-item-custom-fields,
                     {{WRAPPER}} .price-item .price-item-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'item_bg',
                'label'             => esc_html__( 'Background', 'neuros_plugin' ),
                'types'             => [ 'classic', 'gradient' ],
                'fields_options'    => [
                    'color' => [
                        'label'     => esc_html__('Background Color', 'neuros_plugin')
                    ]
                ],
                'selector'          => '{{WRAPPER}} .price-item'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'item_bg_add',
                'label'             => esc_html__( 'Background', 'neuros_plugin' ),
                'types'             => [ 'classic', 'gradient' ],
                'fields_options'    => [
                    'background' => [
                        'label'     => esc_html__('Additional Background', 'neuros_plugin')
                    ]
                ],
                'selector'          => '{{WRAPPER}} .price-item-image-block',
                'condition' => [
                    'block_type'  => 'standard',
                    'block_style' => 'alt'
                ]
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => esc_html__( 'Border Width', 'neuros_plugin' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .price-item' => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .price-item .price-item-label-wrapper' => 'top: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'         => esc_html__('Border Radius', 'neuros_plugin'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .price-item, {{WRAPPER}} .price-item-image-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'     => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'item_shadow',
                'label'     => esc_html__('Item Shadow', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'         => esc_html__('Item Padding', 'neuros_plugin'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .price-item.price-item-type-standard' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .price-item.price-item-type-wide .price-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Title Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_title_settings',
            [
                'label' => esc_html__('Title Settings', 'neuros_plugin'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__('Title Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item-title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'     => esc_html__('Space After Title', 'neuros_plugin'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-item-title:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Label Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_label_settings',
            [
                'label' => esc_html__('Label Settings', 'neuros_plugin'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'label_typography',
                'label'     => esc_html__('Label Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item .price-item-label'
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__('Label Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-label' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'label_bg_color',
            [
                'label'     => esc_html__('Label Background Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-label' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .price-item .price-item-label-wrapper:before,
                     {{WRAPPER}} .price-item .price-item-label-wrapper:after' => 'box-shadow: 0 -20px 0 0 {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'label_padding',
            [
                'label'         => esc_html__('Label Padding', 'neuros_plugin'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .price-item .price-item-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Image Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_image_settings',
            [
                'label'     => esc_html__('Image Settings', 'neuros_plugin'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'block_type'    => 'standard'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'     => esc_html__('Space After Image', 'neuros_plugin'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-item-image:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'block_type'    => 'standard'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------------ //
        // ---------- Price Block Settings ---------- //
        // ------------------------------------------ //
        $this->start_controls_section(
            'section_price_settings',
            [
                'label' => esc_html__('Price Block Settings', 'neuros_plugin'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'price_typography',
                'label'     => esc_html__('Price Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item .price-wrapper .price'
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__('Price Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-wrapper .price' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'currency_typography',
                'label'     => esc_html__('Currency Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item .price-wrapper .currency'
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label'     => esc_html__('Currency Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-wrapper .currency' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'period_typography',
                'label'     => esc_html__('Period Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item .price-item-period'
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label'     => esc_html__('Period Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-period' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_responsive_control(
			'period_margin',
			[
				'label'      => esc_html__( 'Margin', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .price-item .price-item-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Content Settings', 'neuros_plugin'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'fields_padding',
			[
				'label'      => esc_html__( 'Padding', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'fields_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'fields_border',
				'selector' => '{{WRAPPER}} .tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields',
			]
		);

		$this->add_responsive_control(
			'fields_border-radius',
			[
				'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'fields_margin',
            [
                'label'     => esc_html__('Space Between Fields', 'neuros_plugin'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 20
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-custom-field:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'fields_typography',
                'label'     => esc_html__('Custom Fields Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item .price-item-custom-field',
                'separator' => 'after'
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'     => esc_html__('Space After Content', 'neuros_plugin'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-item-custom-fields:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'block_type'    => 'standard'
                ]
            ]
        );

        $this->start_controls_tabs('fields_settings_tabs');

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'tab_fields_normal',
                [
                    'label' => esc_html__('Normal', 'neuros_plugin')
                ]
            );

                $this->add_control(
                    'fields_color',
                    [
                        'label'     => esc_html__('Custom Fields Text Color', 'neuros_plugin'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .price-item .price-item-custom-field:not(.active)' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'fields_dot_color',
                    [
                        'label'     => esc_html__('Custom Fields Dot Color', 'neuros_plugin'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tp-price-item-widget .price-item .price-item-custom-fields .price-item-custom-field:before' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

            // ------------------------ //
            // ------ Active Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'tab_fields_active',
                [
                    'label' => esc_html__('Active', 'neuros_plugin')
                ]
            );

                $this->add_control(
                    'active_fields_color',
                    [
                        'label'     => esc_html__('Custom Fields Text Color', 'neuros_plugin'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .price-item .price-item-custom-field.active' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'fields_dot_active_color',
                    [
                        'label'     => esc_html__('Custom Fields Dot Color', 'neuros_plugin'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tp-price-item-widget .price-item .price-item-custom-fields .price-item-custom-field.active:before' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'description_typography',
                'label'     => esc_html__('Description Typography', 'neuros_plugin'),
                'selector'  => '{{WRAPPER}} .price-item .price-item-description'
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Description Color', 'neuros_plugin'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-item .price-item-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label'     => esc_html__('Space After Description', 'neuros_plugin'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-item-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'block_type'    => 'standard'
                ]
            ]
        );

        $this->end_controls_section();

    
        
		$this->start_controls_section(
			'style_button',
			[
				'label' => esc_html__( 'Button', 'tp-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        // Button Wrapper
		$this->add_control(
			'btn_wrapper_heading',
			[
				'label'     => esc_html__( 'Button Wrapper ', 'tp-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'btn_wrapper_margin',
			[
				'label'      => esc_html__( 'Margin', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tp-price-item-widget .helo--btn-wrapper.style6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tp-price-item-widget .helo--btn-wrapper.style6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_wrapper_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-price-item-widget .helo--btn-wrapper.style6',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_wrapper_border',
				'selector' => '{{WRAPPER}} .tp-price-item-widget .helo--btn-wrapper.style6',
			]
		);

		$this->add_responsive_control(
			'btn_wrapper_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tp-price-item-widget .helo--btn-wrapper.style6'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        // Button 
		$this->add_control(
			'btn_button_heading',
			[
				'label'     => esc_html__( 'Button ', 'tp-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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

		// Icon Style
		$this->add_control(
			'btn_icon_heading',
			[
				'label'     => esc_html__( 'Icon', 'tp-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'tp-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn .icon, {{WRAPPER}} .wc-btn-play' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .style-4 .wc-btn-primary strong'            => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_size_width',
			[
				'label'      => esc_html__( 'Icon Width', 'tp-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; --icon-width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'btn_style' => [ 'style5', 'style6' ] ],
			]
		);

		$this->add_responsive_control(
			'btn_gap',
			[
				'label'      => esc_html__( 'Gap', 'tp-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'btn_style!' => [ 'style5', 'style6' ] ],
			]
		);

		// Tabs
		$this->start_controls_tabs(
			'btn_style_tabs'
		);

		$this->start_controls_tab(
			'btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__( 'Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn, {{WRAPPER}} .btn-text-flip span, {{WRAPPER}} .wc-btn-primary' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary strong'                                          => 'background-color: {{VALUE}}',
					'{{WRAPPER}} svg'                                                                      => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
			'btn_h_color',
			[
				'label'     => esc_html__( 'Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn:hover'                                                => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .btn-text-flip:hover span, {{WRAPPER}} .btn-text-flip:hover svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .wc-btn-group:hover span, {{WRAPPER}} .wc-btn-primary:hover'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .wc-btn-group:hover .wc-btn-play svg'                            => 'fill: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary:hover strong'                           => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary:hover strong::after'                    => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_h_border',
			[
				'label'     => esc_html__( 'Border Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn:hover, {{WRAPPER}} .wc-btn-primary:hover, {{WRAPPER}} .wc-btn-group:hover span' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .helo--btn:hover, {{WRAPPER}} .wc-btn-group:hover span, .style-4 .wc-btn-primary span',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

    }

    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $block_type             = $settings['block_type'];
        $block_style            = $settings['block_style'];
        $title                  = $settings['title'];
        $item_label             = $settings['item_label'];
        $image                  = $settings['image'];
        $active_block_status    = $settings['active_block_status'];
        $currency               = $settings['currency'];
        $currency_position      = $settings['currency_position'];
        $price                  = $settings['price'];
        $period                 = $settings['period'];
        $custom_fields          = $settings['custom_fields'];
        $description            = $settings['description'];
        $price_button_text      = $settings['btn_text'];
        $button_link            = $settings['btn_link'];
        $button_url             = $button_link['url'];

        if ( !empty($price_button_text) && empty($button_url) ) {
            $button_url         = '#';
        }

        $price_item_class = $active_block_status === 'yes' ? ' active' : '';
        $price_item_class .= ' price-item-type-' . esc_attr($block_type);
        $price_item_class .= ($block_type == 'wide' && $block_style === 'alt') ? ' price-item-style-alt' : '';
        ?>

        <style>
            
/********** Price Item Elementor Widget **********/
.tp-price-item-widget.tp-price-item-style-alt {
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
  -webkit-align-items: stretch;
  -moz-align-items: stretch;
  -ms-align-items: stretch;
  align-items: stretch;
}
.tp-price-item-widget.tp-price-item-style-alt .price-item.price-item-type-standard {
  margin: 0;
  width: 73%;
}
.tp-price-item-widget.tp-price-item-style-alt .price-item-image-block {
  width: 38.6%;
  margin-left: -11.6%;
  -webkit-border-radius: 25px;
  border-radius: 25px;
}
.tp-price-item-widget .price-item {
  position: relative;
  cursor: default;
  margin: 0 auto;
  border-width: 1px;
  border-style: solid;
  -webkit-border-radius: 25px;
  border-radius: 25px;
}
.tp-price-item-widget .price-item .price-item-title {
  font-size: 40px;
  line-height: 1em;
  font-weight: 400;
  letter-spacing: -0.03em;
}
.tp-price-item-widget .price-item .price-item-title:not(:last-child) {
  margin-bottom: 14px;
}
.tp-price-item-widget .price-item .price-item-custom-fields .price-item-custom-field {
  position: relative;
  padding: 0 0 0 1em;
}
.tp-price-item-widget .price-item .price-item-custom-fields .price-item-custom-field:not(:first-child) {
  margin: 10px 0 0;
}
.tp-price-item-widget .price-item .price-item-custom-fields .price-item-custom-field:before {
  content: '';
  width: 0.25em;
  height: 0.25em;
  background-color: var(--whiteColor);
  position: absolute;
  left: 2px;
  top: 0.8em;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
.tp-price-item-widget .price-item .price-item-container {
  font-size: 0;
  line-height: 1;
  font-weight: 600;
}
.tp-price-item-widget .price-item .price-item-container:not(:last-child) {
  margin-bottom: 20px;
}
.tp-price-item-widget .price-item .price-item-button-container {
  line-height: 1;
}
.tp-price-item-widget .price-item .price-item-button-container .tp-button {
  padding: 10px 34px 11px 43px;
}
.tp-price-item-widget .price-item .price-item-button-container .tp-button:hover {
  padding: 10px 43px 11px 34px;
}
.tp-price-item-widget .price-item .price-wrapper {
  display: inline-block;
}
.tp-price-item-widget .price-item .price-wrapper .price,
.tp-price-item-widget .price-item .price-wrapper .currency {
  font-size: 60px;
  line-height: 1em;
}
.tp-price-item-widget .price-item .price-item-period {
  display: inline-block;
  vertical-align: baseline;
  font-size: 20px;
}
.tp-price-item-widget .price-item .price-item-description {
  line-height: 1.5em;
  letter-spacing: -0.03em;
  font-weight: 600;
}
.tp-price-item-widget .price-item .price-item-description:not(:last-child) {
  margin-bottom: 60px;
}
.tp-price-item-widget .price-item .price-item-label-wrapper {
  position: absolute;
  top: -1px;
  left: 5.7%;
  padding: 0 20px;
  overflow: hidden;
}
.tp-price-item-widget .price-item .price-item-label-wrapper:before, .tp-price-item-widget .price-item .price-item-label-wrapper:after {
  content: "";
  position: absolute;
  background-color: transparent;
  top: 0;
  height: 40px;
  width: 20px;
  box-shadow: 0 -20px 0 0 #000;
}
.tp-price-item-widget .price-item .price-item-label-wrapper:before {
  left: 0;
  border-top-right-radius: 20px;
}
.tp-price-item-widget .price-item .price-item-label-wrapper:after {
  right: 0;
  border-top-left-radius: 20px;
}
.tp-price-item-widget .price-item .price-item-label-wrapper .price-item-label {
  line-height: 1.5em;
  letter-spacing: -0.03em;
  padding: 8px 43px 6px 37px;
  -webkit-border-radius: 0 0 25px 25px;
  border-radius: 0 0 25px 25px;
  background-color: black;
}
.tp-price-item-widget .price-item.price-item-type-standard {
  padding: 59px 19px 47px;
}
.tp-price-item-widget .price-item.price-item-type-standard .price-item-image {
  position: relative;
}
.tp-price-item-widget .price-item.price-item-type-standard .price-item-image:not(:last-child) {
  margin-bottom: 30px;
}
.tp-price-item-widget .price-item.price-item-type-standard .price-item-image img {
  max-width: 90%;
  margin: 0 auto;
}
.tp-price-item-widget .price-item.price-item-type-standard .price-item-custom-fields:not(:last-child) {
  margin-bottom: 43px;
}
.tp-price-item-widget .price-item.price-item-type-wide.price-item-style-alt .price-item-title {
  font-size: 20px;
  line-height: 1.2em;
}
.tp-price-item-widget .price-item.price-item-type-wide.price-item-style-alt .price-item-title:not(:last-child) {
  margin-bottom: 6px;
}
.tp-price-item-widget .price-item.price-item-type-wide.price-item-style-alt .price-item-label-wrapper {
  left: 17.5%;
}
.tp-price-item-widget .price-item.price-item-type-wide .price-item-inner {
  padding: 50px 35px;
  text-align: left;
}
.tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields:not(:last-child),
.tp-price-item-widget .price-item.price-item-type-wide .price-item-title-wrapper:not(:last-child) {
  margin-bottom: 30px;
}
.tp-price-item-widget .price-item.price-item-type-wide .price-item-container:not(:last-child) {
  margin-bottom: 25px;
}
.tp-price-item-widget .price-item.price-item-type-wide .price-wrapper .price,
.tp-price-item-widget .price-item.price-item-type-wide .price-wrapper .currency {
  font-size: 32px;
  line-height: 1em;
}
.tp-price-item-widget .price-item.price-item-type-wide .price-item-price-wrapper {
  -webkit-flex-shrink: 0;
  -moz-flex-shrink: 0;
  -ms-flex-shrink: 0;
  flex-shrink: 0;
}

@media only screen and (min-width: 768px) {
  .tp-price-item-widget .price-item.price-item-type-standard {
    padding: 72px 45px 60px;
  }
  .tp-price-item-widget .price-item.price-item-type-wide.price-item-style-alt .price-item-inner {
    padding: 50px 50px 55px 48px;
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
    -webkit-justify-content: space-between;
    -moz-justify-content: space-between;
    -ms-justify-content: space-between;
    justify-content: space-between;
    -webkit-align-items: center;
    -moz-align-items: center;
    -ms-align-items: center;
    align-items: center;
  }
  .tp-price-item-widget .price-item.price-item-type-wide.price-item-style-alt .price-item-title-wrapper {
    min-width: 33%;
  }
  .tp-price-item-widget .price-item.price-item-type-wide.price-item-style-alt .price-item-custom-fields {
    width: auto;
    min-width: 35%;
    margin-right: auto;
    column-count: 2;
  }
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-inner {
    padding: 95px 80px 75px 75px;
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
    -webkit-justify-content: space-between;
    -moz-justify-content: space-between;
    -ms-justify-content: space-between;
    justify-content: space-between;
    -webkit-align-items: flex-start;
    -moz-align-items: flex-start;
    -ms-align-items: flex-start;
    align-items: flex-start;
  }
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-label-wrapper {
    left: 6%;
  }
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields:not(:last-child),
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-title-wrapper:not(:last-child) {
    margin-bottom: 0;
  }
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-custom-fields {
    width: 100%;
    border-left: 1px solid #242424;
    padding-left: 50px;
    padding-top: 25px;
    padding-bottom: 25px;
  }
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-title-wrapper {
    min-width: 34%;
    padding: 0 30px 0 0;
  }
  .tp-price-item-widget .price-item.price-item-type-wide .price-item-container {
    white-space: nowrap;
  }
}
@media only screen and (min-width: 992px) {
  .tp-price-item-widget .price-item.price-item-type-wide .price-wrapper .price,
  .tp-price-item-widget .price-item.price-item-type-wide .price-wrapper .currency {
    font-size: 60px;
  }
}

.tp-price-item-widget  .helo--btn-wrapper.style6 {
  background-color: #F4F4F4;
  padding: 20px;
  padding-bottom: 0;
  border: 1px solid #dfdcdc;
  border-bottom: 0;
  border-radius: 20px 20px 0 0;
  margin-bottom: -1px;
}

        </style>
        
        <div class="tp-price-item-widget <?php echo (($block_type === 'standard' && $block_style === 'alt') ? ' tp-price-item-style-alt' : ''); ?>">
            <div class="price-item<?php echo esc_attr($price_item_class) ?>">
                
                <?php
                    if ($item_label !== '') {
                        echo '<div class="price-item-label-wrapper">';
                            echo '<div class="price-item-label">';
                                echo esc_html($item_label);
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
                <div class="price-item-inner">

                    <?php
                    if ($block_type === 'wide' && ($title !== '' || !empty($description))) {
                        echo '<div class="price-item-title-wrapper">';
                    }
                    if ($title !== '') {
                        echo '<div class="price-item-title">' . esc_html($title) . '</div>';
                    }
                    if ($block_type === 'wide' && $block_style === 'alt' && !empty($price) ) {
                        ?>
                        <div class="price-item-container price-item-currency-position-<?php echo esc_attr($currency_position); ?>">
                            <div class="price-wrapper">
                                <?php
                                if ( !empty($currency) && $currency_position == 'before' ) {
                                    echo '<span class="currency">' . esc_html($currency) . '</span>';
                                }

                                echo '<span class="price">' . esc_html($price) . '</span>';

                                if ( !empty($currency) && $currency_position == 'after' ) {
                                    echo '<span class="currency">' . esc_html($currency) . '</span>';
                                }
                                ?>
                            </div>

                            <?php
                            if ( !empty($period) ) {
                                echo '<div class="price-item-period">' . esc_html($period) . '</div>';
                            }
                            ?>
                        </div>
                        <?php
                    }

                    if ( $description !== '' ) {
                        echo '<div class="price-item-description">' . esc_html($description) . '</div>';
                    }


                    if ($block_type === 'wide' && (!empty($price) )) {
                        echo '<div class="price-item-price-wrapper">';
                    }
                    if ($block_type == 'standard' || ($block_type === 'wide' && $block_style !== 'alt') && !empty($price) ) {
                        ?>
                        <div class="price-item-container price-item-currency-position-<?php echo esc_attr($currency_position); ?>">
                            <div class="price-wrapper">
                                <?php
                                if ( !empty($currency) && $currency_position == 'before' ) {
                                    echo '<span class="currency">' . esc_html($currency) . '</span>';
                                }

                                echo '<span class="price">' . esc_html($price) . '</span>';

                                if ( !empty($currency) && $currency_position == 'after' ) {
                                    echo '<span class="currency">' . esc_html($currency) . '</span>';
                                }
                                ?>
                            </div>

                            <?php
                            if ( !empty($period) ) {
                                echo '<div class="price-item-period">' . esc_html($period) . '</div>';
                            }
                            ?>
                        </div>
                        <?php
                    }?>

                    <?php

                        if ($block_type === 'wide' && (!empty($price) )) {
                            echo '</div>';
                        }


                    if ($block_type === 'wide' && ($title !== '' || !empty($description) || !empty($price_button_text))) {
                        echo '</div>';
                    }

                    if ( $block_type === 'standard' && !empty($image['url']) ) {
                        echo '<div class="price-item-image">';
                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
                        echo '</div>';
                    }

                    if ( !empty($custom_fields) ) {
                        ?>
                        <div class="price-item-custom-fields">
                            <?php
                            foreach ($custom_fields as $field) {
                                $field_status_class = $field['is_active'] == 'yes' ? ' active' : '';
                                if ( !empty($field['text']) ) { ?>
                                    <div class="price-item-custom-field <?php echo esc_attr($field_status_class); ?>"><?php echo esc_html($field['text']); ?></div>
                                <?php }
                            }
                            ?>
                        </div>
                        <?php
                    }                    

                    ?>
                </div>

                <?php
                // price button placed new start
                if ( !empty($price_button_text) ) { ?>
                    <div class="price-item-button-container d-flex ">
                        <div class="helo--btn-wrapper d-inline-block position-relative <?php echo esc_html( $settings['btn_style'] ); ?>">
                            <?php 
                                if (!empty($settings['enable_decoration']) && !empty($settings['add_decoration'])) { 
                                    foreach ( $settings['add_decoration'] as $item ) {
                                        echo '<span class="tp-border-decoration-' . $item . ' "></span>';
                                    }
                                }
                            ?>

                            <?php if ( 'style1' === $settings['btn_style'] ) { ?>
                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn btn-border-divide">
                                    <span class="text"><?php echo esc_html( $settings['btn_text'] ); ?></span>
                                    <span class="icon">
                                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                </a>
                            <?php } elseif ( 'style2' === $settings['btn_style'] ) { ?>
                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn">
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                    <span class="icon"><?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?> </span>
                                </a>
                            <?php } elseif ( 'style3' === $settings['btn_style'] ) { ?>
                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn btn-text-flip">
                                    <span data-text="<?php echo esc_html( $settings['btn_text'] ); ?>">
                                        <?php echo esc_html( $settings['btn_text'] ); ?>
                                    </span>
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </a>
                            <?php } elseif ( 'style4' === $settings['btn_style'] ) { ?>
                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-primary btn-hover">
                                    <span></span>
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                    
                                </a>
                            <?php } elseif ( 'style5' === $settings['btn_style'] ) { ?>
                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-group">
                                    <span class="wc-btn-play">
                                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                    <span class="wc-btn-primary">
                                        <?php echo esc_html( $settings['btn_text'] ); ?>
                                    </span>
                                    <span class="wc-btn-play">
                                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                </a>
                            <?php } elseif ( 'style6' === $settings['btn_style'] ) { ?>
                                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-group">
                                    <span class="wc-btn-play">
                                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                    <span class="wc-btn-primary">
                                        <?php echo esc_html( $settings['btn_text'] ); ?>
                                    </span>
                                    <span class="wc-btn-play">
                                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
                // price button placed new end
                ?>

            </div>
            <?php                
                if( $block_type === 'standard' && $block_style === 'alt' ) { ?>
                    <div class="price-item-image-block"></div>
                <?php }
            ?>
        </div>


      <?php
    }
}
