<?php
include 'dbs.php';

$order_by = "asc";

if (isset($_GET['order_by']) && $_GET['order_by'] == "desc") {
    $order_by = "desc";
}

$sql = "SELECT * FROM `users` order by username " . $order_by;
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>BC140200856 | Test Phase</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div class="header">
            <h2>Student ID: BC140200856 - Test Phase Feb 25, 2020</h2>
        </div>
        <div class="list-table">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 200) {
                echo "<p>User Registered Successfully!</p>";
            }
            ?>
            <a href="add-new.php" class="button" >Add New</a>
            <a href="index.php?order_by=asc" class="button" >Sort Ascending</a>
            <a href="index.php?order_by=desc" class="button" >Sort Descending</a>

            <table align="center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
