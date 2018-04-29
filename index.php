<?php 
	$conn = new mysqli('localhost', 'root', 'pak1stan', 'dbphp');
	if(mysqli_connect_error()){
		die("Connection Error!!");
	}
	if(isset($_GET['add_stars']) AND isset($_GET['post_id'])){
		$id = (int)$_GET['post_id'];
		$stars = (int)$_GET['add_stars'];
		$query = $conn->query("INSERT INTO stars (user_id, post_id, stars) VALUES (1, {$id}, {$stars})");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}else{
		$result = $conn->query("SELECT post.*, count(stars.id) AS total, sum(stars.stars) AS stars FROM post LEFT JOIN stars ON post.id = stars.post_id GROUP BY post.id");
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
	<div class="row">
		<h2>Working Star Ratings for Bootstrap 3 <small>Hover and click on a star</small></h2>
	</div>
	<?php 
		while($post = $result->fetch_object()):
	?>
    <div class="media">
  <div class="media-left">
    <a href="#">
      <img class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNjMxMGRlM2E0NCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2MzEwZGUzYTQ0Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="...">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?php echo $post->postTitle; ?></h4>
        
        <p><?php echo $post->postBody; ?></p>
        <?php 
        	if($post->total > 0)
        		$total = $post->stars / $post->total;
        	else
        		$total = 0;
        ?>
        <div id="" class="stars-existing starrr" data-rating="<?php echo ceil($total); ?>"></div>
        You gave a rating of <span class="count-existing"><?php echo $total; ?></span> star(s)
        <input type="hidden" class="post_id" value="<?php echo $post->id; ?>" />
    
  </div>
</div>
<?php endwhile; ?>
</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="./script.js"></script>
	</body>
</html>