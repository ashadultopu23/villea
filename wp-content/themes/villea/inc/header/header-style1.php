<?php

/*
Header Style 1
*/
global $villea_option;
$sticky             = !empty($villea_option['off_sticky']) ? $villea_option['off_sticky'] : '';
$sticky_menu        = ($sticky == 1) ? ' menu-sticky' : '';
$drob_aligns        = (!empty($villea_option['drob_align_s'])) ? 'menu-drob-align' : '';
$mobile_hide_search = (!empty($villea_option['mobile_off_search'])) ? 'mobile-hide-search' : '';
$mobile_hide_cart   = (!empty($villea_option['mobile_off_cart'])) ? 'mobile-hide-cart-no' : 'mobile-hide-cart';
$mobile_hide_button = (!empty($villea_option['mobile_off_button'])) ? 'mobile-hide-button' : '';
$mobile_logo_height = !empty($villea_option['mobile_logo_height']) ? 'style = "max-height: ' . $villea_option['mobile_logo_height'] . '"' : '';

// Header Options here
require get_parent_theme_file_path('inc/header/header-options.php');
//off convas here
get_template_part('inc/header/off-canvas');
//off canvas modern
//get_template_part('inc/header/off-canvas-modern');

?>

<?php if (has_nav_menu('menu-1')) {
    $menugap_minus = 'menugap-minus';
} else {
    $menugap_minus = '';
}

//include sticky search here
get_template_part('inc/header/search');
?>

<!-- Header Menu Start -->
<?php
$menu_bg_color = !empty($menu_bg) ? 'style=background:' . $menu_bg . '' : '';
?>
<div class="menu-area" <?php echo wp_kses($menu_bg_color, 'villea'); ?>>
    <div class="menu_one">
        <!-- <div class="row-table"> -->
        <div class="col-cell header-logo">
            <?php if (has_custom_logo()) {
                the_custom_logo();
            ?>
            <?php } else {
                get_template_part('inc/header/logo');
            } ?>
        </div>

        <div class="col-cell menu-responsive primary-menu">
            <?php
            if (is_page_template('page-single.php')) {
                require get_parent_theme_file_path('inc/header/menu-single.php');
            } else {
                require get_parent_theme_file_path('inc/header/menu.php');
            }
            ?>
        </div>

        <div class="col-cell header-quote">
            <div class="sidebarmenu-area text-right primary-menu mobilehum">
                <div class="nav-link-container center">
                    <button class="nav-menu-link menu-button">
                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect y="14" width="18" height="2" fill="#ffffff"></rect>
                            <rect y="7" width="18" height="2" fill="#ffffff"></rect>
                            <rect width="18" height="2" fill="#ffffff"></rect>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>