FROM ubuntu:20.04

RUN apt update && \
    DEBIAN_FRONTEND=noninteractive apt -y install build-essential pkg-config autoconf bison re2c libxml2-dev libssl-dev libsqlite3-dev libcurl4-openssl-dev \
    libpng-dev libjpeg-dev libonig-dev libfreetype6-dev libxslt1-dev libzip-dev libtidy-dev git wget && \
    apt clean

RUN wget -qO- https://www.php.net/distributions/php-7.4.13.tar.gz | tar -xz

RUN cd php-7.4.13/ext && \
    wget https://pecl.php.net/get/parallel-1.1.4.tgz && \
    tar xf parallel-1.1.4.tgz

RUN cd php-7.4.13 && \
    ./buildconf --force && \
    ./configure --enable-maintainer-zts --enable-parallel && \
    make -j8 && \
    make install
