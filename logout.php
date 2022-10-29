<?php
require_once("function.php");
require_once("session.php");
?>
<?php
$_SESSION['username']=null;
session_destroy();
redirectFunction("login.php")

?>