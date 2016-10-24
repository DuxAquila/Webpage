<?php
error_reporting(E_ALL);
session_start();
include ('config.php');
if(isset($_GET['page'])) {
	$page=$_GET['page'];
	$page="pages/".$page;
} else {
	$page="pages/index";
}
if($page == "index"){
  if(isset($_SESSION['Closed'])){
	$Gesperrt = $_SESSION['Closed'];
  } else {
	$Gesperrt = "";
  }
  if($Gesperrt == "1"){
	$OutputDialog = "Ihr Account ist gesperrt";
  } else {
	  $OutputDialog = "";
  }
}
 

if($page == "view"){
  if($_SESSION['Closed'] == "1") {
	header('Location: index.php?page=index');
  }
  if(empty($_SESSION['user'])) {
	header('Location: index.php?page=index');
  }
}

if($page == "admin"){
  if(empty($_SESSION['user'])) {
	header('Location: index.php');
  }
  if($_SESSION['Admin'] <= "5") {
	header('Location: index.php');
  }
}
if($page == "login"){
  if($_SESSION['login'] == "True"){
    header('Location: index.php?page=index');
   }
}
main:
?>