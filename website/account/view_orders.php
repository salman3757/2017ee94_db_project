



<!--  



 Under Dev.






-->




<nav>
<div id="nav">
  <ul>
    <li><a href="../index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="../products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
	<?php if(!isset($_SESSION['user'])){
		echo "<li><a href=\"index.php?action=view_signin\">Sign In</a></li>
		      <li><a href=\"index.php?action=view_signup\">Sign Up</a></li>";
		}
		elseif($admin)
		{
			echo "<li><a href=\"../admin/?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../admin/?action=signout\">Sign Out</a></li>";
		}
		else{
			echo "<li><a href=\"index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"index.php?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="../cart/">Cart</a></li>
	<li><a href="../admin/">Seller Area</a></li>
  </ul>
  </div>
  <div id="search"><form action="../search.php" method="post">
	     <input placeholder="Search Weapons..." id="search_bar" type="text" name="search_products">
		 <input id="search_btn" type="submit" value="Search"></form>
	</div>
</nav>