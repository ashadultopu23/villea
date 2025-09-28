<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined('ABSPATH') || die();

class Themephi_Image_Tab_Gallery_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'tp-image-tab-gallery';
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
	public function get_title()
	{
		return esc_html__('Image Tab Gallery', 'tp-elements');
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
	public function get_icon()
	{
		return 'glyph-icon flaticon-menu';
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
	public function get_categories()
	{
		return ['pielements_category'];
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
	public function get_keywords()
	{
		return ['banner', 'image', 'hover', 'tab', 'gallery'];
	}



	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('General', 'tp-elements'),
			]
		);
		$this->add_control(
			'feature_style',
			[
				'label'   => esc_html__('Select Style', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => 'Style 1',
					'style2' => 'Style 2',
				],
			]
		);

		$this->add_control(
			'hover_content_style',
			[
				'label' => esc_html__('Hover Content Style', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'content_style1',
				'options' => [
					'content_style1' => esc_html__('Style 1', 'tp-elements'),
					'content_style2' => esc_html__('Style 2', 'tp-elements'),
					'content_style3' => esc_html__('Style 3', 'tp-elements'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'repeater',
			[
				'label' => esc_html__('Repeater', 'tp-elements')
			]
		);

		// Repeater for style one
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__('Title', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('List Title', 'tp-elements'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'list_repeater',
			[
				'label' => esc_html__('Feature List', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__('Title #1', 'tp-elements'),

					],
				],
				'title_field' => '{{{ list_title }}}',
				'condition' => [
					'feature_style' => 'style1',
				]
			]
		);

		// Repeater for style two
		$repeater2 = new \Elementor\Repeater();

		$repeater2->add_control(
			'feature_title',
			[
				'label' => esc_html__('Title', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Feature Title', 'tp-elements'),
				'placeholder' => esc_html__('Enter feature title', 'tp-elements'),
			]
		);

		$repeater2->add_control(
			'feature_description',
			[
				'label' => esc_html__('Description', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Feature description goes here...', 'tp-elements'),
				'placeholder' => esc_html__('Enter feature description', 'tp-elements'),
			]
		);

		$repeater2->add_control(
			'feature_icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater2->add_control(
			'hover_image',
			[
				'label' => esc_html__('Hover Image', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'features_list',
			[
				'label' => esc_html__('Features List', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'feature_title' => esc_html__('Free High Speed Wi-Fi', 'tp-elements'),
						'feature_description' => esc_html__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'tp-elements'),
						'feature_icon' => ['value' => 'fas fa-wifi', 'library' => 'fa-solid'],
					],
					[
						'feature_title' => esc_html__('Washer–Dryer System', 'tp-elements'),
						'feature_description' => esc_html__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'tp-elements'),
						'feature_icon' => ['value' => 'fas fa-tshirt', 'library' => 'fa-solid'],
					],
					[
						'feature_title' => esc_html__('Parking Space Place', 'tp-elements'),
						'feature_description' => esc_html__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'tp-elements'),
						'feature_icon' => ['value' => 'fas fa-car', 'library' => 'fa-solid'],
					],
					[
						'feature_title' => esc_html__('Swimming Pool', 'tp-elements'),
						'feature_description' => esc_html__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'tp-elements'),
						'feature_icon' => ['value' => 'fas fa-swimmer', 'library' => 'fa-solid'],
					],
				],
				'title_field' => '{{{ feature_title }}}',
				'condition' => [
					'feature_style' => 'style2',
				]
			]
		);

		$this->end_controls_section();

		// style one - tab design
		$this->start_controls_section(
			'tab_design_style',
			[
				'label' => esc_html__('Tab Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'feature_style' => 'style1',
				]
			]
		);
		$this->add_responsive_control(
			'tab_wrap',
			[
				'label' => esc_html__('Tabs Wrap', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'nowrap',
				'options' => [
					'nowrap' => esc_html__('No Wrap', 'tp-elements'),
					'wrap' => esc_html__('Wrap', 'tp-elements'),
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-tab .gallery-feature-tab-container ' => 'flex-wrap: {{VALUE}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'tab_spacing',
			[
				'label' => esc_html__('Space between Tabs', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-tab .gallery-feature-tab-container ' => 'gap: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'image_tab_width',
			[
				'label' => esc_html__('Image Width', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-tab-container .gallery-feature-tab-image' => 'width: {{SIZE}}{{UNIT}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'gallery_tab_width',
			[
				'label' => esc_html__('List Width', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-tab-items' => 'width: {{SIZE}}{{UNIT}} !important;',
				]
			]
		);
		$this->end_controls_section();

		// style two - hover design
		$this->start_controls_section(
			'hover_design_style',
			[
				'label' => esc_html__('Hover Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'feature_style' => 'style2',
				]
			]
		);


		$this->add_responsive_control(
			'number_max_width',
			[
				'label' => esc_html__('Number Max Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-number-wrapper' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'number_width',
			[
				'label' => esc_html__('Number Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-number-wrapper' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => esc_html__('Content Max Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-content-wrapper' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'hover_content_style' => ['content_style1', 'content_style2'],
				]
			]
		);
		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__('Content Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-content-wrapper' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'hover_content_style' => ['content_style1', 'content_style2'],
				]
			]
		);

		$this->add_responsive_control(
			'content_title_width',
			[
				'label' => esc_html__('Content Title Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-content.title-wrapper' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'hover_content_style' => 'content_style3',
				]
			]
		);

		$this->add_responsive_control(
			'content_description_width',
			[
				'label' => esc_html__('Content Description Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-content.description-wrapper' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'hover_content_style' => 'content_style3',
				]
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__('Icon Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-icon-wrapper' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'hover_image_item_align',
			[
				'label' => esc_html__('Justify', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Start', 'plugin-name'),
						'icon' => 'eicon-justify-end-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'plugin-name'),
						'icon' => 'eicon-justify-center-h',
					],
					'end' => [
						'title' => esc_html__('End', 'plugin-name'),
						'icon' => 'eicon-justify-start-h',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'plugin-name'),
						'icon' => 'eicon-justify-space-between-h',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items.gallery-image-hover .gallery-feature-item' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'hover_style_content_gap',
			[
				'label' => esc_html__('Content Spacing', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items.gallery-image-hover .gallery-feature-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'hover_style_item_gap',
			[
				'label' => esc_html__('Item Spacing', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items.gallery-image-hover' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__('Image Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'enable_hover_image',
			[
				'label' => esc_html__('Enable Hover Images', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('If you want to show hover images, then enable this option.', 'tp-elements'),
				'condition' => [
					'feature_style' => 'style2',
				]
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .gallery-feature-tab-image .img_border',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-tab-image .img_border,
					{{WRAPPER}} .gallery-feature-tab-image .img_border img, {{WRAPPER}} .gallery-hover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_rotation',
			[
				'label' => esc_html__('Image Rotation', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-tab-image .img_border img, {{WRAPPER}} .gallery-hover-image, {{WRAPPER}} .gallery-hover-image-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);


		$this->add_control(
			'hover_image_width',
			[
				'label' => esc_html__('Image Width', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-hover-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_image_height',
			[
				'label' => esc_html__('Image Height', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-hover-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_style',
			[
				'label' => esc_html__('Items Style', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_bgcolor',
			[
				'label' => esc_html__('background', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'card_active_bgcolor',
			[
				'label' => esc_html__('Hover / Active background', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item:hover, {{WRAPPER}} .gallery-feature-items .gallery-feature-item.active' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .gallery-feature-items .gallery-feature-item',
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



		// Title Style Tab
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('Title', 'tp-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'tp-elements'),
				'name'     => 'title_typ',
				'selector' => '{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-title',

			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label'     => esc_html__('Hover /  Active Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item:hover .gallery-feature-item-title, {{WRAPPER}} .gallery-feature-items .gallery-feature-item.active .gallery-feature-item-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		// Description Style Tab
		$this->start_controls_section(
			'description_style',
			[
				'label' => esc_html__('Description', 'tp-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .feature-content p, {{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#5a5a5a',
				'selectors' => [
					'{{WRAPPER}} .feature-content p, {{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .feature-content p, {{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_max_width',
			[
				'label' => esc_html__('Max Width', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 800,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-content p, {{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-description' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Icon Style Tab
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 16,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_box_size',
			[
				'label' => esc_html__('Box Size', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon svg' => 'fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__('Border', 'plugin-name'),
				'selector' => '{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-icon',
			]
		);

		$this->end_controls_section();

		// Count Style Tab
		$this->start_controls_section(
			'number_style',
			[
				'label' => esc_html__('Numbers', 'tp-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_numbers',
			[
				'label' => esc_html__('Show Numbers', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'tp-elements'),
				'label_off' => esc_html__('Hide', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'tp-elements'),
				'name'     => 'count_typ',
				'selector' => '{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-index',
				'condition' => [
					'show_numbers' => 'yes',
				],
			]
		);

		$this->add_control(
			'count_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item .gallery-feature-item-index' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'show_numbers' => 'yes',
				],
			]
		);

		$this->add_control(
			'count_active_color',
			[
				'label'     => esc_html__('Hover /  Active Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-feature-items .gallery-feature-item:hover .gallery-feature-item-index, {{WRAPPER}} .gallery-feature-items .gallery-feature-item.active .gallery-feature-item-index' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'show_numbers' => 'yes',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$sstyle = $settings['feature_style'];

		if ($sstyle) {
			require_once plugin_dir_path(__FILE__) . "/$sstyle.php";
		} else {
			require_once plugin_dir_path(__FILE__) . "/style1.php";
		}
	}
}
