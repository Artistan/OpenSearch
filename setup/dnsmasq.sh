#!/usr/bin/env bash

brew install dnsmasq

mkdir -pv $(brew --prefix)/etc/

cat >$(brew --prefix)/etc/dnsmasq.conf <<EOL

# Add domains which you want to force to an IP address here.
# The example below send any host in *.local.company.com and *.lan to a local
# webserver.
address=/local.company.com/127.0.0.1
address=/lan/127.0.0.1

# Don't read /etc/resolv.conf or any other configuration files.
no-resolv
# Never forward plain names (without a dot or domain part)
domain-needed
# Never forward addresses in the non-routed address spaces.
bogus-priv

EOL

# start the service...
sudo brew services start dnsmasq

# test that it is running...
dig nested.test.local.company.com @127.0.0.1

