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
    $sql = "select * from signup where email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            // echo $row['email']."<br>";
            // echo $row['password'];
            if($email == $row['email'] && $password == $row['password'])
            {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (1*180);
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="signup-container">
    <div class="signup-form">
        <div class="signup-form-A">
            <?php
            session_start();
            if(isset($_SESSION['email']))
            {
                // echo "Data Exist";
                // echo $_SESSION['email'];
            }
            else{
                // echo "Please log in to continue";
            }
            ?>
            <h1 style="text-align:center; padding-top:25px; text-color:white;">SIGN IN</h1>
        </div>
        <div class="signup-form-B">
            <form method="post" class="myForm">
                <label for="email"> Email </label><br>
                <input type="email" name="email" placeholder="Enter your Email" required> <br><br>
                <label for="password"> Password </label><br>
                <input type="password" name="password" placeholder="Enter your Password" required> <br><br>
                <input type="submit" name="submit" value="SIGN IN"> <br> <br>
                <a href="signup.php"> <input type="button" value="SIGN UP"> </a> <br> <br>
            </form>
    </div>
        <div class="signup-form-C"></div>
    </div>
    </div>
</body>
</html>