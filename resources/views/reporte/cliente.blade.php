<div class="row">
  <div class="col-md-6">
    <button type="button" class="btn btn btn-gradient-warning w-100" id="btnCliente">
      <span class="d-flex justify-content-between flex-wrap mb-50">
        <span class="fw-bolder">CLIENTES</span>
        <span class="fw-bolder">Reporte</span>
      </span>
      <div class="navbar-container">
        <img src="images/cliente.png" id="avatar-img" width="50">
      </div>
      <small class="d-block">Reporte de frecuencia de clientes en formato PDF.</small>
    </button>
  </div>
  <div class="col-md-6">
    <button type="button" class="btn  btn-gradient-primary w-100" id="btnUsuario">
      <span class="d-flex justify-content-between flex-wrap mb-50">
        <span class="fw-bolder">USUARIOS</span>
        <span class="fw-bolder">Reporte</span>
      </span>
      <div class="navbar-container">
        <img src="images/usuario.png" id="avatar-img" width="50">
      </div>
      <small class="d-block">Reporte de usuarios y roles en formato PDF.</small>
    </button>
  </div>
</div>
@push('scripts-vendor')
<script>

  $('#btnCliente').click(function() {
    pdf_cliente();
  })

  $('#btnUsuario').click(function() {
    pdf_usuario();
  })

  function pdf_cliente(){

    $.ajax({
      url: "{{ route('reporte.cliente') }}",
      type: 'GET',
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
  function pdf_usuario(){

    $.ajax({
      url: "{{ route('reporte.usuario') }}",
      type: 'GET',
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