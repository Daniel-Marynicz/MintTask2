#!/usr/bin/env bash

set -eo pipefail

. /usr/local/bin/common-functions.sh

if [[ -z "${app_test_user}" ]] ; then
  exit 0
fi

#escape string with double quotes
app_test_password=${app_test_password/\'/\'\'}


psql -v ON_ERROR_STOP=1 \
    --dbname "$db" \
    --username="$user" <<-EOSQL
    CREATE ROLE ${app_test_user} LOGIN  PASSWORD '${app_test_password}' CREATEDB;
EOSQL
