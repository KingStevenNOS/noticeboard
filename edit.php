<?php
session_start();
include_once("db.php");
if(!isset($_SESSION['username'])){
  header("Location: login.php");
  return;
}
if(!isset($_GET['pid'])){
  header("Location: index.php");
}

$pid = $_GET['pid'];
if(isset($_POST['update'])) {
    $title = strip_tags($_POST['title']);
    $content = strip_tags($_POST['content']);

    $title = mysqli_real_escape_string($db,$title);
    $content = mysqli_real_escape_string($db,$content);

    $date = date('l jS \of F Y h:i:s A');

    $sql = "UPDATE notice_posts (title, content) VALUES ('$title','$content')";

    if($title == "" || $content=="") {
      echo "Please Complete your Post!";
      return;
    }
    mysqli_query($db,$sql);
    
    header("Location: index.php");

}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Post</title>
  </head>
  <body>
    <?php
    $sql_get = "SELECT * FROM notice_posts WHERE id = '$pid'";
    $result = mysqli_query($db,$sql_get) or die(mysqli_errno($db));
    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)){
        $title = $row['title'];
        $content = $row['content'];
        echo "<form action='post.php?pid=$id' method='POST' enctype='multipart/form-data'>
                          <fieldset>
                              <LEGEND>Post your Content</LEGEND>
                            <input placeholder='title' name='title' type='text' autofocus size='48'>$title<br/><br/>
                            <textarea placeholder='content' name='content' rows='20' cols='50'>$content</textarea><br/>";
      }
    }
    ?>
            <input name="post" type="submit" value="Post">
          </fieldset>
      </form>
  
  </body>
</html> 