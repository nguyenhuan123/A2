<!DOCTYPE html>
<html>
<body>

<h1>Xóa DL</h1>

<h4>ID SP cần xóa</h4>

<form name="delete" method="POST" action="DeleteData.php">
    <lable for="id">ID Sản Phẩm</label><input type="text" name="id" placeholder="nhập id sp cần xóa"/><br>
    <input type="submit" value="Xóa">
</form>

<?php
ini_set('display_errors', 1);
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-3-222-150-253.compute-1.amazonaws.com;port=5432;user=ehstogxsuqruqf;password=f68bf6abb7c3788a82087f3a0cffd8eaede75f919256ffa0da03286520e39758;dbname=dem8o7o5f4sedg",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "DELETE FROM products WHERE productid = '$_POST[id]'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>
