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

        echo "Område: " . $lokasjonValue . "<br>";
        echo "Postnummer: " . $postnummerValue . "<br>";
        echo "Bransje: " . $bransjeValue . "<br>";
        echo "Status: " . $statusValue . "<br>";
        echo "Min ansatte: " . $minAnsatteValue . "<br>";
        echo "Max ansatte: " . $maxAnsatteValue . "<br>";
        echo "Siste adresseendring: " . $adrEndringValue . "<br>";
        echo "Min omsetning: " . $minOmsetningValue . "<br>";
        echo "Max omsetning: " . $maxOmsetningValue . "<br>";
        echo "Next?: " . $nextValue . "<br>"; 
        
        
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
            JOIN lokasjon 
            ON lokasjon.lokasjonId=firma.lokasjonId
            JOIN bransje
            ON bransje.bransjeId=firma.bransjeId
            WHERE lokasjon LIKE '%$lokasjonValue%' and postnummer LIKE '%$postnummerValue%' and status LIKE '%$statusValue%' 
            and antallAnsatte >= $minAnsatteValue and antallAnsatte <= $maxAnsatteValue and siste_adr_endr >= $adrEndringValue
            and omsetning >= $minOmsetningValue and omsetning <= $maxOmsetningValue and next LIKE '%$nextValue%'";

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