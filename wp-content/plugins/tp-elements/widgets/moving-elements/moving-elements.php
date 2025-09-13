<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Moving_Elements_Widget extends Widget_Base {

    public function get_name() {
        return 'tp_moving_elements';
    }        

    public function get_title() {
        return esc_html__( 'TP Moving Elements', 'tp-elements' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return [ 'pielements_category' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Moving Elements Settings', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter Title', 'tp-elements' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'tp-elements' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '',
                    'is_external' => true,
                ],
                'placeholder' => esc_html__( 'http://your-link.com', 'tp-elements' ),
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'item_bg',
                'types'          => [ 'classic', 'gradient' ],
                'selector'       => '{{WRAPPER}} {{CURRENT_ITEM}} .moving-item-inner',
            ]
        );

        $this->add_control(
            'moving_list',
            [
                'label'         => esc_html__( 'Moving List Items', 'tp-elements' ),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'title_field'   => '{{{title}}}',
                'prevent_empty' => true,
            ]
        );

        $this->end_controls_section();

        // ----------------------------------------- //
        // ---------- Moving List Settings ---------- //
        // ----------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Moving List Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'items_spacing',
            [
                'label' => esc_html__( 'Items Spacing', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 100
                    ]
                ],
                'default'   => [
                    'unit'      => 'px',
                    'size'      => 20
                ],
                'selectors' => [
                    '{{WRAPPER}} .moving-list' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .moving-list .moving-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2);'
                ]
            ]
        );

        $this->add_responsive_control(
            'items_width',
            [
                'label' => esc_html__( 'Items Width', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 1000
                    ],
                    'em'        => [
                        'min'       => 0,
                        'max'       => 40
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .moving-list .moving-item' => 'width: {{SIZE}}{{UNIT}};'                
                ]
            ]
        );

        $this->add_responsive_control(
            'items_padding',
            [
                'label' => esc_html__( 'Items Height', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range'     => [
                    'px'        => [
                        'min'       => 0,
                        'max'       => 1000
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .moving-list .moving-item-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};'                
                ]
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'         => esc_html__('Items Border Radius', 'tp-elements'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .moving-list .moving-item .moving-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'overflow',
            [
                'label' => esc_html__( 'Items Overflow', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'hidden' => esc_html__( 'Hidden', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-moving-list-widget' => 'overflow: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Color Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_color_settings',
            [
                'label' => esc_html__('Typography & Color Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__('Title Typography', 'tp-elements'),
                'selector'  => '{{WRAPPER}} .moving-list .moving-item .moving-item-title'
            ]
        );  

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'items_bg',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__( 'Items Background', 'tp-elements' )
                    ]                    
                ],
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .moving-item .moving-item-inner'
            ]
        );

        $this->start_controls_tabs(
            'title_color_tabs'
        );

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'tab_color_normal',
                [
                    'label' => esc_html__('Normal', 'tp-elements')
                ]
            );

                $this->add_control(
                    'title_color',
                    [
                        'label'     => esc_html__('Title Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .moving-item .moving-item-title' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Text_Stroke::get_type(),
                    [
                        'name' => 'title_stroke',
                        'selector' => '{{WRAPPER}} .moving-item .moving-item-title',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Stroke::get_type(),
                    [
                        'name'      => 'title_stroke',
                        'label'     => esc_html__('Heading Text Stroke', 'tp-elements'),
                        'selector'  => '{{WRAPPER}} .moving-item .moving-item-title'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name'      => 'title_shadow',
                        'label'     => esc_html__('Heading Text Shadow', 'tp-elements'),
                        'selector'  => '{{WRAPPER}} .moving-item .moving-item-title'
                    ]
                );

            $this->end_controls_tab();

            // ------------------------ //
            // ------ Active Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'tab_color_hover',
                [
                    'label' => esc_html__('Hover', 'tp-elements')
                ]
            );

                $this->add_control(
                    'title_color_hover',
                    [
                        'label'     => esc_html__('Title Color', 'tp-elements'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .moving-item a:hover .moving-item-title' => 'color: {{VALUE}};'
                        ]
                    ]
                );
                
                $this->add_group_control(
                    \Elementor\Group_Control_Text_Stroke::get_type(),
                    [
                        'name' => 'title_hover_stroke',
                        'selector' => '{{WRAPPER}} .moving-item a:hover .moving-item-title',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Stroke::get_type(),
                    [
                        'name'      => 'title_hover_stroke',
                        'label'     => esc_html__('Heading Text Stroke', 'tp-elements'),
                        'selector'  => '{{WRAPPER}} .moving-item a:hover .moving-item-title'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name'      => 'title_hover_shadow',
                        'label'     => esc_html__('Heading Text Shadow', 'tp-elements'),
                        'selector'  => '{{WRAPPER}} .moving-item a:hover .moving-item-title'
                    ]
                );


            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $moving_list = $settings['moving_list'];

        ?> 

        <style>
            
        /********** Moving List Elementor Widget **********/
        .tp-moving-list-widget {
        line-height: 0;
        }

        .moving-list {
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-justify-content: flex-start;
        -moz-justify-content: flex-start;
        -ms-justify-content: flex-start;
        justify-content: flex-start;
        -webkit-align-items: flex-end;
        -moz-align-items: flex-end;
        -ms-align-items: flex-end;
        align-items: flex-end;
        margin: 0 -10px;
        }
        .moving-list .moving-item {
        width: 300px;
        margin: 0 10px;
        }
        .moving-list .moving-item .moving-item-inner {
        position: relative;
        overflow: hidden;
        padding-bottom: 100%;
        -webkit-border-radius: 25px;
        border-radius: 25px;
        }
        .moving-list .moving-item .moving-item-link {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        }
        .moving-list .moving-item .moving-item-title {
        position: absolute;
        font-size: 80px;
        font-weight: 600;
        letter-spacing: -0.05em;
        line-height: 0.6em;
        bottom: -0.1em;
        right: 0;
        white-space: nowrap;
        -webkit-transform-origin: right bottom;
        -ms-transform-origin: right bottom;
        transform-origin: right bottom;
        -webkit-transform: rotate(-90deg) translateX(100%);
        -ms-transform: rotate(-90deg) translateX(100%);
        transform: rotate(-90deg) translateX(100%);
        -webkit-transition: color 0.3s;
        transition: color 0.3s;
        }

        </style>

        <div class="tp-moving-list-widget">
            <div class="moving-list">
                <?php if ( !empty( $moving_list ) ) : ?>
                    <?php foreach ( $moving_list as $item ) : ?>
                        <div class="moving-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                            <div class="moving-item-inner">
                                <?php if ( !empty( $item['link']['url'] ) ) : ?>
                                    <a href="<?php echo esc_url( $item['link']['url'] ); ?>"
                                       <?php echo !empty($item['link']['is_external']) ? 'target="_blank"' : ''; ?>
                                       <?php echo !empty($item['link']['nofollow']) ? 'rel="nofollow"' : ''; ?>
                                       class="moving-item-link">
                                <?php endif; ?>
                                    
                                <?php if ( !empty( $item['title'] ) ) : ?>
                                    <span class="moving-item-title"><?php echo esc_html( $item['title'] ); ?></span>
                                <?php endif; ?>

                                <?php if ( !empty( $item['link']['url'] ) ) : ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <script>
            function initMovingList($scope) {
                gsap.defaults({ overwrite: "auto" });
                gsap.registerPlugin(ScrollTrigger);
                gsap.config({ nullTargetWarn: false });
                
                $scope.find('.tp-moving-list-widget').each(function(index) {
                    var $widget = jQuery(this);
                    var $movingList = $widget.find('.moving-list');
                    var widgetWidth = $widget[0].offsetWidth;
                    var listScrollWidth = $movingList[0].scrollWidth;
                    
                    var x, xEnd;
                    if (index % 2 === 0) {
                        x = 2.5;
                        xEnd = (widgetWidth - listScrollWidth) / 3;
                    } else {
                        x = (widgetWidth - listScrollWidth) / 3;
                        xEnd = 2.5;
                    }
                    
                    gsap.fromTo($movingList[0], { x: x }, {
                        x: xEnd,
                        scrollTrigger: {
                            trigger: $widget[0],
                            scrub: 0.5 
                        }
                    });
                });
            }
            jQuery(document).ready(function() {
                initMovingList(jQuery('body'));
            });
        </script>
        <?php
    }
}

