

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

include('admin.css'); ?>
</style>


<?php 
	require_once('../../php/database.php');
    require_once('../../php/admin_db.php');
    require_once('../../php/database_funcs.php');
?>


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
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
    <li><a href="../../index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="../../products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
	<?php if(!isset($_SESSION['user'])){
		echo "<li><a href=\"../index.php?action=view_signin\">Sign In</a></li>
		      <li><a href=\"../index.php?action=view_signup\">Sign Up</a></li>";
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
</header><div id="p2" class="strip">
<p><span class="p1">Product Manager</span></p>
</div>

<div id="c2">
<div id="signn">


<div id="flex">
<div class="fitem">
<h3>ADD PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="add">
<label>Name        :</label>
<input type="text" name="name"><br>
<label>Code        :</label>
<input type="text" name="code"><br>
<label>Description :</label>
<input type="text" name="description"><br>
<label>Price       :</label>
<input type="text" name="price"><br>
<label>Category id :</label>
<select name="categoryid">
<?php
$categories=get_categories();
foreach ($categories as $category) 
{
	echo "<option value=\"".$category['id']."\">".$category['id']."</option>";
}
?>
</select><input class="btn" type="submit" value="ADD"><br>
</form>
<p style=" margin-top:0px; font-family: Century Gothic;
color: black; background-color:orange; position:relative; top:140px; ">
scroll down to see Output Display.</p>
</div>

<div class="fitem">
<h3>UPDATE PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="update">
<label>Enter Current ID          :</label><br>
<input type="text" name="id"><br>
<label>ENTER " NEW Name "        :</label>
<input type="text" name="name"><br>
<label>ENTER " NEW Code "        :</label>
<input type="text" name="code"><br>
<label>ENTER " NEW Description " :</label>
<input type="text" name="description"><br>
<label>ENTER " NEW Price "       :</label>
<input type="text" name="price"><br>
<label>ENTER " NEW Category id " :</label>
<select name="categoryid">
<?php
$categories=get_categories();
foreach ($categories as $category) 
{
	echo "<option value=\"".$category['id']."\">".$category['id']."</option>";
}
?>
</select><br>
<input class="btn" type="submit" value="UPDATE">
</form>
<p style=" margin-top:0px; font-family: Century Gothic;
color: black; background-color:orange">
scroll down to see Output Display.</p>
</div>
<div class="fitem">
<h3>SHOW PRODUCTS OF ONE CATEGORY</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="show_by_category">
<label>Enter Category id     :</label>
<select name="categoryid">
<?php
$categories=get_categories();
foreach ($categories as $category) 
{
	echo "<option value=\"".$category['id']."\">".$category['id']."</option>";
}
?>
</select>
<input class="btn" type="submit" value="SHOW">
</form>
<br><p style=" margin-top:0px; font-family: Century Gothic;
color: black; background-color:orange">
scroll down to see Output Display.</p><p  style=" position:relative; top:190px; font-family: Century Gothic; background-color:orange;">
For a reference to id of a category, see show all categories section on categories manager page.
</p>
</div>

<div class="fitem">
<h3>SHOW DETAILS OF A PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="show_detail">
<label>Enter Product id      :</label>
<select name="id">
<?php
$id=$_SESSION['user']['id'];
$products=get_products_by_admin($id);
foreach ($products as $product) 
{
	echo "<option value=\"".$product['id']."\">".$product['id']."</option>";
}
?>
</select><input class="btn" type="submit" value="SHOW">
</form>
<br><br><p style="position:relative; top:30px;font-family: Century Gothic; background-color:orange;">
For a reference to id of products, press show all products button .
</p>
</div>
<!--
<h3>UPDATE PRODUCT - ID</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="update_id">
<label>Enter New ID of Product</label>
<input type="text" name="id"><br>
<label>Enter Product Code</label>
<input type="text" name="code"><br>
<input type="submit" value="UPDATE">
</form>
-->

<div class="fitem">
<h3>DELETE PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="delete">
<select name="categoryid">
<?php
$id=$_SESSION['user']['id'];
$products=get_products_by_admin($id);
foreach ($products as $product) 
{
	echo "<option value=\"".$product['id']."\">".$product['id']."</option>";
}
?>
</select>
<input class="btn" type="submit" value="DELETE">
</form>
<br><br><p style="position:relative; top:50px;font-family: Century Gothic;  background-color:orange;">
For a reference to id of products, press show all products button .
</p>
</div>

<div class="fitem">
<h3>SHOW ALL PRODUCTS in your store</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="show_all">
<input class="btn" type="submit" value="SHOW">
</form>
</div>


<div class="fitem" id="result">
<br><h3>RESULT DISPLAY</h3>
</div>

<?php 

if(isset($_POST['action']) && isset($_SESSION['user']) && $admin==TRUE)
{
	$action=$_POST['action'];
	
	
	switch ($action)
	{
		case 'add':
		if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['description'])
			 && isset($_POST['price']) && isset($_POST['categoryid']) && isset($_SESSION['user']['id']))
		{
			$a_id=$_SESSION['user']['id'];
			$name=$_POST['name'];
			$code=$_POST['code'];
			$description=$_POST['description'];
			$price=$_POST['price'];
			$categoryid=$_POST['categoryid'];
			$id=add_product($code,$name,$description, $price,$categoryid, $a_id);
			echo "Product Added with ID = $id ";
			unset($_POST['name']);
			unset($_POST['code']);
		}
		else
		{
			echo "ERROR - All Fields Must be Filled";
		}
		break;
		
		case 'show_detail':
		echo"<div class=\"fitem\" id=\"result\">";
		if(isset($_POST['id']))
		{
		$id=$_POST['id'];	
		$product=get_product_assoc($id);
		foreach ($product as $key=>$value)
		{
			echo $key ."=>". $value ."<br>";
		}
		}
		echo "</div>";
		break;
		
		case 'show_all':
		$id=$_SESSION['user']['id'];
		$products= get_products_by_admin($id);
		?>  <div style="background-color:orange; color:black;" class="fitem"><?php
		foreach ($products as $product)
		{
			?><a class="prodlink" href="products.php?action=show_detail&id=<?php echo $product['id']?>" style="text-decoration:none; color:black"><div class="prodbtn"><?php echo $product['name'] ."<br><br>"; ?></div></a><?php
		}
		?></div><?php
		break;
		
		case 'show_by_category':
		if (isset($_POST['categoryid']))
		{
			//echo"<div class=\"result\">";
			$categoryid=$_POST['categoryid'];
			$admin_id=$_SESSION['user']['id'];
			$products=get_products_by_category_by_admin($categoryid, $admin_id);
			?> <div style="background-color:orange; color:black;" class="fitem"> <?php
			foreach ($products as $product)
			{
				?> <a  class="prodlink" href="products.php?action=show_detail&id=<?php echo $product['id'] ?>"><div class="prodbtn"><?php echo $product['name']."<br>"; ?></div> </a><?php
			}
		}
		//echo "</div>";
		break;
		
		case 'update':
		if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['code'])
			 && isset($_POST['description']) && isset($_POST['price'])
         	&& isset($_POST['categoryid'])	 )
		{
			$id=$_POST['id'];
			$name=$_POST['name'];
			$code=$_POST['code'];
			$description=$_POST['description'];
			$price=$_POST['price'];
			$categoryid=$_POST['categoryid'];
			$result=update_product($id,$code, $name,$description, $price, $categoryid);
			if($result)
			{
				echo "Product Updated";
			}
		    else
		    {
			echo "All fields must be filled";
		    }
		}
		break;
		
		case 'delete':
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$result= delete_product($id);
			if($result)
			{
				echo "Product Deleted";
		    }
		}
		else
		    {
			    echo "ID must be set";
		    }
		
		break;
		
		/*
		case 'update_id':
		if(isset($_POST['id']) && isset($_POST['code']))
		{
			$id=$_POST['id'];
			$code=$_POST['code'];
			$result=update_product_id($code, $id);
			if($result)
			{
				echo "Product ID updated"; 
		    }
			else
			{
				echo "CANNOT UPDATE ID. New id must be unique";
			}
		} */
	}
}
 else
	{
		?> <div style="background-color:wheat;color:red; margin-left:-600px; padding:20px; border:6px solid black;"><h1 style="margin-left:0px; color=red; background-color=silver; font-family:Century Gothic;">You
		Must Be logged in as Administrator to use Admin Panel.</h1>
		</div><?php
	}
	
        if (isset($_GET['action']) && $_GET['action']=='show_detail')
		{
		$id=$_GET['id'];	
		$product=get_product_assoc($id);
		?><div class="fitem"><?php
		foreach ($product as $key=>$value)
		{
			 echo $key ." => ". $value."<br>";
		}
		?></div><?php
		}

   
?>
</div>

</div>
</div>


<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>