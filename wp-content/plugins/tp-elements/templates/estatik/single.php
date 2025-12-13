<?php

/**
 * Template Name: Single Property
 * Template Post Type: property
 */

$partials_path = plugin_dir_path(__FILE__) . 'partials/property-custom.php';



get_header();

global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
	$header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
	$header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

if (!empty($container_class)) {
	$header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
	$header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

?>

<div class="<?php echo esc_attr($header_width); ?> page-section es-custom-single-wrapper">

	<?php do_action('es_before_single_wrapper', get_the_ID()); ?>

	<div class='js-es-single es-single es-single--<?php echo ests('single_layout'); ?>' data-layout="<?php echo ests('single_layout'); ?>">
		<div class="js-es-single-property-layout">
			<?php
			if (file_exists($partials_path)) {
				include $partials_path;
			}
			?>


		</div>

		<?php $instance = es_get_sections_builder_instance();
		if ($sections = $instance::get_items('property')) :
			foreach ($sections as $section) :
				do_action('es_single_property_section', $section, get_the_ID());
			endforeach;
		endif; ?>
	</div>

	<?php do_action('es_after_single_wrapper', get_the_ID());


	?>
</div>
<?php

get_footer();
