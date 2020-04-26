#!/bin/bash

set -e

function disableXdebug() {
  if [ -f "/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini" ] ; then
    mv /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/docker-php-ext-xdebug.ini
  fi
}

function enableXdebug() {
  if [ -f "/usr/local/etc/docker-php-ext-xdebug.ini" ] ; then
    mv /usr/local/etc/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
  fi
}

function waitUntil() {

  local retry=0
  until "$@"  > /dev/null 2>&1 ; do
    sleep 1
    ((retry=retry+1))
    if [ $retry > 10 ] ; then
      break
    fi
  done

  until "$@"; do
    sleep 1
  done
}

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi


envsubst < /usr/local/etc/php/php-ini-directives.ini.template | sed "s~;\s*~\n~g"  > /usr/local/etc/php/conf.d/php-ini-directives.ini

if [ "$1" = 'php-fpm' ] || [[ "$1" =~ (vendor/)?bin/.* ]] || [ "$1" = 'composer' ]; then

	PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-production"
	if [ "$APP_ENV" != 'prod' ]; then
		PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-development"
	fi
	echo "Linking ${PHP_INI_RECOMMENDED} > ${PHP_INI_DIR}/php.ini"
	ln -sf "$PHP_INI_RECOMMENDED" "$PHP_INI_DIR/php.ini"

  disableXdebug
fi

if [ "$1" = 'php-fpm' ] ; then
    mkdir -p var/cache var/log
    >&2 echo "Setting file permissions..."
    setfacl -R -m u:www-data:rwX -m u:"$(whoami)":rwX var
    setfacl -dR -m u:www-data:rwX -m u:"$(whoami)":rwX var

    if [ "$APP_ENV" != 'prod' ]; then
        composer install --prefer-dist --no-progress --no-suggest --no-interaction
    fi

    >&2 echo "Waiting for db to be ready..."
    waitUntil bin/console doctrine:query:sql "SELECT 1"

    #bin/console ergonode:migrations:migrate --no-interaction --allow-no-migration

    >&2 echo "app initialization finished"
fi

if [ "$1" = 'php-fpm' ] || [[ "$1" =~ (vendor/)?bin/.* ]] || [ "$1" = 'composer' ]; then
  if [ "$APP_ENV" != 'prod' ]; then
    enableXdebug
  fi
fi

exec docker-php-entrypoint "$@"