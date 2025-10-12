<?php

/**
 * Property Grid Style 1
 * @package TP Elements
 * @since 1.0.0
 * @version 1.0.0
 * 
 * custom property grid style1 file
 */

use  \Elementor\Icons_Manager;
?>


<div class="col-xl-<?php echo esc_attr($col_xl); ?> col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-<?php echo esc_attr($col_sm); ?> col-12 col-xxs-<?php echo esc_attr($col_xsm); ?>">
    <div class="property-listing-card">
        <div class="property-image-wrapper">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large', ['class' => 'property-thumbnail']); ?>
                </a>
            <?php endif; ?>

            <div class="property-badge-wrapper">
                <!-- Type Badge -->
                <?php if (!empty($property_rent_type)) :
                    $rent_type = is_array($property_rent_type) ? $property_rent_type[0] : $property_rent_type;
                ?>
                    <span class="property-badge property-listing-type <?php echo strtolower(str_replace(' ', '-', $rent_type)); ?>">
                        <?php echo esc_html($rent_type); ?>
                    </span>
                <?php endif; ?>

                <!-- Status Badge -->
                <!-- <?php if (!empty($label) && is_array($label)) : ?>
                    <span class="property-badge property-label">
                        <?php echo esc_html($label[0]->name); ?>
                    </span>
                <?php endif; ?> -->

            </div>

        </div>

        <div class="property-content">

            <!-- Title -->
            <<?php echo esc_attr($title_tag); ?> class="property-title <?php echo !empty($settings['title_line_clamp']) ? esc_attr($settings['title_line_clamp']) : ''; ?>">
                <?php
                $link = $settings['title_link_open'] == 'yes' ? '_blank' : '_self';
                ?>
                <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($link); ?>">
                    <?php echo esc_html(get_the_title()); ?>
                </a>
            </<?php echo esc_attr($title_tag); ?>>

            <!-- Price & Location -->
            <div class="property-price-location-wrapper">
                <!-- Price -->
                <?php if (!empty($settings['property_price_show_hide']) && $settings['property_price_show_hide'] == 'yes') : ?>
                    <div class="property-price">
                        <?php
                        $price =  es_get_the_formatted_field('price');
                        echo !empty($price) ? esc_html($price) : '';
                        ?>
                    </div>
                <?php endif; ?>
                <!-- City -->
                <?php
                if ((!empty($settings['property_location_show_hide']) && $settings['property_location_show_hide'] == 'yes') && !empty($address)): ?>
                    <div class="property-address-city">
                        <span class="property-address-city-icon icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span class="property-address-city-text">
                            <?php if (!empty($city)) {
                                echo esc_html($city);
                            } else {
                                echo esc_html__('N/A', 'villea');
                            }
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (($settings['property_meta_show_hide'] == 'yes') && (!empty($bedrooms) || !empty($bathrooms) || !empty($area) || !empty($parking))): ?>

                <div class="property-features">
                    <?php if ((!empty($settings['property_bedroom_show_hide']) && $settings['property_bedroom_show_hide'] == 'yes') && !empty($bedrooms)) : ?>
                        <span class="property-feature-item bedrooms">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-bed"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($bedrooms[0]) . ' Beds'; ?>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if ((!empty($settings['property_bathroom_show_hide']) && $settings['property_bathroom_show_hide'] == 'yes') && !empty($bathrooms)) : ?>
                        <span class="property-feature-item bathrooms">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-bath"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($bathrooms[0]) . ' Baths'; ?>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if ((!empty($settings['property_area_show_hide']) && $settings['property_area_show_hide'] == 'yes') && !empty($area)) : ?>
                        <span class="property-feature-item area">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-vector-square"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($area[0]) . ' m²'; ?>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if ((!empty($settings['property_parking_show_hide']) && $settings['property_parking_show_hide'] == 'yes') && !empty($parking)) : ?>
                        <span class="property-feature-item parking">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-car"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($parking[0]) . ' Parking'; ?>
                            </span>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['property_text_show_hide']) && $settings['property_text_show_hide'] == 'yes') : ?>
                <div class="property-description <?php echo !empty($settings['text_line_clamp']) ? esc_attr($settings['text_line_clamp']) : ''; ?>">
                    <?php echo get_the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($address) && is_array($address) && !empty($settings['property_address_show_hide']) && $settings['property_address_show_hide'] == 'yes') : ?>
                <p class="property-address">
                    <?php
                    echo !empty($address[0]) ? esc_html($address[0]) : '';
                    ?>
                </p>
            <?php endif; ?>


            <div class="property-button-wrapper">
                <?php if (!empty($settings['property_btn_show_hide']) && $settings['property_btn_show_hide'] == 'yes') : ?>
                    <div class="property-actions">
                        <?php
                        $target_link = !empty($settings['property_btn_link_open']) && $settings['property_btn_link_open'] == 'yes' ? '_blank' : '_self';
                        ?>
                        <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target_link); ?>" class="action-button view-all-button">

                            <?php
                            if ((!empty($settings['property_btn_icon_show_hide']) && $settings['property_btn_icon_show_hide'] == 'yes') && (!empty($settings['property_btn_icon_position']) && $settings['property_btn_icon_position'] == 'before')
                            ) :
                                \Elementor\Icons_Manager::render_icon($settings['property_btn_icon'], ['aria-hidden' => 'true']);
                            endif; ?>

                            <?php echo esc_html($settings['property_btn_text']); ?>

                            <?php
                            if ((!empty($settings['property_btn_icon_show_hide']) && $settings['property_btn_icon_show_hide'] == 'yes') && (!empty($settings['property_btn_icon_position']) && $settings['property_btn_icon_position'] == 'after')
                            ) :
                                \Elementor\Icons_Manager::render_icon($settings['property_btn_icon'], ['aria-hidden' => 'true']);
                            endif; ?>

                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['property_compare_show_hide']) && $settings['property_compare_show_hide'] == 'yes') : ?>
                    <!-- Compare Button -->
                    <a href="javascript:void(0);" class="property-compare-button add-to-compare" data-id="<?php echo get_the_ID(); ?>" title="Compare">
                        <i class="fas fa-balance-scale-right"></i>
                    </a>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>