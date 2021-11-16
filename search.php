<?php

session_start();

if($_SESSION["verified"] != true || !isset($_SESSION["verified"])) {
    header("Location: login.php");
    exit();
}

?>

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
<?php
    include("config.php");
    if(isset($_REQUEST['searchbutton'])){
        $searchValue = $_REQUEST['search'];

        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
        } else {
            
            $sql = "SELECT firma.orgNum, firmanavn, antallAnsatte, kontaktperson, kommentar, fornavn, status
            FROM firma
            JOIN kontaktinfo
            ON kontaktinfo.orgNum=firma.orgNum
            JOIN firmakommentar
            ON firmakommentar.orgNum=firma.orgNum
            JOIN status
            ON status.statusId=firmakommentar.statusId
            JOIN ansatte
            ON ansatte.ansattId=firmakommentar.ansattId
            WHERE firmanavn LIKE '%$searchValue%' order by antallAnsatte DESC";

            $result = $conn->query($sql);
            echo "<div class='container'>
            <table>
            <tr>
            <th style='display:none;'>Org.Num</th>
            <th>Firmanavn</th>
            <th>Kontaktperson</th>
            <th>Antall ansatte</th>
            <th>Status</th>
            <th>Vår kontaktperson</th>
            <th>Kommentar</th>
            <th></th>
            <th></th>
            </tr>";

            while ($row = $result->fetch_assoc()){

                echo "<tr>
                <td style='display:none;'>" . $row['orgNum'] . "</td>
                <td>" . $row['firmanavn'] . "</td>
                <td>" . $row['kontaktperson'] . "</td>
                <td>" . $row['antallAnsatte'] . "</td> 
                <td>" . $row['status'] . "</td>
                <td>" . $row['fornavn'] . "</td>
                <td>" . $row['kommentar'] . "</td>
                <td><button name='showMore'><a href=visMer.php?orgNum=" . $row['orgNum'] . " style='text-decoration: none;'> Vis mer</a></button></td>
                <td><button name='edit'><a href=rediger.php?orgNum=" . $row['orgNum'] . " style='text-decoration: none;'> Rediger</a></button></td>
                </tr></div>";
            }
        }
    }

    
?>
</body>

</html>