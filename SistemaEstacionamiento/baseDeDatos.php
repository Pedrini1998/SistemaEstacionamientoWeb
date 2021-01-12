<?php
if (isset($_POST['btnEliminarA'])) {
    include("conexion.php");
    $id=$_REQUEST["idEliminar"];
    $query="DELETE FROM Vehiculo WHERE id=$id";
    $result=mysqli_query($conn,$query);
    if (!$result) {
        ?><h3 >¡Error: al eliminar el vehiculo!</h3><?php
    }
    mysqli_close($conn);
    //header("Location: GestionarA.php");
    echo("<script> window.location.replace('GestionarA.php');</script>");
}

if (isset($_POST['btnRegistrarV'])){
    if (strlen($_POST['matriculaGA'])>=1 && strlen($_POST['marcaGA'])>=1 && strlen($_POST['modeloGA'])>=1) {
        include("conexion.php");
        $matricula = $_REQUEST["matriculaGA"];
        $marca = $_REQUEST["marcaGA"];
        $modelo = $_REQUEST["modeloGA"];
        $color = $_REQUEST["colorGA"];
        $tamano = $_REQUEST["tamanoGA"];
        $resul=mysqli_query($conn, "INSERT INTO Vehiculo (matricula, marca, modelo, color, tamano) VALUES ('$matricula', '$marca', '$modelo', '$color', '$tamano')");
        if ($resul) {
            ?><h3 >¡Vehiculo registrado correctamente!</h3><?php
        } else {
            ?><h3 >¡Error: al registrar el vehiculo!</h3><?php
        }
        mysqli_close($conn);
    }else{
        ?> 
	    	<h3>¡Por favor complete los campos!</h3>
        <?php
    }
    //header("Location: GestionarA.php");
    echo("<script> window.location.replace('GestionarA.php');</script>");
}

if (isset($_POST['btnRegistrarA'])) {
    $id_vehiculo=$_REQUEST['reg'];
    $id_cajon=$_REQUEST['dis'];
    registrarResguardoAdmin($id_vehiculo,$id_cajon);
    echo("<script> window.location.replace('pantallaAdmin.php');</script>");
} 

if (isset($_POST['btnRegistrar'])) {
    if (strlen($_POST['matriculaA'])>=1 && strlen($_POST['marcaA'])>=1 && strlen($_POST['modeloA'])>=1 /*&& $_POST['disponibles']!='No hay lugares disponibles'*/) {
        $idVehiculo=validarExistenciaVehiculo();
        if ($idVehiculo!=-1) {
            $idResguardo=validarUsoEstacionamiento($idVehiculo);
            if ($idResguardo!=-1) {
                echo("El vehiculo ya se encuentra en el estacionamiento...");
            }else{
                registrarResguardo($idVehiculo);
            }
        } else {
            registrarVehiculo();
        }
    }else{
        ?> 
	    	<h3>¡Por favor complete los campos!</h3>
        <?php
    }
}
if (isset($_POST['btnCalcular'])) {
    $costo=15.00;
    $idCajon = $_REQUEST['ocupados'];
    calcularCosto($idCajon);
    //echo("<script>document.getElementById('marcaA').setAttribute('disabled', 'true');</script>");
    
}
function validarExistenciaVehiculo(){
    include("conexion.php");
    $query = "SELECT * FROM Vehiculo";
    $result_tasks = mysqli_query($conn, $query);
    $matricula = $_REQUEST["matriculaA"];
    while($row = mysqli_fetch_assoc($result_tasks)){
        if ($row['matricula']==$matricula) {
            return $row['id'];
        }
    }
    return -1;
}

function registrarVehiculo(){
    include("conexion.php");
    $matricula = $_REQUEST["matriculaA"];
    $marca = $_REQUEST["marcaA"];
    $modelo = $_REQUEST["modeloA"];
    $color = $_REQUEST["colorA"];
    $tamano = $_REQUEST["tamano"];
    $resul=mysqli_query($conn, "INSERT INTO Vehiculo (matricula, marca, modelo, color, tamano) VALUES ('$matricula', '$marca', '$modelo', '$color', '$tamano')");
    if ($resul) {
        $ultimo_id = mysqli_insert_id($conn);
        registrarResguardo($ultimo_id);
    } else {
        ?><h3 >¡Error: al registrar el vehiculo!</h3><?php
    }
    mysqli_close($conn);
}
function registrarResguardoAdmin($id_v,$id_c){
    date_default_timezone_set('UTC');
    include("conexion.php");
    $time = time();
    $hora= date("H:i:s", $time);
    $fecha= date("Y-m-d", $time);
    $resul=mysqli_query($conn, "INSERT INTO Resguardo(id_vehiculo, id_cajon, hr_llegada, hr_salida, pago, fecha) VALUES ($id_v,$id_c,'$hora','00:00:00',0.00,'$fecha')");
    if ($resul) {
        ?><h3 >¡Dato almacenado correctamente!</h3><?php
        cambiarSituacion($id_c,1);
    } else {
        ?> 
	    	<h3 >¡Error: al realizar el resguardo!</h3>
        <?php
        if (!$conn->query("INSERT INTO Resguardo(id_vehiculo, id_cajon, hr_llegada, hr_salida, pago, fecha) VALUES ($id_v,$id_c,'$hora','00:00:00',0.00,'$fecha')")) {
            printf("Mensaje de Error Insertar Resguardo: %s\n", $conn->error);
        }
    }
    echo("<script>
        window.open('pdf.php','index','directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400');
    </script>");
    mysqli_close($conn);
    //echo("<script> window.location.replace('pantallaAdmin.php');</script>");
    //header("Location: pantallaAdmin.php");
}
function registrarResguardo($id_vehiculo){
    date_default_timezone_set('UTC');
    include("conexion.php");
    $idCajon = $_REQUEST["disponibles"];
    $time = time();
    $hora= date("H:i:s", $time);
    $fecha= date("Y-m-d", $time);
    $resul=mysqli_query($conn, "INSERT INTO Resguardo(id_vehiculo, id_cajon, hr_llegada, hr_salida, pago, fecha) VALUES ($id_vehiculo,$idCajon,'$hora','00:00:00',0.00,'$fecha')");
    if ($resul) {
        ?><h3 >¡Dato almacenado correctamente!</h3><?php
        cambiarSituacion($idCajon,1);
    } else {
        ?> 
	    	<h3 >¡Error: al realizar el resguardo!</h3>
        <?php
        if (!$conn->query("INSERT INTO Resguardo(id_vehiculo, id_cajon, hr_llegada, hr_salida, pago, fecha) VALUES ($id_vehiculo,$idCajon,'$hora','00:00:00',0.00,'$fecha')")) {
            printf("Error message: %s\n", $conn->error);
        }
    }
    echo("<script>
        window.open('pdf.php','index','directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400');
    </script>");
    mysqli_close($conn);
}
function cambiarSituacion($idC,$situacion){
    include("conexion.php");
    mysqli_query($conn, "UPDATE Cajon SET situacion=$situacion WHERE id_cajon=$idC");
    mysqli_close($conn);
}

function validarUsoEstacionamiento($idV){
    include("conexion.php");
    $query = "SELECT * FROM Resguardo";
    $result_tasks = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result_tasks)){
        if ($row['id_vehiculo']==$idV && $row['pago']==0) {
            return $row['id_resguardo'];
        }
    }
    return -1;
}
function calcularCosto($idCajon){
    $costoTotal=0;
    $hrLlegada =0;
    $idResguardo=-1;
    $idVehiculo=-1;
    $fila;
    include("conexion.php");
    if ($idCajon!="No hay autos utilizando espacios...") {
        $query = "SELECT * FROM Resguardo WHERE id_cajon=$idCajon AND pago=0";
        $result_tasks = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result_tasks)){
            $hrLlegada = $row['hr_llegada'];
            $idResguardo = $row['id_resguardo'];
            $idVehiculo = $row['id_vehiculo'];
            $fila = [
            "idCajon" => $row['id_cajon'],
            "hrLlegada" => $row['hr_llegada'],
            "fecha"=>$row['fecha'],
            ];
        }
        if (!$conn->query("SELECT * FROM Resguardo WHERE id_cajon=$idCajon AND pago=0")) {
            printf("Error message: %s\n", $conn->error);
        }
        if ($idResguardo==-1) {
            echo('<br>Ocurrio un error al consultar los datos...');
        } else {
            $time = time();
            $hrSalida=date("H:i:s", $time);
            $horaInicio = new DateTime($hrLlegada);
            $horaTermino = new DateTime($hrSalida);
            $interval = $horaInicio->diff($horaTermino);
            $tamano=obtenerTamano($idVehiculo);
            if ($tamano='Chico') {
                $costoTotal=$interval->format('%H.%i') *12;
            } else {
                $costoTotal=$interval->format('%H.%i') *18;
            }
            cambiarSituacion($idCajon,0);
            horaSalidaPago($idResguardo,$hrSalida,$costoTotal);
            //generarPDF($fila,$hrSalida,$costoTotal);
            echo("<script> window.location.replace('GestionarL.php');</script>");
            echo("<script>document.getElementById('costo').innerHTML=$costoTotal;</script>");
            echo("<script>alert($costoTotal);</script>");
        }
    }
}
function obtenerTamano($idV){
    include("conexion.php");
    $query = "SELECT * FROM Vehiculo WHERE id=$idV";
    $result_tasks = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result_tasks)){
        if ($row['id']==$idV) {
            return $row['tamano'];
        }
    }
}
function horaSalidaPago($idResguardo, $hrSalida, $pago){
    include("conexion.php");
    mysqli_query($conn, "UPDATE Resguardo SET hr_salida='$hrSalida', pago=$pago WHERE id_resguardo=$idResguardo");
    if (!$conn->query("UPDATE Resguardo SET hr_salida='$hrSalida', pago=$pago WHERE id_resguardo=$idResguardo")) {
        printf("Error message: %s\n", $conn->error);
    }
    mysqli_close($conn);
}
?>