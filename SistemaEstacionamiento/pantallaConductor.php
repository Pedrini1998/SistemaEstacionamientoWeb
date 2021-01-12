<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8"></meta>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    ></meta>

    <title>Pantalla Conductor</title>
</head>

<body background="fondo.jpg" >
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
    <table align="center" class="table-primary" width="50%">
        <tr>
            <td>
                <form action="" method="POST" name="formEnviarMsj" id="formEnviarMsj">
                    <?php
                        echo "<br><h4 name='txtUsu' id='txtUsu'>".$_GET['usu']."</h4>";
                    ?>
                    <br><textarea class="form-control" name="txtMsj" id="txtMsj" cols="70" rows="8" disabled></textarea>
                    <br><input class="form-control" type="text" name="txtEnviar" id="txtEnviar" placeholder="Ingrese mensaje">
                    <br><button class="btn btn-success" id="btnEnviar" name="btnEnviar">Enviar</button>
                </form>
            </td>
            <td></td>
        </tr>
    </table>
    <a  href="index.html"> <FONT FACE="impact" SIZE=6 COLOR="red"> Cerrar Sesion</FONT>
      <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-firestore.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDV5rot-CtDJ3HRPJmda4rQb9kHZm4lFZQ",
    authDomain: "sistemaestacionamiento-41c96.firebaseapp.com",
    databaseURL: "https://sistemaestacionamiento-41c96-default-rtdb.firebaseio.com",
    projectId: "sistemaestacionamiento-41c96",
    storageBucket: "sistemaestacionamiento-41c96.appspot.com",
    messagingSenderId: "1098311642665",
    appId: "1:1098311642665:web:9a8bf80a95420eccd17638",
    measurementId: "G-Q42G8NP78E"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
</body>
</html>