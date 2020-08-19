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

RUN groupadd -g 1000 user \
  && useradd -m -u 1000 -g 1000 user
COPY composer.json  /usr/src/projectx-backend/
COPY composer.lock /usr/src/projectx-backend/
WORKDIR /usr/src/projectx-backend/
RUN composer install --no-scripts --no-autoloader
COPY . /usr/src/projectx-backend/

ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=projectx
ENV DB_USERNAME=projectx

ENV DB_PASSWORD=password



RUN cp .env.example .env \
  && composer install \
  && php artisan cache:clear \
  && php artisan config:clear \
  && php artisan key:generate --ansi\
  && php artisan config:cache

CMD php artisan config:cache && php artisan serve --host 0.0.0.0


