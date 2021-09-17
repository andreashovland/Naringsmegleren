<!DOCTYPE html>
<html>
<body>

<?php

include('config.php');

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT fornavn, etternavn FROM ansatte";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<select name='ansatte'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . "'>" . $row['fornavn']  . " " . $row['etternavn'] . "</option>";
    }
    echo "</select>";

} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
