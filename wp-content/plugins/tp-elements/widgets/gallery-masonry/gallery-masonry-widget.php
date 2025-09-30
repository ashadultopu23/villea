<?php

/**
 * Elementor rsgallery Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined('ABSPATH') || die();

class Themephi_Elementor_Gallery_Masonry_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'tp-gallery-masonry';
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
		return esc_html__('TP Gallery Masonry', 'tp-elements');
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
		return 'glyph-icon flaticon-attach';
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
		return ['tpaddon_category'];
	}

	public function get_keywords()
	{
		return ['gallery', 'image', 'photos', 'portfolio', 'isotope', 'filter', 'masonry'];
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
				'label' => esc_html__('Item', 'tp-elements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'gallery_style',
			[
				'label'   => esc_html__('Gallery Style', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => 'Style One',
					// 'style2' => 'Style Two',
					// 'style3' => 'Style Three',
					// 'style4' => 'Style Four',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Gallery Title', 'tp-elements'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'tp-elements'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'tp-elements'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'tp-elements'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'category',
			[
				'label' => esc_html__('Category', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Category', 'tp-elements'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'rs-gallery',
			[
				'label' => esc_html__('Gallery Items', 'tp-elements'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__('Gallery Title #1', 'tp-elements'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label'   => esc_html__('Show Filter', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_hide',
				'separator' => 'before',
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',
				],
			]
		);

		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__('Filter Default Title', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => __('All', 'tp-elements'),
				'condition' => [
					'show_filter' => 'filter_show',
				],

				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
				'separator' => 'before',
				'exclude' => [
					'custom'
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_type',
			[
				'label' => esc_html__('Content', 'tp-elements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'gallery_content_type',
			[
				'label' => esc_html__('Content Type', 'tp-elements'),
				'type' => Controls_Manager::SELECT,
				'default' => 'without_content',
				'options' => [
					'without_content' => esc_html__('Without Content', 'tp-elements'),
					'with_content' => esc_html__('With Content', 'tp-elements'),
					'both_content' => esc_html__('Both Content', 'tp-elements'),
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'gallery_align',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .masonry-gallery-item-content' => 'text-align: {{VALUE}}'
				],
				'separator' => 'before',
				'condition' => [
					'gallery_content_type' => ['with_content', 'both_content'],
				],
			]
		);

		$this->add_control(
			'gallery_popup_type',
			[
				'label' => esc_html__('Popup Type', 'tp-elements'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon_with_popup',
				'options' => [
					'icon_with_popup' => esc_html__('Icon With Popup', 'tp-elements'),
					'icon_with_link' => esc_html__('Icon With Link', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_content_type' => ['without_content', 'both_content'],
				],
			]
		);

		$this->add_control(
			'gallery_icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'separator' => 'before',
				'condition' => [
					'gallery_content_type' => ['without_content', 'both_content'],
				],
			]
		);

		$this->add_control(
			'gallery_cat_show_hide',
			[
				'label' => esc_html__('Category Show / Hide', 'tp-elements'),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__('Yes', 'tp-elements'),
					'no' => esc_html__('No', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_content_type' => ['with_content', 'both_content'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Button', 'tp-elements'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'gallery_content_type' => ['with_content', 'both_content'],
				],
			]
		);
		$this->add_control(
			'gallery_btn_show_hide',
			[
				'label' => esc_html__('Button Show / Hide', 'tp-elements'),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__('Yes', 'tp-elements'),
					'no' => esc_html__('No', 'tp-elements'),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'gallery_btn_text',
			[
				'label' => esc_html__('Services Button Text', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('View More', 'tp-elements'),
				'placeholder' => esc_html__('Services Button Text', 'tp-elements'),
				'separator' => 'before',
				'condition' => [
					'gallery_btn_show_hide' => ['yes'],
				],
			]
		);

		$this->add_control(
			'gallery_btn_link_open',
			[
				'label'   => esc_html__('Link Open New Window', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__('No', 'tp-elements'),
					'yes' => esc_html__('Yes', 'tp-elements'),
				],
				'condition' => [
					'gallery_btn_show_hide' => ['yes'],
				],
			]
		);

		$this->add_control(
			'gallery_btn_icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'separator' => 'before',
				'condition' => [
					'gallery_btn_show_hide' => ['yes'],
				],
			]
		);

		$this->add_control(
			'gallery_btn_icon_position',
			[
				'label' => esc_html__('Icon Position', 'tp-elements'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'before' => [
						'title' => esc_html__('Before', 'tp-elements'),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After', 'tp-elements'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'after',
				'toggle' => false,
				'condition' => [
					'gallery_btn_icon!' => '',
					'gallery_btn_show_hide' => ['yes'],
				],
			]
		);

		$this->add_control(
			'gallery_btn_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,

				'condition' => [
					'gallery_btn_icon!' => '',
					'gallery_btn_show_hide' => ['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_setting',
			[
				'label' => esc_html__('Settings', 'tp-elements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gallery_columns_system',
			[
				'label'   => esc_html__('Select Column Type', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Natural Width', 'tp-elements'),
					'column_width' => esc_html__('Column Width', 'tp-elements')
				],
			]
		);

		$this->add_control(
			'col_xl',
			[
				'label'   => esc_html__('Desktops > 1399px', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 4,
				'options' => [
					'1' => esc_html__('1 Column', 'tp-elements'),
					'2' => esc_html__('2 Column', 'tp-elements'),
					'3' => esc_html__('3 Column', 'tp-elements'),
					'4' => esc_html__('4 Column', 'tp-elements'),
					'5' => esc_html__('5 Column', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_columns_system' => 'column_width',
				],
			]

		);

		$this->add_control(
			'col_lg',
			[
				'label'   => esc_html__('Desktops > 1199px', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					'1' => esc_html__('1 Column', 'tp-elements'),
					'2' => esc_html__('2 Column', 'tp-elements'),
					'3' => esc_html__('3 Column', 'tp-elements'),
					'4' => esc_html__('4 Column', 'tp-elements'),
					'5' => esc_html__('5 Column', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_columns_system' => 'column_width',
				],
			]

		);

		$this->add_control(
			'col_md',
			[
				'label'   => esc_html__('Desktops > 991px', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					'1' => esc_html__('1 Column', 'tp-elements'),
					'2' => esc_html__('2 Column', 'tp-elements'),
					'3' => esc_html__('3 Column', 'tp-elements'),
					'4' => esc_html__('4 Column', 'tp-elements'),
					'5' => esc_html__('5 Column', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_columns_system' => 'column_width',
				],
			]

		);

		$this->add_control(
			'col_sm',
			[
				'label'   => esc_html__('Tablets > 767px', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					'1' => esc_html__('1 Column', 'tp-elements'),
					'2' => esc_html__('2 Column', 'tp-elements'),
					'3' => esc_html__('3 Column', 'tp-elements'),
					'4' => esc_html__('4 Column', 'tp-elements'),
					'5' => esc_html__('5 Column', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_columns_system' => 'column_width',
				],
			]
		);

		$this->add_control(
			'col_xs',
			[
				'label'   => esc_html__('Tablets < 768px', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					'1' => esc_html__('1 Column', 'tp-elements'),
					'2' => esc_html__('2 Column', 'tp-elements'),
					'3' => esc_html__('3 Column', 'tp-elements'),
					'4' => esc_html__('4 Column', 'tp-elements'),
					'5' => esc_html__('5 Column', 'tp-elements'),
				],
				'separator' => 'before',
				'condition' => [
					'gallery_columns_system' => 'column_width',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_gallery_item_style',
			[
				'label' => esc_html__('gallery Item', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'gallery_item_column_gap_switch',
			[
				'label' => esc_html__('Enable Column Gap?', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'tp-elements'),
				'label_off' => esc_html__('Hide', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'gallery_item_margin_top',
			[
				'label' => esc_html__('Item Margin Top', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-5 .col:nth-child(1), {{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-5 .col:nth-child(3), {{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-5 .col:nth-child(5)' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-4 .col:nth-child(1), {{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-4 .col:nth-child(3)' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-3 .col:nth-child(1), {{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-3 .col:nth-child(3)' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-gallery-stylestyle2 .grid .row.row-cols-xl-2 .col:nth-child(1)' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'gallery_style' => ['style2'],
				],
			]
		);

		$this->add_responsive_control(
			'gallery_item_margin',
			[
				'label' => esc_html__('Item Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .masonry-gallery-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_item__padding',
			[
				'label' => esc_html__('Item Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tp-gallery-stylestyle1 .masonry-gallery-item .masonry-gallery-item-content, {{WRAPPER}} .tp-gallery-stylestyle2 .masonry-gallery-item .masonry-gallery-item-content, {{WRAPPER}} .tp-gallery-stylestyle3 .masonry-gallery-item .masonry-gallery-item-content, {{WRAPPER}} .tp-gallery-stylestyle3 .masonry-gallery-item .gallerys-btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_gallery_content_style',
			[
				'label' => esc_html__('gallery Content', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gallery_content_margin',
			[
				'label' => esc_html__('Content Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .masonry-gallery-item .masonry-gallery-item-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_content__padding',
			[
				'label' => esc_html__('Content Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .masonry-gallery-item .masonry-gallery-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_gallery_style',
			[
				'label' => esc_html__('Filter Button', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'filter_btn_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'filter_btn__padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_btn_typography',
				'selector' => '{{WRAPPER}} .gallery-filter button',
			]
		);

		$this->add_responsive_control(
			'filter_btn_align',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .gallery-filter' => 'text-align: {{VALUE}}'
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hr_fitler_btn',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('tabs_filter_btn');

		$this->start_controls_tab(
			'tab_filter_btn_normal',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'filter_btn_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'filter_btn_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'filter_btn_button_border',
				'selector' => '{{WRAPPER}} .gallery-filter button',
			]
		);

		$this->add_control(
			'filter_btn_button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'filter_btn_button_box_shadow',
				'selector' => '{{WRAPPER}} .gallery-filter button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_filter_btn_hover',
			[
				'label' => esc_html__('Hover/Active', 'tp-elements'),
			]
		);

		$this->add_control(
			'filter_btn_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button:hover, {{WRAPPER}} .gallery-filter button.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'filter_btn_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button:hover, {{WRAPPER}}.gallery-filter button.active' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'filter_btn_hover_border',
				'selector' => '{{WRAPPER}} .gallery-filter button:hover, {{WRAPPER}} .gallery-filter button.active',
			]
		);

		$this->add_control(
			'filter_btn_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-filter button:hover, {{WRAPPER}} .gallery-filter button.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'filter_btn_hover_box_shadow',
				'selector' => '{{WRAPPER}} .gallery-filter button:hover, {{WRAPPER}} .gallery-filter button.active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_button',
			[
				'label' => esc_html__('Popup Button', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'popup_btn_typography',
				'selector' => '{{WRAPPER}} span.popup-icon',
			]
		);

		$this->add_responsive_control(
			'popup_btn__padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} span.popup-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->start_controls_tabs('tabs_popup_button');

		$this->start_controls_tab(
			'style_popup_tab',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'popup_text_color',
			[
				'label' => esc_html__('Icon Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.popup-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'popup_background_normal',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} span.popup-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'popup_button_border',
				'selector' => '{{WRAPPER}} span.popup-icon',
			]
		);

		$this->add_control(
			'popup_button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} span.popup-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'popup_button_box_shadow',
				'selector' => '{{WRAPPER}} span.popup-icon',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_popup_hover_tab',
			[
				'label' => esc_html__('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'popup_text_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.popup-icon:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'popup_hover_background',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} span.popup-icon:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'popup_button_hover_border',
				'selector' => '{{WRAPPER}} span.popup-icon:hover',
			]
		);

		$this->add_control(
			'popup_button_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} span.popup-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'popup_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} span.popup-icon:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__('Image', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_background_overlay',
				'label' => esc_html__('Background Overlay', 'tp-elements'),
				'types' => ['classic', 'gradient', 'tp-elements'],
				'selector' => '{{WRAPPER}} .masonry-gallery-item-image::before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_btn',
			[
				'label' => esc_html__('Category', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_btn_typography',
				'selector' => '{{WRAPPER}} .gallery-cat a',
			]
		);

		$this->add_responsive_control(
			'category_btn__padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-cat a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->start_controls_tabs('tabs_category_button');

		$this->start_controls_tab(
			'style_category_tab',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'category_text_color',
			[
				'label' => esc_html__('Icon Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-cat a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'category_background_normal',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} .gallery-cat a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'category_button_border',
				'selector' => '{{WRAPPER}} .gallery-cat a',
			]
		);

		$this->add_control(
			'category_button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-cat a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_button_box_shadow',
				'selector' => '{{WRAPPER}} .gallery-cat a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_category_hover_tab',
			[
				'label' => esc_html__('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'category_text_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-cat a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'category_hover_background',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} .gallery-cat a:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'category_button_hover_border',
				'selector' => '{{WRAPPER}} .gallery-cat a:hover',
			]
		);

		$this->add_control(
			'category_button_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallery-cat a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .gallery-cat a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Title', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gallery-title a',
			]
		);

		$this->add_responsive_control(
			'title__margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->start_controls_tabs('tabs_title_button');

		$this->start_controls_tab(
			'style_title_tab',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__('Title Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-title a, {{WRAPPER}} .gallery-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_button_border',
				'selector' => '{{WRAPPER}} .gallery-title a, {{WRAPPER}} .gallery-title',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_title_hover_tab',
			[
				'label' => esc_html__('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'title_text_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-title a:hover, {{WRAPPER}} .gallery-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_button_hover_border',
				'selector' => '{{WRAPPER}} .gallery-title a:hover, {{WRAPPER}} .gallery-title:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__('Button', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'link_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn',
			]
		);

		$this->add_control(
			'hr_one',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('tabs_button');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.gallerys-btn-part .gallerys-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.gallerys-btn-part .gallerys-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon_translate',
			[
				'label' => esc_html__('Icon Translate X', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .gallerys-btn-part .gallerys-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_icon_translate',
			[
				'label' => esc_html__('Icon Translate X', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,

				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover .gallerys-btn-part .gallerys-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
					'{{WRAPPER}} .elementor-widget-container .gallerys-btn-part .gallerys-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
			'btn_text_only',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Button Text', 'tp-elements'),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'btn_text_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn .btn_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_text_typography',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn .btn_text',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_text_border',
				'selector' => '{{WRAPPER}} .services-btn .btn_text',
			]
		);

		$this->add_control(
			'btn_text_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn .btn_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_text_box_shadow',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn .btn_text',
			]
		);

		$this->add_control(
			'hr_two',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('tabs_btn_text');

		$this->start_controls_tab(
			'tab_btn_text_normal',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn .btn_text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_text_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn .btn_text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_text_hover',
			[
				'label' => esc_html__('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'btn_text_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover .btn_text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_text_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover .btn_text' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_text_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover .btn_text' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'button_icon_only',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Button Icon', 'tp-elements'),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'button_icon_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_icon_typography',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn i',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_icon_border',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn i',
			]
		);

		$this->add_control(
			'button_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_icon_box_shadow',
				'selector' => '{{WRAPPER}} .gallerys-btn-part .gallerys-btn i',
			]
		);

		$this->add_control(
			'hr_three',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('tabs_button_icon');

		$this->start_controls_tab(
			'tab_button_icon_normal',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_icon_hover',
			[
				'label' => esc_html__('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'button_icon_hover_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallerys-btn-part .gallerys-btn:hover i' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .gallerys-btn-part .gallerys-btn:hover i' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

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

		$sstyle = $settings['gallery_style'];

		if ($settings['gallery_item_column_gap_switch'] == 'yes') {
			$column_gap = '';
			$row_gap = 'mb-24';
		} else {
			$column_gap = 'g-0';
			$row_gap = '';
		}

		if ($settings['gallery_columns_system'] == 'auto') {
			$column_width = ' row-cols-auto ';
		} else {
			$column_width = ' row-cols-xl-' . $settings['col_xl'] . ' row-cols-lg-' . $settings['col_lg'] . ' row-cols-md-' . $settings['col_md'] . ' row-cols-sm-' . $settings['col_sm'] . ' row-cols-' . $settings['col_xs'] . '  ';
		}

		// Get all unique categories for filter
		$categories = [];
		if (!empty($settings['rs-gallery'])) {
			foreach ($settings['rs-gallery'] as $item) {
				if (!empty($item['category'])) {
					$categories[sanitize_title($item['category'])] = $item['category'];
				}
			}
		}

		if ($settings['show_filter'] == 'filter_show' && !empty($categories)) :
?>
			<div class="gallery-filter isotope-filter">
				<button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']); ?></button>
				<?php foreach ($categories as $slug => $category) : ?>
					<button data-filter=".filter_<?php echo esc_attr($slug); ?>"><?php echo esc_html($category); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="tp-gallery-<?php echo esc_attr($settings['gallery_style']); ?> grid-gallery">
			<div class="grid">
				<div class="row <?php echo esc_attr($column_width . ' ' . $column_gap); ?>">
					<?php
					if ($sstyle && file_exists(plugin_dir_path(__FILE__) . "/$sstyle.php")) {
						require_once plugin_dir_path(__FILE__) . "/$sstyle.php";
					} else {
						require_once plugin_dir_path(__FILE__) . "/style1.php";
					}
					?>
				</div>
			</div>
		</div>
<?php
	}
}
