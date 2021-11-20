FROM redis:6.0-rc1-alpine AS scratch

ARG APP_ENV
ENV APP_ENV=${APP_ENV}

#COPY redis.conf /usr/local/etc/redis/redis.conf
#RUN echo 65535 > /proc/sys/net/core/somaxconn

FROM scratch as dev

FROM scratch as prod

CMD [ "redis-server", "/usr/local/etc/redis/redis.conf" ]