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

class TP_Est_Property_Grid extends Widget_Base
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
        return 'tp-est-property-grid';
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
        return esc_html__('Estatik Property Grid', 'tp-elements');
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
        return 'eicon-posts-grid';
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
        return ['property', 'grid', 'estatik', 'real estate', 'listing'];
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
            'title_word_count',
            [
                'label' => esc_html__('Title Word Count', 'tp-elements'),
                'type' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'link_open',
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
            'property_text_word_limit',
            [
                'label' => esc_html__('Show Content Limit', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('20', 'tp-elements'),
                'separator' => 'before',
                'condition' => [
                    'property_text_show_hide' => 'yes',
                ]
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
            'property_cat_show_hide',
            [
                'label' => esc_html__('Category Show / Hide', 'tp-elements'),
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

        // $this->add_control(
        //     'property_organizer_show_hide',
        //     [
        //         'label' => esc_html__('Organizer Show / Hide', 'tp-elements'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'yes',
        //         'options' => [
        //             'yes' => esc_html__('Yes', 'tp-elements'),
        //             'no' => esc_html__('No', 'tp-elements'),
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'property_meta_show_hide' => ['yes'],
        //         ],
        //     ]
        // );

        $this->add_control(
            'property_fee_show_hide',
            [
                'label' => esc_html__('Fee Show / Hide', 'tp-elements'),
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
                'condition' => [
                    'property_meta_show_hide' => ['yes'],
                ],
            ]
        );

        // $this->add_control(
        //     'property_schedule_show_hide',
        //     [
        //         'label' => esc_html__('Schedule Show / Hide', 'tp-elements'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'yes',
        //         'options' => [
        //             'yes' => esc_html__('Yes', 'tp-elements'),
        //             'no' => esc_html__('No', 'tp-elements'),
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'property_meta_show_hide' => ['yes'],
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'property_start_date_schedule',
        //     [
        //         'label' => esc_html__('Event Start Date Show / Hide', 'tp-elements'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'yes',
        //         'options' => [
        //             'yes' => esc_html__('Yes', 'tp-elements'),
        //             'no' => esc_html__('No', 'tp-elements'),
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'property_meta_show_hide' => ['yes'],
        //             'property_schedule_show_hide' => ['yes'],
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'property_start_time_schedule',
        //     [
        //         'label' => esc_html__('Event Start Time Show / Hide', 'tp-elements'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'yes',
        //         'options' => [
        //             'yes' => esc_html__('Yes', 'tp-elements'),
        //             'no' => esc_html__('No', 'tp-elements'),
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'property_meta_show_hide' => ['yes'],
        //             'property_schedule_show_hide' => ['yes'],
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'property_end_date_schedule',
        //     [
        //         'label' => esc_html__('Event End Date Show / Hide', 'tp-elements'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'no',
        //         'options' => [
        //             'yes' => esc_html__('Yes', 'tp-elements'),
        //             'no' => esc_html__('No', 'tp-elements'),
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'property_meta_show_hide' => ['yes'],
        //             'property_schedule_show_hide' => ['yes'],
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'property_end_time_schedule',
        //     [
        //         'label' => esc_html__('Event End Time Show / Hide', 'tp-elements'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'no',
        //         'options' => [
        //             'yes' => esc_html__('Yes', 'tp-elements'),
        //             'no' => esc_html__('No', 'tp-elements'),
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'property_meta_show_hide' => ['yes'],
        //             'property_schedule_show_hide' => ['yes'],
        //         ],
        //     ]
        // );

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
                'default' => 'View Service',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi-addon-events-list .events-part .events-text .events-btn-part .events-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themephi-addon-events-list .events-part .events-text .events-btn-part .events-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
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
                    // 'orderby'        => 'meta_value',
                    // 'meta_key'       => '_EventStartDate',
                ));
            } else {
                $queried_post = new wp_Query(array(
                    'post_type'      => 'properties',
                    'posts_per_page' => $settings['post_per_page'],
                    'paged'          => $paged,
                    // 'orderby'        => 'meta_value',
                    // 'meta_key'       => '_EventStartDate',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'es_category',
                            'field'    => 'slug', //can be set to ID
                            'terms'    => $cat //if field is ID you can reference by cat/term number
                        ),
                    )
                ));
            }

            // var_dump($queried_post);

            // Render property grid layout
?>

            <div class="property-listing-section property-grid-layout-<?php echo esc_attr($settings['property_layout']); ?>">
                <div class="row g-4">

                    <?php
                    while ($queried_post->have_posts()):
                        $queried_post->the_post();
                        // var_dump($queried_post);
                        $post_id = get_the_ID();

                        $att = get_post_thumbnail_id();
                        $image_src = wp_get_attachment_image_src($att, 'full');
                        if (!empty($image_src)) {
                            $image_src = $image_src[0];
                        }

                        $category = get_the_terms($post_id, 'es_category');
                        $address = get_the_terms($post_id, 'es_property_address');
                        $type = get_the_terms($post_id, 'es_type');
                        $label = get_the_terms($post_id, 'es_label');
                        $parking = get_post_meta($post_id, 'es_property_garage-spaces', false);
                        $area = get_post_meta($post_id, 'es_property_lot_size');
                        // $area = es_the_property_area($post_id);

                        $bedrooms = get_post_meta($post_id, 'es_property_bedrooms');
                        $bathrooms = get_post_meta($post_id, 'es_property_bathrooms', false);

                        // $price = get_post_meta($post_id, 'es_property_price');
                        // $price = es_the_price($post_id);

                        $property_type = get_post_meta($post_id, 'es_property_type', false);
                        $images = get_post_meta($post_id, 'es_property_gallery', false);
                        $videos = get_post_meta($post_id, 'es_property_video', false);

                        $property_rent_type = get_post_meta($post_id, 'es_property_property-rent-type', false);

                        // $currency =  get_post_meta($post_id, 'currency_sign');
                        // var_dump($currency);

                        $currency =  get_post_meta($post_id, 'es_currency_sign');
                        // $currency = get_option('es_currency_sign'); // Usually $ or €
                        var_dump($currency);

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
