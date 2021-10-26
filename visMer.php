<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="filter.css">
    </head>
    <body>
    <div class="filtere">
<?php
    include("config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);

    // henter orgnummeret fra valgt firma
    $orgNum = $_GET['orgNum'];

    // select statement for alle tabellene
    $firma = "select * from firma where orgNum = $orgNum";
    $bransje = "select bransje from bransje JOIN firma ON bransje.bransjeId=firma.bransjeId where firma.orgNum = $orgNum";
    $kontaktinfo = "select * from kontaktinfo where orgNum = $orgNum";
    $ansatte = "select fornavn from ansatte JOIN firmakommentar ON ansatte.ansattId=firmakommentar.ansattId 
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum";
    $status = "select status from status JOIN firmakommentar ON status.statusId=firmakommentar.statusId
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum";
    $firmakommentar = "select * from firmakommentar where orgNum = $orgNum";
    
    // Array for firma
    $firmaResult = $conn->query($firma);

    while ($row = $firmaResult->fetch_assoc()){
    $array = array(            
        "Org.Num" => $row['orgNum'],
        "Firmanavn" => $row['firmanavn'],
        "Adresse" => $row['adresse'],
        "Postnummer" => $row['postnummer'],
        "Antall ansatte" => $row['antallAnsatte'],
        "Siste adresseendring" => $row['sisteAdrEndring'],
        "Inntekt" => number_format($row['inntekt']),
        "Bransje detalj" => $row['bransjedetalj']
    );
        foreach($array as $x => $value) {
            echo "<br><b><font color=\"black\">" . $x . "</font>".": </b>" . $value . "</font>";
        }
    }

    // Array for bransje
    $bransjeResult = $conn->query($bransje);

    while ($row = $bransjeResult->fetch_assoc()){
    $array = array(            
        "Bransje" => $row['bransje']
    );
        foreach($array as $x => $value) {
            echo "<br><b><font color=\"black\">" . $x . "</font>".": </b>" . $value . "</font>";
        }
    } 
    echo "<br>";

    // Array for kontaktinfo
    $kontaktinfoResult = $conn->query($kontaktinfo);

    while ($row = $kontaktinfoResult->fetch_assoc()){
    $array = array(            
        "Kontaktperson" => $row['kontaktperson'],
        "Telefon" => $row['tlf'],
        "E-post" => $row['epost'],
    );
        foreach($array as $x => $value) {
            echo "<br><b><font color=\"black\">" . $x . "</font>".": </b>" . $value . "</font>";
        }
    }
    echo "<br>";

    // Array for ansatte
    $ansatteResult = $conn->query($ansatte);

    while ($row = $ansatteResult->fetch_assoc()){
    $array = array(            
        "Vår kontaktperson" => $row['fornavn']
    );
        foreach($array as $x => $value) {
            echo "<br><b><font color=\"black\">" . $x . "</font>".": </b>" . $value . "</font>";
        }
    }

    // Array for status
    $statusResult = $conn->query($status);

    while ($row = $statusResult->fetch_assoc()){
    $array = array(            
        "Status" => $row['status']
    );
        foreach($array as $x => $value) {
            echo "<br><b><font color=\"black\">" . $x . "</font>".": </b>" . $value . "</font>";
        }
    }

    // Array for firmakommentar
    $firmakommentarResult = $conn->query($firmakommentar);

    while ($row = $firmakommentarResult->fetch_assoc()){
    $array = array(            
        "Kommentar" => $row['kommentar']
    );
        foreach($array as $x => $value) {
            echo "<br><b><font color=\"black\">" . $x . "</font>".": </b>" . $value . "</font>";
        }
    }
            $conn->close();

    ?>
        <div class="redigerknapp">
            <a href="rediger.php?orgNum=" <?php $orgNum?>>
                <button>Rediger</button>
            </a>
        </div>
    </div>
    
    </body>
</html>
