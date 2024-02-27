@extends('vuexy.layouts.default', ['activePage' => 'reporte'])
@section('title','Reportes')
@section('content')
<div class="content-wrapper p-0">
  <div class="content-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Parametros de reporte</h4>
          </div>
          <div class="navbar-container">
            <div class="row custom-options-checkable g-1">
              <div class="col-md-4">
                <div class="mb-1">
                  <input class="custom-option-item-check" type="radio" name="type" id="type_in">
                  <label class="custom-option-item p-1" for="type_in">
                    <span class="d-flex justify-content-between flex-wrap mb-50">
                      <span class="fw-bolder">INGRESOS</span>
                      <span class="fw-bolder"><i data-feather="box"></i></span>
                    </span>
                  </label>
                </div>
                <div class="mb-1">
                  <input class="custom-option-item-check" type="radio" name="type" id="type_ve">
                  <label class="custom-option-item p-1" for="type_ve">
                    <span class="d-flex justify-content-between flex-wrap mb-50">
                      <span class="fw-bolder">VENTAS</span>
                      <span class="fw-bolder"><i data-feather="shopping-cart"></i></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="mb-1">
                  <select class="form-select" size="6" id="articulo" name="articulo[]" multiple="multiple">
                    @foreach($articulo as $art)
                    <option value="{{$art->id}}">{{$art->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="divider">
            <div class="divider-text">Rango de fechas</div>
          </div>
          <div class="navbar-container">
            <div class="row">
              <div class="col-md-6 mb-1">
                <label class="form-label">Fecha inicial:</label>
                <input type="text" id="fecha_i" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
              </div>
              <div class="col-md-6 mb-1">
                <label class="form-label">Fecha inicial:</label>
                <input type="text" id="fecha_f" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly">
              </div>
            </div>
          </div>
          <div class="card-footer ms-auto">
            <div class="btn-group">
              <button type="button" class="btn btn-warning btn-sm" id="btnPdf">
                <span><i data-feather="file-pdf"></i>Abrir PDF</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        @include('reporte.cliente')
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts-vendor')
<script>
  var url = null;
  $('#btnPdf').click(function() {
    pdf();
  })

  function validate(fecha_i, fecha_f) {

    if (fecha_i > fecha_f) {
      alert('La fecha inicial no puede ser mayor a la fecha final');
    }
    return;
  }

  function pdf(event){

    var fecha_i = $('#fecha_i').val();
    var fecha_f = $('#fecha_f').val();
    var articulo = JSON.stringify($('#articulo').val());
    

    if (validate(fecha_i, fecha_f)) {
      event.preventDefault()
    }

    if ($('#type_in').prop('checked')) {
      url = "{{ route('reporte.ingreso') }}";
    }else if($('#type_ve').prop('checked')){
      url = "{{ route('reporte.venta') }}";
    }

    if (url != null) {
      peticion(url, fecha_i, fecha_f, articulo);
    }else{
      alert('Debe seleccionar tipo de reporte de INGRESO o VENTA');
    }
  }
  function peticion(url, fecha_i, fecha_f, articulo = []) {
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        articulo: articulo,
        dato_i: fecha_i,
        dato_f: fecha_f
      },
      xhrFields: {
        responseType: 'blob'
      },
      success: function(response) {
        const url = URL.createObjectURL(response);
        window.open(url, '_blank');
      },
      error: function(err) {
        console.log(err);
      }
    });
  }
</script>
@endpush