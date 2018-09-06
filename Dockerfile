FROM pongsak/centos-phpfpm-nginx-lumen:2.0

MAINTAINER "Pongsak Prabparn" <pongsak@rebatemango.com>

WORKDIR /var/www/html

COPY ./project .

RUN rm -rf ./composer.lock

RUN composer install

RUN chmod -R 777 ./storage


RUN cp -R .env.example  .env

# Set the port to 80 
EXPOSE 80

# Executing supervisord
CMD ["supervisord" , "-n"]
