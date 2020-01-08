
/* limpuar formularios */
 $('.modal.formulario').on('hidden.bs.modal', function(){ 
    $(this).find('form')[0].reset();
} )

$('input').change(function(){
    $('.alert').remove();
});


/*  Email Reptido??  al apretar enter al input nos traera la posible oincidencia */  
$('input[name="registroEmail"]').change( function(){
    //var email = $( '  input[name="registroEmail"] ').val();
    //esto es lo mismo:
    var email = $(this).val();
    console.log( email);
    

    var datos = new FormData();
    datos.append("validarEmail",email); ///enviado un valiarble post
    
    $.ajax({
        url:urlPrincipal+"ajax/usuarios.ajax.php",
        method:"POST",
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(rpta){

          if(rpta){
                var modo = rpta["modo"];
                if(modo == "direccto"){
                    modo = "ESta pagina"
                }


                $('input[name="registroEmail"]').val("");
                $('input[name="registroEmail"]').after(` <div class="alert alert-warning">
                <strong> HORROR: </strong>  
                el correo ya esta siendo utilizado por un boot lo sentimos
                ,fue registrado a travez de ${modo}
                </div> `);

          } //exitencia de lrpta 






        }//fin success


    })
    



});


/* -------------------------------------------FACEBOOK---------------------------------- */
/* boboton de facebook */
$('.facebook').click( function(){

    console.log('apretaste facebook');
    FB.login(function(rpta){
        console.log('facebuko-rpta',rpta)
        validarUsuario();
    },{scope:'public_profile,email '})


} )


/* validar el ingreso */
function validarUsuario(){
    FB.getLoginStatus( function(response){
        statusChangeCallback(response);


    } )
}

/* validamos el vami d e estado en facebook */
function statusChangeCallback(respuesta){
    if( respuesta.status == 'connected' ){
        testApi();
    }else{
        swal({
            type:"error",
            title: "¡Ay No!",
            text: "¡conected es false, que fue facebook,talvez ssea el https!",
            showConfirmButton: true, 
            confirmButtonText: "Cerrar"
        
    }).then(function(result){

            if(result.value){   
                history.back();
            } 
    });
    }
}

/* ingresamo la api de facebook */
//pra ver si el email viene nulo
function testApi(){
    FB.api('/me?fields=id,name,email,picture',function(r){
        if(r.email == null){
            swal({
                type:"error",
                title: "¡CORREGIR!",
                text: "¡Ndebe ingresar el correo que no lo psusuite al inicio???",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            
        }).then(function(result){

                if(result.value){   
                    history.back();
                } 
        });

         return
        }else{
            
            console.log( 'r.email',r.email);
            
            
            //email viene coninformacion
            var email = r.email;
            var nombre = r.name;
            var foto = "https://graph.facebook.com/"+r.id+"/picture?type=large";
            var datos = new FormData();
            datos.append("email",email);
            datos.append("nombre",nombre);
            datos.append("foto",foto);
            
            
            $.ajax({
                url:urlPrincipal+"ajax/usuarios.ajax.php",
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData:false,
                dataType:"json",
                success:function(rpta){
                    console.log(rpta)

                    if(rpta == "okey"){
                        window.location = urlPrincipal + "perfil"  //xdxdx
                        //noas vamos pa otro lado

                    }else{

                        swal({
                            type:"error",
                            title: "¡Ay No!",
                            text: "¡El correo" + email +"ya esta registrado con otro metodo",
                            showConfirmButton: true, 
                            confirmButtonText: "Cerrar"
                        
                    }).then(function(result){
                            console.log('result: ',result)
                            if(result.value){   
                            //las cokkies de facebook se deben borrar
                            //ya esta registrado con otro metodo
                                FB.getLoginStatus( (response)=>{
                                    console.log( 'response',response);
                                    
                                    if( response.status === 'connected' ){
                                        FB.logout( (rpta)=>{
                                            console.log( 'rpta',rpta);
                                            
                                            deleteCookie("fbm_538896353359902")
                                             setTimeout(function(){

                                                    window.location=urlPrincipal+"salir";

                                                },500)


                                        });//FB.logout

                                        function deleteCookie(name){
                                            document.cookie = name +'=; Path/; Expires=Thu, 01 Jan 1980 00:00:01 GMT;';
                                            

                                        }//function
                                    }//if
                                   
                                })//getliginstatus
                            } 
                    });//swal-then

                    }//else
                }
            
            })

            
            
            
        }//fin else
          
    })//FB.api('/me?fie
}
/*salir de feis */


$('.salir').click( function(e){
     e.preventDefault();
     //nos desconectamois de facbook no se donde pero si se que borra la cokiees
    

     FB.getLoginStatus( (response)=>{
        console.log( 'response',response);
        
        if( response.status === 'connected' ){
            FB.logout( (rpta)=>{
                
                
                deleteCookie("fbm_538896353359902");
                setTimeout(function(){

                    window.location=urlPrincipal+"salir";

                },500)

            });//FB.logout

            function deleteCookie(name){
                document.cookie = name +'=; Path/; Expires=1993-12-26T01:18:31.000Z';
                //esta funcion debe terminar para comenzar on otra 
                //ver ejemplo:https://stackoverflow.com/questions/21518381/proper-way-to-wait-for-one-function-to-finish-before-continuingfo r
                
                

            }//function
        }else{
            //si no esta logaso tmb se sale
            deleteCookie("fbm_538896353359902");
            setTimeout(function(){

                window.location=urlPrincipal+"salir";

            },500);
            function deleteCookie(name){
                document.cookie = name +'=; Path/; Expires=Thu, 01 Jan 1980 00:00:01 GMT;';
                //esta funcion debe terminar para comenzar on otra 
                //ver ejemplo:https://stackoverflow.com/questions/21518381/proper-way-to-wait-for-one-function-to-finish-before-continuingfo r
                
                

            }//function


        }
       





    })//getliginstatus
     
    })
    
    
/* --------------------------------------------//FACEB---------------------------------- */