<?php

function zno_sanitize_text($value) {
    return sanitize_text_field($value);
}

function zno_sanitize_url($value) {
    return esc_url_raw($value);
}

function zno_sanitize_json($value) {
    $value = trim($value);
    if (empty($value)) return '';
    json_decode($value);
    return (json_last_error() === JSON_ERROR_NONE) ? $value : '';
}

add_action('admin_menu', function() {
    add_menu_page(
        'Налаштування сайту ZNO',
        'Налаштування ZNO',
        'manage_options',
        'zno-settings',
        'zno_settings_page_html',
        'dashicons-welcome-write-blog',
        20
    );
});

add_action('admin_init', function() {
    $fields = [
        // Хедер
        'zno_logo_url',
        'zno_logo_mobile_url',
        'zno_phone_link',
        'zno_telegram_link',

        // Соцмережі
        'zno_viber_link',
        'zno_instagram_link',

        // Hero
        'zno_hero_title',
        'zno_hero_button_text',
        'zno_hero_button_url',
        'zno_hero_image',

        // Про курс
        'zno_about_title',
        'zno_about_description',
        'zno_about_info_blocks',

        // Переваги
        'zno_advantages_title',
        'zno_advantages_items',

        // Відгуки
        'zno_reviews_title',
        'zno_reviews_items',

        // Програма (таймлайн)
        'zno_program_title',
        'zno_program_items',

        // Запрошення (відео)
        'zno_invite_title',
        'zno_invite_video',

        // Що входить до курсу
        'zno_course_inclusion_title',
        'zno_course_inclusion_items',

        // CTA
        'zno_cta_title',
        'zno_cta_description',
        'zno_cta_button_text',
        'zno_cta_button_url',

        // Футер
        'zno_footer_copyright',
        'zno_footer_design',
    ];

    foreach ($fields as $field) {
        register_setting('zno_settings_group', $field);
    }
});

function zno_enqueue_scripts() {
    wp_enqueue_script(
        'zno-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/main.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'zno_enqueue_scripts');

function zno_theme_enqueue_styles() {
    wp_enqueue_style(
        'zno-style',
        get_stylesheet_uri(),
        array(),
        time()
    );
}
add_action('wp_enqueue_scripts', 'zno_theme_enqueue_styles');

if (!function_exists('zno_get_embed_iframe')) {
    function zno_get_embed_iframe($input) {
        $input = trim((string) $input);
        if ($input === '') {
            return '';
        }

        if (preg_match('/<iframe[^>]+src=(["\'])(.*?)\1[^>]*><\/iframe>/i', $input, $m)) {
            $src = $m[2];
        } else {
            $src = $input;
        }

        $embed_src = '';

        if (filter_var($src, FILTER_VALIDATE_URL)) {
            $host = parse_url($src, PHP_URL_HOST) ?: '';
            $host = preg_replace('/^www\./', '', $host);
            $path = parse_url($src, PHP_URL_PATH) ?: '';
            $query = parse_url($src, PHP_URL_QUERY) ?: '';

            if (strpos($host, 'youtu') !== false) {
                if (strpos($host, 'youtu.be') !== false) {
                    $id = ltrim($path, '/');
                } elseif (strpos($path, '/embed/') === 0) {
                    $id = substr($path, strlen('/embed/'));
                } elseif (strpos($path, '/shorts/') === 0) {
                    $id = substr($path, strlen('/shorts/'));
                } else {
                    parse_str($query, $q);
                    $id = $q['v'] ?? '';
                }

                if (!empty($id)) {
                    $embed_src = 'https://www.youtube.com/embed/' . rawurlencode($id);
                }
            }
        } else {
            if (preg_match('/^[A-Za-z0-9_-]{6,}$/', $src)) {
                $embed_src = 'https://www.youtube.com/embed/' . rawurlencode($src);
            }
        }

        if (empty($embed_src)) {
            if (filter_var($src, FILTER_VALIDATE_URL)) {
                $embed_src = esc_url_raw($src);
            } else {
                return '';
            }
        }

        $iframe = '<iframe src="' . esc_url($embed_src) . '" title="YouTube video player" loading="lazy" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

        $allowed = array(
            'iframe' => array(
                'src' => array(),
                'title' => array(),
                'loading' => array(),
                'frameborder' => array(),
                'allow' => array(),
                'allowfullscreen' => array(),
                'width' => array(),
                'height' => array(),
                'style' => array(),
            ),
        );

        return wp_kses($iframe, $allowed);
    }
}

add_action('admin_head', function () {
    echo '
    <style>
        .zno-settings-wrap {
            max-width: 900px;
        }
        .zno-tab-buttons {
            margin-bottom: 20px;
        }
        .zno-tab-buttons button {
            background: #2271b1;
            color: #fff;
            border: none;
            padding: 8px 15px;
            margin-right: 5px;
            border-radius: 4px;
            cursor: pointer;
        }
        .zno-tab-buttons button.active {
            background: #135e96;
        }
        .zno-tab-content { display: none; }
        .zno-tab-content.active { display: block; }
        .zno-field {
            margin-bottom: 15px;
        }
        .zno-field label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .zno-field input[type=text],
        .zno-field textarea {
            width: 100%;
            padding: 7px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".zno-tab-buttons button");
        const tabs = document.querySelectorAll(".zno-tab-content");
        buttons.forEach(btn => {
            btn.addEventListener("click", () => {
                buttons.forEach(b => b.classList.remove("active"));
                tabs.forEach(t => t.classList.remove("active"));
                btn.classList.add("active");
                document.querySelector(btn.dataset.target).classList.add("active");
            });
        });
        if (buttons.length) buttons[0].click();
    });
    </script>
    ';
});

function zno_settings_page_html() {
    ?>
    <div class="wrap">
        <h1>Налаштування сайту ZNO</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('zno_settings_group');
            do_settings_sections('zno_settings_group');
            ?>

            <h2>Хедер</h2>
            <p>Логотип (URL): <input type="text" name="zno_logo_url" value="<?php echo esc_attr(get_option('zno_logo_url')); ?>" size="80"></p>
            <p>Логотип (мобільний, URL): <input type="text" name="zno_logo_mobile_url" value="<?php echo esc_attr(get_option('zno_logo_mobile_url')); ?>" size="80"></p>
            <p>Телефон: <input type="text" name="zno_phone_link" value="<?php echo esc_attr(get_option('zno_phone_link')); ?>" size="50"></p>
            <p>Telegram: <input type="text" name="zno_telegram_link" value="<?php echo esc_attr(get_option('zno_telegram_link')); ?>" size="50"></p>
            <hr>

            <h2>Соцмережі</h2>
            <p>Viber: <input type="text" name="zno_viber_link"
                             value="<?php echo esc_attr(get_option('zno_viber_link')); ?>" size="50"></p>
            <p>Instagram: <input type="text" name="zno_instagram_link"
                                 value="<?php echo esc_attr(get_option('zno_instagram_link')); ?>" size="50"></p>
            <hr>

            <h2>Головний банер</h2>
            <textarea name="zno_hero_title" rows="2" cols="80"><?php echo esc_textarea(get_option('zno_hero_title')); ?></textarea>
            <p>Текст кнопки: <input type="text" name="zno_hero_button_text" value="<?php echo esc_attr(get_option('zno_hero_button_text')); ?>" size="50"></p>
            <p>Посилання кнопки: <input type="text" name="zno_hero_button_url" value="<?php echo esc_attr(get_option('zno_hero_button_url')); ?>" size="50"></p>
            <p>URL фото: <input type="text" name="zno_hero_image" value="<?php echo esc_attr(get_option('zno_hero_image')); ?>" size="80"></p>
            <hr>

            <h2>Про курс</h2>
            <p>Заголовок: <input type="text" name="zno_about_title" value="<?php echo esc_attr(get_option('zno_about_title')); ?>" size="50"></p>
            <textarea name="zno_about_description" rows="4" cols="80"><?php echo esc_textarea(get_option('zno_about_description')); ?></textarea>
            <p>Інфоблоки (JSON):</p>
            <textarea name="zno_about_info_blocks" rows="6" cols="80"><?php echo esc_textarea(get_option('zno_about_info_blocks')); ?></textarea>
            <hr>

            <h2>Переваги</h2>
            <p>Заголовок: <input type="text" name="zno_advantages_title" value="<?php echo esc_attr(get_option('zno_advantages_title')); ?>" size="50"></p>
            <p>Елементи (JSON):</p>
            <textarea name="zno_advantages_items" rows="6" cols="80"><?php echo esc_textarea(get_option('zno_advantages_items')); ?></textarea>
            <hr>

            <h2>Відгуки</h2>
            <p>Заголовок: <input type="text" name="zno_reviews_title" value="<?php echo esc_attr(get_option('zno_reviews_title')); ?>" size="50"></p>
            <p>Відгуки (JSON):</p>
            <textarea name="zno_reviews_items" rows="6" cols="80"><?php echo esc_textarea(get_option('zno_reviews_items')); ?></textarea>
            <hr>

            <h2>Програма курсу</h2>
            <p>Заголовок: <input type="text" name="zno_program_title" value="<?php echo esc_attr(get_option('zno_program_title')); ?>" size="50"></p>
            <p>Етапи (JSON):</p>
            <textarea name="zno_program_items" rows="6" cols="80"><?php echo esc_textarea(get_option('zno_program_items')); ?></textarea>
            <hr>

            <h2>Запрошення</h2>
            <p>Заголовок: <input type="text" name="zno_invite_title" value="<?php echo esc_attr(get_option('zno_invite_title')); ?>" size="50"></p>
            <p>Посилання на відео / iframe:</p>
            <textarea name="zno_invite_video" rows="3" cols="80"><?php echo esc_textarea(get_option('zno_invite_video')); ?></textarea>
            <hr>

            <h2>Що входить до курсу</h2>
            <p>Заголовок: <input type="text" name="zno_course_inclusion_title" value="<?php echo esc_attr(get_option('zno_course_inclusion_title')); ?>" size="50"></p>
            <p>Елементи (JSON):</p>
            <textarea name="zno_course_inclusion_items" rows="6" cols="80"><?php echo esc_textarea(get_option('zno_course_inclusion_items')); ?></textarea>
            <hr>

            <h2>CTA секція</h2>
            <p>Заголовок: <input type="text" name="zno_cta_title" value="<?php echo esc_attr(get_option('zno_cta_title')); ?>" size="50"></p>
            <textarea name="zno_cta_description" rows="3" cols="80"><?php echo esc_textarea(get_option('zno_cta_description')); ?></textarea>
            <p>Текст кнопки: <input type="text" name="zno_cta_button_text" value="<?php echo esc_attr(get_option('zno_cta_button_text')); ?>" size="50"></p>
            <p>Посилання кнопки: <input type="text" name="zno_cta_button_url" value="<?php echo esc_attr(get_option('zno_cta_button_url')); ?>" size="50"></p>
            <hr>

            <h2>Футер</h2>
            <p>Копірайт: <input type="text" name="zno_footer_copyright" value="<?php echo esc_attr(get_option('zno_footer_copyright')); ?>" size="80"></p>
            <p>Дизайн: <input type="text" name="zno_footer_design" value="<?php echo esc_attr(get_option('zno_footer_design')); ?>" size="80"></p>
            <hr>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
