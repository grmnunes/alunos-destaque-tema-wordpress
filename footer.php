<?php

/**
 * Template for displaying the footer
 *
 * @package WordPress
 */

$uri = get_template_directory_uri();

?>

<footer id="footer" class="footer dark-background">

	<div class="container footer-top">
		<div class="row gy-4">
			<div class="col-lg-4 col-md-6 footer-about">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="logo d-flex align-items-center me-auto">
					<?php if ($footer_logo = get_field('footer_logo', 'options')) : ?>
						<img src="<?php echo esc_url($footer_logo); ?>">
					<?php else : ?>
						<h1 class="sitename"><?php echo esc_html(bloginfo('name')); ?></h1>
					<?php endif; ?>
				</a>
			</div>
		</div>
	</div>

	<?php if ($copy_text = get_field('copyright_text', 'options')) : ?>
		<div class="container copyright text-center mt-4">
			<p><?php echo esc_html(gmdate('Y')); ?> © <span><?php echo esc_html($copy_text); ?></span></p>
		</div>
	<?php endif; ?>

</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader">
	<div></div>
	<div></div>
	<div></div>
	<div></div>
</div>

<script src="<?php echo esc_url($uri); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo esc_url($uri); ?>/assets/vendor/aos/aos.js"></script>
<script src="<?php echo esc_url($uri); ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>

<?php wp_footer(); ?>

</body>

</html>