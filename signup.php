<?php
include 'connection.php';
if(isset($_POST["submit"]))
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

// Server Side Validation Begin
$errors = [];

// Validate name
if (empty($fname)) {
$errors[] = "First Name is required.";
}
if (empty($lname)) {
$errors[] = "Last Name is required.";
}
if(!preg_match('/^[A-Za-z]+$/', $fname))
{
    $errors[] = "The text contains non-alphabetic characters.";
}
if(!preg_match('/^[A-Za-z]+$/', $lname))
{
    $errors[] = "The text contains non-alphabetic characters.";
}
if (empty($phone)) {
$errors[] = "Phone is required.";
}
if (!preg_match('/^\d+$/', $phone)) {
    $errors[] = "The phone number is invalid (contains non-numeric characters).";
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

if (!preg_match('/[a-zA-Z]/', $password)) {
    $errors[] = "Password must contain 1 letter.";
}
if (!preg_match('/\d/', $password)) {
    $errors[] = "Password must contain 1 number.";
}
if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "Password must contain 1 capital letter.";
}
if (!preg_match('/[a-z]/', $password)) {
    $errors[] = "Password must contain 1 small letter.";
}
// Server Side Validation End

// Check for errors
if (!empty($errors)) {
    // Display errors and redirect back to the form
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  } else {
    // Validation successful, do further processing (e.g., store in database)
    // ...
    $sql = "select * from signup where email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Email address is already registered
        echo "Email address is already registered.";
    }
    else{
    $myEncrypt= password_hash($password,PASSWORD_DEFAULT);
    // $myEncryptTwo = substr($myEncrypt, 0, 10); // Reducing the encrypting password to 10
    $sqltwo = "insert into signup (fname, lname, phone, email, password, encrypt) values ('$fname','$lname','$phone','$email','$password','$myEncrypt')";
    if($conn->query($sqltwo) === TRUE)
    {
        echo "Successfully Signup";
    }
    else{
        echo "Fail to Signup";
    }
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup-container">
    <div class="signup-form">
        <div class="signup-form-A">
            <h1 style="text-align:center; padding-top:25px; text-color:white;">SIGN UP</h1>
        </div>
        <div class="signup-form-B">
            <form method="post" class="myForm">
                <label for="fname"> First Name </label><br>
                <input type="text" name="fname" placeholder="Enter your First Name"required> <br><br>
                <label for="lname"> Last Name </label><br>
                <input type="text" name="lname" placeholder="Enter your Last Name"required> <br><br>
                <label for="phone"> Phone Number </label><br>
                <input type="tel" name="phone" placeholder="Enter your Phone Number"required> <br><br>
                <label for="email"> Email </label><br>
                <input type="email" name="email" placeholder="Enter your Email"required> <br><br>
                <label for="password"> Password </label><br>
                <input type="password" name="password" placeholder="Enter your Password"required> <br><br>
                <input type="submit" name="submit" value="SUBMIT">
            </form>
    </div>
        <div class="signup-form-C"></div>
    </div>
    </div>
</body>
</html>