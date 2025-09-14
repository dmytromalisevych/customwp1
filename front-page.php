<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="vintage-background">
    <?php get_header(); ?>
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">

                <!-- Ліва частина (текст + кнопка) -->
                <div class="hero-text">
                    <?php
                    $hero_title = get_option('zno_hero_title') ?: "МЕНЕ ЗВАТИ<br>МАРГАРИТА I Я -<br>ТВОЯ МАЙБУТНЯ<br>РЕПЕТИТОРКА З<br>IСТОРIї УКРАїНИ.";
                    ?>
                    <h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>

                    <?php
                    $button_url  = get_option('zno_hero_button_url') ?: '#';
                    $button_text = get_option('zno_hero_button_text') ?: 'Перший урок безкоштовно!';
                    ?>
                    <div class="hero-button-container">
                        <a href="<?php echo esc_url($button_url); ?>" class="cta-button">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>
                </div>

                <!-- Права частина (зображення) -->
                <div class="hero-image">
                    <div class="image-container">
                        <?php
                        $hero_image = get_option('zno_hero_image');
                        $hero_image = $hero_image ?: get_template_directory_uri() . '/assets/teacher1.png';
                        ?>
                        <img src="<?php echo esc_url($hero_image); ?>" alt="Репетиторка з історії" class="teacher-photo">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/flower.png" alt="Декор" class="decor-flower">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="about-section">
        <div class="container">
            <div class="section-content">
                <?php
                $default_title = 'Про курс';
                $default_description = 'Я знаю, як допомогти тобi впоратися зi всiма освiтнiми<br>труднощами та не втратити голову в гонитвi за вiдмiнними<br>результатами.<br>
            Я вiрю, що навчання може бути приємним! Пiзнавати iсторiю рiдної<br>держави, дiзнаватися про подвиги та бiди своїх пращурiв – наче<br>шукати скарб, захований у руїнах древнiх цивiлiзацiй.';

                $default_info_blocks = [
                    ['title' => 'Вмiст курсу – 70 урокiв', 'description' => ''],
                    ['title' => 'Тривалiсть курсу – 9 мiсяцiв', 'description' => ''],
                    ['title' => 'Як часто займатися? – 2 рази на тиждень по 1 годинi', 'description' => ''],
                    ['title' => 'Який вигляд матиме заняття?<br>– проведення iндивiдуальних лекцiй за власним графiком, або в групах до 10 осiб', 'description' => ''],
                    ['title' => 'Коли проходять заняття?<br>– за визначеним графiком', 'description' => ''],
                    ['title' => 'Вартiсть – 550 грн/мiсяць', 'description' => '']
                ];

                $title       = get_option('zno_about_title') ?: $default_title;
                $description = get_option('zno_about_description') ?: $default_description;

                $info_blocks_json = get_option('zno_about_info_blocks');
                $info_blocks = (!empty($info_blocks_json) && is_array(json_decode($info_blocks_json, true)))
                    ? json_decode($info_blocks_json, true)
                    : $default_info_blocks;
                ?>

                <h2 class="aboutsection-title"><?php echo esc_html($title); ?></h2>

                <div class="about-text">
                    <?php echo wpautop(wp_kses_post($description)); ?>
                </div>

                <div class="about-info-blocks">
                    <?php foreach ($info_blocks as $index => $block): ?>
                        <div class="info-block info-block-<?php echo $index + 1; ?>">
                            <h3 class="info-block-title"><?php echo wp_kses_post($block['title']); ?></h3>
                            <?php if (!empty($block['description'])): ?>
                                <p class="info-block-description"><?php echo wp_kses_post($block['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Декор -->
                <div class="about-decor decor-grid">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/grid.png" alt="">
                </div>
                <div class="about-decor decor-leaf">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/leaf.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="advantages" id="advantages">
        <div class="container">
            <?php
            $default_title = 'Переваги курсу';
            $default_advantages = [
                ['number' => '01', 'text' => 'Я говорю з учнем тiєю мовою, яку вiн почує. <span style="color: #f65912;">Жодних «офiцiозiв» та упереджень.</span>'],
                ['number' => '02', 'text' => 'Впродовж 3 рокiв я виточувала власну систему занять, котра справдi ДIЄ! Мої учнi не зазубрюють, <span style="color: #f65912;">вони – розумiють.</span>'],
                ['number' => '03', 'text' => 'Курс читається на групових заняттях, проте я завжди вiдкрита до дiалогу та без проблем проведу <span style="color: #f65912;">iндивiдуальнi заняття</span> тим, хто трохи вiдстав або прагне знати бiльше.'],
                ['number' => '04', 'text' => 'Моя програма складена на основi авторського пiдручника, який доповнить курс <span style="color: #f65912;">безоплатно!</span>'],
                ['number' => '05', 'text' => 'Година наших занять мине <span style="color: #f65912;">безболiсно:</span> з жартами, реальними прикладами та живим дiалогом.'],
                ['number' => '06', 'text' => 'Я завжди слiдкую за результатами учнiв та розумiю прагнення батьків бачити <span style="color: #f65912;">прогрес вiд занять зi мною.</span> Жоден онлайн-урок не проходить без домашньої роботи та її ретельної перевiрки!']
            ];

            function safe_html_output($text) {
                $allowed_tags = '<span><strong><em><u><mark><small>';
                return wp_kses($text, [
                    'span' => [
                        'style' => [],
                        'class' => [],
                        'id' => []
                    ],
                    'strong' => [],
                    'em' => [],
                    'u' => [],
                    'mark' => [],
                    'small' => []
                ]);
            }

            $title = get_option('zno_advantages_title');
            if (empty($title)) {
                $title = $default_title;
            }

            $advantages_json = get_option('zno_advantages_items');
            if (!empty($advantages_json)) {
                $advantages = json_decode($advantages_json, true);
                if (!is_array($advantages) || empty($advantages)) {
                    $advantages = $default_advantages;
                }
            } else {
                $advantages = $default_advantages;
            }
            ?>

            <h2 class="advantage-title"><?php echo esc_html($title); ?></h2>

            <div class="advantages-list">
                <?php foreach ($advantages as $adv): ?>
                    <div class="advantage-item">
                        <span class="advantage-number"><?php echo esc_html($adv['number']); ?></span>
                        <div class="advantage-content">
                            <p class="advantage-text"><?php echo safe_html_output($adv['text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <img src="<?php echo get_template_directory_uri(); ?>/assets/leaf1.png" alt="" class="leaf1">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/flower1.png" alt="" class="flower1">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/flower2.png" alt="" class="flower2">
    </section>



    <section id="reviews" class="reviews-section">
        <div class="container">
            <?php
            $default_title = 'Вiдгуки';
            $default_reviews = [
                [
                    'name' => 'АНЯ',
                    'score' => '186',
                    'text' => 'Маргарита досить уважна, знає свiй матерiал ну просто на зубок. Уроки проходять завжди вiдмiнно, а якщо менi щось незрозумiло, <span style="color: #f65912;">я можу завжди перепитати. Думається, а вона пояснить:</span> що? як? чому? В цiлому я дуже задоволена курсом!'
                ],
                [
                    'name' => 'СОФIЯ',
                    'score' => '178',
                    'text' => 'Маргарита – чудова репетиторка, вчить за своїми матерiалами та зрозумiло, часто з гумором викладає свiй предмет. Подобається те, що пiсля кожної пройденої теми даються <span style="color: #f65912;">тест на рiвень знання</span> пройденого навчального матерiалу, де твої неправильнi вiдповiдi не iгноруються, а повторно розбираються.'
                ],
                [
                    'name' => 'МАРIЯ',
                    'score' => '190',
                    'text' => 'Маргарита стала моєю першою репетиторкою, проте враження вiд урокiв приємнi! Працювати з нею легко, <span style="color: #f65912;">все зрозумiло та доступно, цiкаво.</span>'
                ],
                [
                    'name' => 'БОГДАН',
                    'score' => '195',
                    'text' => 'Мiцненько, добренько. <span style="color: #f65912;">Уроки ємнi, без зайвої iнформацiї</span>, але з цiкавими фактами. Особливо запам\'ятався розповідь про Олену Вiтер. Гарний бал я отримав через правильно розставленi акценти зi вчительської сторони.'
                ],
                [
                    'name' => 'НАСТЯ',
                    'score' => '184',
                    'text' => 'Маргарита чудово <span style="color: #f65912;">знаходить пiдхiд</span> до кожного учня та <span style="color: #f65912;">дає найпотрiбнiшу iнформацiю в цiкавому виглядi.</span> Її спосiб навчання допомiг менi краще засвоїти матерiал. Пам\'ятаю, як сидiла на iспитi та побачила портрет Сагайдачного, i в мене в головi пролунав голос Маргарити, який розповiдав, чим же таким важливим нам ця особа запам\'яталася.'
                ],
            ];

            function safe_html_output1($text) {
                return wp_kses($text, [
                    'span' => [
                        'style' => [],
                        'class' => [],
                        'id' => []
                    ],
                    'strong' => [],
                    'em' => [],
                    'u' => [],
                    'mark' => []
                ]);
            }

            $title = get_option('zno_reviews_title');
            if (empty($title)) {
                $title = $default_title;
            }

            $reviews_json = get_option('zno_reviews_items');
            if (!empty($reviews_json)) {
                $reviews = json_decode($reviews_json, true);
                if (!is_array($reviews) || empty($reviews)) {
                    $reviews = $default_reviews;
                }
            } else {
                $reviews = $default_reviews;
            }
            ?>

            <h2 class="review-title"><?php echo esc_html($title); ?></h2>
            <div class="about-decor decor-grid1">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/grid.png" alt="">
            </div>
            <div class="about-decor decor-leaf1">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/leaf.png" alt="">
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/flower1.png" alt="" class="flower1reviews">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/flower1.png" alt="" class="flower2reviews">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/flower2.png" alt="" class="flower3reviews">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/leaf1.png" alt="" class="leaf1review">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/flower3.png" alt="" class="flower3">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/flower3.png" alt="" class="flower4">
            <div class="reviews-wrapper">
                <?php foreach ($reviews as $index => $review): ?>
                    <div class="review-card review-<?php echo $index; ?>">
                        <div class="review-header">
                            <span class="student-name"><?php echo esc_html($review['name']); ?></span>,
                            <span class="student-score"><?php echo esc_html($review['score']); ?></span>
                        </div>
                        <div class="review-content">
                            <p class="review-text"><?php echo safe_html_output1($review['text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="program" class="program-section">
        <div class="container">
            <!-- Заголовок -->
            <div class="timesection-title">
                <div class="title-text">Шлях до знань</div>
            </div>

            <!-- Таймлайн -->
            <div class="timeline">
                <div class="timeline-line">
                    <div class="timeline-step">
                        <p>Реєстрацiя на сайтi курсу</p>
                    </div>
                    <div class="timeline-step">
                        <p>Перше безоплатне заняття</p>
                    </div>
                    <div class="timeline-step">
                        <p>Запис на пробний урок</p>
                    </div>
                    <div class="timeline-step">
                        <p>Оплата курсу</p>
                    </div>
                    <div class="timeline-step">
                        <p><strong>70</strong> годин лекцiй та практик</p>
                    </div>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/leaf1.png" alt="" class="leaf1timeline">
                <!-- Фінальне коло -->
                <div class="timeline-final">
                    <div class="circle-text">
                        Заслуженi <strong>190+</strong> балiв ЗНО!
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="invite" class="invite-section">
        <div class="container">
            <?php
            $default_title = 'ЗАПРОШУЮ ТЕБЕ ДО КУРСУ!';
            $default_video_option = 'https://www.youtube.com/embed/4NRXx6U8ABQ';

            $title = get_option('zno_invite_title');
            if (empty($title)) {
                $title = $default_title;
            }

            $video_option = get_option('zno_invite_video');
            if (empty($video_option)) {
                $video_option = $default_video_option;
            }

            $iframe_html = zno_get_embed_iframe($video_option);
            ?>

            <div class="invite-title">
                <h2><?php echo esc_html($title); ?></h2>
            </div>

            <div class="invite-video">
                <?php echo $iframe_html; ?>
            </div>
        </div>
    </section>

    <section id="course-inclusion" class="course-inclusion-section">
        <div class="container">
            <?php
            $default_title = 'Що входить до курсу?';
            $default_course_items = [
                [
                    'number' => '01',
                    'text' => '<span class="highlight">70 годин</span> найцiкавiших<br>вiдеолекцiй у групах.'
                ],
                [
                    'number' => '02',
                    'text' => 'Тестовi конспекти та<br>презентацiї <span class="highlight">до кожного уроку.</span>'
                ],
                [
                    'number' => '03',
                    'text' => '<span class="highlight">Швидкий фiдбек</span> до домашньої<br>роботи, мiнiконсультацiї у зручний<br>для учня час.'
                ],
                [
                    'number' => '04',
                    'text' => '<span class="highlight">Безплатнi мiнiкурси</span> для<br>запам\'ятовування дат, персоналiй,<br>архiтектури, творiв мистецтва та карт.'
                ],
                [
                    'number' => '05',
                    'text' => '<span class="highlight">Підтримка 24/7</span> та можливiсть<br>iндивiдуальних занять.'
                ],
                [
                    'number' => '06',
                    'text' => 'Авторський пiдручник <span class="highlight">у<br>подарунок.</span>'
                ],
                [
                    'number' => '07',
                    'text' => 'Гарний настрiй :)'
                ]
            ];

            function safe_course_html_output($text) {
                return wp_kses($text, [
                    'span' => [
                        'class' => ['highlight'],
                        'style' => []
                    ],
                    'strong' => [],
                    'em' => [],
                    'br' => []
                ]);
            }

            $title = get_option('zno_course_inclusion_title');
            if (empty($title)) {
                $title = $default_title;
            }

            $course_items_json = get_option('zno_course_inclusion_items');
            if (!empty($course_items_json)) {
                $course_items = json_decode($course_items_json, true);
                if (!is_array($course_items) || empty($course_items)) {
                    $course_items = $default_course_items;
                }
            } else {
                $course_items = $default_course_items;
            }
            ?>

            <h2 class="course-title"><?php echo esc_html($title); ?></h2>

            <div class="course-papers">
                <div class="course-paper course-paper-one">
                    <div class="course-grid">
                        <?php
                        $first_items = array_slice($course_items, 0, 3);
                        foreach ($first_items as $item): ?>
                            <div class="course-item">
                                <div class="course-number"><?php echo esc_html($item['number']); ?></div>
                                <div class="course-content">
                                    <p><?php echo safe_course_html_output($item['text']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/leaf.png" alt="" class="leaf1program">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/flower1program.png" alt="" class="flower1program">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/flower2program.png" alt="" class="flower2program">
                <div class="course-paper course-paper-2">
                    <div class="course-grid">
                        <?php
                        $second_items = array_slice($course_items, 3, 4);
                        foreach ($second_items as $item): ?>
                            <div class="course-item">
                                <div class="course-number"><?php echo esc_html($item['number']); ?></div>
                                <div class="course-content">
                                    <p><?php echo safe_course_html_output($item['text']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="decorative-plant"></div>
        </div>
    </section>
    <?php get_footer(); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>