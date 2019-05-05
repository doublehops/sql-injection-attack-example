#!/bin/bash

# Import (as root) database schema and data into MySQL database.

sudo mysql proj < /var/www/dump/user.sql
sudo mysql proj < /var/www/dump/contact.sql
