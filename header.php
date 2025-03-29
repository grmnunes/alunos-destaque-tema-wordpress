<?php

/**
 * Template for displaying the header
 *
 * @package WordPress
 */

$uri = get_template_directory_uri();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?php echo esc_html(wp_title()); ?></title>

	<!-- Favicons -->
	<link href="<?php echo esc_url($uri); ?>/assets/images/ico/favicon.ico" rel="icon">
	<link href="<?php echo esc_url($uri); ?>/assets/images/ico/favicon.ico" rel="apple-touch-icon">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?php echo esc_url($uri); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo esc_url($uri); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?php echo esc_url($uri); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?php echo esc_url($uri); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<?php wp_head(); ?>
</head>

<body class="index-page">

	<header id="header" class="header d-flex align-items-center sticky-top">
		<div class="container-fluid container-xl position-relative d-flex align-items-center">

			<a href="<?php echo esc_url(home_url('/')); ?>" class="logo d-flex align-items-center me-auto">
				<?php if ($header_logo = get_field('header_logo', 'options')) : ?>
					<img src="<?php echo esc_url($header_logo); ?>">
				<?php else : ?>
					<h1 class="sitename"><?php echo esc_html(bloginfo('name')); ?></h1>
				<?php endif; ?>
			</a>
			<?php $main_menu = _theme_get_menu('main'); ?>
			<?php if (! empty($main_menu)) : ?>
				<nav id="navmenu" class="navmenu">
					<ul>
						<?php foreach ($main_menu as $item) : ?>
							<li>
								<a href="<?php echo esc_attr($item->url); ?>" target="<?php echo esc_html($item->target); ?>">
									<?php echo esc_html($item->title); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>
			<?php if ($featured_button = get_field('featured_button', 'options')) : ?>
				<a
					class="btn-getstarted"
					href="<?php echo esc_url($featured_button['url']); ?>"
					target="<?php echo esc_html($featured_button['target']); ?>">
					<?php echo esc_html($featured_button['title']); ?>
				</a>
			<?php endif; ?>
		</div>
	</header>