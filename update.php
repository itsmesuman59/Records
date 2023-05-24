<?php
include 'connection.php';

$myId = $_GET["updateId"];

if(isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $roll = $_POST["roll"];
    $grade = $_POST["grade"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sql = "update student set name='$name',roll='$roll',grade='$grade',phone='$phone',address='$address' where roll=$myId";
    if($conn->query($sql) === TRUE)
    {
        header("Location: " . "dashboard.php");
    }
    else{
        echo "Fail to Update";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h3> SIGN UP </h3>
        <label> Name </label>
        <input type="text" name="name"> <br>
        <label> Roll </label>
        <input type="text" name="roll"> <br>
        <label> Grade </label>
        <input type="text" name="grade"> <br>
        <label> Phone </label>
        <input type="tel" name="phone"> <br>
        <label> Address </label>
        <input type="text" name="address"> <br>
        <input type="submit" name="submit" value="SUBMIT">
        <button> <a href="index.php"> SIGN IN </a> </button>
    </form>
</body>
</html>