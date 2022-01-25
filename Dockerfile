FROM debian

RUN apt update && apt install php apache2 sqlite3 php-sqlite3 -y
RUN rm /var/www/html/index.html
COPY src /var/www/html/
RUN cat /var/www/html/install/tables.sql | sqlite3 /var/www/html/db.sqlite
RUN rm -rf /var/www/html/install/
RUN chown www-data:www-data -R /var/www/html/
RUN a2ensite default-ssl
RUN a2enmod ssl
RUN a2enmod rewrite
RUN a2dissite 000-default.conf
RUN sed 's/Listen 80//' -i /etc/apache2/ports.conf
RUN printf "<Directory /var/www/>\n AllowOverride all\n</Directory>\n" >> /etc/apache2/apache2.conf

ENTRYPOINT apachectl start && tail -f /var/log/apache2/access.log 
