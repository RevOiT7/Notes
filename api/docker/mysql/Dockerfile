ARG MYSQL_VERSION=5
FROM mysql:${MYSQL_VERSION}

RUN chown -R mysql:root /var/lib/mysql/

COPY my.cnf /etc/mysql/conf.d/my.cnf

CMD ["mysqld"]

EXPOSE 3306