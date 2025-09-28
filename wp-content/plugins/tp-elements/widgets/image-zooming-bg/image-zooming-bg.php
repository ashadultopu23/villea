<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if (! defined('ABSPATH')) exit;

class AT_Image_Zooming_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'at-image-zooming';
    }

    public function get_title()
    {
        return esc_html__('Image Zooming Animation', 'at-elements');
    }

    public function get_icon()
    {
        return 'eicon-image';
    }

    public function get_categories()
    {
        return ['pielements_category'];
    }

    public function get_keywords()
    {
        return ['image', 'zoom', 'animation', 'parallax', 'scroll', 'background'];
    }

    protected function register_controls()
    {

        // Image Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'at-elements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => esc_html__('Choose Image', 'at-elements'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Width', 'at-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => ['min' => 200, 'max' => 2000],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-zooming-section img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Height', 'at-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => ['min' => 200, 'max' => 2000],
                    'vh' => ['min' => 50, 'max' => 150],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-zooming-section img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->end_controls_section();

        // Animation Controls
        $this->start_controls_section(
            'animation_section',
            [
                'label' => esc_html__('Animation Settings', 'at-elements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'   => esc_html__('Animation Type', 'at-elements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'zoom-out',
                'options' => [
                    'zoom-in'  => esc_html__('Zoom In', 'at-elements'),
                    'zoom-out' => esc_html__('Zoom Out', 'at-elements'),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Wrapper Style', 'at-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .image-zooming-section img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_bg_color',
            [
                'label'     => esc_html__('Background Color', 'at-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .image-zooming-section' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'section_padding',
            [
                'label' => esc_html__('Padding', 'at-elements'),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .image-zooming-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_margin',
            [
                'label' => esc_html__('Margin', 'at-elements'),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .image-zooming-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display(); ?>

        <section class="image-zooming-section" data-animation="<?php echo esc_attr($settings['animation_type']); ?>">
            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="">
        </section>

        <script>
            (function($) {
                const animate = (img, section) => {
                    let currentScale = section.dataset.animation === "zoom-out" ? 1.2 : 0.5;
                    let targetScale = currentScale;

                    const updateTarget = () => {
                        const rect = section.getBoundingClientRect();
                        const viewportHeight = window.innerHeight;

                        const progress = Math.min(
                            Math.max(1 - rect.top / viewportHeight, 0),
                            1
                        );

                        const type = section.dataset.animation || "zoom-in";

                        if (type === "zoom-in") {
                            targetScale = 0.5 + progress * 0.7;
                        } else {
                            targetScale = 1.2 - progress * 0.7;
                        }
                    };

                    const tick = () => {
                        currentScale += (targetScale - currentScale) * 0.08;
                        img.style.transform = `scale(${currentScale.toFixed(3)})`;
                        requestAnimationFrame(tick);
                    };

                    // start loop
                    updateTarget();
                    tick();

                    $(window).on("scroll resize", updateTarget);
                };

                $(".image-zooming-section").each(function() {
                    const img = this.querySelector("img");
                    const section = this;
                    animate(img, section);
                });
            })(jQuery);
        </script>
<?php
    }
}
