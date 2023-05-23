<?php
include 'connection.php';
    $myId = $_GET['deleteId'];
    $sql = "delete from student where roll=$myId";
    if($conn->query($sql) === TRUE)
    {
        header("Location: " . "dashboard.php");
    }
    else{
        echo "Fail to Delete";
    }
$conn->close();
?>