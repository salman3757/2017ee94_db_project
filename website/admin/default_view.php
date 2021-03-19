<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php include('signin.css'); ?></style>
</head>

<?php 
	require_once('../php/database.php');
    require_once('../php/admin_db.php');
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
		echo "<li><a href=\"../account/?action=view_signin\">Sign In</a></li>
		      <li><a href=\"../account/?action=view_signup\">Sign Up</a></li>";
		}
		elseif($admin)
		{
			echo "<li><a href=\"index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"index.php?action=signout\">Sign Out</a></li>";
		}
		else{
			echo "<li><a href=\"../account/index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../account/?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="../cart/">Cart</a></li>
	<li><a href="index.php">Seller Area</a></li>
  </ul>
  </div>
  <div id="search"><form action="../search.php" method="post">
	     <input placeholder="Search Weapons..." id="search_bar" type="text" name="search_products">
		 <input id="search_btn" type="submit" value="Search"></form>
	</div>
</nav> 

<div id="logo"> 
    <a href="../index.php"><img id="img" src="../images/logo.jpg" alt="logo" height="200px" width="auto"></a>
  </div> 
<h1><!--cont.--></h1>
</header>


<div id="p2" class="strip">
<p><span class="p1">ADMINISTRATORS</span></p>
</div>

<div id="c2">

<form id="sign" action="index.php" method="post">

<h2 style="font-size:1.5em">Sign In</h2>
<ul>
<input type="hidden" name="action" value="view_signin">
<li class="buttons"><input id="btn" type="submit" value="Sign In"></li>

</ul>

</form>

<form id="sign" action="index.php" method="post">

<h2 style="font-size:1.5em">Sign Up</h2>

<ul>
<input type="hidden" name="action" value="view_signup">
<li class="buttons"><input id="btn" type="submit" value="Sign Up"></li>

</ul>

</form>

</div>





<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>