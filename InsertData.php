<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>Thêm DL vào table product</h1>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST" >
            <li>Pruduct id:</li><li><input type="text" name="ProductID" /></li>
            <li>Product_name:</li><li><input type="text" name="ProductName" /></li>
            <li>NSX:</li><li><input type="date" name="ProductDate" /></li>
            <li><input type="submit" value="Thêm DL" /></li>
        </form>
    </ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-3-222-150-253.compute-1.amazonaws.com;port=5432;user=ehstogxsuqruqf;password=f68bf6abb7c3788a82087f3a0cffd8eaede75f919256ffa0da03286520e39758;dbname=dem8o7o5f4sedg",
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO products(productid, productname, productdate) VALUES ('$_POST[ProductID]','$_POST[ProductName]', '$_POST[ProductDate]')";
$stmt = $pdo->prepare($sql);
echo($sql);
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }

?>
</body>
</html>
