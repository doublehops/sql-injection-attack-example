<?php

    require 'functions.php';
    require 'config.php';

    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    $sql = "SELECT * FROM user WHERE username='$username' AND password=MD5('$password')";

    if ($username) {
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Rather than process login, we're just going to dump output for this example.
        $result = $stmt->fetch();
    
        if ($result) {
            echo "Welcome, ". $result['first_name'] ." ". $result['last_name'] .".";
            exit;
        } else {
            $flash = 'Incorrect username or password';
        }
    }

?>

<html lang="en">
    <head>
        <title>SQL Injection Example</title>
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    <body>
		<div class="container">
            <div class="steps">
                <h2>Step 4</h2>
		    	<h4>Open a waiting network service on your host machine</h4>
                <p>Open the network service on port 4444 using <a href="http://netcat.sourceforge.net/" target="_blank">netcat</a>.</p>
                <div class="code-block">
                    <h4>Command to run</h4>
                    <p>
                        nc -nlvp 4444
                    </p>
                </div>
            </div>
            <nav>
                <a href="step5.php" class="nav">Goto step 5</a>
            </nav>
        </div>

        <script>
            window.onload = function() {
              $('em.input').click(function() {
                str = $(this).html();
                $('#password-input').val(str);
              });
            }
        </script>

    </body>
</html>
