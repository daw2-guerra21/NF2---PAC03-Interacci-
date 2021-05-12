<?php

//fetch_user.php

include('database_connection.php');
include('usernameTable.php');

session_start();

$query = "
SELECT * FROM login 
WHERE user_id != '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$usernameTable = new table();
$usernameTable->setTable($result, $connect);

?>