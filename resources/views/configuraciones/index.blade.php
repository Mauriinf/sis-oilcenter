@extends('vuexy.layouts.default', ['activePage' => 'configuraciones'])
@section('title','Categorias y Servicios')
@push('css-vendor')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
<!-- END: Vendor CSS-->
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/animate/animate.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/extensions/sweetalert2.min.css') !!}">
<!-- END: Vendor CSS-->
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') !!}">
<!-- END: Page CSS-->

@endpush
@section('content')
<div class="content-wrapper p-0">
  <div class="content-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header border-bottom">
            <h4 >
              Tipos de Servicios
            </h4>
            <div class="pull-right">
              <div class="input-group-prepend pull-right btnagregar">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar">
                  <i data-feather='plus'></i>
                  Nuevo
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="table-responsive listaregistros">
                    <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="tdLista">
                      <thead class="thead">
                        <tr>

                          <th>Nro</th>
                          <th>Nombre</th>
                          <th>Estado</th>
                          <th >Actiones</th>
                        </tr>
                      </thead>
                      <tbody >

                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div>
          <div class="alert alert-success p-2" id="respuesta" style="display: none;">
            <p></p>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tipo de categoria</h4>
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" id="agregarCat" data-bs-target="#Articulo">
                <i data-feather='plus'></i>
                <span>Crear Categoria</span>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="card-datatable">
              <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="dt-Categoria">
                <thead class="thead" align="center">
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th><i data-feather='life-buoy'></i></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal fade" id="Articulo" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="Btnclose"></button>
              </div>
              {!! Form::open(['id' => 'CategoriaForm']) !!}
              <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewCardTitle">Categoria</h1>
                <p class="text-center">Crear nueva Categoria</p>
                <div class="col-md-12">
                  <label class="form-label" for="modalAddCardName">Nombre:</label>
                  <input type="hidden" id="editId">
                  <input type="text" name="nombreC" id="nombreC" class="form-control" placeholder="..." />
                  <span class="text-danger" id="errorNombre"></span>
                </div>
                <div class="col-md-12 col-md-3">
                  <label class="form-label" for="modalAddCardExpiryDate">Descripción</label>
                  <textarea class="form-control" name="descripcionC" id="descripcionC" placeholder="..."></textarea>
                  <span class="text-danger" id="errorDescripcion"></span>
                </div>
                <div class="col-12 text-center">
                  <button type="submit" id="btnSave" class="btn btn-success me-1 mt-1">Guardar</button>
                  <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                    Cancelar
                  </button>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-agregar">
  <div class="modal-dialog" style="max-width: 40%;" role="document">
    <div class="modal-content" >
      <div class="modal-header alert-primary">
        <h4 class="modal-title">Nueva tipo de servicio</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onSubmit="return false" id="formAdd" action="{{ route('tiposervicio.save') }}">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
          </div>
          <div class="form-group row">
            <div class="col-md-12 text-center">
              <div class="row ">
                <div class="col-md-12">
                  <div class="mb-1">
                    <div class="input-group " >
                      <span class="input-group-text">
                        Nombre
                      </span>
                      <input type="text" class="form-control" id="nombre_tipo" name="nombre_tipo" placeholder="Nombre" value="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <div class="modal-footer">
          <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather='minus-circle'></i> Cerrar</a>
          <button type="submit" class="btn btn-success"><i data-feather='save'></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-editar">
  <div class="modal-dialog" style="max-width: 40%;" role="document">
    <div class="modal-content" >
      <div class="modal-header alert-info">
        <h4 class="modal-title">Editar Tipo Servicio</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onSubmit="return false" id="formEdit" action="{{ route('tiposervicio.edit') }}" method="POST">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
          </div>
          <input type="hidden" value="" name="id_edit" id="id_edit">
          <div class="form-group row">
            <div class="col-md-12 text-center">
              <div class="row ">
                <div class="col-md-12">
                  <div class="mb-1">
                    <div class="input-group " >
                      <span class="input-group-text">
                        Nombre
                      </span>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row row-space-10">
                <div class="col-md">
                  <div class="mb-1">
                    <div class="input-group" >
                      <span class="input-group-text">
                        Estado
                      </span>
                      <select name="estado" id="estado" class="form-control form-select">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <div class="modal-footer">
          <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather='minus-circle'></i> Cerrar</a>
          <button type="submit" class="btn btn-success"><i data-feather='save'></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts-vendor')
<!-- BEGIN: Page Vendor JS-->
<script src="{!! asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/jszip.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/rowGroup.bootstrap5.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') !!}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{!! asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/extensions/polyfill.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') !!}"></script>
{{-- funciones --}}
<script src="{!! asset('app-assets/js/funtions.js') !!}"></script>


@endpush
@push('scripts-page')
<script>
                //dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
  $(document).ready( function () {
    $('#tdLista').DataTable({
      dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
      language: {
        "url": "/app-assets/js/scripts/tables/spanish.json"
      },
      buttons: [

        ],
      "ajax": {
        url: "{{route('lista.tiposervicio')}}",
        type: 'GET',
      },
      columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + 1;
        }
      },
      { data: 'nombre', name: 'nombre'},
      {data: 'estado', name: 'estado',
      render: function(data, type, row, meta) {
        return data === 'ACTIVO' ?
        '<span class="badge bg-primary">ACTIVO</span>' :
        '<span class="badge bg-danger">INACTIVO</span>';
      }
    },
    { data: 'botones', "orderable": false}
    ],
      error: function(jqXHR, textStatus, errorThrown){
        $("#tdLista").DataTable().clear().draw();
      }
    });


  });

  function f_editar_tiposervicio(id,nombre){
    document.getElementById('id_edit').value=id;
    document.getElementById('nombre').value=nombre;
    $('#modal-editar').modal('toggle');
  }



/*CATEGORIA*/
  var url = '';
  var type = '';

  function indexCategoria(){
    $.ajax({
      url: "{{ url('categoria') }}",
      method: 'GET',
      success: function(response) {
        $('#dt-Categoria tbody').empty();
        cargarDatos(response.categoria);
        tableAdd();
      },
      error: function(error) {
        alert(error.message);
      }
    });
  }
  $(document).ready(function () {
    indexCategoria();
  });

  function tableAdd() {

    $('#dt-Categoria').DataTable({
      retrieve: true,
      paging: true,
      dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
              //displayLength: 7,
              //lengthMenu: [7, 10, 25, 50, 75, 100],
      language: {
        "url": "/app-assets/js/scripts/tables/spanish.json"
      },
      buttons: [
        ],
    });

  };

  function cargarDatos(categoria){

    $.each(categoria, function(index, categoria) {

      var btnEditar = '<button class="btn btn-warning btn-sm btnEdit" style="margin-right:5px;" data-id="' + categoria.id + '" data-nombre="' + categoria.nombre + '" data-descripcion="' + categoria.descripcion + '">Editar</button>';

      var estado = (categoria.estado == 1) ? 'Activo' : 'Inactivo';
      var btnEstado = (categoria.estado == 1) ? '<button class="btn btn-danger btn-sm btnDisable" data-id="' + categoria.id + '">Desabilitar</button>' : '<button class="btn btn-success btn-sm btnEnable" data-id="' + categoria.id + '">Habilitar</button>';

      $('#dt-Categoria tbody').append(
        '<tr>' +
        '<td>' + (index + 1 )+ '</td>' +
        '<td>' + categoria.nombre + '</td>' +
        '<td>' + categoria.descripcion + '</td>'+
        '<td align="center">' + estado + '</td>' +
        '<td><div class="d-flex">' + btnEditar + btnEstado +' </div></td>' +
        '</tr>'
        );
    });
  }

  function evaluar(){

    var id = $('#editId').val();

    if ($('#editId').val() == "") {
      url = "{{ route('categoria.store') }}";
      type = 'POST';
      $('#btnSave').text('Guardar');
    }else{
      url = "{{ url('categoria') }}/" + id;
      type = 'PUT';
      $('#btnSave').text('Modificar');
    }
  }
  $('#btnSave').click(function(event) {
    event.preventDefault();

    guardarForm();
  });

  $('#agregarCat').click(function(event) {
    event.preventDefault();
    limpiar();
    $('#Articulo').modal('show');
    $('#miBoton').text(valor);
  });

  function guardarForm(){

    var formData = $('#CategoriaForm').serialize();

    evaluar();

    $.ajax({
      url: url,
      type: type,
      data: formData,
      success: function(response){
        $('#respuesta p').text(response.success);
        $('#respuesta').show();
        $('#Articulo').modal('hide');
        limpiar();
        $('#dt-Categoria tbody').empty();
        cargarDatos(response.categoria);
      },
      error: function(xhr, textStatus, errorThrown){

        var errors = xhr.responseJSON;

        console.log(errors.errors)

        if (errors.errors.hasOwnProperty('descripcionC')) {
          $('#errorDescripcion').text(errors.errors.descripcionC[0]);
          $('textarea[name=descripcionC]').addClass('border border-danger');
        }
        if (errors.errors.hasOwnProperty('nombreC')) {
          $('#errorNombre').text(errors.errors.nombreC[0]);
          $('input[name=nombreC]').addClass('border border-danger');
        }
      }
    });
  }

  $(document).on('click', '.btnEdit', function() {

    $('#editId').val($(this).data('id'));

    $('#nombreC').val($(this).data('nombre'));
    $('#descripcionC').val($(this).data('descripcion'));
    $('#Articulo').modal('show');
  });

  $(document).on('click', '.btnEnable', function() {

    var id = $(this).data('id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: url = "{{ url('categoria/enable') }}/" + id,
      type: 'PUT',
      success: function(response){

        $('#respuesta p').text(response.success);
        $('#respuesta').show();

        indexCategoria();

      },
      error: function(xhr, textStatus, errorThrown){

        var errors = xhr.responseJSON;

        console.log(errors.errors)

      }

    });

  });

  $(document).on('click', '.btnDisable', function() {

    var id = $(this).data('id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: url = "{{ url('categoria/disable') }}/" + id,
      type: 'PUT',
      success: function(response){

        $('#respuesta p').text(response.success);
        $('#respuesta').show();
        
        indexCategoria();

      },
      error: function(xhr, textStatus, errorThrown){

        var errors = xhr.responseJSON;

        console.log(errors.errors)

      }
      
    });


  });

  function limpiar(){
    $('#editId').val("");
    $('#nombreC').val("");
    $('#descripcionC').val("");
  }
  
</script>
@endpush
