<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
// password_protected();

?>
<?php
if(isset($_GET['id']))
{  $searchQueryInput=$_GET['id'];
   global $connectionDB;
    $sql="UPDATE comment SET status='ON' WHERE id='$searchQueryInput'"; 
    $Execute=$connectionDB->query($sql);
    if($Execute)
    {
        $_SESSION['successMessage']="Comment approve successfully";
        redirectFunction("approveComment.php");
    }
    else{
        $_SESSION['errorMessage']="Something Went Wrong Please try again alter";
    }
    
}

?>