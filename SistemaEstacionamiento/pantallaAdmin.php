<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
        crossorigin="anonymous"
    ></link>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
</head>

<body background="fondo.jpg">
    <br><br><table align="center" class="table-primary" width="100%">
        <tr align="center">
            <td>
                <a href="GestionarU.html" class="btn btn-primary btn-lg">Gestionar Usuarios</a>
                <br><br><a href="GestionarA.php" class="btn btn-primary btn-lg">Gestionar Autos</a>
                <br><br><a href="GestionarL.php" class="btn btn-primary btn-lg">Gestionar Lugares de Estacionamiento</a>
            </td>
            <td>
                <table class="table-success" border="4" align="center">
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
        <tr>
            <td></td><td>
                <form method="POST">
                <br><label FONT FACE="impact" SIZE=6 COLOR="black">Lugar disponible</label><select name="dis" class="form-control">
                    <?php
                        include("conexion.php");
                        $query = "SELECT * FROM Cajon";
                        $cant=0;
                        $result_tasks = mysqli_query($conn, $query);    
                        while($row = mysqli_fetch_assoc($result_tasks)) { 
                            if ($row['situacion']!=1) {
                                $cant++;
                                ?>
                                    <option> <?php echo $row['id_cajon']; ?> </option>
                                <?php
                            }
                        }
                        if ($cant==0) {
                            ?>
                                <option>No hay lugares disponibles</option>
                            <?php
                        }?>
                    </select>
                    <br><label for="reg" class="fs-2">Autos Registrados</label><select name="reg" class="form-control">
                        <?php
                            include("conexion.php");
                            $query = "SELECT * FROM Resguardo";
                            $cant=0;
                            $pila = array();
                            $result_tasks = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result_tasks)) { 
                                if ($row['pago']==0) {
                                    array_push($pila, $row['id_vehiculo']);
                                }
                            }
                            $query = "SELECT * FROM Vehiculo";
                            $cant=0;
                            $pila2 = array();
                            $result_tasks = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result_tasks)) { 
                                array_push($pila2, $row['id']);
                            }
                            $resultado = array_diff($pila2, $pila);
                            for ($i=0; $i < count($resultado); $i++) {
                                ?>
                                    <option> <?php echo ($resultado[$i]); ?> </option>
                                <?php
                            }
                            if (count($resultado)==0) {
                                ?>
                                    <option>No existen vehiculos para aparcar</option>
                                <?php
                            }?>
                        </select>
                        <br><input class="btn btn-success" type="submit" name="btnRegistrarA" value="Registrar Aparcamiento">
                </form>
            </td>
        </tr>
    </table>
   <a  href="index.html"> <FONT FACE="impact" SIZE=6 COLOR="red"> Cerrar Sesion</FONT>
    <?php include("baseDeDatos.php"); ?>
</body>
</html>