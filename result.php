<?php

include('config.php');
//include('filter.php');

$postnummer = $_REQUEST['postnr'];
$maksansatte = $_REQUEST['antallansattmaks'];
$minansatte = $_REQUEST['antallansattmin'];
//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "SELECT firma_navn, antall_ansatte, kontakt_person, kommentar_detalj, fornavn, status
                FROM firma
                JOIN kontakt_info ON kontakt_info.org_num=firma.org_num
                JOIN firma_kommentar ON firma_kommentar.org_num=firma.org_num
                JOIN status ON status.status_id=firma_kommentar.status_id
                JOIN ansatte ON ansatte.ansatt_id=firma_kommentar.ansatt_id
                WHERE antall_ansatte >" . $_REQUEST['antallansattmin'] . "
                OR antall_ansatte <" . $_REQUEST['antallansattmaks'] . "
                OR postnummer LIKE '%" . $_REQUEST['postnr'] . "%'";



//$sql= "SELECT firma_navn, antall_ansatte FROM firma WHERE postnummer LIKE '%$postnummer%'"; //You don't need a ; like you do in SQL





$result = $conn->query($sql);


echo "<table>
            <tr>
            <th>Firmanavn</th>
            <th>Kontakperson</th>
            <th>Antall ansatte</th>
            <th>Status</th>
            <th>Vår kontaktperson</th>
            <th>Kommentar</th>
            </tr>"; // start a table tag in the HTML

while($row = $result->fetch_assoc()) {   //Creates a loop to loop through results
    echo "<tr>
                <td>" . $row['firma_navn'] . "</td>
                <td>" . $row['kontakt_person'] . "</td>
                <td>" . $row['antall_ansatte'] . "</td> 
                <td>" . $row['status'] . "</td>
                <td>" . $row['fornavn'] . "</td>
                <td>" . $row['kommentar_detalj'] . "</td>
                </tr>";
//echo "<tr><td>" . $row['firma_navn'] . "</td><td>" . $row['antall_ansatte'] . /*"</td><td>" . $row['etternavn']*/ "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

$conn->close(); //Make sure to close out the database connection


?>