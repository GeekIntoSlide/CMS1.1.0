<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
<?php
if(isset($_GET['id']))
{
global $connectionDB;
$searchQueryInput=$_GET['id'];
$sql="UPDATE comment SET status='OFF' WHERE id='$searchQueryInput'";
$Execute=$connectionDB->query($sql);
if($Execute)
{
    $_SESSION['successMessage']="delete Successfully";
    redirectFunction("approveComment.php");
}
else{
    $_SESSION['errorMessage']="Something Went Wrong Please try again alter";
}
}

?>