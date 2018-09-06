FROM pongsak/centos-phpfpm-nginx-lumen:2.0

WORKDIR /var/www/html

COPY ./project .

CMD pwd && ls -lah ; \
    rm -f /var/www/html/composer.lock ; \
    rm -f ./.gitignore ; \ 
    composer install; \
    chmod -R 777 /var/www/html/storage ; \
    pwd && ls -lah; \
    supervisord -n

# Set the port to 80 
EXPOSE 80

# Executing supervisord
# CMD ["supervisord" , "-n"]
