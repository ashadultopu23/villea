<?php
/* Template Name: Property Compare */

get_header();

$ids = isset($_GET['ids']) ? explode(',', sanitize_text_field($_GET['ids'])) : [];

if ($ids) :
?>
    <div class="property-compare-wrapper">
        <div class="property-compare-scroll">
            <table class="property-compare">
                <tr>
                    <th>Feature</th>
                    <?php foreach ($ids as $id): ?>
                        <th>
                            <?php echo get_the_title($id); ?>
                            <button class="remove-compare-btn" data-id="<?php echo esc_attr($id); ?>">✕ Remove</button>
                        </th>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Image</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo get_the_post_thumbnail($id, 'medium'); ?></td>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Price</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo esc_html(get_post_meta($id, 'es_property_price', true)); ?></td>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Area</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo esc_html(get_post_meta($id, 'es_property_area', true)); ?></td>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Bedrooms</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo esc_html(get_post_meta($id, 'es_property_bedrooms', true)); ?></td>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Bathrooms</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo esc_html(get_post_meta($id, 'es_property_bathrooms', true)); ?></td>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Type</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo esc_html(get_post_meta($id, 'es_property_type', true)); ?></td>
                    <?php endforeach; ?>
                </tr>

                <tr>
                    <td>Location</td>
                    <?php foreach ($ids as $id): ?>
                        <td><?php echo esc_html(get_post_meta($id, 'es_property_address', true)); ?></td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>
    </div>
<?php
else :
    echo '<p>No properties selected for comparison.</p>';
endif;

get_footer();
