<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="stiler.css">
    </head>

<?php

    include("config.php");

    $lokasjonValue = $_REQUEST['område'];
    $postnummerValue = $_REQUEST['postnummer'];
    $bransjeValue = $_REQUEST['bransje'];
    $statusValue = $_REQUEST['status'];
    $minAnsatteValue = $_REQUEST['minAnsatte'];
    $maxAnsatteValue = $_REQUEST['maxAnsatte'];
    $adrEndringValue = $_REQUEST['adrEndring'];
    $minInntektValue = $_REQUEST['minInntekt'];
    $maxInntektValue = $_REQUEST['maxInntekt'];
    $nextValue = $_REQUEST['next'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else {
    
    $wherequery = array();

        if (!empty($lokasjonValue)) {
            $wherequery[] = "lokasjon LIKE '%$lokasjonValue%'";
        }

        if (!empty($postnummerValue)) {
            $wherequery[] = "postnummer = $postnummerValue";
        }

        if (!empty($bransjeValue)){
            $wherequery[] = "bransje LIKE '%$bransjeValue%'";
        }

        if (!empty($statusValue)){
            $wherequery[] = "status LIKE '%$statusValue%'";
        }

        if (!empty($minAnsatteValue)){
            $wherequery[] = "antallAnsatte >= $minAnsatteValue";
        }

        if (!empty($maxAnsatteValue)){
            $wherequery[] = "antallAnsatte <= $maxAnsatteValue";
        }

        if (!empty($adrEndringValue)){
            $wherequery[] = "sisteAdrEndring <= $adrEndringValue";
        }

        if (!empty($minInntektValue)){
            $wherequery[] = "inntekt >= $minInntektValue";
        }

        if (!empty($maxInntektValue)){
            $wherequery[] = "inntekt <= $maxInntektValue";
        }

        if (!empty($nextValue)){
            $wherequery[] = "next LIKE '%$nextValue%'";
        }


        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
        } else {

        $query = "select firmanavn, antallAnsatte, kontaktperson, kommentar, fornavn, status
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
        ON lokasjon.lokasjonid=firma.lokasjonId
        JOIN bransje
        ON bransje.bransjeId=firma.bransjeId where " . join(' and ', $wherequery);

        print_r($wherequery) . "<br>";
        echo $query;

        
        $result = $conn->query($query);

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

            echo "</table>"; //Close the table in HTML

            $conn->close();
        }
    }

?>

</html>