function enviar(cadena,urls=''){
    $('input[type="submit"]').attr('disabled',true);
  /*  $('.load').show();*/
    //var envio = $.post('',cadena,function(){},'json');
   $.ajax({
        url:urls,
        type: "POST",
        data: cadena,
        contentType: false,
        processData: false,

        success: function(datos)
        {
        if($.isEmptyObject(datos.error)){
            Swal.fire({
                type: "success",
                    title: "¡Se guardo exitosamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Ok"

                }).then(function(result){

                    if(result.value){
                    location.reload();

                    }

                });
        }else{
            $('input[type="submit"]').attr('disabled',false);
                $.each(datos.error, function( key, value ) {
                $('.'+key+'_err').text(value);
            });
        }

        }

    });

  }

//Función para eliminar registros
function eliminardata(cadena,urls)
{

    Swal.fire({

              title: "¿Eliminar?",
              text: "¿Está Seguro de eliminar?",
              type: "warning",
              showCancelButton: true,
              cancelButtonText: "No",
              confirmButtonText: "Si",
              closeOnConfirm: false,
              closeOnCancel: false,
              showLoaderOnConfirm: true
              }).then(function(result){
               if(result.value){

                $.ajax({
                    url:urls,
                    type: "POST",
                    data: cadena,
                    contentType: false,
                    processData: false,

                    success: function(datos)
                    {
                    location.reload();
                    }
                     });

              }
            });
}
