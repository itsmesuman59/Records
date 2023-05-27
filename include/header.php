<div class="myHeader">
    <?php
    session_start();
    if(isset($_SESSION['email']))
    {
        $current = time();
        if ($current>$_SESSION['expire']) {
        session_destroy();
        header("Location: " . "index.php");
        // exit();
        }
    }
    else
    {
        header("Location: " . "index.php");
    }
    ?>
    <div style="position:fixed;top:5px; right:20px;">
    <?php
    echo $_SESSION['fname'];
    echo "    ";
    echo $_SESSION['lname'];
    ?>
    </div>
    <a href="logout.php"> <button style="position:fixed;top:30px; right:30px; background-color:yellow; border:5px solid white;"> LOG OUT </button> </a>
</div>