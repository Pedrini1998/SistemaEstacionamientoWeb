<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="utf-8">
    <body>
    <?php
        header("Content-Type: text/html; charset=UTF-8");
    ?>
    <table class="table table-bordered" cellspacing="10" cellpadding="10" align="center">
        <tr>
            <td>
                <form method="POST">
                    <label>Matricula: </label><input class="form-control" type="text" id="matriculaA" name="matriculaA">
                    <br><label>Marca: </label><input class="form-control" type="text" id="marcaA" name="marcaA">
                    <br><label>Modelo: </label><input class="form-control" type="text" id="modeloA" name="modeloA">
                    <br><label>Color: </label><input class="form-control" type="color" name="colorA">
                    <br><label>Tamaño: </label><select name="tamano"><option>Chico</option><option>Grande</option></select>
                    <br><select name="disponibles" class="form-control">
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
                            //echo("<script>document.getElementById('btnRegistrar').disabled='true';</script>");
                        }else{
                            //echo("<script>document.getElementById('btnRegistrar').disabled='false';</script>");
                        }?>
                    </select>
                    <br><input class="btn btn-primary" type="submit" id="btnRegitrar" name="btnRegistrar" value="Registrar">
                </form>
            </td>
            <td>
                <form>
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
                            ?><td bgcolor="green" width=100 height=200 align="center"><?php
                                echo "vacio<br>";
                                echo $row['id_cajon'];
                            ?></td><?php
                        } else{
                            ?><td bgcolor="red" width=100 height=200 align="center"><?php
                                echo "Ocupado<br>";
                                echo $row['id_cajon']; 
                            ?></td><?php
                        } 
                if ($row['id_cajon']==8 || $row['id_cajon']==16 || $row['id_cajon']==24) {
                    ?>
                    </tr>
                    <?php
                }} ?>
            </tbody>
            </table>
        </form>
            </td>
        </tr>
        <tr><td></td>
            <td >
                <form method="POST">
                    <label>liberar espacio:  </label><select name="ocupados" class="form-control">
                    <?php
                        include("conexion.php");
                        $query = "SELECT * FROM Cajon";
                        $result_tasks = mysqli_query($conn, $query);    
                        while($row = mysqli_fetch_assoc($result_tasks)) { 
                            if ($row['situacion']==1) {
                                ?>
                                    <option> <?php echo $row['id_cajon']; ?> </option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                    <br><input class="btn btn-info" type="submit" id="btnCalcular" name="btnCalcular" value="Calcular costo">
                    <br><label>El Costo total es: $</label><label id="costo" name="costo">0.00</label>
                </form>
            </td><td></td>
        </tr>
    </table>
    <label>Cantidad de Lugares Ocupados:</label>
    <label><?php 
        include("conexion.php");
        $cont=0;
        $query = "SELECT * FROM cajon";
        $result_tasks = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result_tasks)){
            if ($row['situacion']==1) {
                $cont++;
            }
        }
        echo($cont);?>
        </label>
        <?php include("baseDeDatos.php"); ?>
    </body>
</html>