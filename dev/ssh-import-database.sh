#!/bin/bash

# Run shell script within vm as root user to use MySQL credentials in /root/.my.cnf.

ssh vagrant@192.168.30.99 -i .vagrant/machines/default/virtualbox/private_key '/var/www/dev/import-database.sh'
