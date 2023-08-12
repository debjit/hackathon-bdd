
# Fixed typos in the ARG variables NODE_VERSION and POSTGRES_VERSION
ARG NODE_VERSION=18
ARG POSTGRES_VERSION=15

# Removed double quotes from the ENV variables
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Asia/Kolkata

# Added missing dependencies for PHP and other packages
RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 dnsutils librsvg2-bin fswatch software-properties-common

# Added repository for PHP 8.2
RUN add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y php8.2-cli php8.2-dev \
       php8.2-pgsql php8.2-sqlite3 php8.2-gd php8.2-imagick \
       php8.2-curl \
       php8.2-imap php8.2-mysql php8.2-mbstring \
       php8.2-xml php8.2-zip php8.2-bcmath php8.2-soap \
       php8.2-intl php8.2-readline \
       php8.2-ldap \
       php8.2-msgpack php8.2-igbinary php8.2-redis php8.2-swoole \
       php8.2-memcached php8.2-pcov php8.2-xdebug

# Added installation of Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Added installation of Node.js and npm
RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Added installation of Yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /etc/apt/trusted.gpg.d/yarn.gpg >/dev/null \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends

 yarn# Installed MySQL client and PostgreSQL client
RUN apt-get install -y mysql-client \
    && apt-get install -y postgresql-client-$POSTGRES_VERSION

# Removed unnecessary cleanup commands
RUN apt-get clean

# Set the work directory
WORKDIR /var/www/html

# Set capabilities for PHP
RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.2

# Added user and group for the container
RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

# Copied start-container script and supervisord configuration
COPY docker/start-container /usr/local/bin/start-container
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Changed permission of the start-container script
RUN chmod +x /usr/local/bin/start-container

# Exposed the port container
EXPOSE 8000

# Added entrypoint for the container
ENTRYPOINT ["start-container"]
