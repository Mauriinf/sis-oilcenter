@can('editar-tipos-servicios')
<button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Editar" onclick="f_editar_tiposervicio({{$id}},'{{$nombre}}')">Editar</button>
@else
<span class="badge badge-light-warning">Sin Permisos</span>
@endcan


