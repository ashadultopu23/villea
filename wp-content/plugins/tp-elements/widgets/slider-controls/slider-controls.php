<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined('ABSPATH') || die();

class Themephi_Slider_Controls_Widget extends \Elementor\Widget_Base
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
		return 'tp-slider-controls';
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
		return esc_html__('TP Slider Controls', 'tp-elements');
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
		return 'glyph-icon flaticon-error';
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
		return ['slider-controls'];
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
			'section_slider_controls',
			[
				'label' => esc_html__('Slider Navigation', 'tp-elements'),
			]
		);

		$this->add_control(
			'slider_previous_navigation',
			[
				'label' => esc_html__('Slider Previous Navigation', 'tp-elements'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'nav_prev_icon',
			[
				'label'     => esc_html__('Previous Icon', 'tp-elements'),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-arrow-left',
					'library' => 'solid',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'prev_controller_name',
			[
				'label' => esc_html__('Previous Controller Name', 'text-domain'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('slide-prev-btn', 'text-domain'),
				'description' => esc_html__('Enter the name of the previous controller. This will be used to control the slider. Example: ("blog-slide-next-btn", "product-slide-next-btn")  .The default value is "slide-prev-btn".', 'text-domain'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'prev_controller_notice',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('<strong>Important:</strong> Please add the class <code>"slide-next-btn"</code>, <code>"slide-prev-btn"</code> or "your-custom-class" to the slider widget section to make it work.', 'tp-elements'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'slider_next_navigation',
			[
				'label' => esc_html__('Slider Next Navigation', 'tp-elements'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'nav_next_icon',
			[
				'label'     => esc_html__('Next Icon', 'tp-elements'),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-arrow-right',
					'library' => 'solid',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'next_controller_name',
			[
				'label' => esc_html__('Previous Controller Name', 'text-domain'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('slide-next-btn', 'text-domain'),
				'description' => esc_html__('Enter the name of the next controller. This will be used to control the slider. Example: ("blog-slide-next-btn", "product-slide-next-btn")  .The default value is "slide-next-btn".', 'text-domain'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'next_controller_notice',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __('<strong>Important:</strong> Please add the class <code>"slide-next-btn"</code>, <code>"slide-prev-btn"</code> or "your custom class" to the slider widget section to make it work.', 'tp-elements'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'_section_style_slider_controls',
			[
				'label' => esc_html__('Slider Controls', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_icon_typography',
				'label' => esc_html__('Icon Typography', 'tp-elements'),
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'nav_icon_width',
			[
				'label' => esc_html__('Width', 'plugin-name'),
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
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'nav_icon_height',
			[
				'label' => esc_html__('Height', 'plugin-name'),
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
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);



		$this->add_responsive_control(
			'navigation_alignment',
			[
				'label' => esc_html__('Navigation Alignment', 'tp-elements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'tp-elements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'tp-elements'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'tp-elements'),
						'icon' => 'eicon-text-align-right',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'tp-elements'),
						'icon' => 'eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html__('Space Around', 'tp-elements'),
						'icon' => 'eicon-justify-space-around-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation' => 'justify-content: {{VALUE}}'
				]
			]
		);


		$this->start_controls_tabs('_tabs_nav_prev');

		$this->start_controls_tab(
			'nav_prev_normal_tab',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_responsive_control(
			'nav_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_box_shadow',
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon',
			]
		);

		$this->add_responsive_control(
			'nav_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg_color',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon',
			]
		);
		$this->add_control(
			'nav_icon_color',
			[
				'label' => esc_html__('Icon Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_hover_tab',
			[
				'label' => esc_html__('Nav Hover', 'tp-elements'),
			]
		);

		$this->add_responsive_control(
			'nav_hover_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_hover_margin',
			[
				'label' => esc_html__('Margin', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_hover_border',
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_box_shadow',
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover',
			]
		);

		$this->add_responsive_control(
			'nav_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg_color',
				'label' => esc_html__('Hover Background', 'tp-elements'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover',
			]
		);
		$this->add_control(
			'nav_icon_hover_color',
			[
				'label' => esc_html__('Icon Hover Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-slider-controls-navigation .tp-nav-icon:hover' => 'color: {{VALUE}};',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>

		<style>
			.tp-slider-controls-navigation {
				display: flex;
				gap: 12px;
			}

			.tp-nav-icon {
				display: inline-flex;
				justify-content: center;
				align-items: center;
				position: relative;
				z-index: 1;
				cursor: pointer;
				transition: all 0.3s ease-in-out;
			}
		</style>
		<div class="tp-slider-controls-navigation">

			<?php if (!empty($settings['nav_prev_icon']) || !empty($settings['nav_prev_image']['url'])) { ?>
				<span class="tp-nav-icon <?php echo esc_attr($settings['prev_controller_name']); ?>"><?php \Elementor\Icons_Manager::render_icon($settings['nav_prev_icon'], ['aria-hidden' => 'true']); ?></span>
			<?php } ?>

			<?php if (!empty($settings['nav_next_icon']) || !empty($settings['nav_next_image']['url'])) { ?>
				<span class="tp-nav-icon <?php echo esc_attr($settings['next_controller_name']); ?>"><?php \Elementor\Icons_Manager::render_icon($settings['nav_next_icon'], ['aria-hidden' => 'true']); ?></span>
			<?php } ?>

		</div>
<?php
	}
}
