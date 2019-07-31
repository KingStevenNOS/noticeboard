<?php
session_start();
include_once("db.php");
if(!isset($_SESSION['admin'])&& $_SESSION['admin']!=1){
    header("Location: login.php");
    return;
}  
?>


<!DOCTYPE html>
<html>
<head>
    <title>Noticeboard!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div id="header">
            <p><h2>Welcome to the</h2></p><p><h1>NOTICEBOARD</h1></p>
        </div>
    </header>
    <?php      
    $sql = "SELECT * FROM notice_posts ORDER BY id ASC LIMIT 1";
    $result = mysqli_query($db,$sql) or die("error in connection" . mysqli_error($db));

    if(mysqli_num_rows($result)>0){
        while($currentrow = mysqli_fetch_assoc($result)){
             $id = $row['id'];
             $title = $row['title'];
             $notice_post = $row[çontent];
             $date = $row['date'];
             $admin = "<div><a href='delete.php?pid=$id'>Delete</a>;<a href='edit_posts.php?pid=$id'>Edit</a></div>";
             $post = "
                    <div><h2>$date</h2><br/><h1>$title</h1><p><h3>$notice_post</h3></p><div><br/><br/>$admin";
        }echo $post;
    }else{
        echo "There is no new announcement";
    }
    
    ?>
</body>
</html>