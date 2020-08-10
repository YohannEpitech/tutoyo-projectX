FROM postgre

ENV TZ=Europe/Paris
ENV POSTGRES_PASSWORD Yobar92110
ENV POSTGRES_DB projectX
ENV POSTGRES_USER projectX

COPY projectx.sql /docker-entrypoint-initdb.d/projectx.sql

# RUN chmod -R 775 /docker-entrypoint-initdb.d

EXPOSE 5432
