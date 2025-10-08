<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

defined('ABSPATH') || die();

class Themephi_Elementor_Blog_Slider_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tp-blog-slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve rsgallery widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('TP Blog Slider', 'tp-elements');
    }

    /**
     * Get widget icon.
     *
     * Retrieve rsgallery widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-slider-3';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the rsgallery widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['pielements_category'];
    }


    protected function register_controls()
    {


        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'blog_slider_style',
            [
                'label'   => esc_html__('Select Style', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => 'Style 1',
                    '2' => 'Style 2',
                    '3' => 'Style 3',
                    '4' => 'Style 4',
                    '5' => 'Style 5',
                ],
            ]
        );


        $this->add_control(
            'blog_category',
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
            'per_page',
            [
                'label' => esc_html__('Blog Show Per Page', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('example 3', 'tp-elements'),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'details_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                // 'condition' => [
                //     'blog_slider_style' => '3',
                // ],
            ]
        );


        $this->add_control(
            'show_graycale',
            [
                'label' => esc_html__('Enable Image Grayscale', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tp-elements'),
                'label_off' => esc_html__('Hide', 'tp-elements'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );



        $this->end_controls_section();


        $this->start_controls_section(
            'meta_section',
            [
                'label' => esc_html__('Meta Settings', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'blog_meta_show_hide',
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
            'blog_avatar_show_hide',
            [
                'label' => esc_html__('Author Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__('Category Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_comments_show_hide',
            [
                'label' => esc_html__('Comments Show / Hide', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__('Yes', 'tp-elements'),
                    'no' => esc_html__('No', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );



        $this->add_control(
            'blog_date_show_hide',
            [
                'label' => esc_html__('Date Show / Hide', 'tp-elements'),
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
            'button_section',
            [
                'label' => esc_html__('Button Settings', 'tp-elements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'blog_readmore_text',
            [
                'label' => esc_html__('Button text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_readmore_icon',
            [
                'label' => esc_html__('Button Icon', 'tp-elements'),
                'type' => Controls_Manager::ICON,
                'separator' => 'before',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'blog_readmore_icon_position',
            [
                'label' => esc_html__('Button Icon Position', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'tp-elements'),
                    'right' => esc_html__('Right', 'tp-elements'),
                ],
                'separator' => 'before',
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__('Slider Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'col_xxl',
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
            'col_xl',
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
            'col_lg',
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
            'col_md',
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
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 575px', 'tp-elements'),
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
            'col_xs',
            [
                'label'   => esc_html__('Tablets < 575px', 'tp-elements'),
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
            'slider_nav_align',
            [
                'label' => esc_html__('Slider Navigation Alignment', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'tp-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tp-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'tp-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Justified', 'tp-elements'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-navigation-wrapp' => 'justify-content: {{VALUE}};',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );



        $this->add_responsive_control(
            'slider_nav_padding',
            [
                'label' => esc_html__('Pagination Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-navigation-wrapp > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tp-blog-navigation-wrapp > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_border',
                'label' => esc_html__('Border', 'tp-elements'),
                'selector' => '{{WRAPPER}} .tp-blog-navigation-wrapp > span',
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_hover_border',
                'label' => esc_html__('Hover Border', 'tp-elements'),
                'selector' => '{{WRAPPER}} .tp-blog-navigation-wrapp > span:hover',
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_control(
            'pcat_nav_text_bg',
            [
                'label' => esc_html__('Nav BG Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-navigation-wrapp > span' => 'background-color: {{VALUE}} !important;',
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
                    '{{WRAPPER}} .tp-blog-navigation-wrapp > span:hover' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_icon',
            [
                'label' => esc_html__('Nav Icon Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-navigation-wrapp > span i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover_icon',
            [
                'label' => esc_html__('Nav Icon Hover Color', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-navigation-wrapp > span:hover i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_control(
            'navigation_top_space',
            [
                'label' => esc_html__('Navigation Top', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],

                'selectors' => [
                    '{{WRAPPER}} .tp-blog-navigation-wrapp' => 'transform: translateY({{SIZE}}{{UNIT}});',
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
                    'size' => 15,
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




        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__('Card Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_card_background',
                'label' => esc_html__('Background', 'tp-elements'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .tp-blog-slider  .blog-item',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                        'label' => esc_html__('Background', 'tp-elements'),
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_card_hover_background',
                'label' => esc_html__('Hover Background', 'tp-elements'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .tp-blog-slider  .blog-item:hover',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                        'label' => esc_html__('Hover Background', 'tp-elements'),
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => esc_html__('Card Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .tp-blog-slider .blog-item',
                'fields_options' => [
                    'border' => [
                        'label' => esc_html__('Card Border', 'plugin-name'),
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_hover_border',
                'label' => esc_html__('Card Hover Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .tp-blog-slider .blog-item:hover',
                'fields_options' => [
                    'border' => [
                        'label' => esc_html__('Card Hover Border', 'plugin-name'),
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Card Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_margin',
            [
                'label' => esc_html__('Card Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Card Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_slider_image_style',
            [
                'label' => esc_html__('Image Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .image-part img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'card_content_style',
            [
                'label' => esc_html__('Card Content Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_content_width',
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
                    '{{WRAPPER}} .tp-blog-slider .blog-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_card_content_background',
                'label' => esc_html__('Background', 'tp-elements'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .tp-blog-slider  .blog-content',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_content_border',
                'label' => esc_html__('Content Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .tp-blog-slider .blog-content',
            ]
        );

        $this->add_responsive_control(
            'blog_slider_content_padding',
            [
                'label' => esc_html__('Content Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_slider_content_margin',
            [
                'label' => esc_html__('Content Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_slider_title_style',
            [
                'label' => esc_html__('Title Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Title Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .title:hover' => 'color: {{VALUE}};',
                ],
            ]

        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .tp-blog-slider .title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .tp-blog-slider .title',
            ]

        );

        $this->add_responsive_control(
            'blog_title_padding',
            [
                'label' => esc_html__('Title Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'blog_title_margin',
            [
                'label' => esc_html__('Title Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_category_style',
            [
                'label' => esc_html__('Category Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .tp-blog-slider .post-categories li a',
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => esc_html__('Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__('Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_bg_color',
            [
                'label' => esc_html__('Background Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_bg_hover_color',
            [
                'label' => esc_html__('Hover Background Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'category_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'category_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'category_border_radius',
            [
                'label' => esc_html__('Border Radius', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .post-categories li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_meta_style',
            [
                'label' => esc_html__('Meta Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => esc_html__('Text Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-content .blog-meta li span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_bg_color',
            [
                'label' => esc_html__('Meta BG Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-content .blog-meta li span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_separator_color',
            [
                'label' => esc_html__('Separator Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-content .blog-meta li::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_slider_button_style',
            [
                'label' => esc_html__('Button Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => esc_html__('Typography', 'tp-elements'),
                'selector' => '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a, .tp-blog-slider .tps-read-more',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Button Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a, .tp-blog-slider .tps-read-more' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__('Button Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a:hover, .tp-blog-slider .tps-read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Button BG Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a, .tp-blog-slider .tps-read-more' => 'background: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => esc_html__('Button Hover BG Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a:hover, .tp-blog-slider .tps-read-more:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_button_padding',
            [
                'label' => esc_html__('Button Padding', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a, .tp-blog-slider .tps-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_button_margin',
            [
                'label' => esc_html__('Button Margin', 'tp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a, .tp-blog-slider .tps-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a, .tp-blog-slider .tps-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_heading',
            [
                'label' => esc_html__('Icon', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a i, .tp-blog-slider .tps-read-more i',
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__('Width', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a i, .tp-blog-slider .tps-read-more i' => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a svg, .tp-blog-slider .tps-read-more svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'custom'],
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
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a i, .tp-blog-slider .tps-read-more i' => 'height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a svg, .tp-blog-slider .tps-read-more svg' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => esc_html__('Icon Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a i, .tp-blog-slider .tps-read-more i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a svg, .tp-blog-slider .tps-read-more svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => esc_html__('Icon Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a:hover i, .tp-blog-slider .tps-read-more:hover i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a:hover svg, .tp-blog-slider .tps-read-more:hover svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'button_icon_bg_color',
            [
                'label' => esc_html__('Icon BG Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a i, .tp-blog-slider .tps-read-more i' => 'background: {{VALUE}} !important;',
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a svg, .tp-blog-slider .tps-read-more svg' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_icon_bg_color_hover',
            [
                'label' => esc_html__('Icon BG Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a:hover i, .tp-blog-slider .tps-read-more:hover i' => 'background: {{VALUE}} !important;',
                    '{{WRAPPER}} .tp-blog-slider .blog-btn.themephi-button a:hover svg, .tp-blog-slider .tps-read-more:hover svg' => 'background: {{VALUE}} !important;',
                ],
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render rsgallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings              = $this->get_settings_for_display();
        $col_xxl         = $settings['col_xxl'];
        $col_xxl         = !empty($col_xxl) ? $col_xxl : 3;
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

        $item_gap = $settings['item_gap_custom']['size'];
        $item_gap = !empty($item_gap) ? $item_gap : '30';
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

?>
        <?php $gray_scale = $settings['show_graycale']; ?>

        <div class="tpaddon-unique-slider gray_<?php echo $settings['show_graycale']; ?> themephi-addon-slider tp-blog-slider tp-blog tp-blog-style<?php echo esc_attr($settings['blog_slider_style']); ?> slider-style-<?php echo esc_attr($settings['blog_slider_style']); ?> ">

            <?php if ($settings['slider_nav'] == 'true') { ?>
                <!-- navigation -->
                <div class="tp-blog-navigation-wrapp blog-navigation-<?php echo esc_attr($settings['blog_slider_style']); ?>">
                    <span class="tp-blog-nav tp-blog-nav-prev "><i class="tp-arrow-left"></i></span>
                    <span class="tp-blog-nav tp-blog-nav-next "><i class="tp-arrow-right"></i></span>
                </div>
            <?php } ?>

            <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rt_widget_sliders swiper tpaddon-slider-<?php echo esc_attr($unique); ?>">
                <div class="swiper-wrapper">
                    <?php if ('1' == $settings['blog_slider_style']) {
                        include plugin_dir_path(__FILE__) . "/style1.php";
                    }

                    if ('2' == $settings['blog_slider_style']) {
                        include plugin_dir_path(__FILE__) . "/style2.php";
                    }

                    if ('3' == $settings['blog_slider_style']) {
                        include plugin_dir_path(__FILE__) . "/style3.php";
                    }

                    if ('4' == $settings['blog_slider_style']) {
                        include plugin_dir_path(__FILE__) . "/style4.php";
                    }

                    if ('5' == $settings['blog_slider_style']) {
                        include plugin_dir_path(__FILE__) . "/style5.php";
                    }

                    ?>
                </div>
            </div>

            <?php if ($settings['slider_dots'] == 'true') { ?>
                <div class="tp-blog-pagination"></div>
            <?php } ?>

        </div>

        <script type="text/javascript">
            jQuery(document).ready(function() {

                var swiper = new Swiper(".tpaddon-slider-<?php echo esc_attr($unique); ?>", {
                    slidesPerView: <?php echo $slidesToShow; ?>,
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,

                    loop: <?php echo esc_attr($infinite); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                    spaceBetween: <?php echo esc_attr($item_gap); ?>,
                    pagination: {
                        el: ".tp-blog-pagination",
                        clickable: true,
                    },
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    navigation: {
                        nextEl: ".tp-blog-nav-next",
                        prevEl: ".tp-blog-nav-prev",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: <?php echo esc_attr($col_xs); ?>,

                        },
                        <?php
                        echo (!empty($col_xs)) ?  '320: { slidesPerView: ' . $col_xs . ' },' : '';
                        echo (!empty($col_sm)) ?  '576: { slidesPerView: ' . $col_sm . ' },' : '';
                        echo (!empty($col_md)) ?  '768: { slidesPerView: ' . $col_md . ' },' : '';
                        echo (!empty($col_lg)) ?  '992: { slidesPerView: ' . $col_lg . ' },' : '';
                        echo (!empty($col_xl)) ?  '1199: { slidesPerView: ' . $col_xl . ' },' : '';
                        ?>
                        1399: {
                            slidesPerView: <?php echo esc_attr($col_xxl); ?>,
                            spaceBetween: <?php echo esc_attr($item_gap); ?>
                        }
                    }
                });

            });
        </script>
<?php
    }
    public function getCategories()
    {
        $cat_list = [];
        if (post_type_exists('post')) {
            $terms = get_terms(array(
                'taxonomy'    => 'category',
                'hide_empty'  => true
            ));

            foreach ($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }
        return $cat_list;
    }
} ?>