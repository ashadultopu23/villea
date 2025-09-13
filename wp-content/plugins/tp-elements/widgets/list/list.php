<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_List_Widget extends \Elementor\Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tp-list';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('TP List', 'tp-elements');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-list';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tp-elements'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['tp-elements'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {



        // ======================Content================================//

        $this->start_controls_section(
            'list_section_genaral',
            [
                'label' => esc_html__('List', 'tp-elements')
            ]
        );

        $this->add_responsive_control(
            'finview_heading_content_align',
            [
                'label'         => esc_html__('Heading Text Align', 'tp-elements'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'start'         => [
                        'title' => esc_html__('Left', 'tp-elements'),
                        'icon'     => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'tp-elements'),
                        'icon'     => 'eicon-v-align-middle',
                    ],
                    'end'     => [
                        'title' => esc_html__('Right', 'tp-elements'),
                        'icon'     => 'eicon-v-align-bottom',
                    ],
                ],
                'default'         => 'left',
                'selectors'     => [
                    '{{WRAPPER}} .cus_content ' => 'align-items: {{VALUE}} !important;',
                ],

            ]
        );

        $this->add_responsive_control(
            'column_style',
            [
                'label' => esc_html__('Columns', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('1 Column', 'tp-elements'),
                    '2' => esc_html__('2 Columns', 'tp-elements'),
                    '3' => esc_html__('3 Columns', 'tp-elements'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .responsive_style' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );


        $this->add_control(
            'list_content_style',
            [
                'label'   => esc_html__('Content Style', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('ul', 'tp-elements'),
                    'style_two' => esc_html__('ol', 'tp-elements'),
                    'style_three' => esc_html__('Icon List', 'tp-elements'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->add_control(
            'list_style_type',
            [
                'label'   => esc_html__('List Style Type', 'tp-elements'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'disc' => esc_html__('Disc', 'tp-elements'),
                    'circle' => esc_html__('Circle', 'tp-elements'),
                    'square' => esc_html__('Square', 'tp-elements'),
                    'none' => esc_html__('None', 'tp-elements'),
                ],
                'default' => 'disc',
                'condition' => [
                    'list_content_style' => 'style_one',
                ]
            ]
        );
        $this->add_control(
            'list_style_type_ol',
            [
                'label'   => esc_html__('List Style Type', 'tp-elements'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'decimal' => esc_html__('Decimal', 'tp-elements'),
                    'lower-roman' => esc_html__('Lower Roman', 'tp-elements'),
                    'upper-roman' => esc_html__('Upper Roman', 'tp-elements'),
                    'lower-alpha' => esc_html__('Lower Alpha', 'tp-elements'),
                    'upper-alpha' => esc_html__('Upper Alpha', 'tp-elements'),
                    'none' => esc_html__('None', 'tp-elements'),
                ],
                'default' => 'decimal',
                'condition' => [
                    'list_content_style' => 'style_two',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_style_position',
            [
                'label'     => esc_html__('List Style Position', 'tp-elements'),
                'type'      => Controls_Manager::SELECT,
                'options' => [
                    'outside' => esc_html__('Outside', 'tp-elements'),
                    'inside' => esc_html__('Inside', 'tp-elements'),
                    'inherit' => esc_html__('Inherit', 'tp-elements'),
                ],
                'default' => 'outside',
                'condition' => [
                    'list_content_style' => ['style_one', 'style_two'],
                ]
            ]
        );

        $this->add_responsive_control(
            'list_padding_left',
            [
                'label'   => esc_html__('Padding Left', 'tp-elements'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list_area ul, {{WRAPPER}} .list_area ol' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iconspace_between_widgets',
            [
                'label'     => esc_html__('Icon Gap', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} ul li .cus_content' => 'gap: {{SIZE}}{{UNIT}} !important',
                ],
                'condition' => [
                    'list_content_style' => 'style_three',
                ]
            ]
        );


        $this->add_responsive_control(
            'space_between_widgets',
            [
                'label'     => esc_html__('List Gap', 'tp-elements'),
                'type'      => Controls_Manager::GAPS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} ul,ol' => 'gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}}!important;',
                ],
            ]
        );

        $this->add_control(
            'list_heading',
            [
                'label' => esc_html__('List Title', 'sportsmi-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('List Title Here', 'sportsmi-core'),
                'placeholder' => esc_html__('Type your list title here', 'sportsmi-core'),
                'label_block' => true,
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title',
            [
                'label' => esc_html__('List Title', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Default title', 'tp-elements'),
                'placeholder' => esc_html__('Type your title here', 'tp-elements'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label' => esc_html__('Icon', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-regular fa-circle-check',
                    'library' => 'solid',
                ],
            ]
        );
        // Link
        $repeater->add_control(
            'list_link',
            [
                'label' => esc_html__('Link', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'bankio-core'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'list_repeater',
            [
                'label' => esc_html__('List Content', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__('List Item #1', 'tp-elements'),
                    ],
                    [
                        'list_title' => esc_html__('List Item #2', 'tp-elements'),
                    ],
                    [
                        'list_title' => esc_html__('List Item #3', 'tp-elements'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',

            ]
        );

        $this->end_controls_section();




        // =======================Style=================================//


        // List area
        $this->start_controls_section(
            'list_card_style',
            [
                'label' => esc_html__('List Area', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],

                'selectors'  => [
                    '{{WRAPPER}} .list_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .list_area',
            ]
        );

        $this->end_controls_section();

        // List Icon
        $this->start_controls_section(
            'list_icon_style',
            [
                'label' => esc_html__('Icon', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'list_content_style' => 'style_three',
                ]
            ]
        );

        $this->add_control(
            'card_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list_area ul li i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .list_area ul li svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'counter_icon_custom_dimensionsss1',
            [
                'label' => esc_html__('Icon Size', 'golftio-core'),
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
                    '{{WRAPPER}} .list_area ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .list_area ul li svg' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        // List Content
        $this->start_controls_section(
            'list_title_style',
            [
                'label' => esc_html__('List Content', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'list_title_typ',
                'selector' => '{{WRAPPER}} .cus_content, {{WRAPPER}} .cus_content a',
            ]
        );


        $this->add_control(
            'selected_class',
            [
                'label'   => esc_html__('Auto Responsive font size', 'tp-elements'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'fs_3xl' => esc_html__('32px', 'tp-elements'),
                    'fs_2xl' => esc_html__('24px', 'tp-elements'),
                    'fs_xl' => esc_html__('20px', 'tp-elements'),
                    'fs_lg' => esc_html__('18px', 'tp-elements'),
                    'fs_base' => esc_html__('16px', 'tp-elements'),
                    'fs_sm' => esc_html__('14px', 'tp-elements'),
                    'fs_xs' => esc_html__('12px', 'tp-elements'),
                ],
                'default' => 'fs_base',
            ]
        );


        $this->add_control(
            'list_title_color',
            [
                'label'     => esc_html__('Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_content, {{WRAPPER}} .cus_content a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_marker',
            [
                'label'   => esc_html__('List Marker Size', 'tp-elements'),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list_area ul, {{WRAPPER}} ul li::marker' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'title_style_typ',
                'selector' => '{{WRAPPER}} .cus_title',

            ]
        );

        $this->add_control(
            'title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <style>
            .list_area ul,
            .list_area ol {
                display: flex;
                flex-direction: column;
                padding-left: 0px;
                margin: 0;
            }



            .list-columns-1 {
                grid-template-columns: 1fr;
            }

            .list-columns-2 {
                grid-template-columns: repeat(2, 1fr);
            }

            .list-columns-3 {
                grid-template-columns: repeat(3, 1fr);
            }
        </style>

        <?php $additional_class = '';
        switch ($settings['selected_class']) {
            case 'fs_xs':
                $additional_class = 'fs-xs';
                break;
            case 'fs_sm':
                $additional_class = 'fs-sm';
                break;
            case 'fs_base':
                $additional_class = 'fs-base';
                break;
            case 'fs_lg':
                $additional_class = 'fs-lg';
                break;
            case 'fs_xl':
                $additional_class = 'fs-xl';
                break;
            case 'fs_2xl':
                $additional_class = 'fs-2xl';
                break;
            case 'fs_3xl':
                $additional_class = 'fs-3xl';
                break;
            default:
                $additional_class = 'fs_base'; // Fallback class
        }
        ?>


        <div class="list_area">
            <?php if (!empty($settings['list_heading'])) : ?>
                <p class="cus_title"><?php echo wp_kses($settings['list_heading'], wp_kses_allowed_html('post')); ?></p>
            <?php endif; ?>

            <?php if ($settings['list_content_style'] == 'style_one') : ?>
                <?php $list_style_type = $settings['list_style_type'];
                $list_style_position = $settings['list_style_position'];
                ?>
                <ul style="list-style-type: <?php echo esc_attr($list_style_type); ?>; list-style-position: <?php echo esc_attr($list_style_position); ?>;" class="responsive_style d-grid gap-2 ">
                    <?php foreach ($settings['list_repeater'] as $item) : ?>
                        <li class="cus_content m-0 <?php echo esc_attr($additional_class); ?>">
                            <?php if (!empty($item['list_link']['url'])) :   ?>
                                <a href="<?php echo esc_url($item['list_link']['url']); ?>" class="<?php echo esc_attr($additional_class); ?>">
                                <?php endif ?>
                                <?php echo wp_kses($item['list_title'], wp_kses_allowed_html('post')); ?>
                                <?php if (!empty($item['list_link']['url'])) :   ?>
                                </a>
                            <?php endif ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif ($settings['list_content_style'] == 'style_two') : ?>
                <?php $list_style_type_ol = $settings['list_style_type_ol'];
                $list_style_position = $settings['list_style_position']; ?>
                <ol style="list-style-type: <?php echo esc_attr($list_style_type_ol); ?>; list-style-position: <?php echo esc_attr($list_style_position); ?>;" class="responsive_style d-grid gap-2">
                    <?php foreach ($settings['list_repeater'] as $item) : ?>
                        <li class="cus_content m-0 <?php echo esc_attr($additional_class); ?>">
                            <?php if (!empty($item['list_link']['url'])) :   ?>
                                <a href="<?php echo esc_url($item['list_link']['url']); ?>" class="<?php echo esc_attr($additional_class); ?>">
                                <?php endif ?>
                                <?php echo wp_kses($item['list_title'], wp_kses_allowed_html('post')); ?>
                                <?php if (!empty($item['list_link']['url'])) :   ?>
                                </a>
                            <?php endif ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php elseif ($settings['list_content_style'] == 'style_three') : ?>
                <ul class="list-unstyled responsive_style d-grid gap-2  ?>">
                    <?php foreach ($settings['list_repeater'] as $item) : ?>
                        <li class="m-0">
                            <?php if (!empty($item['list_link']['url'])) : ?>
                                <a href="<?php echo esc_url($item['list_link']['url']); ?>" class="<?php echo esc_attr($additional_class); ?>">
                                <?php endif; ?>
                                <span class="cus_content <?php echo esc_attr($additional_class); ?> d-flex align-items-center gap-2">
                                    <?php if (!empty($item['list_icon'])) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon($item['list_icon'], ['aria-hidden' => 'true']); ?>
                                    <?php endif; ?>
                                    <?php echo wp_kses($item['list_title'], wp_kses_allowed_html('post')); ?>
                                </span>
                                <?php if (!empty($item['list_link']['url'])) : ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endif; ?>

        </div>

<?php
    }
}
