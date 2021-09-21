<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="header">
            <img src="bilder/logo_senter_hvit.png" class="logo">
        </div>

        <div class="box">

            <form method="post" id="form1">
                <input type="text" name="søk" placeholder="Søk">
                <input type="submit" value="Søk" name="søkeknapp">
            </form><br>
            <a href="filter.php" style="text-decoration: none;">
            <button class="filter">Filter</button>
            </a>
        </div>
    </body>
</html>

<?php

include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT firmaNavn, adresse, antallAnsatte, bransjeDetalj FROM firma";
$result = $conn->query($conn, $sql);
$queryResults = mysqli_num_rows($result);

if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        echo "<table><tr>
        <th>Firma</th>
        <th>Adresse</th>
        <th>Antall ansatte</th>
        <th>Bransje</th>
        </tr>
        <tr>
        <td>" .$row['firmaNavn']. "</td>
        <td>" .$row['adresse']. "</td>
        <td>" .$row['antallAnsatte']. "</td>
        <td>" .$row['bransjeDetalj']. "</td>
        </tr></table>";
    }
}
?>