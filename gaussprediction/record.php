<?php
session_start();
echo $_SESSION[$_POST['table']];
$_SESSION[$_POST['table']]=$_POST['uvalue'];
echo $_SESSION[$_POST['table']];
?>