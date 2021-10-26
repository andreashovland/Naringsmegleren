<html>
<head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="filter.css">
    </head>
<body>

<?php
    include("config.php");
    $conn = new mysqli($servername, $username, $password, $dbname);

    $orgNum = $_GET['orgNum'];

    $ansattSet = $conn->query("SELECT fornavn FROM ansatte");

    // select statement for alle tabellene
    $firma = "select * from firma where orgNum = $orgNum";
    $bransje = "select bransje from bransje JOIN firma ON bransje.bransjeId=firma.bransjeId where firma.orgNum = $orgNum";
    $kontaktinfo = "select * from kontaktinfo where orgNum = $orgNum";
    $ansatte = "select fornavn from ansatte JOIN firmakommentar ON ansatte.ansattId=firmakommentar.ansattId 
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum";
    $status = "select status from status JOIN firmakommentar ON status.statusId=firmakommentar.statusId
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum";
    $firmakommentar = "select * from firmakommentar where orgNum = $orgNum";

    $ansatteResult = $conn->query($ansatte);

    while ($row = $ansatteResult->fetch_assoc()){
    ?>
    <form method="post" action="rediger.php">

        <label for="ansatt">Vår kontaktperson</label>
        <select name="ansatt" value="<?php if (isset( $row['fornavn'])) {echo $row['fornavn'];}?>">
            <option></option>
            <?php
                while ($rows = $ansattSet->fetch_assoc()){
                    $ansatt = $rows['fornavn'];
                    echo "<option value='$ansatt'>$ansatt</option>";
                }
            ?>
        </select>
    <?php
    }
        $firmakommentarResult = $conn->query($firmakommentar);

        while ($row = $firmakommentarResult->fetch_assoc()){
    ?>
        <label for="kommentar">Kommentar</label>
        <input type="text" name="kommentar" value="<?php if (isset( $row['kommentar'])) {echo $row['kommentar'];}?>">
        
    </form>
    <?php   
    }
?>
</body>
</html>
