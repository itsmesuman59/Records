<?php
include 'connection.php';
if(isset($_POST["submit"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validation
$errors = [];

// Validate email
if (empty($email)) {
$errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$errors[] = "Invalid email format.";
}

// Validate password
if (empty($password)) {
$errors[] = "Password is required.";
} elseif (strlen($password) < 8) {
$errors[] = "Password must be at least 8 characters long.";
}

// Check for errors
if (!empty($errors)) {
    // Display errors and redirect back to the form
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  } else {
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
        <input type="email" name="email" required> <br>
        <label> Password </label>
        <input type="password" name="password" required> <br>
        <input type="submit" name="submit" value="SIGN IN">
        <button> <a href="signup.php"> SIGN UP </a> </button>
    </form>
</body>
</html>