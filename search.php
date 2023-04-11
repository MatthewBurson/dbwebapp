<?php
session_start();
$action = "";

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
            span.title{
                font-weight: bold;
                font-size: 26pt;
                color: #ffffff;
            }
            span.title-reg{
                font-size: 12pt;
                color: #ffffff;
            }
            a.link1{
                font-size: 12pt;
                color: #e0ebeb;
            }
            a.link1:hover{
                font-size: 12pt;
                color: purple;
            }
            a.tnav{
                font-size: 11pt;
                color: #666666;
            }
            a.tnav:hover{
                font-size: 11pt;
                color: #D6EEEE;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th{
                text-align: left;
                padding: 8px;
                background-color: #93d2d2;
                font-weight: bold;
            }
            td {
                text-align: left;
                padding: 8px;
            }
            tr:nth-child(odd) {
                background-color: #D6EEEE;
            }
            span.f2{
                font-size: 16pt;
                color: #000000;
            }
            a.f2link{
                font-size: 16pt;
                color: #004466;
            }
            a.f2link:hover{
                font-size: 16pt;
                color: #4dc3ff;
            }
        </style>
    </head>
    <body>
        <div class="top-container">
            <div class="top-item1">
                <span class="title">ADP DB WebApp</span><br>
                <span class="title-reg">Customer Search Page</span>
            </div>
            <div class="top-item2">
                <span class="title-reg">Welcome, <?=$_SESSION["username"]?>.</span><br>
                <span class="title-reg">Click <a href="search.php?action=logout" class="link1">here</a> to logout.</span><br>
            </div>
        </div>
        <br><br>
        <span class="f2">Click <a href="insert.php" class="f2link">here</a> to add a salesperson to the database.</span>
            <?php
                if($conn_error == false){
                    $sql = "SELECT * FROM adptestdb.salesperson LEFT JOIN adptestdb.state on salesperson_state_id=state_id;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        ?>
                        <table width="99%">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Salary</th>
                                <th>Edit/Delete</th>
                            </tr>
                        <?php
                        $count = 1;
                        while($row = $result->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?=$count?></td>
                                <td><?=$row["salesperson_name"]?></td>
                                <td><?=$row["salesperson_contact"]?></td>
                                <td><?=$row["salesperson_city"]?></td>
                                <td><?=$row["state_name"]?></td>
                                <td><?=$row["salesperson_zip"]?></td>
                                <td>$<?=$row["salesperson_salary"]?></td>
                                <td>
                                    <a href="update.php?action=edit&id=<?=$row["salesperson_id"]?>" class="tnav">Edit</a> / <a href="delete.php?action=delete&id=<?=$row["salesperson_id"]?>"  class="tnav">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                        </table>
                        <?php
                    }else{
                        echo "0 results";
                    }
                }else{
                    echo "No results to display due to connection error.";
                }
            ?>
    </body>
</html>
<?php
}
?>