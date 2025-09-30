		<!-- Gallery style 1 -->
		<div class="row rs-galleys elementor-image-gallery g-0 <?php echo esc_html($settings['gallery_column_gap']); ?> rs-gallery-<?php echo esc_attr($id) ?>" id="rs-gallery-<?php echo esc_attr($id) ?>" data-masonry='{ "columnWidth": ".gallery-masonry-item", "percentPosition": false }'>
			<?php
			foreach ($settings['rs-gallery'] as $image) {
				$gallery_item = wp_get_attachment_image_url($image['id'], $settings['thumbnail_size']);
				$gallery_titles =  get_post_field('post_title', $image['id']);
			?>
				<div class=" col-xl-<?php echo esc_html($settings['gallery_columns_xl']); ?> col-lg-<?php echo esc_html($settings['gallery_columns_lg']); ?> col-md-<?php echo esc_html($settings['gallery_columns_md']); ?> col-sm-<?php echo esc_html($settings['gallery_columns_sm']); ?> col-<?php echo esc_html($settings['gallery_columns']); ?> gallery-masonry-item">
					<div class="galley-img <?php echo esc_html($settings['gallery_effice']); ?> <?php echo esc_html($settings['gallery_style']); ?>">
						<a class="image-popup zoom-icon" href="<?php echo esc_url(wp_get_attachment_image_url($image['id'], 'Full')); ?>">
							<i class="<?php echo esc_html($settings['selected_icon']); ?>"></i>
						</a>
						<a class="img-wrap" href="<?php echo esc_url(wp_get_attachment_image_url($image['id'], 'Full')); ?>" title="Title 1">
							<img src="<?php echo esc_url($gallery_item); ?>" alt=" " class="w-100">
						</a>
						<?php
						if (!empty($gallery_titles) && ($settings['gallery_cation_style'] == 'show')) {
							echo '<h5 class="gallery-titles">' . $gallery_titles . '</h5>';
						}
						?>
					</div>
				</div>
			<?php } ?>
		</div>