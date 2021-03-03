<?php session_start();?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php include('account_view.css');

include('../php/database.php');
include('../php/customer_db.php'); ?></style>
</head>

<body>
<div id="container">
<header>
<nav>
<div id="nav">
  <ul>
    <li><a href="index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="../products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
	<li><a href="signup.php">SignUp</a></li>
	<li><a href="">Cart</a></li>
	<li><a href="">Seller Area</a></li>
  </ul>
  </div>
  <div id="search"><form action="search.php" method="post">
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
<p><span class="p1">Account</span></p>
</div>

<div id="c2">
<div id="sign">
<?php 
$fname=$_SESSION['user']['fname'];
$lname=$_SESSION['user']['lname'];
$email=$_SESSION['user']['email'];
$phone=$_SESSION['user']['phone'];

$id=$_SESSION['user']['id'];
$address=get_address($id);

$address_detail=$address['detail'];
$zip=$address['zip'];
$city=$address['city'];
$state=$address['state'];
?>
<table>
<tr>
<th>Name</th>
<td colspan="4"><?php echo $fname." ". $lname;?></td>
</tr>
<tr>
<th>Email</th>
<td colspan="4"><?php echo $email;?></td>
</tr>
<tr>
<th>Phone</th>
<td colspan="4"><?php echo $phone;?></td>
</tr>
<tr>
<th>Address</th>
<td><?php echo $address_detail;?></td>
<td><?php echo $city;?></td>
<td><?php echo $state;?></td>
<td><?php echo $zip;?></td>
</tr>
<tr>
<td colspan="5">
<a href="account_edit.php?id=<?php echo $id?>" style="border:2px solid black; color:orange; padding:0.2em;
      background-color:black; font-weight:bold;"> EDIT ACCOUNT</a></td></tr>
</table>
</div>
</div>





<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>