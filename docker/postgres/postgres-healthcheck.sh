#!/usr/bin/env bash

set -eo pipefail

. /usr/local/bin/common-functions.sh

export PGPASSWORD="${password}"

psql \
    --host="$host" \
    --username="$user" \
    --dbname="$db" \
    --quiet --no-align --tuples-only \
    --command "SELECT 1"
