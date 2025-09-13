<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}

use ReduxFramework\ReduxFrameworkPlugin;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

// This is your option name where all the Redux data is stored.
$opt_name = "villea_option";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('villea/opt_name', $opt_name);

/*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    'page_priority'        => 8,
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Villea Options', 'villea'),
    'page_title'           => esc_html__('Villea Options', 'villea'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 20,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    'forced_dev_mode_off' => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    'compiler' => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 20,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    'force_output' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = sprintf(esc_html__('Villea Theme', 'villea'), $v);
} else {
    $args['intro_text'] = esc_html__('Villea Theme', 'villea');
}

Redux::setArgs($opt_name, $args);

/*
     * ---> END ARGUMENTSvillea
      
     */
// -> START General Settings
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('General Settings', 'villea'),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'enable_global',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Global Style Settings', 'villea'),
                'subtitle' => esc_html__('If you enable global style settings all option will be work only theme option', 'villea'),
                'default'  => true,
            ),

            // array(
            //     'id'       => 'container_size',
            //     'title'    => esc_html__('Container Size', 'villea'),
            //     'subtitle' => esc_html__('Container Size example(1350px)', 'villea'),
            //     'type'     => 'text',
            //     'default'  => '1320px'
            // ),

            // array(
            //     'id'       => 'tp_favicon',
            //     'type'     => 'media',
            //     'title'    => esc_html__('Upload Favicon', 'villea'),
            //     'subtitle' => esc_html__('Upload your faviocn here', 'villea'),
            //     'url' => true
            // ),

            array(
                'id'       => 'off_sticky',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Sticky Menu', 'villea'),
                'subtitle' => esc_html__('You can show or hide sticky menu here', 'villea'),
                'default'  => false,
            ),
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch',
                'title'    => esc_html__('Scroll to Top', 'villea'),
                'subtitle' => esc_html__('You can show or hide here', 'villea'),
                'default'  => false,
            ),

            array(
                'id'       => 'container_class',
                'type'     => 'image_select',
                'title'    => esc_html__('Container Layout', 'villea'),
                'subtitle' => esc_html__('Select your shop layout', 'villea'),
                'options'  => array(
                    'container' => array(
                        'alt'   => esc_html__('Container', 'villea'),
                        'img'   => get_template_directory_uri() . '/libs/img/2c.png'
                    ),
                    'fluid'      => array(
                        'alt'   => esc_html__('Container Fluid', 'villea'),
                        'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                    ),
                ),
                'default' => 'container'
            ),
        )
    )
);


//Preloader settings
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Preloader Style', 'villea'),
        'desc'   => esc_html__('Preloader Style Here', 'villea'),
        'fields' => array(
            array(
                'id'       => 'show_preloader',
                'type'     => 'switch',
                'title'    => esc_html__('Show Preloader', 'villea'),
                'subtitle' => esc_html__('You can show or hide preloader', 'villea'),
                'default'  => false,
            ),

            array(
                'id'        => 'preloader_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Preloader Background Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#212121',
                'validate'  => 'color',
            ),


            array(
                'id'        => 'preloader_animate_color2',
                'type'      => 'color',
                'title'     => esc_html__('Preloader Circle Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#A58EFF',
                'validate'  => 'color',
                'output'    => array('background' => '.lds-ellipsis div')
            ),


            array(
                'id'    => 'preloader_img',
                'url'   => true,
                'title' => esc_html__('Preloader Image', 'villea'),
                'type'  => 'media',
            ),
        )
    )
);
//End Preloader settings 

// -> START Style Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Style', 'villea'),
    'id'               => 'stle',
    'customizer_width' => '450px',
    'icon' => 'el el-brush',


));

Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Global Style', 'villea'),
        'desc'   => esc_html__('Style your theme', 'villea'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'       => 'global_style_notice',
                'type'     => 'info',
                'style'    => 'warning',
                'title'    => esc_html__('Notice', 'villea'),
                'desc'     => sprintf(
                    esc_html__('Please enable %s switch to use these options', 'villea'),
                    '<strong> <i>' . esc_html__('General Settings > Enable Global Style Settings', 'villea') . '</i></strong>'
                ),
                'hidden'   => function ($value) {
                    global $villea_options;
                    return isset($villea_options['enable_global']) && $villea_options['enable_global'] == true;
                },
                'required'         => array('enable_global', '=', '0'),
            ),

            array(
                'id'        => 'body_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'villea'),
                'subtitle'  => esc_html__('Pick body background color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'bodyColor',
                'type'      => 'color',
                'title'     => esc_html__('Body Color', 'villea'),
                'subtitle'  => esc_html__('Pick text color', 'villea'),
                'default'   => '#404A60',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'titleColor',
                'type'      => 'color',
                'title'     => esc_html__('Heading Color', 'villea'),
                'subtitle'  => esc_html__('Pick text color', 'villea'),
                'default'   => '#222E48',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'primaryColor',
                'type'      => 'color',
                'title'     => esc_html__('Primary Color', 'villea'),
                'subtitle'  => esc_html__('Select Primary Color.', 'villea'),
                'default'   => '#2660B5',
                'validate'  => 'color',
                // 'output'      => array('.themephi-heading .title-inner .sub-text,  .menu-area .navbar ul li:hover a'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'secondaryColor',
                'type'      => 'color',
                'title'     => esc_html__('Secondary Color', 'villea'),
                'subtitle'  => esc_html__('Select Secondary Color.', 'villea'),
                'default'   => '#EB7A23',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),
            array(
                'id'        => 'globalColor',
                'type'      => 'color',
                'title'     => esc_html__('Global Color', 'villea'),
                'subtitle'  => esc_html__('Global color', 'villea'),
                'default'   => '#F5F5F5',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),
            array(
                'id'        => 'borderColor',
                'type'      => 'color',
                'title'     => esc_html__('Border Color', 'villea'),
                'subtitle'  => esc_html__('Border color', 'villea'),
                'default'   => '#DFE0E4',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),
            array(
                'id'            => 'boxBorderRadius',
                'type'          => 'slider',
                'title'         => esc_html__('Border Radius', 'villea'),
                'subtitle'      => esc_html__('Set border radius in pixels (0-200px)', 'villea'),
                'default'       => 5,
                'min'           => 0,
                'step'          => 1,
                'max'           => 200,
                'unit'          => 'px',
                'display_value' => 'text',
                'required'         => array('enable_global', '=', '1'),
            ),
            array(
                'id'            => 'imageBorderRadius',
                'type'          => 'slider',
                'title'         => esc_html__('Image Border Radius', 'villea'),
                'subtitle'      => esc_html__('Set border radius in pixels (0-200px)', 'villea'),
                'default'       => 4,
                'min'           => 0,
                'step'          => 1,
                'max'           => 200,
                'unit'          => 'px',
                'display_value' => 'text',
                'required'         => array('enable_global', '=', '1'),
            ),
            array(
                'id'        => 'linkColor',
                'type'      => 'color',
                'title'     => esc_html__('Link Color', 'villea'),
                'subtitle'  => esc_html__('Pick Link color', 'villea'),
                'default'   => '#2660B5',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'hoverColor',
                'type'      => 'color',
                'title'     => esc_html__('Link Hover Color', 'villea'),
                'subtitle'  => esc_html__('Pick link hover color', 'villea'),
                'default'   => '#EB7A23',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'whiteColor',
                'type'      => 'color',
                'title'     => esc_html__('White Color', 'villea'),
                'subtitle'  => esc_html__('White color', 'villea'),
                'default'   => '#FFFFFF',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),
            array(
                'id'        => 'blackColor',
                'type'      => 'color',
                'title'     => esc_html__('Black Color', 'villea'),
                'subtitle'  => esc_html__('Black color', 'villea'),
                'default'   => '#000000',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),
        )
    )
);


//Button settings
Redux::setSection(
    $opt_name,
    array(
        'title'      => esc_html__('Button Style', 'villea'),
        'desc'       => esc_html__('Button Style Your Theme', 'villea'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'       => 'btn_style_notice',
                'type'     => 'info',
                'style'    => 'warning',
                'title'    => esc_html__('Notice', 'villea'),
                'desc'     => sprintf(
                    esc_html__('Please enable %s switch to use these options', 'villea'),
                    '<strong> <i>' . esc_html__('General Settings > Enable Global Style Settings', 'villea') . '</i></strong>'
                ),
                'hidden'   => function ($value) {
                    global $villea_options;
                    return isset($villea_options['enable_global']) && $villea_options['enable_global'] == true;
                },
                'required'         => array('enable_global', '=', '0'),
            ),

            array(
                'id'     => 'notice_critical',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'success',
                'title'  => esc_html__('Primary Button Style', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'            => 'btnBorderRadius',
                'type'          => 'slider',
                'title'         => esc_html__('Border Radius', 'villea'),
                'subtitle'      => esc_html__('Set border radius in pixels (0-200px)', 'villea'),
                'default'       => 5,
                'min'           => 0,
                'step'          => 1,
                'max'           => 200,
                'unit'          => 'px',
                'display_value' => 'text',
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'btnBgColor',
                'type'      => 'color',
                'title'     => esc_html__('Background Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#2660B5',
                'validate'  => 'color',
                'output'    => array('background-color' => '.themephi-button a'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'btnHoverBgColor',
                'type'      => 'color',
                'title'     => esc_html__('Hover Background', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#EB7A23',
                'validate'  => 'color',
                'output'    => array('background' => '.themephi-button a:hover::before'),
                'required'         => array('enable_global', '=', '1'),

            ),

            array(
                'id'        => 'btnColor',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button a'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'btnHoverColor',
                'type'      => 'color',
                'title'     => esc_html__('Hover Text Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button a:hover'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'     => 'notice_critical2',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'success',
                'title'  => esc_html__('Seconday Button Style', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'btnBgColor2',
                'type'      => 'color',
                'title'     => esc_html__('Background Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => 'transparent',
                'validate'  => 'color',
                'output'    => array('background-color' => '.themephi-button.secondary_btn a'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'btnHoverBgColor2',
                'type'      => 'color',
                'title'     => esc_html__('Hover Background', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#2660B5',
                'validate'  => 'color',
                'output'    => array('background' => '.themephi-button.secondary_btn a:after'),
                'required'         => array('enable_global', '=', '1'),

            ),

            array(
                'id'        => 'btnColor2',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#222E48',
                'validate'  => 'color',
                'output'    => array('.themephi-button.secondary_btn a'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'btnHoverColor2',
                'type'      => 'color',
                'title'     => esc_html__('Hover Text Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'output'    => array('.themephi-button.secondary_btn a:after'),
                'required'         => array('enable_global', '=', '1'),
            ),
        )
    )
);

//Breadcrumb settings
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Breadcrumb Style', 'villea'),
        'desc'       => esc_html__('Breadcrumb Style Your Theme', 'villea'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'       => 'breadcrumb_style_notice',
                'type'     => 'info',
                'style'    => 'warning',
                'title'    => esc_html__('Notice', 'villea'),
                'desc'     => sprintf(
                    esc_html__('Please enable %s switch to use these options', 'villea'),
                    '<strong> <i>' . esc_html__('General Settings > Enable Global Style Settings', 'villea') . '</i></strong>'
                ),
                'hidden'   => function ($value) {
                    global $villea_options;
                    return isset($villea_options['enable_global']) && $villea_options['enable_global'] == true;
                },
                'required'         => array('enable_global', '=', '0'),
            ),

            array(
                'id'       => 'off_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__('Show off Breadcrumb', 'villea'),
                'subtitle' => esc_html__('You can show or hide off breadcrumb here', 'villea'),
                'default'  => true,
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'      => 'align_breadcrumb',
                'type'    => 'select',
                'title'    => esc_html__('Breadcrumb Alignment', 'villea'),
                'default'  => 'center',
                'options' => array(
                    'start' => __('Left', 'villea'),
                    'center'   => __('Center', 'villea'),
                    'end'     => __('Right', 'villea'),
                ),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'breadcrumb_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Bg Color', 'villea'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
                'required'         => array('enable_global', '=', '1'),
            ),

            // array(
            //     'id'        => 'page_title_color',
            //     'type'      => 'color',
            //     'title'     => esc_html__('Banner Title Color', 'villea'),
            //     'subtitle'  => esc_html__('Pick color', 'villea'),
            //     'default'   => '#00100B',
            //     'validate'  => 'color',
            // ),

            array(
                'id'       => 'page_banner_main',
                'type'     => 'media',
                'title'    => esc_html__('Background Banner', 'villea'),
                'subtitle' => esc_html__('Upload your banner', 'villea'),
                'default' => [
                    'url' => get_template_directory_uri() . '/assets/images/breadcrum_bg.png',
                ],
                'url'      => true, // Allow URL upload
                'preview'  => true, // Enable preview of the image
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'breadcrumb_top_padding',
                'type'      => 'text',
                'title'     => esc_html__('Padding Top', 'villea'),
                'desc'    => esc_html__('Type ex: 90px', 'villea'),
                'placeholder'      => esc_html__('Type ex: 90px', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'breadcrumb_bottom_padding',
                'type'      => 'text',
                'title'     => esc_html__('Padding Bottom', 'villea'),
                'desc'    => esc_html__('Type ex: 80px', 'villea'),
                'placeholder'      => esc_html__('Type ex: 80px', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),

            // array(
            //     'id'        => 'mobile_breadcrumb_top_padding',
            //     'type'      => 'text',
            //     'title'     => esc_html__('Mobile Top Gap', 'villea'),
            //     'default'   => '90px',

            // ),
            // array(
            //     'id'        => 'mobile_breadcrumb_bottom_padding',
            //     'type'      => 'text',
            //     'title'     => esc_html__('Mobile Bottom Gap', 'villea'),
            //     'default'   => '80px',
            // ),

            array(
                'id'        => 'breadcrumb_position',
                'type'      => 'text',
                'title'     => esc_html__('Top Postion', 'villea'),
                'placeholder'      => esc_html__('Type ex: 0px', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),


            array(
                'id'          => 'page_title_typography',
                'type'        => 'typography',
                'title'       => __('Banner Title Typography', 'villea'),
                'output'      => array('.themephi-breadcrumbs .page-title'),
                'units'       => 'px',
                'subtitle'    => __('Typography option with each property can be called individually.', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'          => 'page_breadcrumbs_color',
                'type'        => 'typography',
                'title'       => __('Banner Breadcrumbs Typography', 'villea'),
                'output'      => array('.themephi-breadcrumbs .breadcrumbs-title span, .themephi-breadcrumbs .breadcrumbs-title span a:before'),
                'units'       => 'px',
                'subtitle'    => __('Typography option with each property can be called individually.', 'villea'),
                'required'         => array('enable_global', '=', '1'),
            ),

            array(
                'id'        => 'page_breadcrumbs_current_color',
                'type'      => 'color',
                'title'       => __('Banner Breadcrumbs Current Color', 'villea'),
                'output'      => array('body .themephi-breadcrumbs .breadcrumbs-title span.current-item'),
                'subtitle'  => esc_html__('Pick color', 'villea'),
                'default'   => '#b5b5b5',
                'required'         => array('enable_global', '=', '1'),
            ),


        )
    )
);

//-> START Typography
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Typography', 'villea'),
        'id'     => 'typography',
        'desc'   => esc_html__('You can specify your body and heading font here', 'villea'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'body_typography_font',
                'type'     => 'typography',
                'title'    => esc_html__('Body Font', 'villea'),
                'subtitle' => esc_html__('Specify the body font properties.', 'villea'),
                'google'   => true,
                'font-style' => false,
                'default'  => array(
                    'font-family' => 'Jost',
                ),
            ),
            array(
                'id'       => 'heading_typography_font',
                'type'     => 'typography',
                'title'    => esc_html__('Heading Typography', 'villea'),
                'subtitle' => esc_html__('Specify the heading font properties.', 'villea'),
                'google'   => true,
                'font-style' => false,
                'default'  => array(
                    'font-family' => 'Jost',
                ),
            ),

            // // heading
            array(
                'id'          => 'h1_typography',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H1', 'villea'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'villea'),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'h2_typography',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H2', 'villea'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'villea'),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'h3_typography',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H3', 'villea'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'villea'),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'h4_typography',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H4', 'villea'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'villea'),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'h5_typography',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H5', 'villea'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'villea'),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),
            array(
                'id'          => 'h6_typography',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H6', 'villea'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'villea'),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),

        )
    )

);


if (class_exists('WooCommerce')) {
    Redux::setSection(
        $opt_name,
        array(
            'title'  => esc_html__('Woocommerce', 'villea'),
            'icon'   => 'el el-shopping-cart',
        )
    );

    Redux::setSection(
        $opt_name,
        array(
            'title'            => esc_html__('Shop', 'villea'),
            'id'               => 'shop_layout',
            'customizer_width' => '450px',
            'subsection' => true,
            'fields'           => array(
                array(
                    'id'        => 'shop_banner_bg_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Shop Banner Backgroud Color', 'villea'),
                    'subtitle'  => esc_html__('Pick banner background color', 'villea'),
                    'validate'  => 'color',
                ),

                array(
                    'id'       => 'shop_banner_main',
                    'url'      => true,
                    'title'    => esc_html__('Shop Page Banner Image', 'villea'),
                    'type'     => 'media',
                ),
                // array(
                //     'id'       => 'shop_long_title',
                //     'url'      => true,
                //     'title'    => esc_html__('Shop Long Title', 'villea'),
                //     'type'     => 'text',
                // ), 

                array(
                    'id'       => 'shop_banner_title',
                    'url'      => true,
                    'title'    => esc_html__('Shop Title', 'villea'),
                    'type'     => 'text',
                    'placeholder' => esc_html__('Enter a Shop Title', 'villea'),

                ),

                array(
                    'id'       => 'shop_container_class',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Container Layout', 'villea'),
                    'subtitle' => esc_html__('Select your shop layout', 'villea'),
                    'options'  => array(
                        'container' => array(
                            'alt'   => esc_html__('Container', 'villea'),
                            'img'   => get_template_directory_uri() . '/libs/img/2c.png'
                        ),
                        'fluid'      => array(
                            'alt'   => esc_html__('Container Fluid', 'villea'),
                            'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                        ),
                    ),
                    'default' => 'container'
                ),

                array(
                    'id'               => 'shop_sidebar_layout_style',
                    'type'             => 'select',
                    'title'            => esc_html__('Shop Sidebar Layout Style', 'villea'),
                    'desc'             => esc_html__('Select the default shop layout style', 'villea'),
                    'options'          => array(
                        'default'             => esc_html__('Default', 'villea'),
                        'modern'             => esc_html__('Modern', 'villea'),
                        'flyout'             => esc_html__('Flyout', 'villea'),
                    ),
                    'placeholder'      => esc_html__('Choose Shop Sidebar Layout...', 'villea'),
                    'default'          => 'default',
                ),

                array(
                    'id'       => 'shop-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Shop Layout', 'villea'),
                    'subtitle' => esc_html__('Select your shop layout', 'villea'),
                    'options'  => array(
                        'full'      => array(
                            'alt'   => esc_html__('Full Width', 'villea'),
                            'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                        ),
                        'right-col' => array(
                            'alt'   => esc_html__('Right Sidebar', 'villea'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cr.png'
                        ),
                        'left-col'  => array(
                            'alt'   => esc_html__('Left Sidebar', 'villea'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cl.png'
                        ),
                    ),
                    'default' => 'full',
                ),

                array(
                    'id'       => 'sidebar_icon_type',
                    'type'     => 'select',
                    'title'    => esc_html__('Sidebar Icon Type', 'villea'),
                    'options'  => array(
                        'image' => esc_html__('Upload SVG Icon', 'villea'),
                        'font'  => esc_html__('Font Awesome Icon', 'villea'),
                    ),
                    'default'  => 'font',
                    'required' => array(
                        array('shop-layout', '=', array('right-col', 'left-col')),
                        array('shop_sidebar_layout_style', '=', array('flyout', 'modern')),
                    ),
                ),

                array(
                    'id'       => 'icon_image_upload',
                    'type'     => 'media',
                    'title'    => esc_html__('Upload Icon SVG', 'villea'),
                    'library_filter' => array('gif', 'jpg', 'jpeg', 'png', 'svg', 'webp'),
                    'url'      => true,
                    'default'  => array('url' => ''),
                    'required' => array('sidebar_icon_type', '=', 'image'), // Only show if 'image' is selected
                ),

                array(
                    'id'       => 'fontawesome_icon_class',
                    'type'     => 'text',
                    'title'    => esc_html__('Font Awesome Icon Class', 'villea'),
                    'subtitle' => esc_html__('Example: fa-solid fa-user', 'villea'),
                    'default'  => 'fa-solid fa-bars-staggered',
                    'required' => array('sidebar_icon_type', '=', 'font'), // Only show if 'font' is selected
                ),

                // array(
                //     'id'       => 'custom_icon_upload',
                //     'type'     => 'media',
                //     'title'    => esc_html__('Upload Icon', 'villea'),
                //     'subtitle' => esc_html__('Upload an icon image (SVG, PNG, etc.)', 'villea'),
                //     'library_filter' => array('gif', 'jpg', 'jpeg', 'png', 'svg', 'webp'),
                //     'url'      => true,
                //     'default'  => array(
                //         'url' => '', // Optionally add default icon URL
                //     ),
                //     'required'         => array('shop-layout', '=', ['right-col', 'left-col'])
                // ),

                array(
                    'id'       => 'shop_sidebar_icon_position',
                    'type'     => 'switch',
                    'title'    => esc_html__('Sidebar Icon Position', 'villea'),
                    'on'       => esc_html__('Right', 'villea'),
                    'off'      => esc_html__('Left', 'villea'),
                    'default'  => false,
                    'required' => array(
                        array('shop-layout', '=', array('right-col', 'left-col')),
                        array('shop_sidebar_layout_style', '=', array('flyout', 'modern')),
                    ),
                ),

                array(
                    'id'               => 'shop_layout_style',
                    'type'             => 'select',
                    'title'            => esc_html__('Shop Layout Style', 'villea'),
                    'desc'             => esc_html__('Select the default shop layout style', 'villea'),
                    'options'          => array(
                        'grid'             => esc_html__('Grid', 'villea'),
                        'list'             => esc_html__('List', 'villea'),
                    ),
                    'placeholder'      => esc_html__('Choose Shop Layout...', 'villea'),
                    'default'          => 'grid'
                ),

                array(
                    'id'       => 'shop_grid_columns',
                    'type'     => 'select',
                    'title'    => esc_html__('Number of Products Per Row', 'villea'),
                    'options'          => array(
                        '1'             => esc_html__('Column 1', 'villea'),
                        '2'             => esc_html__('Column 2', 'villea'),
                        '3'             => esc_html__('Column 3', 'villea'),
                        '4'             => esc_html__('Column 4', 'villea'),
                        '6'             => esc_html__('Column 6', 'villea'),
                        '12'             => esc_html__('Column 12', 'villea'),
                    ),
                    'default'  => 4,
                    'required'         => array('shop_layout_style', '=', 'grid')
                ),

                array(
                    'id'       => 'wc_num_product_per_page',
                    'type'     => 'slider',
                    'title'    => esc_html__('Number of Products Per Page', 'villea'),
                    'default'  => 9,
                    'min'      => 1,
                    'step'     => 1,
                    'max'      => 20,
                ),

                array(
                    'id'       => 'product_excerpt_trim_words',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Trim Words', 'villea'),
                    'default'  => 9,
                    'min'      => 1,
                    'step'     => 1,
                    'max'      => 100,
                    'placeholder' => esc_html__('Enter a number (e.g., 9)', 'villea'),

                ),



                // array(
                //     'id'       => 'wc_cart_icon',
                //     'type'     => 'switch',
                //     'title'    => esc_html__('Cart Icon Show At Menu Area', 'villea'),
                //     'on'       => esc_html__('Enabled', 'villea'),
                //     'off'      => esc_html__('Disabled', 'villea'),
                //     'default'  => false,
                // ),

                // array(
                //     'id'       => 'disable-sidebar',
                //     'type'     => 'switch',
                //     'title'    => esc_html__('Sidebar Disable For Single Product Page', 'villea'),
                //     'default'  => true,
                // ),

                array(
                    'id'       => 'wc_wishlist_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Wishlist Icon', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_quickview_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Product Quickview Icon', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_compare_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Product Compare Icon', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_cart_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Product Cart Icon', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_show_percentage',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Percentage Badge', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_show_sale',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Product Sale Badge', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_show_new',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Product New Badge', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_new_product_days',
                    'type'     => 'text',
                    'title'    => esc_html__('Enter Numbers for New Badge', 'villea'),
                    'desc'     => esc_html__('Select last day, when uploaded products will show a new badge.', 'villea'),
                    'default'  => '15',
                    'placeholder' => esc_html__('Enter a number (e.g., 15)', 'villea'),

                    'required' => array('wc_show_new', '=', true)
                ),
                array(
                    'id'       => 'wc_show_hot',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Product Hot Badge', 'villea'),
                    'on'       => esc_html__('Enabled', 'villea'),
                    'off'      => esc_html__('Disabled', 'villea'),
                    'default'  => true,
                ),

                array(
                    'id'       => 'wc_hot_product_product',
                    'type'     => 'text',
                    'title'    => esc_html__('Enter numbers for hot badge', 'villea'),
                    'default'  => 20,
                    'placeholder' => esc_html__('Enter a number (e.g., 20)', 'villea'),
                    'required' => array('wc_show_hot', '=', true)
                ),


            )
        )
    );
    Redux::setSection(
        $opt_name,
        array(
            'title'            => esc_html__('Shop Single', 'villea'),
            'id'               => 'shop_single',
            'customizer_width' => '450px',
            'subsection' => true,
            'fields'           => array(

                array(
                    'id'       => 'shop_banner_single',
                    'url'      => true,
                    'title'    => esc_html__('Shop Single page banner', 'villea'),
                    'type'     => 'media',
                ),

                // array(
                //     'id'       => 'single-gallery-layout',
                //     'type'     => 'image_select',
                //     'title'    => esc_html__('Single Product Gallery Layout', 'villea'),
                //     'subtitle' => esc_html__('Select single page gallery layout', 'villea'),
                //     'options'  => array(
                //         'default-thumb'      => array(
                //             'alt'   => esc_html__('Style 1', 'villea'),
                //             'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                //         ),
                //         'right-thumb' => array(
                //             'alt'   => esc_html__('Style 2', 'villea'),
                //             'img'   => get_template_directory_uri() . '/libs/img/2cr.png'
                //         ),
                //         'left-thumb'  => array(
                //             'alt'   => esc_html__('Style 3', 'villea'),
                //             'img'   => get_template_directory_uri() . '/libs/img/2cl.png'
                //         ),
                //     ),
                //     'default' => 'default-thumb'
                // ),

                // array(
                //     'id'       => 'single_shop_banner_title',
                //     'url'      => true,
                //     'title'    => esc_html__(' Shop Single Title', 'villea'),
                //     'type'     => 'text',
                // ),

                array(
                    'id'       => 'single_releted_products_col',
                    'type'     => 'slider',
                    'title'    => esc_html__('Coloumn Number of Releted Products in Product detail Page', 'villea'),
                    'default'  => 4,
                    'min'      => 1,
                    'step'     => 1,
                    'max'      => 5,
                ),

            )
        )
    );
}

// Portfolio
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Portfolio Page', 'villea'),
        'id'               => 'portfolio_setting',
        'customizer_width' => '450px',
        'icon' => 'el el-align-right',
        'fields'           => array(

            array(
                'id'    => 'portfolio_banner_main',
                'url'   => true,
                'title' => esc_html__('Portfolio Page Banner', 'villea'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'portfolio_banner_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Portfolio Banner Backgroud Color', 'villea'),
                'subtitle'  => esc_html__('Pick banner background color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),

            array(
                'id'       => 'portfolio_title',
                'title'    => esc_html__('Portfolio Title', 'villea'),
                'subtitle' => esc_html__('Enter Portfolio  Title Here', 'villea'),
                'type'     => 'text',
                'placeholder' => esc_html__('Enter Title', 'villea'),

            ),

            array(
                'id'       => 'portfolio_slug',
                'title'    => esc_html__('Portfolio Slug', 'villea'),
                'subtitle' => esc_html__('Enter Portfolio Slug Here', 'villea'),
                'type'     => 'text',
                'default'  => 'portfolios',
                'placeholder' => esc_html__('Enter Slug', 'villea'),

            ),

            array(
                'id'       => 'portfolio_cat_slug',
                'title'    => esc_html__('Portfolio Category Slug', 'villea'),
                'subtitle' => esc_html__('Enter Portfolio Cat Slug Here', 'villea'),
                'type'     => 'text',
                'default'  => 'portfolio-category',
                'placeholder' => esc_html__('Enter Category Slug', 'villea'),
            ),
        )
    )
);

// Service
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Service Page', 'villea'),
        'id'               => 'service_setting',
        'customizer_width' => '450px',
        'icon' => 'el el-align-right',
        'fields'           => array(

            array(
                'id'    => 'service_banner_main',
                'url'   => true,
                'title' => esc_html__('Service Page Banner', 'villea'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'service_banner_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Service Banner Background Color', 'villea'),
                'subtitle'  => esc_html__('Pick banner background color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),

            array(
                'id'       => 'service_title',
                'title'    => esc_html__('Service Title', 'villea'),
                'subtitle' => esc_html__('Enter Service  Title Here', 'villea'),
                'type'     => 'text',
                'placeholder' => esc_html__('Enter Title', 'villea'),
            ),

            array(
                'id'       => 'service_slug',
                'title'    => esc_html__('Service Slug', 'villea'),
                'subtitle' => esc_html__('Enter Service Slug Here', 'villea'),
                'type'     => 'text',
                'default'  => 'services',
                'placeholder' => esc_html__('Enter Slug', 'villea'),
            ),

            array(
                'id'       => 'service_cat_slug',
                'title'    => esc_html__('Service Category Slug', 'villea'),
                'subtitle' => esc_html__('Enter Service Cat Slug Here', 'villea'),
                'type'     => 'text',
                'default'  => 'service-category',
                'placeholder' => esc_html__('Enter Category Slug', 'villea'),
            ),
            array(
                'id'               => 'service-layout',
                'type'             => 'image_select',
                'title'            => esc_html__('Select Service Layout', 'villea'),
                'subtitle'         => esc_html__('Select your service layout', 'villea'),
                'options'          => array(
                    'full'             => array(
                        'alt'              => esc_html__('Service Style 1', 'villea'),
                        'img'              => get_template_directory_uri() . '/libs/img/1c.png'
                    ),
                    '2right'           => array(
                        'alt'              => esc_html__('Service Style 2', 'villea'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cr.png'
                    ),
                    '2left'            => array(
                        'alt'              => esc_html__('Service Style 3', 'villea'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cl.png'
                    ),
                ),
                'default'          => '2right'
            ),
            array(
                'id'               => 'service_layout_style',
                'type'             => 'select',
                'title'            => esc_html__('Service Layout Style', 'villea'),
                'desc'             => esc_html__('Select the default service layout style', 'villea'),
                'options'          => array(
                    'grid'             => esc_html__('Grid', 'villea'),
                    'list'             => esc_html__('List', 'villea'),
                ),
                'placeholder'      => esc_html__('Choose Service Layout...', 'villea'),
                'default'          => 'grid'
            ),
            array(
                'id'               => 'service_grid_columns',
                'type'             => 'select',
                'title'            => esc_html__('Grid Columns', 'villea'),
                'desc'             => esc_html__('Select number of columns for grid view', 'villea'),
                'options'          => array(
                    '12'            => esc_html__('1 Column', 'villea'),
                    '6'             => esc_html__('2 Columns', 'villea'),
                    '4'             => esc_html__('3 Columns', 'villea'),
                    '3'             => esc_html__('4 Columns', 'villea')
                ),
                'default'          => '6',
                'required'         => array('service_layout_style', '=', 'grid')
            ),

        )
    )
);

// Team
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Team Page', 'villea'),
        'id'               => 'team_setting',
        'customizer_width' => '450px',
        'icon' => 'el el-align-right',
        'fields'           => array(

            array(
                'id'    => 'team_banner_main',
                'url'   => true,
                'title' => esc_html__('Team Page Banner', 'villea'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'team_banner_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Team Banner Background Color', 'villea'),
                'subtitle'  => esc_html__('Pick banner background color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),

            array(
                'id'       => 'team_title',
                'title'    => esc_html__('Team Title', 'villea'),
                'subtitle' => esc_html__('Enter Team  Title Here', 'villea'),
                'type'     => 'text',
                'placeholder' => esc_html__('Enter Title', 'villea'),
            ),

            array(
                'id'       => 'team_slug',
                'title'    => esc_html__('Team Slug', 'villea'),
                'subtitle' => esc_html__('Enter Team Slug Here', 'villea'),
                'type'     => 'text',
                'default'  => 'teams',
                'placeholder' => esc_html__('Enter Slug', 'villea'),
            ),

            array(
                'id'       => 'team_cat_slug',
                'title'    => esc_html__('Team Category Slug', 'villea'),
                'subtitle' => esc_html__('Enter Team Cat Slug Here', 'villea'),
                'type'     => 'text',
                'default'  => 'team-category',
                'placeholder' => esc_html__('Enter Category Slug', 'villea'),
            ),
        )
    )
);

/*Blog Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog', 'villea'),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog Settings', 'villea'),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',

        'fields'           => array(

            array(
                'id'    => 'blog_banner_main',
                'url'   => true,
                'title' => esc_html__('Blog Page Banner', 'villea'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'blog_banner_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Blog Banner Backgroud Color', 'villea'),
                'subtitle'  => esc_html__('Pick banner background color', 'villea'),
                'validate'  => 'color',
            ),

            array(
                'id'       => 'blog_title',
                'title'    => esc_html__('Blog Title', 'villea'),
                'subtitle' => esc_html__('Enter Blog  Title Here', 'villea'),
                'type'     => 'text',
                'placeholder' => esc_html__('Enter a Blog Title', 'villea'),
            ),

            // array(
            //     'id'       => 'blog_long_title',
            //     'title'    => esc_html__('Blog Long Title', 'villea'),
            //     'subtitle' => esc_html__('Enter Blog  Long Title Here', 'villea'),
            //     'type'     => 'text',
            // ),

            array(
                'id'               => 'blog-layout',
                'type'             => 'image_select',
                'title'            => esc_html__('Select Blog Layout', 'villea'),
                'subtitle'         => esc_html__('Select your blog layout', 'villea'),
                'options'          => array(
                    'full'             => array(
                        'alt'              => esc_html__('Blog Style 1', 'villea'),
                        'img'              => get_template_directory_uri() . '/libs/img/1c.png'
                    ),
                    '2right'           => array(
                        'alt'              => esc_html__('Blog Style 2', 'villea'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cr.png'
                    ),
                    '2left'            => array(
                        'alt'              => esc_html__('Blog Style 3', 'villea'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cl.png'
                    ),
                ),
                'default'          => '2right'
            ),
            array(
                'id'               => 'blog_layout_style',
                'type'             => 'select',
                'title'            => esc_html__('Blog Layout Style', 'villea'),
                'desc'             => esc_html__('Select the default blog layout style', 'villea'),
                'options'          => array(
                    'grid'             => esc_html__('Grid', 'villea'),
                    'list'             => esc_html__('List', 'villea'),
                ),
                'placeholder'      => esc_html__('Choose Blog Layout...', 'villea'),
                'default'          => 'grid'
            ),
            array(
                'id'               => 'blog_grid_columns',
                'type'             => 'select',
                'title'            => esc_html__('Grid Columns', 'villea'),
                'desc'             => esc_html__('Select number of columns for grid view', 'villea'),
                'options'          => array(
                    '12'            => esc_html__('1 Column', 'villea'),
                    '6'             => esc_html__('2 Columns', 'villea'),
                    '4'             => esc_html__('3 Columns', 'villea'),
                    '3'             => esc_html__('4 Columns', 'villea')
                ),
                'default'          => '6',
                'required'         => array('blog_layout_style', '=', 'grid')
            ),


            array(
                'id'               => 'blog-author-post',
                'type'             => 'select',
                'title'            => esc_html__('Show Author Info ', 'villea'),
                'desc'             => esc_html__('Select author info show or hide', 'villea'),
                'options'          => array(
                    'show'             => esc_html__('Show', 'villea'),
                    'hide'             => esc_html__('Hide', 'villea'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-category',
                'type'             => 'select',
                'title'            => esc_html__('Show Category', 'villea'),
                'options'          => array(
                    'show'             => esc_html__('Show', 'villea'),
                    'hide'             => esc_html__('Hide', 'villea'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-date',
                'type'             => 'switch',
                'title'            => esc_html__('Show Date', 'villea'),
                'desc'             => esc_html__('You can show/hide date at blog page', 'villea'),
                'default'          => true,
            ),

            array(
                'id'               => 'blog_readmore',
                'title'            => esc_html__('Blog Read More Text', 'villea'),
                'subtitle'         => esc_html__('Enter Blog Read More Here', 'villea'),
                'type'             => 'text',
                'default'          => esc_html__('Read More', 'villea'),
                'placeholder' => esc_html__('Enter Read More Text', 'villea'),
            ),

        )
    )

);

/*Single Post Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Single Post', 'villea'),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'blog-comments',
                'type'     => 'select',
                'title'    => esc_html__('Show Comment Form', 'villea'),
                'desc'     => esc_html__('Select comments show or hide', 'villea'),
                'options'  => array(
                    'show' => esc_html__('Show', 'villea'),
                    'hide' => esc_html__('Hide', 'villea'),
                ),
                'default'  => 'show',

            ),

            array(
                'id'       => 'blog-author-meta',
                'type'     => 'select',
                'title'    => esc_html__('Show Meta Info', 'villea'),
                'desc'     => esc_html__('Select meta info show or hide', 'villea'),
                'options'  => array(
                    'show' => esc_html__('Show', 'villea'),
                    'hide' => esc_html__('Hide', 'villea'),
                ),
                'default'  => 'show',

            ),

        )
    )

);

// error page
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('404 Error Page', 'villea'),
        'desc'   => esc_html__('404 details  here', 'villea'),
        'icon'   => 'el el-error-alt',
        'fields' => array(

            array(
                'id'       => 'title_404',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'villea'),
                'subtitle' => esc_html__('Enter title for 404 page', 'villea'),
                'default'  => esc_html__('404', 'villea'),
                'placeholder' => esc_html__('Enter a title (e.g., 404)', 'villea')
            ),
            array(
                'id'       => 'text_404',
                'type'     => 'text',
                'title'    => esc_html__('Text', 'villea'),
                'subtitle' => esc_html__('Enter text for 404 page', 'villea'),
                'default'  => esc_html__('Page Not Found', 'villea'),
                'placeholder' => esc_html__('Enter a text (e.g., Page Not Found)', 'villea')
            ),
            array(
                'id'       => 'des_404',
                'type'     => 'textarea',
                'title'    => esc_html__('Short Description Text', 'villea'),
                'subtitle' => esc_html__('Enter short description text for 404 page', 'villea'),
                'default'  => esc_html__("Sorry, we couldn't find the page you where looking for. We suggest that you return to homepage.", 'villea'),
                'placeholder' => esc_html__('Enter a short description ', 'villea')
            ),
            array(
                'id'       => 'back_home',
                'type'     => 'text',
                'title'    => esc_html__('Back to Home Button Label', 'villea'),
                'subtitle' => esc_html__('Enter label for "Back to Home" button', 'villea'),
                'default'  => esc_html__('Back to Home', 'villea'),
                'placeholder' => esc_html__('Enter a button label (e.g., Back to Home)', 'villea'),
            ),
            array(
                'id'       => '404_bg',
                'type'     => 'media',
                'title'    => esc_html__('404 page Image', 'villea'),
                'subtitle' => esc_html__('Upload your image', 'villea'),
                'url' => true
            ),


        )
    )
);

// Course
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Course Page', 'villea'),
        'id'               => 'course_setting',
        'customizer_width' => '450px',
        // 'icon' => 'el el-align-right',
        'fields'           => array(

            array(
                'id'    => 'course_banner_main',
                'url'   => true,
                'title' => esc_html__('Course Page Banner', 'villea'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'course_banner_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Course Banner Background Color', 'villea'),
                'subtitle'  => esc_html__('Pick banner background color', 'villea'),
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),

            array(
                'id'       => 'course_title',
                'title'    => esc_html__('Course Title', 'villea'),
                'subtitle' => esc_html__('Enter Course Title Here', 'villea'),
                'type'     => 'text',
                'placeholder' => esc_html__('Enter Title', 'villea'),
            ),
        )
    )
);


if (!function_exists('compiler_action')) {
    function compiler_action($options, $css, $changed_values)
    {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r($changed_values); // Values that have changed since the last save
        echo "</pre>";
    }
}

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')) {
    function redux_validate_callback_function($field, $value, $existing_value)
    {
        $error   = false;
        $warning = false;

        //do your validation
        if ($value == 1) {
            $error = true;
            $value = $existing_value;
        } elseif ($value == 2) {
            $warning = true;
            $value   = $existing_value;
        }

        $return['value'] = $value;

        if ($error == true) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }

        if ($warning == true) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }

        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')) {
    function redux_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.     
 * */
if (!function_exists('dynamic_section')) {
    function dynamic_section($sections)
    {
        $sections[] = array(
            'title'  => esc_html__('Section via hook', 'villea'),
            'desc'   => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'villea'),
            'icon'   => 'el el-paper-clip',
            'fields' => array()
        );
        return $sections;
    }
}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if (!function_exists('change_arguments')) {
    function change_arguments($args)
    {
        return $args;
    }
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if (!function_exists('change_defaults')) {
    function change_defaults($defaults)
    {
        $defaults['str_replace'] = 'Testing filter hook!';
        return $defaults;
    }
}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if (!function_exists('remove_demo')) {
    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }
}
