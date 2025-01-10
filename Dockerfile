# Usando a imagem base PHP com Apache
FROM php:8.1-apache

# Instalando a extensão PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Habilitar o módulo do Apache mod_rewrite (opcional, caso precise)
RUN a2enmod rewrite
