<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins', 999);

/**
 * Register the required plugins for this theme.
 */
function my_theme_register_required_plugins()
{
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name' 		=> 'Breadcrumb NavXT',
			'slug' 		=> 'breadcrumb-navxt',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Template Library and Redux Framework',
			'slug' 		=> 'redux-framework',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'MetForm',
			'slug' 		=> 'metform',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Elementor',
			'slug' 		=> 'elementor',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'One Click Demo Import',
			'slug' 		=> 'one-click-demo-import',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'MC4WP: Mailchimp for WordPress',
			'slug' 		=> 'mailchimp-for-wp',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'GTranslate',
			'slug' 		=> 'gtranslate',
			'required' 	=> true,
		),

		array(
			'name'               => 'TP Elements',
			'slug'               => 'tp-elements',
			'source'             => 'https://pixelaxis.net/villea/wp-content/plugins/tp-elements.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => 'TP Framework',
			'slug'               => 'tp-framework',
			'source'             => 'https://pixelaxis.net/villea/wp-content/plugins/tp-framework.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => 'Estatik',
			'slug'               => 'estatik',
			'required'           => true,
		),

		array(
			'name'               => 'Woocommerce',
			'slug'               => 'woocommerce',
			'required'           => false,
		),

		array(
			'name'               => 'WPC Smart Compare for WooCommerce',
			'slug'               => 'woo-smart-compare',
			'required'           => false,
		),

		array(
			'name'               => 'WPC Smart Wishlist for WooCommerce',
			'slug'               => 'woo-smart-wishlist',
			'required'           => false,
		),

		array(
			'name'               => 'WPC Smart Quick View for WooCommerce',
			'slug'               => 'woo-smart-quick-view',
			'required'           => false,
		),

		array(
			'name'               => 'WP Mail SMTP',
			'slug'               => 'wp-mail-smtp',
			'required'           => false,
		),

	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',

		'strings'      => array(
			'page_title'                      => __('Install Required Plugins', 'villea'),
			'menu_title'                      => __('Install Plugins', 'villea'),
			'installing'                      => __('Installing Plugin: %s', 'villea'),
			'updating'                        => __('Updating Plugin: %s', 'villea'),
			'oops'                            => __('Something went wrong with the plugin API.', 'villea'),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'villea'
			),
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'villea'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'villea'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'villea'
			),
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'villea'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'villea'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'villea'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'villea'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'villea'
			),
			'return'                          => __('Return to Required Plugins Installer', 'villea'),
			'plugin_activated'                => __('Plugin activated successfully.', 'villea'),
			'activated_successfully'          => __('The following plugin was activated successfully:', 'villea'),
			'plugin_already_active'           => __('No action taken. Plugin %1$s was already active.', 'villea'),
			'plugin_needs_higher_version'     => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'villea'),
			'complete'                        => __('All plugins installed and activated successfully. %1$s', 'villea'),
			'dismiss'                         => __('Dismiss this notice', 'villea'),
			'notice_cannot_install_activate'  => __('There are one or more required or recommended plugins to install, update or activate.', 'villea'),
			'contact_admin'                   => __('Please contact the administrator of this site for help.', 'villea'),
			'nag_type'                        => '',
		),
	);

	tgmpa($plugins, $config);
}
