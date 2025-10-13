<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined('ABSPATH') || die();

class Themephi_Button_Widget extends \Elementor\Widget_Base
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
		return 'tp-button';
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
		return esc_html__('TP Button', 'tp-elements');
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
		return ['button'];
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
			'section_button',
			[
				'label' => esc_html__('Content', 'tp-elements'),
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'   => esc_html__('Select Style', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'primary_btn',
				'separator' => 'before',
				'options' => [
					'primary_btn' => esc_html__('Primary Button', 'tp-elements'),
					'secondary_btn' => esc_html__('Secondary Button', 'tp-elements'),
					'link_btn' => esc_html__('Link Button', 'tp-elements'),
					'outline_btn' => esc_html__('Outline Button', 'tp-elements'),
					'another_btn' => esc_html__('Another Button', 'tp-elements'),

				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__('Button Text', 'tp-elements'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sample',
				'placeholder' => esc_html__('Button Text', 'tp-elements'),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__('Button Link', 'tp-elements'),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'is_downloadable',
			[
				'label' => esc_html__('Is Downloadable', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'plugin-name'),
				'label_off' => esc_html__('Hide', 'plugin-name'),
				'return_value' => 'yes',
				'default' => 'no',
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .themephi-button' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label'        => esc_html__('Show Icon', 'tp-elements'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'tp-elements'),
				'label_off'    => esc_html__('Hide', 'tp-elements'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__('Icon Position', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'before'  => esc_html__('Before Content', 'tp-elements'),
					'after' => esc_html__('After Content', 'tp-elements'),
				],

				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'     => esc_html__('Icon', 'tp-elements'),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'tp tp-arrow-left',
				],
				'separator' => 'before',

				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon_spacing',
			[
				'label' => esc_html__('Icon Left Spacing', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],

				'selectors' => [
					'{{WRAPPER}} .themephi-button i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themephi-button a svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icon' => 'yes',
					'icon_position' => 'after',
				],
			]
		);

		$this->add_control(
			'btn_icon_spacing_left',
			[
				'label' => esc_html__('Icon Right Spacing', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],

				'selectors' => [
					'{{WRAPPER}} .themephi-button i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themephi-button a svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icon' => 'yes',
					'icon_position' => 'before',
				],
			]
		);

		$this->add_control(
			'btn_icon_spacing_top',
			[
				'label' => esc_html__('Icon Top/Bottom Spacing', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'px' => [
					'min' => -100,
					'max' => 100,
					'step' => 1,
				],
				'default' => [
					'size' => 0,

				],

				'selectors' => [
					'{{WRAPPER}} .themephi-button i' => 'top: {{SIZE}}px;',
					'{{WRAPPER}} .themephi-button a svg' => 'top: {{SIZE}}px;',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn_icon_width',
			[
				'label' => esc_html__('Icon Width', 'tp-elements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'_section_style_button',
			[
				'label' => esc_html__('Button', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// button size control


		// themephi_button
		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'inline-flex' => [
						'title' => __('Inline', 'plugin-name'),
						'icon'  => 'eicon-post-list',
					],
					'flex' => [
						'title' => __('Block', 'plugin-name'),
						'icon'  => 'eicon-posts-grid',
					],
				],
				'default' => 'inline-flex',
				'selectors' => [
					'{{WRAPPER}} .themephi-button a' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_size',
			[
				'label' => esc_html__('Button Size', 'plugin-name'),
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
					'{{WRAPPER}} .themephi-button a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				"condition" => [
					'button_style' => 'another_btn',
				],
			]
		);

		$this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__('Text Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'link_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .themephi-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .themephi-button a::after, {{WRAPPER}} .themephi-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .themephi-button a',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .themephi-button a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
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
					'{{WRAPPER}} .themephi-button a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'link_hover_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_hover_typography',
				'selector' => '{{WRAPPER}} .themephi-button a:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'tp-elements'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .themephi-button a:hover',
			]
		);

		$this->add_control(
			'btn_after_bg_color',
			[
				'label' => esc_html__('Hover After BG Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a::before' => 'background: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .themephi-button a:hover',
			]
		);

		$this->add_control(
			'button_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .themephi-button a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_text_color',
			[
				'label' => esc_html__('Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a svg' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a svg path' => 'fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__('Hover Color', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a:hover i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a:hover svg' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a:hover svg path' => 'fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_background',
			[

				'label' => esc_html__('Background', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a i' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a svg' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_hover_background',
			[

				'label' => esc_html__('Hover Background', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a:hover i' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a:hover svg' => 'background: {{VALUE}} !important;',
				],
			]
		);


		$this->add_control(
			'icon_stroke_color',
			[
				'label' => esc_html__('Stroke Color', 'tp-elements'),
				'description' => esc_html__('Only for SVG (when color not works) ', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a svg' => 'stroke: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a svg path' => 'stroke: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_hover_stroke_color',
			[
				'label' => esc_html__('Hover Stroke Color', 'tp-elements'),
				'description' => esc_html__('Only for SVG (when color not works) ', 'tp-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a:hover svg' => 'stroke: {{VALUE}} !important;',
					'{{WRAPPER}} .themephi-button a:hover svg path' => 'stroke: {{VALUE}} !important;',
				],
			]
		);


		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_inline_editing_attributes('btn_text', 'basic');
		$this->add_render_attribute('btn_text', 'class', 'btn_text');


		$url = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '#';
		$target = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$is_downloadable = $settings['is_downloadable'] === 'yes';

?>
		<div class="themephi-button <?php echo esc_attr($settings['button_style']); ?>">

			<a class="themephi_button box-style" href="<?php echo esc_url($url); ?>"
				<?php if ($is_downloadable) echo 'download'; ?>
				<?php echo $target; ?>>

				<?php if (!empty($settings['btn_icon']) &&  ($settings['icon_position'] == 'before')) : ?>
					<span class="icon d-inline-flex align-items-center justify-content-center">
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</span>
				<?php endif; ?>

				<span class="btn_text"><?php echo esc_html($settings['btn_text']); ?></span>

				<?php if (!empty($settings['btn_icon']) &&  ($settings['icon_position'] == 'after')) : ?>
					<span class="icon d-inline-flex align-items-center justify-content-center">
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</span>
				<?php endif; ?>

			</a>
		</div>


<?php
	}
}
