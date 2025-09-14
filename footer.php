<footer class="site-footer">
    <div class="footer-top">
        <div class="logo">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" class="logo-img" alt="Логотип">
            <?php endif; ?>
        </div>

        <nav class="footer-nav">
            <a href="#about">Про курс</a>
            <a href="#advantages">Переваги</a>
            <a href="#program">Шлях до знань</a>
            <a href="#reviews">Вiдгуки</a>
        </nav>

        <div class="footer-social">
            <a href="<?php echo get_option('zno_instagram_link', '#'); ?>" class="instagram1">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="<?php echo get_option('zno_phone_link', '#'); ?>" class="viber1">
                <i class="fas fa-phone"></i>
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="copyright">© ЗНО з iсторiї України</p>
        <a href="#" class="design">DESIGN: MYBURGERISNOTYOURS</a>
    </div>
</footer>
</div>

<div id="lessonPopupOverlay" class="popup-overlay">
    <div class="popup-container">
        <span class="popup-close">&times;</span>
        <h2>Запишiться на безкоштовний урок</h2>
        <form>
            <input type="text" name="name" placeholder="Iм'я" required>
            <input type="tel" name="phone" placeholder="Номер телефону" required>
            <button type="submit" class="popup-submit">Записатись</button>
        </form>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
