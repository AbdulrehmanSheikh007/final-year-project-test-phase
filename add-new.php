<?php
include 'dbs.php';

//Validations 
$error = "";
if (isset($_POST['submit'])) {

    if (empty($_POST['name']))
        $error = "Name field is required.";
    else if (empty($_POST['username']))
        $error = "Username field is  required.";
    else if (empty($_POST['email']))
        $error = "Email field is  required.";
    else if (empty($_POST['password']))
        $error = "Password field is  required.";
    else if (strlen($_POST['name']) < 3 || strlen($_POST['name']) > 100)
        $error = "Name length should be at least 3 to 100 character.";
    else if (strlen($_POST['username']) < 8 || strlen($_POST['username']) > 100)
        $error = "Username length should be 8 to 100 character.";
    else if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20)
        $error = "Password length should be 8 to 20 character.";
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $error = "Email address is invalid.";
    else {

        unset($_POST['submit']);

        //Remove Special Characters 
        $_POST['username'] = preg_replace("/[^a-zA-Z]+/", "", $_POST['username']);
        $cols = "`" . implode("`,`", array_keys($_POST)) . "`";
        $vals = "'" . implode("','", array_values($_POST)) . "'";
        $insertQry = "INSERT INTO `users`(" . $cols . ") VALUES (" . $vals . ")";

        if ($conn->query($insertQry)) {
            header('Location: index.php?status=200');
        } else {
            $error = "An error occured in query execution.";
        }
    }
}
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
            if (!empty($error)) {
                echo "<p>" . $error . "</p>";
            }
            ?>
            <form class="form" action="add-new.php" method="post" >
                <div class="form-field">
                    <div class="label">Name:</div>
                    <input type="text" class="form-input"  name="name" placeholder="Enter Name"/>
                </div>
                <div class="form-field">
                    <div class="label">Username:</div>
                    <input type="text" class="form-input"  name="username" placeholder="Enter Username"/>
                </div>
                <div class="form-field">
                    <div class="label">Email:</div>
                    <input type="email" class="form-input"  name="email" placeholder="Enter Email"/>
                </div>
                <div class="form-field">
                    <div class="label">Password:</div>
                    <input type="password" class="form-input"  name="password" placeholder="Enter Password"/>
                </div>
                <div class="form-field">
                    <a href="index.php" class="button" >Go Back</a>
                    <input type="reset" value="Reset" class="button" />
                    <input type="submit" value="Submit" name="submit" class="button" />
                </div>
            </form>
        </table>
    </div>
</body>
</html>
