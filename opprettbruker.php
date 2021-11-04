<html>

<head>
    <title>Opretting av bruker</title>
</head>

<body>

    <h2>Registrer bruker</h2>

    <pre>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Brukernavn: <input type="text" name="bnavn" placeholder="Skriv brukernavn her"><br>
        Passord: <input type="password" name="pord" placeholder="Skriv passord her"><br>
        <input type="submit" name="registrer" value="Registrér">
        </form>
    </pre>

    <?php

    include('config.php');

    $brukernavn = $_REQUEST['bnavn'];
    $passord = password_hash($_REQUEST['pord'], PASSWORD_DEFAULT);

    if (isset($_REQUEST['registrer'])) {

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "INSERT INTO user (brukernavn, passord) VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $brukernavn, $passord);

            //echo print_r($sql);

            if ($stmt->execute()) {
                echo "New user created successfully !";
            } else {
                echo "Error: " . $sql . "
                        " . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }

    ?>

</body>

</html>