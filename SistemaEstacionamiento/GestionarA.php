<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
        crossorigin="anonymous"
    ></link>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Vehiculo</title>
</head>
<body background="fondo.jpg">
    <table  cellspacing="10" cellpadding="10" align="center" class="table-primary" width="100%">
        <tr>
            <td>
                <table class="table table-bordered" cellspacing="10" cellpadding="10" align="center"> 
                        <tr>
                            <td>id</td><td>Matricula</td><td>Marca</td><td>Modelo</td><td>Color</td><td>Tamaño</td>
                        </tr>
                        <?php
                            include("conexion.php");
                            $query = "SELECT * FROM Vehiculo";
                            $result_tasks = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result_tasks)) { 
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['matricula']; ?></td>
                                    <td><?php echo $row['marca']; ?></td>
                                    <td><?php echo $row['modelo']; ?></td>
                                    <td><input class="form-control" type="color" name="colorA" id="colorA" <?php echo "value='{$row['color']}'"; ?> ></td>
                                    <td><?php echo $row['tamano']; ?></td>
                                </tr>
                                <?php      
                            }?>
                </table>
            </td>
            <td>
                <form method="POST">
                    <label for="idEliminar">Seleccione el Id del vehiculo a eliminar</label>
                        <select name="idEliminar" class="form-control">
                            <?php
                            include("conexion.php");
                            $query = "SELECT * FROM Vehiculo";
                            $cant=0;
                            $result_tasks = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result_tasks)) { 
                                $cant++;
                                ?>
                                    <option> <?php echo $row['id']; ?> </option>
                                <?php
                            }
                            if ($cant==0) {
                                ?>
                                    <option>No hay lugares disponibles</option>
                                <?php
                            }?>
                        </select>
                        <br><input class="btn btn-outline-danger" type="submit" name="btnEliminarA" value="Eliminar Auto">
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form method="POST">
                    <br><br><br><input class="form-control" type="text" name="matriculaGA" id="matriculaGA" placeholder="Ingrese Matricula">
                    <br><input class="form-control" type="text" name="marcaGA" id="marcaGA" placeholder="Ingrese Marca">
                    <br><input class="form-control" type="text" name="modeloGA" id="modeloGA" placeholder="Ingrese Modelo">
                    <br><input class="form-control" type="color" name="colorGA" id="colorGA">
                    <br><select class="form-control" name="tamanoGA" id="tamanoGA">
                        <option value="Chico">Chico</option>
                        <option value="Grande">Grande</option>
                    </select>
                    <br><input class="btn btn-success" type="submit" name="btnRegistrarV" value="Registrar Auto">
                </form>
            </td>
        </tr>
    </table>

    <a  href="pantallaAdmin.php"> <FONT FACE="impact" SIZE=6 COLOR="red"> Pantalla Principal</FONT>
    <?php include("baseDeDatos.php"); ?>
</body>
</html>