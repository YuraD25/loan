FROM php:8.3-fpm-alpine

# Установка системных зависимостей
RUN apk add --no-cache \
    --update linux-headers \
    bash \
    git \
    icu-dev \
    libzip-dev \
    postgresql-dev \
    $PHPIZE_DEPS # Зависимости для сборки расширений (gcc, make и т.д.)

# Установка расширений PHP
RUN docker-php-ext-install \
    intl \
    pdo \
    pdo_pgsql \
    zip

# --- Установка Xdebug (План C - Компиляция из исходников) ---
# Этот метод самый надежный, так как не зависит от доступности PECL.
RUN set -eux; \
    # Скачиваем исходный код конкретной стабильной версии
    wget -O xdebug.tgz https://xdebug.org/files/xdebug-3.3.2.tgz; \
    # Проверяем целостность файла (опционально, но рекомендуется)
    # echo "a35353348f76f485502e14581258e39910332e46906df03b34575894927d493a *xdebug.tgz" | sha256sum -c -; \
    # Распаковываем архив
    tar -zxvf xdebug.tgz; \
    # Переходим в созданную директорию
    cd xdebug-3.3.2; \
    # Готовим окружение для сборки расширения
    phpize; \
    # Конфигурируем сборку
    ./configure; \
    # Компилируем
    make; \
    # Устанавливаем скомпилированное расширение в систему
    make install; \
    # Возвращаемся в корневую директорию и удаляем временные файлы, чтобы уменьшить размер образа
    cd ..; \
    rm -rf xdebug-3.3.2 xdebug.tgz;

# Включаем расширение стандартным для Docker способом.
# Эта команда сама найдет xdebug.so и создаст нужный .ini файл.
RUN docker-php-ext-enable xdebug
# ----------------------------------------------------------------

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html

# Копируем наш кастомный файл конфигурации Xdebug
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Копируем код приложения
COPY . .

# Установка зависимостей Composer
RUN composer install --prefer-dist --no-scripts --no-progress --no-interaction

CMD ["php-fpm"]
EXPOSE 9000