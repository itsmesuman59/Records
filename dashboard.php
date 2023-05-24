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
<div class="parent">
<?php include 'header.php' ?>
<div class="mySection">
        <table>
            <tr>
                <th>
                    <form method="get">
                    <input type="text" name="searchBar" placeholder="Search ..." value="<?php if(isset($_GET['searchBar'])){echo $_GET['searchBar'];} ?>">
                    <center><input type="submit" value="Click"></center>
                    </form>
                </th>
                <th>
                <center><button onclick="openForm()" class="search-button"> ADD </button></center>
                </th>
            </tr>
            <tr>
                <th>NAME</th>
                <th>ROLL</th>
                <th>GRADE</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th colspan="2">ACTION</th>
            </tr>
            <tr>
                <?php
                error_reporting(E_ERROR | E_PARSE); // Helps to hide warning messages
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
                <td contenteditable="true">'.$name.'</td>
                <td contenteditable="true">'.$roll.'</td>
                <td contenteditable="true">'.$grade.'</td>
                <td contenteditable="true">'.$phone.'</td>
                <td contenteditable="true">'.$address.'</td>
                <td <button> <a href="update.php?updateId='.$roll.'"> Edit </a> </button> </td>
                <td <button> <a href="delete.php?deleteId='.$roll.'"> Delete </a> </button> </td>
                </tr>';
                }
                }
                else{
                // echo "No results found";
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
                                <div id="myForm">
                                <form method="POST">
                                <input type="text" name="name" placeholder="Name" required> <br><br>
                                <input type="text" name="roll" placeholder="Roll" required> <br><br>
                                <input type="text" name="grade" placeholder="Grade" required> <br><br>
                                <input type="tel" name="phone" placeholder="Phone" required> <br><br>
                                <input type="text" name="address" placeholder="Address" required> <br><br>
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
                                <script>
                                // Get all editable cells
                                const editableCells = document.querySelectorAll('td[contenteditable="true"]');

                                // Add event listener for each editable cell
                                editableCells.forEach(cell => {
                                cell.addEventListener('input', () => {
                                const editedContent = cell.innerText;
                                console.log(`Edited content: ${editedContent}`);
                                });
                                });
                                </script>
</div>
<?php include 'footer.php' ?>
</div>
</body>
</html>