<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined('ABSPATH') || die();

class Themephi_StepCountBox_Widget extends \Elementor\Widget_Base
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
		return 'step-count-box';
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
		return esc_html__('Step Count Box', 'tp-elements');
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
		return ['counter', 'step', 'box', 'count', 'number'];
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
		/**
		 * General Section
		 */
		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__('General', 'tp-elements'),
			]
		);

		$this->add_control(
			'notice_step_class',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('<strong>Important:</strong> Please add the class <code>step-count-box</code> to the section or container that holds your steps. This is required for the progress counter to work properly.', 'tp-elements'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'label',
			[
				'label' => esc_html__('Label', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Steps', 'tp-elements'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'current_step',
			[
				'label' => esc_html__('Current Step', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('01', 'tp-elements'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'total_step',
			[
				'label' => esc_html__('Total Step', 'tp-elements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('04', 'tp-elements'),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		/**
		 * Label Style
		 */
		$this->start_controls_section(
			'section_label_style',
			[
				'label' => esc_html__('Label', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .step-circle_box .inner_circle p',
			]
		);

		$this->end_controls_section();

		/**
		 * Number Style (h2, steps)
		 */
		$this->start_controls_section(
			'section_number_style',
			[
				'label' => esc_html__('Number', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'current_number_color',
			[
				'label' => esc_html__('Current Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle .current-count-step' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'total_number_color',
			[
				'label' => esc_html__('Total Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle .total-count-step' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_divider_color',
			[
				'label' => esc_html__('Separator Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle .count-separator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .step-circle_box .inner_circle h2',
			]
		);

		$this->end_controls_section();

		/**
		 * Circle Wrapper Style
		 */
		$this->start_controls_section(
			'section_circle_style',
			[
				'label' => esc_html__('Circle Box', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'circle_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .step-circle_box',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'circle_border',
				'selector' => '{{WRAPPER}} .step-circle_box',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'circle_box_shadow',
				'selector' => '{{WRAPPER}} .step-circle_box',
			]
		);

		$this->add_responsive_control(
			'circle_size',
			[
				'label' => esc_html__('Circle Size (px)', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 100, 'max' => 600],
				],
				'selectors' => [
					'{{WRAPPER}} .step-circle_box' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'circle_border_radius',
			[
				'label' => esc_html__('Border Radius (px)', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => ['min' => 0, 'max' => 100],
					'%' => ['min' => 0, 'max' => 100],
				],
				'selectors' => [
					'{{WRAPPER}} .step-circle_box' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'circle_padding',
			[
				'label' => esc_html__('Padding (px)', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => ['min' => 0, 'max' => 100],
					'%' => ['min' => 0, 'max' => 100],
				],
				'selectors' => [
					'{{WRAPPER}} .step-circle_box' => 'padding: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'inner_circle_heading',
			[
				'label' => esc_html__('Inner Circle', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'inner_circle_background_color',
			[
				'label' => esc_html__('Inner Circle Background', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'inner_circle_border',
				'label' => esc_html__('Inner Circle Border', 'plugin-name'),
				'selector' => '{{WRAPPER}} .step-circle_box .inner_circle',
			]
		);

		$this->add_responsive_control(
			'inner_circle_border_radius',
			[
				'label' => esc_html__('Border Radius (px)', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => ['min' => 0, 'max' => 100],
					'%' => ['min' => 0, 'max' => 100],
				],
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'inner_circle_padding',
			[
				'label' => esc_html__('Padding (px)', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 0, 'max' => 100],
				],
				'selectors' => [
					'{{WRAPPER}} .step-circle_box .inner_circle' => 'padding: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'inner_circle_box_shadow',
				'selector' => '{{WRAPPER}} .step-circle_box .inner_circle',
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

		require_once plugin_dir_path(__FILE__) . "/style1.php";


?>

	<?php
	}
}
