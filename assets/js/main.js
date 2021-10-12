console.log('Conectado al archivo main js');
var btnStatic = {"background": 'rgb(33 37 41)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s'};
var btnSuccess = {"background": '#3ac47d', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
var btnWarning = {"background": 'rgb(208 148 80)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
var btnDanger = {"background": 'rgb(208 80 80)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
window.onload = validateForm();
//Se carga la página inicial__aqui marca el error NETWORK
$.post("../Homepage.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); cleanItemMenu();$('#item-desktop').addClass("active");});
//SECCION VALIDACIONES JS 
function validateForm (){  
    $("#formG").validate({
        rules:{
            nombre:{
                required:true,
                letters: true
            },
            apellidos:{
                required:true,
                letters: true
            },
            correo:{
                required:true,
                email: true
            },
            edad:{
                required:true,
                maxlength:2,
                digits: true,
            },
            telefono:{
                required:true,
                minlength:12,
                maxlength:12,
                digits: true,
            },
            donacion:{
                required: true,
            },
            contraseña:{
                required:true,
                minlength:3
            },
            contraseña_d: { 
                required: true, 
                minlength:3,
                equalTo: "#contraseña" 
            },
        },
        messages : {
            nombre:{
                required: "Este campo es requerido",
                letters: "Sólo se permiten letras",
            },
            apellidos:{
                required: "Este campo es requerido",
                letters: "Sólo se permiten letras",
            },
            correo: {
                required: "Este campo es requerido",
                email: "El correo ingresado no es valido"
            },
            donacion: {
                required: "Este campo es requerido",
            },
            telefono: {
                required: "Este campo es requerido",
                letters: "Asegúrese de estar incluyendo el código de país (52)",
            },
            contraseña: {
              required: "Este campo es requerido",
              minlength: "Este campo tiene como minimo 5 caracteres",
            },
            contraseña_d: {
                required: "Este campo es requerido",
                minlength: "Este campo no coincide con la contraseña",
              },
              pesoMXN: {
                  required : "Este campo es requerido",

              },
        },
        errorElement : 'span',

    });
}
// https://es.stackoverflow.com/questions/23179/como-hacer-que-mi-input-text-tenga-separador-de-miles-y-decimales-en-jquery
function monedaMX(){
    $("#donacion").on({
        "focus": function(event) {
          $(event.target).select();
        },
        "keyup": function(event) {
          $(event.target).val(function(index, value) {
             
            setTimeout(function() {
                $("#donacion").css("font-size", "17px") 
                $("#donacion").css("font-weight", "bold")
            },1000);
           
            return "$" + value.replace(/\D/g, "")
              .replace(/([0-9])([0-9]{2})$/, '$1.$2')
              .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
          });
        }
    });      
}
function logoutSesion(){
    Swal.fire({
        type: 'info',
        title: "sesión",
        text: "¿Estás seguro en cerrar la sesión?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, Salir",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            window.location.href="../../recepcion/logout.php";
        }else {
            // console.log("*NO Quiere eliminar*");
        }
        })
}
//SECCION ASIGNACION DE ROLES
function registerdesdeAdmin(){
    $("input:radio:checked").each(function() {
        var select_tipo =  $(this).val();
            console.log(select_tipo);
        if( select_tipo == 2){
            const data = {
                "nombre":       $('#nombre').val(), 
                "correo":       $('#correo').val(), 
                "contraseña":   $('#contraseña').val(), 
                "contraseña_d": $('#contraseña_d').val(),
                "rol_usuario":  2, 
                "tipo_perfil": "Colaborador"
            };
            $.ajax({
                type: "POST",
                url:"../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    if(resp == "true"){
                        Swal.fire({
                            type: 'success',
                            title: 'El usuario ha sido registrado',
                            showConfirmButton: false,
                            showCloseButton: true
                        })
                    }else if(resp == "data_invalid"){
                         // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                         Swal.fire({
                            type: 'warning',
                            title: 'Houston, tenemos un problema...',
                            text: 'Uno o más campos no están correctamente, verifícalos...',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "pwd_not_match"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'Parece que las contraseñas no coinciden',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "mail_use"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'El correo electrónico ya esta en uso, prueba con otro.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "empty_fields"){
                        Swal.fire({
                            type: 'question',
                            title: '¡Vaya! No recibí ningún dato',
                            text: '¿Deseas intentarlo nuevamente?',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                 }
            });
        }
        else if( select_tipo == 3){
            const data = {
                "nombre":       $('#nombre').val(), 
                "correo":       $('#correo').val(), 
                "contraseña":   $('#contraseña').val(), 
                "contraseña_d": $('#contraseña_d').val(),
                "rol_usuario":  3, 
                "tipo_perfil": "Recepción"
            };
            $.ajax({
                type: "POST",
                url:"../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    if(resp == "true"){
                        Swal.fire({
                            type: 'success',
                            title: 'El usuario ha sido registrado',
                            showConfirmButton: false,
                            showCloseButton: true
                        })
                    }else if(resp == "data_invalid"){
                         // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                         Swal.fire({
                            type: 'warning',
                            title: 'Houston, tenemos un problema...',
                            text: 'Uno o más campos no están correctamente, verifícalos...',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "pwd_not_match"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'Parece que las contraseñas no coinciden',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "mail_use"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'El correo electrónico ya esta en uso, prueba con otro.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "empty_fields"){
                        Swal.fire({
                            type: 'question',
                            title: '¡Vaya! No recibí ningún dato',
                            text: '¿Deseas intentarlo nuevamente?',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                 }
            });
        }
        else{
            const data = {
                "nombre":       $('#nombre').val(), 
                "correo":       $('#correo').val(), 
                "contraseña":   $('#contraseña').val(), 
                "contraseña_d": $('#contraseña_d').val(),
                "rol_usuario": 1,
                "tipo_perfil": "Administrador"
            };
            $.ajax({
                type: "POST",
                url:"../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    if(resp == "true"){
                        Swal.fire({
                            type: 'success',
                            title: 'El colaborador ha sido registrado',
                            showConfirmButton: false,
                            showCloseButton: true
                        })
                    }else if(resp == "data_invalid"){
                         // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                         Swal.fire({
                            type: 'warning',
                            title: 'Houston, tenemos un problema...',
                            text: 'Uno o más campos no están correctamente, verifícalos...',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "pwd_not_match"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'Parece que  las contraseñas no coinciden',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "empty_fields"){
                        Swal.fire({
                            type: 'question',
                            title: '¡Vaya! No recibí ningún dato',
                            text: '¿Deseas intentarlo nuevamente?',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                 }
            });
        }

    });
}
function showUser(){
    $('#subtitle-inscriptions').text("Revisa la información detallada");
    $('#actionInscriptions').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="inscriptions"><ion-icon name="calendar-outline" size="small"></ion-icon><span id="text-option">Crear registro</span></button>') 
    $('#userslist').replaceWith(`  
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de usuarios</h5> 
    </div>    
    <table class="table table-responsive table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Fecha de creación</th>
        <th scope="col">Tipo de usuario</th>
        <th scope="col">Estado</th>
        <th scope="col">Controles</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-users">
        
    </tbody>
    </table>`);
    // Send the request
    $.post("../../recepcion/form-register.php", {showUsers: true}, function(resp) {
        $('#table-register').empty()
        $.each( resp, function( users, user ) {
            if( user.estado == 'Activo'){
                active = 'checked';
            }else{
                active = '';
            }
            var fila=`
                <tr>
                <th scope="row">${user.id}</th>
                <td>${user.nombre}</td>
                <td>${user.correo}</td>
                <td>${user.fecha}</td>
                <td>${user.perfil}</td>
                <td>${user.estado}</td>
                <td>
                <label class="switch">
                <input type="checkbox" name="checkbox" class="active" id_user="${user.id}"  ${active} />
                <span class="slider round"></span>
                </label>
                
                </td>
                <td><a class="btn btn-danger" onclick="deleteProfile(${user.id})"><ion-icon name="trash-outline"></ion-icon></a></td>
                </tr>     
                `;
            $('#table-users').append(fila);
        });
        
        $('.active').click(function(){
            if($(this).is(':checked')){
                const idUserAct = $(this).attr("id_user");
                const data = {
                    "activar": idUserAct,
                };
                $.ajax({
                    type: "POST",
                    url: "../../recepcion/form-register.php",
                    data: data,
                    success: function(resp){
                        if(resp === 'true'){
                            $('#table-users').empty()
                            showUser();
                            
                        }
                    },
                    error: function(resp){
                        Swal.fire({
                            type: 'error',
                            title: 'Houston, tenemos un problema...',
                            text: 'Se perdió la conexión, contacta al proveedor.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                });
            } else {
                const idUserAct = $(this).attr("id_user");
                const data = {
                    "desactivar": idUserAct,
                };
                $.ajax({
                    type: "POST",
                    url: "../../recepcion/form-register.php",
                    data: data,
                    success: function(resp){
                        if(resp == "true"){
                            $('#table-users').empty()
                            showUser(); 
                        }
                    },
                    error: function(resp){
                        Swal.fire({
                            type: 'error',
                            title: 'Houston, tenemos un problema...',
                            text: 'Se perdió la conexión, contacta al proveedor.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                });
            }
        }); 
    }, 'json');
}
function deleteProfile( id ){
    Swal.fire({
        type: 'question',
        title: "Deshacer permanentemente",
        text: "Eliminarás este registro de usuario, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteUser": id,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-users').empty()
                        showUser();
                        
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });
    
        } else {
            // console.log("*NO Quiere eliminar*");
        }
        })
}
/*link al registro desde el front eliminar?*/
function register(){
    const data = {
        "nombre":       $('#nombre').val(), 
        "correo":       $('#correo').val(), 
        "contraseña":   $('#contraseña').val(), 
        "contraseña_d": $('#contraseña_d').val(), 
    };
    $.ajax({
        type: "POST",
        url:"../../public/recepcion/form-register.php",
        data: data,
        success: function(resp){
            if(resp == "Registrado"){
                var fila=`
                    <div class="modal animated fadeIn" id="userRegister" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                        <h5 class="modal-title text-center">Registrado con éxito</h5>
                        </div>       
                    </div>
                    </div>
                    </div>
                `;
                $('#messageRegister').html(fila);
                $("#userRegister").modal("show");
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
         }
    });
}
//SECCION DONACIONES 
function donations(){
    const data = {
        "nombre":    $('#nombre').val(), 
        "donacion":  $('#donacion').val(),
        "insertDonations": true,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-donations.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                var btnDonate = $("#btn-donation");
                btnDonate.css(btnSuccess);
                btnDonate.text("¡Gracias por Donar!");
                btnDonate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnDonate.css(btnSuccess);
                    btnDonate.text("¡Gracias por Donar!");
                    btnDonate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnDonate.css(btnStatic);
                    btnDonate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnDonate.text("¡Donar!");
                    $('#formG').trigger("reset");
                }, 1000);
                Swal.fire({
                    type: 'success',
                    title: 'Gracias por donar',
                    showConfirmButton: false,
                    showCloseButton: true
                })
            }
            else if(resp == "false"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Sin registro, Se detectaron campos erroneos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Donar!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "empty_fields"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnDanger);
                    userUpdate.text("Los campos estan vacios");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Donar!");
                    }, 1000);
                    Swal.fire({
                        type: 'question',
                        title: '¡Vaya! No recibí ningún dato',
                        text: '¿Deseas intentarlo nuevamente?',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}
function showDonation(){
    $('#subtitle-donations').text("Revisa la información detallada");
    $('#actionDonations').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="donations"><ion-icon name="heart-outline" size="small"></ion-icon><span id="text-option">Nueva donación</span></button>')
    $('#table-donations').replaceWith(`
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de Donaciones</h5> 
    </div>
    <div class="col col-lg-2">
        
    </div>
    <table class="table table-responsive table-striped table-hover" id="datable">
    <thead>
        <tr class="table-color">
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Donacion</th>
        <th scope="col">Fecha</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-register">
    </tbody>
    </table>`
    );
    // Send the request
    $.ajax({
        url: "../../recepcion/form-donations.php",
        data: { 'generateTable_' : true },
        type: "POST",
        success : function(data) {
            var dataInfo = JSON.parse(data)
            var table = $('#datable').dataTable({
                "deferRender": true,
                "processing": true,
                "destroy":true,
                "paging":   true,
                "responsive": true,
                "pagingType": "full_numbers",
                "language": {
                    "emptyTable":			"No hay datos disponibles en la tabla.",
                    "info":		   			"Del _START_ al _END_ de _TOTAL_ ",
                    "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                    "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                    "infoPostFix":			"(actualizados)",
                    "lengthMenu":			"Mostrar _MENU_ registros",
                    "loadingRecords":		"Cargando...",
                    "processing":			"Procesando...",
                    "search":				"Buscar:",
                    "searchPlaceholder":	"Buscar",
                    "zeroRecords":			"No se han encontrado coincidencias.",
                    "paginate": {
                        "first":			"<span style='font-size:12px'>Primera</span>",
                        "last":				"<span style='font-size:12px'>Última</span>",
                        "next":				"<span style='font-size:12px'>Siguiente</span>",
                        "previous":			"<span style='font-size:12px'>Anterior</span>"
                    },
                    "aria": {
                        "sortAscending":	"Ordenación ascendente",
                        "sortDescending":	"Ordenación descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                "data" : dataInfo.ALL,
                "dataSrc": '',
                "columns": [
                    {"data" : 'id'},
                    {"data" : 'nombre'},
                    {"data" : 'donacion'},
                    {"data" : 'fecha'},
                    {"defaultContent" : `<button type='button' class='eliminar btn btn-danger' onclick='deleteDonation()'><ion-icon name='trash-outline'></ion-icon></button>`}
                ],
                
            });
        }    
    });
    
}
function deleteDonation(){
    $('tr td:last-child').click(function(){
        const id = $(this).parent().find('td:first').text();
        Swal.fire({
            type: 'info',
            title: "Deshacer",
            text: "Eliminarás este registro de usuario, ¿Deseas continuar?",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "Sí, continuar",
            cancelButtonText: "Regresar",
            })
            .then(resultado => {
            if (resultado.value) {
                const data = {
                    "deleteDonations": id,
                };
                $.ajax({
                    type: "POST",
                    url: "../../recepcion/form-donations.php",
                    data: data,
                    success: function(resp){
                        console.log(resp)
                        if(resp == "true"){
                            $('#table-register').empty()
                            showDonation();
                        }
                    },
                    error: function(resp){
                        Swal.fire({
                            type: 'error',
                            title: 'Houston, tenemos un problema...',
                            text: 'Se perdió la conexión, contacta al proveedor.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                });
        
            } else {
                // console.log("*NO Quiere eliminar*");
            }
            });

    });
}
function deleteDonationAll( ){
    Swal.fire({
        type: 'warning',
        title: "Ops...",
        text: "Está acción eliminará todos los registros y no se podrán recuperar, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteDonationsAll": true,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-donations.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-register').empty()
                        showDonation();
                        $("#modalDonations").modal('hide');
                        
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });

        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
}
//SECCION INSCRIPCIONES 
function limitInscripcions(){
    const data = {
        "stop": $('#limit').val(),
        "limit": true,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-inscriptions.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                var btnLimitInscription = $("#btn-limit");
                btnLimitInscription.css(btnSuccess);
                btnLimitInscription.text("Actualizado");
                btnLimitInscription.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnLimitInscription.css(btnSuccess);
                    btnLimitInscription.text("Actualizado");
                    btnLimitInscription.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnLimitInscription.css(btnStatic);
                    btnLimitInscription.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnLimitInscription.text("Guardar");
                    $('#formG').trigger("reset");
                }, 1000);
                Swal.fire({
                    type: 'success',
                    title: 'Límite ampliado',
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 1000,
                })
            }
        },
        error: function(resp){
           Swal.fire({
            type: 'error',
            title: 'Houston, tenemos un problema...',
            text: 'Se perdió la conexión, contacta al proveedor.',
            showConfirmButton: true,
            confirmButtonText: 'Continuar',
        })
        }
    });
}
function inscriptions(ext){
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(),
        "edad":      $('#edad').val(),
        "telefono":  $('#telefono').val(), 
        "correo":    $('#correo').val(),
        "asignacion":$('#asignacion').val(),
        "abono":     $('#abono').val(),
        "createInscriptions": true,
    };

    if(ext == 1){url = "../recepcion/form-inscriptions.php";} //url externa
    else{url = "../../recepcion/form-inscriptions.php";}
    
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(resp){
            if(resp == "true"){
                var btnInscription = $("#btn-inscription");
                btnInscription.css(btnSuccess);
                btnInscription.text("Se ha registrado");
                btnInscription.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnInscription.css(btnSuccess);
                    btnInscription.text("Se ha registrado");
                    btnInscription.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnInscription.css(btnStatic);
                    btnInscription.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnInscription.text("¡Inscribirme!");
                    $('#formG').trigger("reset");
                }, 1000);
                Swal.fire({
                    type: 'success',
                    title: 'Gracias por registrarte',
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 1000,
                })
            }else if(resp == "data_invalid"){
                var btnInscription =  $("#btn-inscription");
                btnInscription.css(btnWarning);
                btnInscription.text("Sin registro, Se detectaron campos erroneos");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }else if(resp == "reached_limit"){
                var btnInscription =  $("#btn-inscription");
                btnInscription.css(btnWarning);
                btnInscription.text("Sin registro, Se acompletó la cifra indicada");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'info',
                        title: 'Houston, llegamos al límite asignado...',
                        text: 'Se ha alcanzado el espacio máximo de registros',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "not_exit_option"){
                var btnInscription =  $("#btn-update-register");
                btnInscription.css(btnWarning);
                btnInscription.text("Sin resultados");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'El sistema no encontró la opción de visita selecionada',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "empty_fields"){
                var btnInscription =  $("#btn-inscription");
                btnInscription.css(btnDanger);
                btnInscription.text("Los campos estan vacios");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'question',
                        title: '¡Vaya! No recibí ningún dato',
                        text: '¿Deseas intentarlo nuevamente?',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
        },
        error: function(resp){
           Swal.fire({
            type: 'error',
            title: 'Houston, tenemos un problema...',
            text: 'Se perdió la conexión, contacta al proveedor.',
            showConfirmButton: true,
            confirmButtonText: 'Continuar',
        })
        }
    });
}
function showInscriptions(){
    $('#subtitle-inscriptions').text("Revisa la información detallada");
    $('#actionInscriptions').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="inscriptions"><ion-icon name="calendar-outline" size="small"></ion-icon><span id="text-option">Crear registro</span></button>') 
    $('#inscription').replaceWith(`  
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de inscripciones</h5> 
    </div>
    <div class="col col-lg-2">
        
    </div>      
    <table class="table table-responsive table-striped table-hover" id="datable">
    <thead>
        <tr class="table-color">
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Edad</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Asignacion</th>
        <th scope="col">Abonos</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-register">
    </tbody>
    </table>`);

     $.ajax({
        url: "../../recepcion/form-inscriptions.php",
        data: { 'showRegister' : true },
        type: "POST",
        success : function(data) {
            var dataInfo = JSON.parse(data)
            var table = $('#datable').dataTable({
                "deferRender": true,
                "processing": true,
                "destroy":true,
                "paging":   true,
                "responsive": true,
                "pagingType": "full_numbers",
                "language": {
                    "emptyTable":			"No hay datos disponibles en la tabla.",
                    "info":		   			"Del _START_ al _END_ de _TOTAL_ ",
                    "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                    "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                    "infoPostFix":			"(actualizados)",
                    "lengthMenu":			"Mostrar _MENU_ registros",
                    "loadingRecords":		"Cargando...",
                    "processing":			"Procesando...",
                    "search":				"Buscar:",
                    "searchPlaceholder":	"Buscar",
                    "zeroRecords":			"No se han encontrado coincidencias.",
                    "paginate": {
                        "first":			"<span style='font-size:12px'>Primera</span>",
                        "last":				"<span style='font-size:12px'>Última</span>",
                        "next":				"<span style='font-size:12px'>Siguiente</span>",
                        "previous":			"<span style='font-size:12px'>Anterior</span>"
                    },
                    /* "oPaginate": {
                        "sNext": '<i class="fa fa-forward"></i>',
                        "sPrevious": '<i class="fa fa-backward"></i>',
                        "sFirst": '<i class="fa fa-step-backward"></i>',
                        "sLast": '<i class="fa fa-step-forward"></i>'
                        }, */
                    "aria": {
                        "sortAscending":	"Ordenación ascendente",
                        "sortDescending":	"Ordenación descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                "data" : dataInfo.ALL,
                "dataSrc": '',
                "columns": [
                    {"data" : 'id'},
                    {"data" : 'nombre'},
                    {"data" : 'apellidos'},
                    {"data" : 'edad'},
                    {"data" : 'telefono'},
                    {"data" : 'correo'},
                    {"data" : 'asignacion'},
                    {"data" : 'abono'},
                    {"defaultContent" : `<button type='button' class='editar btn btn-warning' onclick='editInscriptions(this)'><ion-icon name='pencil-outline'></ion-icon></button>  <button type='button' class='eliminar btn btn-danger' onclick='deleteInscriptions(this)'><ion-icon name='trash-outline'></ion-icon></button>`}
                ],
                
            });
        }    
    });

}
function editInscriptions(ids){
        const id = $(ids).parent().parent().find('td:first').text()
            // Send the request
            $.post("../../recepcion/form-inscriptions.php", {'editInscription': id}, function(resp) {
            $("#modalInscriptions").modal('show');
            
            var fila=`
            <form class="form-donation" id="formG">
            <h2 class="text-center">Modificación de Inscripción</h2>
            <div class="mb-3">
                <label for="user" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" value="${resp.nombre}" required>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="${resp.apellidos}" required>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Edad</label>
                <input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" value="${resp.edad}" required>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="${resp.telefono}" required>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" value="${resp.correo}" >
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Tipo de Asginación</label>
                <select class="form-select" name="asignacion" id="asignacion" required>
                    <option selected >Seleciona una opción</option>
                    <option value="01">Invitado</option>
                    <option value="02">Servidor(a)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Abono</label>
                <input type="number" class="form-control" name="abono" id="abono" placeholder="¿Cuánto abono?" value="${resp.abono}" >
            </div>
            <div class="d-grid gap-2">
                <a type="button" class="btn btn-dark" name="btn-update-register" id="btn-update-register" onclick="updateInscriptions(${id})"><ion-icon name="checkmark-outline"></ion-icon>Actualizar</a>
            </div>
            </form>
        `;

            $('#contentEdit').html(fila);
            
        }, 'json');

    
}
function updateInscriptions( id ){
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(),
        "edad":      $('#edad').val(),
        "telefono":  $('#telefono').val(), 
        "correo":    $('#correo').val(),
        "asignacion":$('#asignacion').val(),
        "abono":     $('#abono').val(),
        "updateInscriptions": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-inscriptions.php",
        data: data,
        success: function(resp){
            if(resp == "userUpdate"){
                /* $('#datable').DataTable().clear(); */
                showInscriptions();
                var btnUpdateRegister = $("#btn-update-register");
                btnUpdateRegister.css(btnSuccess);
                btnUpdateRegister.text("Actualizado");
                btnUpdateRegister.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnUpdateRegister.css(btnSuccess);
                    btnUpdateRegister.text("Actualizado");
                    btnUpdateRegister.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnUpdateRegister.css(btnStatic);
                    btnUpdateRegister.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnUpdateRegister.text("Actualizar");
                    setTimeout( editInscriptions( id ), 3000);
                   
                }, 1000);
            }
            else if(resp == "data_invalid"){
                var btnInscription =  $("#btn-inscription");
                btnInscription.css(btnWarning);
                btnInscription.text("Sin registro, Se detectaron campos erroneos");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "not_exit_option"){
                var btnInscription =  $("#btn-update-register");
                btnInscription.css(btnWarning);
                btnInscription.text("Sin resultados");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'El sistema no encontró la opción de visita selecionada',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "empty_fields"){
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}
function deleteInscriptions(ids){
        const id = $(ids).parent().parent().find('td:first').text()
        Swal.fire({
            type: 'info',
            title: "Deshacer",
            text: "Eliminarás este registro de usuario, ¿Deseas continuar?",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "Sí, continuar",
            cancelButtonText: "Regresar",
            })
            .then(resultado => {
            if (resultado.value) {
                const data = {
                    "deleteInscriptions": id,
                };
                $.ajax({
                    type: "POST",
                    url: "../../recepcion/form-inscriptions.php",
                    data: data,
                    success: function(resp){
                        console.log(resp)
                        if(resp == "true"){
                            /* $('#table-register').empty() */
                            showInscriptions();
                        }
                    },
                    error: function(resp){
                        Swal.fire({
                            type: 'error',
                            title: 'Houston, tenemos un problema...',
                            text: 'Se perdió la conexión, contacta al proveedor.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                });
        
            } else {
                // console.log("*NO Quiere eliminar*");
            }
            });
    
}
function inscriptionDeleteAll( ){
    Swal.fire({
        type: 'warning',
        title: "Ops...",
        text: "Está acción eliminará todos los registros y no se podrán recuperar, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteInscriptionsAll": true,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-inscriptions.php",
                data: data,
                success: function(resp){
                    if(resp == "true"){
                        $('#datable').DataTable().clear();
                        showInscriptions();
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });

        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
}
//SECCION PERSONAS NUEVAS
function inscriptionNewPerson(){
const data = {
    "nombre":    $('#nombre').val(), 
    "apellidos": $('#apellidos').val(),
    "telefono":  $('#telefono').val(),
    "ubicacion": $('#option-location').val(),
    "visitante":  $('#option-new-person').val(),
    "createNewPerson": true,
};
$.ajax({
    type: "POST",
    url: "../../recepcion/form-new-person.php",
    data: data,
    success: function(resp){
        if(resp == "true"){
            var btnInscription = $("#btn-inscription");
            btnInscription.css(btnSuccess);
            btnInscription.text("Se ha registrado");
            btnInscription.animate({
                height: '10px', 
                opacity: '0.4',
            }, 500,);
            setTimeout(function() {
                btnInscription.css(btnSuccess);
                btnInscription.text("Se ha registrado");
                btnInscription.animate({
                    height: '100%', 
                    opacity: '0.8',
                }, 800,);
                btnInscription.css(btnStatic);
                btnInscription.animate({
                    height: '100%', 
                    opacity: '1',
                }, 800,);
                btnInscription.text("¡Inscribirme!");
                $('#formG').trigger("reset");
            }, 1000);
            Swal.fire({
                type: 'success',
                title: 'Gracias por registrarte',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1000,
            })
        }else if(resp == "not_exit_option"){
            var btnInscription =  $("#btn-inscription");
            btnInscription.css(btnWarning);
            btnInscription.text("Sin resultados");
                setTimeout(function() {
                    btnInscription.css(btnStatic);
                    btnInscription.text("¡Inscribirme!");
                }, 1000);
                Swal.fire({
                    type: 'warning',
                    title: 'Houston, tenemos un problema...',
                    text: 'El sistema no encontró la opción selecionada',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                })
        }
        else if(resp == "data_invalid"){
            var userUpdate =  $("#btn-inscription");
            userUpdate.css(btnWarning);
            userUpdate.text("Verificar los campos");
            setTimeout(function() {
                userUpdate.css(btnStatic);
                userUpdate.text("Guardar");
            }, 1000);
            // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
            Swal.fire({
                type: 'warning',
                title: 'Houston, tenemos un problema...',
                text: 'Uno o más campos no están correctamente, verifícalos...',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
    }
    else if(resp == "empty_fields"){
        Swal.fire({
            type: 'question',
            title: '¡Vaya! No recibí ningún dato',
            text: '¿Deseas intentarlo nuevamente?',
            showConfirmButton: true,
            confirmButtonText: 'Continuar',
        });
    }
    },
    error: function(resp){
       Swal.fire({
        type: 'error',
        title: 'Houston, tenemos un problema...',
        text: 'Se perdió la conexión, contacta al proveedor.',
        showConfirmButton: true,
        confirmButtonText: 'Continuar',
    })
    }
});
}
function showRegisterNewPerson(){
    $('#subtitle-new-person').text("Revisa la información detallada");
    $('#actionNewPerson').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="new-visit"><ion-icon name="calendar-outline" size="small"></ion-icon><span id="text-option">Crear registro</span></button>') 
    $('#new-people').replaceWith(`  
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de inscripciones</h5> 
    </div>
    <div class="col col-lg-2">
        
    </div>      
    <table class="table table-responsive table-striped table-hover" id="datable">
    <thead>
        <tr class="table-color">
        <th scope="col">#</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Telefono</th>
        <th scope="col">Ubicación</th>
        <th scope="col">Visitó</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-register">
    </tbody>
    </table>`);

     $.ajax({
        url: "../../recepcion/form-new-person.php",
        data: { 'showRegister' : true },
        type: "POST",
        success : function(data) {
            var dataInfo = JSON.parse(data)
            var table = $('#datable').dataTable({
                "deferRender": true,
                "processing": true,
                "destroy":true,
                "paging":   true,
                "responsive": true,
                "pagingType": "full_numbers",
                "language": {
                    "emptyTable":			"No hay datos disponibles en la tabla.",
                    "info":		   			"Del _START_ al _END_ de _TOTAL_ ",
                    "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                    "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                    "infoPostFix":			"(actualizados)",
                    "lengthMenu":			"Mostrar _MENU_ registros",
                    "loadingRecords":		"Cargando...",
                    "processing":			"Procesando...",
                    "search":				"Buscar:",
                    "searchPlaceholder":	"Buscar",
                    "zeroRecords":			"No se han encontrado coincidencias.",
                    "paginate": {
                        "first":			"<span style='font-size:12px'>Primera</span>",
                        "last":				"<span style='font-size:12px'>Última</span>",
                        "next":				"<span style='font-size:12px'>Siguiente</span>",
                        "previous":			"<span style='font-size:12px'>Anterior</span>"
                    },
                    /* "oPaginate": {
                        "sNext": '<i class="fa fa-forward"></i>',
                        "sPrevious": '<i class="fa fa-backward"></i>',
                        "sFirst": '<i class="fa fa-step-backward"></i>',
                        "sLast": '<i class="fa fa-step-forward"></i>'
                        }, */
                    "aria": {
                        "sortAscending":	"Ordenación ascendente",
                        "sortDescending":	"Ordenación descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                "data" : dataInfo.ALL,
                "dataSrc": '',
                "columns": [
                    {"data" : 'id'},
                    {"data" : 'nombres'},
                    {"data" : 'apellidos'},
                    {"data" : 'telefono'},
                    {"data" : 'ubicacion'},
                    {"data" : 'visitante'},
                    {"defaultContent" : `<button type='button' class='editar btn btn-warning' onclick='editRegisterNewPerson(this)'><ion-icon name='pencil-outline'></ion-icon></button>  <button type='button' class='eliminar btn btn-danger' onclick='deleteNewPerson(this)'><ion-icon name='trash-outline'></ion-icon></button>`}
                ],
                
            });
            /* table.dataTable().ajax.reload(); */
            /* getDataEdit("#datable tbody", table); */
            /* $('tr td:last-child').click(function(){
                 console.log($(this).parent().find('td:first').text());
            }); */
           
        }    
    });

}
function editRegisterNewPerson(ids){
    const id = $(ids).parent().parent().find('td:first').text()
        // Send the request
        $.post("../../recepcion/form-new-person.php", {'editRegisterNewPerson': id}, function(resp) {
        $("#modalInscriptions").modal('show');                                  

        var fila=`
        <form class="form-donation" id="formG">
        <h2 class="text-center">Modificación de Inscripción</h2>
        <div class="mb-3">
            <label for="user" class="form-label">Nombres</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" value="${resp.nombres}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="${resp.apellidos}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Telefono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="${resp.telefono}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Ubicación</label>
            <select class="form-select" name="option-location" id="option-location" required>
                <option selected disabled>Seleciona una opción</option>
                <option value="01">Mérida</option>
                <option value="02">Caucel</option>
                <option value="03">Kanasín</option>
                <option value="04">Umán</option>
                <option value="05">Otro</option>
             </select>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">¿Quién visitó?</label>
            <select class="form-select" name="option-new-person" id="option-new-person" required>
                <option selected disabled>Seleciona una opción</option>
                <option value="01">Joven</option>
                <option value="02">Adulto</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <a type="button" class="btn btn-dark" name="btn-new-person" id="btn-new-person" onclick="updateNewPerson(${id})"><ion-icon name="checkmark-outline"></ion-icon>Actualizar</a>
        </div>
        </form>
    `;

        $('#contentEdit').html(fila);
        
    }, 'json');


}
function updateNewPerson( id ){
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(),
        "telefono":  $('#telefono').val(),
        "ubicacion": $('#option-location').val(),
        "visitante":  $('#option-new-person').val(),
        "UpdateNewPersonID": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-new-person.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                showRegisterNewPerson();
                var btnInscription = $("#btn-new-person");
                btnInscription.css(btnSuccess);
                btnInscription.text("Guardando");
                btnInscription.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnInscription.css(btnSuccess);
                    btnInscription.text("Realizando Modificación");
                    btnInscription.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnInscription.css(btnStatic);
                    btnInscription.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnInscription.text("Guardado");
                    $('#modalInscriptions').modal("hide");
                    $('#formG').trigger("reset");
                }, 1000);
                Swal.fire({
                    type: 'success',
                    title: 'Gracias por registrarte',
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 2000,
                })
            }else if(resp == "not_exit_option"){
                var btnInscription =  $("#btn-inscription");
                btnInscription.css(btnWarning);
                btnInscription.text("Sin resultados");
                    setTimeout(function() {
                        btnInscription.css(btnStatic);
                        btnInscription.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'El sistema no encontró la opción selecionada',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "data_invalid"){
                var userUpdate =  $("#btn-inscription");
                userUpdate.css(btnWarning);
                userUpdate.text("Verificar los campos");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar");
                }, 1000);
                // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                Swal.fire({
                    type: 'warning',
                    title: 'Houston, tenemos un problema...',
                    text: 'Uno o más campos no están correctamente, verifícalos...',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
            else if(resp == "empty_fields"){
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}
function deleteNewPerson(ids){
    const id = $(ids).parent().parent().find('td:first').text()
    Swal.fire({
        type: 'info',
        title: "Deshacer",
        text: "Eliminarás este registro de usuario, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteNewPerson": id,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-new-person.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        showRegisterNewPerson();
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });
    
        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });

}
function inscriptionNewPersonDeleteAll( ){
    Swal.fire({
        type: 'warning',
        title: "Ops...",
        text: "Está acción eliminará todos los registros y no se podrán recuperar, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteNewVisitAll": true,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-new-person.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#datable').empty()
                        showRegisterNewPerson();
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });

        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
}
//SECCION PERFILES USUARIO 
function Updateprofile(){
    $("#nombre").prop('disabled', false);
    $("#correo").prop('disabled', false);
    $("#btn-profile").css("display", "none");
    $("#btn-profileUpdate").removeClass("d-none");
}
function Saveprofile( id ){
    const data = {
        "nombre": $('#nombre').val(), 
        "correo": $('#correo').val(),
        "upData": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-profile.php",
        data: data,
        success: function(resp){
            console.log(resp)
            if(resp == "true"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnSuccess);
                userUpdate.text("Usuario Actualizado");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Usuario Actualizado");
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    userUpdate.css(btnStatic);
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 1000,);
                    userUpdate.text("Guardar");
                }, 1200);
                setTimeout(function() {
                    actionMenu('profile')
                }, 1400);
                Swal.fire({
                    type: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    showCloseButton: true
                });
            }else if(resp == "data_invalid"){
                    var userUpdate =  $("#btn-profileUpdate");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }else if(resp == "empty_fields"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnDanger);
                userUpdate.text("Los campos estan vacios");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar!");
                }, 1000);
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
                actionMenu('profile');
            }
           
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}
function Updatepassword(){
    $("#passwordCurrent").prop('disabled', false);
    $("#passwordNew").prop('disabled', false);
    $("#passwordConfirmNew").prop('disabled', false);
    $("#btn-password").css("display", "none");
    $("#btn-passwordUpdate").removeClass("d-none");
}
function Savepassword( id ){
    const data = {
        "passwordCurrent": $('#passwordCurrent').val(), 
        "passwordNew": $('#passwordNew').val(),
        "pwdConfirmNew": $('#passwordConfirmNew').val(),
        "user": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-reset-pass.php",
        data: data,
        success: function(resp){
            console.log(resp)
            if(resp == "true"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnSuccess);
                userUpdate.text("Usuario Actualizado");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Usuario Actualizado");
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    userUpdate.css(btnStatic);
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 1000,);
                    userUpdate.text("Guardar");
                }, 1200);
                setTimeout(function() {
                    actionMenu('profile')
                }, 1400);
                Swal.fire({
                    type: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    showCloseButton: true
                });
            }else if(resp == "pwd_not_equal"){
                    var userUpdate =  $("#btn-profileUpdate");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'La nueva contraseña no coincide, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }else if(resp == "pwdCurrent_not_valid"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnWarning);
                userUpdate.text("Verificar los campos");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar");
                }, 1000);
                // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                Swal.fire({
                    type: 'warning',
                    title: 'Houston, tenemos un problema...',
                    text: 'La contraseña actual no es validá, verifícala...',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
        }else if(resp == "fields_invalids"){
            var userUpdate =  $("#btn-profileUpdate");
            userUpdate.css(btnWarning);
            userUpdate.text("Verificar los campos");
            setTimeout(function() {
                userUpdate.css(btnStatic);
                userUpdate.text("Guardar");
            }, 1000);
            // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
            Swal.fire({
                type: 'warning',
                title: 'Houston, tenemos un problema...',
                text: 'Uno o más campos no son correctos, verifícalos...',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }else if(resp == "empty_fields"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnDanger);
                userUpdate.text("Los campos estan vacios");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar!");
                }, 1000);
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
                actionMenu('profile');
            }
           
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}
function editRemember( id ){
    // console.log('id '+id +" Descubriste una nueva funcion que no se ha programado")
    var fila=`
        <div class="modal fade" id="editremember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-donation" id="formG">
                <div class="mb-3">
                    <label for="recordatorio" class="form-label">Actualizar recordatorio</label>
                    <input type="text" class="form-control" name="remember" id="textremember" placeholder="Recordatorio..." required>
                </div>
                <div class="d-grid gap-2">
                    <a type="button" class="btn btn-dark" name="btn-update-remember" id="btn-update-remember" onclick="updateRemember(${id})"><ion-icon name="checkmark-outline"></ion-icon>Actualizar</a>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    `;

$('#rememberEdit').html(fila);
$("#editremember").modal("show");

}
function updateRemember( id ){
    const data = {
        "recordatorio": $('#textremember').val(), 
        "upDataRemember": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-profile.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                var userUpdate =  $("#btn-update-remember");
                userUpdate.css(btnSuccess);
                userUpdate.text("Guardando");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Guardando");
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    userUpdate.css(btnStatic);
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    userUpdate.text("Guardar");
                }, 1000);
                setTimeout(function() {
                    actionMenu('profile')
                    $("#editremember").modal("hide");
                }, 1200);
                setTimeout(function() {
                    Swal.fire({
                        type: 'success',
                        title: 'Recordatorio Actualizado',
                        showConfirmButton: false,
                        showCloseButton: true
                    });
                }, 1500);
            }else if(resp == "data_invalid"){
                    var userUpdate =  $("#btn-update-remember");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }else if(resp == "empty_fields" ){
                var userUpdate =  $("#btn-update-remember");
                userUpdate.css(btnDanger);
                userUpdate.text("Los campos estan vacios");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar!");
                }, 1000);
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
    // console.log('id '+id +" Descubriste una nueva funcion que no se ha programado")
}
function socialMedia( id ){
    var valueFacebook = $('#link-facebook').attr('href');
    var APIWhatsapp = $('#link-whatsapp').attr('href');
    var valueInstagram = $('#link-instagram').attr('href');
    var valueYotube = $('#link-youtube').attr('href');
    var valueWeb = $('#link-web').attr('href');
    var Mailto = $('#link-email').attr('href');
    const valueWhatsapp = APIWhatsapp.substring(36);
    const valueEmail = Mailto.substring(7);

    var fila=`
        <div class="modal fade" id="socialmedia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-donation" id="formG">
                <div class="mb-3">
                    <label for="social-media" class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="url_facebook" placeholder="https://www.facebook.com" value="${valueFacebook}"required>
                </div>
                <div class="mb-3">
                    <label for="social-media" class="form-label">Whatsapp</label>
                    <input type="text" class="form-control" name="whatsapp" id="url_whatsapp" placeholder="número con prefijo" value="${valueWhatsapp}"required>
                </div>
                <div class="mb-3">
                    <label for="social-media" class="form-label">Instagram</label>
                    <input type="text" class="form-control" name="instagram" id="url_instagram" placeholder="https://www.instagram.com" value="${valueInstagram}" required>
                </div>
                <div class="mb-3">
                    <label for="social-media" class="form-label">YouTube</label>
                    <input type="text" class="form-control" name="youtube" id="url_youtube" placeholder="https://www.youtube.com" value="${valueYotube}" required>
                </div>
                <div class="mb-3">
                    <label for="social-media" class="form-label">Web</label>
                    <input type="text" class="form-control" name="web" id="url_web" placeholder="https://www.paginaweb.com" value="${valueWeb}" required>
                </div>
                <div class="mb-3">
                    <label for="social-media" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control" name="email" id="url_correo" placeholder="correo@hotmail.com" value="${valueEmail}" required>
                </div>
                <div class="d-grid gap-2">
                    <a type="button" class="btn btn-dark" name="btn-update-social" id="btn-update-social-media" onclick="saveSocialMedia(${id})"><ion-icon name="checkmark-outline"></ion-icon>Guardar</a>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    `;

$('#socialUpdate').html(fila);
$("#socialmedia").modal("show");

}
function saveSocialMedia( id ){
    const data = {
        "facebook": $('#url_facebook').val(), 
        "whatsapp": $('#url_whatsapp').val(), 
        "instagram": $('#url_instagram').val(), 
        "youtube": $('#url_youtube').val(), 
        "web": $('#url_web').val(), 
        "correo": $('#url_correo').val(), 
        "useridSocialmedia": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-profile.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                var userUpdate =  $("#btn-update-remember");
                userUpdate.css(btnSuccess);
                userUpdate.text("Guardando");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Guardando");
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    userUpdate.css(btnStatic);
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    userUpdate.text("Guardar");
                }, 1000);
                setTimeout(function() {
                    actionMenu('profile')
                    $("#editremember").modal("hide");
                }, 1200);
                setTimeout(function() {
                    Swal.fire({
                        type: 'success',
                        title: 'Recordatorio Actualizado',
                        showConfirmButton: false,
                        showCloseButton: true
                    });
                }, 1500);
            }else if(resp == "data_invalid"){
                    var userUpdate =  $("#btn-update-remember");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }else if(resp == "empty_fields" ){
                var userUpdate =  $("#btn-update-remember");
                userUpdate.css(btnDanger);
                userUpdate.text("Los campos estan vacios");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar!");
                }, 1000);
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
    // console.log('id '+id +" Descubriste una nueva funcion que no se ha programado")
}
function updatePhoto( id ){
    var fila=`
        <div class="modal fade" id="editremember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="img-profile">
                            <img  src="" alt="Foto de perfil" class="rounded-circle mb-2" id="userCI" width="128" height="128" />
                        </div>
                        <h5 class="card-title">Elige una foto de perfil</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Para una mayor calidad de imágen utilice 480px por 480px</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="file" class="form-control" name="image" id="userImage">
                            <input type="text" class="form-control d-none" name="userProfile" id="userProfile" value="${id}">
                        </div>
                        <div class="d-grid gap-2">
                        <a type="button" class="btn btn-dark" name="btn-update-photo" id="btn-update-photo" ><ion-icon name="checkmark-outline"></ion-icon>Guardar</a>
                        </div>
                    </div>
                </div>

        </form>
            </div>
        </div>
        </div>
        </div>
    `;

$('#rememberEdit').html(fila);
$("#editremember").modal("show");
 var currentPhoto = $("#userImg").attr("src");
 var showCurrent = $("#userCI").attr("src", currentPhoto);
$("#btn-update-photo").on('click', function() {
    var formData = new FormData();
    var files = $('#userImage')[0].files[0];
    var idUser = $("#userProfile").val();
    formData.append('file',files);
    formData.append('idUser',idUser);
    $.ajax({
        url: "../../recepcion/form-profile.php",
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            const resp    = response.split(' ')[0];
            const respath = response.split(' ')[1];
            if (resp == 'true') {
                var userUpdate =  $("#btn-update-photo");
                userUpdate.css(btnSuccess);
                userUpdate.text("Guardando");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    $("#userImg").attr("src", respath);
                    $("#userImgSB").attr("src", respath);
                    $("#userImgNB").attr("src", respath);
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Guardando");
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    userUpdate.css(btnStatic);
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    userUpdate.text("Guardar");
                }, 1000);
                setTimeout(function() {
                    $("#editremember").modal("hide");
                }, 1100);
                setTimeout(function() {
                    Swal.fire({
                        type: 'success',
                        title: 'Actualizado',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 1000,
                    });
                }, 1300);
            } 
            else if (response == 'exist_file'){
                Swal.fire({
                    type: 'info',
                    title: 'Ya existe',
                    text: 'La foto de perfil ya existe con ese nombre',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
            else {
                Swal.fire({
                    type: 'warning',
                    title: 'Sin cambios',
                    text: 'No fue posible cambiar la foto de perfil intenta con (JPEG, JPG, PNG, GIF, SVG) y con un peso menos de 4MB',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                });
            }
            
        }
    });
    return false;
});
}
//SECCION MENSAJES 
function sms(){
    const data = {
        "message":    $('#message').val(), 
        "sms": true,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-whatsapp.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                var btnMessage = $("#btn-message");
                btnMessage.css(btnSuccess);
                btnMessage.text("Se ha enviado");
                btnMessage.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnMessage.css(btnSuccess);
                    btnMessage.text("Se ha enviado");
                    btnMessage.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnMessage.css(btnStatic);
                    btnMessage.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnMessage.text("Enviar mensaje");
                    $('#formG').trigger("reset");
                }, 1000);
            }
            else if(resp == "error_send"){
                var btnMessage =  $("#btn-message");
                    btnMessage.css(btnWarning);
                    btnMessage.text("No enviado");
                    setTimeout(function() {
                        btnMessage.css(btnStatic);
                        btnMessage.text("Enviar mensaje");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Mensaje no enviado',
                        text: 'Ha ocurrido un error al enviar, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}
//SECCION RUTAS 
function actionMenu( item ){
    switch (item) {
        case 'panel':
            $.post("../Homepage.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); cleanItemMenu();
            $('#item-desktop').addClass("active");  $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar') });
          break;
        case 'donations':
            $.post("../Donations.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); cleanItemMenu();
            $('#item-donation').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'inscriptions':
            $.post("../Inscriptions.php", function(contents){ $("#content").html(contents); validateForm(); cleanItemMenu();
            $('#item-inscriptions').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'new-visit':
            $.post("../NuevasVisitas.php", function(contents){ $("#content").html(contents); validateForm(); cleanItemMenu();
            $('#item-new-visit').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'profile':
            $.post("../Profile.php", function(contents){ $("#content").html(contents); validateForm(); cleanItemMenu();
            $('#item-profile').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'configurations':
            $.post("../Configurations.php", function(contents){ $("#content").html(contents);  cleanItemMenu();
            $('#item-configurations').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar') });
          break;
        case 'createUser':
            $.post("../Signup.php", function(contents){ $("#content").html(contents);  cleanItemMenu();
            $('#item-user-management').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'showUsers':
            $.post("../View-user.php", function(contents){ $("#content").html(contents);  cleanItemMenu(); showUser();
            $('#item-user-management').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'direction':
            $.post("../Direction.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-direction').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'maps':
            $.post("../Maps.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-maps').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
          case 'sms':
            $.post("../mensajes.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-sms').addClass("active");  $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'helps':
            $.post("../Helps.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-help').addClass("active");  $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        default:
          console.log('No existe' + item + '.');
      }
}
function cleanItemMenu (){
    var itemsMenu = [
        'item-desktop',
        'item-donation',
        'item-inscriptions',
        'item-new-visit',
        'item-profile',
        'item-configurations',
        'item-user-management',
        'item-direction',
        'item-maps',
        'item-sms',
        'item-help',
    ]
    jQuery.each( itemsMenu, function( i, item ) {
       $('#'+item).removeClass("active");
      });
}

