function init(){
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        mostrarform(false);

        $('#formespecialidad').on('submit',function(e){
        e.preventDefault(e);
            var cadena = new FormData($("#formespecialidad")[0]);
            /*console.log(cadena);*/

            enviar(cadena,'/especialidades');
    });

}
function limpiar()
{
	$("input[id=nombre]").val('');
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

 eliminardata(cadena,'/especialidades/'+id);
}
function mostrar(id)
{
	$.ajax({
      url:"/especialidades/"+id+"/show",
      type: "GET",
      data: {},
      contentType: false,
      processData: false,

      success: function(data)
      {
        mostrarform(true);
		  $("input[id=nombre]").val(data.nombre);
		   $("input[id=descripcion]").val(data.descripcion);
		   $("input[name=id]").val(data.id);
	  }
    });

}
init();
