<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Stint+Ultra+Expanded" rel="stylesheet">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
@import url(search.css);
</style>
</head>

<body>
<div id="container">
<header>
<nav>
<div id="nav">
  <ul>
    <li><a href="" >Order Online</a></li>
    <li><a href="">Our Story</a></li>
	<li><a href="products.php">Armory</a><li>
	<li><a href="">Hours & Location</a><li>
    <li><a href="">Contact Us</a></li>
	<li><div id="search"><form action="" method="post">
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


<div id="p2" class="strip">
<p><span class="p1">Search Results</span></p>
</div>

<div id="c2">
<div id="categories">

<?php include('php/database_funcs.php');

$srch=$_POST['search_products'];
$products=search($srch);

foreach($products as $product)
{
	?> <div class="flexitem"> <?php echo "<br><a href="."product_detail.php?action=product_detail&product_id=".$product['id']. " class=\"btn\" style=\"color:black; \">".$product['name']."</a><br>";?></div><?php

}
?>
</div>
</div>
</div>

<footer>
<p><span id="footer">COPYRIGHT &copy; 2021, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>
