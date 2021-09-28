<html>
<head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="styles.css">
    </head>
<body>

<?php

    if(isset($_REQUEST['searchbutton'])){
        $searchValue = $_REQUEST['search'];
        $con = new mysqli("localhost", "root", "", "Næringsmegleren");

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        } else {
            $sql = "SELECT firmaNavn, antallAnsatte, kontaktPerson, kommentarDetalj, fornavn, status
            FROM firma
            JOIN kontaktinfo
            ON kontaktinfo.orgNum=firma.orgNum
            JOIN firmakommentar
            ON firmakommentar.orgNum=firma.orgNum
            JOIN status
            ON status.statusId=firmakommentar.statusId
            JOIN ansatte
            ON ansatte.ansattId=firmakommentar.ansattId
            WHERE firmaNavn LIKE '%$searchValue%'";


            $result = $con->query($sql);
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
                <td>" . $row['firmaNavn'] . "</td>
                <td>" . $row['kontaktPerson'] . "</td>
                <td>" . $row['antallAnsatte'] . "</td> 
                <td>" . $row['status'] . "</td>
                <td>" . $row['fornavn'] . "</td>
                <td>" . $row['kommentarDetalj'] . "</td>
                <td><button class='visMer'>Vis mer</button></td>
                <td><button class='rediger'>Rediger</button></td>
                </tr></div>";
            }
        }
    }

    
?>
</body>

</html>