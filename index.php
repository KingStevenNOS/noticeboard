<?php
session_start();
include_once("db.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Noticeboard!</title>
</head>
<body>
	<header>
		<div class="header">
			<p><h2>Welcome to the</h2></p><p><h1>NOTICEBOARD</h1></p>
		</div>
	</header>
	<div class="container"><?php
		$sql = "SELECT * FROM notice_posts ORDER BY id DESC LIMIT 1";
		$result = mysqli_query($db,$sql) or die("error in connection" . mysqli_error($db));

		if(mysqli_num_rows($result)>0){
			while($currentrow = mysqli_fetch_assoc($result)){
				$id = $currentrow['id'];
				$title = $currentrow['title'];
				$notice_post = $currentrow['content'];
				$date = $currentrow['date'];

				$post = "<div><h2>$date</h2><br/><h1>$title</h1><p><h3>$notice_post</h3></p><div>";
			}echo $post;
		}else{
			echo "There is no new announcement";
		}
		?>
	</div>
	<div>
        <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin']==1){
            echo "<a href='admin.php'>Admin</a> | <a href='post.php'>Post</a> | <a href='logout.php'>Logout</a>";
        }
        if (!isset($_SESSION['username'])){
            echo "<a href='login.php'>Login</a><br/>";
            echo "<a href='register.php'>Register</a><br/>";

        }
        if (isset($_SESSION['username']) && !isset($_SESSION['admin'])){
            echo "<a href='logout.php'>Logout</a>";
        }
        ?>
        	
	</div>
	</body>
</html>