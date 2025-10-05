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

                        <!-- Taxonomies -->
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
                                        <?php

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
