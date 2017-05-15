<?php
$parent = $_POST['parent'];
include 'db1.php';
$select_parent = "INSERT INTO `tags` (`id`, `name`, `level`, `parent`) VALUES ('', '$parent', '0', '');";
echo mysqli_query($db,$select_parent);

?>
