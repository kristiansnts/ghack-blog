<?php 

require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//Get Heroku ClearDB connection information
$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server   = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db       = substr($cleardb_url["path"],1);

echo '<pre>';
print_r($cleardb_url);
echo '</pre>';

$connect = mysqli_connect(
	$cleardb_server,
	$cleardb_username,
	$cleardb_password,
	$cleardb_db  ) or die(mysqli_error($connect));


/*
$db = NewADOConnection('mysqli');
$db->Connect(
	$cleardb_server,
	$cleardb_username,
	$cleardb_password,
	$cleardb_db);
	
// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

// Use UTF-8
$db->EXECUTE("set names 'utf8'"); 
*/

$sql = mysqli_query($connect, "SELECT * FROM `raffles-pdf` LIMIT 10");
$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

echo "<b>First 10 row</b><br />";

// $result = $db->Execute($sql);
if ($result == false) die("failed [" . __LINE__ . "]: " . $sql);

while (!$result->EOF) 
{
	echo $result->fields['pdf'] . "<br />";

	$result->MoveNext();
}

 ?>
 
