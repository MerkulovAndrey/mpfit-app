<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Тестовое задание PHP + Laravel9 + Mysql (Фронтэнд не оценивался)
Ведение товаров в категориях, формирование заказов.

Сборка
Выполнить: ./var/www/html/build
Для удобства в контейнер Apache установлен MC.

Установка Laravel 9.52.21:
1)  Перейти в терминал контейнера Apache2
2)  Выполнить: cp /var/www/html/docker/laravel9/000-default.conf /etc/apache2/sites-enabled/000-default.conf
3)  Перезапустить контейнер Apache2
4)  Снова перейти в терминал контейнера Apache2
5)  Выполнить su - user
6)  Выполнить: /var/www/html/docker/laravel9/install
7)  Выполнить: composer install
8)  Перелогинитьcя пользователем user
9)  Скопировать .env.example в .env
10) Выполнить: ./artisan migrate
11) Выполнить: npm run dev

Функционал приложения:

1 Управление товарами:
Добавление, редактирование, удаление и просмотр товаров.
Просмотр списка товаров с сокращенной информацией (например, название, цена, категория).
Просмотр полной информации о товаре.

2 Управление заказами:
Добавление заказа с возможностью добавления одного наименования товара в количестве 1 штуки или больше.
Заказ должен содержать:
ФИО покупателя (обязательное поле)
Дату создания (обязательное поле)
Статус заказа (новый или выполнен; по умолчанию новый).
Комментарий покупателя

Просмотр списка заказов с отображением:
Номера заказа (ID)
Даты создания
ФИО покупателя
Статуса заказа
Итоговой цены.

Просмотр заказа (с полной информацией о заказе) с возможностью изменить статус на "выполнен" через кнопку.

3 Категории для товаров:

Создание миграции для таблицы categories, которая должна содержать следующую информацию:
ID (первичный ключ)
Название (строка)

Создайте с помощью миграции таблицу categories и заполните ее следующими данными: легкий, хрупкий, тяжелый.

Связи между таблицами:

Товары должны быть привязаны к категориям (один ко многим).
В заказе может быть только один товар (одно наименование) (один ко многим).

Требования к товарам:

Каждый товар должен иметь:
Название (обязательное поле)
Категорию (товар должен быть обязательно привязан к одной категории)
Описание
Цена (валюта - рубли, копейки должны учитываться) (обязательное поле).

Функциональные требования:

Обеспечьте возможность управления товарами и заказами через веб-интерфейс.
Используйте валидацию данных при создании/редактировании.
