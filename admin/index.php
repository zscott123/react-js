<?php
	$page = "dashboard.php";
	$p = "dashboard";
	if(isset($_GET['p']))
	{
		$p = $_GET['p'];
		switch($p)
		{
			case "slideshow" : $page = "slideshow.php"; 
			break;
			case "product" : $page = "product.php";
			break;
			case "categories" : $page = "categories.php";
			break;
			case "brand" : $page = "brand.php";
			break;
			case "page" : $page = "page.php";
			break;
			case "user" : $page = "user.php";
			break;
			case "setting" : $page = "setting.php";
			break;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php" ?>
<body>
	<div class="wrapper">
		<?php include "include/nav.php" ?>
		<div class="main">
		<?php include "include/header.php" ?>

			<?php include "$page" ?>
			
<?php include "include/footer.php" ?>

		</div>
	</div>
<?php include "include/foot.php"?>
	

</body>

</html>