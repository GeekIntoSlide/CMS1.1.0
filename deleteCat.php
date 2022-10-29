<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
<?php
if(isset($_GET['id']))
{
    $searchQueryInput=$_GET['id'];
    global $connectionDB;
    $sql="DELETE FROM category WHERE id='$searchQueryInput'";
    $Execute=$connectionDB->query($sql);
    if($Execute)
    {
        $_SESSION['successMessage']="delete Successfully";
        redirectFunction("category.php");
    }
    else{
        $_SESSION['errorMessage']="Something Went Wrong Please try again alter";
    }
}


?>