<?php session_start();?>

<?php 
	require_once('../php/database.php');
    require_once('../php/admin_db.php');
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php include('account_view.css');
?></style>
</head>
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
    <li><a href="../index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="../products.php">Armory</a></li>
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
<p><span class="p1">Administrator Account</span></p>
</div>

<div id="c2">
<div id="sign">
<?php 
$fname=$_SESSION['user']['fname'];
$lname=$_SESSION['user']['lname'];
$email=$_SESSION['user']['email'];

$id=$_SESSION['user']['id'];

?>
<table id="tbl">
<tr>
<th>Name</th>
<td colspan="4"><?php echo $fname." ". $lname;?></td>
</tr>
<tr>
<th>Email</th>
<td colspan="4"><?php echo $email;?></td>
</tr>
<tr>
<tr>
<td colspan="5">
<a href="account_edit.php?id=<?php echo $id?>" style="border:2px solid black; color:orange; padding:0.2em;
      background-color:black; font-weight:bold;"> EDIT ACCOUNT</a></td></tr>
</table>
<?php 
$id=$_SESSION['user']['id'];
$store=get_store($id);

if($store)
{
	$name=$store['name'];
	?> <div id="store"><?php echo "Your Store : <a href=\"store/index.php?action=show&name=".$name."\"><div id=\"btn\" class=\"btnn\">".$name."</div></a></div>";
}
else
{
	echo "<div id=\"msg\"><p>You Don't Have a Store yet. Create One to get started.</p>
	       <p><a href=\"store/index.php?action=show_create_form\" style=\"border:2px solid black; color:orange; padding:0.2em;
      background-color:black; font-weight:bold;\">Create Store</a></p></div>";
}
?>
</div>
</div>





<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>
