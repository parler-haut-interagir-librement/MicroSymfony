# The development image of compose.yaml: FrankenPHP on PHP 8.5, with the extensions the application uses.
# It is for working on the application on a workstation, not a production image: each site keeps its own deployment.
FROM dunglas/frankenphp:1-php8.5

RUN install-php-extensions @composer apcu intl opcache zip

# The settings of development: errors shown, the timestamps of OPcache checked so that an edited file is read again.
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /app
