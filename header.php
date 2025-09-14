<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            <div class="logo-img">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" class="logo-img" alt="Логотип">
                <?php endif; ?>
            </div>

            <nav class="main-navigation">
                <ul class="nav-menu">
                    <li><a href="#about">Про курс</a></li>
                    <li><a href="#advantages">Переваги</a></li>
                    <li><a href="#program">Шлях до знань</a></li>
                    <li><a href="#reviews">Вiдгуки</a></li>
                </ul>
            </nav>

            <div class="social-links">
                <a href="<?php echo get_option('zno_viber_link', '+380937939371'); ?>" class="viber">
                    <i class="fab fa-viber"></i>
                </a>
                <a href="<?php echo get_option('zno_instagram_link', 'https://www.instagram.com/zno.z.history.ua/'); ?>" class="instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>

            <div class="menu-toggle" id="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <div class="logo mobile-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Лого мобільне">
    </div>

    <nav class="mobile-navigation" id="mobile-navigation">
        <ul>
            <li><a href="#about">Про курс</a></li>
            <li><a href="#advantages">Переваги</a></li>
            <li><a href="#program">Шлях до знань</a></li>
            <li><a href="#reviews">Вiдгуки</a></li>
        </ul>
        <div class="mobile-social-links">
            <a href="<?php echo get_option('zno_viber_link', '#'); ?>" class="viber">
                <i class="fab fa-viber"></i>
            </a>
            <a href="<?php echo get_option('zno_instagram_link', 'https://www.instagram.com/zno.z.history.ua/'); ?>" class="instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="<?php echo get_option('zno_telegram_link', '#'); ?>" class="telegram">
                <i class="fab fa-telegram"></i>
            </a>
        </div>
    </nav>
</header>
