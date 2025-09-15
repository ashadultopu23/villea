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
				'label' => esc_html__('Style', 'tp-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_heading',
			[
				'label' => esc_html__('Image Style', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .solution-image-container .img_border',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .solution-image-container .img_border,
					{{WRAPPER}} .solution-image-container .img_border img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .solution-image-container .img_border img' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .expert-solutions .flex-container ' => 'gap: {{SIZE}}{{UNIT}} !important;',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_style',
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
					'{{WRAPPER}} .solution-items .solution-item' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'card_active_bgcolor',
			[
				'label' => esc_html__('Hover / Active background', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item:hover, {{WRAPPER}} .solution-items .solution-item.active' => 'background-color: {{VALUE}} !important',
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
					'{{WRAPPER}} .solution-items .solution-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .solution-items .solution-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .solution-items .solution-item',
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label' => esc_html__('Border Radius', 'tp-elements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' => '{{WRAPPER}} .solution-items .solution-item .solution-title',

			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item .solution-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label'     => esc_html__('Hover /  Active Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item:hover .solution-title, {{WRAPPER}} .solution-items .solution-item.active .solution-title' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'count_heading',
			[
				'label' => esc_html__('Count', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__('Typography', 'tp-elements'),
				'name'     => 'count_typ',
				'selector' => '{{WRAPPER}} .solution-items .solution-item .solution-index',

			]
		);

		$this->add_control(
			'count_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item .solution-index' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'count_active_color',
			[
				'label'     => esc_html__('Hover /  Active Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item:hover .solution-index, {{WRAPPER}} .solution-items .solution-item.active .solution-index' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label' => esc_html__('Icon', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__('Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .solution-items .solution-item i' => 'color: {{VALUE}} !important;',
				],
			]
		);

		// $this->add_control(
		// 	'icon_active_color',
		// 	[
		// 		'label'     => esc_html__('Hover /  Active Color', 'tp-elements'),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .solution-items .solution-item:hover i, {{WRAPPER}} .solution-items .solution-item.active i' => 'color: {{VALUE}} !important;',
		// 		],
		// 	]
		// );

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'plugin-name'),
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
					'{{WRAPPER}} .solution-items .solution-item svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .solution-items .solution-item i' => 'font-size: {{SIZE}}{{UNIT}};',
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
		$default_image = !empty($settings['list_repeater'][0]['image']['url'])
			? $settings['list_repeater'][0]['image']['url']
			: \Elementor\Utils::get_placeholder_image_src();
?>

		<section class="expert-solutions" id="tp-widget-<?php echo $this->get_id(); ?>">
			<div class="flex-container d-flex flex-wrap flex-lg-nowrap gap-5">

				<!-- Image Column -->
				<div class="w-100">
					<div class="solution-image-container w-100">
						<div class="img_border">
							<img src="<?php echo esc_url($default_image); ?>"
								class="solution-img"
								alt="<?php echo !empty($settings['list_repeater'][0]['list_title'])
											? esc_attr($settings['list_repeater'][0]['list_title'])
											: esc_attr__('Default image', 'tp-elements'); ?>" />
						</div>
					</div>
				</div>

				<!-- Solution Items Column -->
				<div class="w-100">
					<div class="solution-items w-100">
						<?php
						if (!empty($settings['list_repeater']) && is_array($settings['list_repeater'])) :
							$index = 1;
							foreach ($settings['list_repeater'] as $item) :
								$image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
								$title = isset($item['list_title']) ? $item['list_title'] : '';
						?>
								<!-- Solution Item -->
								<div class="solution-item" data-img="<?php echo esc_url($image_url); ?>">
									<i class="tp-arrow-up-right"></i>
									<div class="content">
										<?php if (!empty($title)) : ?>
											<h3 class="solution-title inactive"><?php echo wp_kses_post($title); ?></h3>
										<?php endif; ?>
										<h6 class="solution-index inactive"><?php echo sprintf("%02d", $index); ?></h6>
									</div>
								</div>
						<?php
								$index++;
							endforeach;
						endif;
						?>
					</div>
				</div>

			</div>
		</section>

		<script>
			(function($) {
				// Define the function only once
				if (typeof window.initSolutionHover === "undefined") {
					window.initSolutionHover = function(container) {
						if (!container) return;

						const solutionItems = container.querySelectorAll(".solution-item");
						const solutionImg = container.querySelector(".solution-img");

						if (!solutionItems.length || !solutionImg) return;

						solutionItems.forEach((item) => {
							item.addEventListener("mouseenter", function() {
								const imgSrc = this.getAttribute("data-img");

								// Preload image for smoother transition
								const newImg = new Image();
								newImg.onload = function() {
									solutionImg.src = imgSrc;
								};
								newImg.src = imgSrc;

								solutionItems.forEach((i) => i.classList.remove("active"));
								this.classList.add("active");
							});

							// Add tabindex for keyboard navigation
							item.setAttribute("tabindex", "0");

							// Add click event for mobile/touch devices
							item.addEventListener("click", function() {
								const imgSrc = this.getAttribute("data-img");
								const newImg = new Image();
								newImg.onload = function() {
									solutionImg.src = imgSrc;
								};
								newImg.src = imgSrc;

								solutionItems.forEach((i) => i.classList.remove("active"));
								this.classList.add("active");
							});
						});
					};
				}

				// Initialize for this specific widget instance
				$(document).ready(function() {
					const container = document.getElementById('tp-widget-<?php echo $this->get_id(); ?>');
					if (container) {
						window.initSolutionHover(container);
					}
				});

			})(jQuery);
		</script>


<?php
	}
}
