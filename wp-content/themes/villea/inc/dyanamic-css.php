<?php
/*
dynamic css file. please don't edit it. it's update automatically when settings changed
*/
add_action('wp_head', 'villea_custom_colors', 160);
function villea_custom_colors()
{
	global $villea_option;
	/***styling options
------------------*/
	if (!empty($villea_option['body_bg_color'])) {
		$body_bg          = $villea_option['body_bg_color'];
	}

	$primaryColor 	= !empty($villea_option['primaryColor']) ? $villea_option['primaryColor'] : '';
	$secondaryColor = !empty($villea_option['secondaryColor']) ? $villea_option['secondaryColor'] : '';
	$linkColor      = !empty($villea_option['linkColor']) ? $villea_option['linkColor'] : '';
	$hoverColor 	= !empty($villea_option['hoverColor']) ? $villea_option['hoverColor'] : '';
	$titleColor 	= !empty($villea_option['titleColor']) ? $villea_option['titleColor'] : '';
	$bodyColor  	= !empty($villea_option['bodyColor']) ? $villea_option['bodyColor'] : '';
	$whiteColor  	= !empty($villea_option['whiteColor']) ? $villea_option['whiteColor'] : '';
	$globalColor  	= !empty($villea_option['globalColor']) ? $villea_option['globalColor'] : '';
	$borderColor  	= !empty($villea_option['borderColor']) ? $villea_option['borderColor'] : '';
	$boxBorderRadius = !empty($villea_option['boxBorderRadius']) ? $villea_option['boxBorderRadius'] : '';
	$imageBorderRadius = !empty($villea_option['imageBorderRadius']) ? $villea_option['imageBorderRadius'] : '';
	$blackColor  	= !empty($villea_option['blackColor']) ? $villea_option['blackColor'] : '';

	// btn
	$btnBorderRadius = !empty($villea_option['btnBorderRadius']) ? $villea_option['btnBorderRadius'] : '';
	$btnBgColor  	= !empty($villea_option['btnBgColor']) ? $villea_option['btnBgColor'] : '';
	$btnHoverBgColor  	= !empty($villea_option['btnHoverBgColor']) ? $villea_option['btnHoverBgColor'] : '';
	$btnColor  	= !empty($villea_option['btnColor']) ? $villea_option['btnColor'] : '';
	$btnHoverColor  	= !empty($villea_option['btnHoverColor']) ? $villea_option['btnHoverColor'] : '';
	$btnBgColor2  	= !empty($villea_option['btnBgColor2']) ? $villea_option['btnBgColor2'] : '';
	$btnHoverBgColor2  	= !empty($villea_option['btnHoverBgColor2']) ? $villea_option['btnHoverBgColor2'] : '';
	$btnColor2  	= !empty($villea_option['btnColor2']) ? $villea_option['btnColor2'] : '';
	$btnHoverColor2  	= !empty($villea_option['btnHoverColor2']) ? $villea_option['btnHoverColor2'] : '';


	//typography extract for body
	$body_typography_font      = !empty($villea_option['body_typography_font']['font-family']) ? $villea_option['body_typography_font']['font-family'] : '';
	$body_typography_font_size = !empty($villea_option['body_typography_font']['font-size']) ? $villea_option['body_typography_font']['font-size'] : '';
	$heading_typography_font   = !empty($villea_option['heading_typography_font']['font-family']) ? $villea_option['heading_typography_font']['font-family'] : '';
	$heading_typography_color   = !empty($villea_option['heading_typography_font']['color']) ? $villea_option['heading_typography_font']['color'] : '';
	// Banner Title Typography
	$page_title_typography_color   = !empty($villea_option['page_title_typography']['color']) ? $villea_option['page_title_typography']['color'] : '';
	$page_breadcrumbs_color   = !empty($villea_option['page_breadcrumbs_color']['color']) ? $villea_option['page_breadcrumbs_color']['color'] : '';
	$page_breadcrumbs_current_color   = !empty($villea_option['page_breadcrumbs_current_color']['color']) ? $villea_option['page_breadcrumbs_current_color']['color'] : '';
	// //typography extract for menu
	// $menu_typography_color       = !empty($villea_option['opt-typography-menu']['color']) ? $villea_option['opt-typography-menu']['color'] : '';
	// $menu_typography_weight      = !empty($villea_option['opt-typography-menu']['font-weight']) ? $villea_option['opt-typography-menu']['font-weight'] : '';
	// $menu_typography_font_family = !empty($villea_option['opt-typography-menu']['font-family']) ? $villea_option['opt-typography-menu']['font-family'] : '';
	// $menu_typography_font_fsize  = !empty($villea_option['opt-typography-menu']['font-size']) ? $villea_option['opt-typography-menu']['font-size'] : '';

	//typography extract for heading
	// h1
	$h1_typography_color = !empty($villea_option['h1_typography']['color']) ? $villea_option['h1_typography']['color'] : '';
	$h1_typography_weight = !empty($villea_option['h1_typography']['font-weight']) ? $villea_option['h1_typography']['font-weight'] : '';
	$h1_typography_font_family = !empty($villea_option['h1_typography']['font-family']) ? $villea_option['h1_typography']['font-family'] : '';
	$h1_typography_font_size = !empty($villea_option['h1_typography']['font-size']) ? $villea_option['h1_typography']['font-size'] : '';
	$h1_typography_line_height = !empty($villea_option['h1_typography']['line-height']) ? $villea_option['h1_typography']['line-height'] : '';

	// h2
	$h2_typography_color = !empty($villea_option['h2_typography']['color']) ? $villea_option['h2_typography']['color'] : '';
	$h2_typography_weight = !empty($villea_option['h2_typography']['font-weight']) ? $villea_option['h2_typography']['font-weight'] : '';
	$h2_typography_font_family = !empty($villea_option['h2_typography']['font-family']) ? $villea_option['h2_typography']['font-family'] : '';
	$h2_typography_font_size = !empty($villea_option['h2_typography']['font-size']) ? $villea_option['h2_typography']['font-size'] : '';
	$h2_typography_line_height = !empty($villea_option['h2_typography']['line-height']) ? $villea_option['h2_typography']['line-height'] : '';

	// h3
	$h3_typography_color = !empty($villea_option['h3_typography']['color']) ? $villea_option['h3_typography']['color'] : '';
	$h3_typography_font_family = !empty($villea_option['h3_typography']['font-family']) ? $villea_option['h3_typography']['font-family'] : '';
	$h3_typography_font_size = !empty($villea_option['h3_typography']['font-size']) ? $villea_option['h3_typography']['font-size'] : '';
	$h3_typography_weight = !empty($villea_option['h3_typography']['font-weight']) ? $villea_option['h3_typography']['font-weight'] : '';
	$h3_typography_line_height = !empty($villea_option['h3_typography']['line-height']) ? $villea_option['h3_typography']['line-height'] : '';
	$h3_typography_align = !empty($villea_option['h3_typography']['text-align']) ? $villea_option['h3_typography']['text-align'] : '';

	// h4
	$h4_typography_color = !empty($villea_option['h4_typography']['color']) ? $villea_option['h4_typography']['color'] : '';
	$h4_typography_weight = !empty($villea_option['h4_typography']['font-weight']) ? $villea_option['h4_typography']['font-weight'] : '';
	$h4_typography_font_family = !empty($villea_option['h4_typography']['font-family']) ? $villea_option['h4_typography']['font-family'] : '';
	$h4_typography_font_size = !empty($villea_option['h4_typography']['font-size']) ? $villea_option['h4_typography']['font-size'] : '';
	$h4_typography_line_height = !empty($villea_option['h4_typography']['line-height']) ? $villea_option['h4_typography']['line-height'] : '';

	// h5
	$h5_typography_color = !empty($villea_option['h5_typography']['color']) ? $villea_option['h5_typography']['color'] : '';
	$h5_typography_weight = !empty($villea_option['h5_typography']['font-weight']) ? $villea_option['h5_typography']['font-weight'] : '';
	$h5_typography_font_family = !empty($villea_option['h5_typography']['font-family']) ? $villea_option['h5_typography']['font-family'] : '';
	$h5_typography_font_size = !empty($villea_option['h5_typography']['font-size']) ? $villea_option['h5_typography']['font-size'] : '';
	$h5_typography_line_height = !empty($villea_option['h5_typography']['line-height']) ? $villea_option['h5_typography']['line-height'] : '';

	// h6
	$h6_typography_color = !empty($villea_option['h6_typography']['color']) ? $villea_option['h6_typography']['color'] : '';
	$h6_typography_weight = !empty($villea_option['h6_typography']['font-weight']) ? $villea_option['h6_typography']['font-weight'] : '';
	$h6_typography_font_family = !empty($villea_option['h6_typography']['font-family']) ? $villea_option['h6_typography']['font-family'] : '';
	$h6_typography_font_size = !empty($villea_option['h6_typography']['font-size']) ? $villea_option['h6_typography']['font-size'] : '';
	$h6_typography_line_height = !empty($villea_option['h6_typography']['line-height']) ? $villea_option['h6_typography']['line-height'] : '';

?>

	<!-- Typography -->
	<?php if (!empty($bodyColor)) {
		global $villea_option;
	?>
		<?php if (!empty($titleColor)) {
			global $villea_option;
		?>
			<style>
				:root {
					--body_bg: <?php echo sanitize_hex_color($body_bg); ?> !important;
					--primaryColor: <?php echo sanitize_hex_color($primaryColor); ?> !important;
					--secondaryColor: <?php echo sanitize_hex_color($secondaryColor); ?> !important;
					--linkColor: <?php echo sanitize_hex_color($linkColor); ?> !important;
					--hoverColor: <?php echo sanitize_hex_color($hoverColor); ?> !important;
					--bodyColor: <?php echo sanitize_hex_color($bodyColor); ?> !important;
					--titleColor: <?php echo sanitize_hex_color($titleColor); ?> !important;
					--whiteColor: <?php echo sanitize_hex_color($whiteColor); ?> !important;
					--globalColor: <?php echo sanitize_hex_color($globalColor); ?> !important;
					--borderColor: <?php echo sanitize_hex_color($borderColor); ?> !important;
					--boxBorderRadius: <?php echo esc_attr($boxBorderRadius) . 'px' ?> !important;
					--imageBorderRadius: <?php echo esc_attr($imageBorderRadius) . 'px' ?> !important;
					--blackColor: <?php echo sanitize_hex_color($blackColor); ?> !important;
					/* btn */
					--btnBorderRadius: <?php echo esc_attr($btnBorderRadius) . 'px' ?> !important;
					--btnBgColor: <?php echo sanitize_hex_color($btnBgColor); ?> !important;
					--btnHoverBgColor: <?php echo sanitize_hex_color($btnHoverBgColor); ?> !important;
					--btnColor: <?php echo sanitize_hex_color($btnColor); ?> !important;
					--btnHoverColor: <?php echo sanitize_hex_color($btnHoverColor); ?> !important;
					--btnBgColor2: <?php echo sanitize_hex_color($btnBgColor2); ?> !important;
					--btnHoverBgColor2: <?php echo sanitize_hex_color($btnHoverBgColor2); ?> !important;
					--btnColor2: <?php echo sanitize_hex_color($btnColor2); ?> !important;
					--btnHoverColor2: <?php echo sanitize_hex_color($btnHoverColor2); ?> !important;
					--bodyFont: "<?php echo esc_attr($body_typography_font); ?>", sans-serif;
					--titleFont: "<?php echo esc_attr($heading_typography_font); ?>", sans-serif;
				}

				body {
					background: <?php echo sanitize_hex_color($body_bg); ?> !important;
					color: <?php echo sanitize_hex_color($bodyColor); ?> !important;
					<?php echo !empty($body_typography_font) ? 'font-family: ' . esc_attr($body_typography_font) . ' !important;' : '';
					echo !empty($body_typography_font_size) ? 'font-size: ' . esc_attr($body_typography_font_size) . ' !important;' : ''; ?>
				}

				h1,
				h2,
				h3,
				h4,
				h5,
				h6 {
					<?php echo !empty($heading_typography_font) ? 'font-family: ' . esc_attr($heading_typography_font) . ' !important;' : '';
					echo !empty($heading_typography_color) ? 'color: ' . esc_attr($heading_typography_color) . ' !important;' : ''; ?>
				}

				h1 {
					<?php
					echo !empty($h1_typography_color) ? 'color: ' . sanitize_hex_color($h1_typography_color) . ' !important;' : '';
					echo !empty($h1_typography_font_family) ? 'font-family: ' . esc_attr($h1_typography_font_family) . ' !important;' : '';
					echo !empty($h1_typography_font_size) ? 'font-size: ' . esc_attr($h1_typography_font_size) . ' !important;' : '';
					echo !empty($h1_typography_weight) ? 'font-weight: ' . esc_attr($h1_typography_weight) . ' !important;' : '';
					echo !empty($h1_typography_line_height) ? 'line-height: ' . esc_attr($h1_typography_line_height) . ' !important;' : '';
					echo !empty($h1_typography_align) ? 'text-align: ' . esc_attr($h1_typography_align) . ' !important;' : '';
					?>
				}

				h2 {
					<?php
					echo !empty($h2_typography_color) ? 'color: ' . sanitize_hex_color($h2_typography_color) . ' !important;' : '';
					echo !empty($h2_typography_font_family) ? 'font-family: ' . esc_attr($h2_typography_font_family) . ' !important;' : '';
					echo !empty($h2_typography_font_size) ? 'font-size: ' . esc_attr($h2_typography_font_size) . ' !important;' : '';
					echo !empty($h2_typography_weight) ? 'font-weight: ' . esc_attr($h2_typography_weight) . ' !important;' : '';
					echo !empty($h2_typography_line_height) ? 'line-height: ' . esc_attr($h2_typography_line_height) . ' !important;' : '';
					echo !empty($h2_typography_align) ? 'text-align: ' . esc_attr($h2_typography_align) . ' !important;' : '';
					?>
				}

				h3 {
					<?php
					echo !empty($h3_typography_color) ? 'color: ' . sanitize_hex_color($h3_typography_color) . ' !important;' : '';
					echo !empty($h3_typography_font_family) ? 'font-family: ' . esc_attr($h3_typography_font_family) . ' !important;' : '';
					echo !empty($h3_typography_font_size) ? 'font-size: ' . esc_attr($h3_typography_font_size) . ' !important;' : '';
					echo !empty($h3_typography_weight) ? 'font-weight: ' . esc_attr($h3_typography_weight) . ' !important;' : '';
					echo !empty($h3_typography_line_height) ? 'line-height: ' . esc_attr($h3_typography_line_height) . ' !important;' : '';
					echo !empty($h3_typography_align) ? 'text-align: ' . esc_attr($h3_typography_align) . ' !important;' : '';
					?>
				}

				h4 {
					<?php
					echo !empty($h4_typography_color) ? 'color: ' . sanitize_hex_color($h4_typography_color) . ' !important;' : '';
					echo !empty($h4_typography_font_family) ? 'font-family: ' . esc_attr($h4_typography_font_family) . ' !important;' : '';
					echo !empty($h4_typography_font_size) ? 'font-size: ' . esc_attr($h4_typography_font_size) . ' !important;' : '';
					echo !empty($h4_typography_weight) ? 'font-weight: ' . esc_attr($h4_typography_weight) . ' !important;' : '';
					echo !empty($h4_typography_line_height) ? 'line-height: ' . esc_attr($h4_typography_line_height) . ' !important;' : '';
					echo !empty($h4_typography_align) ? 'text-align: ' . esc_attr($h4_typography_align) . ' !important;' : '';
					?>
				}

				h5 {
					<?php
					echo !empty($h5_typography_color) ? 'color: ' . sanitize_hex_color($h5_typography_color) . ' !important;' : '';
					echo !empty($h5_typography_font_family) ? 'font-family: ' . esc_attr($h5_typography_font_family) . ' !important;' : '';
					echo !empty($h5_typography_font_size) ? 'font-size: ' . esc_attr($h5_typography_font_size) . ' !important;' : '';
					echo !empty($h5_typography_weight) ? 'font-weight: ' . esc_attr($h5_typography_weight) . ' !important;' : '';
					echo !empty($h5_typography_line_height) ? 'line-height: ' . esc_attr($h5_typography_line_height) . ' !important;' : '';
					echo !empty($h5_typography_align) ? 'text-align: ' . esc_attr($h5_typography_align) . ' !important;' : '';
					?>
				}

				h6 {
					<?php
					echo !empty($h6_typography_color) ? 'color: ' . sanitize_hex_color($h6_typography_color) . ' !important;' : '';
					echo !empty($h6_typography_font_family) ? 'font-family: ' . esc_attr($h6_typography_font_family) . ' !important;' : '';
					echo !empty($h6_typography_font_size) ? 'font-size: ' . esc_attr($h6_typography_font_size) . ' !important;' : '';
					echo !empty($h6_typography_weight) ? 'font-weight: ' . esc_attr($h6_typography_weight) . ' !important;' : '';
					echo !empty($h6_typography_line_height) ? 'line-height: ' . esc_attr($h6_typography_line_height) . ' !important;' : '';
					echo !empty($h6_typography_align) ? 'text-align: ' . esc_attr($h6_typography_align) . ' !important;' : '';
					?>
				}


				h1 a,
				h2 a,
				h3 a,
				h4 a,
				h5 a,
				h6 a,
				h1 span,
				h2 span,
				h3 span,
				h4 span,
				h5 span,
				h6 span {
					color: inherit !important;
					font-size: inherit !important;
					font-weight: inherit !important;
					line-height: inherit !important;
				}

				.menu-area .navbar ul li>a,
				.sidenav .widget_nav_menu ul li a {
					<?php if (!empty($menu_typography_weight)) { ?>font-weight: <?php echo esc_attr($menu_typography_weight); ?>;
					<?php } ?><?php if (!empty($menu_typography_font_family)) { ?>font-family: <?php echo esc_attr($menu_typography_font_family); ?>;
					<?php } ?><?php if (! empty($menu_typography_font_fsize)) { ?>font-size: <?php echo esc_attr($menu_typography_font_fsize); ?>;
					<?php } ?>
				}



				<?php if (!empty($villea_option['breadcrumb_top_padding'])) : ?>.themephi-breadcrumbs .breadcrumbs-inner {
					padding-top: <?php echo esc_attr($villea_option['breadcrumb_top_padding']); ?> !important;
				}

				<?php endif; ?><?php if (!empty($villea_option['breadcrumb_bottom_padding'])) : ?>.themephi-breadcrumbs .breadcrumbs-inner {
					padding-bottom: <?php echo esc_attr($villea_option['breadcrumb_bottom_padding']); ?>;
				}

				<?php endif; ?><?php if (!empty($villea_option['breadcrumb_position'])) : ?>.themephi-breadcrumbs {
					margin-top: <?php echo esc_attr($villea_option['breadcrumb_position']); ?>;
				}

				<?php endif; ?><?php // if (!empty($villea_option['container_size'])) : 
								?>
				/* @media only screen and (min-width: 1400px) {
					.container {
						max-width: <?php // echo esc_attr($villea_option['container_size']); 
									?>;
					} 
				} */

				<?php // endif; 
				?><?php if (!empty($villea_option['preloader_bg_color'])) : ?>#villea-load {
					background: <?php echo sanitize_hex_color($villea_option['preloader_bg_color']); ?>;
				}

				<?php endif; ?><?php if (!empty($villea_option['preloader_animate_color2'])) : ?>#villea-load .lds-ring div {
					border-color: <?php echo sanitize_hex_color($villea_option['preloader_animate_color2']); ?> transparent transparent transparent;
				}

				<?php endif; ?><?php if (!empty($villea_option['align_breadcrumb'])) : ?>.themephi-breadcrumbs .breadcrumbs-inner {
					text-align: <?php echo esc_attr($villea_option['align_breadcrumb']); ?> !important;
				}

				<?php endif; ?><?php if (!empty($page_title_typography_color)) : ?>.themephi-breadcrumbs .page-title {
					color: <?php echo sanitize_hex_color($page_title_typography_color); ?> !important;
				}

				<?php endif; ?><?php if (!empty($page_breadcrumbs_color)) : ?>.themephi-breadcrumbs .breadcrumbs-title span a span {
					color: <?php echo sanitize_hex_color($page_breadcrumbs_color); ?> !important;
				}

				<?php endif; ?><?php if (!empty($page_breadcrumbs_current_color)) : ?>.themephi-breadcrumbs .breadcrumbs-title span.current-item {
					color: <?php echo sanitize_hex_color($page_breadcrumbs_current_color); ?> !important;
				}

				<?php endif; ?><?php if (!empty($villea_option['body_bg_color'])) : ?>body.archive.tax-product_cat {
					background: <?php echo sanitize_hex_color($villea_option['body_bg_color']); ?> !important;
				}

				<?php endif; ?>
			</style>

			<?php
		}

		if (is_home() && !is_front_page() || is_home() && is_front_page()) {
			$padding_top        = get_post_meta(get_queried_object_id(), 'content_top', true);
			$padding_bottom     = get_post_meta(get_queried_object_id(), 'content_bottom', true);
			$footer_padd_top    = get_post_meta(get_queried_object_id(), 'footer_padd_top', true);
			$footer_padd_bottom = get_post_meta(get_queried_object_id(), 'footer_padd_bottom', true);
			if ($padding_top != '' || $padding_bottom != '') {
			?>

			<?php
			}
			if ($footer_padd_top != '' || $footer_padd_bottom != '') {
			?>
				<style>
					.main-contain #content,
					body.themephi-pages-btm-gap .main-contain #content {
						<?php if (!empty($padding_top)) : ?>padding-top: <?php echo esc_attr($padding_top); ?>;
						<?php endif; ?><?php if (!empty($padding_bottom)) : ?>padding-bottom: <?php echo esc_attr($padding_bottom); ?>;
						<?php endif; ?>
					}
				</style>
			<?php
			}
		} else {
			$padding_top        = get_post_meta(get_the_ID(), 'content_top', true);
			$padding_bottom     = get_post_meta(get_the_ID(), 'content_bottom', true);
			$padding_top_small        = get_post_meta(get_the_ID(), 'content_top_small', true);
			$padding_bottom_small     = get_post_meta(get_the_ID(), 'content_bottom_small', true);
			$footer_padd_top    = get_post_meta(get_the_ID(), 'footer_padd_top', true);
			$footer_padd_bottom = get_post_meta(get_the_ID(), 'footer_padd_bottom', true);
			if ($padding_top != '' || $padding_bottom != '' || $padding_top_small != '' || $padding_bottom_small != '') {
			?>
				<style>
					.main-contain #content,
					body.themephi-pages-btm-gap .main-contain #content {

						/* Desktop Padding */
						@media (min-width:992px) {
							<?php if (!empty($padding_top)) : ?>padding-top: <?php echo esc_attr($padding_top); ?>;
							<?php endif; ?><?php if (!empty($padding_bottom)) : ?>padding-bottom: <?php echo esc_attr($padding_bottom); ?>;
							<?php endif; ?>
						}

						/* Responsive Padding */
						@media (max-width: 991px) {
							<?php if (!empty($padding_top_small)) : ?>padding-top: <?php echo esc_attr($padding_top_small); ?>;
							<?php endif; ?><?php if (!empty($padding_bottom_small)) : ?>padding-bottom: <?php echo esc_attr($padding_bottom_small); ?>;
							<?php endif; ?>
						}
					}
				</style>

			<?php
			}

			if ($footer_padd_top != '' || $footer_padd_bottom != '') {
			?>
				<style>
					.themephi-footer .footer-top {
						<?php if (!empty($footer_padd_top)) : ?>padding-top: <?php echo esc_attr($footer_padd_top); ?> !important;
						<?php endif; ?><?php if (!empty($footer_padd_bottom)) : ?>padding-bottom: <?php echo esc_attr($footer_padd_bottom); ?> !important;
						<?php endif; ?>
					}
				</style>
			<?php
			}
		}

		if (!class_exists('ReduxFrameworkPlugin')) {  ?>

			<style>
				@media only screen and (max-width: 1024px) {
					.sidebarmenu-area.primary-menu.mobilehum {
						display: block !important;
					}
				}
			</style>
<?php }
	}
}
