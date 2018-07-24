FROM 1and1internet/ubuntu-16-apache-php-7.1

# Setting dir properly
WORKDIR /var/www/html

# Exposing ports
EXPOSE 3306
EXPOSE 8080

RUN apt-get update -y && apt-get install php7.1-curl -y

# Apache Mods
RUN a2enmod headers && a2enmod rewrite
