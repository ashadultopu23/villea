<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

defined('ABSPATH') || die();


class Themephi_Elementor_Heading_Widget extends \Elementor\Widget_Base
{

	/*
	 *
	 * @since 1.0.0 
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'tp-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('TP Heading', 'tp-elements');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'glyph-icon flaticon-letter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['pielements_category'];
	}

	public function get_keywords()
	{
		return ['title, heading'];
	}

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Heading Info', 'tp-elements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'style',
			[
				'label'   => esc_html__('Select Heading Style', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'tp-elements'),
					'style1'  => esc_html__('Border Right', 'tp-elements'),
					'style2'  => esc_html__('Border Bottom', 'tp-elements'),
					'style3'  => esc_html__('Border Left', 'tp-elements'),
					'style4'  => esc_html__('Border Top', 'tp-elements'),
					'style6'  => esc_html__('Border Top Left', 'tp-elements'),
					'style7'  => esc_html__('Border Top Right', 'tp-elements'),
					'style8'  => esc_html__('Border Left Vertical Style', 'tp-elements'),
					'style9'  => esc_html__('Heading Image Style', 'tp-elements'),
					'style5'  => esc_html__('Heading Bracket Style', 'tp-elements'),
					'style10' => esc_html__('Heading Left Rotate Style', 'tp-elements'),
					'style11' => esc_html__('Heading Right Rotate Style', 'tp-elements'),
					'style12'  => esc_html__('Border Top Left Right', 'tp-elements'),
					'style13'  => esc_html__('Sub Heading Left Right Image', 'tp-elements'),
					'style14'  => esc_html__('Heading with Button', 'tp-elements'),
					'style15'  => esc_html__('Sub Heading with Dot', 'tp-elements'),

				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Heading Text', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Heading Style', 'tp-elements'),
				'separator' => 'before',
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__('Select Heading Tag', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__('H1', 'tp-elements'),
					'h2' => esc_html__('H2', 'tp-elements'),
					'h3' => esc_html__('H3', 'tp-elements'),
					'h4' => esc_html__('H4', 'tp-elements'),
					'h5' => esc_html__('H5', 'tp-elements'),
					'h6' => esc_html__('H6', 'tp-elements'),
				],
			]
		);


		$this->add_control(
			'title_pre_class',
			[
				'label'   => esc_html__('Select Heading Pre Class', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'display-four',
				'options' => [
					'display-one' => esc_html__('Display One', 'tp-elements'),
					'display-two' => esc_html__('Display Two', 'tp-elements'),
					'display-three' => esc_html__('Display Three', 'tp-elements'),
					'display-four' => esc_html__('Display Four', 'tp-elements'),
					'display-five' => esc_html__('Display Five', 'tp-elements'),
					'display-six' => esc_html__('Display Six', 'tp-elements'),
					'no-pre-class' => esc_html__('No Pre Class', 'tp-elements'),
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'enable_stroke',
			[
				'label' => esc_html__('Enable Title Stroke', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'enable_border',
			[
				'label' => esc_html__('Enable Title Bottom Border', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->add_control(
			'image-left-sub',
			[
				'label' => esc_html__('Choose Sub Heading Left Image', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style13',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'image-right-sub',
			[
				'label' => esc_html__('Choose Sub Heading Rihgt Image', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style13',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_subtitle',
			[
				'label' => esc_html__('Show Sub Title', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__('Sub Heading Text', 'tp-elements'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Sub Heading', 'tp-elements'),
				'condition' => [
					'show_subtitle' => 'yes',
				],
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Heading Image', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style9',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_position',
			[
				'label'   => esc_html__('Select Image Position', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' => esc_html__('Top', 'tp-elements'),
					'bottom' => esc_html__('Bottom', 'tp-elements'),

				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_position_width',
			[
				'label' => esc_html__('Image With', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '150',
				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .title-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_position_left_right',
			[
				'label' => esc_html__('Image Left/right Position', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -400,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',

				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .title-img img' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'show_watermark',
			[
				'label' => esc_html__('Show Watermark', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'watermark',
			[
				'label' => esc_html__('Watermark Text', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Watermark Text', 'tp-elements'),
				'label_block' => true,
				'separator' => 'before',
				'condition' => [
					'show_watermark' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_description',
			[
				'label' => esc_html__('Show Description', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'content',
			[
				'label'   => esc_html__('Description', 'tp-elements'),
				'type'    => Controls_Manager::WYSIWYG,
				'rows'    => 10,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_description',
							'value' => 'yes',
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'tp-elements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'tp-elements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'tp-elements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'tp-elements'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'tp-elements'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading' => 'text-align: {{VALUE}}'
				]
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_button',
			[
				'label' => esc_html__('Button Info', 'tp-elements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'show_button',
			[
				'label' => esc_html__('Show Button', 'tp-elements'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'tp-elements'),
				'label_off' => esc_html__('Hide', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Button Text', 'tp-elements'),
				'separator' => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_button',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style14',
						],
					],
				],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__(' Button Link', 'tp-elements'),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_button',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style14',
						],
					],
				],
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__('Show Icon', 'tp-elements'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'tp-elements'),
				'label_off' => esc_html__('Hide', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__('Heading Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Title', 'tp-elements'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'tp-elements'),
				'selector' => '{{WRAPPER}} .themephi-heading .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'enable_stroke!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'title_stroke',
			[
				'label' => esc_html__('Title Stroke', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					]
				],
				'default' => [
					'size' => 2,
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; stroke-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'enable_stroke' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_stroke_color',
			[
				'label' => esc_html__('Title Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .title' => ' -webkit-text-fill-color: {{VALUE}};',
				],
				'condition' => [
					'enable_stroke' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_stroke_border_color',
			[
				'label' => esc_html__('Title Text Border Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .title' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'condition' => [
					'enable_stroke' => 'yes',
					'enable_gradient!' => 'yes'
				]
			]
		);

		$this->add_control(
			'enable_gradient',
			[
				'label' => esc_html__('Enable Gradient', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_stroke' => 'yes'
				]
			]
		);

		$this->add_control(
			'gradient_color_1',
			[
				'label' => esc_html__('Gradient Color 1', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ff7e5f',
				'condition' => [
					'enable_stroke' => 'yes',
					'enable_gradient' => 'yes'
				]
			]
		);

		$this->add_control(
			'gradient_color_2',
			[
				'label' => esc_html__('Gradient Color 2', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#feb47b',
				'condition' => [
					'enable_stroke' => 'yes',
					'enable_gradient' => 'yes'
				]
			]
		);

		$this->add_control(
			'gradient_direction',
			[
				'label' => esc_html__('Direction (deg)', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 90,
				],
				'condition' => [
					'enable_stroke' => 'yes',
					'enable_gradient' => 'yes'
				]
			]
		);




		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		// water mark 
		$this->add_control(
			'watermark_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Watermark', 'tp-elements'),
				'separator' => 'before',
				'condition' => [
					'show_watermark' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'mark_position_zindex',
			[
				'label' => esc_html__('Watermark Z-Index', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 99,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 'px',

				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themephi-heading  span.watermark' => 'z-index: {{SIZE}};',
				],
				'condition' => [
					'show_watermark' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'mark_position_left_right',
			[
				'label' => esc_html__('Watermark Left/right Position', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themephi-heading  span.watermark' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_watermark' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'mark_position_top_bottom',
			[
				'label' => esc_html__('Watermark Top/Bottom Position', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themephi-heading  span.watermark' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_watermark' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'mark_width',
			[
				'label' => esc_html__('Watermark Text Custom Width', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',

				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themephi-heading span.watermark' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_watermark' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'watermark_typography',
				'label' => esc_html__('Watermark Typography', 'tp-elements'),
				'selector' => '{{WRAPPER}} .themephi-heading span.watermark',
				'condition' => [
					'show_watermark' => 'yes'
				]
			]
		);

		$this->add_control(
			'watermark_opacity',
			[
				'label' => esc_html__('Watermark Opacity', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 50, // 0.5 in a 0-100 scale
				],
				'range' => [
					'unitless' => [ // You need a unit key here, even if not used
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading span.watermark' => 'opacity: calc({{SIZE}} / 100);',
				],
				'condition' => [
					'show_watermark' => 'yes',
				],
			]
		);


		$this->add_responsive_control(
			'watermark_stroke',
			[
				'label' => esc_html__('Watermark Stroke', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					]
				],
				'default' => [
					'size' => 2,
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading span.watermark' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; stroke-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_watermark' => 'yes'
				]
			]
		);

		$this->add_control(
			'watermark_color',
			[
				'label' => esc_html__('Watermark Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading span.watermark' => ' -webkit-text-fill-color: {{VALUE}};',
				],
				'condition' => [
					'show_watermark' => 'yes'
				]
			]
		);

		$this->add_control(
			'watermark_border_color',
			[
				'label' => esc_html__('Watermark Text Border Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading span.watermark' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'condition' => [
					'show_watermark' => 'yes'
				]
			]
		);

		$this->end_controls_section();





		$this->start_controls_section(
			'section_sub_heading_style',
			[
				'label' => esc_html__('Sub Heading Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_subtitle' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Subtitle Typography', 'tp-elements'),
				'selector' => '{{WRAPPER}} .themephi-heading .sub-text',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Subtitle Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .sub-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_highlight_color',
			[
				'label' => esc_html__('Subtitle Highlight Background', 'tp-elements'),
				// 'desc' => esc_html__( 'Add span tag to apply background style', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .sub-text span' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__('Subtitle Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .sub-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'dots_style',
			[
				'label' => esc_html__('Dot Style', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => 'style15',
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => esc_html__('Dot Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .sub-text .sub-text-dot' => 'background: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style15',
				],
			]
		);

		$this->add_responsive_control(
			'dot_width',
			[
				'label'       => esc_html__('Width', 'plugin-name'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => ['px', '%'],  // Allow px and percentage units
				'description' => esc_html__('Choose width in px or %', 'plugin-name'),
				'selectors'   => [
					'{{WRAPPER}} .themephi-heading .sub-text .sub-text-dot' => 'width: {{SIZE}}{{UNIT}};', // Dynamic unit
				],
				'default'     => [
					'unit'  => 'px',  // Default unit is px
				],
				'condition' => [
					'style' => 'style15',
				]
			]
		);

		$this->add_responsive_control(
			'dot_height',
			[
				'label'       => esc_html__('Height', 'plugin-name'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => ['px', '%'],  // Allow px and percentage units
				'description' => esc_html__('Choose height in px or %', 'plugin-name'),
				'selectors'   => [
					'{{WRAPPER}} .themephi-heading .sub-text .sub-text-dot' => 'height: {{SIZE}}{{UNIT}};', // Dynamic unit
				],
				'default'     => [
					'unit'  => 'px',  // Default unit is px
				],
				'condition' => [
					'style' => 'style15',
				]
			]
		);

		$this->add_responsive_control(
			'dot_margin',
			[
				'label' => esc_html__('Dot Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .sub-text .sub-text-dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'style15',
				]
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_description_style',
			[
				'label' => esc_html__('Description Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__('Description Typography', 'tp-elements'),
				'selector' => '{{WRAPPER}} .themephi-heading .description p',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__('Description Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-heading .description p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-heading .description p a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'desc_color_strong',
			[
				'label' => esc_html__('Description Strong Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .description strong' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-heading .description p strong' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_sec_typography',
				'label' => esc_html__('Description Strong Typography', 'tp-elements'),
				'selector' => '{{WRAPPER}} .themephi-heading .description strong',
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label' => esc_html__('Description Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__('Description Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'desc_background',
				'label' => esc_html__('Description Background', 'tp-elements'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],

				'selector' => '{{WRAPPER}} .themephi-heading.style2:after',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
				'condition' => [
					'style' => 'style2',
				],
			]
		);



		$this->end_controls_section();



		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'show_button',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style14',
						],
					],
				],
			]
		);


		$this->add_responsive_control(
			'btn_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_hover_color',
			[
				'label' => esc_html__('Hover Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_hover_bg_color',
			[
				'label' => esc_html__('Hover Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a::before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_text_typography',
				'selector' => '{{WRAPPER}} .themephi-heading .tp-button a',
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'plugin-name'),
				'selector' => '{{WRAPPER}} .themephi-heading .tp-button a',
			]
		);



		$this->add_responsive_control(
			'btn_icon_styles',
			[
				'label' => esc_html__('Button Icon Styles', 'tp-elements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'btn_icon_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_hover_color',
			[
				'label' => esc_html__('Hover Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a:hover i' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'btn_icon_bg_color',
			[
				'label' => esc_html__('Backgorund Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a i' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_hover_bg_color',
			[
				'label' => esc_html__('Hover Backgorund Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a:hover i' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_iocn_typography',
				'selector' => '{{WRAPPER}} .themephi-heading .tp-button a i',
			]
		);

		$this->add_responsive_control(
			'btn_icon_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-heading .tp-button a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'tp-elements'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);


		$this->end_controls_section();



		$this->start_controls_section(
			'_section_style_animation',
			[
				'label' => esc_html__('AOS Animation', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'enable_animation',
			[
				'label' => esc_html__('Enable Animation', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'yes',

			]
		);

		$this->add_control(
			'animation_style',
			[
				'label' => esc_html__('Animation Type', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide-up',
				'options' => [
					'fade'  => esc_html__('Fade', 'tp-elements'),
					'slide-up'  => esc_html__('Slide Up', 'tp-elements'),
					'slide-down'  => esc_html__('Slide Down', 'tp-elements'),
					'slide-left' => esc_html__('Slide Left', 'tp-elements'),
					'slide-right' => esc_html__('Slide Right', 'tp-elements'),

				],
				'condition' => [
					'enable_animation' =>  'yes'
				]

			]
		);

		$this->add_control(
			'data_delay',
			[
				'label' => esc_html__('Data Delay', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('150', 'tp-elements'),
				'condition' => [
					'enable_animation' =>  'yes'
				]

			]
		);


		$this->add_control(
			'data_duration',
			[
				'label' => esc_html__('Data Duration', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('800', 'tp-elements'),
				'condition' => [
					'enable_animation' =>  'yes'
				]
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{

		$settings = $this->get_settings_for_display();
		if ($settings['enable_animation'] == 'yes') {
			$animate_img = 'data-aos-delay="100" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true"';
			$animate = 'data-aos-delay="100" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true"';
			$animate_sub = 'data-aos-delay="150" data-aos="fade-up" data-aos-duration="700" data-aos-once="true"';
			$animate_des = 'data-aos-delay="200" data-aos="fade-up" data-aos-duration="1200" data-aos-once="true"';
			$animate_btn = 'data-aos-delay="250" data-aos="fade-up" data-aos-duration="1500" data-aos-once="true"';
		} else {
			$animate = '';
			$animate_sub = '';
			$animate_des = '';
			$animate_img = '';
			$animate_btn = '';
		}

		$color_1 = '';
		$color_2 = '';
		$direction = '';
		$selector = '';

		if ($settings['enable_gradient'] === 'yes') {
			$color_1 = !empty($settings['gradient_color_1']) ? $settings['gradient_color_1']  : '#ff7e5f';
			$color_2 = !empty($settings['gradient_color_2']) ? $settings['gradient_color_2'] : '#feb47b';
			$direction = isset($settings['gradient_direction']['size']) ? $settings['gradient_direction']['size'] : 90;
			$selector = '.elementor-element-' . esc_attr($this->get_id()) . ' .title.title-stroke.title-gradient';
		}
?>
		<style>
			<?php echo $selector; ?> {
				background: linear-gradient(<?php echo esc_attr($direction); ?>deg, <?php echo esc_attr($color_1); ?>, <?php echo esc_attr($color_2); ?>);
				background-clip: text;
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
				-webkit-text-stroke-width: 2px;
				-webkit-text-stroke-color: transparent !important;
			}
		</style>

		<?php


		$watermark_text = (($settings['show_watermark'] == 'yes') && $settings['watermark']) ? '<span class="watermark">' . ($settings['watermark']) . '</span>' : '';

		$title_stroke = ($settings['enable_stroke'] == 'yes') ? 'title-stroke' : '';
		$stroke_gradient = ($settings['enable_gradient'] == 'yes') ? 'title-gradient' : '';

		$main_title     = ($settings['title']) ? '<' . $settings['title_tag'] . ' class="title ' . $settings['title_pre_class'] . ' ' . $title_stroke . ' ' . $stroke_gradient . ' " ' . $animate . '>' . $settings['title'] . '</' . $settings['title_tag'] . '>' : '';

		if ($settings['show_subtitle'] == 'yes' &&  "style4"    ==	$settings['style'] || "style4 Lite" == $settings['style'] || "style6" == $settings['style'] || "style6 Lite" == $settings['style'] || "style7" == $settings['style'] || "style7 Lite" == $settings['style']) {
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text" ' . $animate_sub . '>' . ($settings['subtitle']) . '</span>' : '';
		} elseif ($settings['show_subtitle'] == 'yes' && "style5" == $settings['style']) {
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text title-upper" ' . $animate_sub . '>[ <span class="sub-text title-upper">' . ($settings['subtitle']) . '</span> ] </span>' : '';
		} elseif (($settings['style'] == 'style15')) {
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text" ' . $animate_sub . '>' . ' <span class="sub-text-dot"></span> ' . ($settings['subtitle']) . '</span>' : '';
		} else {
			$sub_text  = ($settings['show_subtitle'] == 'yes' && $settings['subtitle'])  ? '<span class="sub-text" ' . $animate_sub . '>' . ($settings['subtitle']) . '</span>' : '';
		}
		$titleimg    = $settings['image'] ? '<img src="' . $settings['image']['url'] . '" alt="title-image" />' : '';
		$topimage    = $settings['image_position'] == 'top' ? '<div class="title-img top" ' . $animate_img . '> ' . $titleimg . '</div>' : "";
		$bottomimage = $settings['image_position'] == 'bottom' ? '<div class="title-img bottom-img">' . $titleimg . '</div>' : "";

		if ("style9" == $settings['style']) {
			$main_title     = ($settings['title']) ? '<' . $settings['title_tag'] . ' class="title ' . $settings['title_pre_class'] . '" ' . $animate . '>' . $watermark_text . '' . ($settings['title']) . '</' . $settings['title_tag'] . '>' : '';
		}


		if ("style13" == $settings['style']) {
			$sub_left_image = $settings['image-left-sub']['url'] ? '<img  class = "line-1-img" src="' . $settings['image-left-sub']['url'] . '" alt="title-image" />' : '';
			$sub_right_image = $settings['image-right-sub']['url'] ? '<img class = "line-2-img" src="' . $settings['image-right-sub']['url'] . '" alt="title-image" />' : '';
			$sub_text  =   '<div class="sub-content">' . $sub_left_image . $sub_text . $sub_right_image . '</div>';
		}

		?>

		<div class="themephi-heading <?php echo esc_attr($settings['style']); ?> title-border-<?php echo $settings['enable_border']; ?>">

			<?php

			if ($settings['image_position'] == 'top') {
				echo wp_kses($topimage ?? '', wp_kses_allowed_html('post'));
			}
			echo wp_kses($sub_text ?? '', wp_kses_allowed_html('post'));

			echo wp_kses($main_title ?? '', wp_kses_allowed_html('post'));

			if ($settings['image_position'] == 'bottom') {
				echo wp_kses($bottomimage ?? '', wp_kses_allowed_html('post'));
			}
			?>

			<?php echo $watermark_text; ?>

			<?php if ($settings['show_description'] == 'yes' && $settings['content']) {
				$this->add_inline_editing_attributes('content', 'advanced');
				$this->add_render_attribute('content', 'class', 'description'); ?>
				<div <?php echo $this->print_render_attribute_string('content'); ?> <?php echo $animate_des; ?>>
					<?php echo wp_kses($settings['content'], wp_kses_allowed_html('post')); ?>
				</div>
			<?php } ?>

			<?php if (!empty($settings['btn_text'])): ?>

				<div class="tp-button" <?php echo $animate_btn; ?>>

					<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : ''; ?>
					<a class="readon themephi_button elementor-animation-<?php echo esc_html($settings['hover_animation']); ?>" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>

						<!-- <span <?php echo wp_kses($this->print_render_attribute_string('btn_text') ?? '', wp_kses_allowed_html('post')); ?>> -->

						<?php echo esc_html($settings['btn_text']); ?></span>

						<?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
					</a>

				</div>
			<?php endif; ?>
		</div>
<?php
	}
} ?>