<?php
$fname = "";
$lname = "";
$email = "";
$error = 0; // 0 Means no eror.
$process_data = 0;
$error_message = "Please fix the following fields: ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $process_data = 1;
    if (empty($_POST["firstname"])) {
        $error = 1;
        $error_message .= "<br>&middot;First Name";
    } else {
        $fname = $_POST["firstname"];
    }

    if (empty($_POST["lastname"])) {
        $error = 1;
        $error_message .= "<br>&middot;Last Name";
    } else {
        $lname = $_POST["lastname"];
    }
 
    if (empty($_POST["email"])) {
        $error = 1;
        $error_message .= "<br>&middot;Email";
    } else {
        $email = $_POST["email"];
    }
}else{
    // Possible invalid request/access.
}

//No errors - Process Data and go to next page
if ($error == 0 && $process_data == 1){
    header("Location: index.php");
}

?>



<html>
    <head>
        <title>PHP Form Test</title>
    </head>
    <body>
        <h3>Custom Form</h3>
        <?php
            if($error == 1){
            echo "<font color=red>" . $error_message . "</font>";   
            }
        ?>
        <form method="post" action="form.php">
            <span>First Name:</span><br>
            <input type="text" name="firstname" value= "<?=$fname?>"><br>
            <span>Last Name:</span><br>
            <input type="text" name="lastname" value= "<?=$lname?>"><br>
            <span>email:</span><br>
            <input type="email" name="email" value= "<?=$email?>"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>