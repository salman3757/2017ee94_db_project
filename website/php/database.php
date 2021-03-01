
<?php 

$dsn = 'mysql:host=localhost;dbname=armory_db';
$username = 'salman';
$password = 'mysql59@';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}
?>

