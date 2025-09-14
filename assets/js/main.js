console.log("Тема My Course Theme підключена!");

document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('lessonPopupOverlay');
    const openBtn = document.querySelector('.cta-button');
    const closeBtn = document.querySelector('.popup-close');

    if (openBtn && overlay && closeBtn) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            overlay.style.display = 'block';
        });

        closeBtn.addEventListener('click', function() {
            overlay.style.display = 'none';
        });

        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.style.display = 'none';
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById("mobile-menu-toggle");
    const menu = document.getElementById("mobile-navigation");

    // додаємо хрестик
    const closeBtn = document.createElement("div");
    closeBtn.classList.add("menu-close");
    menu.appendChild(closeBtn);

    // Відкриття меню
    toggle.addEventListener("click", function() {
        menu.classList.add("active");
        toggle.style.display = "none"; // ховаємо бургер
        document.body.classList.add("menu-open"); // блокуємо скролл
    });

    // Закриття меню по хрестику
    closeBtn.addEventListener("click", function() {
        menu.classList.remove("active");
        toggle.style.display = "block"; // повертаємо бургер
        document.body.classList.remove("menu-open"); // повертаємо скролл
    });

    // Закриття меню при кліку на пункт
    const menuLinks = menu.querySelectorAll("a");
    menuLinks.forEach(link => {
        link.addEventListener("click", function() {
            menu.classList.remove("active");
            toggle.style.display = "block";
            document.body.classList.remove("menu-open");
        });
    });
});





