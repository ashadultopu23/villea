<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Heading_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tp_heading';
    }        

    public function get_title() {
        return esc_html__( 'TP Heading', 'tp-elements' );
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
                'label' => esc_html__( 'Heading Info', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'         => esc_html__('Heading', 'tp-elements'),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => esc_html__( 'This is heading element', 'tp-elements' ),
                'placeholder'   => esc_html__( 'Enter Your Heading', 'tp-elements' )
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__('HTML Tag', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'h1'        => esc_html__( 'H1', 'tp-elements' ),
                    'h2'        => esc_html__( 'H2', 'tp-elements' ),
                    'h3'        => esc_html__( 'H3', 'tp-elements' ),
                    'h4'        => esc_html__( 'H4', 'tp-elements' ),
                    'h5'        => esc_html__( 'H5', 'tp-elements' ),
                    'h6'        => esc_html__( 'H6', 'tp-elements' ),
                    'span'      => esc_html__( 'SPAN', 'tp-elements' ),
                ],
                'default'   => 'h2'
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label'     => esc_html__('Alignment', 'tp-elements'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'=> [
                        'title'     => esc_html__('Left', 'tp-elements'),
                        'icon'      => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title'     => esc_html__('Center', 'tp-elements'),
                        'icon'      => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title'     => esc_html__('Right', 'tp-elements'),
                        'icon'      => 'eicon-text-align-right',
                    ]
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tp-heading' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Heading Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__('Heading Typography', 'tp-elements'),
                'selector'  => '{{WRAPPER}} .tp-heading'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Heading Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-heading .tp-heading-content' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'add_gradient_color',
            [
                'label'         => esc_html__('Add Gradient Color', 'tp-elements'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'label_off'     => esc_html__('No', 'tp-elements'),
                'label_on'      => esc_html__('Yes', 'tp-elements')
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'accent_bg_color',
                'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                'fields_options' => [
                    'background' => [
                        'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                    ]
                ],
                'types'     => [ 'gradient' ],
                'selector'  => '{{WRAPPER}} .tp-heading .tp-heading-content.has_gradient_color_text del, {{WRAPPER}} .tp-heading .tp-heading-content.has_gradient_color_text strong, {{WRAPPER}} .tp-heading .tp-heading-content.has_gradient_color_text em',
                'condition' => [
                    'add_gradient_color' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'gradient_style',
            [
                'label'     => esc_html__('Gradient Block Style', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''             => esc_html__('Default', 'tp-elements'),
                    'inline'       => esc_html__('Inline', 'tp-elements'),
                    'inline-block' => esc_html__('Inline Block', 'tp-elements'),
                    'block'        => esc_html__('Block', 'tp-elements'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-heading-content.has_gradient_color_text del, {{WRAPPER}} .tp-heading .tp-heading-content.has_gradient_color_text strong, {{WRAPPER}} .tp-heading .tp-heading-content.has_gradient_color_text em' => 'display: {{VALUE}};'
                ],
                'condition' => [
                    'add_gradient_color' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'title_shadow',
                'label'     => esc_html__('Heading Text Shadow', 'tp-elements'),
                'selector'  => '{{WRAPPER}} .tp-heading .tp-heading-content'
            ]
        );


        $this->add_control(
            'enable_animation',
            [
                'label' => esc_html__( 'Enable Heading Animation', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tp-elements' ),
                'label_off' => esc_html__( 'No', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title_tag          = $settings['title_tag'];
        $heading            = $settings['heading'];
        $add_gradient_color = $settings['add_gradient_color'];
        $enable_animation   = $settings['enable_animation'];

        $content_class = '';
        if ( $add_gradient_color === 'yes' ) {
            $content_class .= ' has_gradient_color_text';
        }

        if (!empty($heading)) {

            ?> 

            <style>
                .tp-heading .tp-heading-content.has_gradient_color_text del, .tp-heading .tp-heading-content.has_gradient_color_text strong, .tp-heading .tp-heading-content.has_gradient_color_text em {
                    background-clip: text;
                    -webkit-background-clip: text;
                    -moz-background-clip: text;
                    text-decoration: none;
                    color: transparent;
                }
				.elementor-widget-tp_heading.elementor-invisible {
					visibility: visible;
				}
                .tp-heading .tp-heading-content .letter {
                    display: inline-block;
                    opacity: 0;
                    -webkit-transform: translateY(120%);
                    -ms-transform: translateY(120%);
                    transform: translateY(120%);
                    animation: fadeIn 0.35s forwards, fadeInLetter 0.7s ease forwards;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                    }
                    to {
                        opacity: 1;
                    }
                }

                @keyframes fadeInLetter {
                    from {
                        -webkit-transform: translateY(120%);
                        -ms-transform: translateY(120%);
                        transform: translateY(120%);
                    }
                    to {
                        -webkit-transform: translateY(0);
                        -ms-transform: translateY(0);
                        transform: translateY(0);
                    }
                }
            </style>

            <div class="tp-heading-widget" data-settings='{"_animation":"<?php echo esc_attr($enable_animation === 'yes' ? 'tp_heading_animation' : ''); ?>"}'>
                <<?php echo esc_html($title_tag); ?> class="tp-heading">
                    <span class="tp-heading-content <?php echo esc_attr($content_class); ?> ">
                        <?php echo wp_kses( $heading, array(
                                'a' => array(
                                    'href' => array(),
                                    'title' => array()
                                ),
                                'br' => array(),
                                'em' => array(),
                                'strong' => array(),
                                'del' => array(),
                            )
                        ); 
                        ?>
                    </span>
                </<?php echo esc_html($title_tag); ?>>
            </div>

            <?php
        }
        ?>

        <script>

            function animateHeading($scope) {
                if ($scope.data('settings') && $scope.data('settings')._animation === 'tp_heading_animation') {
                    let content = $scope.find('.tp-heading-content');
                    content.html(content.html().replace(/(<\/?.*?>|\s+)([^\s<>]+)/g, '$1<span class="word">$2</span>'));
                    content.find('.word').each(function () {
                        let wordHtml = jQuery(this).html().replace(/(\w|<em>|<\/em>|<strong>|<\/strong>|<del>|<\/del>)/g, '<span class="letter">$&</span>');
                        jQuery(this).html(wordHtml);
                    });
                    content.find('.letter').each(function (index) {
                        jQuery(this).css('animation-delay', (index / 50) + 's');
                    });
                }
            }

            jQuery(document).ready(function($) {
                $('.tp-heading-widget').each(function() {
                    animateHeading($(this));
                });

            });
        </script>

        <?php

    }

}
?>
