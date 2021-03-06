# Разработка API (catalog) на фреймворке Laravel

## Описание задачи

Необходимо написать простейшее API для каталога товаров. Приложение должно содержать:
- Категории товаров
- Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)
- Пользователей, которые могут авторизоваться (авторизация через jwt- токены)

Возможные действия:
- Получение списка всех категорий
- Получение списка товаров в конкретной категории
- Авторизация пользователей
- Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
- Добавление/Редактирование/Удаление товара (для авторизованных пользователей)

## Технические требования
1. Приложение должно быть написано на PHP
2. Результаты запросов должны быть представлены в формате JSON
4. Результат задания должен быть ввиде merge request на этот репозиторий в github, должна быть инструкция по запуску проекта. Также необходимо пояснить, сколько на каждую часть проекта ушло времени

## Доп. задачи (опционально выбрать две задачи из списка)
- Добавить email верификацию при регистрации
- Добавить фильтры к товарам (цвет, вес, цена и тд), и реализовать метод получение товара по фильтру
- Добавить сущность тэгов к товарам и категориям, написать методы для вывода тэгов по товарам и категориям
- Добавить роли (админ, модератор, пользователь) и на все методы с операциями добавление/редактирование/удаление поставить валидацию ролей админа и модератора

## Критерии оценки
- Архитектурная организация API
- Грамотное применение ООП и паттернов проектирования
- Корректная обработка внештатных ситуаций
- Код-стайл и соблюдение стандартов

## Полезные материалы
- [Документация Laravel](https://laravel.com/docs/5.7/ "Документация Laravel") рекомендую читать его как книгу:)
- Для авторизации можно использовать встроенный [Laravel Passport](https://laravel.com/docs/5.7/passport "Laravel Passport") или более простой пакет [jwt-auth](https://github.com/tymondesigns/jwt-auth "jwt-auth")
- Всякие ништяки по Laravel от [ru community](https://github.com/LaravelRUS/awesome-laravel-rus "ru community")
- Аналогичный источник от [en community](https://github.com/chiraggude/awesome-laravel "en community")
- [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices "Laravel Best Practices") must read для каждого разработчика
