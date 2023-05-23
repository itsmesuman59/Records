<?php
include 'connection.php';
if(isset($_GET["deleteId"]))
{
    $myId = $_GET['deleteId'];
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