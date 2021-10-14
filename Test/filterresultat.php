<html>
<head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="stiler.css">
    </head>
<body>

<?php
if(isset($_REQUEST['filterbutton'])){
    $lokasjonValue = $_REQUEST['område'];
    $postnummerValue = $_REQUEST['postnummer'];
    $bransjeValue = $_REQUEST['bransje'];
    $statusValue = $_REQUEST['status'];
    $minAnsatteValue = $_REQUEST['minAnsatte'];
    $maxAnsatteValue = $_REQUEST['maxAnsatte'];
    $adrEndringValue = $_REQUEST['adrEndring'];
    $minOmsetningValue = $_REQUEST['minOmsetning'];
    $maxOmsetningValue = $_REQUEST['maxOmsetning'];
    $nextValue = $_REQUEST['next'];
    
    
    $con = new mysqli("localhost", "root", "", "Næringsmegleren");

    if ($con->connect_error) {
        echo "Connection failed: " . $con->connect_error;
    } else {

        $sql = "SELECT firmaNavn, antallAnsatte, kontaktPerson, kommentarDetalj, fornavn, status
            FROM firma
            LEFT JOIN kontaktinfo
            ON kontaktinfo.orgNum=firma.orgNum
            LEFT JOIN firmakommentar
            ON firmakommentar.orgNum=firma.orgNum
            LEFT JOIN status
            ON status.statusId=firmakommentar.statusId
            LEFT JOIN ansatte
            ON ansatte.ansattId=firmakommentar.ansattId
            LEFT JOIN lokasjon 
            ON lokasjon.lokasjonId=firma.lokasjonId
            LEFT JOIN bransje
            ON bransje.bransjeId=firma.bransjeId
            WHERE lokasjon LIKE '%$lokasjonValue%' and status LIKE '%$statusValue%' and antallAnsatte >= '%$minValue%'";


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