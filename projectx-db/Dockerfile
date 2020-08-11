FROM postgres:9.4

ENV TZ=Europe/Paris
ENV POSTGRES_DB projectX
ENV POSTGRES_USER projectX

COPY projectx.sql /docker-entrypoint-initdb.d/projectx.sql

# RUN chmod -R 775 /docker-entrypoint-initdb.d

EXPOSE 5432
