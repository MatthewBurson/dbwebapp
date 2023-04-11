<?php
session_start();

if(isset($_SESSION["username"])){
    echo "Welcome " . $_SESSION["username"] . "!";
}else{
    echo "Not loged in!!! <a href = index.php>Click here to log in.</a>";
}

?>

