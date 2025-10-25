<?php

/**
 * Elementor Classes.
 *
 * @package tp-elements
 */
// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

if (! defined('ABSPATH')) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Nav Menu.
 */
class Themephi_Navigation_Menu extends Widget_Base
{
	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'navigation-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Navigation Menu', 'tp-elements');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-nav-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['header_footer_category'];
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index()
	{
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus()
	{

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ($menus as $menu) {
			$options[$menu->slug] = $menu->name;
		}

		return $options;
	}

	/**
	 * Check if the Elementor is updated.
	 *
	 * @since 1.3.0
	 *
	 * @return boolean if Elementor updated.
	 */
	public static function is_elementor_updated()
	{
		if (class_exists('Elementor\Icons_Manager')) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Register Nav Menu controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_general_content_controls()
	{

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __('Menu', 'tp-elements'),
			]
		);

		$menus = $this->get_available_menus();

		if (! empty($menus)) {
			$this->add_control(
				'menu',
				[
					'label'        => __('Menu', 'tp-elements'),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys($menus)[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'tp-elements'), admin_url('nav-menus.php')),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'tp-elements'), admin_url('nav-menus.php?action=edit&menu=0')),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->end_controls_section();


		$this->start_controls_section(
			'section_layout',
			[
				'label' => __('Layout', 'tp-elements'),
			]
		);


		$this->add_control(
			'layout',
			[
				'label'   => __('Layout', 'tp-elements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __('Horizontal', 'tp-elements'),
					'vertical'   => __('Vertical', 'tp-elements'),
					'flyout'     => __('Flyout', 'tp-elements'),
				],
			]
		);


		$this->add_control(
			'icon_options',
			[
				'label' => esc_html__('Parent Menu Icon', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'submenu_icon',
			[
				'label'        => __('Submenu Icon', 'header-footer-elementor'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'arrow',
				'options'      => [
					'arrow'   => __('Arrows', 'header-footer-elementor'),
					'plus'    => __('Plus Sign', 'header-footer-elementor'),
					'classic' => __('Classic', 'header-footer-elementor'),
				],
				'prefix_class' => 'hfe-submenu-icon-',
			]
		);


		$this->add_control(
			'flyout_layout',
			[
				'label'     => __('Flyout Orientation', 'header-footer-elementor'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => [
					'left'  => __('Left', 'header-footer-elementor'),
					'right' => __('Right', 'header-footer-elementor'),
				],
				'condition' => [
					'layout' => 'flyout',
				],
				'prefix_class' => 'hfe-nav__layout-',
			]
		);

		$this->add_control(
			'flyout_type',
			[
				'label'       => __('Appear Effect', 'header-footer-elementor'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'normal',
				'label_block' => false,
				'options'     => [
					'normal' => __('Slide', 'header-footer-elementor'),
					'push'   => __('Push', 'header-footer-elementor'),
				],
				'render_type' => 'template',
				'condition'   => [
					'layout' => 'flyout',
				],
				'prefix_class' => 'hfe-nav__layout_effect-',
			]
		);

		$this->add_responsive_control(
			'hamburger_menu_align',
			[
				'label'              => __('Menu Items Align', 'header-footer-elementor'),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'flex-start'    => [
						'title' => __('Left', 'header-footer-elementor'),
						'icon'  => 'eicon-h-align-left',
					],
					'center'        => [
						'title' => __('Center', 'header-footer-elementor'),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'      => [
						'title' => __('Right', 'header-footer-elementor'),
						'icon'  => 'eicon-h-align-right',
					],
					'space-between' => [
						'title' => __('Justify', 'header-footer-elementor'),
						'icon'  => 'eicon-h-align-stretch',
					],
				],
				'default'            => 'space-between',
				'condition'          => [
					'layout' => ['vertical'],
				],
				'selectors'          => [
					'{{WRAPPER}} li.menu-item a' => 'justify-content: {{VALUE}} ;',
					'{{WRAPPER}} li .hfe-button-wrapper' => 'text-align: {{VALUE}} ;',
					'{{WRAPPER}}.hfe-menu-item-flex-end li.hfe-button-wrapper' => 'text-align: right;',
				],
				'prefix_class'       => 'hfe-menu-item-',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'navmenu_align',
			[
				'label'        => __('Alignment', 'tp-elements'),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'flex-start'    => [
						'title' => __('Start', 'tp-elements'),
						'icon'  => 'eicon-align-start-h',
					],
					'center'  => [
						'title' => __('Center', 'tp-elements'),
						'icon'  => 'eicon-justify-center-h',
					],
					'flex-end'   => [
						'title' => __('End', 'tp-elements'),
						'icon'  => 'eicon-justify-end-h',
					],
				],
				'default'      => 'flex-end',
				'selectors' => [
					'{{WRAPPER}} .menu_one' => 'justify-content: {{VALUE}} ;'
				],
				'condition'    => [
					'layout' => ['horizontal', 'vertical', 'flyout'],
				],
				'prefix_class' => 'hfe-nav-menu__align-',
			]
		);

		$this->add_control(
			'enable_two_column',
			[
				'label' => esc_html__('Enable Two Column Menu', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'    => [
					'layout' => ['vertical'],
				],
			]
		);

		$this->add_control(
			'enable_menu_icon',
			[
				'label' => esc_html__('Enable Menu Icon', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'    => [
					'layout' => ['vertical'],
				],
			]
		);

		$this->add_control(
			'vertical_layout',
			[
				'label'     => __('Menu Icon', 'header-footer-elementor'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Left',
				'options'   => [
					'before'  => __('Before', 'header-footer-elementor'),
					'after' => __('After', 'header-footer-elementor'),
				],
				'condition' => [
					'layout' => 'vertical',
					'enable_menu_icon' => 'yes',
				],
				'prefix_class' => 'hfe-verticalmenuicon-layout-',
			]
		);

		$this->add_control(
			'ver_menu_icon',
			[
				'label'        => __('Vertical menu Icon', 'header-footer-elementor'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'arrow',
				'options'      => [
					'arrow'   => __('Arrow', 'header-footer-elementor'),
					'plus'    => __('Plus Sign', 'header-footer-elementor'),
					'angles' => __('Angle', 'header-footer-elementor'),
					'angles-double' => __('Angle Double', 'header-footer-elementor'),
				],
				'condition' => [
					'layout' => 'vertical',
					'enable_menu_icon' => 'yes',
				],
				'prefix_class' => 'hfe-verticalmenu-icon-',
			]
		);


		$this->add_control(
			'enable_hover_animation_content',
			[
				'label' => esc_html__('Enable Hover Animation', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tp-elements'),
				'label_off' => esc_html__('No', 'tp-elements'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition'    => [
					'layout' => ['vertical'],
					'enable_menu_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'enable_hover_animation_select',
			[
				'label' => esc_html__('Enable Hover Animation', 'tp-elements'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'leftToRight',
				'options'      => [
					'leftToRight'   => __('Left To Right', 'header-footer-elementor'),
					'leftToRightHide'   => __('Hide Left To Right', 'header-footer-elementor'),
					'rightToLeft'    => __('Right To Left', 'header-footer-elementor'),
					'none' => __('normal', 'header-footer-elementor'),
				],
				'condition' => [
					'layout' => 'vertical',
					'enable_menu_icon' => 'yes',
					'enable_hover_animation_content' => 'yes',
				],
				'prefix_class' => 'hfe-verticalmenuhover-icon-',
			]
		);


		$this->add_control(
			'heading_responsive',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __('Responsive', 'header-footer-elementor'),
				'separator' => 'before',
				'condition' => [
					'layout' => 'horizontal',
				],
			]
		);

		$this->add_control(
			'dropdown',
			[
				'label'        => __('Breakpoint', 'header-footer-elementor'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __('Mobile (768px)', 'header-footer-elementor'),
					'tablet' => __('Tablet (1024px)', 'header-footer-elementor'),
					'laptop_xl' => __('Laptop (1200px)', 'header-footer-elementor'),
					'none'   => __('None', 'header-footer-elementor'),
				],
				'prefix_class' => 'hfe-nav-menu__breakpoint-',
				'condition'    => [
					'layout' => 'horizontal',
				],
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'flyout_horizontal_layout',
			[
				'label'     => __('Breakpoint Orientation', 'header-footer-elementor'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => [
					'left'  => __('Left', 'header-footer-elementor'),
					'right' => __('Right', 'header-footer-elementor'),
				],
				'condition' => [
					'layout' => 'horizontal',
					'dropdown!' => 'none',
				],
				'prefix_class' => 'hfe-nav__layout-',
			]
		);


		$this->add_control(
			'dropdown_icon',
			[
				'label'       => __('Menu Icon', 'header-footer-elementor'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
				'default'     => [
					'value'   => 'fas fa-align-justify',
					'library' => 'fa-solid',
				],
				'condition'    => [
					'layout' => ['horizontal', 'flyout'],
					'dropdown!' => 'none',
				],
			]
		);



		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls()
	{

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __('Main Menu', 'tp-elements'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_menu_item',
			[
				'label'              => __('Horizontal Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area nav.navbar ul.menu > li.menu-item > a, {{WRAPPER}} .menu-wrap-off .sidenav ul > li > a' => 'padding-left: {{SIZE}}{{UNIT}} ;  padding-right: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'padding_vertical_menu_item',
			[
				'label'              => __('Vertical Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu > li.menu-item > a, {{WRAPPER}} .menu-wrap-off .sidenav ul > li > a' => 'padding-top: {{SIZE}}{{UNIT}} ;  padding-bottom: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'menu_column_space_between',
			[
				'label'              => __('Menu Items Column Gap', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul, {{WRAPPER}} .menu-wrap-off .sidenav ul' => 'column-gap: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'menu_row_space_between',
			[
				'label'              => __('Menu Items Row Gap', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul, {{WRAPPER}} .menu-wrap-off .sidenav ul' => 'row-gap: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'menu_row_space',
			[
				'label'              => __('Dropdown Menu Icon Gap', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul > li.menu-item-has-children > a, {{WRAPPER}} .menu-wrap-off .sidenav ul > li.menu-item-has-children > a' => 'gap: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'style_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->start_controls_tabs('tabs_menu_item_style');
		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => __('Normal', 'tp-elements'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __('Menu Typography', 'tp-elements'),
				'name'      => 'menu_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .menu-area .navbar ul li a, {{WRAPPER}} .menu-wrap-off .sidenav ul li a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __('Submenu Icon Typography', 'tp-elements'),
				'name'      => 'menu_after_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .menu-area .navbar ul li a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul li a::after',
			]
		);

		$this->add_control(
			'color_menu_item',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li a, {{WRAPPER}} .menu-wrap-off .sidenav ul li a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'bg_color_main_menu',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li, {{WRAPPER}} .menu-wrap-off .sidenav ul li' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'parent_icon_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul li > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'main_menu_border_item',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul li, {{WRAPPER}} .menu-wrap-off .sidenav ul li',
			]
		);

		$this->add_responsive_control(
			'main_menu_border_radius',
			[
				'label'              => __('Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul li, {{WRAPPER}} .menu-wrap-off .sidenav ul li'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => __('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'color_menu_item_hover',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li:hover > a, {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'bg_color_main_hover_menu',
			[
				'label'     => __('Items BG Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'parent_icon_active_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li:hover > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'main_menu_border_item_hover',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover',
			]
		);

		$this->add_responsive_control(
			'main_menu_border_radius2',
			[
				'label'              => __('Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => __('Active', 'tp-elements'),
			]
		);

		$this->add_control(
			'color_active_menu_item_hover',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-area .navbar ul li.current_page_item > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul li.current_page_item > a,.menu-area .navbar ul li:active > a, 
					{{WRAPPER}} .menu-area .navbar ul li:focus > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul li:active > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul li:focus > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'color_menu_item_active',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children, {{WRAPPER}} .menu-area .navbar ul li.current_page_item, {{WRAPPER}} .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children, {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current_page_item,.menu-area .navbar ul li:active, {{WRAPPER}} .menu-area .navbar ul li:focus' => 'background: {{VALUE}} ;',
				],
			]
		);


		$this->add_control(
			'parent_normal_icon_style__color_active',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children > a::after, {{WRAPPER}} .menu-area .navbar ul li.current_page_item > a::after, {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul li.current_page_item > a::after,.menu-area .navbar ul li:active > a::after, {{WRAPPER}} .menu-area .navbar ul li:focus > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'main_border_item_active',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul li.current_page_item, {{WRAPPER}} .menu-wrap-off .sidenav ul li.current_page_item, {{WRAPPER}} .menu-area .navbar ul li:active, {{WRAPPER}} .menu-wrap-off .sidenav ul li:focus',
			]
		);

		$this->add_responsive_control(
			'main_menu_border_radius3',
			[
				'label'              => __('Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children, {{WRAPPER}} .menu-area .navbar ul li.current_page_item, {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children, {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current_page_item, {{WRAPPER}} .menu-area .navbar ul li:active, {{WRAPPER}} .menu-area .navbar ul li:focus'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu Dropdown General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls()
	{

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __('Dropdown', 'tp-elements'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_description',
			[
				'raw'             => __('<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'tp-elements'),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
				'condition'       => [
					'layout!' => [
						'expandible',
						'flyout',
					],
				],
			]
		);

		$this->add_control(
			'dropdown_bg_color_menu_item',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_responsive_control(
			'width_dropdown_item',
			[
				'label'              => __('Dropdown Width (px)', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default'            => [
					'size' => '220',
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul li ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}} ;  width: {{SIZE}}{{UNIT}} ;',

				],
				'condition'          => [
					'layout' => 'horizontal',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_dropdown_item',
			[
				'label'              => __('Dropdown Box Horizontal Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu' => 'padding-left: {{SIZE}}{{UNIT}} ;  padding-right: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'padding_vertical_dropdown_item',
			[
				'label'              => __('Dropdown Box Vertical Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu' => 'padding-top: {{SIZE}}{{UNIT}} ;  padding-bottom: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label'              => __('Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label'		=> __('Dropdown Box Shadow', 'tp-elements'),
				'name'      => 'dropdown_box_shadow',
				'exclude'   => [
					'box_shadow_position',
				],
				'selector'  => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_divider_border',
				'label' => esc_html__('Dropdown Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu, 
				{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu',
			]
		);

		$this->add_control(
			'icon_optionws',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs('tabs_dropdown_item_style');

		$this->start_controls_tab(
			'tab_dropdown_item_normal',
			[
				'label' => __('Normal', 'tp-elements'),
			]
		);

		$this->add_responsive_control(
			'dropdown_padding_horizontal_menu_item',
			[
				'label'              => __('Dropdown Menu Horizontal Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li > a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a' => 'padding-left: {{SIZE}}{{UNIT}} ; padding-right: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'dropdown_padding_vertical_menu_item',
			[
				'label'              => __('Dropdown Menu Vertical Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a'  => 'padding-top: {{SIZE}}{{UNIT}} ; padding-bottom: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'dropdown_menu_column_space_between',
			[
				'label'              => __('Menu Items Gap', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu' => 'gap: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'color_dropdown_item',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li > a, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'bg_color_menu_item',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'dropdown_icon_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'drop_border_item',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:not(:last-child), 
				{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:not(:last-child)',
			]
		);

		$this->add_responsive_control(
			'dropdown_items_border_radius',
			[
				'label'              => __('Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu li ul.sub-menu li, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li ul.sub-menu li'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_hover',
			[
				'label' => __('Hover', 'tp-elements'),
			]
		);

		$this->add_responsive_control(
			'dropdown_padding_horizontal_menu_item_hover',
			[
				'label'              => __('Horizontal Items Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a' => 'padding-left: {{SIZE}}{{UNIT}} ; padding-right: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'dropdown_padding_vertical_menu_item_hover',
			[
				'label'              => __('Vertical Items Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a'  => 'padding-top: {{SIZE}}{{UNIT}} ; padding-bottom: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'dropdown_color_menu_item_hover',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'dropdown_bg_color_main_hover_menu',
			[
				'label'     => __('Items BG Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'dropdown_parent_icon_active_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'drop_border_item_hover',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover',
			]
		);

		$this->add_responsive_control(
			'dropdown_items_border_radius_hover',
			[
				'label'              => __('Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu li ul.sub-menu li:hover, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li ul.sub-menu li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_active',
			[
				'label' => __('Active', 'tp-elements'),
			]
		);

		$this->add_control(
			'drop_color_active_menu_item_active',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active > a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'drop_color_menu_item_active',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus' => 'background: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'drop_parent_normal_icon_style__color_active',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a::after, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a::after,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a::after, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a::after, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active > a::after, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus > a::after, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active > a::after, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'drop_border_item_active',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus'
			]
		);

		$this->add_responsive_control(
			'dropdown_items_border_radius_active',
			[
				'label'              => __('Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_tabs();

		$this->end_controls_section();




		// Sticky Options
		$this->start_controls_section(
			'section_style_sticky_main-menu',
			[
				'label'     => __('Sticky Options', 'tp-elements'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);


		$this->add_control(
			'offcanvas_icon_sticky_color',
			[
				'label'     => __('Offcanvas Sticky Menu Icon', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors'          => [
					'.tp-sticky {{WRAPPER}} .menu-area .nav-link-container .menu-button svg path' => 'fill: {{VALUE}} !important;',
					'.tp-sticky {{WRAPPER}} .menu-area .nav-link-container .menu-button i' => 'color: {{VALUE}} !important;'
				],
			]
		);

		$this->add_control(
			'more_options',
			[
				'label' => esc_html__('Sticky Menu Color', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs('tabs_menu_item_style_stikcy');

		$this->start_controls_tab(
			'stikcy_menu_item_normal',
			[
				'label' => __('Normal', 'tp-elements'),
			]
		);

		$this->add_control(
			'sticky_color_menu_item',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li a, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li a' => 'color: {{VALUE}}  ;',
				],
			]
		);

		$this->add_control(
			'sticky_bg_color_main_menu',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li' => 'background-color: {{VALUE}} ;',
				],

			]
		);

		$this->add_control(
			'sticky_parent_icon_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li.menu-item-has-children > a::after, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li.menu-item-has-children > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sticky_border_item',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '.tp-sticky {{WRAPPER}} .menu-area .navbar ul li, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'sticky_menu_item_hover',
			[
				'label' => __('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'sticky_color_menu_item_hover',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li:hover > a, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'sticky_bg_color_main_hover_menu',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li:hover, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'sticky_parent_icon_hover_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li:hover > a::after, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sticky_border_item_hover',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '.tp-sticky {{WRAPPER}} .menu-area .navbar ul li:hover, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sticky_menu_item_active',
			[
				'label' => __('Active', 'tp-elements'),
			]
		);

		$this->add_control(
			'sticky_color_menu_item_active',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children > a, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current_page_item > a, .tp-sticky {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children > a, .tp-sticky {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current_page_item > a,.menu-area .navbar ul li:active > a, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li:focus > a, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:active > a, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:focus > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'sticky_bg_color_menu_item_active',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current_page_item, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children, .tp-sticky {{WRAPPER}}  .menu-wrap-off .sidenav ul li.current_page_item,.menu-area .navbar ul li:active, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li:focus' => 'background: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'sticky_parent_icon_active_style__color_active',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'.tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current-menu-ancestor.menu-item-has-children > a::after, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current_page_item > a::after, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li.current-menu-ancestor.menu-item-has-children > a::after, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li.current_page_item > a::after,.menu-area .navbar ul li:active > a::after, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li:focus > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sticky_main_border_item_active',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '.tp-sticky {{WRAPPER}} .menu-area .navbar ul li.current_page_item, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li.current_page_item, .tp-sticky {{WRAPPER}} .menu-area .navbar ul li:active, .tp-sticky {{WRAPPER}} .menu-wrap-off .sidenav ul li:focus',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'sticky_color_bg',
			[
				'label'     => __('Sticky Area Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'#themephi-header .tp-sticky' => 'background: {{VALUE}} ;',
					'#themephi-header .tp-sticky .bg-remove' => 'background: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'stikcy_box_shadow',
				'selector'  => '#themephi-header .tp-sticky',
				'separator' => 'after',
			]
		);

		$this->end_controls_section();


		//Responsive menu icon settings
		$this->start_controls_section(
			'resonsive_menu',
			[
				'label'     => __('Offcanvas Style', 'tp-elements'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'offcanvas_icon_color',
			[
				'label'     => __('Offcanvas Menu Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors'          => [
					'{{WRAPPER}} .menu-area .nav-link-container .menu-button svg path' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .menu-area .nav-link-container .menu-button i' => 'color: {{VALUE}} !important;',
				],
			]
		);

		// Icon Size
		$this->add_responsive_control(
			'menu_icon_custom_dimensionsss',
			[
				'label' => esc_html__('Offcanvas Menu Icon Size', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .nav-link-container .menu-button svg' => 'height: {{SIZE}}{{UNIT}} ;  width: {{SIZE}}{{UNIT}} ; ',
					'{{WRAPPER}} .menu-area .nav-link-container .menu-button i' => 'font-size: {{SIZE}}{{UNIT}} ; '
				],
			]
		);

		$this->add_control(
			'offcanvas_bg',
			[
				'label'     => __('Offcanvas Bg', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off, {{WRAPPER}} .menu-wrap-off.off-open' => 'background: {{VALUE}} ;'
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_padding',
			[
				'label'              => __('Offcanvas Padding', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'offcanvas_menu_icon_border',
				'label'    => __('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-wrap-off',
			]
		);

		$this->add_responsive_control(
			'offcanvas_items_border_radius',
			[
				'label'              => __('Offcanvas Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
				'separator' => 'after',
			]
		);


		// Offcanvas Close Button style
		$this->start_controls_tabs('responsive_tabs_close_button_style');

		$this->start_controls_tab(
			'responsive_close_tab_dropdown_item_normal',
			[
				'label' => __('Normal', 'tp-elements'),
			]
		);

		// Icon Size
		$this->add_responsive_control(
			'close_icon_custom_dimensionsss',
			[
				'label' => esc_html__('Offcanvas Close Icon Size', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button i' => 'font-size: {{SIZE}}{{UNIT}} ; '
				],
			]
		);

		// Icon box Size
		$this->add_responsive_control(
			'close_icon_box_custom_dimensionsss',
			[
				'label' => esc_html__('Offcanvas Close Box Size', 'tp-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button' => 'height: {{SIZE}}{{UNIT}} ; width: {{SIZE}}{{UNIT}} ; min-width: {{SIZE}}{{UNIT}} ;',
				],

				'separator' => 'after',
			]
		);

		$this->add_control(
			'menu_icon_bg_responsive',
			[
				'label'     => __('Offcanvas Close Icon Bg', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button' => 'background: {{VALUE}} ;'
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu_icon_responsive',
			[
				'label'     => __('Offcanvas Close Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button i' => 'color: {{VALUE}} ;'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'responsive_menu_icon_border',
				'label'    => __('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button',
			]
		);

		$this->add_responsive_control(
			'menu_close_icon_responsive',
			[
				'label'              => __('Offcanvas Close Icon Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'responsive_close_tab_dropdown_item_hover',
			[
				'label' => __('Hover', 'tp-elements'),
			]
		);

		$this->add_control(
			'menu_hover_icon_bg_responsive',
			[
				'label'     => __('Offcanvas Close Icon Bg', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button:hover' => 'background: {{VALUE}} ;'
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'menu_hover_icon_responsive',
			[
				'label'     => __('Offcanvas Close Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button:hover i' => 'color: {{VALUE}} ;'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'responsive_hover_menu_icon_border',
				'label'    => __('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button:hover',
			]
		);

		$this->add_responsive_control(
			'menu_close_hover_icon_responsive',
			[
				'label'              => __('Offcanvas Close Icon Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .inner-offcan .close-button:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
				'separator' => 'after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();



		// offcanvas items style
		$this->start_controls_tabs('responsive_tabs_dropdown_item_style');

		$this->start_controls_tab(
			'responsive_tab_dropdown_item_normal',
			[
				'label' => __('Normal', 'tp-elements'),
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __('Offcanvas Menu Typography', 'tp-elements'),
				'name'      => 'responsive_dropdown_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .menu-wrap-off .sidenav ul li > a, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => __('Offcanvas Submenu Icon Typography', 'tp-elements'),
				'name'      => 'offcanvas_menu_after_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .menu-wrap-off .sidenav ul li > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a::after',
			]
		);


		$this->add_responsive_control(
			'responsive_dropdown_padding_horizontal_menu_item',
			[
				'label'              => __('Horizontal Items Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a' => 'padding-left: {{SIZE}}{{UNIT}} ; padding-right: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'responsive_dropdown_padding_vertical_menu_item',
			[
				'label'              => __('Vertical Items Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a'  => 'padding-top: {{SIZE}}{{UNIT}} ; padding-bottom: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'responsive_color_dropdown_item',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li > a, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'responsive_bg_color_menu_item',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					' {{WRAPPER}} .menu-wrap-off .sidenav ul.menu li, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'responsive_dropdown_icon_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'offcanvas_responsive_dropdown_padding_menu_ul',
			[
				'label'     => __('Dropdown BG Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu' => 'background-color: {{VALUE}} ; border: none;',
				],

			]
		);

		$this->add_control(
			'offcanvas_responsive_dropdown_padding_menu_ul_li',
			[
				'label'     => __('Dropdown Items BG Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li' => 'background-color: {{VALUE}} ;',
				],
			]
		);
		$this->add_control(
			'offcanvas_responsive_dropdown_padding_menu_ul_li_a',
			[
				'label'     => __('Dropdown Items Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li > a' => 'color: {{VALUE}} ;',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'drop_border_item2',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu li ul.sub-menu li',
			]
		);

		$this->add_responsive_control(
			'responsive_dropdown_items_border_radius',
			[
				'label'              => __('Offcanvas items Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu li ul.sub-menu li'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'responsive_mobile_menu_column_space_between',
			[
				'label'              => __('Menu Items Gap', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul' => 'gap: {{SIZE}}{{UNIT}} ; ',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'responsive_drop_mobile_menu_column_space_between',
			[
				'label'              => __('Dropdown Menu Items Gap', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}} ; ',
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:first-child' => 'margin-top: {{SIZE}}{{UNIT}} ;  display: inline-block;',
				],
				'separator' => 'before',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'offcanvas_responsive_dropdown_padding_menu_ul_padding',
			[
				'label'              => __('Dropdown Padding', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'drop_border_item3',
				'label' => esc_html__('Offcanvas Dropdown Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu',
			]
		);


		$this->add_responsive_control(
			'offcanvas_responsive_dropdown_padding_menu_border_radius',
			[
				'label'              => __('Offcanvas Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,

			]
		);

		$this->end_controls_tab();



		$this->start_controls_tab(
			'responsive_tab_dropdown_item_hover',
			[
				'label' => __('Hover', 'tp-elements'),
			]
		);

		$this->add_responsive_control(
			'responsive_dropdown_padding_horizontal_menu_item_hover',
			[
				'label'              => __('Horizontal Items Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a' => 'padding-left: {{SIZE}}{{UNIT}} ; padding-right: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'responsive_dropdown_color_menu_item_hover',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'responsive_dropdown_bg_color_main_hover_menu',
			[
				'label'     => __('Items Hover BG Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover' => 'background-color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'responsive_dropdown_parent_icon_active_style__color',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover > a::after, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'responsive_drop_border_item',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:hover, {{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:hover',
			]
		);

		$this->add_responsive_control(
			'responsive_dropdown_items_border_radius_hover',
			[
				'label'              => __('Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu li ul.sub-menu li:hover, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu li ul.sub-menu li:hover'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'responsive_tab_dropdown_item_active',
			[
				'label' => __('Active', 'tp-elements'),
			]
		);


		$this->add_responsive_control(
			'responsive_dropdown_padding_horizontal_menu_item_active',
			[
				'label'              => __('Horizontal Items Padding', 'tp-elements'),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => ['px'],
				'range'              => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus a,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active a' => 'padding-left: {{SIZE}}{{UNIT}} ; padding-right: {{SIZE}}{{UNIT}} ;',
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'responsive_drop_color_active_menu_item_active',
			[
				'label'     => __('Text Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item a,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active > a, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active > a, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus > a' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'responsive_drop_color_menu_item_active',
			[
				'label'     => __('Items Bg Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus' => 'background: {{VALUE}} ;',
				],
			]
		);

		$this->add_control(
			'responsive_drop_parent_normal_icon_style__color_active',
			[
				'label'     => __('Dropdown Icon Color', 'tp-elements'),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a::after, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a::after,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children > a::after, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item a::after, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active > a::after, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus > a::after, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active > a::after, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus > a::after' => 'color: {{VALUE}} ;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'responsive_drop_border_item_active',
				'label' => esc_html__('Border', 'tp-elements'),
				'selector' => '{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus'
			]
		);

		$this->add_responsive_control(
			'responsive_dropdown_items_border_radius_active',
			[
				'label'              => __('Dropdown Border Radius', 'tp-elements'),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => ['px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current-menu-ancestor.menu-item-has-children li.current_page_item, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li.current_page_item,
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-area .navbar ul.menu ul.sub-menu li:focus, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:active, 
					{{WRAPPER}} .menu-wrap-off .sidenav ul.menu ul.sub-menu li:focus'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;'
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_tabs();


		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 * @since 1.5.2
	 * @param string $atts link attributes.
	 * @access public
	 */
	public function handle_link_attrs($atts)
	{

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 * @since 1.6.0
	 * @param string $value link attributes.
	 * @access public
	 */
	public function handle_li_values($value)
	{

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Get the menu and close icon HTML.
	 *
	 * @since 1.5.2
	 * @param array $settings Widget settings array.
	 * @access public
	 */
	public function get_menu_close_icon($settings)
	{
		$menu_icon     = '';
		$close_icon    = '';
		$icons         = [];
		$icon_settings = [
			$settings['dropdown_icon'],
			$settings['dropdown_close_icon'],
		];

		foreach ($icon_settings as $icon) {
			if ($this->is_elementor_updated()) {
				ob_start();
				\Elementor\Icons_Manager::render_icon(
					$icon,
					[
						'aria-hidden' => 'true',
						'tabindex'    => '0',
					]
				);
				$menu_icon = ob_get_clean();
			} else {
				$menu_icon = '<i class="' . esc_attr($icon) . '" aria-hidden="true" tabindex="0"></i>';
			}

			array_push($icons, $menu_icon);
		}

		return $icons;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();


		$menus = $this->get_available_menus();
		if (empty($menus)) {
			return false;
		}
		$args = [
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'menu',
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
			'walker'      => '',
		];
		$menu_html = wp_nav_menu($args);



?>

		<div class="menu-area <?php echo esc_attr($settings['layout']); ?> <?php echo esc_attr($settings['dropdown']); ?>">
			<div class="menu_one  <?php echo esc_attr($settings['layout']) . '_wraper'; ?> <?php echo $settings['enable_two_column']; ?>">
				<div class="col-cell menu-responsive">
					<?php
					$menus = $this->get_available_menus();
					if (empty($menus)) {
						return false;
					}
					$args = [
						'echo'        => false,
						'menu'        => $settings['menu'],
						'menu_class'  => 'menu',
						'fallback_cb' => '__return_empty_string',
						'container'   => '',
						'walker'      => '',
					];
					$menu_html = wp_nav_menu($args);


					// User has assigned menu to this location;
					// output it
					?>
					<nav class="nav navbar">

						<?php
						echo $menu_html;
						?>

						<?php

						?>
				</div>

				<?php if ($settings['layout'] == 'flyout' || ($settings['layout'] == 'horizontal')) :
				?>
					<div class="<?php echo esc_attr($settings['layout']) . '_menu_icon'; ?>">
						<div class="nav-link-container center">
							<button class="nav-menu-link menu-button">
								<?php
								if (!empty($settings['dropdown_icon']) && !empty($settings['dropdown_icon']['value'])) {
									\Elementor\Icons_Manager::render_icon($settings['dropdown_icon'], ['aria-hidden' => 'true']);
								} else {
								?>
									<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect y="14" width="18" height="2" fill="#ffffff"></rect>
										<rect y="7" width="18" height="2" fill="#ffffff"></rect>
										<rect width="18" height="2" fill="#ffffff"></rect>
									</svg>
								<?php
								}
								?>
							</button>
						</div>
					</div>
				<?php endif;
				?>

			</div>
		</div>

<?php
		get_template_part('inc/header/off-canvas');
	}
}
?>