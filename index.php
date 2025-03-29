<?php

/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

get_header();
the_post();

$awards = _theme_get_awards();

?>

<section id="hero" class="hero section dark-background">

	<div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

		<div class="carousel-item active">
			<?php if (has_post_thumbnail()) : ?>
				<img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
			<?php endif; ?>
			<div class="carousel-container">
				<h2><?php echo esc_html(get_the_title()); ?></h2>
				<?php echo wp_kses_post(get_the_content()); ?>
			</div>
		</div>
	</div>

</section>

<?php if (isset($awards['data'])) : ?>
	<section id="team" class="team section">

		<?php foreach ($awards['data'] as $award) : ?>
			<div class="container section-title" data-aos="fade-up">
				<div>
					<i class="fas fa-award"></i>
					<?php echo esc_html($award['title']); ?>
					<?php echo esc_html(" - {$award['date']}"); ?>
				</div>
				<h2><?php echo esc_html($award['description']); ?></h2>
			</div>

			<div class="container p-4">

				<?php foreach ($award['items'] as $item) : ?>
					<div class="container section-title" data-aos="fade-up">
						<div>
							<i class="fas fa-graduation-cap"></i>
							<span><?php echo esc_html($item['school']['name']); ?></span>
						</div>
						<h2>
							<a href="<?php echo esc_url($item['school']['map_location']); ?>" target="_blank" rel="noopener noreferrer">
								<i class="fas fa-map-marked"></i>
								<?php echo esc_html($item['school']['address']); ?>
							</a>
						</h2>
					</div>

					<?php if (isset($item['students']) && !empty($item['students'])) : ?>
						<div class="row gy-4">
							<?php foreach ($item['students'] as $student) :  ?>
								<div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
									<div class="member mb-4">
										<?php if (isset($student['image']) && !empty($student['image'])) : ?>
											<img src="<?php echo esc_url($student['image']); ?>" class="img-fluid">

										<?php else : ?>
											<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/default.webp" class="img-fluid">
										<?php endif; ?>
										<div class="member-info">
											<div class="member-info-content">
												<h4><?php echo esc_html($student['name']); ?></h4>
												<p><?php echo esc_html($student['grade']['name']); ?></p>
												<span>(<?php echo esc_html($student['shift']['name']); ?>)</span>

											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<br><br>
		<?php endforeach; ?>
	</section>
<?php else : ?>

	<div class="container section-title p-4" data-aos="fade-up">
		<h2>Sentimos muito</h2>
		<div><span>Nenhuma premiação encontrada no momento.</span></div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>