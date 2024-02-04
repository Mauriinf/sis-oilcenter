function init(){
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        mostrarform(false);

        $('#formtratamiento').on('submit',function(e){
        e.preventDefault(e);
            var cadena = new FormData($("#formtratamiento")[0]);
            /*console.log(cadena);*/

            enviar(cadena,'/tratamientos');
    });

}
function limpiar()
{
	$("input[id=costo]").val('');
	$("input[id=descripcion]").val('');
}
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$(".listaregistros").hide();
		$(".formregistros").show();
		/*$("#btnGuardar").prop("disabled",false);*/
		$(".btnagregar").hide();
		/*$(".btnagregar").show();*/
	}
	else
	{

		$(".listaregistros").show();
		$(".formregistros").hide();
		$(".btnagregar").show();
		/*$("#btnagregar").show();*/
	}
}
function eliminar(id)
{
	var cadena = new FormData($("#delete-form")[0]);

 eliminardata(cadena,'/tratamientos/'+id);
}
function mostrar(id)
{
	$.ajax({
      url:"/tratamientos/"+id+"/show",
      type: "GET",
      data: {},
      contentType: false,
      processData: false,

      success: function(data)
      {
        mostrarform(true);
		  $("input[id=costo]").val(data.costo);
          $("input[id=color]").val(data.color);
		   $("input[id=descripcion]").val(data.descripcion);
		   $("input[name=id]").val(data.id);
	  }
    });

}
init();
