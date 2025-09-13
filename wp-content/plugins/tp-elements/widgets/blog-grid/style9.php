<?php if($settings['blog_image'] == 'yes') :?>
    <?php if ( has_post_thumbnail() ) { ?>
<div class="grid-item col-xxl-<?php echo esc_attr($col_xxl); ?> col-xl-<?php echo esc_attr($col_xl); ?> col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-<?php echo esc_attr($col_sm); ?> col-<?php echo esc_attr($col_xs); ?> <?php echo esc_attr($termsString);?>">
    <div class="align-items-center no-gutter blog-item themephi-blog-grid1 overflow-hidden">
        <div class="col-md-12 ">
            <div class="grid-image-part-wrapper">
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

                <div class="image-part">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                    </a>
                </div>
                <div class="blog-content blog-content-absolute">        
                    <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                    <ul class="blog-meta">
                        <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                            <li><span class="meta_author"><?php echo esc_html__( 'By', 'tp-elements' ); ?> <?php echo esc_html($post_admin);?></span></li>
                        <?php } ?>
                        <?php if(($settings['blog_cat_show_hide'] == 'yes') && !empty($category ) ){ ?>
                            <li><span class="meta_category"><?php echo esc_html($category[0]->cat_name);?></span></li>
                        <?php } ?>
                        <?php if(($settings['blog_date_show_hide'] == 'yes') ){ ?>						
                            <li><span class="meta_date"><?php echo esc_html( $full_date ); ?></span></li>						
                        <?php } ?>
                        <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                            <li><span class="meta_comments"><?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?></span></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                    <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                    <p class="txt mt-15 mb-0"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php endif; ?>