//n
function login (){
    const data = {
        "correo":     $('#correo').val(), 
        "contrasena": $('#contraseña').val(), 
    };
    $.ajax({
        type: "POST",
        url:"recepcion/form-sesion.php",
        data: data,
        cache: false,
        // dataType: "json",
        success: function(resp){ 
            if(resp == "true"){
                window.location="dashboard/content/Dashboard-panel.php";
                
           }else if(resp == 'no_pwd_mail'){
               Swal.fire({
                   type: 'question',
                   title: 'Usuario invalido',
                   text: 'El usuario/contraseña no son correctos',
                   showConfirmButton: true,
                   confirmButtonText: 'Continuar',
                   timer: 2100,
               });
           }else if(resp == 'data_invalid'){
               Swal.fire({
                   type: 'question',
                   title: 'Intento',
                   text: 'Estás intentando escribir un dato invalido en el sistema',
                   showConfirmButton: true,
                   confirmButtonText: 'Continuar',
                   timer: 2100,
               });
           }else if(resp == 'empty_fields'){
               Swal.fire({
                   type: 'question',
                   title: '¡Vaya! No recibí ningún dato',
                   text: '¿Deseas intentarlo nuevamente?',
                   showConfirmButton: true,
                   confirmButtonText: 'Continuar',
               });
           }else if(resp == 'without_session'){
            Swal.fire({
                type: 'warning',
                title: '¡Vaya! la cuenta está desactivada',
                text: 'Comunicate con el administrador',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
        }
    });
}
