<?php
/*
session_start();

if($_SESSION["verified"] != true || !isset($_SESSION["verified"])) {
    header("Location: login.php");
    exit();
}
*/
?>

<!DOCTYPE html>
<html>

<head>
    <title>Næringsmegleren</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <div class="bg"></div>
    <div class="header">
        <img src="bilder/logo.dark.png" alt="logo-dark" width="15%" height="60%">
    </div>

    <section class="content">
        <div class="box">
            <form method="post" id="form1" action="search.php">
                <input type="text" name="search" placeholder="Søk">
                <input type="submit" value="Søk" name="searchbutton">
            </form><br>
            <a href="filterside.php" style="text-decoration: none;">
                <button class="filter">Filter</button>
            </a>
        </div>
    </section>

</body>

</html>