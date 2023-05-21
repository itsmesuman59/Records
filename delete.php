<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recordms";
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_GET["updateId"]))
{
    $myId = $_GET['updateId'];
    $sql = "delete from signup where id=$myId";
    if($conn->query($sql) === TRUE)
    {
        header("Location: " . "dashboard.php");
    }
    else{
        echo "Fail to Delete";
    }
}
$conn->close();
?>