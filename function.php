<?php
require_once("db.php");

?>
<?php
function redirectFunction($location)
{
    header("location:".$location);
    exit;
}
function userExistOrNot($username)
{
 global $connectionDB;
 $sql="SELECT username FROM manageadmin WHERE username=:usernamE";
 $stmt=$connectionDB->prepare($sql);
 $stmt->bindValue(':usernamE',$username);
 $stmt->execute();
 $Result=$stmt->rowCount();
 if($Result==1)
 {
    return true;
 }
 else{
    return false;
 }
}
function loginByUser($username,$password)
{
   global $connectionDB;
   $sql="SELECT * FROM manageadmin WHERE username=:usernamE AND password=:passworD LIMIT 1";
   $stmt=$connectionDB->prepare($sql);
   $stmt->bindValue(':usernamE',$username);
   $stmt->bindValue(':passworD',$password);
   $stmt->execute();
   $result=$stmt->rowCount();
   if($result==1)
   {
       return $Found_Account=$stmt->fetch();
   }
   else{
       echo "bad";
   }
}
function password_protected()
{
   if(isset($_SESSION['UserId']))
   {
      return true;
   }
   else{
      $_SESSION['errorMessage']="Login required";
      redirectFunction("login.php");
   }
}
function totalPost()
{
   global $connectionDB;
   $sql="SELECT COUNT(*) FROM post";
   $stmt=$connectionDB->query($sql);
   $totalRow=$stmt->fetch();
   $totalPost=array_shift($totalRow);
   echo $totalPost;

}
function totalCategory()
{
   global $connectionDB;
   $sql="SELECT COUNT(*) FROM category";
   $stmt=$connectionDB->query($sql);
   $totalRow=$stmt->fetch();
   $totalCategory=array_shift($totalRow);
   echo $totalCategory;
}
function totalComment(){
   global $connectionDB;
   $sql="SELECT COUNT(*) FROM comment";
   $stmt=$connectionDB->query($sql);
   $totalRow=$stmt->fetch();
   $totalComment=array_shift($totalRow);
   echo $totalComment;
}
function totalAdmin()
{
   global $connectionDB;
   $sql="SELECT COUNT(*) FROM post";
   $stmt=$connectionDB->query($sql);
   $totalRow=$stmt->fetch();
   $totalAdmin=array_shift($totalRow);
   echo $totalAdmin;
}
?>