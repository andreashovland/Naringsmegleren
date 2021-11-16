<?php
/*
session_start();

if($_SESSION["verified"] != true || !isset($_SESSION["verified"])) {
    header("Location: login.php");
    exit();
}
*/
?>

<html>

<head>
    <title>Næringsmegleren</title>
    <link rel="stylesheet" href="css/filter.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="bg"></div>

    <div class="filtere">
        <div class="innhold">
            <?php
            include("config.php");

            $orgNum = $_GET['orgNum']; // Henter orgnummer fra valgt rad

            // select statement for alle tabellene
            $firma = mysqli_query($conn, "select * from firma where orgNum = $orgNum");
            $bransje = mysqli_query($conn, "select bransje from bransje JOIN firma ON bransje.bransjeId=firma.bransjeId where firma.orgNum = $orgNum");
            $kontaktinfo = mysqli_query($conn, "select * from kontaktinfo where orgNum = $orgNum");
            $ansatte = mysqli_query($conn, "select fornavn from ansatte JOIN firmakommentar ON ansatte.ansattId=firmakommentar.ansattId 
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum");
            $status = mysqli_query($conn, "select status from status JOIN firmakommentar ON status.statusId=firmakommentar.statusId
    JOIN firma ON firmakommentar.orgNum=firma.orgNum where firma.orgNum = $orgNum");
            $firmakommentar = mysqli_query($conn, "select * from firmakommentar where orgNum = $orgNum");

            // Plasserer verdiene i en array

            while ($rowFirma = mysqli_fetch_array($firma)) {
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
                foreach ($array as $x => $value) {
                    echo "<br><b><font color=\"white\">" . $x . ": </b>" . $value . "</font>";
                }
            }


            while ($rowBransje = mysqli_fetch_array($bransje)) {
                $array = array(
                    "Bransje" => $rowBransje['bransje']
                );
                foreach ($array as $x => $value) {
                    echo "<br><b><font color=\"white\">" . $x . ": </b>" . $value . "</font>";
                }
            }
            echo "<br>";

            // Rediger

            $rowKontaktinfo = mysqli_fetch_array($kontaktinfo);
            $rowAnsatte = mysqli_fetch_array($ansatte);
            $rowStatus = mysqli_fetch_array($status);
            $rowFirmakommentar = mysqli_fetch_array($firmakommentar);

            if (isset($_POST['redigerknapp'])) {

                $kontaktpersonPost = $_POST['kontaktperson'];
                $telefonPost = $_POST['telefon'];
                $epostPost = $_POST['epost'];
                $vårKontaktperson = $_POST['vårKontaktperson'];
                $statusPost = $_POST['statusPost'];
                $kommentarPost = $_POST['kommentarPost'];

                $editKommentar = "UPDATE firmakommentar SET statusId='$statusPost', kommentar='$kommentarPost', ansattId='$vårKontaktperson' WHERE orgNum='$orgNum'";
                $editKontaktinfo = "UPDATE kontaktinfo SET kontaktperson='$kontaktpersonPost', tlf='$telefonPost', epost='$epostPost' WHERE orgNum='$orgNum'";

                $query_run_kommentar = mysqli_query($conn, $editKommentar);
                $query_run_kontaktinfo = mysqli_query($conn, $editKontaktinfo);

                if ($query_run_kommentar) {
                    mysqli_close($conn); // Close connection
                    header("location:visMer2.php?orgNum=" . $orgNum); // redirects to members page
                    exit;
                }
                if ($query_run_kontaktinfo) {
                    mysqli_close($conn); // Close connection
                } else {
                }
            }
            ?>

            <div>
                <form method="post">
                    <div class="box-rediger">
                        <br>
                        <label for="kontaktperson">Kontaktperson: </label>
                        <input type="text" name="kontaktperson" value="<?php echo $rowKontaktinfo['kontaktperson'] ?>"><br>

                        <label for="telefon">Telefon: </label>
                        <input type="text" name="telefon" value="<?php echo $rowKontaktinfo['tlf'] ?>"><br>

                        <label for="epost">E-post: </label>
                        <input type="text" name="epost" value="<?php echo $rowKontaktinfo['epost'] ?>"><br>

                        <label for="vårKontaktperson">Vår kontaktperson: </label>
                        <select name="vårKontaktperson">
                            <option></option>
                            <option value="2" <?php if ($rowFirmakommentar['ansattId'] == 2) echo 'selected="selected"'; ?>>-</option>
                            <option value="6" <?php if ($rowFirmakommentar['ansattId'] == 6) echo 'selected="selected"'; ?>>Gunnar</option>
                            <option value="3" <?php if ($rowFirmakommentar['ansattId'] == 3) echo 'selected="selected"'; ?>>Jens Helge</option>
                            <option value="5" <?php if ($rowFirmakommentar['ansattId'] == 5) echo 'selected="selected"'; ?>>Line Ericha</option>
                            <option value="4" <?php if ($rowFirmakommentar['ansattId'] == 4) echo 'selected="selected"'; ?>>Mikael</option>
                            <option value="7" <?php if ($rowFirmakommentar['ansattId'] == 7) echo 'selected="selected"'; ?>>Sylvi</option>
                            <option value="1" <?php if ($rowFirmakommentar['ansattId'] == 1) echo 'selected="selected"'; ?>>Unni</option>

                        </select><br>

                        <label for="statusPost">Status: </label>
                        <select name="statusPost">
                            <option></option>
                            <option value="1" <?php if ($rowFirmakommentar['statusId'] == 1) echo 'selected="selected"'; ?>>Eget bygg</option>
                            <option value="2" <?php if ($rowFirmakommentar['statusId'] == 2) echo 'selected="selected"'; ?>>Forlenget kontrakt</option>
                            <option value="3" <?php if ($rowFirmakommentar['statusId'] == 3) echo 'selected="selected"'; ?>>Fornøyd</option>
                            <option value="4" <?php if ($rowFirmakommentar['statusId'] == 4) echo 'selected="selected"'; ?>>Få ansatte</option>
                            <option value="5" <?php if ($rowFirmakommentar['statusId'] == 5) echo 'selected="selected"'; ?>>I dialog</option>
                            <option value="6" <?php if ($rowFirmakommentar['statusId'] == 6) echo 'selected="selected"'; ?>>Ikke aktuell</option>
                            <option value="7" <?php if ($rowFirmakommentar['statusId'] == 7) echo 'selected="selected"'; ?>>Ikke flyttbare</option>
                            <option value="8" <?php if ($rowFirmakommentar['statusId'] == 8) echo 'selected="selected"'; ?>>Innleid</option>
                            <option value="9" <?php if ($rowFirmakommentar['statusId'] == 9) echo 'selected="selected"'; ?>>Lang kontrakt</option>
                            <option value="10" <?php if ($rowFirmakommentar['statusId'] == 10) echo 'selected="selected"'; ?>>Nylig flyttet</option>
                            <option value="11" <?php if ($rowFirmakommentar['statusId'] == 11) echo 'selected="selected"'; ?>>-</option>
                        </select><br>

                        Kommentar:<br>
                        <textarea name="kommentarPost" placeholder="Kommentar...">
            <?php echo $rowFirmakommentar['kommentar'] ?>
        </textarea>

                        <input type="submit" name="redigerknapp" value="Rediger">

                        <div class="tilbake">
                            <button name="tilbakeButton" onclick="goBack()">Tilbake</button>
                            <script>
                                function goBack() {
                                    window.history.go(-1);
                                }
                            </script>
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>