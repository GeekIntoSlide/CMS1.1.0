<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
<?php
if(isset($_POST['submitPost']))
{
    $Image=$_FILES["Image"]["name"];
    $target="upload/".basename($_FILES["Image"]["name"]);
    $currentTime=time();
    $time=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
  if(empty($_POST['postTitle'])||empty($_POST['catDrop'])||empty($_POST['textArea']))
  {
    $_SESSION['errorMessage']="All filed must be fill";
    redirectFunction("post.php");
  }elseif (strlen($_POST['textArea'])>1000) {
    # code...
    $_SESSION['errorMessage']="Please upload post less than 1000 words ";
    redirectFunction("post.php");
  }
  else {
    # code...
    global $connectionDB;
    $sql="INSERT INTO post(datetime,title,category,image,post)";
    $sql.="VALUES(:datetime,:titlE,:categorY,:imagE,:posT)";
    $stmt=$connectionDB->prepare($sql);
    $stmt->bindValue(':titlE',$_POST['postTitle']);
    $stmt->bindValue(':datetime',$time);
    $stmt->bindValue(':categorY',$_POST['catDrop']);
    $stmt->bindValue(':imagE',$Image);
    $stmt->bindValue(':posT',$_POST['textArea']);
    // $stmt->bindValue(':authoR',$_POST['author']);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$target);
    $Execute=$stmt->execute();

    $_SESSION['successMessage']="Post upload successfully";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/63c877e653.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <h1>Globe.com</h1>
        </div>
        <div class="navItems">
            <ul>
                <li><i class="fa-regular fa-user"></i>My Profile</li>
                <li>Dashboard</li>
                <li>Category</li>
                <li>Blogs</li>
                <li>Manage Admin</li>
                <li>Comments</li>
                <li>Live Blog</li>
            </ul>
        </div>
        <div class="status">
            <p><i class="fa-solid fa-right-from-bracket"></i>Logout</p>
        </div>
        </div>
 
     <div class="header">
        <h1><i class="fa-sharp fa-solid fa-plus"></i><i class="fa-solid fa-arrows-to-eye"></i>Post</h1>
     </div>
     <?php
     echo errorMessage();
     echo successMessage();
     ?>
     <form action="post.php" method="post" enctype="multipart/form-data">
     <div class="manage">
        <h1>Add New Post</h1>
        <div class="addCat">
            <p>Post Title:</p>
            <input type="text" placeholder="Type your title" name="postTitle"/>
        </div>
        <div class="addCat">
            <p>Select Category:</p>
            <select class="drop" name="catDrop">
               <?php
               global $connectionDB;
               $sql="SELECT * FROM category";
               $stmt=$connectionDB->query($sql);
               while($DataRows=$stmt->fetch())
               {
                $id=$DataRows['id'];
                $title=$DataRows['title'];
               
               
               ?>
               <option><?php echo $title?></option>
               <?php } ?>

            </select>
        </div>
        <div class="addCat">
            <p>Select Image:</p>
            <input type="file" placeholder="Select from device" name="Image"/>
        </div>
        <div class="addCat">
            <p>Post Content:</p>
            <textarea rows="5" cols="80" name="textArea"></textarea>
        </div>
        <div class="manageBtn">
            <button type="submit"><i class="fa-solid fa-hand-back-point-left"></i>Go to dashboard</button>
            <button type="submit" name='submitPost'><i class="fa-solid fa-check"></i>Publish</button>
        </div>
     </div>
     </form>
</body>
</html>