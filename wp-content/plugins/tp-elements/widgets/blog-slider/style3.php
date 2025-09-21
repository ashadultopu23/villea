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
	$cats_show = get_the_term_list($best_wp->ID, 'category', ' ', '<span class="separator">,</span> ');

	$full_date      = get_the_date();
	$blog_date      = get_the_date('M d y');
	$post_admin     = get_the_author();
?>
	<div class="align-items-center no-gutter blog-item themephi-blog-grid1 swiper-slide">
		<div class="image-part">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail($settings['thumbnail_size']); ?>
			</a>
			<?php if (($settings['blog_cat_show_hide'] == 'yes')) { ?>
				<div class="cat_list">
					<?php the_category(); ?>
				</div>
			<?php } ?>
		</div>

		<div class="blog-content">
			<?php if (!empty($settings['blog_meta_show_hide']) || !empty($settings['blog_avatar_show_hide'])) { ?>
				<ul class="blog-meta">
					<?php if (($settings['blog_avatar_show_hide'] == 'yes')) { ?>
						<?php if (!empty($post_admin)) { ?>
							<li>
								<span class="icon avatar-icon">
									<i class="tp tp-user-2"></i>
								</span>
								<span class="meta_text author">
									<?php echo esc_html__('By', 'tp-elements'); ?>
									<?php echo esc_html($post_admin); ?>
								</span>
							</li>
						<?php } ?>
					<?php } ?>

					<?php if (($settings['blog_meta_show_hide'] == 'yes')) { ?>
						<li>
							<span class="icon calendar-icon">
								<i class="tp-clock-regular"></i>
							</span>
							<span class="meta_text date">
								<?php if (!empty($full_date)) { ?>
									<?php echo esc_html($full_date); ?>
								<?php } ?>
							</span>
						</li>
					<?php } ?>

				</ul>
			<?php } ?>

			<<?php echo $settings['title_tag'] ?> class="title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</<?php echo $settings['title_tag'] ?>>


			<?php if ($settings['blog_readmore_text']) : ?>
				<a class="tps-read-more" href="<?php the_permalink(); ?>">
					<?php echo $settings['blog_readmore_text']; ?>
					<i class="tp tp-arrow-right"></i>
				</a>
			<?php endif; ?>
		</div>
	</div>
<?php
endwhile;
wp_reset_query();
?>