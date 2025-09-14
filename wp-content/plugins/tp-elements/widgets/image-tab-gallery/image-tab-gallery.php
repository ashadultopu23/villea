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
				'label' => esc_html__('Select Style', 'tp-elements'),
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
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'heading',
			[
				'label' => esc_html__('Heading', 'tp-elements')
			]
		);
		$this->add_control(
			'default_image',
			[
				'label' => esc_html__('Default Image', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'label',
			[
				'label' => esc_html__('Label', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Steps', 'tp-elements'),
				'label_block' => true,
				'condition' => [
					'feature_style' => ['style1']
				]
			]
		);
		$this->add_control(
			'current_step',
			[
				'label' => esc_html__('Current Step', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('01', 'tp-elements'),
				'label_block' => true,
				'condition' => [
					'feature_style' => ['style1']
				]
			]
		);
		$this->add_control(
			'total_step',
			[
				'label' => esc_html__('Total Step', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('04', 'tp-elements'),
				'label_block' => true,
				'condition' => [
					'feature_style' => ['style1']
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'repeater',
			[
				'label' => esc_html__('Repeater', 'tp-elements')
			]
		);
		// Repeater
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
				'label' => esc_html__('Repeater List', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__('Title #1', 'tp-elements'),

					],
					[
						'list_title' => esc_html__('Title #2', 'tp-elements'),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'design_select',
			[
				'label' => esc_html__('Select Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'feature_design',
			[
				'label'     => esc_html__('Style', 'tp-elements'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'style_one',
				'options'   => [
					'style_one'      => esc_html__('Style One', 'tp-elements'),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'heading_style',
			[
				'label' => esc_html__('Heading Style', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_card',
			[
				'label' => esc_html__('Icon Card BG', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .opening-account-wrapper .opening-account-item .icon::after' => 'background: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .opening-account-wrapper .opening-account-item .icon::after',
			]
		);


		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__('Title', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'tp-elements'),
				'name'     => 'title_typ',
				'selector' => '{{WRAPPER}} .tp-box .title',

			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-box .title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'desc_heading',
			[
				'label' => esc_html__('Description', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'tp-elements'),
				'name'     => 'desc_typ',
				'selector' => '{{WRAPPER}} .tp-box .desc',

			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-box .desc' => 'color: {{VALUE}} !important;',
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


		if ('style1' == $settings['feature_style']) {
			require_once plugin_dir_path(__FILE__) . "/style1.php";
		}

?>

	<?php
	}
}
