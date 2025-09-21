<?php

/**
 * Main Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class TPelements_Elementor_Extension
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct()
	{
		add_action('init', [$this, 'i18n']);
		add_action('plugins_loaded', [$this, 'init']);
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n()
	{
		load_plugin_textdomain('tp-elements');
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init()
	{

		// Check if Elementor installed and activated
		if (! did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return;
		}

		// Check for required Elementor version
		if (! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return;
		}
		// Add Plugin actions
		add_action('elementor/widgets/register', [$this, 'init_widgets']);
		add_action('elementor/elements/categories_registered', [$this, 'add_category']);
		add_action('elementor/elements/categories_registered', [$this, 'resgister_tpaddon_category']);
		add_action('elementor/elements/categories_registered', [$this, 'resgister_header_footer_category']);
		add_action('wp_enqueue_scripts', [$this, 'tpelements_register_widget_styles']);
		add_action('wp_enqueue_scripts', [$this, 'tpaddon_register_plugin_styles']);
		add_action('admin_enqueue_scripts', [$this, 'tpaddon_admin_defualt_css']);
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'tpaddon_register_plugin_admin_styles']);
		$this->include_files();
	}

	public function tpelements_register_widget_styles()
	{
		$dir = plugin_dir_url(__FILE__);
		$tpelements_addon_setting = get_option('tpelements_addon_option');

		$path = plugin_dir_path(__FILE__);

		// Helper function to enqueue with filemtime
		$enqueue_with_version = function ($handle, $file_rel_path) use ($dir, $path) {
			$file_path = $path . $file_rel_path;
			$version   = file_exists($file_path) ? filemtime($file_path) : time(); // fallback to time if missing
			wp_enqueue_style($handle, $dir . $file_rel_path, array(), $version, 'all');
		};

		//Contact Form 7
		if (isset($tpelements_addon_setting['tp_contact_form_7_setting']) == 'tpelement_contact_form_7') {
			$enqueue_with_version('tpelements-cf7', 'widgets/cf7/cf7-css/cf7.css');
		}
		//CTA
		if (isset($tpelements_addon_setting['tp_cta_setting']) == 'tpelement_cta') {
			$enqueue_with_version('tpelements-cta', 'widgets/cta/cta-css/cta.css');
		}

		//Icon Box
		if (isset($tpelements_addon_setting['tp_icon_box_setting']) == 'tpelement_icon_box') {
			$enqueue_with_version('tpelements-iconbox', 'widgets/iconbox/tp-iconbox-css/iconbox.css');
		}
		//Progress Pie
		if (isset($tpelements_addon_setting['tp_progress_pie_setting']) == 'tpelement_progress_pie') {
			$enqueue_with_version('tpelements-progress-pie', 'widgets/progress-pie/progress-pie-css/progress-pie.css');
		}

		// experience CSS
		$enqueue_with_version('tpelements-experience', 'widgets/experience/experience-css/experience.css');

		// Service CSS
		$enqueue_with_version('tpelements-service-grid', 'widgets/services/serv-grid-css/services-grid.css');

		$enqueue_with_version('tpelements-service-slider', 'widgets/services/serv-grid-css/service-slider.css');

		$enqueue_with_version('tpelements-portfolio-grid', 'widgets/portfolio-grid/portfolio-grid-css/portfolio-grid.css');

		// Product Card
		$enqueue_with_version('tpelements-product-css', 'widgets/woocommerce/product/product-css/product.css');

		// Product Category
		$enqueue_with_version('tpelements-product-cat-css', 'widgets/woocommerce/product-cat/product-cat-css/product-cat.css');

		// Countdown
		$enqueue_with_version('tpelements-countdown-css', 'widgets/countdown/countdown.css');

		// Buttonpro
		$enqueue_with_version('tpelements-buttonpro-css', 'widgets/buttonpro/buttonpro-css/buttonpro.css');

		// How works 
		$enqueue_with_version('tpelements-howworks-css', 'widgets/how-works/how-works.css');

		// portfolio slider
		$enqueue_with_version('tpelements-portfolio-slider-css', 'widgets/portfolio-slider/portfolio-slider-css/portfolio-slider.css');

		// heading 
		if (isset($tpelements_addon_setting['tp_heading_setting']) == 'tp_element_heading') {
			$enqueue_with_version('tpelements-heading-css', 'widgets/heading/heading-css/heading.css');
		}

		// button
		if (isset($tpelements_addon_setting['tp_button_setting']) == 'tpelement_button') {
			$enqueue_with_version('tpelements-button-css', 'widgets/button/button-css/button.css');
		}

		// accordion
		if (isset($tpelements_addon_setting['tp_accordion_setting']) == 'tpelement_accordion') {
			$enqueue_with_version('tpelements-accordion-css', 'widgets/accordion/accordion-css/accordion.css');
		}

		// social share
		$enqueue_with_version('tpelements-social-share-css', 'widgets/social-share/social-share-css/social-share.css');

		// testimonial
		$enqueue_with_version('tpelements-testimonial-css', 'widgets/slider/slider-css/slider.css');

		// download buttons
		$enqueue_with_version('tpelements-download-button-css', 'widgets/download-button/download-button-css/download-button.css');


		// category
		$enqueue_with_version('tpelements-category-css', 'widgets/category/category-css/category.css');

		// video
		$enqueue_with_version('tpelements-video-css', 'widgets/video/video-css/video.css');

		// button
		$enqueue_with_version('tpelements-video-button-css', 'widgets/video-button/video-button-css/video-button.css');

		// image-tab-gallery
		$enqueue_with_version('tpelements-image-tab-gallery-css', 'widgets/image-tab-gallery/image-tab-gallery-css/image-tab-gallery.css');

		// team
		$enqueue_with_version('tpelements-team-css', 'widgets/team-member-slider/team-slider-css/team-slider.css');

		// image scroll gallery
		$enqueue_with_version('tpelements-image-scroll-gallery-css', 'widgets/image-scroll-gallery/image-scroll-gallery-css/image-scroll-gallery.css');

		// blog slider
		$enqueue_with_version('tpelements-blog-slider-css', 'widgets/blog-slider/blog-slider-css/blog-slider.css');

		// blog grid
		$enqueue_with_version('tpelements-blog-grid-css', 'widgets/blog-grid/blog-css/blog-grid.css');
	}

	public function tpaddon_register_plugin_styles()
	{
		$dir = plugin_dir_url(__FILE__);
		wp_enqueue_style('custom-aos', $dir . 'assets/css/aos.css');
		wp_enqueue_style('tpelements-styles', $dir . 'assets/css/elements.css');
		//enqueue javascript   		  
		wp_enqueue_script('aos', $dir . 'assets/js/aos.js', array('jquery'), '201513434', true);
		wp_enqueue_script('hover-revel', $dir . 'assets/js/hover-revel.js', array('jquery'), '201513435', true);
		wp_enqueue_script('twinmax', $dir . 'assets/js/twinmax.js', array('jquery'), '201513434', true);
		wp_enqueue_script('TimeCircles', $dir . 'assets/js/TimeCircles.js', array('jquery'), '2015134367', true);
		wp_enqueue_script('jquery-plugin-progressbar', $dir . 'assets/js/jQuery-plugin-progressbar.js', array('jquery'), '201514', true);
		wp_register_script('aat', $dir . 'assets/js/aat.min.js', array(), false, true);
		wp_enqueue_script('ScrollTrigger', $dir . 'assets/js/ScrollTrigger.min.js', array(), false, true);
		wp_enqueue_script('gsap', $dir . 'assets/js/gsap.min.js', array('ScrollTrigger'), false, true);
		wp_enqueue_script('tpaddons-custom-pro', $dir . 'assets/js/custom.js', array('jquery', 'imagesloaded'), '201434', true);
	}

	public function tpaddon_register_plugin_admin_styles()
	{
		$dir = plugin_dir_url(__FILE__);
		wp_enqueue_style('tpaddons-admin-pro', $dir . 'assets/css/admin/admin.css');
		wp_enqueue_style('tpaddons-admin-floaticon-pro', $dir . 'assets/fonts/flaticon.css');
	}

	public function tpaddon_admin_defualt_css()
	{
		$dir = plugin_dir_url(__FILE__);
		wp_enqueue_style('tpaddons-admin-pro-style', $dir . 'assets/css/admin/style.css');
	}

	public function include_files()
	{
		require(__DIR__ . '/inc/tp-addon-icons.php');
		require(__DIR__ . '/inc/form.php');
		require(__DIR__ . '/inc/helper.php');
		require(__DIR__ . '/inc/single-templates.php');
		require(__DIR__ . '/inc/subscription-modal.php');
	}

	public function add_category($elements_manager)
	{
		$elements_manager->add_category(
			'pielements_category',
			[
				'title' => esc_html__('TP Elementor Addons', 'tp-elements'),
				'icon' => 'fa fa-smile-o',
			]
		);
	}

	public function resgister_tpaddon_category($elements_manager)
	{
		$elements_manager->add_category(
			'tpaddon_category',
			[
				'title' => esc_html__('TP Elementor Pro Addons', 'tp-elements'),
				'icon' => 'fa fa-smile-o',
			]
		);
	}

	public function resgister_header_footer_category($elements_manager)
	{
		$elements_manager->add_category(
			'header_footer_category',
			[
				'title' => esc_html__('TP Header Footer Elements', 'tp-elements'),
				'icon' => 'fa fa-smile-o',
			]
		);
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'tp-elements'),
			'<strong>' . esc_html__('TP Elementor Addon', 'tp-elements') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'tp-elements') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'tp-elements'),
			'<strong>' . esc_html__('TP Elementor Addon', 'tp-elements') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'tp-elements') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'tp-elements'),
			'<strong>' . esc_html__('TP Elementor Addon', 'tp-elements') . '</strong>',
			'<strong>' . esc_html__('PHP', 'tp-elements') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets()
	{
		$tpelements_addon_setting = get_option('tpelements_addon_option');


		// Text Hover Image
		require_once(__DIR__ . '/widgets/text-hover-image/text-hover-image.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Text_Hover_Image_Widget());

		// How Works
		require_once(__DIR__ . '/widgets/how-works/how-works.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_How_Works_Widget());

		// TP Icon
		require_once(__DIR__ . '/widgets/icon/tp-icon.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Icon_Widget());

		// Video Heading
		require_once(__DIR__ . '/widgets/video-heading/video-heading.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Video_Heading_Widget());

		// Slider Controls
		require_once(__DIR__ . '/widgets/slider-controls/slider-controls.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Slider_Controls_Widget());

		//heading
		if (isset($tpelements_addon_setting['tp_heading_setting']) == 'tp_element_heading') {
			require_once(__DIR__ . '/widgets/heading/heading.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Heading_Widget());
		}

		// Banner Slider 
		require_once(__DIR__ . '/widgets/banner-slider/banner-slider.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Banner_Slider_Widget());

		// Scrollbar Progress Bar
		require_once(__DIR__ . '/widgets/header-footer/site-scrollprogress.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Scroll_Progress());

		//Experience
		require_once(__DIR__ . '/widgets/experience/experience.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Experience_Widget());

		// //Intel project video slider
		// require_once(__DIR__ . '/widgets/project-video-slider/project-video-slider.php');
		// \Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Project_Video_Slider_Widget());

		//Story Slider
		require_once(__DIR__ . '/widgets/story-slider/story-slider.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Story_Slider_Widget());

		//Animated Hheading Setting
		if (isset($tpelements_addon_setting['tp_animated_heading_setting']) == 'tpelement_animated_heading') {
			require_once(__DIR__ . '/widgets/animated-heading/animated-heading.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Animated_Heading_Widget());
		}

		//About Image
		if (isset($tpelements_addon_setting['tp_about_image_setting']) == 'tpelement_about_image') {
			require_once(__DIR__ . '/widgets/image-about-home/about-image.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_About_Image_Widget());
		}

		if (isset($tpelements_addon_setting['tp_blockquote_setting']) == 'tpelement_blockquote') {
			require_once(__DIR__ . '/widgets/blockquote/blockquote.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Pro_Blockquote_Widget());
		}


		//Image Showcase
		if (isset($tpelements_addon_setting['tp_image_showcase_setting']) == 'tpelement_image_showcase') {
			require_once(__DIR__ . '/widgets/image-widget/image.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Image_Showcase_Widget());
		}

		//Team Grid
		if (isset($tpelements_addon_setting['tp_team_grid_setting']) == 'tpelement_team_grid') {
			require_once(__DIR__ . '/widgets/team-member/team-grid-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Team_Grid_Widget());
		}

		//Team Slider
		if (isset($tpelements_addon_setting['tp_team_slider_setting']) == 'tpelement_team_slider') {
			require_once(__DIR__ . '/widgets/team-member-slider/team-slider-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Team_Slider_Widget());
		}

		//Portfolio Grid
		if (isset($tpelements_addon_setting['tp_portfolio_grid_setting']) == 'tpelement_portfolio_grid') {
			require_once(__DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Portfolio_Grid_Widget());
		}

		//Portfolio Filter
		if (isset($tpelements_addon_setting['tp_portfolio_slider_setting']) == 'tpelement_portfolio_slider') {
			require_once(__DIR__ . '/widgets/portfolio-slider/portfolio-slider-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Portfolio_Slider_Widget());
		}

		//Project Custom widget
		require_once(__DIR__ . '/widgets/project-custom-widget/project-custom-widget.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Project_Custom_Widget());


		//Counter
		if (isset($tpelements_addon_setting['tp_counter_setting']) == 'tpelement_counter') {
			require_once(__DIR__ . '/widgets/counter/tp-counter.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Counter_Widget());
		}

		//Service Grid
		if (isset($tpelements_addon_setting['tp_service_grid_setting']) == 'tpelement_service_grid') {
			require_once(__DIR__ . '/widgets/services/service-grid.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Sservices_Grid_Widget());
		}

		//Service Slider
		if (isset($tpelements_addon_setting['tp_service_slider_setting']) == 'tpelement_service_slider') {
			require_once(__DIR__ . '/widgets/services/service-slider.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Services_Slider_Widget());
		}

		//Video Button
		if (isset($tpelements_addon_setting['tp_video_setting']) == 'tpelement_video') {
			require_once(__DIR__ . '/widgets/video/tp-video.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Video_Widget());
		}

		// Video Button
		require_once(__DIR__ . '/widgets/video-button/tp-video-button.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Video_Button_Widget());


		//pricing table
		if (isset($tpelements_addon_setting['tp_pricing_table_setting']) == 'tpelement_pricing_table') {
			require_once(__DIR__ . '/widgets/pricing-table/pricing-table.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Pricing_Table_Widget());
		}

		//Button
		if (isset($tpelements_addon_setting['tp_button_setting']) == 'tpelement_button') {
			require_once(__DIR__ . '/widgets/button/button.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Button_Widget());
		}

		//Button Pro
		require_once(__DIR__ . '/widgets/buttonpro/buttonpro.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_ButtonPro_Widget());


		//Moving Elements
		require_once(__DIR__ . '/widgets/moving-elements/moving-elements.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Moving_Elements_Widget());


		//Button Switch
		require_once(__DIR__ . '/widgets/button-switch/button-switch.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Button_Switch_Widget());

		//Logo Showcase
		if (isset($tpelements_addon_setting['tp_logo_showcase_setting']) == 'tpelement_logo_showcase') {
			require_once(__DIR__ . '/widgets/logo-widget/logo.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Logo_Showcase_Widget());
		}

		//CTA
		if (isset($tpelements_addon_setting['tp_cta_setting']) == 'tpelement_cta') {
			require_once(__DIR__ . '/widgets/cta/cta.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_CTA_Widget());
		}

		//Testimonial Slider
		if (isset($tpelements_addon_setting['tp_testimonial_slider_setting']) == 'tpelement_testimonial_slider') {
			require_once(__DIR__ . '/widgets/slider/slider.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Testimonial_Slider_Widget());
		}

		//Tab
		if (isset($tpelements_addon_setting['tp_tab_setting']) == 'tpelement_tab') {
			require_once(__DIR__ . '/widgets/tab/tab.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Tab_Widget());
		}

		//Advance Tab
		if (isset($tpelements_addon_setting['tp_advance_tab_setting']) == 'tpelement_advance_tab') {
			require_once(__DIR__ . '/widgets/advanced-tab/tab.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Advance_Tab_Widget());
		}

		//Icon Box
		if (isset($tpelements_addon_setting['tp_icon_box_setting']) == 'tpelement_icon_box') {
			require_once(__DIR__ . '/widgets/iconbox/tp-iconbox.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Icon_Box_Widget());
		}

		//Blog Grid
		if (isset($tpelements_addon_setting['tp_blog_grid_setting']) == 'tpelement_blog_grid') {
			require_once(__DIR__ . '/widgets/blog-grid/blog-grid-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Blog_Grid_Widget());
		}

		//Blog Slider
		if (isset($tpelements_addon_setting['tp_blog_slider_setting']) == 'tpelement_blog_slider') {
			require_once(__DIR__ . '/widgets/blog-slider/blog-slider-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Blog_Slider_Widget());
		}

		//Number Grid
		if (isset($tpelements_addon_setting['tp_number_grid_setting']) == 'tpelement_number_grid') {
			require_once(__DIR__ . '/widgets/number/tp-number.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Numnber_Widgets());
		}

		//Contact Form 7
		if (isset($tpelements_addon_setting['tp_contact_form_7_setting']) == 'tpelement_contact_form_7') {
			require_once(__DIR__ . '/widgets/cf7/contact-cf7.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_CF7_Widget());
		}

		//Progress Bar
		if (isset($tpelements_addon_setting['tp_progress_bar_setting']) == 'tpelement_progress_bar') {
			require_once(__DIR__ . '/widgets/progress/tp-progress.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Progress_Widget());
		}
		// Iconbox Top
		if (isset($tpelements_addon_setting['tp_icon_bar_setting']) == 'tpelement_icon_bar') {
			require_once(__DIR__ . '/widgets/header-footer/topbar-icon.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Topbar_Icon_Bar_Widget());
		}
		// Iconbox List
		if (isset($tpelements_addon_setting['tp_contactbox_icon_setting']) == 'tpelement_contactbox_icon') {
			require_once(__DIR__ . '/widgets/topbar-item/topbar-icon.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Contactbox_List_Widget());
		}

		// Contact Box
		if (isset($tpelements_addon_setting['tp_real_contactbox_setting']) == 'tpelement_real_contactbox') {
			require_once(__DIR__ . '/widgets/contact-box/contact-box.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Pro_Contactbox_Grid_Widget());
		}

		//Progress Pie
		if (isset($tpelements_addon_setting['tp_progress_pie_setting']) == 'tpelement_progress_pie') {
			require_once(__DIR__ . '/widgets/progress-pie/progress-pie.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Progress_Pie_Widget());
		}

		//countdown
		if (isset($tpelements_addon_setting['tp_countdown_setting']) == 'tpelement_countdown_box') {
			require_once(__DIR__ . '/widgets/countdown/countdown.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Pro_Countdown_Widget());
		}

		//business hour
		if (isset($tpelements_addon_setting['tp_business_hour_setting']) == 'tpelement_business_hour_box') {
			require_once(__DIR__ . '/widgets/business-hour/tp-hour.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Business_Hour_Widget());
		}

		//Tooltip
		if (isset($tpelements_addon_setting['tp_tooltip_setting']) == 'tpelement_tooltip') {
			require_once(__DIR__ . '/widgets/tooltip/tp-tooltip.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Pro_Tooltip_Box_Widget());
		}

		//image hover effect
		if (isset($tpelements_addon_setting['tp_image_hover_effect_setting']) == 'tpelement_image_hover_effect') {
			require_once(__DIR__ . '/widgets/image-hover-widget/image-hover-effect.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Pro_Image_Hover_Effect_Widget());
		}

		//features list
		if (isset($tpelements_addon_setting['tp_features_list_setting']) == 'tpelement_features_list') {
			require_once(__DIR__ . '/widgets/feature-list/feature-list.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Features_List_Widget());
		}

		//Accordion
		if (isset($tpelements_addon_setting['tp_accordion_setting']) == 'tpelement_accordion') {
			require_once(__DIR__ . '/widgets/accordion/accordion.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Widget_Accordion());
		}

		//Newsletter
		if (isset($tpelements_addon_setting['tp_newsletter_setting']) == 'tpelement_newsletter') {
			require_once(__DIR__ . '/widgets/mailchimp/mailchimp.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Mailchimp_Widget());
		}

		//Image Card
		if (isset($tpelements_addon_setting['tp_image_card_setting']) == 'tpelement_image_card') {
			require_once(__DIR__ . '/widgets/image-card/image-card.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Image_Card_Widget());
		}

		//Marquee
		if (isset($tpelements_addon_setting['tp_marquee_setting']) == 'tpelement_marquee') {
			require_once(__DIR__ . '/widgets/marquee/marquee.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Pro_Marquee_Widget());
		}

		//Marquee Pro
		require_once(__DIR__ . '/widgets/marqueepro/marqueepro.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Pro_Marquee_Pro_Widget());

		//Line Draw
		if (isset($tpelements_addon_setting['tp_linedraw_setting']) == 'tpelement_linedraw') {
			require_once(__DIR__ . '/widgets/line-draw/line-draw.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_pro_Line_Draw_Widget());
		}

		//Client Thumb
		if (isset($tpelements_addon_setting['tp_client_thumb_setting']) == 'tpelement_client_thumb') {
			require_once(__DIR__ . '/widgets/client-thumb/client-thumb.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Client_Thumb_Showcase_Widget());
		}

		//Timeline
		if (isset($tpelements_addon_setting['tp_timeline_setting']) == 'tpelement_timeline') {
			require_once(__DIR__ . '/widgets/timeline/timeline.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Timeline_Showcase_Widget());
		}

		//History
		if (isset($tpelements_addon_setting['tp_history_setting']) == 'tpelement_history') {
			require_once(__DIR__ . '/widgets/company-history/history.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_History_Showcase_Widget());
		}

		//Portfolio Feature List
		if (isset($tpelements_addon_setting['tp_portfolio_featurelist_setting']) == 'tpelement_portfolio_featurelist') {
			require_once(__DIR__ . '/widgets/portfolio-features-list/feature-list.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Portfolio_Features_List_Widget());
		}

		//Feature Image
		if (isset($tpelements_addon_setting['tp_featured_image_setting']) == 'tpelement_featured_image') {
			require_once(__DIR__ . '/widgets/featured-image/image.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Featured_Image_Showcase_Widget());
		}

		//Site Logo
		if (isset($tpelements_addon_setting['tp_site_logo_setting']) == 'tpelement_site_logo') {
			require_once(__DIR__ . '/widgets/header-footer/site-logo.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Site_Logo());
		}

		//Site Search
		if (isset($tpelements_addon_setting['tp_site_search_setting']) == 'tpelement_site_search') {
			require_once(__DIR__ . '/widgets/header-footer/site-search.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Search_Button());
		}

		//Site Navigation
		if (isset($tpelements_addon_setting['tp_site_navigation_setting']) == 'tpelement_site_navigation') {
			require_once(__DIR__ . '/widgets/header-footer/site-nav.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Navigation_Menu());
		}

		//Scroll To Top
		if (isset($tpelements_addon_setting['tp_scroll_to_top_setting']) == 'tpelement_scroll_to_top') {
			require_once(__DIR__ . '/widgets/header-footer/scroll-to-top.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Scroll_To_Top_Widget());
		}

		//Single Page Navigation
		if (isset($tpelements_addon_setting['tp_single_navigation_setting']) == 'tpelement_single_navigation') {
			require_once(__DIR__ . '/widgets/header-footer/single-page-nav.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Single_Navigation_Menu());
		}

		//Copyright
		if (isset($tpelements_addon_setting['tp_copyright_setting']) == 'tpelement_copyright') {
			require_once(__DIR__ . '/widgets/header-footer/copyright.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Copyright_Widget());
		}

		//Cart
		if (isset($tpelements_addon_setting['tp_cart_setting']) == 'tpelement_cart') {
			require_once(__DIR__ . '/widgets/woocommerce/cart.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Product_Cart());
		}

		// Product Card
		require_once(__DIR__ . '/widgets/woocommerce/product/product.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Product_Widget());


		// Product Category
		require_once(__DIR__ . '/widgets/woocommerce/product-cat/product-cat.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Product_Cat_Widget());


		// require_once( __DIR__ . '/widgets/search/site-search.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Site_Search_Button() );

		// require_once( __DIR__ . '/widgets/blog-category-slider/blog-category-widget.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pro_blog_category_slider_Widget() );

		// require_once( __DIR__ . '/widgets/blog-thumbnail-slider/thumbnail-slider-widget.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_thumbnail_slider_Widget() );

		// require_once( __DIR__ . '/widgets/dual-button/dual-button.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Dual_Button_Widget() );

		require_once(__DIR__ . '/widgets/dual-heading/dual-heading.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Heading_Dual_Widget());

		require_once(__DIR__ . '/widgets/gallery/gallery-widget.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_pro_Gallery_Widget());

		require_once(__DIR__ . '/widgets/instagram/instagram.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Instagram_Widget());

		//Site Navigation
		// require_once( __DIR__ . '/widgets/site-navigation/site-nav.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Navigation_Menu() );

		require_once(__DIR__ . '/widgets/table/table.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Pro_Table_Elementor_Widget());

		// List Widget
		require_once(__DIR__ . '/widgets/list/list.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \TP_List_Widget());

		// comment widget
		require_once(__DIR__ . '/widgets/comment/comment.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Tp_Comment_Widget());

		// social widget
		require_once(__DIR__ . '/widgets/social-share/social-share.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Social_Share_Widget());

		// download button
		require_once(__DIR__ . '/widgets/download-button/download-button.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Download_Button_Widget());

		// category widget
		require_once(__DIR__ . '/widgets/category/category.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Trading_Categories_Widget());

		// image tab gallery 
		require_once(__DIR__ . '/widgets/image-tab-gallery/image-tab-gallery.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Image_Tab_Gallery_Widget());

		// image scroll gallery 
		require_once(__DIR__ . '/widgets/image-scroll-gallery/image-scroll-gallery.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Image_Scroll_Gallery_Widget());


		// Register widget				
		add_action('elementor/elements/categories_registered', [$this, 'add_category']);
		add_action('elementor/elements/categories_registered', [$this, 'resgister_tpaddon_category']);
		add_action('elementor/elements/categories_registered', [$this, 'resgister_header_footer_category']);
	}
}
TPelements_Elementor_Extension::instance();
