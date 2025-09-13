<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Social_Share_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'social-share';
    }

    public function get_title()
    {
        return __('Social Share', 'sv-element');
    }

    public function get_icon()
    {
        return 'eicon-share';
    }

    public function get_categories()
    {
        return ['general'];
    }


    protected function _register_controls()
    {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'sv-element'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Display', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'inline' => __('Inline', 'sv-element'),
                    'block' => __('Block', 'sv-element'),
                ],
                'default' => 'inline',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'sv-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Share This:', 'sv-element'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_network',
            [
                'label' => __('Social Network', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'facebook',
                'options' => [
                    'facebook' => __('Facebook', 'sv-element'),
                    'twitter' => __('Twitter', 'sv-element'),
                    'linkedin' => __('LinkedIn', 'sv-element'),
                    'pinterest' => __('Pinterest', 'sv-element'),
                    'reddit' => __('Reddit', 'sv-element'),
                    'whatsapp' => __('WhatsApp', 'sv-element'),
                    'telegram' => __('Telegram', 'sv-element'),
                    'viber' => __('Viber', 'sv-element'),
                    'skype' => __('Skype', 'sv-element'),
                    'messenger' => __('Facebook Messenger', 'sv-element'),
                    'tumblr' => __('Tumblr', 'sv-element'),
                    'buffer' => __('Buffer', 'sv-element'),
                    'digg' => __('Digg', 'sv-element'),
                    'stumbleupon' => __('StumbleUpon', 'sv-element'),
                    'mix' => __('Mix', 'sv-element'),
                    'email' => __('Email', 'sv-element'),
                    'copy' => __('Copy Link', 'sv-element'),
                ],
            ]
        );


        $repeater->add_control(
            'custom_label',
            [
                'label' => __('Custom Label', 'sv-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Leave empty for default', 'sv-element'),
            ]
        );

        $repeater->add_control(
            'custom_icon',
            [
                'label' => __('Custom Icon', 'sv-element'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-share-alt',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'social_networks',
            [
                'label' => __('Social Networks', 'sv-element'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_network' => 'facebook',
                        'custom_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_network' => 'twitter',
                        'custom_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_network' => 'linkedin',
                        'custom_icon' => [
                            'value' => 'fab fa-linkedin-in',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_network' => 'copy',
                        'custom_icon' => [
                            'value' => 'far fa-copy',
                            'library' => 'fa-regular',
                        ],
                    ],
                ],
                'title_field' => '{{{ social_network }}}',
            ]
        );

        $this->add_control(
            'share_text',
            [
                'label' => __('Share Text', 'sv-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Check this out!', 'sv-element'),
            ]
        );


        $this->add_control(
            'copy_notification',
            [
                'label' => __('Copy Notification Text', 'sv-element'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Link copied to clipboard!', 'sv-element'),
                // 'condition' => [
                //     'social_networks.social_network' => 'copy',
                // ],
            ]
        );

        $this->add_control(
            'show_icons',
            [
                'label' => __('Show Icons', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'sv-element'),
                'label_off' => __('Hide', 'sv-element'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label' => __('Show Labels', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'sv-element'),
                'label_off' => __('Hide', 'sv-element'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h5',
            ]
        );

        $this->end_controls_section();




        // Style Tab
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'sv-element'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-share-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => __('Icon Padding', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-share-item .social-share-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __('Spacing Between Items', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-share-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __('Alignment', 'sv-element'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'sv-element'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'sv-element'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'sv-element'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .social-share-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('icon_colors');

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => __('Normal', 'sv-element'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __('Background Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => __('Label Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-label' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Label Typography', 'sv-element'),
                'selector' => '{{WRAPPER}} .social-share-label',
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => __('Hover', 'sv-element'),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-item:hover .social-share-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg_color',
            [
                'label' => __('Background Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-item:hover .social-share-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label' => __('Border Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-item:hover .social-share-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_hover_color',
            [
                'label' => __('Label Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-label:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_labels' => 'yes',
                ],
                'separator' => 'before',

            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .social-share-icon',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'sv-element'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .social-share-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .social-share-icon',
            ]
        );

        $this->add_control(
            'title_style',
            [
                'label' => __('Title', 'sv-element'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'sv-element'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-share-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'sv-element'),
                'selector' => '{{WRAPPER}} .social-share-title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing_bottom',
            [
                'label' => __('Spacing Bottom', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-share-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                // 'condition' => [
                //     'layout' => 'block',
                // ],
            ]
        );

        $this->add_responsive_control(
            'title_spacing_right',
            [
                'label' => __('Spacing Right', 'sv-element'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-share-title' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                // 'condition' => [
                //     'layout' => 'inline',
                // ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title_tag = $settings['title_tag'] ?: 'h5';
        $share_text = esc_attr($settings['share_text']);
        $current_url = esc_url(get_permalink());
?>
        <div class="social-share-container <?php echo esc_attr($settings['layout']); ?>">
            <<?php echo esc_attr($title_tag); ?> class="social-share-title">
                <?php echo esc_html($settings['title']); ?>
            </<?php echo esc_attr($title_tag); ?>>
            <div class="social-share-wrapper">
                <?php foreach ($settings['social_networks'] as $item):
                    $network = $item['social_network'];
                    $label = $item['custom_label'] ?: ucfirst($network);
                    $icon = $item['custom_icon'];
                    $url = '#';

                    switch ($network) {
                        case 'facebook':
                            $url = 'https://www.facebook.com/sharer/sharer.php?u=' . $current_url;
                            break;
                        case 'twitter':
                            $url = 'https://twitter.com/intent/tweet?url=' . $current_url . '&text=' . $share_text;
                            break;
                        case 'linkedin':
                            $url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $current_url;
                            break;
                        case 'pinterest':
                            $url = 'https://pinterest.com/pin/create/button/?url=' . $current_url;
                            break;
                        case 'reddit':
                            $url = 'https://www.reddit.com/submit?url=' . $current_url;
                            break;
                        case 'whatsapp':
                            $url = 'https://api.whatsapp.com/send?text=' . $current_url;
                            break;
                        case 'telegram':
                            $url = 'https://t.me/share/url?url=' . $current_url;
                            break;
                        case 'viber':
                            $url = 'viber://forward?text=' . $current_url;
                            break;
                        case 'skype':
                            $url = 'https://web.skype.com/share?url=' . $current_url;
                            break;
                        case 'messenger':
                            $url = 'fb-messenger://share?link=' . $current_url;
                            break;
                        case 'tumblr':
                            $url = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $current_url;
                            break;
                        case 'buffer':
                            $url = 'https://buffer.com/add?url=' . $current_url;
                            break;
                        case 'digg':
                            $url = 'http://digg.com/submit?url=' . $current_url;
                            break;
                        case 'stumbleupon':
                            $url = 'http://www.stumbleupon.com/submit?url=' . $current_url;
                            break;
                        case 'mix':
                            $url = 'https://mix.com/add?url=' . $current_url;
                            break;
                        case 'email':
                            $url = 'mailto:?subject=' . rawurlencode($share_text) . '&body=' . $current_url;
                            break;
                        case 'copy':
                            $url = 'javascript:void(0);';
                            break;
                    }
                ?>
                    <div class="social-share-item">
                        <a class="social-share-link" href="<?php echo $network === 'copy' ? 'javascript:void(0);' : esc_url($url); ?>" target="<?php echo $network === 'copy' ? '_self' : '_blank'; ?>" <?php if ($network === 'copy'): ?>onclick="navigator.clipboard.writeText('<?php echo $current_url; ?>'); alert('<?php echo esc_js($settings['copy_notification']); ?>');" <?php endif; ?>>

                            <?php
                            if (!empty($icon['value']) && ($settings['show_icons'] === 'yes')) {
                                echo '<span class="social-share-icon"> <i class="' . esc_attr($icon['value']) . '"></i> </span>';
                            }
                            ?>

                            <?php if ($settings['show_labels'] === 'yes'): ?>
                                <span class="social-share-label"><?php echo esc_html($label); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
