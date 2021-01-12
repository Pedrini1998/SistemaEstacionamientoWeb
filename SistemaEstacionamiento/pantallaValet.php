<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8"></meta>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    ></meta>

    <title>Valet Parking</title>
</head>

<body background="fondo.jpg">
    <br><br><br><br><table border="1" align="center" class="table-primary" width="100%">
        <tbody>
            <?php
    include("conexion.php");
        $query = "SELECT * FROM Cajon";
        $result_tasks = mysqli_query($conn, $query);    
        while($row = mysqli_fetch_assoc($result_tasks)) { 
            if ($row['id_cajon']==1 || $row['id_cajon']==9 || $row['id_cajon']==17) {
                ?>

            <tr>
                <?php
            }
            if ($row['situacion']==0) {
                ?>

                <td bgcolor="green" width="100" height="100" align="center">
                    <?php
                    echo "vacio
                    <br>
                    ";
                    echo $row['id_cajon'];
                ?>
                </td>

                <?php
            } else{
                ?>

                <td
                    bgcolor="red"
                    width="100"
                    height="100"
                    align="center"
                >
                    <?php
                    echo "Ocupado
                    <br>
                    ";
                    echo $row['id_cajon']; 
                ?>
                </td>

                <?php
            } 
    if ($row['id_cajon']==8 || $row['id_cajon']==16 || $row['id_cajon']==24) {
        ?>
            </tr>

            <?php
    }} ?>
        </tbody>
    </table>
    <a  href="index.html"> <FONT FACE="impact" SIZE=6 COLOR="red"> Cerrar Sesion</FONT>

    <?php include("baseDeDatos.php"); ?>
</body>
</html>