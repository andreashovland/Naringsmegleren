<!DOCTYPE html>
<html>
<body>

<?php

function ansatte() {
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
    echo "<option value='>Velg ansatt</option>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . "'>" . $row['fornavn']  . " " . $row['etternavn'] . "</option>";
    }
    echo "</select>";

} else {
    echo "0 results";
}


$conn->close();
}

function area() {
    include('config.php');
    
    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = "SELECT lokasjon FROM lokasjon";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<select name='lokasjon'>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . "'>" . $row['lokasjon']  . "</option>";
        }
        echo "</select>";
    
    } else {
        echo "0 results";
    }

    $conn->close();
}

function bransje() {
    include('config.php');
    
    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = "SELECT bransje FROM bransje";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<select name='bransje'>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . "'>" . $row['bransje'] . "</option>";
        }
        echo "</select>";
    
    } else {
        echo "0 results";
    }
    
    $conn->close();
    }

function status() {
        include('config.php');
        
        //create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
        $sql = "SELECT status FROM status";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<select name='status'>";
            //echo "<option value="no
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . "'>" . $row['status'] . "</option>";
            }
            echo "</select>";
        
        } else {
            echo "0 results";
        }
        
        $conn->close();
        }

?>

</body>
</html>
