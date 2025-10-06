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
                    $property_rent_type = is_array($property_rent_type) ? $property_rent_type[0] : $property_rent_type;
                ?>
                    <span class="property-badge property-listing-type <?php echo strtolower(str_replace(' ', '-', $property_rent_type)); ?>">
                        <?php echo esc_html($property_rent_type); ?>
                    </span>
                <?php endif; ?>

                <!-- Status Badge -->
                <?php if (!empty($label) && is_array($label)) : ?>
                    <span class="property-badge property-label">
                        <?php echo esc_html($label[0]->name); ?>
                    </span>
                <?php endif; ?>

            </div>


        </div>

        <div class="property-content">
            <div class="property-title-compare-wrapper">
                <<?php echo esc_attr($title_tag); ?> class="property-title"><?php the_title(); ?></<?php echo esc_attr($title_tag); ?>>
                <a href="javascript:void(0);" class="property-compare-button add-to-compare" data-id="<?php echo get_the_ID(); ?>" title="Compare">
                    <i class="fas fa-balance-scale-right"></i>
                </a>
            </div>
            <div class="property-price-location-wrapper">
                <div class="property-price">
                    <?php
                    $price =  es_get_the_formatted_field('price');
                    echo !empty($price) ? esc_html($price) : '';
                    ?>
                </div>

                <?php
                // $address = es_the_address();
                // var_dump($address);
                ?>

                <?php

                // $address = es_the_address();
                // var_dump($address);

                if (!empty($address)) : ?>
                    <p class="property-address">
                        <?php
                        //echo esc_html($address[0]->name);
                        // echo $address;

                        ?>
                    </p>
                <?php endif; ?>

            </div>

            <?php if (!empty($bedrooms) || !empty($bathrooms) || !empty($area) || !empty($parking)) : ?>

                <div class="property-features">
                    <?php if (!empty($bedrooms)) : ?>
                        <span class="property-feature-item bedrooms">
                            <span class="icon">
                                <i class="fas fa-bed"></i>
                            </span>
                            <?php echo esc_html($bedrooms[0]) . ' Beds'; ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($bathrooms)) : ?>
                        <span class="property-feature-item bathrooms">
                            <span class="icon">
                                <i class="fas fa-bath"></i>
                            </span>
                            <?php echo esc_html($bathrooms[0]) . ' Baths'; ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($area)) : ?>
                        <span class="property-feature-item area">
                            <span class="icon">
                                <i class="fas fa-vector-square"></i>
                            </span>
                            <?php echo esc_html($area[0]) . ' m²'; ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($parking)) : ?>
                        <span class="property-feature-item parking">
                            <span class="icon">
                                <i class="fas fa-car"></i>
                            </span>
                            <?php echo esc_html($parking[0]) . ' Parking'; ?>
                        </span>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

            <div class="property-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
            </div>



            <!-- <?php if (!empty($address) && is_array($address)) : ?>
                <p class="property-address">
                    <?php echo esc_html($address[0]->name); ?>
                </p>
            <?php endif; ?> -->


            <div class="property-actions">
                <button class="action-button rent-button">Booking Now</button>
                <a href="<?php the_permalink(); ?>" class="view-all-button ">
                    View Details
                </a>
            </div>
        </div>

    </div>
</div>