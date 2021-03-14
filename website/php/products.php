
<?php
include('database.php');
include('database_funcs.php');
 ?>

<html>
<head>
<title>PRODUCT MANAGER
</title>
<style>
<?php
include('admin.css');
?>
</style>
</head>

<body>


<div id="flex">
<div class="fitem">
<h3>ADD PRODUCT </h3>
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
<input type="text" name="categoryid"><br>
<input class="btn" type="submit" value="ADD"><br>
</form>
</div>

<div class="fitem">
<h3>UPDATE PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="update">
<label>Enter Current ID          :</label>
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
<input type="text" name="categoryid"><br>

<input class="btn" type="submit" value="UPDATE">
</form>
</div>
<div class="fitem">
<h3>SHOW PRODUCTS OF ONE CATEGORY</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="show_by_category">
<label>Enter Category id     :</label>
<input type="text" name="categoryid">
<input class="btn" type="submit" value="SHOW">
</form>
</div>

<div class="fitem">
<h3>SHOW DETAILS OF A PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="show_detail">
<label>Enter Product id      :</label>
<input type="text" name="id">
<input class="btn" type="submit" value="SHOW">
</form>
</div>

<h3>UPDATE PRODUCT - ID</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="update_id">
<label>Enter New ID of Product</label>
<input type="text" name="id"><br>
<label>Enter Product Code</label>
<input type="text" name="code"><br>
<input type="submit" value="UPDATE">
</form>


<div class="fitem">
<h3>DELETE PRODUCT</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="delete">
<label>Enter Product ID    :</label>
<input type="text" name="id">
<input class="btn" type="submit" value="DELETE">
</form>
</div>

<div class="fitem">
<h3>SHOW ALL PRODUCTS</h3>
<form action="products.php" method="post">
<input type="hidden" name="action" value="show_all">
<input class="btn" type="submit" value="SHOW">
</form>
</div>


<div class="fitem" id="result">
<br><h3>RESULT DISPLAY</h3>
</div>

<?php 

if(isset($_POST['action']))
{
	$action=$_POST['action'];
	
	
	switch ($action)
	{
		case 'add':
		if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['description'])
			 && isset($_POST['price']) && isset($_POST['categoryid']))
		{
			$name=$_POST['name'];
			$code=$_POST['code'];
			$description=$_POST['description'];
			$price=$_POST['price'];
			$categoryid=$_POST['categoryid'];
			$id=add_product($code,$name,$description, $price,$categoryid);
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
		echo"<div class=\"fitem\">";
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
		$products=get_all_products();
		?>  <div class="fitem"><?php
		foreach ($products as $product)
		{
			?><a href="products.php?action=show_detail&id=<?php echo $product['id']?>"><?php echo $product['name'] ."<br><br>"; ?> </a> <?php
		}
		?></div><?php
		break;
		
		case 'show_by_category':
		if (isset($_POST['categoryid']))
		{
			echo"<div class=\"results\">";
			$categoryid=$_POST['categoryid'];
			$products=get_products_by_category($categoryid);
			foreach ($products as $product)
			{
				?> <div class="fitem"><a href="products.php?action=show_detail&id=<?php echo $product['id'] ?>"> <?php echo $product['name']."<br>"; ?> </a></div><?php
			}
		}
		echo "</div>";
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
</body>

</html>