<?php

include('config.php');
//include('filter.php');

$postnummer = $_POST['postnr'];
//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT firma_navn FROM firma WHERE postnummer LIKE '%$postnummer%'"; //You don't need a ; like you do in SQL
$result = $conn->query($sql);

echo "<table>"; // start a table tag in the HTML

while($row = $result->fetch_assoc()) {   //Creates a loop to loop through results
echo "<tr><td>" . $row['firmanavn'] /*. "</td><td>" . $row['fornavn'] . "</td><td>" . $row['etternavn']*/."</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

$conn->close(); //Make sure to close out the database connection


?>