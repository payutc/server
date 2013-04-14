#!/bin/bash

DIR="${1:-.}"
PATTERN="${2:-*.php}"
echo "DIR=$DIR"
echo "PATTERN=$PATTERN"

find $DIR -type d \( -path ./vendor -o -path ./.git \) -prune -o -iname "$PATTERN" -print -exec sed -i -e 's/[ \t]*$//' {} \;

