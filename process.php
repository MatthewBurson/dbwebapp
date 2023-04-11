<html>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "Method: Post<br<br>>";
                if(empty($_POST["firstname"])){
                    echo "<br><br>No first name provided!";
                }else{
                    echo "<br><br>First Name : " . $_POST["firstname"];
                }
                if(empty($_POST["lastname"])){
                    echo "<br><br>No last name provided!";
                }else{
                    echo "<br><br>Last Name : " . $_POST["lastname"];
                }
                if(empty($_POST["password"])){
                    echo "<br><br>No password provided!";
                }else{
                    echo "<br><br>Password : " . $_POST["password"];
                }
                if(empty($_POST["member"])){
                    echo "<br><br>You are not a member!";
                }else{
                    echo "<br><br>Member : " . $_POST["member"];
                }
            }else{
                echo "Method: Get";



            }

        ?>
    </body>
</html>