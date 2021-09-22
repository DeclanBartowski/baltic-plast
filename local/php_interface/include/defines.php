<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (SITE_ID == 's1') { // RU
    //Типы инфоблоков
    define('IBLOCK_CONTENT_TYPE', 'content');
    define('IBLOCK_ABOUT_TYPE', 'about');
    define('IBLOCK_COOPERATION_TYPE', 'cooperative');

    // ИНФОБЛОКИ
    define('IBLOCK_HELPFUL_INFORMATION_ID', 1); // Полезная информация

    define('IBLOCK_SOLUTIONS_ID', 2); // Каталог решений
    define('IBLOCK_CATALOG_ID', 3); // Каталог
    define('IBLOCK_SOLUTIONS_SLIDER_ID', 4); // Слайдер в каталоге решений

    define('IBLOCK_MAIN_SLIDER_ID', 5); // Слайдер на главной

    define('IBLOCK_ADVANTAGES_ID', 6); // Преимущества
    define('IBLOCK_ABOUT_SLIDER_ID', 7); // Слайдер "О нас"
    define('IBLOCK_WORK_PROCESS_ID', 8); // Процесс работы
    define('IBLOCK_ADVANTAGE_NUMBERS_ID', 9); // Преимущества в цифрах

    define('IBLOCK_COOPERATION_SLIDER_ID', 10); // Слайдер "Сотрудничество"
    define('IBLOCK_COOPERATION_SERVICES_ID', 11); // Предлжения

    define('FORM_SUCCESS_TEXT', "Спасибо, ваше сообщение принято.");
} elseif (SITE_ID == 's2') { // EN
    //Типы инфоблоков
    define('IBLOCK_CONTENT_TYPE', 'content_en');
    define('IBLOCK_ABOUT_TYPE', 'about_en');
    define('IBLOCK_COOPERATION_TYPE', 'cooperative_en');

    // ИНФОБЛОКИ
    define('IBLOCK_HELPFUL_INFORMATION_ID', 21); // Полезная информация

    define('IBLOCK_SOLUTIONS_ID', 19); // Каталог решений
    define('IBLOCK_CATALOG_ID', 17); // Каталог
    define('IBLOCK_SOLUTIONS_SLIDER_ID', 20); // Слайдер в каталоге решений

    define('IBLOCK_MAIN_SLIDER_ID', 18); // Слайдер на главной

    define('IBLOCK_ADVANTAGES_ID', 16); // Преимущества
    define('IBLOCK_ABOUT_SLIDER_ID', 14); // Слайдер "О нас"
    define('IBLOCK_WORK_PROCESS_ID', 15); // Процесс работы
    define('IBLOCK_ADVANTAGE_NUMBERS_ID', 13); // Преимущества в цифрах

    define('IBLOCK_COOPERATION_SLIDER_ID', 23); // Слайдер "Сотрудничество"
    define('IBLOCK_COOPERATION_SERVICES_ID', 22); // Предлжения
    define('FORM_SUCCESS_TEXT', "Thank you, your message has been received.");
} elseif (SITE_ID == 's3') { // PL
    //Типы инфоблоков
    define('IBLOCK_CONTENT_TYPE', 'content_pl');
    define('IBLOCK_ABOUT_TYPE', 'about_pl');
    define('IBLOCK_COOPERATION_TYPE', 'cooperative_pl');

    // ИНФОБЛОКИ
    define('IBLOCK_HELPFUL_INFORMATION_ID', 32); // Полезная информация

    define('IBLOCK_SOLUTIONS_ID', 30); // Каталог решений
    define('IBLOCK_CATALOG_ID', 28); // Каталог
    define('IBLOCK_SOLUTIONS_SLIDER_ID', 31); // Слайдер в каталоге решений

    define('IBLOCK_MAIN_SLIDER_ID', 29); // Слайдер на главной

    define('IBLOCK_ADVANTAGES_ID', 27); // Преимущества
    define('IBLOCK_ABOUT_SLIDER_ID', 25); // Слайдер "О нас"
    define('IBLOCK_WORK_PROCESS_ID', 26); // Процесс работы
    define('IBLOCK_ADVANTAGE_NUMBERS_ID', 24); // Преимущества в цифрах

    define('IBLOCK_COOPERATION_SLIDER_ID', 34); // Слайдер "Сотрудничество"
    define('IBLOCK_COOPERATION_SERVICES_ID', 33); // Предлжения
    define('FORM_SUCCESS_TEXT', "Dziękuję, Twoja wiadomość została odebrana.");
}

