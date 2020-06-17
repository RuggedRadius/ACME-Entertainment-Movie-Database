<?php


function CreateAdminAccount()
{
    // import connection
    require './php/connection.php';

    // Expire code
    ExpireCode($_POST['code']);

    // Create statement
    $query = "  INSERT INTO `admin` (`username`, `password`, `email`)
        VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', '".$_POST['email']."');";

    // Execute statement
    $result = mysqli_query($dbConnection, $query);
}

function ExpireCode($code)
{
    // import connection
    require './php/connection.php';

    $query = "  SELECT * 
    FROM `accountcodes` 
    WHERE `Code` = '" . $code . "'";

    $result = mysqli_query($dbConnection, $query);
    $row = $result->fetch_assoc();
    if ($row) {
        // Update existing subscription
        $query = "  UPDATE `accountcodes` 
        SET `Expired` = '1'
        WHERE `Code` = '" . $code . "';";

        // Execute statement
        $result = mysqli_query($dbConnection, $query);
    } else {
        // Code does nto exist
    }
}

function CheckUsernameExists($username)
{
    // import connection
    require './php/connection.php';

    // CHECK DATABASE FOR EXISTING USERNAME
    $query = "SELECT * FROM `admin` WHERE `username`='".$username."' LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
    $row = mysqli_fetch_assoc($result);

    // Determine result
    if ($row) {
        // Username was found
        return false;
    } else {
        // Username was NOT found
        return true;
    }
}

function ValidatePassword($complexString)
{
    // $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm";
    $pattern = "/^(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/";
    return (bool) preg_match($pattern, $complexString);
}


function VerifyCode($code)
{
    // import connection
    require './php/connection.php';


    // CHECK DATABASE FOR EXISTING USERNAME
    $query = "SELECT * FROM `accountcodes` WHERE `Code`='".$code."' LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Determine result
    if ($row) {
        // Code was found
        if ($row["Expired"] == 0) {
            // Code valid
            return true;
        } else {
            // Code expired
            return false;
        }
    } else {
        // Username was NOT found
        return false;
    }
}

function ValidateEmail($email)
{
    // Determine email validation regex pattern
    // $pattern = "/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g";
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function ValidateName($name)
{
    // Split name into char array
    $chars = str_split($name);

    // Assess each character
    foreach ($chars as $char) {
        if (!ValidateChar($char)) {
            return false;
        }
    }

    // // Check for empty
    // if (empty($name)) {
    //     return false;
    // }

    return true;
}

function ValidateChar($char)
{
    // Alphabetical characters
    if (ctype_alpha($char)) {
        return true;
    }

    // White spaces
    // if (ctype_space($char)) {
    //     return true;
    // }

    if (ctype_alnum($char)) {
        return true;
    }

    // Apostrophes
    if (ord($char) === 39) {
        return true;
    }

    // Hypens
    if (ord($char) === 45) {
        return true;
    }

    return false;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>

    <?php
    require "./php/html_head.php";
    ?>
</head>


<body>
<script type="text/javascript" src="./js/notification.js"></script>



<?php
/**
 * Short description for file
 *
 * PHP version 5
 *
 * @category BenFlix
 * @package  BenFlix
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */


require "./php/header.php";
require "./php/connection.php";


if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $code = $_POST["code"];

    // echo "<script>alert('Username: $username');</script>";
    // echo "<script>alert('Password: $password');</script>";
    // echo "<script>alert('Email: $email');</script>";
    // echo "<script>alert('Code: $code');</script>";

    // Check username doesn't exist
    if (CheckUsernameExists($username)) {
        // Validate username
        if (ValidateName($username)) {
            // Validate password
            if (ValidatePassword($password)) {
                // Validate email
                if (ValidateEmail($email)) {
                    // Validate code
                    if (VerifyCode($code)) {
                        // Create admin account
                        CreateAdminAccount();
                        echo '<script type="text/javascript">notify("Account created", 5000, null);</script>';
                    } else {
                        echo '<script type="text/javascript">notify("Invalid code", 5000, null);</script>';
                    }
                } else {
                    echo '<script type="text/javascript">notify("Invalid email", 5000, null);</script>';
                }
            } else {
                echo '<script type="text/javascript">notify("Invalid password", 5000, null);</script>';
            }
        } else {
            echo '<script type="text/javascript">notify("Invalid name", 5000, null);</script>';
        }
    } else {
        echo '<script type="text/javascript">notify("Username already exists", 5000, null);</script>';
    }
}
?>

<!-- Side Title -->
<div class="side-title"><p>Login</p></div>


<!-- Form -->
<form id="form-search" action="./adminCreateAccount.php" method="POST">

    <!-- Heading -->
    <h1 style="color: white; text-align: center;">Create Admin Account</h1> 
    <br>

    <!-- Username -->
    <div class="form-coupling">
    <label for="username" class="form-label">Username:</label>
    <input type="text" name="username" id="username"><br>
    </div>

    <!-- Password -->
    <div class="form-coupling">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password"><br>
    </div>

    <!-- Email -->
    <div class="form-coupling">
    <label for="email" class="form-label">Email:</label>
    <input type="text" name="email" id="email"><br>
    </div>

    <!-- Code -->
    <div class="form-coupling">
    <label for="code" class="form-label">Activation Code:</label>
    <input type="text" name="code" id="code"><br>
    </div>

            
    <!-- Login Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit" style="padding: 10px 80px;">Create Account</button>
    </div>
</form>

</body>
</html>
