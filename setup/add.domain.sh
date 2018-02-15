#!/usr/bin/env bash

if [[ -z $1 ]]; then
	echo "./add.domain.sh my.domain.local [IP]"
fi

if [[ -z $2 ]]; then
	2="127.0.0.1"
fi

cat >>$(brew --prefix)/etc/dnsmasq.conf <<EOL

address=/$1/$2

EOL

# start the service...
sudo brew services restart dnsmasq

# test that it is running...
dig "$1" "@$2"

