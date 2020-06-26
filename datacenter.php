<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainstyle.css"/>
    <title>ATN data center</title>
</head>
<body>
        <?php
        ini_set('display_errors', 1);
        if (empty(getenv("DATABASE_URL"))){
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo getenv("dbname");
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

        $sql = "SELECT * FROM products ORDER BY productid";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN cơ sở dữ liệu</h1>
    <button onclick="location.href='index.php'">Trờ về trang chủ</button>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <img src="./data.png"/>
                <a href="#" onClick="displayData()"><b>Xem dữ liệu hóa đơn</b></a>
            </div>
            <div class="grid-item">
                <img src="./data.png" />
                <a href="./InsertData.php" target="framename"><b>Thêm DL</b></a>
            </div>
            <div class="grid-item">
                <img src="./data.png"/>
                <a href="./DeleteData.php" target="framename"><b>Xóa DL</b></a>
            </div>
            <div class="grid-item">
                <img src="./data.png"/>
                <a href="UpdateData.php" target="framename"><b>Cập nhật DL</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ProductID</th>
                        <th>ProductName</th>
                        <th>ProductDate</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // tạo vòng lặp 
                        //while($r = mysql_fetch_array($result)){
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['productid'] ?></td>
                        <td><?php echo $row['productname'] ?></td>
                        <td><?php echo $row['productdate'] ?></td>     
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>
