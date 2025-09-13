<?php

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Trading_Categories_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'categories_widget';
    }

    public function get_title()
    {
        return __('Categories', 'tp-elements');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // CONTENT TAB
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label'   => __('Post Type', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->get_filtered_post_types(),
                'default' => 'post',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __('Layout', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid'   => __('Grid', 'tp-elements'),
                    'slider' => __('Slider', 'tp-elements'),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'     => __('Columns', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'default'   => '4',
                'condition' => [
                    'layout' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .categories-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label'   => __('Post Limit', 'tp-elements'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => __('Order By', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'name'         => __('Name', 'tp-elements'),
                    'count'        => __('Count', 'tp-elements'),
                    'term_group'   => __('Term Group', 'tp-elements'),
                    'id'           => __('ID', 'tp-elements'),
                ],
                'default' => 'name',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __('Order', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => __('Ascending', 'tp-elements'),
                    'DESC' => __('Descending', 'tp-elements'),
                ],
                'default' => 'ASC',
            ]
        );

        $this->add_control(
            'title_words_limit',
            [
                'label' => esc_html__('Title Words Limit', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'show_thumbnail',
            [
                'label'        => __('Show Thumbnail', 'tp-elements'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'tp-elements'),
                'label_off'    => __('Hide', 'tp-elements'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'        => __('Show Post Count', 'tp-elements'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'tp-elements'),
                'label_off'    => __('Hide', 'tp-elements'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'overlay_heading',
            [
                'label' => esc_html__('Overlay', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay',
            [
                'label'        => __('Overlay', 'tp-elements'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'tp-elements'),
                'label_off'    => __('Hide', 'tp-elements'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();




        // slider settings
        $this->start_controls_section(
            'slider_settings',
            [
                'label'     => __('Slider Settings', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'slider',
                ],
            ]
        );

        $this->add_control(
            'col_xl',
            [
                'label'   => esc_html__('Wide Screen > 1399px', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'tp-elements'),
                    '2' => esc_html__('2 Column', 'tp-elements'),
                    '3' => esc_html__('3 Column', 'tp-elements'),
                    '4' => esc_html__('4 Column', 'tp-elements'),
                    '4.5' => esc_html__('4.5 Column', 'tp-elements'),
                    '5' => esc_html__('5 Column', 'tp-elements'),
                    '6' => esc_html__('6 Column', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__('Desktops > 1199px', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'tp-elements'),
                    '2' => esc_html__('2 Column', 'tp-elements'),
                    '3' => esc_html__('3 Column', 'tp-elements'),
                    '4' => esc_html__('4 Column', 'tp-elements'),
                    '6' => esc_html__('6 Column', 'tp-elements'),
                ],
                'separator' => 'before',
            ]

        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Laptop > 991px', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'tp-elements'),
                    '2' => esc_html__('2 Column', 'tp-elements'),
                    '3' => esc_html__('3 Column', 'tp-elements'),
                    '4' => esc_html__('4 Column', 'tp-elements'),
                    '6' => esc_html__('6 Column', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Column', 'tp-elements'),
                    '2' => esc_html__('2 Column', 'tp-elements'),
                    '3' => esc_html__('3 Column', 'tp-elements'),
                    '4' => esc_html__('4 Column', 'tp-elements'),
                    '6' => esc_html__('6 Column', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__('Tablets < 768px', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1 Column', 'tp-elements'),
                    '2' => esc_html__('2 Column', 'tp-elements'),
                    '3' => esc_html__('3 Column', 'tp-elements'),
                    '4' => esc_html__('4 Column', 'tp-elements'),
                    '6' => esc_html__('6 Column', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__('Slide To Scroll', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Item', 'tp-elements'),
                    '2' => esc_html__('2 Item', 'tp-elements'),
                    '3' => esc_html__('3 Item', 'tp-elements'),
                    '4' => esc_html__('4 Item', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__('Navigation Dots', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__('Navigation Nav', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',
            ]

        );

        $this->add_responsive_control(
            'nav_width',
            [
                'label' => esc_html__('Width', 'plugin-name'),
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
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_responsive_control(
            'nav_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
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
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );


        $this->add_control(
            'slider_nav_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_border',
                'selector' => '{{WRAPPER}} .tp-categories-navigation-wrapp > span',
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_hover_border',
                'selector' => '{{WRAPPER}} .tp-categories-navigation-wrapp > span:hover',
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_control(
            'pcat_nav_text_bg',
            [
                'label' => esc_html__('Nav BG Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover',
            [
                'label' => esc_html__('Nav BG Hover Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span:hover' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_icon',
            [
                'label' => esc_html__('Nav BG Icon Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover_icon',
            [
                'label' => esc_html__('Nav BG Icon Hover Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp > span:hover i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );


        $this->add_responsive_control(
            'navigation_top_space',
            [
                'label' => esc_html__('Navigation Top', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                    'em' => [
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_responsive_control(
            'nav_transform_left',
            [
                'label' => esc_html__('Navigation Transform Left', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_transform_right',
            [
                'label' => esc_html__('Navigation Transform Right', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-categories-navigation-wrapp' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__('Autoplay', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__('Autoplay Slide Speed', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '1000' => esc_html__('1 Seconds', 'tp-elements'),
                    '2000' => esc_html__('2 Seconds', 'tp-elements'),
                    '3000' => esc_html__('3 Seconds', 'tp-elements'),
                    '4000' => esc_html__('4 Seconds', 'tp-elements'),
                    '5000' => esc_html__('5 Seconds', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__('Autoplay Interval', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '5000' => esc_html__('5 Seconds', 'tp-elements'),
                    '4000' => esc_html__('4 Seconds', 'tp-elements'),
                    '3000' => esc_html__('3 Seconds', 'tp-elements'),
                    '2000' => esc_html__('2 Seconds', 'tp-elements'),
                    '1000' => esc_html__('1 Seconds', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__('Stop On Interaction', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__('Stop on Hover', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__('Loop', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__('Center Mode', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'tp-elements'),
                    'false' => esc_html__('Disable', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__('Item Middle Gap', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 16,
                ],
            ]
        );

        $this->add_control(
            'item_gap_custom_bottom',
            [
                'label' => esc_html__('Item Bottom Gap', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],

                'selectors' => [
                    '{{WRAPPER}} .themephi-addon-slider .testimonial-item' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        // STYLE TAB
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'card_background',
                'label'    => __('Background', 'tp-elements'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .category-card',
            ]
        );

        $this->add_control(
            'card_text_color',
            [
                'label'     => __('Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-card' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .category-title',
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
                'default' => 'h4',
                'toggle' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'label'    => __('Border', 'tp-elements'),
                'selector' => '{{WRAPPER}} .category-card',
            ]
        );


        $this->add_control(
            'card_border_radius',
            [
                'label'     => __('Border Radius', 'tp-elements'),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .category-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __('Box Shadow', 'tp-elements'),
                'selector' => '{{WRAPPER}} .category-card',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'     => __('Padding', 'tp-elements'),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .category-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_style_heading',
            [
                'label' => esc_html__('Overlay Style', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_background_color',
            [
                'label'     => __('Overlay Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-overlay' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'overlay_typography',
                'selector' => '{{WRAPPER}} .category-overlay-content .category-overlay-title',
            ]
        );

        $this->add_control(
            'overlay_text_color',
            [
                'label'     => __('Overlay Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-overlay-content .category-overlay-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'overlay_text_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .category-overlay-content .category-overlay-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_icon_color',
            [
                'label'     => __('Overlay Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_icon_bg_color',
            [
                'label'     => __('Overlay Icon Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'overlay_icon_size',
            [
                'label'     => __('Overlay Icon Size', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'default'   => [
                    'size' => 24,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .category-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'overlay_icon_box_size',
            [
                'label'     => __('Overlay Icon Size Box', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'default'   => [
                    'size' => 42,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .category-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get post types without unwanted ones
     */
    protected function get_filtered_post_types()
    {
        // Get all public post types
        $post_types = get_post_types(['public' => true], 'objects');

        // Unwanted post types
        $exclude = [
            'page',
            'attachment',
            'elementor_library',
            'tp-canvans',
            'tpelements_pro',
            'elementor-hf',
            'wpforms',
        ];

        $options = [];
        foreach ($post_types as $slug => $obj) {
            if (in_array($slug, $exclude, true)) {
                continue;
            }
            $options[$slug] = $obj->label;
        }

        return $options;
    }

    protected function render()
    {
        $settings    = $this->get_settings_for_display();
        $post_type   = $settings['post_type'];
        $categories  = isset($settings['categories']) ? $settings['categories'] : [];
        $layout      = $settings['layout'];
        $show_count  = $settings['show_count'];
        $post_limit  = $settings['post_limit'];

        $title_words_limit = !empty($settings['title_words_limit']) ? $settings['title_words_limit'] : 1;

        $taxonomy = '';
        $taxonomies = get_object_taxonomies($post_type, 'objects');
        foreach ($taxonomies as $tax) {
            if ($tax->hierarchical) {
                $taxonomy = $tax->name;
                break;
            }
        }

        if (!$taxonomy) {
            echo '<div class="no-category-msg">' .
                __('No category taxonomy found for this post type.', 'tp-elements') .
                '</div>';
            return;
        }

        $args = [
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'number'     => $post_limit,
            'orderby'    => $settings['order_by'],
            'order'      => $settings['order'],
        ];

        // Add slug filter only if categories are selected
        if (!empty($categories)) {
            $args['slug'] = $categories;
        }

        $terms = get_terms($args);

        if (empty($terms) || is_wp_error($terms)) {
            echo '<div class="no-category-msg">' .
                sprintf(
                    __('No categories found for this post type. <a href="%s" target="_blank">Create one here</a>.', 'tp-elements'),
                    admin_url('edit-tags.php?taxonomy=' . $taxonomy . '&post_type=' . $post_type)
                ) .
                '</div>';
            return;
        }


        // slider settings
        $col_xl          = $settings['col_xl'];
        $col_xl          = !empty($col_xl) ? $col_xl : 3;
        $slidesToShow    = $col_xl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';

        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];

        $item_gap_desktop = !empty($settings['item_gap_custom']['size']) ? $settings['item_gap_custom']['size'] : '24';
        $item_gap_tablet  = !empty($settings['item_gap_custom_tablet']['size']) ? $settings['item_gap_custom_tablet']['size'] : $item_gap_desktop;
        $item_gap_mobile  = !empty($settings['item_gap_custom_mobile']['size']) ? $settings['item_gap_custom_mobile']['size'] : $item_gap_tablet;



        $unique = rand(2012, 35120);

        if ($slider_autoplay == 'true') {
            $slider_autoplay = 'autoplay: { ';
            $slider_autoplay .= 'delay: ' . $interval;
            if ($pauseOnHover == 'true') {
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            } else {
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if ($pauseOnInter == 'true') {
                $slider_autoplay .= ', disableOnInteraction: true';
            } else {
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        } else {
            $slider_autoplay = 'autoplay: false';
        }




        // Render categories based on layout
        if ($layout === 'grid') {
?>
            <div class="categories-wrapper categories-grid">
                <?php foreach ($terms as $term) : ?>
                    <div class="category-card position-relative">
                        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="category-link d-block">
                            <?php if ($settings['show_thumbnail'] === 'yes' && !empty($term->term_id)) : ?>
                                <?php
                                $tp_cat_image = get_term_meta($term->term_id, 'tp_cat_image', true);

                                if ($tp_cat_image) {
                                    echo '<img src="' . esc_url($tp_cat_image) . '" alt="' . esc_attr($term->name) . '" class="category-thumbnail">';
                                }

                                ?>
                            <?php endif; ?>

                            <<?php echo esc_attr($settings['title_tag']); ?> class="category-title">
                                <?php
                                $title = wp_trim_words($term->name, $title_words_limit, '');
                                echo esc_html($title);
                                ?>
                            </<?php echo esc_attr($settings['title_tag']); ?>>
                            <?php if ($show_count === 'yes') : ?>
                                <div class="category-count"><?php echo esc_html($term->count); ?> <?php _e('Items', 'tp-elements'); ?></div>
                            <?php endif; ?>

                            <!-- overlay -->
                            <?php if ($settings['overlay'] === 'yes') : ?>
                                <div class="category-overlay">
                                    <div class="category-overlay-content">
                                        <<?php echo esc_attr($settings['title_tag']); ?> class="category-overlay-title">
                                            <?php
                                            $title = wp_trim_words($term->name, $title_words_limit, '');
                                            echo esc_html($title);
                                            ?>
                                        </<?php echo esc_attr($settings['title_tag']); ?>>
                                        <span class="category-icon">
                                            <i class="tp-arrow-up-right"></i>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php
        } elseif ($layout === 'slider') {
        ?>

            <div class=position-relative>
                <div class="swiper categories-wrapper categories-slider categories-slider-<?php echo esc_attr($unique); ?>">
                    <div class="swiper-wrapper h-unset">
                        <?php foreach ($terms as $term) : ?>
                            <div class="swiper-slide">
                                <div class="category-card position-relative h-100">
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>" class="category-link d-block">
                                        <?php if ($settings['show_thumbnail'] === 'yes' && !empty($term->term_id)) : ?>
                                            <?php
                                            $tp_cat_image = get_term_meta($term->term_id, 'tp_cat_image', true);

                                            if ($tp_cat_image) {
                                                echo '<img src="' . esc_url($tp_cat_image) . '" alt="' . esc_attr($term->name) . '" class="category-thumbnail">';
                                            }
                                            ?>
                                        <?php endif; ?>

                                        <<?php echo esc_attr($settings['title_tag']); ?> class="category-title">

                                            <?php
                                            $title = wp_trim_words($term->name, $title_words_limit, '');
                                            echo esc_html($title);
                                            ?>

                                        </<?php echo esc_attr($settings['title_tag']); ?>>

                                        <?php if ($show_count === 'yes') : ?>
                                            <div class="category-count"><?php echo esc_html($term->count); ?> <?php _e('Items', 'tp-elements'); ?></div>
                                        <?php endif; ?>

                                        <!-- overlay -->
                                        <?php if ($settings['overlay'] === 'yes') : ?>
                                            <div class="category-overlay">
                                                <div class="category-overlay-content">
                                                    <span class="category-overlay-title">
                                                        <<?php echo esc_attr($settings['title_tag']); ?> class="category-title">
                                                            <?php
                                                            $title = wp_trim_words($term->name, $title_words_limit, '');
                                                            echo esc_html($title);
                                                            ?>
                                                        </<?php echo esc_attr($settings['title_tag']); ?>>
                                                    </span>
                                                    <span class="category-icon">
                                                        <i class="tp-arrow-up-right"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($sliderNav === 'true') : ?>
                    <div class="tp-categories-navigation-wrapp">
                        <span class="tp-category-nav-prev "><i class="tp-arrow-left"></i></span>
                        <span class="tp-category-nav-next "><i class="tp-arrow-right"></i></span>
                    </div>
                <?php endif; ?>
            </div>

            <script>
                jQuery(document).ready(function() {
                    var swiper = new Swiper(".categories-slider-<?php echo esc_attr($unique); ?>", {
                        slidesPerView: <?php echo $slidesToShow; ?>,
                        speed: <?php echo esc_attr($autoplaySpeed); ?>,

                        loop: <?php echo esc_attr($infinite); ?>,
                        <?php echo esc_attr($slider_autoplay); ?>,
                        spaceBetween: <?php echo esc_attr($item_gap_mobile); ?>,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        centeredSlides: <?php echo esc_attr($centerMode); ?>,
                        navigation: {
                            nextEl: ".tp-category-nav-next",
                            prevEl: ".tp-category-nav-prev",
                        },
                        breakpoints: {
                            0: {
                                slidesPerView: <?php echo esc_attr($col_xs); ?>,
                                spaceBetween: <?php echo esc_attr($item_gap_mobile); ?>
                            },
                            575: {
                                slidesPerView: <?php echo esc_attr($col_xs); ?>,
                                spaceBetween: <?php echo esc_attr($item_gap_mobile); ?>
                            },
                            767: {
                                slidesPerView: <?php echo esc_attr($col_sm); ?>,
                                spaceBetween: <?php echo esc_attr($item_gap_tablet); ?>
                            },
                            991: {
                                slidesPerView: <?php echo esc_attr($col_md); ?>,
                                spaceBetween: <?php echo esc_attr($item_gap_tablet); ?>
                            },
                            1199: {
                                slidesPerView: <?php echo esc_attr($col_lg); ?>,
                                spaceBetween: <?php echo esc_attr($item_gap_desktop); ?>
                            },
                            1399: {
                                slidesPerView: <?php echo esc_attr($col_xl); ?>,
                                spaceBetween: <?php echo esc_attr($item_gap_desktop); ?>
                            }
                        }
                    });
                });
            </script>
<?php
        }
    }
}
