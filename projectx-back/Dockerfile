FROM php:7.3

ENV TZ Europe/Paris
# Install Composer

RUN apt update \
  && apt install -y unzip zip mariadb-client libzip-dev --no-install-recommends\
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install zip \
  && docker-php-ext-install bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json  /usr/src/pokedex/
COPY composer.lock /usr/src/pokedex/
WORKDIR /usr/src/pokedex/
RUN composer install --no-scripts --no-autoloader
COPY . /usr/src/projectx-backend/

ENV DB_HOST=db
ENV DB_PORT=5432
ENV DB_DATABASE=projectX


RUN cp .env.example .env \
  && composer install \
  && php artisan cache:clear \
  && php artisan config:clear \
  && php artisan key:generate --ansi\
  && php artisan config:cache

CMD php artisan config:cache && php artisan serve --host 0.0.0.0


