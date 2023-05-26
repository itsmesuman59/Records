<div class="myHeader">
    <?php
    session_start();
    if(isset($_SESSION['email']))
    {
    // echo $_SESSION['email'];
    }
    else
    {
        header("Location: " . "index.php");
    }
    ?>
    <a href="logout.php"> <button style="position:fixed;top:5px; right:20px;"> LOG OUT </button> </a>
</div>