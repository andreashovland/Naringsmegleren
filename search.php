<html>
<head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="styles.css">
    </head>
<body>

<?php
    include("config.php");
    if(isset($_REQUEST['searchbutton'])){
        $searchValue = $_REQUEST['search'];
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
        } else {
            echo "connection successful" . "<br>"; //test
            
            $sql = "SELECT firmanavn, antallAnsatte, kontaktperson, kommentar, fornavn, status
            FROM firma
            JOIN kontaktinfo
            ON kontaktinfo.orgNum=firma.orgNum
            JOIN firmakommentar
            ON firmakommentar.orgNum=firma.orgNum
            JOIN status
            ON status.statusId=firmakommentar.statusId
            JOIN ansatte
            ON ansatte.ansattId=firmakommentar.ansattId
            WHERE firmanavn LIKE '%$searchValue%'";

            echo $sql; //test


            $result = $conn->query($sql);
            echo "<div class='container'>
            <table>
            <tr>
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
                <td>" . $row['firmanavn'] . "</td>
                <td>" . $row['kontaktperson'] . "</td>
                <td>" . $row['antallAnsatte'] . "</td> 
                <td>" . $row['status'] . "</td>
                <td>" . $row['fornavn'] . "</td>
                <td>" . $row['kommentar'] . "</td>
                <td><button class='visMer'>Vis mer</button></td>
                <td><button class='rediger'>Rediger</button></td>
                </tr></div>";
            }
        }
    }

    
?>
</body>

</html>