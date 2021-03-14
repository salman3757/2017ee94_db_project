<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php include('signup.css'); ?></style>
</head>

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
    <a href="home.php"><img id="img" src="../images/logo.jpg" alt="logo" height="200px" width="auto"></a>
  </div> 
<h1><!--cont.--></h1>
</header>


<div id="p2" class="strip">
<p><span class="p1">Registration</span></p>
</div>

<div id="c2">

<form id="sign" action="index.php" method="post">
<input type="hidden" name="action" value="signup">
<h2 style="font-size:1.5em">Sign Up</h2>

<ul>
<li><label for="form-name">First Name</label>   <input type="text"     name="firstname"  class="textinput"></li>
<li><label for="form-name">Last Name</label>    <input type="text"     name="latname"    class="textinput"></li>
<li><label for="form-email">Email</label>       <input type="email"    name="email"      class="textinput"></li>
<li><label for="form-password">Password</label> <input type="password" name="password1"  class="textinput"></li>
<li><label for="form-password">Re-Type</label>  <input type="password" name="password2"  class="textinput"></li>

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
