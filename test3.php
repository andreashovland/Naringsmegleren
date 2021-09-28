<?php



    if(isset($_REQUEST['searchbutton'])){
        $searchValue = $_REQUEST['search'];
        $con = new mysqli("localhost", "root", "", "Næringsmegleren");
        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
        } else {
            $sql = "SELECT * FROM firma WHERE firmaNavn LIKE '%$searchValue%'";
            
            /*"SELECT firmaNavn, kontaktPerson, antallAnsatte, status, kommentarDetalj
            FROM "*/
            
            

            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()){
                echo $row['orgNum'] . "<br>";
                echo $row['firmaNavn'] . "<br>";
                echo $row['adresse'] . "<br>";
                echo $row['lokasjonId'] . "<br>";
                echo $row['antallAnsatte'] . "<br>";
                echo $row['bransjeId'] . "<br>";
                echo $row['bransjedetalj'] . "<br>";
            }
        }
    }
?>