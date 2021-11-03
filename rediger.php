<html>
<head>
    <title>Næringsmegleren</title>
    <link rel="stylesheet" href="css/filter.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="bg"></div>
<div class="filtere">

<?php
    include("config.php");

    $orgNum = $_GET['orgNum']; // Henter orgnummer fra valgt rad

    // select statement for alle tabellene
    $firma = mysqli_query($conn,"select * from firma where orgNum = $orgNum");
    $bransje = mysqli_query($conn,"select bransje from bransje JOIN firma ON bransje.bransjeId=firma.bransjeId where firma.orgNum = $orgNum");
    $kontaktinfo = mysqli_query($conn,"select * from kontaktinfo where orgNum = $orgNum");
    $ansatte = mysqli_query($conn,"select fornavn from ansatte JOIN firmakommentar ON ansatte.ansattId=firmakommentar.ansattId 
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum");
    $status = mysqli_query($conn,"select status from status JOIN firmakommentar ON status.statusId=firmakommentar.statusId
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum");
    $firmakommentar = mysqli_query($conn,"select * from firmakommentar where orgNum = $orgNum");


    while ($rowFirma = mysqli_fetch_array($firma)){
        $array = array(            
            "Org.Num" => $rowFirma['orgNum'],
            "Firmanavn" => $rowFirma['firmanavn'],
            "Adresse" => $rowFirma['adresse'],
            "Postnummer" => $rowFirma['postnummer'],
            "Antall ansatte" => $rowFirma['antallAnsatte'],
            "Siste adresseendring" => $rowFirma['sisteAdrEndring'],
            "Inntekt" => number_format($rowFirma['inntekt']),
            "Bransje detalj" => $rowFirma['bransjedetalj']
        );
            foreach($array as $x => $value) {
                echo "<br><b><font color=\"white\">" . $x .": </b>" . $value . "</font>";
            }
        }


    while ($rowBransje = mysqli_fetch_array($bransje)){
        $array = array(            
            "Bransje" => $rowBransje['bransje']
        );
            foreach($array as $x => $value) {
                echo "<br><b><font color=\"white\">" . $x .": </b>" . $value . "</font>";
            }
        } 
        echo "<br>";


    while ($rowKontaktinfo = mysqli_fetch_array($kontaktinfo)){
        $array = array(            
            "Kontaktperson" => $rowKontaktinfo['kontaktperson'],
            "Telefon" => $rowKontaktinfo['tlf'],
            "E-post" => $rowKontaktinfo['epost'],
        );
            foreach($array as $x => $value) {
                echo "<br><b><font color=\"white\">" . $x .": </b>" . $value . "</font>";
            }
        }
        echo "<br>";

    $rowAnsatte = mysqli_fetch_array($ansatte);
    $rowStatus = mysqli_fetch_array($status);
    $rowFirmakommentar = mysqli_fetch_array($firmakommentar);

    if(isset($_POST['rediger'])){

        $vårKontaktperson = $_POST['vårKontaktperson'];
        $statusPost = $_POST['statusPost'];
        $kommentarPost = $_POST['kommentarPost'];

        $editKommentar = "UPDATE firmakommentar SET statusId='$statusPost', kommentar='$kommentarPost', ansattId='$vårKontaktperson' WHERE orgNum='$orgNum'";
        
        $query_run = mysqli_query($conn, $editKommentar);

        if($query_run)
        {   
        mysqli_close($conn); // Close connection
        header("location:visMer.php?orgNum=". $orgNum); // redirects to members page
        exit;

        }
        else {
        }    	
    }
?>

<div>
<form method="post">
    <div class="box-rediger">
    <br>

        <label for="vårKontaktperson">Vår kontaktperson: </label>
        <select name="vårKontaktperson">
            <option></option>
            <option value="1" <?php if($rowFirmakommentar['ansattId']==1) echo 'selected="selected"'; ?>>Unni</option>
            <option value="2" <?php if($rowFirmakommentar['ansattId']==2) echo 'selected="selected"'; ?>>-</option>
        </select><br>

        <label for="statusPost">Status: </label>
        <select name="statusPost">
            <option></option>
            <option value="1" <?php if($rowFirmakommentar['statusId']==1) echo 'selected="selected"'; ?>>Eget bygg</option>
            <option value="2" <?php if($rowFirmakommentar['statusId']==2) echo 'selected="selected"'; ?>>Forlenget kontrakt</option>
            <option value="3" <?php if($rowFirmakommentar['statusId']==3) echo 'selected="selected"'; ?>>Fornøyd</option>
            <option value="4" <?php if($rowFirmakommentar['statusId']==4) echo 'selected="selected"'; ?>>Få ansatte</option>
            <option value="5" <?php if($rowFirmakommentar['statusId']==5) echo 'selected="selected"'; ?>>I dialog</option>
            <option value="6" <?php if($rowFirmakommentar['statusId']==6) echo 'selected="selected"'; ?>>Ikke aktuell</option>
            <option value="7" <?php if($rowFirmakommentar['statusId']==7) echo 'selected="selected"'; ?>>Ikke flyttbare</option>
            <option value="8" <?php if($rowFirmakommentar['statusId']==8) echo 'selected="selected"'; ?>>Innleid</option>
            <option value="9" <?php if($rowFirmakommentar['statusId']==9) echo 'selected="selected"'; ?>>Lang kontrakt</option>
            <option value="10" <?php if($rowFirmakommentar['statusId']==10) echo 'selected="selected"'; ?>>Nylig flyttet</option>
            <option value="11" <?php if($rowFirmakommentar['statusId']==11) echo 'selected="selected"'; ?>>-</option>
        </select><br>

        <label for="kommentarPost">Kommentar: </label>
        <textarea rows = "5" cols = "40" name="kommentarPost">
            <?php echo $rowFirmakommentar['kommentar']?>
        </textarea>
        <input type="submit" name="rediger" value="Rediger">


    </div>
</form>
</div>
</div>
    
</body>
</html>