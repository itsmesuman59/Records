<?php
include 'connection.php';

if(isset($_POST["submit"]))
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "update signup set fname='$fname',lname='$lname',phone='$phone',email='$email',password='$password' where id=$myId";
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
        <label> First Name </label>
        <input type="text" name="fname"> <br>
        <label> Last Name </label>
        <input type="text" name="lname"> <br>
        <label> Phone Number </label>
        <input type="text" name="phone"> <br>
        <label> Email </label>
        <input type="text" name="email"> <br>
        <label> Password </label>
        <input type="password" name="password"> <br>
        <!-- <label> Confirmation Password </label>
        <input type="password"> <br> -->
        <input type="submit" name="submit" value="SUBMIT">
        <button> <a href="index.php"> SIGN IN </a> </button>
    </form>
</body>
</html>