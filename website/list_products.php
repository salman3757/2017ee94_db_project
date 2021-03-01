<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Stint+Ultra+Expanded" rel="stylesheet">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php 
include('list_products.css');
?>
</style>
</head>

<body>
<div id="container">
<header>
<nav>
<div id="nav">
  <ul>
    <li><a href="home.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
    <li><a href="">LOGIN / Register</a></li>
	<li><a href="">Cart</a></li>
	<li><div id="search"><form action="search.php" method="post">
	     <input placeholder="Search Weapons..." id="search_bar" type="text" name="search_products">
		 <input id="search_btn" type="submit" value="Search"></form>
	</div></li>

  </ul>
  </div>
</nav> 
<div id="logo"> 
    <a href="home.php"><img id="img" src="images/logo.jpg" alt="logo" height="200px" width="auto"></a>
  </div> 
<h1><!--Robust--></h1>
</header>

<?php include('php/database_funcs.php');

$id=$_GET['category_id'];
$category=get_category($id);
?>

<div id="p2" class="strip">
<p><span class="p1"><?php echo $category['name']."<br>"?></span></p>
<!-- <p><span class="p1">Products</span></p>-->
</div>
<div id="c2">
<div id="categories">
<?php
$products=get_products_by_category($id);

foreach($products as $product)
{
	 echo "<div class=\"fitem\"><br><a href="."product_detail.php?action=product_detail&product_id=".$product['id']. " class=\"btn\" style=\"color:black;\"><div class=\"f3\"><img src=\"images/".$product['code'].".jpg\"  height=\"200px\" width=\"auto\" ></div><br>".$product['name']."<br>$".$product['price']."</a><br></div>";

}
?>
</div>
</div>

<footer>
<p><span id="footer">COPYRIGHT &copy; 2021, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>
