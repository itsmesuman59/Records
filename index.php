<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recordms";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["submit"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "select * from signup where id=1";
    $result = $conn->query($sql);
    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            // echo $row['email']."<br>";
            // echo $row['password'];
            if($email == $row['email'] && $password == $row['password'])
            {
                header("Location: " . "dashboard.php");
    exit();
            }
            else
            {
                echo "Login Failed";
            }
        }
    }
    else{
        echo "No results found";
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
        <label> Email </label>
        <input type="email" name="email"> <br>
        <label> Password </label>
        <input type="password" name="password"> <br>
        <input type="submit" name="submit" value="SIGN IN">
        <button> <a href="signup.php"> SIGN UP </a> </button>
    </form>
</body>
</html>