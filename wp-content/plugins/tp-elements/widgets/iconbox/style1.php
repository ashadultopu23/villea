<div class="col-xxl-<?php echo esc_attr( $col_xxl ); ?> col-xl-<?php echo esc_attr( $col_xl ); ?> col-lg-<?php echo esc_attr( $col_lg ); ?> col-md-<?php echo esc_attr( $col_md ); ?> col-sm-<?php echo esc_attr( $col_sm ); ?> col-<?php echo esc_attr( $col_xs ); ?>">

	<div class="tp_elements-icon-box-widget">
		<div class="icon-box-item">

			<div class="icon-container<?php echo ( !empty($background_type) ? ' background-type-' . esc_attr($background_type) : '' ); ?>">

				<?php if( !empty( $image_url ) ){ ?>
				<div class="icon-area">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr__( 'Icon Image', 'tp-elements' ); ?>">
				</div>
				<?php } { 

					if ($icon_type == 'default') {
						echo '<i class="' . esc_attr($default_icon['value']) . '"></i>';
					}
					if ($icon_type == 'svg') {
						echo '<span class="icon">' . tp_elements_output_code($svg_icon) . '</span>';
					}

					if ($background_type == 'image') {
						if (!empty($bg_image['url'])) {
							echo '<img class="icon-container-bg-image" src="' . esc_url($bg_image['url']) . '" alt="' . esc_html__('Background Image', 'tp-elements') . '" />';
						}
					}
					if ($background_type == 'svg' && !empty($svg_background)) {
						echo '<span class="background">' . tp_elements_output_code($svg_background) . '</span>';
					}
				}
				?>

			</div>

			<div class="content-container">

				<h5 class="icon-box-title"><a href="<?php esc_url( the_permalink() ); ?>" class="tp_elements-heading-content"><?php the_title(); ?></a></h5>

				<?php
					echo '<div class="icon-box-info">';
						the_excerpt();
					echo '</div>';
				?>

			</div>

			<?php if(!empty($settings['services_btn_text'])){ ?>
			<div class="services-btn-part">
				<?php if(!empty($settings['services_btn_text'])) : 
					$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
				?>

				<?php  
					$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
				?>
					<a class="services-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink();?>" <?php echo wp_kses_post( $link_open ); ?>>
						<span class="btn-txt"><?php echo wp_kses_post( $settings['services_btn_text'] );?></span>
						<?php if(!empty($settings['services_btn_icon'])) : ?>
							<i class="fa <?php echo esc_html( $settings['services_btn_icon'] );?>"></i>
						<?php endif; ?>
					</a>
				<?php else: ?>
				<?php endif;
				?>
				
			</div>
			<?php } ?>

		</div>
	</div>


</div>