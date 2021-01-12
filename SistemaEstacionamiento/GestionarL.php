<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
        crossorigin="anonymous"
    ></link>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costo</title>
</head>
<body background="fondo.jpg">
    <table align="center" class="table-primary" width="100%">
        <tr>
            <td>
                <form method="POST" action="pdf.php">
                    <label>liberar espacio:  </label><select name="ocupados" class="form-control">
                    <?php
                        include("conexion.php");
                        $query = "SELECT * FROM Cajon";
                        $result_tasks = mysqli_query($conn, $query);  
                        $cont=0;  
                        while($row = mysqli_fetch_assoc($result_tasks)) { 
                            if ($row['situacion']==1) {
                                $cont++;
                                ?>
                                    <option><?php echo $row['id_cajon']; ?></option>
                                <?php
                            }
                        }
                        if(cont==0){
                            ?>
                                <option>No hay autos utilizando espacios...</option>
                            <?php
                        }
                    ?>
                    </select>
                    <br><input class="btn btn-info" type="submit" id="btnCalcular" name="btnCalcular" value="Calcular costo">
                    <br><label>El Costo total es: $</label><label id="costo" name="costo">0.00</label>
                </form>
            </td>
            <td>
                <table class="table table-bordered" border="1" align="center">
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
                            echo "vacio<br>";
                                echo $row['id_cajon'];
                                ?>
                            </td>
                            <?php
                        } else{
                            ?>
                            <td bgcolor="red" width="100" height="100" align="center">
                                <?php
                                echo "Ocupado<br>";
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
            </td>
        </tr>
    </table>
    <a  href="index.html"> <FONT FACE="impact" SIZE=6 COLOR="red"> Cerrar Sesion</FONT>
    <?php include("baseDeDatos.php"); ?>
</body>
</html>