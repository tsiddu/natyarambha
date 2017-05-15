<?php

function showmsg($msg)
{
	$script = "<script>alert('".$msg."');</script>";
	echo $script;
}
?>