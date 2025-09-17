<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if (! defined('ABSPATH')) exit;

class Themephi_Image_Scroll_Gallery_Widget extends \Elementor\Widget_Base
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
		return 'tp-image-scroll_gallery';
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
		return __('TP Image Scroll Gallery', 'tp-elements');
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
		return 'glyph-icon flaticon-slider-3';
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

		/**
		 * Content Tab
		 */
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Gallery Content', 'at-extension'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __('Image', 'at-extension'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'alt_text',
			[
				'label'   => __('Alt Text', 'at-extension'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Gallery Image', 'at-extension'),
			]
		);

		$repeater->add_control(
			'row_type',
			[
				'label'   => __('Row', 'at-extension'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top'    => __('Top Row', 'at-extension'),
					'bottom' => __('Bottom Row', 'at-extension'),
				],
			]
		);

		$this->add_control(
			'gallery_items',
			[
				'label'       => __('Gallery Items', 'at-extension'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [],
				'title_field' => '{{{ alt_text }}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab
		 */
		$this->start_controls_section(
			'gallery_style',
			[
				'label' => __('Gallery Items', 'at-extension'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_width',
			[
				'label'      => __('Item Width', 'at-extension'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default'    => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .gallery-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_height',
			[
				'label'      => __('Item Height', 'at-extension'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default'    => [
					'size' => 200,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .gallery-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'selector' => '{{WRAPPER}} .gallery-item',
			]
		);

		$this->add_responsive_control(
			'item_radius',
			[
				'label'      => __('Border Radius', 'at-extension'),
				'type'       => Controls_Manager::DIMENSIONS,
				'selectors'  => [
					'{{WRAPPER}} .gallery-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_shadow',
				'selector' => '{{WRAPPER}} .gallery-item',
			]
		);

		$this->end_controls_section();

		// Counter Style
		$this->start_controls_section(
			'counter_style',
			[
				'label' => __('Counter Circle', 'at-extension'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'counter_background',
				'label'    => __('Background', 'at-extension'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .counter-circle',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typography',
				'selector' => '{{WRAPPER}} .counter-circle',
			]
		);

		$this->add_responsive_control(
			'counter_size',
			[
				'label' => __('Size', 'at-extension'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Group items by row type
		$top_items = array_filter($settings['gallery_items'], fn($item) => $item['row_type'] === 'top');
		$bottom_items = array_filter($settings['gallery_items'], fn($item) => $item['row_type'] === 'bottom');
?>

		<div class="gallery-container">
			<!-- Top Row -->
			<div class="gallery-row top-row" id="topRow-<?php echo $this->get_id(); ?>">
				<?php foreach ($top_items as $item) : ?>
					<div class="gallery-item" data-src="<?php echo esc_url($item['image']['url']); ?>">
						<img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['alt_text']); ?>">
						<div class="hover-icon">📷</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Bottom Row -->
			<div class="gallery-row bottom-row" id="bottomRow-<?php echo $this->get_id(); ?>">
				<?php foreach ($bottom_items as $item) : ?>
					<div class="gallery-item" data-src="<?php echo esc_url($item['image']['url']); ?>">
						<img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['alt_text']); ?>">
						<div class="hover-icon">📷</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Counter Circle -->
		<div class="counter-circle">
			<span id="counterText-<?php echo $this->get_id(); ?>">0%</span>
		</div>

		<!-- Popup Overlay -->
		<div class="popup-overlay" id="popupOverlay-<?php echo $this->get_id(); ?>">
			<div class="popup-content">
				<img id="popupImage-<?php echo $this->get_id(); ?>" src="<?php echo esc_url(\Elementor\Utils::get_placeholder_image_src()); ?>" alt="Popup Image">
				<button class="close-btn" id="closeBtn-<?php echo $this->get_id(); ?>">&times;</button>
			</div>
		</div>

		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.querySelectorAll(".gallery-container").forEach(function(container) {
					const topRow = container.querySelector(".top-row");
					const bottomRow = container.querySelector(".bottom-row");
					const counter = container.closest("body").querySelector(".counter-circle span");
					const popupOverlay = container.closest("body").querySelector(".popup-overlay");
					const popupImage = container.closest("body").querySelector(".popup-overlay img");
					const closeBtn = container.closest("body").querySelector(".popup-overlay .close-btn");
					const galleryItems = container.querySelectorAll(".gallery-item");

					function handleScroll() {
						const scrollTop = window.pageYOffset;
						const docHeight = document.documentElement.scrollHeight - window.innerHeight;
						const scrollPercent = scrollTop / docHeight;

						const maxMovement = 200;
						const topMovement = scrollPercent * maxMovement;
						const bottomMovement = scrollPercent * maxMovement;

						if (topRow) topRow.style.transform = `translateX(-${topMovement}px)`;
						if (bottomRow) bottomRow.style.transform = `translateX(${bottomMovement}px)`;

						const counterPercentage = Math.round(scrollPercent * 100);
						if (counter) counter.textContent = `${counterPercentage}%`;
					}

					function openPopup(imageSrc) {
						popupImage.src = imageSrc;
						popupOverlay.classList.add("active");
						document.body.style.overflow = "hidden";
					}

					function closePopup() {
						popupOverlay.classList.remove("active");
						document.body.style.overflow = "auto";
					}

					window.addEventListener("scroll", handleScroll);

					galleryItems.forEach((item) => {
						item.addEventListener("click", function() {
							const imageSrc = this.getAttribute("data-src");
							openPopup(imageSrc);
						});
					});

					closeBtn.addEventListener("click", closePopup);
					popupOverlay.addEventListener("click", function(e) {
						if (e.target === popupOverlay) {
							closePopup();
						}
					});

					document.addEventListener("keydown", function(e) {
						if (e.key === "Escape") {
							closePopup();
						}
					});

					handleScroll();
				});
			});
		</script>
<?php
	}
}
