
<html>
<body>
<?php

	include('config.php');

	session_start();
   

	$dbname = 'WebsiteDatabase';
 
	$sql = "SHOW TABLES FROM $dbname	";
	$result = mysql_query($con, $sql);
 
	if (!$result) {
		echo "DB Error, could not list tables\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}

	echo "<table width=\"75%\" border=\"0\">";
	echo  "<tr bgcolor=\"#993333\"> ";
	echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"#FFFFFF\">Table name:</font></td>";
	echo  "</tr>”;

	for ($row = mysql_fetch_row($result);$row != false; $row = mysql_fetch_row($result)) {
        echo "<tr bgcolor=\"#CCCCCC\">";
		echo    "<td>";
        print "$row\n";
		echo    "</td>";
		echo "</tr>";
    }

	mysql_free_result($result);
?>
		</body>
		</html>