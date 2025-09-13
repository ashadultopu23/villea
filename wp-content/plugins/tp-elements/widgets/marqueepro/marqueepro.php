<?php
/**
 * Marquee widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Pro_Marquee_Pro_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *    
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'tp-marqueepro';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'TP Marquee Pro', 'tp-elements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Marquee Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Marquee Image', 'tp-elements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Marquee Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Type Text ', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'tp-elements'),
                'type' => Controls_Manager::URL,                
            ]
        ); 

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
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
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_animation_style',
            [
                'label' => esc_html__( 'Animation ', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animate',
            [
                'label' => esc_html__( 'Enable Animation', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tp-elements' ),
                'label_off' => esc_html__( 'No', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'text_count',
            [
                'label' => esc_html__( 'Duplicate times', 'tp-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'condition' => [
                    'animate' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'animation_direction',
            [
                'label'     => esc_html__('Animation Direction', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'left'      => esc_html__( 'Left', 'tp-elements' ),
                    'right'     => esc_html__( 'Right', 'tp-elements' )
                ],
                'default'   => 'left',
                'condition' => [
                    'animate' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'animate_duration',
            [
                'label'     => esc_html__( 'Animation Duration, s', 'tp-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'     => [
                    'px'        => [
                        'min' => 0.1,
                        'max'       => 100,
                        'step'      => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-animated' => 'animation-duration: {{SIZE}}s',
                ],
                'condition' => [
                    'animate' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => esc_html__( 'Text Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .tp-marquee-text',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Text Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Text Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Text Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_control(
            'effect',
            [
                'label'     => esc_html__( 'Text Effect', 'tp-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''   => esc_html__( 'Default', 'tp-elements' ),
                    'stroke'    => esc_html__( 'Stroke', 'tp-elements' ),
                    'fill'      => esc_html__( 'Fill', 'tp-elements' ),
                    'partial_gradient'      => esc_html__( 'Partial Gradient', 'tp-elements' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'accent_bg_color',
                'label'     => esc_html__( 'Tex Gradient Color', 'tp-elements' ),
                'fields_options' => [
                    'background' => [
                        'label'     => esc_html__( 'Text Gradient Color', 'tp-elements' ),
                        '' => esc_html__( 'Your Text Should be <em>Your Text</em> or <strong>Your Text</strong> or <del>Your Text</del>', 'tp-elements' ),
                    ]
                ],
                'types'     => [ 'gradient' ],
                'selector'  => '{{WRAPPER}} .tp-marquee-text del, {{WRAPPER}} .tp-marquee-text strong, {{WRAPPER}} .tp-marquee-text em',
                'condition' => [
                    'effect' => 'partial_gradient'
                ]
            ]
        );


        $this->add_control(
            'text_color_stroke',
            [
                'label'     => esc_html__('Text Stroke Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-text' => '-webkit-text-stroke: 1px {{VALUE}}; text-stroke: 1px {{VALUE}};'
                ],
                'condition' => [
                    'effect'    => [ 'stroke', 'fill' ]
                ]
            ]
        );

        $this->add_control(
            'text_stroke_width',
            [
                'label'     => esc_html__('Text Stroke Width', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'         => [
                        'min'       => 0,
                        'max'       => 20,
                        'step'      => 1
                    ]
                ],
                'default'   => [
                    'unit'      => 'px',
                    'size'      => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'effect'    => [ 'stroke', 'fill' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'text_background',
                'label'     => esc_html__( 'Text Background', 'tp-elements' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .tp-marquee-text',
                'condition' => [
                    'effect'    => 'fill'
                ]
            ]
        );

        $this->add_control(
            'text_opacity',
            [
                'label'     => esc_html__('Text Opacity', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    '%'         => [
                        'min'       => 0,
                        'max'       => 1,
                        'step'      => .01
                    ]
                ],
                'default'   => [
                    'unit'      => '%',
                    'size'      => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-text' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_imagge_style',
            [
                'label' => esc_html__( 'Image Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Width', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],            
            ]
        );
        
        $this->add_control(
            'image_effect',
            [
                'label'     => esc_html__( 'Enable Image Effect ?', 'tp-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'no',
                'options'   => [
                    'yes'   => esc_html__( 'Yes', 'tp-elements' ),
                    'no'      => esc_html__( 'No', 'tp-elements' )
                ],
            ]
        );
        
        $this->add_control(
            'image_blur_effect',
            [
                'label' => esc_html__( 'Blur', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-image img' => 'filter: blur({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'image_effect' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_effect',
                'selector' => '{{WRAPPER}} .tp-marquee-image img',
                'condition' => [
                    'image_effect' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();
        
        
        $this->start_controls_section(
            '_section_wrapper_style',
            [
                'label' => esc_html__( 'Item Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_wrapper_bg',
            [
                'label' => esc_html__( 'Item Background ', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-content' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_wrapper_padding',
            [
                'label' => esc_html__( 'Item Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->add_responsive_control(
            'item_wrapper_margin',
            [
                'label' => esc_html__( 'Item Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-marquee-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( empty($settings['logo_list'] ) ) {
            return;
        }

        $effect              = $settings['effect'];
        $animate             = $settings['animate'];
        $animation_direction = $settings['animation_direction'];

        $wrapper_classes = 'tp-marqueepro-wrapper ' . ($animate === 'yes' ? 'animate animated tp-marquee-animated animation-direction-' . $animation_direction : '');
        $block_classes  = 'tp-marqueepro-wrapper-content-text ' . ( !empty($effect) ? ' special-text-effect-' . esc_attr($effect) : '' );

        $text_count          = (!empty($settings['text_count'] && $animate === 'yes') ? $settings['text_count'] : 1);

        ?>

        <style>

            .tp-marquee-text, .tp-marquee-text del, .tp-marquee-text strong, .tp-marquee-text em {
                background-clip: text;
                -webkit-background-clip: text;
                -moz-background-clip: text;
                text-decoration: none;
                color: transparent;
            }
            .tp-marqueepro {
                white-space: nowrap;
            }
            .tp-marquee-image img {
                max-width: 100%;
            }
            .animation-direction-left {
                animation: text_move_left 5s linear infinite;
            }
            .animation-direction-right {
                animation: text_move_right 5s linear infinite;
            }

            @keyframes text_move_left {
                from {
                    -webkit-transform: translateX(0%);
                    -ms-transform: translateX(0%);
                    transform: translateX(0%);
                }
                to {
                    -webkit-transform: translateX(-100%);
                    -ms-transform: translateX(-100%);
                    transform: translateX(-100%);
                }
            }
            @keyframes text_move_right {
                from {
                    -webkit-transform: translateX(0%);
                    -ms-transform: translateX(0%);
                    transform: translateX(0%);
                }
                to {
                    -webkit-transform: translateX(100%);
                    -ms-transform: translateX(100%);
                    transform: translateX(100%);
                }
            }


        </style>

        <div class="tp-marqueepro <?php echo esc_attr( $wrapper_classes ); ?>">
            <?php
            for ($i = 0; $i < $text_count; $i++) {  
                foreach ( $settings['logo_list'] as $index => $item ) :
                $IMG_ID = $item['image']['id']; 
                $size = $settings['thumbnail_size'];
                if(!empty($IMG_ID)):
                    $image = wp_get_attachment_image_src($IMG_ID, $size )[0];
                endif;
                $title = !empty($item['name']) ? $item['name'] : '';
                $link = !empty($item['link']['url']) ? $item['link']['url'] : '';
                $target = !empty($item['link']['is_external']) ? 'target=_blank' : '';  
                ?>
                <span class="tp-marquee-content d-inline-block <?php echo esc_attr( $block_classes ); ?>">

                    <span class="tp-marquee-text"><?php echo wp_kses_post($title);?></span>
                    <?php if (!empty($image) ) { ?>
                    <span class="tp-marquee-image">
                        <a href="<?php echo esc_url($link);?>">
                            <img src="<?php echo esc_attr($image);?>" alt="<?php echo esc_attr__( 'image', 'tp-elements' ); ?>">
                        </a>
                    </span>
                    <?php } ?>
                    
                </span>
            <?php endforeach; 
            }
            ?>
        </div>
    <?php
    }
}