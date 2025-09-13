<div class="grid-item col-xxl-<?php echo esc_attr($col_xxl); ?> col-xl-<?php echo esc_attr($col_xl); ?> col-lg-<?php echo esc_attr($col_lg); ?> col-md-<?php echo esc_attr($col_md); ?> col-sm-<?php echo esc_attr($col_sm); ?> col-<?php echo esc_attr($col_xs); ?>  <?php echo esc_attr($termsString);?>">
    <div class="align-items-center row g-0 blog-item themephi-blog-grid1">
        <div class="col-md-12">
            <div class="blog-content-main">
                <?php if($settings['blog_image'] == 'yes' && has_post_thumbnail()) :?>
                <div class="image-part position-relative <?php echo $settings['image_gray'];?>">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                    </a> 

                    <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                        <?php if(($settings['blog_cat_show_hide'] == 'yes') && ! empty( $category ) && ! is_wp_error( $category ) ){ ?>
                            <a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>" class="meta_category meta-cat-abs"><?php echo esc_html($category[0]->cat_name);?></a>
                        <?php } ?>
                    <?php } ?>

                    <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                    <div class="blog-meta-abs d-inline-block">	
                        <?php if(($settings['blog_date_show_hide'] == 'yes') ){ ?>						
                            <span class="meta_date"><?php echo esc_html( $full_date ); ?></span>						
                        <?php } ?>
                        <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                            <span class="meta_author"><?php echo esc_html($post_admin);?></span>
                        <?php } ?>
                    </div>
                    <?php } ?>

                </div>   
                <?php endif; ?>     
                <div class="blog-content ">   

                    <div class="blog-content-inner-wrapp d-flex">
                        <div class="blog-content-inner-wrapp-left ">
                            <h5 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                            <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="blog-content-inner-wrapp-right">
                            <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                            <div class="btn-part">
                                <a href="<?php the_permalink(); ?>">
                                    <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>