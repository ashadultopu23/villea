<?php

/**
 * Property Grid Style 1
 * @package TP Elements
 * @since 1.0.0
 * @version 1.0.0
 * 
 * custom property grid style1 file
 */

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

            <!-- Title & Compare -->
            <div class="property-title-compare-wrapper">
                <!-- Title -->
                <<?php echo esc_attr($title_tag); ?> class="property-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </<?php echo esc_attr($title_tag); ?>>
                <!-- Compare Button -->
                <a href="javascript:void(0);" class="property-compare-button add-to-compare" data-id="<?php echo get_the_ID(); ?>" title="Compare">
                    <i class="fas fa-balance-scale-right"></i>
                </a>
            </div>

            <!-- Price & Location -->
            <div class="property-price-location-wrapper">
                <!-- Price -->
                <div class="property-price">
                    <?php
                    $price =  es_get_the_formatted_field('price');
                    echo !empty($price) ? esc_html($price) : '';
                    ?>
                </div>
                <!-- City -->
                <?php
                if (!empty($address)) : ?>
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

            <?php if (!empty($bedrooms) || !empty($bathrooms) || !empty($area) || !empty($parking)) : ?>

                <div class="property-features">
                    <?php if (!empty($bedrooms)) : ?>
                        <span class="property-feature-item bedrooms">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-bed"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($bedrooms[0]) . ' Beds'; ?>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($bathrooms)) : ?>
                        <span class="property-feature-item bathrooms">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-bath"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($bathrooms[0]) . ' Baths'; ?>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($area)) : ?>
                        <span class="property-feature-item area">
                            <span class="property-feature-icon icon">
                                <i class="fas fa-vector-square"></i>
                            </span>
                            <span class="property-feature-text">
                                <?php echo esc_html($area[0]) . ' m²'; ?>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($parking)) : ?>
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

            <!-- <div class="property-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
            </div> -->



            <!-- <?php if (!empty($address) && is_array($address)) : ?>
                <p class="property-address">
                    <?php
                        echo !empty($address[0]) ? esc_html($address[0]) : '';
                    ?>
                </p>
            <?php endif; ?> -->


            <div class="property-actions">
                <?php if (!empty($property_rent_type)) :
                    $rent_type = is_array($property_rent_type) ? $property_rent_type[0] : $property_rent_type;
                    $rent_type_formatted = strtolower(str_replace(' ', '-', $rent_type));

                    if ($rent_type_formatted == 'for-sale') {
                ?>
                        <button class="action-button sale-button">
                            <?php echo esc_html__('Buy Now', 'tp-elements'); ?>
                        </button>
                    <?php
                    } elseif ($rent_type_formatted == 'for-rent') {
                    ?>
                        <button class="action-button rent-button">
                            <?php echo esc_html__('Book Now', 'tp-elements'); ?>
                        </button>
                    <?php
                    }
                    ?>

                <?php endif; ?>

                <a href="<?php the_permalink(); ?>" class="action-button view-all-button">
                    <?php echo esc_html__('View Details', 'tp-elements'); ?>
                </a>
            </div>
        </div>

    </div>
</div>