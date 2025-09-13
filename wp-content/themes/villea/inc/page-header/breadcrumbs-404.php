<?php
global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);

$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
  $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
  $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}
?>

<?php
$post_meta_data = '';
if (!empty($villea_option['page_banner_main']['url'])):
  $post_meta_data = $villea_option['page_banner_main']['url'];
endif;

if ($post_meta_data != '') {
?>
  <div class="themephi-breadcrumbs 404-breadcrumbs">
    <div class="breadcrumbs-single" style="background:<?php echo esc_attr($villea_option['breadcrumb_bg_color']); ?>">
      <img src="<?php echo esc_url($post_meta_data); ?>" alt="<?php echo esc_attr__('breadcrumb image', 'villea'); ?>">
      <div class="<?php echo esc_attr($header_width); ?>">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">

              <h1 class="page-title">
                <?php echo esc_html__("404 Page", 'villea'); ?>
              </h1>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } else {
?>
  <div class="themephi-breadcrumbs">
    <div class="breadcrumbs-single">
      <div class="<?php echo esc_attr($header_width); ?>">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">

              <h1 class="page-title">
                <?php echo esc_html__("404 Page", 'villea'); ?>
              </h1>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }


?>