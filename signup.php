<?php
include 'connection.php';
if(isset($_POST["submit"]))
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

// Validation
$errors = [];

// Validate name
if (empty($fname)) {
$errors[] = "First Name is required.";
}
if (empty($lname)) {
$errors[] = "Last Name is required.";
}
if (empty($phone)) {
$errors[] = "Phone is required.";
}

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
    // Validation successful, do further processing (e.g., store in database)
    // ...
    $sql = "insert into signup (fname, lname, phone, email, password) values ('$fname','$lname','$phone','$email','$password')";
    if($conn->query($sql) === TRUE)
    {
        echo "Successfully Signup";
    }
    else{
        echo "Fail to Signup";
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
        <h3> SIGN UP </h3>
        <label> First Name </label>
        <input type="text" name="fname" required> <br>
        <label> Last Name </label>
        <input type="text" name="lname" required> <br>
        <label> Phone Number </label>
        <input type="text" name="phone" required> <br>
        <label> Email </label>
        <input type="text" name="email" required> <br>
        <label> Password </label>
        <input type="password" name="password" required> <br>
        <!-- <label> Confirmation Password </label>
        <input type="password"> <br> -->
        <input type="submit" name="submit" value="SUBMIT">
        <button> <a href="index.php"> SIGN IN </a> </button>
    </form>
</body>
</html>