<html>
    <body>

<?php

include('dropdown.php');

echo area();

"<br>";

echo ansatte();

"<br>";

echo bransje();

echo status();

?>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" /></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" /></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="text" name="city" /></td>
            </tr>
            <tr>
                <td>State:</td>
                <td><input type="text" name="state" /></td>
            </tr>
            <tr>
                <td>Zip:</td>
                <td><input type="text" name="zip" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Search" /></td>
            </tr>
        </form>
    </table>


</body>
</html>