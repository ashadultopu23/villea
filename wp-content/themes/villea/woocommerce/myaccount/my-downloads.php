<?php

/**
 * My Downloads - Deprecated
 *
 * Shows downloads on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.0.0
 * @deprecated  2.6.0
 */

defined('ABSPATH') || exit;

$downloads = WC()->customer->get_downloadable_products();

if ($downloads) : ?>

	<?php do_action('woocommerce_before_available_downloads'); ?>

	<h2><?php echo apply_filters('woocommerce_my_account_my_downloads_title', esc_html__('Available downloads', 'villea')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
		?></h2>

	<ul class="woocommerce-Downloads digital-downloads">
		<?php foreach ($downloads as $download) : ?>
			<li>
				<?php

				$remaining = isset($download['downloads_remaining']) ? absint($download['downloads_remaining']) : 0;

				echo apply_filters(
					'woocommerce_available_download_count',
					'<span class="woocommerce-Count count">' .
						sprintf(
							_n('%s download remaining', '%s downloads remaining', $remaining, 'villea'),
							number_format_i18n($remaining)
						) .
						'</span>',
					$download
				);
				?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php do_action('woocommerce_after_available_downloads'); ?>

<?php endif; ?>