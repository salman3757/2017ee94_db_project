
<?php 

include ('database.php');


/*----------------------------CATEGORIES-------------------------------*/



function add_category($name)
{
	global $db;
	$query = "INSERT INTO Categories (name)
	          VALUES ('$name')";
	
	$db->exec($query);  // exec() -> executes an SQL statement in a single function call, 
	                    //           returning the number of rows affected by the statement.
	
	$categoryid=$db->lastInsertId();
	
	return $categoryid;
}
function update_category($id, $name)
{
	global $db;
	$query="UPDATE categories
	        SET    name='$name'
			WHERE  id=$id";
	$result=$db->exec($query);
	
	return $result;
}

function delete_category($id)
{
	global $db;
	$query="DELETE 
	        FROM categories
			WHERE id=$id";
	$result=$db->exec($query);
	
	return $result;
}

function get_categories()
{
	global $db;
	$query="SELECT *
	        FROM Categories";
	$result=$db->query($query);  // query() -> Executes an SQL statement, 
	                             // returning a result set as a PDOStatement object
	$categories=$result->fetchAll(PDO::FETCH_BOTH);
	
	return $categories;
}
function get_category($id)
{
	global $db;
	$query="SELECT *
	        FROM categories
			WHERE id=$id";
	$result=$db->query($query);
    $category=$result->fetch(PDO::FETCH_BOTH);
	
	return $category;
}
function update_category_id($id, $name)
{
	global $db;
	$query="UPDATE categories
	        SET id=$id
			WHERE name='$name'";
	$result=$db->exec($query);
	
	return $result;
}

/*----------------------------PRODUCTS-------------------------------*/




function add_product($code, $name, $description, $price, $categoryid)
{
	global $db;
	$query= "INSERT INTO Products (code, name, description, price, categoryid)
	         VALUES ('$code', '$name', '$description', $price, $categoryid)";
			 
	$db->exec($query);
	$productid=$db->lastInsertId();
	
	return $productid;
	
}

function get_product($id)
{
	global $db;
	$query="SELECT *
	        FROM products
			WHERE id=$id";
	$result=$db->query($query);
	$product=$result->fetch(PDO::FETCH_BOTH);
	
	return $product;
}

function get_products_by_category($categoryid)
{
	global $db;
	$query="SELECT * 
	        FROM Products 
	        WHERE categoryid=$categoryid";
	
	$result   = $db->query($query);
	$products = $result->fetchAll(PDO::FETCH_BOTH);
	
	return $products;
}
function get_all_products()
{
	global $db;
	$query="SELECT *
	        FROM Products";
	$result=$db->query($query);
	$allproducts=$result->fetchAll(PDO::FETCH_BOTH);
	
	return $allproducts;
	
}

function update_product($id, $code, $name, $description, $price, $categoryid)
{
	global $db;
	$query="UPDATE products
	        SET code='$code',
			    name='$name',
				description='$description',
				price=$price,
				categoryid=$categoryid
			WHERE id=$id";
	$result=$db->exec($query);
	
	return $result;
}

function delete_product($id)
{
	global $db;
	$query="DELETE 
	        FROM  products
			WHERE id=$id";
	$result=$db->exec($query);
	
	return $result;
}


function get_product_assoc($id)
{
	global $db;
	$query="SELECT *
	        FROM products
			WHERE id=$id";
	$result=$db->query($query);
	$product=$result->fetch(PDO::FETCH_ASSOC);
	
	return $product;
}

function update_product_id($code, $id)
{
	global $db;
	$query="UPDATE products
	        SET id=$id
			WHERE code='$code'";
	$result=$db->exec($query);
	return $result;
}

function search($product)
{
	global $db;
	$query="SELECT *
	        FROM products
			WHERE name LIKE '%$product%' OR
			      code LIKE '%$product%' OR
			      description LIKE '%$product%'";
	$result=$db->query($query);
	$products=$result->fetchALL(PDO::FETCH_BOTH);
	
	return $products;
}

?>
