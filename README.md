SQL INJECTION ATTACK EXAMPLE
============================

This small project is a working example of setting up a website vulnerable to SQL injection with instructions
on how to exploit it to get shell access.

Setup Instructions
----------------------------

In order to setup locally, you will need Virtualbox, Vagrant and Ansible installed on your work machine.

```
// Clone the repository to your work machine.
# git clone git@github.com:doublehops/sql-injection-attack-example.git

// Change into the new directory download and run the virtual machine with:
# vagrant up

// Ensure you can ssh into the virtual machine:
# ssh vagrant@192.168.30.99 -i .vagrant/machines/default/virtualbox/private_key

// Use Ansible to provision (install the webserver, PHP, MariaDB/MYSQL) the box with the following:
# dev/provision.sh local_dev

// Import database schema and data into database:
# ssh vagrant@192.168.30.99 -i .vagrant/machines/default/virtualbox/private_key '/var/www/dev/import-database.sh'

// Load the webpage in your browser: http://192.168.30.99
```

Gain Access to Webserver with SQL Injection
-------------------------------------------

