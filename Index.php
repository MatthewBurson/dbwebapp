<?php
session_start();

$servername = "localhost:3306";
$usernamedb = "root";
$passworddb = "MB@062305";
$database = "adptestdb";
$username = "";
$password = "";
$error = 0;
$processed = 0;
$error_message = "Error Message: ";

$conn = new mysqli($servername, $usernamedb, $passworddb, $database);
$conn_error = false;
if($conn->connect_error){
    $conn_error = true;
}



if($_SERVER["REQUEST_METHOD"] == "POST"){

    $processed = 1;
    if(empty($_POST["username"])){
        $error = 1;
        $error_message .= "<br>&middot;Please enter a username.";
    }else{
        $username = $_POST["username"];
    }
    if(empty($_POST["password"])){
        $error = 1;
        $error_message .= "<br>&middot;Please enter a password.";
    }else{
        $password = $_POST["password"];
    }


    if ($error == 0) {
        $sql = "SELECT * FROM adptestdb.user WHERE user_username = '{$username}' AND user_password = '{$password}';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION["username"] = $username;
            header("location: search.php");
        } else {
            $error = 1;
            $error_message .= "<br>&middot;Invalid Username or Password.";
        }
    }
    
        
    

}

?>
<html>
    <body>
        <h2>System Login</h2>
        <?php
            if($error == 1 && $processed == 1){
                echo "<font color=red>" . $error_message . "</font>";
            }
        ?>
        <form method="post" action="index.php">
            <span>Username:</span><br>
            <input type="text" name="username"><br>
            <span>Password:</span><br>
            <input type="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
