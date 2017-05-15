<?php
$parent = $_POST['parent'];
$child = $_POST['child'];
include 'db1.php';
$select_parent = "INSERT INTO `tags` (`id`, `name`, `level`, `parent`) VALUES ('', '$child', '1', '$parent');";
echo mysqli_query($db,$select_parent);

?>
