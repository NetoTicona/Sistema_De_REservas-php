/* colocar case ACtivate */
var enlacesHabitaciones = $(".cabeceraHabitacion ul.nav li.nav-item a");
var tituBtn = []
//console.log(enlacesHabitaciones);




for(var i= 0; i<enlacesHabitaciones.length; i++){
    $(enlacesHabitaciones[i]).removeClass("active")
    $(enlacesHabitaciones[i]).children("i").remove();
    tituBtn[i] =  $(enlacesHabitaciones[i]).html();

}

$(enlacesHabitaciones[0]).addClass("active");
$(enlacesHabitaciones[0]).html('<i class="fas fa-chevron-right" > .. </i>' + tituBtn[0]);

$(enlacesHabitaciones[ enlacesHabitaciones.length -1   ]).css({ "border-right":0 });

/* Enlaces habitaciones */

$(".cabeceraHabitacion ul.nav li.nav-item a").click( function(e){
    //console.log('se hizo click');
    
    e.preventDefault();
    var orden = $(this).attr("orden");
    //console.log(orden);
    
    var ruta = $(this).attr("ruta");

    for(var i= 0; i<enlacesHabitaciones.length; i++){
        $(enlacesHabitaciones[i]).removeClass("active")
        $(enlacesHabitaciones[i]).children("i").remove();
        tituBtn[i] =  $(enlacesHabitaciones[i]).html();
    
    }

$(enlacesHabitaciones[orden]).addClass("active");
$(enlacesHabitaciones[orden]).html('<i class="fas fa-chevron-right" > .. </i>' + tituBtn[orden])
/* consultas ajax */
var datos = new FormData();
datos.append("ruta",ruta);

//console.log('url principal', urlPrincipal );
var action= urlPrincipal+'ajax/habitaciones.ajax.php'
//console.log(action);


var listaSlide = $('.slideHabitaciones .slide-inner .slide-area li')
var alturaSlide = $('.slideHabitaciones .slide-inner .slide-area ').height();
for( var i = 0 ; i< listaSlide.length ;i++){

    $('.slideHabitaciones .slide-inner .slide-area ').css({"height":alturaSlide + "px"})
    $(listaSlide[i]).html('');
   

}



$.ajax({
    url:action,
    method:'POST',
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:'json',
    success:(rpta)=>{
         // console.log(rpta[orden]);

        var galeria = JSON.parse( rpta[orden]['galeria'] );
        //console.log('listas de slide');
        
        //console.log(listaSlide);
        
        for( var i = 0 ; i< galeria.length ;i++){

            $(listaSlide[0]).html('<img class="img-fluid" src="'+urlServidor+galeria[galeria.length -1]   +'" >')
            $(listaSlide[i+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[i]   +'" >')
            $(listaSlide[galeria.length+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[0]   +'" >')
            

        }

        $('#videoHabitaciones iframe').attr('src',"https://www.youtube.com/embed/" +rpta[orden]["video"])
        $('#myPano').attr('back',urlServidor + rpta[orden]["recorrido_virtual"]);  
        $(".d-habitacion").html( rpta[orden]["descripcion_h"] );
        $('.descripcionHabitacion h1').html( rpta[orden]["estilo"]+ " " +rpta[orden]["tipo"]  );
        $('input[name="id_habitacion"]').val(rpta[orden]["id_h"]);/* se colca el valor sacado se id al propo input */
        console.log(rpta[orden]["id_h"]);
        
        /* traer testimonios */
        var datosTestimonios = new FormData();
        datosTestimonios.append("id_h", rpta[orden]["id_h"]);
        
        $.ajax({

            url:urlPrincipal+"ajax/reservas.ajax.php",
            method: "POST",
            data: datosTestimonios,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function(respuesta){
                 console.log( respuesta);
                 
                 var cantidadTestimonios = 0;
					var idTestimonios = [];
					
					$(".testimonios .row").html("");
					$(".verMasTestimonios").remove();
					$(".verMenosTestimonios").remove();
                    $(".testimonios .row").css({'height':"auto"})

                    for(var i = 0; i < respuesta.length; i ++){

						if(respuesta[i]["aprobado"] != 0){

							cantidadTestimonios++;
							idTestimonios.push(respuesta[i]["id_t"]);

						}

					}
                 
                    if(cantidadTestimonios >= 4){
                        var foto = []
                        for(var i = 0; i < idTestimonios.length; i ++){

							if(respuesta[i]["foto"] == ""){

								foto[i] = urlServidor+"vistas/img/usuarios/default/default.png";
							
							}else{

								if(respuesta[i]["modo"] == "direccto"){

									foto[i] = urlServidor+respuesta[i]["foto"];

								}else{

									foto[i] = respuesta[i]["foto"];

                                }
                                $(".testimonios .row").append(`

                                    <div class="col-12 col-lg-3 text-center p-4">

                                        <img src="`+foto[i]+`" class="img-fluid rounded-circle w-50">	
                                                                    
                                        <h4 class="py-4">`+respuesta[i]["nombre"]+`</h4>

                                        <p>`+respuesta[i]["testimonio"]+`</p>

                                    </div> `);

							    $(".testimonios .row").css({'height':$(".testimonios .row div").height()+50+"px", 
														'overflow':'hidden'})

							}
                        }//fin de for 
                    }else{//if(cantidadTestimonios >= 4

						$(".testimonios .row").html('<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>');

                    }
                    
                    if(cantidadTestimonios > 4){

						$(".testimonios .row").after(`
							
			     				<button class="btn btn-default px-4 float-right verMasTestimonios">VER MÁS</button>
			     			
			     		`);

					}
                    
            }

            
        })



    }


})



} )



var alturaTestimonios = $(".testimonios .row").height();
var alturaTestimoniosCorta = $(".testimonios .row div").height()+50;


$(".testimonios .row").css({'height':alturaTestimoniosCorta+"px",
                            'overflow':'hidden'})









                            
 //------------------------------------------------ver mas testimonios----------------------//                           
//asegurase q funqie cuando todo cargue                            
$(document).on("click", ".verMasTestimonios", function(){

    //regreara a laaltura natural de ver  testimonios:
    $(".testimonios .row").css({'height':alturaTestimonios+"px", 
                                'overflow':'hidden'})
    $(this).removeClass("verMasTestimonios");
	$(this).addClass("verMenosTestimonios");
	$(this).html("Ver menos");
a
})

//-------------------menos testimoios----
$(document).on("click", ".verMenosTestimonios", function(){

    //regreara a laaltura natural de ver  testimonios:
    $(".testimonios .row").css({'height':alturaTestimoniosCorta+"px", 
                                'overflow':'hidden'})
    $(this).removeClass("verMenosTestimonios");
	$(this).addClass("verMasTestimonios");
	$(this).html("Ver más");

})