<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Dashboard </h1>
    <form action="" method="get">
    <input type="text" name="searchBar" value="<?php if(isset($_GET['searchBar'])){echo $_GET['searchBar'];} ?>">
    <input type="submit" value="SEARCH">
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th colspan="2">ACTION</th>
        </tr>
        <tr>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recordms";
$conn = new mysqli($servername, $username, $password, $dbname);
$filtersearch = $_GET['searchBar'];
$sql = "select * from signup where concat(id) like '%$filtersearch%' ";
$result = $conn->query($sql);
if($result->num_rows>0)
{
    while($row = $result->fetch_assoc())
    {
        $id = $row["id"];
        $fname = $row["fname"];
        $lname = $row["lname"];
        $phone = $row["phone"];
        $email = $row["email"];
        $password = $row["password"];
        echo
        '<tr>
        <td>'.$id.'</td>
        <td>'.$fname.'</td>
        <td>'.$lname.'</td>
        <td>'.$phone.'</td>
        <td>'.$email.'</td>
        <td>'.$password.'</td>
        <td <button> <a href="update.php?updateId='.$id.'"> Edit </a> </button> </td>
        <td <button> <a href="delete.php?deleteId='.$id.'"> Delete </a> </button> </td>
        </tr>';
    }
}
else{
    echo "No results found";
}
$conn->close();
?>
        </tr>
    </table>
</body>
</html>