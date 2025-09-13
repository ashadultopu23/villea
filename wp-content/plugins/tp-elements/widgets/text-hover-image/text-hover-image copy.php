<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

defined('ABSPATH') || die();

class Themephi_Elementor_Text_Hover_Image_Widget extends \Elementor\Widget_Base {


    public function get_name() {
        return 'tp-text-hover-image';
    }

    public function get_title() {
        return __('TP Text Hover Image', 'tp-elements');
    }

    public function get_icon() {
        return 'glyph-icon flaticon-multimedia';
    }

    public function get_categories() {
        return ['pielements_category'];
    }

    public function get_keywords() {
        return ['text-hover-img'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'tp-elements'),
            ]
        );

        $this->add_control(
            'before_hover_text',
            [
                'label' => esc_html__('Before Hover Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('Enter before text', 'tp-elements'),
                'default' => esc_html__('I\'m ', 'tp-elements'),
            ]
        );

        $this->add_control(
            'hover_text',
            [
                'label' => esc_html__('Hover Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('Enter hover text', 'tp-elements'),
                'default' => esc_html__('Mariya', 'tp-elements'),
            ]
        );

        $this->add_control(
            'after_hover_text',
            [
                'label' => esc_html__('After Hover Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('Enter after text', 'tp-elements'),
                'default' => esc_html__('the awarded dancer', 'tp-elements'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Hover Image', 'tp-elements'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => ['url' => Utils::get_placeholder_image_src()],
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__('HTML Tag', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'tp-elements'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'tp-elements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tp-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tp-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tp-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'tp-elements'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => ['{{WRAPPER}}' => 'text-align: {{VALUE}};'],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Text Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-title' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-title:hover' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .tp-text-hover-image-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .tp-text-hover-image-title',
            ]
        );

        $this->add_control(
            'hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-text' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hover_typography',
                'selector' => '{{WRAPPER}} .tp-text-hover-image-text',
            ]
        );

        $this->end_controls_section();

        // Image Style Tab
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__('Image Style', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Width', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 1000],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-img' => 'width: {{SIZE}}{{UNIT}};'],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Height', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 1000],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-img' => 'height: {{SIZE}}{{UNIT}};'],
            ]
        );

        $this->add_responsive_control(
            'image_position_top',
            [
                'label' => esc_html__('Position Top', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => -1000, 'max' => 1000],
                    '%' => ['min' => -100, 'max' => 100],
                ],
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-img' => 'transform: translateY({{SIZE}}{{UNIT}});'],
            ]
        );

        $this->add_responsive_control(
            'image_position_left',
            [
                'label' => esc_html__('Position Left', 'tp-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => -1000, 'max' => 1000],
                    '%' => ['min' => -100, 'max' => 100],
                ],
                'selectors' => ['{{WRAPPER}} .tp-text-hover-image-img' => 'transform: translateX({{SIZE}}{{UNIT}});'],
            ]
        );

        $this->end_controls_section();

    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['before_hover_text']) && empty($settings['hover_text']) && empty($settings['after_hover_text'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'tp-text-hover-image-wrapper');
        $this->add_render_attribute('title', 'class', 'tp-text-hover-image-title');
        $this->add_render_attribute('hover_text', [
            'class' => 'tp-text-hover-image-text',
            'data-widget-id' => $this->get_id()
        ]);
        $this->add_render_attribute('hover_img', 'class', 'tp-text-hover-image-img');

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('url', $settings['link']);
        }
        ?>

        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <?php if (!empty($settings['link']['url'])) : ?>
                <a <?php $this->print_render_attribute_string('url'); ?>>
            <?php endif; ?>

            <<?php echo esc_attr($settings['html_tag']); ?> <?php $this->print_render_attribute_string('title'); ?>>
                <?php if (!empty($settings['before_hover_text'])) : ?>
                    <?php echo esc_html($settings['before_hover_text']); ?>
                <?php endif; ?>

                <span <?php $this->print_render_attribute_string('hover_text'); ?>>
                    <?php if (!empty($settings['hover_text'])) : ?>
                        <?php echo esc_html($settings['hover_text']); ?>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['image']['url'])) : ?>
                        <span <?php $this->print_render_attribute_string('hover_img'); ?> 
                            style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>);">
                        </span>
                    <?php endif; ?>
                </span>

                <?php if (!empty($settings['after_hover_text'])) : ?>
                    <?php echo esc_html($settings['after_hover_text']); ?>
                <?php endif; ?>
            </<?php echo esc_attr($settings['html_tag']); ?>>

            <?php if (!empty($settings['link']['url'])) : ?>
                </a>
            <?php endif; ?>
        </div>

        <style>
        .tp-text-hover-image-wrapper {
            display: inline-block;
            position: relative;
        }

        .tp-text-hover-image-title {
            display: inline-block;
            position: relative;
            margin: 0;
            transition: color 0.3s ease;
        }

        .tp-text-hover-image-text {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tp-text-hover-image-img {
            position: fixed;
            width: <?php echo isset($settings['image_width']['size']) ? esc_attr($settings['image_width']['size']) . esc_attr($settings['image_width']['unit']) : '300px'; ?>;
            height: <?php echo isset($settings['image_height']['size']) ? esc_attr($settings['image_height']['size']) . esc_attr($settings['image_height']['unit']) : '400px'; ?>;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0;
            pointer-events: none;
            z-index: 9999;
            transition: opacity 0.3s ease;
            transform: translate(-50px, -50%) rotate(15deg);
            will-change: transform;
        }

        /* Elementor editor specific styles */
        .elementor-editor-active .tp-text-hover-image-img {
            position: absolute !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            display: none; /* Initially hidden */
        }
        
        .elementor-editor-active .tp-text-hover-image-text:hover .tp-text-hover-image-img {
            display: block;
            transform: translate(50px, 50px);
        }
        </style>

        <script>
        (function($) {
            function initHoverEffect() {
                var hoverElements = $('.tp-text-hover-image-text[data-widget-id="<?php echo esc_js($this->get_id()); ?>"]');
                var distanceFromCursor = 50;
                
                hoverElements.each(function() {
                    var $hoverText = $(this);
                    var $hoverImg = $hoverText.find('.tp-text-hover-image-img');
                    
                    if (!$hoverImg.length) return;
                    
                    // For Elementor editor
                    if ($('body').hasClass('elementor-editor-active')) {
                        $hoverText.on('mousemove', function(e) {
                            var offset = $hoverText.offset();
                            var x = e.pageX - offset.left;
                            var y = e.pageY - offset.top;
                            
                            $hoverImg.css({
                                'left': x + distanceFromCursor,
                                'top': y + distanceFromCursor,
                                'display': 'block'
                            });
                        }).on('mouseleave', function() {
                            $hoverImg.css('display', 'none');
                        });
                    } 
                    // For frontend
                    else {
                        $hoverText.on('mousemove', function(e) {
                            $hoverImg.css({
                                'left': e.clientX + distanceFromCursor,
                                'top': e.clientY + distanceFromCursor,
                                'opacity': '1'
                            });
                        }).on('mouseleave', function() {
                            $hoverImg.css('opacity', '0');
                        });
                    }
                });
            }
            
            // Initialize on load and when Elementor preview refreshes
            $(window).on('load', initHoverEffect);
            
            // For Elementor editor live preview
            if (typeof elementor !== 'undefined' && elementor.on) {
                elementor.on('preview:loaded', initHoverEffect);
            }
        })(jQuery);
        </script>
        <?php
    }
}