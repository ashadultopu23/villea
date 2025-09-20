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
				'label' => __('Top Row Gallery Content', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		// Top Row
		$top_repeater = new \Elementor\Repeater();

		$top_repeater->add_control(
			'top_row_image',
			[
				'label'   => __('Image', 'tp-elements'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$top_repeater->add_control(
			'top_row_alt_text',
			[
				'label'   => __('Alt Text', 'tp-elements'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Gallery Image', 'tp-elements'),
			]
		);

		$top_repeater->add_control(
			'top_row_icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$top_repeater->add_control(
			'top_row_link',
			[
				'label'   => __('Link', 'tp-elements'),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'top_row_gallery_items',
			[
				'label'       => __('Gallery Items', 'tp-elements'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $top_repeater->get_controls(),
				'default'     => [],
				'title_field' => '{{{ top_row_alt_text }}}',
			]
		);

		// Bottom Row
		$bottom_repeater = new \Elementor\Repeater();

		$bottom_repeater->add_control(
			'bottom_row_image',
			[
				'label'   => __('Image', 'tp-elements'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$bottom_repeater->add_control(
			'bottom_row_alt_text',
			[
				'label'   => __('Alt Text', 'tp-elements'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Gallery Image', 'tp-elements'),
			]
		);

		$bottom_repeater->add_control(
			'bottom_row_icon',
			[
				'label' => esc_html__('Icon', 'tp-elements'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$bottom_repeater->add_control(
			'bottom_row_link',
			[
				'label'   => __('Link', 'tp-elements'),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'bottom_row_gallery_items',
			[
				'label'       => __('Bottom Row Gallery Items', 'tp-elements'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $bottom_repeater->get_controls(),
				'default'     => [],
				'title_field' => '{{{ bottom_row_alt_text }}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab
		 */
		$this->start_controls_section(
			'gallery_style',
			[
				'label' => __('Gallery Items', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_width',
			[
				'label'      => __('Item Width', 'tp-elements'),
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
				'label'      => __('Item Height', 'tp-elements'),
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
				'label'      => __('Border Radius', 'tp-elements'),
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
				'label' => __('Counter Circle', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'counter_background',
				'label'    => __('Background', 'tp-elements'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .counter-circle',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'counter_border',
				'label' => esc_html__('Border', 'plugin-name'),
				'selector' => '{{WRAPPER}} .counter-circle',
			]
		);

		$this->add_responsive_control(
			'counter_size',
			[
				'label' => __('Counter Size', 'tp-elements'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 400,
					],
				],
				'default' => [
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .progress-ring' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Progress Ring Stroke Width
		$this->add_responsive_control(
			'progress_stroke_width',
			[
				'label' => __('Progress Stroke Width', 'tp-elements'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 20,
					],
				],
				'default' => [
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .progress-ring__circle' => 'stroke-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .progress-ring__background' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Progress Circle Radius (affects the actual circle size within the SVG)
		$this->add_responsive_control(
			'progress_radius',
			[
				'label' => __('Progress Circle Radius', 'tp-elements'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 180,
					],
				],
				'default' => [
					'size' => 54,
				],
				'description' => __('Adjust the radius of the progress circle. Should be smaller than half the counter size.', 'tp-elements'),
			]
		);

		// Progress Colors
		$this->add_control(
			'progress_active_color',
			[
				'label'     => __('Progress Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .progress-ring__circle' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'progress_background_color',
			[
				'label'     => __('Progress Background Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 255, 255, 0.3)',
				'selectors' => [
					'{{WRAPPER}} .progress-ring__background' => 'stroke: {{VALUE}};',
				],
			]
		);

		// Counter Text Styling
		$this->add_control(
			'counter_text_heading',
			[
				'label' => __('Counter Text', 'tp-elements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'counter_text_color',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .counter-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'counter_text_typography',
				'selector' => '{{WRAPPER}} .counter-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'popup_icon_style',
			[
				'label' => esc_html__('Popup Icon', 'plugin-name'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_icon_color',
			[
				'label'     => __('Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .gallery-item .hover-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gallery-item .hover-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_icon_background',
			[
				'label'     => __('Icon Background', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.5)',
				'selectors' => [
					'{{WRAPPER}} .gallery-item .hover-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'hover_icon_size',
			[
				'label' => __('Icon Font Size', 'tp-elements'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-item .hover-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gallery-item .hover-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// popup close icon
		$this->add_control(
			'popup_close_icon_color',
			[
				'label'     => __('Popup Close Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .popup-content .close-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'popup_close_icon_background',
			[
				'label'     => __('Popup Close Icon Background', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.5)',
				'selectors' => [
					'{{WRAPPER}} .popup-content .close-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Group items by row type
		$top_items = $settings['top_row_gallery_items'];
		$bottom_items = $settings['bottom_row_gallery_items'];


		// Get dynamic values from settings with fallbacks
		$counter_size = !empty($settings['counter_size']['size']) ? $settings['counter_size']['size'] : 120;
		$progress_radius = !empty($settings['progress_radius']['size']) ? $settings['progress_radius']['size'] : 54;
		$svg_center = $counter_size / 2;

		// Ensure radius doesn't exceed reasonable bounds (leave some padding for stroke)
		$stroke_width = !empty($settings['progress_stroke_width']['size']) ? $settings['progress_stroke_width']['size'] : 8;
		$max_radius = ($counter_size / 2) - ($stroke_width / 2) - 5; // 5px padding
		$progress_radius = min($progress_radius, $max_radius);
?>

		<div class="gallery-container gallery-container-<?php echo $this->get_id(); ?>">
			<!-- Top Row -->
			<div class="gallery-row top-row" id="topRow-<?php echo $this->get_id(); ?>">
				<?php foreach ($top_items as $item) : ?>
					<div class="gallery-item" data-src="<?php echo esc_url($item['top_row_image']['url']); ?>">
						<img src="<?php echo esc_url($item['top_row_image']['url']); ?>" alt="<?php echo esc_attr($item['top_row_alt_text']); ?>">
						<a href="<?php echo esc_url($item['top_row_link']['url']); ?>" class="hover-icon">
							<?php \Elementor\Icons_Manager::render_icon($item['top_row_icon'], ['aria-hidden' => 'true']); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Bottom Row -->
			<div class="gallery-row bottom-row" id="bottomRow-<?php echo $this->get_id(); ?>">
				<?php foreach ($bottom_items as $item) : ?>
					<div class="gallery-item" data-src="<?php echo esc_url($item['bottom_row_image']['url']); ?>">
						<img src="<?php echo esc_url($item['bottom_row_image']['url']); ?>" alt="<?php echo esc_attr($item['bottom_row_alt_text']); ?>">
						<a href="<?php echo esc_url($item['bottom_row_link']['url']); ?>" class="hover-icon">
							<?php \Elementor\Icons_Manager::render_icon($item['bottom_row_icon'], ['aria-hidden' => 'true']); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="counter-circle">
				<svg class="progress-ring" width="<?php echo $counter_size; ?>" height="<?php echo $counter_size; ?>">
					<circle
						class="progress-ring__background"
						cx="<?php echo $svg_center; ?>"
						cy="<?php echo $svg_center; ?>"
						r="<?php echo $progress_radius; ?>" />
					<circle
						class="progress-ring__circle"
						cx="<?php echo $svg_center; ?>"
						cy="<?php echo $svg_center; ?>"
						r="<?php echo $progress_radius; ?>" />
				</svg>
				<span id="counterText-<?php echo $this->get_id(); ?>" class="counter-text">
					<?php echo count($top_items) + count($bottom_items); ?>
				</span>
			</div>

			<!-- Popup Overlay -->
			<div class="popup-overlay" id="popupOverlay-<?php echo $this->get_id(); ?>">
				<div class="popup-content">
					<img id="popupImage-<?php echo $this->get_id(); ?>" src="<?php echo esc_url(\Elementor\Utils::get_placeholder_image_src()); ?>" alt="Popup Image">
					<button class="close-btn" id="closeBtn-<?php echo $this->get_id(); ?>">&times;</button>
				</div>
			</div>
		</div>


		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.querySelectorAll(".gallery-container").forEach(function(container) {
					const topRow = container.querySelector(".top-row");
					const bottomRow = container.querySelector(".bottom-row");
					const counter = container.closest(".gallery-container").querySelector(".counter-circle span");
					const popupOverlay = container.closest(".gallery-container").querySelector(".popup-overlay");
					const popupImage = container.closest(".gallery-container").querySelector(".popup-overlay img");
					const closeBtn = container.closest(".gallery-container").querySelector(".popup-overlay .close-btn");
					const galleryItems = container.querySelectorAll(".gallery-item");

					const circle = container.querySelector(".progress-ring__circle");
					const backgroundCircle = container.querySelector(".progress-ring__background");

					let radius = 54;
					if (circle) {
						radius = parseFloat(circle.getAttribute('r')) || 54;
					}
					const circumference = 2 * Math.PI * radius;

					if (circle) {
						circle.style.strokeDasharray = circumference;
						circle.style.strokeDashoffset = circumference;
					}

					// Track if container is in viewport
					let isInViewport = false;
					let containerRect = null;

					function setProgress(percent) {
						if (circle) {
							const offset = circumference - (percent / 100) * circumference;
							circle.style.strokeDashoffset = offset;
						}
					}

					// Set initial positions
					function setInitialPositions() {
						if (topRow) {
							topRow.style.transform = 'translateX(0px)';
						}

						if (bottomRow) {
							const bottomRowWidth = bottomRow.scrollWidth;
							const containerWidth = bottomRow.parentElement.offsetWidth;
							const maxMovement = Math.max(0, bottomRowWidth - containerWidth);
							bottomRow.style.transform = `translateX(-${maxMovement}px)`;
						}
					}

					// Calculate scroll percentage within the container's viewport range
					function calculateContainerScrollPercent() {
						if (!isInViewport || !containerRect) return 0;

						const scrollTop = window.pageYOffset;
						const windowHeight = window.innerHeight;

						// Container position relative to viewport
						const containerTop = containerRect.top + scrollTop;
						const containerBottom = containerTop + containerRect.height;

						// Calculate when container starts and ends being "active"
						const startScroll = containerTop - windowHeight; // Start when container enters viewport
						const endScroll = containerBottom; // End when container fully exits viewport

						const scrollRange = endScroll - startScroll;
						const currentScroll = scrollTop - startScroll;

						// Calculate percentage (0 to 1)
						const scrollPercent = Math.max(0, Math.min(1, currentScroll / scrollRange));

						return scrollPercent;
					}

					// Handle scroll with viewport-aware calculation
					function handleScroll() {
						if (!isInViewport) {
							// Reset progress when not in viewport
							if (counter) counter.textContent = '0%';
							setProgress(0);
							return;
						}

						const scrollPercent = calculateContainerScrollPercent();

						// Base speed for top row
						const topRowSpeed = 1;

						let topMaxMovement = 0;
						let bottomMaxMovement = 0;

						// Calculate max movements for both rows
						if (topRow) {
							const topRowWidth = topRow.scrollWidth;
							const containerWidth = topRow.parentElement.offsetWidth;
							topMaxMovement = Math.max(0, topRowWidth - containerWidth);
						}

						if (bottomRow) {
							const bottomRowWidth = bottomRow.scrollWidth;
							const containerWidth = bottomRow.parentElement.offsetWidth;
							bottomMaxMovement = Math.max(0, bottomRowWidth - containerWidth);
						}

						// Calculate dynamic bottom row speed
						let bottomRowSpeed;

						if (topMaxMovement > 0 && bottomMaxMovement > 0) {
							bottomRowSpeed = topMaxMovement / bottomMaxMovement;
							bottomRowSpeed = Math.max(0.2, Math.min(2, bottomRowSpeed));
						} else if (bottomMaxMovement > 0) {
							bottomRowSpeed = 0.5;
						} else {
							bottomRowSpeed = 0;
						}

						// Top Row: moves from left (0) to right (-maxMovement)
						if (topRow && topMaxMovement > 0) {
							const movement = (scrollPercent * topRowSpeed) * topMaxMovement;
							topRow.style.transform = `translateX(-${movement}px)`;
						}

						// Bottom Row: moves from right (-maxMovement) to left (0)
						if (bottomRow && bottomMaxMovement > 0) {
							const adjustedScrollPercent = scrollPercent * bottomRowSpeed;
							const movement = bottomMaxMovement - (adjustedScrollPercent * bottomMaxMovement);
							bottomRow.style.transform = `translateX(-${movement}px)`;
						}

						const counterPercentage = Math.min(100, Math.round(scrollPercent * 100));
						if (counter) counter.textContent = `${counterPercentage}%`;
						setProgress(counterPercentage);
					}

					// Intersection Observer to detect when container is in viewport
					const observer = new IntersectionObserver((entries) => {
						entries.forEach(entry => {
							const wasInViewport = isInViewport;
							isInViewport = entry.isIntersecting;
							containerRect = entry.boundingClientRect;

							// If container just entered viewport, update positions
							if (isInViewport && !wasInViewport) {
								containerRect = container.getBoundingClientRect();
								handleScroll();
							} else if (!isInViewport && wasInViewport) {
								// Container left viewport - reset or maintain last state
								// Uncomment next line if you want to reset when leaving viewport
								// handleScroll();
							}
						});
					}, {
						threshold: [0, 0.1, 0.5, 0.9, 1], // Multiple thresholds for smooth tracking
						rootMargin: '50px 0px 50px 0px' // Start tracking 50px before entering viewport
					});

					// Start observing the container
					observer.observe(container);

					// Update container rect on resize
					function updateContainerRect() {
						if (isInViewport) {
							containerRect = container.getBoundingClientRect();
						}
						setInitialPositions();
						handleScroll();
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

					// Set initial positions
					setInitialPositions();

					// Event listeners
					window.addEventListener("scroll", handleScroll);
					window.addEventListener("resize", updateContainerRect);

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

					// Initial call
					containerRect = container.getBoundingClientRect();
					handleScroll();
				});
			});
		</script>
<?php
	}
}
