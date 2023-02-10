<?php
session_start();
$action = "";
$id = "";
$name = "";
$contact = "";
$city = "";
$state = 0;
$zip = "";
$salary = "";
$error = FALSE;
$error_message = "Please fill in the following fields:";
$dberror = FALSE; 
$dberror_message = "The following erorrs occured:";
$update_message = "";
$record_update = FALSE; 

$servername = "localhost:3306";
$username = "root";
$password = "MB@062305";
$database = "adptestdb";
//Create DB Connection
$conn = new mysqli($servername, $username, $password, $database);
$conn_error = false;
if($conn->connect_error){
    $conn_error = true;
}


if(!isset($_SESSION["username"])){
    header("Location: index.php");
}else{

    if(!empty($_GET["action"])){
        $action = $_GET["action"];


    }

    if($action== "logout"){
        session_destroy();
        header("Location: index.php");
    }

    //Populate Salesperson Fields 
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        if($conn->connect_error){
            //DB Connect Error Message Goes Here. 
        }else{
            $sql = "SELECT * FROM salesperson LEFT JOIN state ON salesperson_state_id = state_id WHERE salesperson_id = " . $id . ";";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $name = $row["salesperson_name"];
                $contact = $row["salesperson_contact"];
                $city = $row["salesperson_city"];
                $state = $row["state_id"];
                $zip = $row["salesperson_zip"];
                $salary = $row["salesperson_salary"];
            }else{
                //Generate Error Message - Salesperson w/that ID not found. 
            }
        }
    }else{
        //Display error message.. couldn't retrieve id. 
    }

    if(isset($_POST["Submit"])){
        
        $id = $_POST["id"];

        if($_POST["Submit"] == "Yes"){
            if (!$conn->connect_error) {
                $sql = "DELETE FROM salesperson WHERE salesperson_id={$id};";
                $conn->query($sql);
            }
        }
        header("Location: search.php");
   
    }
?>
<html>
    <head>
        <title>SEARCH PAGE</title>
        <style>
            body{
                background-color: #e6f7ff;
            }
            .top-container{
                display: flex;
                background-color: #006699;
                border-radius: 3px;
            }
            .top-item1{
                padding:10px;

                margin: 5px;
                width: 50%;
            }
            .top-item2{
                padding:10px;
 
                margin: 5px;
                width: 50%;
                text-align: right;
            }
            .form-container{
                display: flex;
                background-color: #006699;
                border-radius: 3px;
                width: 300px;
                color: #ffffff;
                font-weight: bold;
            }
            .form-item1{
                padding:10px;
                margin: 5px;
                width: 300px;
                text-align: left;
            }
            .form-item2{
                padding:10px;
                margin: 5px;
                width: 12%;
                text-align: left;
            }
            span.title{
                font-weight: bold;
                font-size: 26pt;
                color: #ffffff;
            }
            span.title-reg{
                font-size: 12pt;
                color: #ffffff;
            }
            span.f1{
                font-weight: bold;
                font-size: 22pt;
                color: #000000;
            }
            span.f2{
                font-size: 16pt;
                color: #000000;
            }
            a.link1{
                font-size: 12pt;
                color: #e0ebeb;
            }
            a.link1:hover{
                font-size: 12pt;
                color: #33cc33;
            }
            a.back{
                color: #000000;
                font-size: 12pt;
                text-decoration: none;
            }
            a.back:hover{
                color: #33cc33;
                font-size: 12pt;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="top-container">
            <div class="top-item1">
                <span class="title">ADP DB WebApp</span><br>
                <span class="title-reg">SalesPerson Entry Form</span>
            </div>
            <div class="top-item2">
                <span class="title-reg">Welcome, <?=$_SESSION["username"]?>.</span><br>
                <span class="title-reg">Click <a href="search.php?action=logout" class="link1">here</a> to logout.</span><br>
            </div>
        </div>
        <a href="search.php" class="back"> > Back to search page</a>
        <br><br>
        <span class="f1">
            Remove Salesperson
        </span><br>
        <span class="f2">
            Click 'Yes' to delete Salesperson. 'No' to exit.
        </span><br><br>
        <?PHP
            if($error){
                echo "<font color=red>" . $error_message . "</font>";
            }
            if($dberror){
                echo "<font color=red>" . $dberror_message . "</font>";
            }
            if($record_update){
                echo "<font>" . $update_message . "</font>";
            }
        ?>
        <span>
            --Salesperson Record --<br>
            Name: <?=$name?><br>
            Contact: <?=$contact?><br>
            City: <?=$city?><br>
            State: <?php
                        if($conn_error == false){
                            $sql = "SELECT * FROM adptestdb.state Where state_id={$state};";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                echo $row["state_name"];
                            }
                        }
                    ?><br>
            Zip: <?=$zip?><br>
            Salary: <?=$salary?><br><br>
        </span>

        <form method="POST" action="delete.php">  
        <input type="hidden" name="id" value="<?=$id?>">  
            Delete? <input type="submit" name="Submit" value="Yes"> / <input type="submit" name="Submit" value="No">
        </form>
    </body>
</html>
<?php
    $conn->close();
}
?>