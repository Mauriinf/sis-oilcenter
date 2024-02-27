@extends('vuexy.layouts.default', ['activePage' => 'venta'])
@section('title','Nuevo Venta')
@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-body">
    <section id="basic-input">
      <div class="row">
        <div>
          <div class="alert alert-danger p-2" id="respuesta" style="display: none;">
            <p></p>
          </div>
        </div>
        <div class="col-md-12">
          @if (count($errors) > 0 && session('title'))
            <div class="alert alert-danger p-1">
              @if(session('title'))
                <strong>{{ session('title') }}</strong>
              @endif
              <br><br>
              <ul>
                 @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                 @endforeach
              </ul>
            </div>
          @endif
          {!! Form::open(array('route' => isset($venta) ? ['venta.update', $venta->id] : 'venta.store', 'method' => isset($venta) ? 'PUT' : 'POST', 'id' => 'formulario')) !!}
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Venta</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-5">
                  <div class="row">
                    <div class="col-md-7 mb-3">
                      <div class="form-group">
                        <label>Cliente:</label>
                        <select class="form-select @if($errors->has('cliente')) border border-danger @endif" name="cliente" id="cliente">
                          <option value="0">Seleccione...</option>
                          @foreach ($cliente as $cli)
                          <option value="{{ $cli->id }},{{ $cli->nombres }},{{ $cli->paterno }},{{ $cli->materno }}" {{ ( isset($venta) && $venta->id_cliente == $cli->id) || (old('cliente') && explode(',', old('cliente'))[0] == $cli->id) ? 'selected' : '' }}>
                              {{ $cli->nombres .' ' . $cli->paterno .' ' . $cli->materno }}
                          </option>
                          @endforeach         
                        </select>
                        @error('cliente') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <label>Articulo:</label>
                        <select class="form-select @if($errors->has('articulo')) border border-danger @endif" name="articulo" id="articulo">
                          <option value="0">Seleccione...</option>
                          @foreach ($articulo as $art)
                          <option value="{{ $art->id }},{{ $art->nombre }}">
                            {{ $art->nombre }}
                          </option>
                          @endforeach         
                        </select>
                        @error('articulo') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-3 mb-2">
                      <div class="form-group">
                        <label>stock:</label>
                        <input type="hidden" name="stock" id="stock">
                        <input type="text" name="stock_v" id="stock_v" class="form-control text-center" placeholder="0" readonly>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="mb-1">
                        <label>Precio normal:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <div class="form-check">
                              <input type="radio" class="form-check-input text-center" name="radio_p_norm" id="radio_p_norm" data-valor="0">
                            </div>
                          </div>
                          <input type="text" class="form-control" placeholder="0.00" name="p_normal" id="p_normal">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="mb-1">
                        <label>Precio facturado:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <div class="form-check">
                              <input type="radio" class="form-check-input text-center" name="radio_p_fact" id="radio_p_fact" data-valor="0">
                            </div>
                          </div>
                          <input type="text" class="form-control" placeholder="0.00" name="p_factura" id="p_factura">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 mb-2">
                      <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="cantidad" id="cantidad" class="form-control text-center @if($errors->has('cantidad')) border border-danger @endif" placeholder="...">
                        @error('cantidad') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                  </div>
                  <div>
                    <button type="button" id="bt_add" class="btn btn-success w-100">
                      <i class="feater-plus"></i>
                      Agregar al detalle
                    </button>
                  </div>
                </div>
                <div class="col-md-7 d-flex flex-column">
                  <input type="hidden" name="datosFilas" id="datosFilas">
                  <div class="p-1 bg-light-secondary border-bottom-dark">
                    <b><p class="m-0">Cliente: <span id="cli"></span></p></b>
                  </div>
                  <table id="detalles" class="table table-striped table-bordered table-sm">
                    <thead align="center">
                      <th><i data-feather='life-buoy'></i></th> 
                      <th>PRODUCTO</th>
                      <th>CANTIDAD</th>
                      <th>P. VENTA</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="flex-grow-1 border-bottom-dark"></div> 
                  <div class="row mt-1">
                    <div class="col-md-4">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Total Bs.</span>
                        </div>
                        <input type="text" class="form-control text-center @if($errors->has('total')) border border-danger @endif" name="total" id="total" align="center" placeholder="0.00" readonly>
                      </div>
                      @error('total') <span class="text-danger">* {{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Abono Bs.</span>
                        </div>
                        <input type="text" class="form-control text-center" name="cancelado" id="cancelado" value="0.00">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Saldo Bs.</span>
                        </div>
                        <input type="text" class="form-control text-center @if($errors->has('saldo')) border border-danger @endif" name="saldo" id="saldo" placeholder="0.00" readonly>
                      </div>
                      @error('saldo') <span class="text-danger">* {{ $message }}</span> @enderror
                    </div>
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group ">
              <a class="btn btn-secondary float-md-start" href="javascript:history.back(-1);" title="Ir la página anterior" class="fa fa-hand-o-left">Volver</a>
              <button type="submit" id="enviar" class="btn btn-success float-md-end {{ isset($ingreso) ? 'btn-warning': ''}}">
                <span>
                  <i data-feather='save'></i>
                  {{ isset($ingreso) ? 'Actualizar' : 'Guardar' }}
                </span>
              </button>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </section>
</div>
</div>
@endsection

@push('scripts-vendor')

<!-- BEGIN: Page Vendor JS-->
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{!! asset('app-assets/js/scripts/forms/form-select2.js') !!}"></script>
<!-- END: Page JS-->


@endpush
@push('scripts-vendor')
<script>

  document.addEventListener('DOMContentLoaded', function() {
    
    var clienteOld = "{{ old('cliente') }}";
    if (clienteOld) {
      var n_completo = clienteOld.split(',')[1]+' '+clienteOld.split(',')[2]+' '+clienteOld.split(',')[3];
      $('#cli').text(n_completo);
    }
    
  });


  var cont=0;
  total=0;
  subtotal = [];
  var datosFilas = [];


  $('#total, #cancelado').on('input', cargarSaldo);

  function cargarSaldo() {
        // Obtener valores de los inputs y sumarlos
    var total = parseFloat($('#total').val()) || 0;
    var cancelado = parseFloat($('#cancelado').val()) || 0;
    var suma = total - cancelado;
    $('#saldo').val(suma+ '.00');
  }

  $('#enviar').click(function() {
    var datosJSON = JSON.stringify(datosFilas);
    $('#datosFilas').val(datosJSON);
    $('#formulario').submit();
  })

  function selectCliente(value) {

    $('#cliente').change(function() {

      var selectedValue = $(this).val().split(',')[1]+' '+$(this).val().split(',')[2]+' '+$(this).val().split(',')[3];
      
      // Establecer el valor seleccionado en el contenido del span
      $('#cli').text(selectedValue);


    });
  }

  $(document).ready(function() {
    calcularStock();
    selectCliente();
    precio();
    radioSelect();
    $('#bt_add').click(function() {

      agregar();
    });
  });


  function calcularStock(){

    var stock = parseInt($('#stock').val());
    var cantidad = parseInt($('#cantidad').val());

    if (stock < cantidad) {
      alert('La cantidad a vender no puede ser mayor al stock');
      $('#cantidad').val(stock)
      return true;
    }

    return false;

  }
  function agregar() {

    id_cliente = $('#cliente').val().split(',')[0];
    id_articulo = $('#articulo').val().split(',')[0];
    nombre_articulo = $('#articulo').val().split(',')[1];
    d_cantidad=$('#cantidad').val();
    d_p_venta = 0;

    if ($('#radio_p_norm').prop('checked')) {
      d_p_venta = $('#p_normal').val();
    }else if($('#radio_p_fact').prop('checked')){
      d_p_venta = $('#p_factura').val();
    }

    if (d_cantidad!="" && d_cantidad!="" && d_cantidad>0 && d_p_venta>0 && id_cliente>0) {

      if (!calcularStock()) {
        subtotal[cont]=(d_cantidad*d_p_venta);

        total=total + subtotal[cont];

        var fila='<tr class="selected" align="center" id="fila'+cont+'"><td><button type="button" class="btn btn-warning btn-sm" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="nombre_articulo" id="nombre_articulo" value="'+nombre_articulo+'">'+nombre_articulo+'</td><td><input type="hidden" name="d_cantidad" value="'+d_cantidad+'">'+d_cantidad+'</td><td><input type="hidden" name="d_p_venta" value="'+d_p_venta+'">'+d_p_venta+'</td></tr>';
        cont++;
        limpiar();
        $("#total").val(total+'.00');
        cargarSaldo();
        //evaluar(); 
        $('#detalles').append(fila);
        push_array();
      }
      
    }else {
      alert("Error al ingresar el movimiento revise los datos del Articulo");
    }

  }
  function push_array(){
    datosFilas.push({
      id_articulo: id_articulo,
      d_cantidad: d_cantidad,
      d_p_venta: d_p_venta
    });
  }
  function limpiar() {
    $('#articulo').val(0);
    $('#cantidad').val("");
    $('#precio_venta').val("");
    $('#p_normal').val("");
    $('#p_factura').val("");
    $('#radio_p_norm').prop('checked', false);
    $('#radio_p_fact').prop('checked', false);
    $('#stock').val(0);
    $('#stock_v').val(0);
  }
  function evaluar() {
    if (total>0) {
      $("#guardar").show();
    }else {
      $("#guardar").hide();
    }
  }
  function eliminar(index) {
    total=total-subtotal[index];
    $("#total").val(total+'.00');
    $("#fila"+index).remove();
    datosFilas.splice(index, 1);
    evaluar();
    cargarSaldo();
  }
  //  vender
  function radioSelect(){
    $('#radio_p_fact, #radio_p_norm').change(function() {
      if ($(this).is(':checked')) {
        var otroRadio = $(this).attr('id') === 'radio_p_fact' ? $('#radio_p_norm') : $('#radio_p_fact');
        otroRadio.prop('checked', false);
      }
    });   
  }
  function precio(){
    $('#articulo').change(function() {
      var articulo = $(this).val().split(',')[0];
      $.ajax({
        url: 'precio/'+articulo,
        type: 'GET',
        success: function(response) {
          $("#p_normal").val(response.precio.precio_venta_normal+'.00');
          $("#p_factura").val(response.precio.precio_venta_factura+'.00');
          $("#stock").val(response.precio.articulo.stock);
          $("#stock_v").val(response.precio.articulo.stock);
        },
        error: function(xhr, textStatus, errorThrown) {

          $('#respuesta p').text(xhr.responseJSON.message);
          $('#respuesta').show();
        }
      });
    });
  }
</script>

@endpush