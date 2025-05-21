FROM php:8.3-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev libonig-dev zip unzip git \
    && docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto para o container
COPY . .

# Definir permissões para o diretório de cache e logs
RUN chmod -R 777 var/cache var/log

RUN chmod -R 655 config/jwt

# Instalar dependências do Symfony
RUN composer install --optimize-autoloader

# Expor a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]