# bagisto-docker/Dockerfile
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# --- Instala dependencias del sistema y extensiones de PHP ---
RUN apk update && apk add --no-cache \
    nginx \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    mariadb-client \
    nodejs \
    npm \
    php82-session
    # Estos son los comentarios de las dependencias que movimos
    # nginx: Servidor web
    # git: Para clonar repositorios si es necesario
    # unzip: Para descomprimir archivos
    # libzip-dev: Para la extensión ZIP de PHP
    # libpng-dev, libjpeg-turbo-dev, freetype-dev: Para la extensión GD (procesamiento de imágenes)
    # icu-dev: Para la extensión Intl
    # mariadb-client: Cliente MySQL (para conectar desde el contenedor)
    # nodejs, npm: Para la compilación de assets de Bagisto (Vite/Mix)
    # php82-session: Extensión de sesión para PHP (ajústala a tu versión de PHP, ej: php81-session)


# Configura y instala las extensiones de PHP necesarias para Laravel/Bagisto
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl

# --- Instala Composer (gestor de dependencias de PHP) ---
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# --- Configuración personalizada de PHP ---
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# --- Configuración de Nginx ---
RUN mkdir -p /etc/nginx/conf.d/
RUN rm -f /etc/nginx/conf.d/default.conf
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80 9000

CMD ["sh", "-c", "nginx && php-fpm"]