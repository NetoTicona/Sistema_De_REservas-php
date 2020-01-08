/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({
	startDate: '0d',
	format: 'yyyy-mm-dd',
	todayHighlight:true
});


$('.datepicker.entrada').change(function(){

  $('.datepicker.salida ').attr("readonly",false)
  var fechaEntrada = $(this).val();
  


	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,
		datesDisabled: fechaEntrada,
		format: 'yyyy-mm-dd'
	});

})


/*=============================================
CALENDARIO
=============================================*/
if($('.infoReservas').html() != undefined  )
{

    var idHabitacion = $('.infoReservas').attr('idHabitacion');
   var ffechaIngreso = $('.infoReservas').attr('fechaIngreso');
  var ffechaSalida = $('.infoReservas').attr('fechaSalida');
  var totalEventos = [];
  var opcion1=[]
  var opcion2=[];
  var opcion3=[];
  var validarDisponibilidad
  var dias = $('.infoReservas').attr("dias");

  inicio = `${ffechaIngreso.trim()}` 
  
  salida = `${ffechaSalida.trim()}` 
 
  
  
  
  

  console.log( 'lo datos es bien ');
  
  var datos = new FormData();
  datos.append("idHabitacion",idHabitacion)

  $.ajax({
    url:urlPrincipal + "ajax/reservas.ajax.php",
    method:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:"json",
    success: (rpta)=>{
    if(rpta.length == 0)
    {
          //console.log( 'dsponible');
          $('#calendar').fullCalendar({
            defaultDate:fechaIngreso,
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events: [
          {
            start:`${inicio}`,
            end:`${salida}`,
            rendering: 'background',
            color: '#FFCC29'
          },
        ]
      });
    }else{ 
      //parte del cruce de hpraios
      //dentro de un cliclo for por si hay varas respuetas
      for(var i = 0; i < rpta.length; i++ )
      {
          /* validadndo algun cruce horaios si ficha de ingreo es la mismsa de BD */
        /* opcio1 fechas iniciales coiciden */
          if( ffechaIngreso.trim() == rpta[i]['fecha_ingreso']){
          
              opcion1[i] = false/* opc dice hay coincidencia , hay fechas oscuras*/
          }else{
              opcion1[i]=true /* todo boun */
          }


              /* opcion2 , fecha solicita estra entre resservadas */
          if( ffechaIngreso.trim() > rpta[i]['fecha_ingreso'] && ffechaIngreso.trim() < rpta[i]['fecha_salida']  ){
          
            opcion2[i] = false/* opc dice hay coincidencia , hay fechas oscuras*/
        }else{
            opcion2[i]=true /* todo boun */
        }

          /* opcion3 la... */
          if( ffechaIngreso.trim() < rpta[i]['fecha_salida'] && ffechaSalida.trim() >= rpta[i]['fecha_ingreso']  ){
          
            opcion3[i] = false/* opc dice hay coincidencia , hay fechas oscuras*/
        }else{
            opcion3[i]=true /* todo boun */
        }
          /* opciones se confrontan fechas iniciales coiciden */
          if( opcion1[i] == false || opcion2[i] == false || opcion3[i]==false )  {
            validarDisponibilidad = false;
          }else{
            validarDisponibilidad = true;
          }

      

          /*  EN AMBOS CASOS PINTAR ALAS FECHAS OSCURAS,pero si esta disponible que pinte la solicitud de l nuevo inquilino */
          if(!validarDisponibilidad){
            /*  no hay disponibilidad */
                totalEventos.push(
               /*    {
                    start:`${inicio}`,
                    end:`${salida}`,
                    rendering: 'background',
                    color: '#FFCC29'
                  }, */
                  {
                    start:rpta[i]["fecha_ingreso"]  ,
                    end:rpta[i]["fecha_salida"] ,
                    rendering: 'background',
                    color: '#847059'
                  }
                )/* fin del push */
                $('.infoDisponibilidad').html(' <h5 class="pb-5 float left" > Lo sentimo muchacho , no hay disponibilidad <br> <br> <strong>! vuelve a intentarlo</strong>  </h5>')
                break;

          }else{
            /* si hay diponibilidad , aun asi que me pinta las fechas oscurras */

                totalEventos.push(
               /*    {
                    start:`${inicio}`,
                    end:`${salida}`,
                    rendering: 'background',
                    color: '#FFCC29'
                  }, */
                  {
                    start:rpta[i]["fecha_ingreso"]  ,
                    end:rpta[i]["fecha_salida"] ,
                    rendering: 'background',
                    color: '#847059'
      
                  });
                  $('.infoDisponibilidad').html('  <h5 class="pb-5 float left" > Si esta Disponible br@ </h5>')
          }

      }/* fon del for */
     if(validarDisponibilidad){
      colDerReservas();
              totalEventos.push(
                    {
                    start:`${inicio}`,
                    end:`${salida}`,
                    rendering: 'background',
                    color: '#FFCC29'
                  } );
              
     } 

     /* AGORA SI , apintar si ... */
     $('#calendar').fullCalendar({
      defaultDate:fechaIngreso,
          header: {
              left: 'prev',
              center: 'title',
              right: 'next'
          },
          events: totalEventos
        });     /* calendar :3 */


    }/* fin else */
      
      
    }/* fin uccess */

  })/* fin ajx */
  

 
}





/* SElect anidados */

$('.selectTipoHabitacion').change(function(){

 
  
  
  var ruta = $(this).val();

  
 if(  ruta != ''){
  $(".selectTemaHabitacion").html("");
 
  }else{
    $(".selectTemaHabitacion").html("");
  $(".selectTemaHabitacion").append('<option>  SEleccione un tema xd </option>')
  }

  //$(".selectTemaHabitacion").html("");
  var datos = new FormData();
  datos.append("ruta",ruta);

  $.ajax({
    url:urlPrincipal + "ajax/habitaciones.ajax.php",
    method:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:"json",
    success:(rpta)=>{
      

     $('input[name="ruta"]').val(rpta[0]["ruta"]);
      for(var i= 0; i<rpta.length;i++){
        

        $(".selectTemaHabitacion").append( `<option value= '${ rpta[i]['id_h'] }' > ${rpta[i]["estilo"]}  </option>` )
      }
      
    }
  })  


});

/* CODIGO ALEATORIO */
var chars="0123456789ABCDEFGHIJKLMNOPQRSTWXYZ";
  codigoAleatorio = (chars,length)=>{
    codigo ="";
    for( var i= 0; i< length; i++){
      rand = Math.floor( Math.random()*chars.length);
    //console.log('rand',rand);
    codigo = codigo + chars.substr(rand, 1)
    //codigo = 'wert'

    
    
    //console.log( 'codigo',codigo);
    
    }
    return codigo
  }


/* FUNCIONES DE LA CLUMNA DERECHA */

colDerReservas = ()=>{
   $('.colDerReservas').show();
   var codigoReserva = codigoAleatorio( chars,9 );
   console.log( 'postulante a codigo ',codigoReserva);

  var datos = new FormData();
  datos.append("codigoReserva",codigoReserva)
  console.log( 'apunto de realizar el ajax');
  
  $.ajax({ /* comprobacion del codigo de reservas */
    url:urlPrincipal + "ajax/reservas.ajax.php",
    method:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:"json",
    success: function(rpta)
    {
     if(!rpta){
       console.log( codigoReserva);
       
       $('.codigoReserva').html(codigoReserva);
       $('.pagarReerva').attr("codigoReserva",codigoReserva);

     }else{
      $('.codigoReserva').html(codigoReserva + codigoAleatorio(chars,3) );
      $('.pagarReerva').attr("codigoReserva",codigoReserva);
     }
     
     /* cambio de plan */
     console.log( 'aldslaslalsas');
     
     $(".elegirPlan").change( function(){
  
    
       $('.precioReserva').html( Number( $('.elegirPlan').val().split(",")[0]*dias)*0.25*dias  );
       switchecito();
      

     })//change del select
     $('.cantidadPersonas').change( function(){
      
      console.log( 'se ejecuta el swichito');
      
        switchecito(); 
       
     
       

     });



      
    }

  })



  /* el switch */

   switchecito = ()=>{
     switch ( $('.cantidadPersonas').val() ) {
    case "2":
      $('.precioReserva').html( Number( $('.elegirPlan').val().split(",")[0]*dias)*0.25  );
      $('.pagarReerva').attr("pagoReserva",Number( $('.elegirPlan').val().split(",")[0]*dias)*0.25  );
      $('.pagarReerva').attr("plan",$('.elegirPlan').val().split(",")[1])
      $('.pagarReerva').attr("personas",$('.cantidadPersonas').val());
      console.log($('.cantidadPersonas').val() );
      break;
      case "3":
        $('.precioReserva').html( Number( $('.elegirPlan').val().split(",")[0]*dias)*0.25 + $('.elegirPlan').val().split(",")[0] );
        $('.pagarReerva').attr("pagoReserva",Number( $('.elegirPlan').val().split(",")[0]*dias)*0.25  );
        $('.pagarReerva').attr("plan",$('.elegirPlan').val().split(",")[1])
        $('.pagarReerva').attr("personas",$('.cantidadPersonas').val());
        console.log($('.cantidadPersonas').val() );
        break;
        case "4":
          $('.precioReserva').html( Number( $('.elegirPlan').val().split(",")[0]*dias)*0.50 + $('.elegirPlan').val().split(",")[0]  );
          $('.pagarReerva').attr("pagoReserva",Number( $('.elegirPlan').val().split(",")[0]*dias)*0.25  );
          $('.pagarReerva').attr("plan",$('.elegirPlan').val().split(",")[1])
          $('.pagarReerva').attr("personas",$('.cantidadPersonas').val());
          console.log($('.cantidadPersonas').val() );
          break;
          case "5":
            $('.precioReserva').html( Number( $('.elegirPlan').val().split(",")[0]*dias)*0.75 + $('.elegirPlan').val().split(",")[0]  );
            $('.pagarReerva').attr("pagoReserva",Number( $('.elegirPlan').val().split(",")[0]*dias)*0.75  );
            $('.pagarReerva').attr("plan",$('.elegirPlan').val().split(",")[1])
            console.log($('.cantidadPersonas').val() );
            
            $('.pagarReerva').attr("personas",$('.cantidadPersonas').val());
            break;
            
  
    default:
      break;
  }  
   }




}
/* funcion para generar cookies */
function crearCookie(nombre,valor,diasExpedicion){
  var hoy = new Date();
  hoy.setTime( hoy.getTime() + diasExpedicion*24*60*60*1000 )
  fechaExpedicion= "expires=" + hoy.toUTCString();

  document.cookie = nombre + "=" + valor + "; "+fechaExpedicion;


}



/* CAPTURANDO DATOS DE LA RESERVA info-reserva.php (COOKIES) */
$('.pagarReerva').click(function(){
  var idHabitacion= $(this).attr(('idhabitacion'));
  //console.log( idHabitacion);
  
  var imgHabitacion = $(this).attr('imgHabitacion');
  //onsole.log( imgHabitacion);
  var infoHabitacion = $(this).attr('infoHabitacion')+" - "+$(this).attr('plan')+" - "+
  $(this).attr('personas')+ " peronas" ;
 // console.log( infoHabitacion);

  var codigoReserva = $(this).attr('codigoReserva');
 // console.log( codigoReserva);
  var fechaIngreso = $(this).attr('fechaIngreso');
  //console.log( fechaIngreso);
  var fechaSalida = $(this).attr('fechaSalida');
 // console.log( fechaSalida);
 var pagoReserva = $(this).attr('pagoReserva')
  

  crearCookie("idHabitacion", idHabitacion,1);
  crearCookie("imgHabitacion",imgHabitacion,1)
  crearCookie("infoHabitacion",infoHabitacion,1)
  crearCookie("codigoReserva",codigoReserva,1)
  crearCookie("fechaIngreso",fechaIngreso,1);
  crearCookie("fechaSalida",fechaSalida,1);
  crearCookie("pagoReserva",pagoReserva,1);



});