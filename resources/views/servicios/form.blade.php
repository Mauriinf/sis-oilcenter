@extends('vuexy.layouts.default', ['activePage' => 'servicios'])
@section('title','Nuevo Servicio')
@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-body">
    <section id="basic-input">
      <div class="row">
        <div class="col-md-12">
          {!! Form::open(array('route' => isset($servicio) ? ['servicio.update', $servicio->id] : 'servicio.store', 'method' => isset($servicio) ? 'PUT' : 'POST', 'id' => 'formulario')) !!}
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Servicio</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label>Cliente:</label>
                        <select class="form-select @if($errors->has('cliente')) border border-danger @endif" name="cliente" id="cliente">
                          <option>Seleccione...</option>
                          @foreach ($clientes as $client)
                          <option value="{{ $client->id}}" {{ (isset($servicio) && $servicio->id_cliente == $client->id) || old('cliente') == $client->id ? 'selected' : '' }}>
                            {{ $client->nombres .' ' . $client->paterno .' ' . $client->materno }}
                          </option>
                          @endforeach
                        </select>
                        @error('cliente') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label>Tipos de Servicio:</label>
                        <select multiple="multiple" class="form-control select2  @if($errors->has('tipos')) border border-danger @endif" name="tipos[]" id="tipos">
                          @foreach ($tiposervicio as $item)
                          <option value="{{ $item->id }}">
                            {{ $item->nombre }}
                          </option>
                          @endforeach
                        </select>
                        @error('tipos') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" name="precio" id="precio" class="form-control @if($errors->has('precio')) border border-danger @endif" placeholder="0.0" value="{{ old('precio') }}">
                        @error('precio') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                          <label>Kilometraje Actual:</label>
                          <input type="number" name="km_actual" id="km_actual" class="form-control @if($errors->has('km_actual')) border border-danger @endif" value="{{ old('km_actual') }}" >
                          @error('km_actual') <span class="text-danger">* {{ $message }}</span> @enderror
                        </div>
                      </div>
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label>Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-2">
                      <div class="form-group">
                        <label>Fecha poxima revisión:</label>
                        <input type="datetime-local" name="fecha" id="fecha" class="form-control @if($errors->has('fecha')) border border-danger @endif" value="{{ old('fecha') }}" >
                        @error('fecha') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <div class="form-group">
                          <label>Adicionar kilometraje:</label>
                          <input type="number" name="adicionar" id="adicionar" class="form-control " value="{{ old('adicionar') }}" placeholder="1">
                        </div>
                      </div>
                    <div class="col-md-2 mb-2">
                      <div class="form-group">
                        <label>Proximo kilometraje:</label>
                        <input type="number" name="km" id="km" class="form-control @if($errors->has('km')) border border-danger @endif" value="0" value="{{ old('km') }}" >
                        @error('km') <span class="text-danger">* {{ $message }}</span> @enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                          <label>Descripción proxima:</label>
                          <textarea name="descripcion_prox" id="descripcion_prox" class="form-control">{{ old('descripcion_prox') }}</textarea>
                          @error('descripcion_prox') <span class="text-danger">* {{ $message }}</span> @enderror
                        </div>
                      </div>
                  </div>
                  <div>
                    <button type="submit" id="enviar" class="btn btn-success float-md-end {{ isset($servicio) ? 'btn-warning': ''}}">
                        <span>
                          <i data-feather='save'></i>
                          {{ isset($servicio) ? 'Actualizar' : 'Guardar' }}
                        </span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group ">
              <a class="btn btn-secondary float-md-start" href="javascript:history.back(-1);" title="Ir la página anterior" class="fa fa-hand-o-left">Volver</a>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
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

<script>
$('#adicionar').on('input', calcularKilometraje);

function calcularKilometraje() {
  var km_actual = parseFloat($('#km_actual').val()) || 0;
  var adicionar = parseFloat($('#adicionar').val()) || 0;
  var suma = km_actual+adicionar;
  $('#km').val(suma);
}
</script>
@endpush

