<?php
	define("db_host", "localhost");
	define("db_user", "root");
	define("db_name", "realsolve");
	define("db_passwowrd", "");

$dbc = mysqli_connect(db_host, db_user, db_passwowrd, db_name) or die ("Unable to connect to the database".mysqli_error());


?>