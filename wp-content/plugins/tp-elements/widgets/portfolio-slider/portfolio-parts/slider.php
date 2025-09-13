<?php 
$tp_audio_format_sign_image = get_post_meta(get_the_ID(), 'tp_audio_format_sign_image', true);

?>
<div class="grid-item swiper-slide <?php echo esc_attr( $settings['select_layout'] ); ?>">
    <?php if( $settings['select_layout'] == 'layout2' ) : ?>
    <div class="tp-portfolio-item position-relative">
        <div class="tp-portfolio-item-inner-wrapper">
            <div class="tp-portfolio-item-inner-wrapper-left">
                <h4 class="tp-portfolio-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="tp-portfolio-audio-signed-img">
                    <img src="<?php echo esc_url( $tp_audio_format_sign_image ); ?>" >
                </div>
                <?php
                // price button placed new start
                if ( !empty($price_button_text) ) { ?>
                <div class="price-item-button-container d-flex ">
                    <div class="helo--btn-wrapper d-inline-block position-relative <?php echo esc_html( $settings['btn_style'] ); ?>">

                        <?php if ( 'style1' === $settings['btn_style'] ) { ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="helo--btn btn-border-divide">
                                <span class="text"><?php echo esc_html( $settings['btn_text'] ); ?></span>
                                <span class="icon">
                                    <i class="tp tp-arrow-right"></i>
                                    <i class="tp tp-arrow-right"></i>
                                </span>
                            </a>
                        <?php } elseif ( 'style2' === $settings['btn_style'] ) { ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="helo--btn">
                                <?php echo esc_html( $settings['btn_text'] ); ?>
                                <span class="icon"><i class="tp tp-arrow-right"></i> </span>
                            </a>
                        <?php } elseif ( 'style3' === $settings['btn_style'] ) { ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="helo--btn btn-text-flip">
                                <span data-text="<?php echo esc_html( $settings['btn_text'] ); ?>">
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                </span>
                                <i class="tp tp-arrow-right"></i>
                            </a>
                        <?php } elseif ( 'style4' === $settings['btn_style'] ) { ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="wc-btn-primary btn-hover">
                                <span></span>
                                <?php echo esc_html( $settings['btn_text'] ); ?>
                                
                            </a>
                        <?php } elseif ( 'style5' === $settings['btn_style'] ) { ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="wc-btn-group">
                                <span class="wc-btn-play">
                                    <i class="tp tp-arrow-right"></i>
                                </span>
                                <span class="wc-btn-primary">
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                </span>
                                <span class="wc-btn-play">
                                    <i class="tp tp-arrow-right"></i>
                                </span>
                            </a>
                        <?php } elseif ( 'style6' === $settings['btn_style'] ) { ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="wc-btn-group">
                                <span class="wc-btn-play">
                                    <i class="tp tp-arrow-right"></i>
                                </span>
                                <span class="wc-btn-primary">
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                </span>
                                <span class="wc-btn-play">
                                    <i class="tp tp-arrow-right"></i>
                                </span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php }
                // price button placed new end
                ?>
                
            </div>

            <div class="tp-portfolio-item-inner-wrapper-right">
                <?php if ( has_post_thumbnail( $projects_query->ID ) ) : ?>
                <div class="tp-portfolio-thumb">
                    <?php echo get_the_post_thumbnail( $projects_query->ID, 'full' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php else : ?>
    <div class="tp-portfolio-item position-relative">
        <div class="tp_elements-icon-widget d-inline-block position-absolute end-0" >

            <?php 
            if (!empty($settings['enable_decoration']) && !empty($settings['add_decoration'])) { 
                foreach ( $settings['add_decoration'] as $item ) {
                    echo '<span class="tp-border-decoration-' . $item . ' "></span>';
                }
            }
            $link_open = $settings['btn_link_open'] == 'yes' ? 'target=_blank' : '';
            ?>
            <a href="<?php echo get_the_permalink(); ?>" class="icon-item-link" <?php echo esc_attr( $link_open ); ?> >
                <div class="icon-item">

                    <div class="icon-container<?php echo ( !empty($background_type) ? ' background-type-' . esc_attr($background_type) : '' ); ?>">
                        <?php
                        if ($icon_type == 'default') {
                            echo '<i class="' . esc_attr($default_icon['value']) . '"></i>';
                        }
                        if ($icon_type == 'svg') {
                            echo '<span class="icon">' . tp_elements_output_code($svg_icon) . '</span>';
                        }
                        if ($icon_type == 'custom') {
                            echo '<span>' . $settings['custom_text'] . '</span>';
                        }

                        if ($background_type == 'image') {
                            if (!empty($bg_image['url'])) {
                                echo '<img class="icon-container-bg-image" src="' . esc_url($bg_image['url']) . '" alt="' . esc_html__('Background Image', 'tp-elements') . '" />';
                            }
                        }
                        if ($background_type == 'svg' && !empty($svg_background)) {
                            echo '<span class="background">' . tp_elements_output_code($svg_background) . '</span>';
                        }
                        ?>
                    </div>

                </div>
            </a>
        </div>

        <?php if ( has_post_thumbnail( $projects_query->ID ) ) : ?>
        <div class="tp-portfolio-thumb">
            <?php echo get_the_post_thumbnail( $projects_query->ID, 'full' ); ?>
        </div>
        <?php endif; ?>
        <div class="tp-portfolio-item-content tp-portfolio-item-content-absolute">
            <h4 class="tp-portfolio-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <a href="<?php echo esc_url( $cat_link ); ?>" class="tp-portfolio-category"><?php echo esc_html( $first_cat->name ); ?></a>
        </div>
    </div>
    <?php endif; ?>
</div>
