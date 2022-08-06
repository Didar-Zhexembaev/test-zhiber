FROM php:8.0-apache
RUN apt-get update && apt-get upgrade -y \
&& apt-get install git zip unzip -y \
&& apt-get install -y libpq-dev \
&& apt-get install -y gnupg \
&& docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
&& docker-php-ext-install pdo pdo_pgsql pgsql \
&& a2enmod rewrite
COPY default.conf /etc/apache2/sites-available/000-default.conf
COPY ports.conf /etc/apache2/ports.conf
# Install Composer
RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/local/bin --filename=composer
# Install Nodejs
RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash \
&& bash -c "source ~/.profile && nvm install node"