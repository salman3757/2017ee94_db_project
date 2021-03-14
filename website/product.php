
<?php
include('database.php');
include('database_funcs.php');
 ?>

<html>
<head>
<title>CATEGORY MANAGER
</title>
</head>

<body>



<h2>ADD CATEGORY </h2>
<form action="category.php" method="post">
<label>Category Name</label>
<input type="hidden" name="action" value="add">
<input type="text" name="cname"><br>
<input type="submit" value="ADD"><br>
</form>

SHOW ALL CATEGORIES
<form action="category.php" method="post">
<input type="hidden" name="action" value="show">
<input type="submit" value="SHOW">
</form>

UPDATE CATEGORY
<form action="category.php" method="post">
<input type="hidden" name="action" value="update">
<label>Enter ID of Category to be UPDATED</label>
<input type="text" name="id">
<label>ENTER " NEW NAME " for the Category</label>
<input type="text" name="name">
<input type="submit" value="UPDATE">
</form>

DELETE CATEGORY
<form action="category.php" method="post">
<label>Enter ID of the Category to be DELETED</label>
<input type="text" name="id">
<input type="submit" valye="DELETE">
</form>



<h2>ADD PRODUCT</h2>
<form  action="add_product.php"  method="post">
<p><label>Product Code</label>
<input type = "text"  name="pcode">
<p><label>PRODUCT Name</label>
<input type = "text"  name="pname">
<p><label>PRODUCT Description</label>
<input type = "text"  name="description">
<p><label>PRODUCT Price</label>
<input type = "text"  name="price">
<p><label>PRODUCT Category Id</label>
<input type = "text"  name="pcid">
<input type="submit"  value="ADD"></p>
</form>

<br>
<h2>DELETE CATEGORY</h2>
<form action="add_product.php" method="post">
<input type="hidden" name="action" value="delete_category">
<input type="text" name="categoryid">
<input type="submit" value="DELETE">
<p>
<?php  

if (isset ($_POST['cname']))
{
	$cname=$_POST['cname'];
	$categoryid=add_category($cname);
	if(isset($categoryid))
	{
		echo "Category Added";
	}
	else{
		echo "Category Is NOT ADDED";
	}
}

if (isset($_POST['pcode']) && isset($_POST['pname']) && isset($_POST['description'])
	     && isset($_POST['price']) && isset($_POST['pcid']))
{
	echo $_POST['pcode']."<br>";
	echo $_POST['pname']."<br>";
	echo $_POST['description']."<br>";
	echo $_POST['price']."<br>";
	echo $_POST['pcid']."<br>";
	$pcode=$_POST['pcode'];
	$pname=$_POST['pname'];
	$description=$_POST['description'];
	$price=$_POST['price'];
	$pcid=$_POST['pcid'];
	
	
	$productid=add_product($pcode, $pname, $description, $price, $pcid);
	if($productid)
	{echo "product ADDED";}
else {
	echo "product cannot be added";
}

}


if (isset($_POST['action']) && $_POST['action']=='delete_category')
{
	
	$result=$_POST['categoryid'];
	$out=delete_category($result);
    if($out)
	{
		echo"CATEGORY DELETED";
	}
}

?></p>
<p>
<a href="add_product.php?action=show">SHOW ALL PRODUCTS</a>
<?php if ($_GET['action']=='show')

{
	$products=get_products();
	foreach ($products as $product)
	{
		echo "<br>". $product[1] ." " ;
	}
}
?>

<a href="add_product.php?action=showcat">SHOW ALL CATS</a>
<?php if ($_GET['action']=='showcat'):


	$products=get_categories();
	foreach ($products as $product):
	
		echo "<br>". $product[0] ."=>". $product[1] ; ?>
		<a href="add_product.php?action=delete_category&categoryid=<?php echo $product[0] ?>">DELETE</a>
		<br>
	<?php endforeach;
	endif;

if ($_GET['action']=='delete_category')
{
	delete_category($_GET['categoryid']);
}
	?>


</p>

</body>

</html>