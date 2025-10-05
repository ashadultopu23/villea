<?php
/* Template Name: Property Compare */

get_header();

$ids = isset($_GET['ids']) ? explode(',', sanitize_text_field($_GET['ids'])) : [];

?>
<section>
    <div class="container-fluid">
        <div class="page-header text-center">
            <h2 class="page-title">
                <?php echo esc_html__('Compare Properties', 'villea'); ?>
            </h2>
        </div>
        <?php
        if ($ids) :


            get_the_terms($id, 'taxonomy_name');

            // $property_id = get_the_ID();
            // $property_id = $ids[0];

            // $taxonomies = [
            //     'es_location' => 'Location',
            //     'es_category' => 'Category',
            //     'es_type' => 'Type',
            //     'es_status' => 'Status',
            //     'es_feature' => 'Features',
            //     'es_amenity' => 'Amenities',
            // ];

            // foreach ($taxonomies as $taxonomy => $label) {
            //     $terms = get_the_terms($property_id, $taxonomy);

            //     if (!empty($terms) && !is_wp_error($terms)) {
            //         echo '<div class="property-taxonomy property-' . esc_attr($taxonomy) . '">';
            //         echo '<strong>' . esc_html($label) . ':</strong> ';
            //         $term_names = wp_list_pluck($terms, 'name');
            //         echo '<span>' . esc_html(implode(', ', $term_names)) . '</span>';
            //         echo '</div>';
            //     }
            // }
            $compare_taxonomies = [
                'es_category' => __('Category', 'villea'),
                'es_type' => __('Type', 'villea'),
                'es_status' => __('Status', 'villea'),
                'es_feature' => __('Features', 'villea'),
                'es_amenity' => __('Amenities', 'villea'),
                'es_location' => __('Location', 'villea'),
            ];

        ?>
            <div class="at-compare-table-wrapper">
                <div class="at-compare-table-scroll">
                    <table class="at-compare-table">
                        <tr>
                            <th class="at-sticky-col"><?php echo esc_html__('Property', 'villea'); ?></th>
                            <?php foreach ($ids as $id): ?>
                                <th>
                                    <?php echo get_the_title($id); ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>

                        <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Image', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo has_post_thumbnail($id) ? "at-compare-active" : ' ' ?>">
                                    <div class="at-compare-table-image">
                                        <?php echo get_the_post_thumbnail($id, 'medium'); ?>
                                    </div>
                                    <div class="at-compare-table-title mt-3">
                                        <?php echo get_the_title($id); ?>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>


                        <?php $all_taxonomies = get_object_taxonomies('properties', 'objects');

                        foreach ($all_taxonomies as $taxonomy_slug => $taxonomy_obj) :
                        ?>
                            <tr>
                                <td class="at-sticky-col">
                                    <?php echo esc_html($taxonomy_obj->labels->singular_name); ?>
                                </td>

                                <?php foreach ($ids as $id): ?>
                                    <?php
                                    $terms = get_the_terms($id, $taxonomy_slug);
                                    $term_names = [];

                                    if (!empty($terms) && !is_wp_error($terms)) {
                                        $term_names = wp_list_pluck($terms, 'name');
                                    }
                                    ?>
                                    <td class="<?php echo !empty($term_names) ? 'at-compare-active' : ''; ?>">
                                        <!-- <?php echo !empty($term_names) ? esc_html(implode(', ', $term_names)) : 'N/A'; ?> -->
                                        <?php
                                        // if (!empty($term_names)) {
                                        //     if ($term_names && count($term_names) < 1) {
                                        //         echo '<span class="at-compare-term">' . $term_names . '</span> ';
                                        //     } else {
                                        //         foreach ($term_names as $term_name) {
                                        //             echo '<span class="at-compare-terms">' . esc_html($term_name) . '</span> ';
                                        //             // echo '<span class="at-compare-terms">' . esc_html(implode(', ', $term_names)) . '</span> ';
                                        //         }
                                        //     }
                                        // } else {
                                        //     echo 'N/A';
                                        // }

                                        // if (!empty($term_names)) {
                                        //     if (count($term_names) === 1) {
                                        //         // Single term → wrap individually
                                        //         echo '<span class="at-compare-term">' . esc_html($term_names[0]) . '</span>';
                                        //     } else {
                                        //         // Multiple terms → combine and wrap in one span
                                        //         echo '<span class="at-compare-terms">' . esc_html(implode(', ', $term_names)) . '</span>';
                                        //     }
                                        // } else {
                                        //     echo 'N/A';
                                        // }

                                        if (!empty($term_names)) {
                                            if (count($term_names) === 1) {
                                                // Single term → wrap in single badge
                                                echo '<span class="at-compare-term">' . esc_html($term_names[0]) . '</span>';
                                            } else {
                                                // Multiple terms → group and wrap each inside parent span
                                                echo '<span class="at-compare-terms">';
                                                foreach ($term_names as $term_name) {
                                                    echo '<span>' . esc_html($term_name) . ', </span> ';
                                                }
                                                echo '</span>';
                                            }
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>





                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Price', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_price', true) ? "at-compare-active" : ' ' ?>">

                                    <span class="at-compare-currency-symbol">
                                        <?php echo esc_html__('$', 'villea'); ?>
                                    </span>
                                    <?php echo esc_html(get_post_meta($id, 'es_property_price', true) ? get_post_meta($id, 'es_property_price', true) : 'N/A'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Area', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_area', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_area', true) ? get_post_meta($id, 'es_property_area', true) : 'N/A'); ?>

                                    <span class="at-compare-area-unit">
                                        <?php echo esc_html(get_post_meta($id, 'es_property_area_unit', true)); ?>
                                    </span>

                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Bedrooms', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_bedrooms', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_bedrooms', true) ? get_post_meta($id, 'es_property_bedrooms', true) : 'N/A'); ?>
                                    <?php if (get_post_meta($id, 'es_property_bedrooms', true)) : ?>
                                        <span class="at-compare-bed-unit">
                                            <?php echo esc_html__('Beds', 'villea'); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Bathrooms', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_bathrooms', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_bathrooms', true) ? get_post_meta($id, 'es_property_bathrooms', true) : 'N/A'); ?>
                                    <?php if (get_post_meta($id, 'es_property_bathrooms', true)) : ?>
                                        <span class="at-compare-bath-unit">
                                            <?php echo esc_html__('Baths', 'villea'); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Floors', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_floor_level', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_floor_level', true) ? get_post_meta($id, 'es_property_floor_level', true) : 'N/A'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Parkings', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_garage-spaces', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_garage-spaces', true) ? get_post_meta($id, 'es_property_garage-spaces', true) : 'N/A'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <!-- <?php foreach ($compare_taxonomies as $taxonomy => $label) : ?>
                            <tr>
                                <td class="at-sticky-col"><?php echo esc_html($label); ?></td>
                                <?php foreach ($ids as $id): ?>
                                    <?php $terms = get_the_terms($id, $taxonomy); ?>
                                    <td class="<?php echo !empty($terms) ? 'at-compare-active' : ''; ?>">
                                        <?php
                                        if (!empty($terms) && !is_wp_error($terms)) {
                                            echo esc_html(implode(', ', wp_list_pluck($terms, 'name')));
                                        } else {
                                            echo esc_html__('N/A', 'villea');
                                        }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?> -->


                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Location', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_location', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_address', true) ? get_post_meta($id, 'es_property_address', true) : 'N/A'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Build Year', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_year_built', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_year_built', true) ? get_post_meta($id, 'es_property_year_built', true) : 'N/A'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Sell / Rent', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td class="<?php echo get_post_meta($id, 'es_property_property-rent-type', true) ? "at-compare-active" : ' ' ?>">
                                    <?php echo esc_html(get_post_meta($id, 'es_property_property-rent-type', true) ? get_post_meta($id, 'es_property_property-rent-type', true) : 'N/A'); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr> -->

                        <tr>
                            <td class="at-sticky-col">
                                <?php echo esc_html__('Actions', 'villea'); ?>
                            </td>
                            <?php foreach ($ids as $id): ?>
                                <td>
                                    <a href="<?php echo get_permalink($id); ?>" class="compare-btn view-compare-btn"><?php echo esc_html__('View Details', 'villea'); ?></a>
                                    <button class="compare-btn remove-compare-btn" data-id="<?php echo esc_attr($id); ?>">✕ Remove</button>
                                </td>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>

        <?php
        else :
            echo '<p class="text-center">No properties selected for comparison.</p>';
        endif;
        ?>
    </div>
</section>
<?php

get_footer();
