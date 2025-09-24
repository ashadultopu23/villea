<?php
$widget_id = $this->get_id();

$rotate = '-6'; // Default value

if (isset($settings['image_rotation'])) {
	if (is_array($settings['image_rotation'])) {
		// Handle different possible array structures
		if (isset($settings['image_rotation']['size'])) {
			$rotate = $settings['image_rotation']['size'];
		} elseif (isset($settings['image_rotation']['unit'])) {
			$rotate = $settings['image_rotation']['unit'];
		} elseif (!empty($settings['image_rotation'])) {
			// Get the first value if it's a simple array
			$rotate = is_array($settings['image_rotation']) ? reset($settings['image_rotation']) : $settings['image_rotation'];
		}
	} else {
		$rotate = $settings['image_rotation'];
	}
}

// Ensure it's a valid number
$rotate = is_numeric($rotate) ? $rotate : '-6';

?>
<div class="gallery-feature-items gallery-image-hover gallery-image-hover-<?php echo esc_attr($widget_id); ?>">
	<?php foreach ($settings['features_list'] as $index => $item) :
		$number = sprintf('%02d', $index + 1);
		$hover_image = !empty($item['hover_image']['url']) ? $item['hover_image']['url'] : '';
	?>
		<div class="gallery-feature-item <?php echo esc_attr($settings['hover_content_style']); ?>" data-img="<?php echo esc_url($hover_image); ?>">

			<!-- Content Style 1 -->
			<?php if (!empty($settings['hover_content_style']) && $settings['hover_content_style'] === 'content_style1') : ?>
				<div class="gallery-feature-content-left">
					<?php if ($settings['show_numbers'] === 'yes') : ?>
						<div class="gallery-feature-number-wrapper">
							<span class="gallery-feature-number gallery-feature-item-index"><?php echo esc_html($number); ?></span>
						</div>
					<?php endif; ?>
					<div class="gallery-feature-content-wrapper">
						<h3 class="gallery-feature-item-title"><?php echo esc_html($item['feature_title']); ?></h3>
						<p class="gallery-feature-item-description"><?php echo esc_html($item['feature_description']); ?></p>
					</div>
				</div>

				<div class="gallery-feature-icon-wrapper">
					<div class="gallery-feature-icon">
						<?php \Elementor\Icons_Manager::render_icon($item['feature_icon'], ['aria-hidden' => 'true']); ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Content Style 2 -->
			<?php if (!empty($settings['hover_content_style']) && $settings['hover_content_style'] === 'content_style2') : ?>
				<?php if ($settings['show_numbers'] === 'yes') : ?>
					<div class="gallery-feature-number-wrapper">
						<span class="gallery-feature-number"><?php echo esc_html($number); ?></span>
					</div>
				<?php endif; ?>

				<div class="gallery-feature-content-wrapper">
					<h3 class="gallery-feature-item-title"><?php echo esc_html($item['feature_title']); ?></h3>
					<p class="gallery-feature-item-description"><?php echo esc_html($item['feature_description']); ?></p>
				</div>

				<div class="gallery-feature-icon-wrapper">
					<div class="gallery-feature-icon">
						<?php \Elementor\Icons_Manager::render_icon($item['feature_icon'], ['aria-hidden' => 'true']); ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Content Style 3 -->
			<?php if (!empty($settings['hover_content_style']) && $settings['hover_content_style'] === 'content_style3') : ?>
				<!-- <div class="gallery-feature-left-content"> -->
				<?php if ($settings['show_numbers'] === 'yes') : ?>
					<div class="gallery-feature-number-wrapper">
						<span class="gallery-feature-number"><?php echo esc_html($number); ?></span>
					</div>
				<?php endif; ?>
				<div class="gallery-feature-content title-wrapper">
					<h3 class="gallery-feature-item-title"><?php echo wp_kses($item['feature_title'], 'post') ?></h3>
				</div>
				<!-- </div> -->
				<!-- <div class="gallery-feature-right-content"> -->
				<div class="gallery-feature-content description-wrapper">
					<p class="gallery-feature-item-description"><?php echo wp_kses($item['feature_description'], 'post'); ?></p>
				</div>
				<div class="gallery-feature-icon-wrapper">
					<div class="gallery-feature-icon">
						<?php \Elementor\Icons_Manager::render_icon($item['feature_icon'], ['aria-hidden' => 'true']); ?>
					</div>
				</div>
				<!-- </div> -->
			<?php endif; ?>

			<!-- Icon -->
		</div>
	<?php endforeach; ?>

	<?php if ($settings['enable_hover_image'] === 'yes') : ?>
		<img class="gallery-hover-image" id="hoverImage-<?php echo esc_attr($widget_id); ?>" src="" alt="Preview">
	<?php endif; ?>
</div>

<?php if ($settings['enable_hover_image'] === 'yes') : ?>
	<script>
		const featureItems = document.querySelectorAll('.gallery-image-hover-<?php echo esc_js($widget_id); ?> .gallery-feature-item');
		const hoverImage = document.getElementById('hoverImage-<?php echo esc_js($widget_id); ?>');

		// Variables for smooth animation
		let targetX = 0;
		let targetY = 0;
		let currentX = 0;
		let currentY = 0;
		let isVisible = false;
		let isHovering = false;
		let animationFrameId = null;
		let currentImgSrc = '';

		// Get rotation value from PHP
		const rotationValue = <?php echo esc_js($rotate); ?>;

		// Smooth animation function - always running
		function animate() {
			// Only update position if visible
			if (isVisible) {
				// Smooth interpolation (easing)
				const ease = 0.2;
				const dx = targetX - currentX;
				const dy = targetY - currentY;

				// If the difference is very small, snap to target
				if (Math.abs(dx) < 0.5 && Math.abs(dy) < 0.5) {
					currentX = targetX;
					currentY = targetY;
				} else {
					currentX += dx * ease;
					currentY += dy * ease;
				}

				// Apply position
				hoverImage.style.transform = ` translate(${currentX}px, ${currentY}px) rotate(${rotationValue}deg`;
			}

			// Always continue animation loop
			animationFrameId = requestAnimationFrame(animate);
		}

		// Start animation loop (runs continuously)
		function startAnimation() {
			if (!animationFrameId) {
				animationFrameId = requestAnimationFrame(animate);
			}
		}

		// Stop animation loop (call this only when completely done)
		function stopAnimation() {
			if (animationFrameId) {
				cancelAnimationFrame(animationFrameId);
				animationFrameId = null;
			}
		}

		// Show image with fade in
		function showImage(imgSrc) {
			if (imgSrc && imgSrc !== currentImgSrc) {
				hoverImage.src = imgSrc;
				currentImgSrc = imgSrc;
			}

			hoverImage.style.visibility = 'visible';
			hoverImage.style.transition = 'opacity 0.3s ease';
			hoverImage.style.opacity = '1';
			isVisible = true;
		}

		// Hide image with fade out
		function hideImage() {
			hoverImage.style.transition = 'opacity 0.3s ease, visibility 0s linear 0.3s';
			hoverImage.style.opacity = '0';

			setTimeout(() => {
				if (!isHovering) {
					hoverImage.style.visibility = 'hidden';
					hoverImage.src = '';
					currentImgSrc = '';
					isVisible = false;
				}
			}, 300);
		}

		// Update image position
		function updatePosition(e) {
			if (!isVisible) return;

			const imgWidth = hoverImage.offsetWidth;
			const imgHeight = hoverImage.offsetHeight;
			const margin = 20; // Space between cursor and image

			// Get mouse position
			let posX = e.clientX;
			let posY = e.clientY;

			// Center the image horizontally with the cursor
			posX -= imgWidth / 2;

			// Position image below cursor with margin
			posY += margin;

			// Boundary checks
			// Right boundary
			if (posX + imgWidth > window.innerWidth) {
				posX = window.innerWidth - imgWidth - 5;
			}

			// Left boundary
			if (posX < 5) {
				posX = 5;
			}

			// Bottom boundary
			if (posY + imgHeight > window.innerHeight) {
				posY = e.clientY - imgHeight - margin;
			}

			// Top boundary
			if (posY < 5) {
				posY = 5;
			}

			// Update target position for smooth animation
			targetX = posX;
			targetY = posY;
		}

		if (featureItems.length > 0 && hoverImage) {
			// Start the animation loop immediately
			startAnimation();

			featureItems.forEach(item => {
				item.addEventListener('mouseenter', function(e) {
					isHovering = true;
					const imgSrc = item.getAttribute('data-img');
					if (imgSrc) {
						showImage(imgSrc);
						updatePosition(e);
					}
				});

				item.addEventListener('mousemove', function(e) {
					if (!isHovering) {
						isHovering = true;
						const imgSrc = item.getAttribute('data-img');
						if (imgSrc) {
							showImage(imgSrc);
						}
					}
					updatePosition(e);
				});

				item.addEventListener('mouseleave', function() {
					isHovering = false;
					hideImage();
				});
			});

			// Also handle mouse leave on the entire container
			const container = document.querySelector('.gallery-image-hover-<?php echo esc_js($widget_id); ?>');
			if (container) {
				container.addEventListener('mouseleave', function() {
					isHovering = false;
					if (isVisible) {
						hideImage();
					}
				});
			}

			// Handle window resize
			window.addEventListener('resize', function() {
				if (isVisible) {
					// Adjust position if window is resized while visible
					const rect = hoverImage.getBoundingClientRect();
					targetX = rect.left;
					targetY = rect.top;
				}
			});

			// Clean up animation when leaving the page
			window.addEventListener('beforeunload', function() {
				stopAnimation();
			});
		}
	</script>
<?php endif; ?>