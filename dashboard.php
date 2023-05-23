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
            <th>NAME</th>
            <th>ROLL</th>
            <th>GRADE</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th colspan="2">ACTION</th>
            <th>
            <button onclick="openForm()"> ADD </button>
            </th>
        </tr>
        <tr>
<?php
// error_reporting(E_ERROR | E_PARSE); Helps to hide warning messages
include 'connection.php';

$filtersearch = $_GET['searchBar'];
$sql = "select * from student where concat(name,roll) like '%$filtersearch%' ";
$result = $conn->query($sql);
if($result->num_rows>0)
{
    while($row = $result->fetch_assoc())
    {
        $name = $row["name"];
        $roll = $row["roll"];
        $grade = $row["grade"];
        $phone = $row["phone"];
        $address = $row["address"];
        echo
        '<tr>
        <td>'.$name.'</td>
        <td>'.$roll.'</td>
        <td>'.$grade.'</td>
        <td>'.$phone.'</td>
        <td>'.$address.'</td>
        <td <button> <a href="update.php?updateId='.$roll.'"> Edit </a> </button> </td>
        <td <button> <a href="delete.php?deleteId='.$roll.'"> Delete </a> </button> </td>
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
    <?php
    include 'connection.php';
    if(isset($_POST['submit']))
    {
        echo "Entered !!!";
        $name = $_POST["name"];
        $roll = $_POST["roll"];
        $grade = $_POST["grade"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $sqlnew = "insert into student (name,roll,grade,phone,address) values('$name','$roll','$grade','$phone','$address')";
        if($conn->query($sqlnew) === TRUE)
        {
            header("Location: " . "dashboard.php");
            echo "Successfully Inserted";
        }
        else
        {
            echo "Fail to Insert";
        }
    }
    $conn->close();
    ?>
    <div id="myForm" style="
    display: none;
    position: fixed;
    top: 27%;
    left: 35%;
    transform: translate(-50%, -50%);
    z-index: 9999;">
    <form method="POST">
    <!-- Your form content goes here -->
    <input type="text" name="name" placeholder="Name" required> <br>
    <input type="text" name="roll" placeholder="Roll" required> <br>
    <input type="text" name="grade" placeholder="Grade" required> <br>
    <input type="tel" name="phone" placeholder="Phone" required> <br>
    <input type="text" name="address" placeholder="Address" required> <br>
    <button type="submit" name="submit">Submit</button>
    <button type="submit" onclick="closeForm()">Close</button>
    </form>
    </div>
    <script>
    function openForm() {
    document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
    }
    </script>
</body>
</html>