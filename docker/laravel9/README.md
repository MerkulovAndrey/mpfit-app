<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Установка Laravel 9.52.21:
1)  Перейти в терминал контейнера Apache2
2)  Выполнить: cp /var/www/html/docker/laravel9/000-default.conf /etc/apache2/sites-enabled/000-default.conf
3)  Перезапустить контейнер Apache2
4)  Снова перейти в терминал контейнера Apache2
5)  Выполнить su - user
6)  Выполнить: /var/www/html/docker/laravel9/install
7)  Выполнить: composer install
8)  Настроить подключения к БД в .env (см. docker-compose.yml)
9)  Выполнить: ./artisan migrate
10) Выполнить: npm run dev

