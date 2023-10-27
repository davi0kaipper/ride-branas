 FROM alpine:3.17 AS ext-build

 RUN echo "https://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories \
     && apk add --no-cache \
         build-base \
         curl-dev \
         openssl-dev \
         php82-dev \
         php82-openssl \
         php82-pear

 FROM alpine:3.17

 RUN echo "https://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories \
     && echo "https://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories \
     && apk add --no-cache \
         php82 \
         php82-bcmath \
         php82-ctype \
         php82-curl \
         php82-dom \
         php82-iconv \
         php82-mbstring \
         php82-openssl \
         php82-phar \
         php82-pdo \
         php82-pdo_mysql \
         php82-pdo_pgsql \
         php82-session \
         php82-simplexml \
         php82-tokenizer \
         php82-xml \
         php82-xsl \
     && ln -sf /usr/bin/php82 /usr/bin/php

 RUN apk add --no-cache \
       bash \
       curl \
       tzdata