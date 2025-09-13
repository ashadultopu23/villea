<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Tp_Comment_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'tp-comment';
    }

    public function get_title()
    {
        return __('TP Comments', 'tp-core');
    }

    public function get_icon()
    {
        return 'eicon-comments';
    }

    public function get_categories()
    {
        return ['tp-core'];
    }

    protected function register_controls()
    {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'tp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'force_comments',
            [
                'label' => __('Force Enable Comments', 'tp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tp-core'),
                'label_off' => __('No', 'tp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Enable comments even if they are closed for the post', 'tp-core'),
            ]
        );

        $this->end_controls_section();

        // Style Tab - Comments Wrapper
        $this->start_controls_section(
            'comment_style',
            [
                'label' => __('Comments Wrapper', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'comment_bg',
                'label' => __('Background', 'tp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .comments-area',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'comment_border',
                'selector' => '{{WRAPPER}} .comments-area',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'comment_border_radius',
            [
                'label' => __('Border Radius', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .comments-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_padding',
            [
                'label' => __('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .comments-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_margin',
            [
                'label' => __('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .comments-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Style Tab - Comment Text
        $this->start_controls_section(
            'comment_text_style',
            [
                'label' => __('Comment Text', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'comment_text_color',
            [
                'label' => __('Text Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comments-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comment_text_typography',
                'selector' => '{{WRAPPER}} .comments-title',
            ]
        );

        $this->end_controls_section();



        // Style Tab - Comments List
        $this->start_controls_section(
            'comment_list_style',
            [
                'label' => __('Comments List', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'comment_list_bg',
                'label' => __('Background', 'tp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .comment-list .comment',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'comment_list_border',
                'selector' => '{{WRAPPER}} .comment-list .comment',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'comment_list_border_radius',
            [
                'label' => __('Border Radius', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_list_padding',
            [
                'label' => __('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_list_margin',
            [
                'label' => __('Margin', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'replay_button_heading',
            [
                'label' => esc_html__('Replay Button', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'replay_button_color',
            [
                'label' => __('Button Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment .comment-reply-link' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'replay_button_hover_color',
            [
                'label' => __('Button Hover Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment .comment-reply-link:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'replay_button_bg_color',
            [
                'label' => __('Button Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment .comment-reply-link' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'replay_button_hover_bg_color',
            [
                'label' => __('Button Hover Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comment-list .comment .comment-reply-link:hover' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();


        // Style Tab - Comment Form
        $this->start_controls_section(
            'comment_form_style',
            [
                'label' => __('Comment Form', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'form_bg',
                'label' => __('Background', 'tp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} #respond, {{WRAPPER}} #commentform',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_border',
                'selector' => '{{WRAPPER}} #respond',
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label' => __('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #respond' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Input Fields
        $this->add_control(
            'input_fields_heading',
            [
                'label' => __('Input Fields', 'tp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => __('Text Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #commentform input, {{WRAPPER}} #commentform textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label' => __('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #commentform input, {{WRAPPER}} #commentform textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} #commentform input, {{WRAPPER}} #commentform textarea',
            ]
        );

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label' => __('Border Radius', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #commentform input, {{WRAPPER}} #commentform textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label' => __('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #commentform input, {{WRAPPER}} #commentform textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Submit Button
        $this->add_control(
            'submit_button_heading',
            [
                'label' => __('Submit Button', 'tp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #commentform .form-submit input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'tp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #commentform .form-submit input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} #commentform .form-submit input',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #commentform .form-submit input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'tp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} #commentform .form-submit input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} #commentform .form-submit input',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        global $post;

        if (!$post) {
            echo '<p>' . esc_html__('No post found.', 'tp-core') . '</p>';
            return;
        }

        // Force enable comments if setting is on
        if ('yes' === $settings['force_comments']) {
            add_post_type_support($post->post_type, 'comments');
            add_post_type_support($post->post_type, 'trackbacks');

            if (!comments_open()) {
                $post->comment_status = 'open';
                $post->ping_status = 'open';
                wp_update_post($post);
            }
        }

        setup_postdata($post);

        // Display comments
        if (comments_open() || get_comments_number()) {
            comments_template();
        } else {
            echo '<p>' . esc_html__('Comments are closed.', 'tp-core') . '</p>';
        }

        wp_reset_postdata();
    }
}
