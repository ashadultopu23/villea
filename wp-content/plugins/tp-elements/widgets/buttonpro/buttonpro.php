<?php

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class Themephi_ButtonPro_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-button-pro';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TP Button Pro', 'tp-elements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-menu';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'buttonpro' ];
	}
	
	

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'tp-elements' ),
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'     => esc_html__( 'Style', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style1',
				'options'   => [
					'style1' => esc_html__( ' Button Style 1', 'tp-elements' ),
					'style2' => esc_html__( ' Button Style 2', 'tp-elements' ),
					'style3' => esc_html__( ' Button Style 3', 'tp-elements' ),
					'style4' => esc_html__( ' Button Style 4', 'tp-elements' ),
					'style5' => esc_html__( ' Button Style 5', 'tp-elements' ),
					'style6' => esc_html__( ' Button Style 6', 'tp-elements' ),
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Text', 'tp-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Discover More', 'tp-elements' ),
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'       => esc_html__( 'Icon', 'tp-elements' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'btn_icon_position',
			[
				'label'     => esc_html__( 'Icon Position', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'row',
				'options'   => [
					'row'         => esc_html__( 'After', 'tp-elements' ),
					'row-reverse' => esc_html__( 'Before', 'tp-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} .btn-text-flip' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'btn_style' => 'style3',
				],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'   => esc_html__( 'Link', 'tp-elements' ),
				'type'    => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				],
			]
		);

		$this->add_responsive_control(
			'btn_align',
			[
				'label'     => esc_html__( 'Alignment', 'tp-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .helo--btn-wrapper' => 'text-align: {{VALUE}};',
				],
				'prefix_class'      => 'button-pro-align-',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();	
		
        $this->start_controls_section(
            'decoration_settings',
            [
                'label' => esc_html__('Decoration Settings', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'enable_decoration',
            [
                'label'         => esc_html__('Enable Decoration ?', 'tp_plugin'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'return_value'  => 'on',
                'label_off'     => esc_html__('No', 'tp_plugin'),
                'label_on'      => esc_html__('Yes', 'tp_plugin'),
                'separator'     => 'before',

            ]
        );

        $this->add_control(
            'add_decoration',
            [
                'label'         => esc_html__('Select Decoration', 'tp_plugin'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
				'options' => [
					'border-top-left' => esc_html__( 'Top Left', 'tp_plugin' ),
					'border-top-right'  => esc_html__( 'Top Right', 'tp_plugin' ),
					'border-bottom-left' => esc_html__( 'Bottom Left', 'tp_plugin' ),
					'border-bottom-right' => esc_html__( 'Bottom Right', 'tp_plugin' ),
					'inside-border-bottom-right' => esc_html__( 'Inside Bottom Right', 'tp_plugin' ),
					'inside-border-bottom-left' => esc_html__( 'Inside Bottom Left', 'tp_plugin' ),
                ],
                'separator'     => 'before',
                'condition' => [ 
                    'enable_decoration' => 'on'
                 ],
            ]
        );

		$this->add_control(
			'box_shadow_offset_y',
			[
				'label' => esc_html__( 'Box Shadow Offset Y', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .tp-border-decoration-border-bottom-left, {{WRAPPER}} .tp-border-decoration-border-bottom-right, {{WRAPPER}} .tp-border-decoration-border-top-left, {{WRAPPER}} .tp-border-decoration-border-top-right' => '--box-shadow-offset-y: {{SIZE}}{{UNIT}};',
				],
                'condition' => [ 
                    'enable_decoration' => 'on'
                ],
			]
		);

        $this->add_control(
            'decoration_color',
            [
                'label' => esc_html__('Decoration Color', 'tp_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-border-decoration-border-bottom-left, {{WRAPPER}} .tp-border-decoration-border-bottom-right, {{WRAPPER}} .tp-border-decoration-border-top-left, {{WRAPPER}} .tp-border-decoration-border-top-right' => '--box-shadow-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'enable_decoration' => 'on'
                ],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'decoration_border',
				'selector' => '{{WRAPPER}} .tp-border-decoration-border-bottom-left, {{WRAPPER}} .tp-border-decoration-border-bottom-right, {{WRAPPER}} .tp-border-decoration-border-top-left, {{WRAPPER}} .tp-border-decoration-border-top-right',
                'condition' => [ 
                    'enable_decoration' => 'on'
                ],
			]
		);

        $this->end_controls_section();


		$this->start_controls_section(
			'style_button',
			[
				'label' => esc_html__( 'Button', 'tp-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .wc-btn-play',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .wc-btn-play',
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-play'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'tp-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Style
		$this->add_control(
			'btn_icon_heading',
			[
				'label'     => esc_html__( 'Icon', 'tp-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'tp-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn .icon, {{WRAPPER}} .wc-btn-play' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .style-4 .wc-btn-primary strong'            => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_size_width',
			[
				'label'      => esc_html__( 'Icon Width', 'tp-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; --icon-width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'btn_style' => [ 'style5', 'style6' ] ],
			]
		);

		$this->add_responsive_control(
			'btn_gap',
			[
				'label'      => esc_html__( 'Gap', 'tp-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'btn_style!' => [ 'style5', 'style6' ] ],
			]
		);

		// Tabs
		$this->start_controls_tabs(
			'btn_style_tabs'
		);

		$this->start_controls_tab(
			'btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__( 'Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn, {{WRAPPER}} .btn-text-flip span, {{WRAPPER}} .wc-btn-primary' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary strong'                                          => 'background-color: {{VALUE}}',
					'{{WRAPPER}} svg'                                                                      => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
			'btn_h_color',
			[
				'label'     => esc_html__( 'Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn:hover'                                                => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .btn-text-flip:hover span, {{WRAPPER}} .btn-text-flip:hover svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .wc-btn-group:hover span, {{WRAPPER}} .wc-btn-primary:hover'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .wc-btn-group:hover .wc-btn-play svg'                            => 'fill: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary:hover strong'                           => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary:hover strong::after'                    => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_h_border',
			[
				'label'     => esc_html__( 'Border Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn:hover, {{WRAPPER}} .wc-btn-primary:hover, {{WRAPPER}} .wc-btn-group:hover span' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .helo--btn:hover, {{WRAPPER}} .wc-btn-group:hover span, .style-4 .wc-btn-primary span',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {	
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_link'] );
		}
	?>	

	<style>

		.button-pro-align-center .wc-btn-group {
			margin: 0 auto;
		}
		.button-pro-align-start .wc-btn-group {
			margin-right: auto;
		}
		.button-pro-align-end .wc-btn-group {
			margin-left: auto;
		}
		
	</style>
	
        <div class="helo--btn-wrapper <?php echo esc_html( $settings['btn_style'] ); ?>">
			<?php 
                if (!empty($settings['enable_decoration']) && !empty($settings['add_decoration'])) { 
                    foreach ( $settings['add_decoration'] as $item ) {
                        echo '<span class="tp-border-decoration-' . $item . ' "></span>';
                    }
                }
            ?>

			<?php if ( 'style1' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn btn-border-divide">
                    <span class="text"><?php echo esc_html( $settings['btn_text'] ); ?></span>
                    <span class="icon">
                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                </a>
			<?php } elseif ( 'style2' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn">
					<?php echo esc_html( $settings['btn_text'] ); ?>
                    <span class="icon"><?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?> </span>
                </a>
			<?php } elseif ( 'style3' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn btn-text-flip">
                    <span data-text="<?php echo esc_html( $settings['btn_text'] ); ?>">
                        <?php echo esc_html( $settings['btn_text'] ); ?>
                    </span>
					<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
			<?php } elseif ( 'style4' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-primary btn-hover">
                    <span></span>
					<?php echo esc_html( $settings['btn_text'] ); ?>
                    
                </a>
			<?php } elseif ( 'style5' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-group">
					<span class="wc-btn-play">
						<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
                    <span class="wc-btn-primary">
						<?php echo esc_html( $settings['btn_text'] ); ?>
					</span>
                    <span class="wc-btn-play">
						<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
                </a>
			<?php } elseif ( 'style6' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-group">
					<span class="wc-btn-play">
						<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
                    <span class="wc-btn-primary">
						<?php echo esc_html( $settings['btn_text'] ); ?>
					</span>
                    <span class="wc-btn-play">
						<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
                </a>
			<?php } ?>
        </div>

	<?php 
	}
}