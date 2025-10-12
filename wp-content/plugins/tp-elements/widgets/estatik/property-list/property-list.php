<?php

/**
 * Property Grid Widget
 * @package TP Elements
 * @since 1.0.0
 * @version 1.0.0
 * 
 * custom property grid widget file
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;

class TP_Est_Property_List extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Property widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tp-est-property-list';
    }

    /**
     * Get widget title.
     *
     * Retrieve Property widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Estatik Property List', 'tp-elements');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Property widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-post-list';
    }

    /**
     * Retrieve the list of scripts the Property widget showed on.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_categories()
    {
        return ['tp-elements'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the Property widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['property', 'list', 'estatik', 'real estate', 'listing'];
    }

    /**
     * Register Property widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'property_layout',
            [
                'label' => esc_html__('Layout', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => 'Style 1',
                ],
            ]
        );

        $this->add_control(
            'property_category',
            [
                'label'   => esc_html__('Category', 'tp-elements'),
                'type'    => Controls_Manager::SELECT2,
                'default' => 0,
                'options' => $this->getCategories(),
                'multiple' => true,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'post_per_page',
            [
                'label' => esc_html__('Post Per Page', 'tp-elements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'post_pagination_show_hide',
            [
                'label' => esc_html__('Pagination Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title & Description', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_line_clamp',
            [
                'label' => esc_html__('Title Line Row', 'tp-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'line-clamp-2',
                'options' => [
                    'line-clamp-1' => esc_html__('One', 'tp-element'),
                    'line-clamp-2' => esc_html__('Two', 'tp-element'),
                    'line-clamp-3' => esc_html__('Three', 'tp-element'),
                    'line-clamp-4' => esc_html__('Four', 'tp-element'),
                    'line-clamp-5' => esc_html__('Five', 'tp-element'),
                    'line-clamp-6' => esc_html__('Six', 'tp-element'),
                    'line-clamp-7' => esc_html__('Seven', 'tp-element'),
                    'line-clamp-8' => esc_html__('Eight', 'tp-element'),
                    'line-clamp-9' => esc_html__('Nine', 'tp-element'),
                    'line-clamp-10' => esc_html__('Ten', 'tp-element'),
                    'line-clamp-11' => esc_html__('Eleven', 'tp-element'),
                    'line-clamp-12' => esc_html__('Twelve', 'tp-element'),
                ],
            ]
        );

        $this->add_control(
            'title_link_open',
            [
                'label'   => esc_html__('Link Open New Window', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'no' => esc_html__('No', 'tp-elements'),
                    'yes' => esc_html__('Yes', 'tp-elements'),

                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tp-elements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__('H1', 'tp-elements'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__('H2', 'tp-elements'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__('H3', 'tp-elements'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__('H4', 'tp-elements'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__('H5', 'tp-elements'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__('H6', 'tp-elements'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );
        $this->add_control(
            'property_text_show_hide',
            [
                'label' => esc_html__('Content Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'text_line_clamp',
            [
                'label' => esc_html__('Content Line Row', 'tp-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'line-clamp-2',
                'options' => [
                    'line-clamp-1' => esc_html__('One', 'tp-element'),
                    'line-clamp-2' => esc_html__('Two', 'tp-element'),
                    'line-clamp-3' => esc_html__('Three', 'tp-element'),
                    'line-clamp-4' => esc_html__('Four', 'tp-element'),
                    'line-clamp-5' => esc_html__('Five', 'tp-element'),
                    'line-clamp-6' => esc_html__('Six', 'tp-element'),
                    'line-clamp-7' => esc_html__('Seven', 'tp-element'),
                    'line-clamp-8' => esc_html__('Eight', 'tp-element'),
                    'line-clamp-9' => esc_html__('Nine', 'tp-element'),
                    'line-clamp-10' => esc_html__('Ten', 'tp-element'),
                    'line-clamp-11' => esc_html__('Eleven', 'tp-element'),
                    'line-clamp-12' => esc_html__('Twelve', 'tp-element'),
                ],
            ]
        );

        $this->add_control(
            'property_address_show_hide',
            [
                'label' => esc_html__('Address Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_meta',
            [
                'label' => esc_html__('Property Meta', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'property_meta_show_hide',
            [
                'label' => esc_html__('Meta Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'property_bedroom_show_hide',
            [
                'label' => esc_html__('Bedroom Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'property_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_bathroom_show_hide',
            [
                'label' => esc_html__('Bathroom Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'property_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_area_show_hide',
            [
                'label' => esc_html__('Area Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'property_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_parking_show_hide',
            [
                'label' => esc_html__('Parking Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'property_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_price_show_hide',
            [
                'label' => esc_html__('Price Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'property_location_show_hide',
            [
                'label' => esc_html__('Location Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'property_compare_show_hide',
            [
                'label' => esc_html__('Compare Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Button', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'property_btn_show_hide',
            [
                'label' => esc_html__('Button Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'property_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View Details',
                'placeholder' => esc_html__('Button Text', 'tp-elements'),
                'separator' => 'before',
                'condition' => [
                    'property_btn_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_btn_link_open',
            [
                'label'   => esc_html__('Link Open New Window', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'no' => esc_html__('No', 'tp-elements'),
                    'yes' => esc_html__('Yes', 'tp-elements'),
                ],
                'condition' => [
                    'property_btn_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_btn_icon_show_hide',
            [
                'label' => esc_html__('Icon Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'condition' => [
                    'property_btn_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_btn_icon',
            [
                'label' => esc_html__('Icon', 'tp-elements'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
                'separator' => 'before',
                'condition' => [
                    'property_btn_show_hide' => ['yes'],
                    'property_btn_icon_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_btn_icon_position',
            [
                'label' => esc_html__('Icon Position', 'tp-elements'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => esc_html__('Before', 'tp-elements'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => esc_html__('After', 'tp-elements'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'condition' => [
                    'property_btn_icon!' => '',
                    'property_btn_show_hide' => ['yes'],
                    'property_btn_icon_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'property_btn_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,

                'condition' => [
                    'property_btn_icon!' => '',
                    'property_btn_show_hide' => ['yes'],
                    'property_btn_icon_show_hide' => ['yes'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-actions .action-button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_columns',
            [
                'label' => esc_html__('Columns', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'columns_xl',
            [
                'label' => esc_html__('Columns (<= 1200px)', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '2' => '6',
                ],
            ]
        );

        $this->add_control(
            'columns_lg',
            [
                'label' => esc_html__('Columns (<= 992px)', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '2' => '6',
                ],
            ]
        );

        $this->add_control(
            'columns_md',
            [
                'label' => esc_html__('Columns (<= 768px)', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '2' => '6',
                ],
            ]
        );

        $this->add_control(
            'columns_sm',
            [
                'label' => esc_html__('Columns (<= 576px)', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '2' => '6',
                ],
            ]
        );

        $this->add_control(
            'columns_xsm',
            [
                'label' => esc_html__('Columns (<= 480px)', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '2' => '6',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-title',
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'compare_style',
            [
                'label' => esc_html__('Compare Button Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'compare_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-compare-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'compare_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-compare-button' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'compare_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-compare-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'compare_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-compare-button',
            ]
        );

        $this->add_control(
            'compare_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-compare-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'compare_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-compare-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'compare_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-compare-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'price_style',
            [
                'label' => esc_html__('Price Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'price_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-price',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'price_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-price',
            ]
        );

        $this->add_control(
            'price_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_wrap_heading',
            [
                'label' => esc_html__('Price Wrap', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'price_wrap_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-price-location-wrapper',
            ]
        );

        $this->add_control(
            'price_wrap_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price-location-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_wrap_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-price-location-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'city_style',
            [
                'label' => esc_html__('City Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'city_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address-city-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'city_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-address-city-text',
            ]
        );

        $this->add_control(
            'city_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address-city-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'city_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address-city-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'city_icon_heading',
            [
                'label' => esc_html__('Icon', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'city_icon_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address-city-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'city_icon_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address-city-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'feature_style',
            [
                'label' => esc_html__('Features Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-feature-item .property-feature-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-feature-item .property-feature-text',
            ]
        );

        $this->add_control(
            'feature_icon_heading',
            [
                'label' => esc_html__('Icon', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'feature_icon_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-feature-item .property-feature-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'property_text_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-description',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'description_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-description',
            ]
        );

        $this->add_control(
            'description_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'address_style',
            [
                'label' => esc_html__('Address Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'property_address_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'address_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'address_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-address',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'address_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .property-address',
            ]
        );

        $this->add_control(
            'address_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'address_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .property-address' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__('Background Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__('Hover Background Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .action-button',
            ]
        );

        // Normal state border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .property-listing-card .property-content .action-button',
            ]
        );

        // Hover state border (using different approach)
        $this->add_control(
            'button_border_hover_color',
            [
                'label' => esc_html__('Hover Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .property-listing-card .property-content .action-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }



    /**
     * Render Property widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $sstyle = $settings['property_layout'];
        $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h4';

        // grid column classes
        $col_xl = $settings['columns_xl'] ? $settings['columns_xl'] : 4;
        $col_lg = $settings['columns_lg'] ? $settings['columns_lg'] : 4;
        $col_md = $settings['columns_md'] ? $settings['columns_md'] : 6;
        $col_sm = $settings['columns_sm'] ? $settings['columns_sm'] : 12;
        $col_xsm = $settings['columns_xsm'] ? $settings['columns_xsm'] : 12;

        // Query Args
        if (class_exists('estatik') ||  post_type_exists('properties')) {
            $cat = $settings['property_category'];
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            if (empty($cat)) {
                $queried_post = new wp_Query(array(
                    'post_type'      => 'properties',
                    'posts_per_page' => $settings['post_per_page'],
                    'paged'          => $paged,
                ));
            } else {
                $queried_post = new wp_Query(array(
                    'post_type'      => 'properties',
                    'posts_per_page' => $settings['post_per_page'],
                    'paged'          => $paged,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'es_category',
                            'field'    => 'slug', //can be set to ID
                            'terms'    => $cat //if field is ID you can reference by cat/term number
                        ),
                    )
                ));
            }

            // Render property grid layout
?>

            <div class="property-listing-section property-list property-list-layout-<?php echo esc_attr($settings['property_layout']); ?>">
                <div class="row g-4">

                    <?php
                    while ($queried_post->have_posts()):
                        $queried_post->the_post();
                        $post_id = get_the_ID();

                        $att = get_post_thumbnail_id();
                        $image_src = wp_get_attachment_image_src($att, 'full');
                        if (!empty($image_src)) {
                            $image_src = $image_src[0];
                        }

                        $category = get_the_terms($post_id, 'es_category');
                        $address = get_post_meta($post_id, 'es_property_address');
                        $address_full = get_post_meta($post_id, 'es_property_address_components');
                        $parking = get_post_meta($post_id, 'es_property_garage-spaces', false);
                        $area = get_post_meta($post_id, 'es_property_lot_size');

                        $bedrooms = get_post_meta($post_id, 'es_property_bedrooms');
                        $bathrooms = get_post_meta($post_id, 'es_property_bathrooms', false);

                        $property_type = get_post_meta($post_id, 'es_property_type', false);
                        $images = get_post_meta($post_id, 'es_property_gallery', false);
                        $videos = get_post_meta($post_id, 'es_property_video', false);

                        $property_rent_type = get_post_meta($post_id, 'es_property_property-rent-type', false);

                        // Decode the JSON address components
                        if (isset($address_full[0]) && !empty($address_full[0])) {
                            $decoded = json_decode($address_full[0], true);
                            if ($decoded !== null) {
                                // Get street number
                                $street_number = '';
                                $route = '';
                                $city = '';
                                $state = '';
                                $country = '';
                                $postal_code = '';

                                foreach ($decoded as $component) {
                                    if (in_array('street_number', $component['types'])) {
                                        $street_number = $component['long_name'];
                                    }
                                    if (in_array('route', $component['types'])) {
                                        $route = $component['long_name'];
                                    }
                                    if (in_array('locality', $component['types'])) {
                                        $city = $component['long_name'];
                                    }
                                    if (in_array('administrative_area_level_1', $component['types'])) {
                                        $state = $component['short_name'];
                                    }
                                    if (in_array('country', $component['types'])) {
                                        $country = $component['long_name'];
                                    }
                                    if (in_array('postal_code', $component['types'])) {
                                        $postal_code = $component['long_name'];
                                    }
                                }

                                // Display formatted address
                                // echo "Full Address: $street_number $route, $city, $state $postal_code, $country";
                                // Output: Full Address: 725 Northeast 166th Street, Miami, FL 33162, United States
                            }
                        }

                        // Load styles
                        if ($settings['property_layout'] == 'style1') {
                            include dirname(__FILE__) . '/style1.php';
                        }
                    endwhile;
                    ?>


                </div>
            </div>
<?php
        }
    }

    public function getCategories()
    {
        $cat_list = [];
        if (post_type_exists('properties')) {
            $terms = get_terms(array(
                'taxonomy'    => 'es_category',
                'hide_empty'  => true
            ));
            foreach ($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }
        return $cat_list;
    }
}
