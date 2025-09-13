<?php

/**
 * Elementor App Download Buttons Widget.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined('ABSPATH') || die();

class Themephi_Download_Button_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     */
    public function get_name()
    {
        return 'download-buttons';
    }

    /**
     * Get widget title.
     */
    public function get_title()
    {
        return esc_html__('Download Buttons', 'textdomain');
    }

    /**
     * Get widget icon.
     */
    public function get_icon()
    {
        return 'eicon-download-button';
    }

    /**
     * Get widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'download_button_icon',
            [
                'label' => esc_html__('Label', 'text-domain'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'download_button_title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('GET IT ON', 'textdomain'),
            ]
        );

        $this->add_control(
            'download_button_text',
            [
                'label' => esc_html__('Text', 'textdomain'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Google Play', 'textdomain'),
            ]
        );

        $this->add_control(
            'download_button_link',
            [
                'label' => esc_html__('Link', 'textdomain'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'textdomain'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );


        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'textdomain'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_alignment',
            [
                'label' => esc_html__('Alignment', 'textdomain'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border', 'plugin-name'),
                'selector' => '{{WRAPPER}} .app-download-button',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .app-download-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .app-download-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '30',
                    'right' => '30',
                    'bottom' => '30',
                    'left' => '30',
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'download_button_color',
            [
                'label' => esc_html__('Button Background Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .google-play-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'download_button_hover_color',
            [
                'label' => esc_html__('Button Hover Background Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .google-play-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'download_button_text_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app-download-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'download_button_text_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app-download-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .app-download-button .button-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Text Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .app-download-button .button-text',
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'textdomain'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .app-download-button .button-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .app-download-button .button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app-download-button .button-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__('Icon Hover Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app-download-button:hover .button-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('buttons-wrapper', 'class', 'app-download-buttons');
        $this->add_render_attribute('buttons-wrapper', 'class', 'elementor-align-' . $settings['button_alignment']);

?>
        <div <?php echo $this->get_render_attribute_string('buttons-wrapper'); ?>>

            <?php
            $this->add_render_attribute('google-play-button', 'class', 'app-download-button google-play-button');
            $this->add_render_attribute('google-play-button', 'href', $settings['download_button_link']['url']);

            if ($settings['download_button_link']['is_external']) {
                $this->add_render_attribute('google-play-button', 'target', '_blank');
            }

            if ($settings['download_button_link']['nofollow']) {
                $this->add_render_attribute('google-play-button', 'rel', 'nofollow');
            }
            ?>
            <a <?php echo $this->get_render_attribute_string('google-play-button'); ?>>
                <?php
                if (!empty($settings['download_button_icon']['value'])) : ?>
                    <span class="button-icon">
                        <?php Icons_Manager::render_icon($settings['download_button_icon'], ['aria-hidden' => 'true']); ?>
                    </span>
                <?php endif; ?>
                <div class="button-content">
                    <div class="button-title"><?php echo $settings['download_button_title']; ?></div>
                    <div class="button-text"><?php echo $settings['download_button_text']; ?></div>
                </div>
            </a>
        </div>
<?php
    }
}
