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
    $minOmsetningValue = $_REQUEST['minOmsetning'];
    $maxOmsetningValue = $_REQUEST['maxOmsetning'];
    $nextValue = $_REQUEST['next'];

    $conn = new mysqli($servername, $username, $password, $dbname);


    $wherequery = array();

        if (!empty($postnummerValue)) {
            $wherequery[] = "postnummer = $postnummerValue";
        }

        if (!empty($minAnsatteValue)){
            $wherequery[] = "antall_ansatte >= $minAnsatteValue";
        }

        if (!empty($statusValue)){
            $wherequery[] = "antall_ansatte >= $statusValue";
        }


        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        } else {

        $query = "select * from firma where " . join(' and ', $wherequery);

        print_r($wherequery) . "<br>";
        echo $query;

        
        $result = $conn->query($query);

        echo "<div class='container'>
            <table>
            <tr>
            <th>Organisasjonsnummer</th>
            <th>Firmanavn</th>
            <th>Adresse</th>
            <th>Lokasjon ID</th>
            <th>Antall ansatte</th>
            <th>Bransje ID</th>
            <th>Bransje Detalj</th>
            <th>Postnummer</th>
            <th></th>
            <th></th>
            </tr>";

            while ($row = $result->fetch_assoc()){

                echo "<tr>
                <td>" . $row['org_num'] . "</td>
                <td>" . $row['firma_navn'] . "</td>
                <td>" . $row['adresse'] . "</td>
                <td>" . $row['lokasjon_id'] . "</td>
                <td>" . $row['antall_ansatte'] . "</td>
                <td>" . $row['bransje_id'] . "</td> 
                <td>" . $row['bransje_detalj'] . "</td>
                <td>" . $row['postnummer'] . "</td>
                <td><button class='visMer'>Vis mer</button></td>
                <td><button class='rediger'>Rediger</button></td>
                </tr></div>";
            }

            echo "</table>"; //Close the table in HTML

            $conn->close();
        }
        
?>

</html>