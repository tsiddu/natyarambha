<?php
include 'config.php';

$db_user = constant('db_user');
$db_password = constant('db_password');
$db_name = constant('db_name');
$db_host = constant('db_host');


$db = mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("Error " . mysqli_error($db));

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



//echo "i am inclided";
// $query = "SELECT * FROM  users";
// $result = mysqli_query($db,$query);

// foreach($result as $row)
// {	
	// echo $row['Username'];
// }


?>