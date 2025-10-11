<?php
$cat   = $settings['blog_category'];

if (empty($cat)) {
	$best_wp = new wp_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => $settings['per_page'],
	));
} else {
	$best_wp = new wp_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => $settings['per_page'],
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug', //can be set to ID
				'terms'    => $cat //if field is ID you can reference by cat/term number
			),
		)
	));
}
while ($best_wp->have_posts()): $best_wp->the_post();

	$full_date      = get_the_date();
	$blog_date      = get_the_date('M d y');
	$post_admin     = get_the_author();

	$comment_ccount = get_comments_number(get_the_ID());
	$category = get_the_category();

?>
	<div class="blog-item swiper-slide">
		<div class="col-top">
			<div class="image-part">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail($settings['thumbnail_size']); ?>
				</a>
			</div>
		</div>
		<div class="col-bottom">
			<div class="blog-content">
				<?php if (!empty($settings['blog_meta_show_hide']) && $settings['blog_meta_show_hide'] == 'yes') { ?>
					<ul class="blog-meta">

						<?php if (($settings['blog_cat_show_hide'] == 'yes') && !empty($category)) { ?>
							<li>
								<span class="meta_category">
									<?php echo esc_html($category[0]->cat_name); ?>
								</span>
							</li>
						<?php } ?>
						
					</ul>
				<?php } ?>

				<<?php echo $settings['title_tag'] ?> class="title dd">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</<?php echo $settings['title_tag'] ?>>

				<div class="footer-area">

					<?php if (!empty($settings['blog_meta_show_hide']) && $settings['blog_meta_show_hide'] == 'yes') { ?>
						<ul class="blog-meta">
							<?php if (($settings['blog_avatar_show_hide'] == 'yes')) { ?>
								<?php if (!empty($post_admin)) { ?>
									<li>
										<i class="tp tp-user-2"></i>
										<span> <?php echo esc_html__('By', 'tp-elements'); ?></span>
										<span class="author"><?php echo esc_html($post_admin); ?></span>
									</li>
								<?php } ?>
							<?php } ?>
							<?php if (($settings['blog_date_show_hide'] == 'yes')) { ?>
								<?php if (!empty($post_admin)) { ?>
									<li><i class="tp-clock-regular"></i><span class="date"><?php echo esc_html($full_date); ?></span></li>
								<?php } ?>
							<?php } ?>
							<?php if (($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount)) { ?>
								<li><i class="tp tp-message"></i><span class="meta_comments"><?php echo esc_html($comment_ccount)  . esc_html__(' Comments', 'tp-elements'); ?></span></li>
							<?php } ?>
						</ul>
					<?php } ?>

					<?php if ($settings['blog_readmore_text'] || $settings['blog_readmore_icon']) : ?>
						<a class="tps-read-more " href="<?php the_permalink(); ?>">
							<?php if ($settings['blog_readmore_icon'] && $settings['blog_readmore_icon_position'] == 'left') : ?>
								<span class="icon <?php echo esc_attr($settings['blog_readmore_icon_position']); ?>">
									<i class="<?php echo esc_attr($settings['blog_readmore_icon']); ?>"></i>
								</span>
							<?php endif; ?>
							<?php echo $settings['blog_readmore_text']; ?>

							<?php if ($settings['blog_readmore_icon'] && $settings['blog_readmore_icon_position'] == 'right') : ?>
								<span class="icon <?php echo esc_attr($settings['blog_readmore_icon_position']); ?>">
									<i class="<?php echo esc_attr($settings['blog_readmore_icon']); ?>"></i>
								</span>
							<?php endif; ?>
						</a>
					<?php endif; ?>

				</div>

			</div>
		</div>
	</div>
<?php
endwhile;
wp_reset_query();
?>