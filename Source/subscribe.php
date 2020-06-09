<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function emailRequestToAdmins($userEmailAddr)
{
    // Generate static content
    $msg = '
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supscription Cancellation Request Notice</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body style="background: #121614; font-size: 1.5rem;">
    <div
        style="width: 80vw; height: auto; margin: auto; background: #384947; color: white;  font-family: Poppins; padding: 50px;">
        <h1 style="color: #cac4bf; font-family: Bebas Neue; text-align: center;">ACME Movie Database Administration
        </h1>
        <h2 style="color: #e43f43; font-family: Bebas Neue; text-align: center;">Subscription Cancellation Request
            Notice</h2>
        <br>
        <!-- <p style="font-family: Poppins; text-align: center;">The following user:</p> -->
        <p style="font-family: Poppins; text-align: center; color: #ed9a9c;">
            ' . $userEmailAddr . '
        </p>
        <p style="font-family: Poppins; text-align: center;"> wishes to be removed from the subscription database.</p>
        <br>
        <p style="font-size: 0.8rem;"> This e-mail has been sent automatically. Any e-mails sent to this address will
            <u>NOT</u>
            be answered.
            <br>
            <br>
            This email is confidential and may contain legally privileged information. If you are not the intended
            recipient, you must not disclose or use the information contained in it. If you have received this email in
            error, please notify us immediately by return email and delete the document.
            <br>
            <br>
            ACME accepts no liability for any damage caused by the transmission, receipt or opening of this message and
            any files transmitted with it.
        </p>
        <p></p>
    </div>
</body>
</html>
';

    // Fetch admin emails from database
    require "./php/connection.php";
    $qry = "SELECT * FROM `admin`";
    $result = mysqli_query($dbConnection, $qry);

    // Send administrator an email
    while ($row = $result->fetch_assoc()) {
        require 'vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->Username = "acme.moviedb@gmail.com";
        $mail->Password = "radisrad2020";

        $mail->AddAddress($row["email"]);
        $mail->SetFrom('no-reply@ACME.MovieDb.com');
        $mail->Subject = 'Subscription Cancellation Request Notice';

        $mail->isHTML();
        $mail->Body = $msg;

        if (!$mail->Send()) {
            echo '<script type="text/javascript">alert("ERROR: ' . $mail->ErrorInfo . '");</script>';
        } else {
            echo '<script type="text/javascript">notify("Removal request sent", 3000, null);</script>';
        }
    }
}

function ValidateEmail($email)
{
    // $pattern = "/^[a-zA-Z0-9\.]+@(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.?[a-zA-Z0-9\.]+\.(com|net|com.au)$/";
    // $pattern = "^[\w!#$%&'*+\-/=?\^_`{|}~]+(\.[\w!#$%&'*+\-/=?\^_`{|}~]+)*@((([\-\w]+\.)+[a-zA-Z]{2,4})|(([0-9]{1,3}\.){3}[0-9]{1,3}))$";
    $pattern = "/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g";
    return (bool) preg_match($pattern, $email);
}

function ValidateName($name)
{
    $chars = str_split($name);
    foreach ($chars as $char) {
        if (!ValidateChar($char)) {
            return false;
        }
    }
    return true;
}

function ValidateChar($char)
{
    // Alphabetical characters
    if (ctype_alpha($char)) {
        return true;
    }

    // White spaces
    if (ctype_space($char)) {
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

function handleSubscriptions()
{
    require "./php/connection.php";

    if (isset($_POST["email"])) {
        if (isset($_POST["remove"])) {
            if ($_POST["remove"]) {
                $emailAddress = $_POST["email"];

                // Email removal request to admins
                emailRequestToAdmins($emailAddress);

                // Update both monthly and burst to 'off'
                $query = "SELECT * 
                FROM `subscriptions` 
                WHERE `email` = '" . $emailAddress . "'";

                $result = mysqli_query($dbConnection, $query);
                $row = $result->fetch_assoc();
                if ($row) {
                    // Get ID of subscription
                    $row = mysqli_fetch_assoc($result);
                    $subID = $row["id"];

                    // Update existing subscription
                    $query = "  UPDATE `subscriptions` 
                                SET `monthly` = '0', `burst` = '0'  
                                WHERE `email` = '" . $emailAddress . "';";

                    // Execute statement
                    $result = mysqli_query($dbConnection, $query);
                }
            }
        } else {
            $emailAddress = $_POST["email"];
    
            $boolMonthly = 0;
            $boolBurst = 0;
        
            if (isset($_POST["monthly"])) {
                $boolMonthly = 1;
            }
            if (isset($_POST["burst"])) {
                $boolBurst = 1;
            }
    
            $query = "  SELECT * 
                        FROM `subscriptions` 
                        WHERE `email` = '" . $emailAddress . "'";
    
            $result = mysqli_query($dbConnection, $query);
            $row = $result->fetch_assoc();
            if ($row) {
                // Get ID of subscription
                $row = mysqli_fetch_assoc($result);
                $subID = $row["id"];
    
                // Update existing subscription
                $query = "  UPDATE `subscriptions` 
                            SET `monthly` = '" . $boolMonthly . "', `burst` = '".$boolBurst."'  
                            WHERE `email` = '" . $emailAddress . "';";
    
                // Execute statement
                $result = mysqli_query($dbConnection, $query);

                echo '<script type="text/javascript">notify("Successfully updated", 3000, null);</script>';
            } else {
                addSubscription();
            }
        }
    }
}

function addSubscription()
{
    $emailAddress = $_POST["email"];
    $givenName = $_POST["firstname"];
    $surname = $_POST["surname"];

    $boolMonthly = 0;
    $boolBurst = 0;

    if (isset($_POST["monthly"])) {
        $boolMonthly = 1;
    }
    if (isset($_POST["burst"])) {
        $boolBurst = 1;
    }

    // Filter name and email
    $validGivenName = ValidateName($givenName);
    $validSurname = ValidateName($surname);
    $validEmail = ValidateEmail($emailAddress);

    if ($validGivenName === true && $validSurname === true) {
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            // Create new subscription
            $query = "  INSERT INTO `subscriptions` (`email`, `firstname`, `surname`, `monthly`, `burst`)
                    VALUES ('" . $emailAddress . "', '" . $givenName . "', '".$surname."', '" . $boolMonthly . "', '" . $boolBurst . "');";

            // import connection
            require './php/connection.php';

            // Execute statement
            $result = mysqli_query($dbConnection, $query);

            // Show success feedback to user
            echo '<script type="text/javascript">notify("Subscription created", 3000, null);</script>';
        } else {
            // Show success feedback to user
            echo '<script type="text/javascript">notify("ERROR: Invalid email address", 3000, null);</script>';
        }
    } else {
        // Show success feedback to user
        echo '<script type="text/javascript">notify("ERROR: Invalid name(s)", 3000, null);</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscribe</title>

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

// Handle subscription creations and updates
handleSubscriptions();
?>
<!-- Side page title -->
<div class="side-title"><p>Subscribe</p></div>

<!-- Form -->
<form id="form-search" action="./subscribe.php" method="POST">

    <h1 style="color: white; text-align: center;">Subscribe</h1> 
    <br>
    <p style="color: white; text-align: center; font: 1.5rem Poppins;">Please fill out the form to subscribe to our newsletter!</p> 
    <br>

    <!-- First Name -->
    <div class="form-coupling">
        <label for="firstname" class="form-label" style="min-width: 200px">Given Name:</label>
        <input type="text" name="firstname" id="firstname" placeholder="Enter given name">
        <br>
    </div>

    <!-- Surname -->
    <div class="form-coupling">
        <label for="surname" class="form-label" style="min-width: 200px">Surname:</label>
        <input type="text" name="surname" id="surname" placeholder="Enter surname">
        <br>
    </div>

    <!-- Email -->
    <div class="form-coupling">
        <label for="email" class="form-label" style="min-width: 200px">Email:</label>
        <input type="text" name="email" id="email" placeholder="Enter email address">
        <br>
    </div>

    <!-- Monthly -->
    <div class="form-coupling">    
        <input type="checkbox" id="monthly" name="monthly" value="monthly">
        <label for="monthly" class="form-label">Monthly Newsletter</label>
        <br>
    </div>

    <!-- Burst -->
    <div class="form-coupling">    
        <input type="checkbox" id="burst" name="burst" value="burst">
        <label for="burst" class="form-label">Burst Notifcations</label>
        <br>
    </div>

    <p style="text-align: center; color: white; font-size: 1rem; font-family: Poppins;">or</p>

    <!-- Remove -->
    <div class="form-coupling">    
        <input type="checkbox" id="remove" name="remove" value="remove">
        <label for="remove" class="form-label" style="color: red;">Unsubscribe</label>
        <br>
    </div>

    <!-- Login Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit">Update My Subscription</button>
    </div>

</form>
</body>
</html>
