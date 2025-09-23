		<?php
        $default_image = !empty($settings['list_repeater'][0]['image']['url'])
            ? $settings['list_repeater'][0]['image']['url']
            : \Elementor\Utils::get_placeholder_image_src();
        ?>


		<section class="gallery-feature-tab" id="tp-widget-<?php echo $this->get_id(); ?>">
		    <div class="gallery-feature-tab-container">

		        <!-- Image Column -->
		        <div class="gallery-feature-tab-image">
		            <div class="img_border">
		                <img src="<?php echo esc_url($default_image); ?>"
		                    class="feature-tab-img"
		                    alt="<?php echo !empty($settings['list_repeater'][0]['list_title'])
                                        ? esc_attr($settings['list_repeater'][0]['list_title'])
                                        : esc_attr__('Default image', 'tp-elements'); ?>" />
		            </div>
		        </div>

		        <!-- Solution Items Column -->
		        <div class="gallery-feature-tab-items gallery-feature-items">
		            <?php
                    if (!empty($settings['list_repeater']) && is_array($settings['list_repeater'])) :
                        $index = 1;
                        foreach ($settings['list_repeater'] as $item) :
                            $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
                            $title = isset($item['list_title']) ? $item['list_title'] : '';
                    ?>
		                    <!-- Solution Item -->
		                    <div class="gallery-feature-item gallery-feature-tab-item" data-img="<?php echo esc_url($image_url); ?>">
		                        <i class="tp-arrow-up-right"></i>
		                        <div class="content gallery-feature-item-content">
		                            <?php if (!empty($title)) : ?>
		                                <h3 class="gallery-feature-item-title inactive"><?php echo wp_kses_post($title); ?></h3>
		                            <?php endif; ?>
		                            <h6 class="solution-index gallery-feature-item-index inactive"><?php echo sprintf("%02d", $index); ?></h6>
		                        </div>
		                    </div>
		            <?php
                            $index++;
                        endforeach;
                    endif;
                    ?>
		        </div>

		    </div>
		</section>

		<script>
		    (function($) {
		        // Define the function only once
		        if (typeof window.initSolutionHover === "undefined") {
		            window.initSolutionHover = function(container) {
		                if (!container) return;

		                const tabItem = container.querySelectorAll(".gallery-feature-tab-item");
		                const solutionImg = container.querySelector(".feature-tab-img");

		                if (!tabItem.length || !solutionImg) return;

		                tabItem.forEach((item) => {
		                    item.addEventListener("mouseenter", function() {
		                        const imgSrc = this.getAttribute("data-img");

		                        // Preload image for smoother transition
		                        const newImg = new Image();
		                        newImg.onload = function() {
		                            solutionImg.src = imgSrc;
		                        };
		                        newImg.src = imgSrc;

		                        tabItem.forEach((i) => i.classList.remove("active"));
		                        this.classList.add("active");
		                    });

		                    // Add tabindex for keyboard navigation
		                    item.setAttribute("tabindex", "0");

		                    // Add click event for mobile/touch devices
		                    item.addEventListener("click", function() {
		                        const imgSrc = this.getAttribute("data-img");
		                        const newImg = new Image();
		                        newImg.onload = function() {
		                            solutionImg.src = imgSrc;
		                        };
		                        newImg.src = imgSrc;

		                        tabItem.forEach((i) => i.classList.remove("active"));
		                        this.classList.add("active");
		                    });
		                });
		            };
		        }

		        // Initialize for this specific widget instance
		        $(document).ready(function() {
		            const container = document.getElementById('tp-widget-<?php echo $this->get_id(); ?>');
		            if (container) {
		                window.initSolutionHover(container);
		            }
		        });

		    })(jQuery);
		</script>