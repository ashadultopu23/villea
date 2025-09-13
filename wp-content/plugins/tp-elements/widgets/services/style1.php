<div class="themephi-addon-services <?php echo esc_attr($settings['image_or_icon_vertical_align']); ?> <?php echo esc_attr($settings['image_or_icon_position']); ?> services-<?php echo esc_attr($settings['services_style']); ?> services-<?php echo esc_attr($settings['service_grid_source']); ?>">

	<div class="services-part">
		<div class="image-btn-wrapper d-flex justify-content-between align-items-center">
			<?php if (!empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])) { ?>
				<div class="services-icon single-item-img">
					<?php if (!empty($settings['selected_icon'])) : ?>
						<?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
					<?php endif; ?>
					<?php if (!empty($settings['selected_image'])) : ?>
						<img src="<?php echo esc_url($settings['selected_image']['url']); ?>" alt="image" />
					<?php endif; ?>
				</div>
			<?php } ?>

			<?php if (!empty($settings['services_btn_show_hide']) && $settings['services_btn_show_hide'] == 'yes') { ?>
				<div class="services-btn-part">
					<?php
					$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
					$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
					?>

					<a class="services-btn <?php echo esc_attr($icon_position); ?>" href="<?php echo esc_url($settings['services_btn_link']); ?>" <?php echo wp_kses_post($link_open); ?>>
						<?php if ($settings['services_btn_icon_position'] == 'before') : ?>
							<?php if ($settings['services_btn_icon']): ?>
								<?php \Elementor\Icons_Manager::render_icon($settings['services_btn_icon'], ['aria-hidden' => 'true']); ?>
							<?php endif; ?>
						<?php endif; ?>
						<?php if (!empty($settings['services_btn_text'])) { ?>
							<span class="btn_text">
								<?php echo esc_html($settings['services_btn_text']); ?>
							</span>
						<?php } ?>
						<?php if ($settings['services_btn_icon_position'] == 'after') : ?>
							<?php if ($settings['services_btn_icon']): ?>
								<?php \Elementor\Icons_Manager::render_icon($settings['services_btn_icon'], ['aria-hidden' => 'true']); ?>
							<?php endif; ?>
						<?php endif; ?>
					</a>

				</div>
			<?php } ?>
		</div>
		<div class="services-text">

			<?php if (($settings['services_meta_show_hide'] == 'yes')) { ?>
				<ul class="service-meta">
					<?php if (!empty($settings['services_cat'])) { ?>
						<li><span class="meta_cat"><?php echo esc_html($settings['services_cat']); ?></span></li>
					<?php } ?>
				</ul>
			<?php } ?>

			<?php if (!empty($settings['title'])) { ?>
				<div class="services-title">
					<?php if (!empty($settings['title_link'])) :
						$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
					?>
						<<?php echo esc_html($settings['title_tag']); ?> class="title"> <a href="<?php echo esc_url($settings['title_link']); ?>" <?php echo wp_kses_post($link_open); ?>><?php echo esc_html($settings['title']); ?></a></<?php echo esc_html($settings['title_tag']); ?>>
					<?php else: ?>
						<<?php echo esc_html($settings['title_tag']); ?> class="title"> <?php echo esc_html($settings['title']); ?></<?php echo esc_html($settings['title_tag']); ?>>
					<?php endif; ?>
				</div>
			<?php } ?>

			<?php if (!empty($settings['text'])) : ?>
				<div class="services-desc"><?php echo wp_kses_post($settings['text']); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>