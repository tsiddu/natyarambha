<?php
$url_validater = 1;
session_start();
include 'db.php';
include 'functions.php'; 
$active_user = false; 	
if(isset($_SESSION['checker']))
{
	$name = $_SESSION['name'];
	$active_user = true;
	$user_access = $_SESSION['user_access'];

}

//phpinfo();
		
		$module="";
		$task="";
		if(isset($_GET['module'])){
			$module=$_GET['module'];
		}
		if(isset($_GET['task'])){
			$task = $_GET['task'];
			$moduleTask=$module."_".$_GET['task'];
		}
		if($module==''){
			$module=$defaultModule;
		}
		if($task==""){
			$moduleTask=$module."_".$defaultTask;
		}
		$path="modules/".$module."/".$module.".php";
		if(file_exists($path))
		{
			include $path;
			if(function_exists($moduleTask))
			{
				if(($active_user==TRUE))
				{
					if(($active_user==TRUE) and ($moduleTask=="users_login"))
					{
						include "template/header.php";
						include "template/leftmenu.php";
						echo "ur already loged in";
						include "template/footer.php";
					}
					else if(($active_user==TRUE) and ($moduleTask=="users_register"))
					{
						include "template/header.php";
						include "template/leftmenu.php";
						echo "already registered";
						include "template/footer.php";
					}
					/*
					else if(($user_type == 'normal') and (($adminmodule == 'aa') or ($adminmodule1 == 'aa1')))
					{
						header('location:  url ');
					}
					*/
					else{
						include "template/header.php";
						include "template/leftmenu.php";
						$moduleTask();
						include "template/footer.php";
					}

				}
				//user accessible function before login
				else if(($moduleTask=='home_user') or ($moduleTask=='home_home') or ($moduleTask=='home_plans') or 
						($moduleTask=='home_about') or ($moduleTask=='users_register') or ($moduleTask=='users_login') or ($moduleTask=='users_login_process') or ($moduleTask=='users_registration_process') or ($moduleTask=='users_get_password') or ($moduleTask=='users_chek_email_user') or ($moduleTask=='users_process_new_password_request'))
				{
					include "template/header.php";
					include "template/leftmenu.php";
					$moduleTask();
					include "template/footer.php";
				}
				else
				{
					include "template/header.php";
					include "template/leftmenu.php";
					if($module!="users"){include "modules/users/users.php";}
					users_login();
					showmsg("first login");
					include "template/footer.php";
				}
			}
			else{
				include "template/header.php";
				include "template/leftmenu.php";
				echo "Function not implemented";
				include "template/footer.php";
			}
		}
		else{
			include "template/header.php";
			include "template/leftmenu.php";
			echo "Module Not Found";
			include "template/footer.php";
		}


?>