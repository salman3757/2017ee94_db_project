<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php 
session_start();
$id=$_SESSION['user']['id'];

include('account_view.css'); ?></style>
</head>

<?php 
	require_once('../../php/database.php');
    require_once('../../php/database_funcs.php');
?>

<?php if (isset($_SESSION['user']))
{
	$email=$_SESSION['user']['email'];
	$query="SELECT *
            FROM administrators
			WHERE email='$email'";
	$result=$db->query($query);
    $admin=$result->fetch(PDO::FETCH_BOTH);
	}
	
?>
<body>
<div id="container">
<header>
<nav>
<div id="nav">
  <ul>
    <li><a href="index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
	<?php if(!isset($_SESSION['user'])){
		echo "<li><a href=\"../../account/index.php?action=view_signin\">Sign In</a></li>
		      <li><a href=\"../../account/index.php?action=view_signup\">Sign Up</a></li>";
		}
		elseif($admin)
		{
			echo "<li><a href=\"../index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../index.php?action=signout\">Sign Out</a></li>";
		}
		else{
			echo "<li><a href=\"../index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../index.php?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="../../cart/">Cart</a></li>
	<li><a href="../index.php">Seller Area</a></li>
  </ul>
  </div>
  <div id="search"><form action="../../search.php" method="post">
	     <input placeholder="Search Weapons..." id="search_bar" type="text" name="search_products">
		 <input id="search_btn" type="submit" value="Search"></form>
	</div>
</nav> 

<div id="logo"> 
    <a href="../../index.php"><img id="img" src="../../images/logo.jpg" alt="logo" height="200px" width="auto"></a>
  </div> 
<h1><!--cont.--></h1>
</header>
<div id="p2" class="strip">
<p><span class="p1">STORE</span></p>
</div>

<div id="c2">
<div id="sign">


<?php
$name=$_GET['name'];
echo "<h1>".$name."</h2>";
$categories=get_categories();

$id=$_SESSION['user']['id'];

$products=get_products_by_admin($id);
?>
<div id=flex>
<div class="fi">
<h2>Categories</h2>
<?php
foreach($categories as $category)
{
	echo "<div class=\"item\">".$category['name']."</div>";
}
?>
</div>
<div class="fi">
<h2>Products</h2>
<?php
foreach($products as $product)
{
	echo "<div class=\"item\">".$product['name']."</div>";
}?>
</div>
</div>
<?php 
$id=$_SESSION['user']['id'];
$query="SELECT *
        FROM store
		WHERE administrator_id=$id";
$result=$db->query($query);
$store=$result->fetch(PDO::FETCH_ASSOC);
$storeid=$store['id'];
?>
<div id="btndiv">
<a href="index.php?action=manage_products&id=".<?php echo $storeid; ?>."" style="" id="btn">Manage Products</a>
</div>
<div id="btndiv">
<a href="index.php?action=manage_categories&id=".<?php echo $storeid; ?>."" style="" id="btn">Manage Categories</a>
</div>
</div>
<span style= "color:white;" ><pre>       Note that this page shows all the categories currently in the Database, regardless of which seller added them.
       However, the products shown are only those that you have added.</pre></span>
</div>


<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>