const db = firebase.firestore();
const form=document.getElementById("formularioR")
if(form){
    form.addEventListener('submit',e =>  {
        e.preventDefault();
        const nombre=form['nombreR'].value;
        const cargo=form['opcionesR'].value;
        const contrasena=form['contrasenaR'].value;
        const conContrasena=form['conContrasenaR'].value;
        if (nombre!="" && cargo!="" && contrasena!="" && conContrasena!="") {
            if (contrasena==conContrasena) {
                db.collection('Usuarios').doc().set({
                    nombre,
                    cargo,
                    contrasena
                });
                alert("Usuario Registrado Correctamente...");
                //window.location.replace("index.html");
                //window.location.replace('GestionarU.html');
                form.reset();
                setTimeout(function(){window.location.replace('GestionarU.html');},500);
            } else {
                alert("La contraseña ingresada no coincide");
            }
        } else {
            alert("Debe ingresar los datos para registrar el Usuario");
        }
    })
}
var contenido=document.getElementById("contenido")
if (contenido) {
    opciones=document.getElementById("nomUsuarios");
    //opciones.innerHTML='<select name="nomUsuarios" id="nomUsuarios">';
    db.collection("Usuarios").get().then((querySnapshot)=>{
    //contenido.innerHTML='<tbody id="contenido"><tr>';
        querySnapshot.forEach((doc)=>{
            contenido.innerHTML+='<td>'+doc.id+'</td><td>'+doc.data().nombre+'</td><td>'+doc.data().cargo+'</td>';
            opciones.innerHTML+='<option value="'+doc.id+'">'+doc.id+'</option>';
        });
    });
    //opciones.innerHTML+='</select>';
}

const obetenerDatos = () => db.collection('Usuarios').get();
const formInicio=document.getElementById("formulario")
if (formInicio) {
    formInicio.addEventListener('submit', async (e) =>{
        e.preventDefault();
        const nombre=formInicio['usuarioI'].value;
        const contrasenaF=formInicio['contrasenaI'].value;
        const querySnapshot= await obetenerDatos();
        cont=0;
        querySnapshot.forEach(doc => {
            if(doc.data().nombre==nombre && doc.data().contrasena==contrasenaF){
                alert(doc.data().cargo);
                if (doc.data().cargo=="Valet") {
                    window.location.replace("pantallaValet.php");
                }else if (doc.data().cargo=="Administrador") {
                    window.location.replace("pantallaAdmin.php");
                }else if (doc.data().cargo=="Cajero") {
                    window.location.replace("PantallaCajero.php?usu="+doc.data().cargo);
                }else if(doc.data().cargo=="Conductor"){
                    window.location.replace("pantallaConductor.php?usu="+doc.data().nombre);
                }
                cont++;
            }
        });
        if (cont==0) {
            alert("Verifique los datos ingresados...");
        }
    })
}
    const formE = document.getElementById("formEliminar")
    if (formE) {
        boton=formE["btnEliminarU"];
        boton.addEventListener("click",function(evento){
            evento.preventDefault();
            const id=formE['nomUsuarios'].value;
            db.collection("Usuarios").doc(id).delete().then(function(){
                alert("Registro eliminado Correctamente");
                setTimeout(function(){window.location.replace('GestionarU.html');},500);
            }).catch(function(error){
                alert("Error al eliminar el registro");
            });
        });
    }


    const formEnvio=document.getElementById("formEnviarMsj");
if (formEnvio) {
    formEnvio.addEventListener('submit', async (e) =>{
        e.preventDefault();
        const mensaje=formEnvio['txtEnviar'].value;
        const destino="Cajero";
        const remitente=document.getElementById("txtUsu").innerHTML;
        if (mensaje!="") {
            db.collection('Mensajes').doc().set({
                destino,
                mensaje,
                remitente
            });
            setTimeout(function(){ window.location.replace('pantallaConductor.php?usu='+remitente); }, 500);
        } else {
            alert("Debe ingresar un mensaje a enviar...");
        }
    });
}
var mensajes=document.getElementById("txtMsj");
if (mensajes) {
    const usuarioIngreso = document.getElementById("txtUsu").innerHTML;
    db.collection("Mensajes").get().then((querySnapshot)=>{
        querySnapshot.forEach((doc)=>{
            if (doc.data().destino==usuarioIngreso) {
                document.getElementById("txtMsj").value+=doc.data().remitente+": "+doc.data().mensaje+"\n";
            }
            if (doc.data().remitente==usuarioIngreso) {
                document.getElementById("txtMsj").value+=doc.data().remitente+": "+doc.data().mensaje+"\n";
            }
        });
    });
}
const formCajeroE=document.getElementById("formEnviarMsjC");
if (formCajeroE) {
    usuarios=document.getElementById("usuarios");
    db.collection("Usuarios").get().then((querySnapshot)=>{
        querySnapshot.forEach((doc)=>{
            if (doc.data().cargo=="Conductor") {
                usuarios.innerHTML+='<option value="'+doc.data().nombre+'">'+doc.data().nombre+'</option>';
            }
        });
    });
    btnLeer=formCajeroE["btnLeer"];
    btnLeer.addEventListener("click", function(evento){
        evento.preventDefault();
        rem=formCajeroE["usuarios"].value;
        const usuarioIngreso = document.getElementById("txtUsu").innerHTML;
        document.getElementById("txtMsjC").value='';
        db.collection("Mensajes").get().then((querySnapshot)=>{
            querySnapshot.forEach((doc)=>{
                if (doc.data().destino==usuarioIngreso && doc.data().remitente==rem) {
                    document.getElementById("txtMsjC").value+=doc.data().remitente+": "+doc.data().mensaje+"\n";
                }
                if (doc.data().destino==rem && doc.data().remitente==usuarioIngreso) {
                    document.getElementById("txtMsjC").value+=doc.data().remitente+": "+doc.data().mensaje+"\n";
                }
            });
        });
    });
    btnLeer=formCajeroE["btnEnviar"];
    btnLeer.addEventListener("click", function(evento){
        evento.preventDefault();
        const mensaje=formCajeroE['txtEnviar'].value;
        const destino=rem;
        const remitente="Cajero";
        if (mensaje!="") {
            db.collection('Mensajes').doc().set({
                destino,
                mensaje,
                remitente
            });
            setTimeout(function(){ window.location.replace('pantallaCajero.php?usu=Cajero'); }, 500);
        } else {
            alert("Debe ingresar un mensaje a enviar...");
        }
    });

}
