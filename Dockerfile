FROM php:8.4-apache

RUN apt-get update && apt-get install -y mc wget libpq-dev

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

# Установить зависимости для GD
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    && rm -rf /var/lib/apt/lists/*
# Настроить и установить GD
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp
RUN docker-php-ext-install -j$(nproc) gd

# настройки Apache
COPY ./docker/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Включаем модуль rewrite для Apache
RUN a2enmod rewrite

# Get latest Composer
# RUN curl -sS https://getcomposer.org/installer | php
# RUN mv composer.phar /usr/local/bin/composer
# Если composer не загружается, раскомментировать 2 строки ниже:
COPY docker/laravel9/composer.phar /usr/local/bin/composer
RUN chmod a+x /usr/local/bin/composer

# Опционально: настраиваем php.ini (если нужен кастомный конфиг)
COPY docker/8.4/php.ini /usr/local/etc/php/

# настройка прав пользователя
ARG USER_UID=1000
ARG USER_GID=1000
RUN groupadd --gid $USER_GID usergroup && \
    useradd --uid $USER_UID --gid $USER_GID --shell /bin/bash --create-home user

# Настройки MC
COPY docker/mc /root/.config/mc
COPY docker/mc /home/user/.config/mc

RUN echo "cd /var/www/html" >> /home/user/.profile