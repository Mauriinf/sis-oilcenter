@extends('vuexy.layouts.default', ['activePage' => 'articulo'])
@section('title','Nuevo Usuario')
@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-body">
    <section id="basic-input">
      <div class="row">
        <div class="col-md-12">
          <div>
            <div class="alert alert-success p-2" id="respuesta" style="display: none;">
              <p></p>
            </div>
          </div>
          {!! Form::open(['route' => isset($articulo) ? ['articulo.update', $articulo->id] : 'articulo.store', 'method' => isset($articulo) ? 'PUT' : 'POST', 'enctype' => 'multipart/form-data']) !!}
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Articulos</h4>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                <div class="row mb-3">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Código</label>
                      <input type="text" name="codigo" class="form-control @if($errors->has('codigo')) border border-danger @endif" value="{{ isset($articulo) ? $articulo->codigo : old('codigo') }}" placeholder="....">
                      @error('codigo') <span class="text-danger">* {{ $message }}</span> @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-4">                        
                          <label>Categoria:</label>
                        <div class="input-group" id="selectCont">
                          <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addArticulo">
                            <i data-feather='plus'></i>
                          </button>
                          <select class="form-select @if($errors->has('categoria')) border border-danger @endif" name="categoria" id="categoria">
                            <option value="0">Seleccione...</option>
                            @foreach ($categoria as $cat)
                            <option value="{{ $cat->id }}" {{ (isset($articulo) && $articulo->id_categoria == $cat->id) || old('categoria') == $cat->id ? 'selected' : '' }}>
                              {{ $cat->nombre }}
                            </option>
                            @endforeach         
                          </select>
                          @error('categoria') <span class="text-danger">* {{ $message }}</span> @enderror
                        </div>
                      </div>
                      <div class="col-md-6 mb-2">
                        <div class="form-group">
                          <label>Nombre:</label>
                          <input type="text" name="nombre" class="form-control @if($errors->has('nombre')) border border-danger @endif" placeholder="..." value="{{ isset($articulo) ? $articulo->nombre : old('nombre') }}">
                          @error('nombre') <span class="text-danger">* {{ $message }}</span> @enderror
                        </div>
                      </div>
                      <div class="col-md-2 mb-2">
                        <div class="form-group">
                          <label>Stock:</label>
                          <input type="text" name="stock" class="form-control" value="{{ isset($articulo) ? $articulo->stock : old('stock', 0) }}" readonly>
                        </div>
                      </div>
                      <div class="col-md-12 mb-2">
                        <div class="form-group">
                          <label>Detalle:</label>
                          <textarea class="form-control" name="descripcion" placeholder="...">{{isset($articulo) ? $articulo->descripcion : old('descripcion') }}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div>
                      <a href="#" class="me-25">
                        <img src="{{ isset($articulo) ? asset('imagenes/articulo/' . $articulo->imagen) : asset('images/product.png') }}" id="avatar-img" class="uploadedAvatar rounded mx-75" alt="profile image" height="130" width="130"/>
                      </a>
                      <!-- upload and reset button -->
                      <div class="d-flex align-items-end mt-75">
                        <div>
                          <label for="avatar" class="btn btn-sm btn-primary mb-75 me-75">Subir</label>
                          <input type="file" id="avatar" name="avatar" hidden accept="image/*" accept="png, jpg" />
                          <button type="button" id="avatar-reset" class="btn btn-sm btn-outline-secondary mb-75">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="form-group ">
                <a class="btn btn-secondary float-md-start" href="javascript:history.back(-1);" title="Ir la página anterior" class="fa fa-hand-o-left">Volver</a>
                <button type="submit" class="btn btn-success float-md-end {{ isset($articulo) ? 'btn-warning': ''}}">
                  <span>
                    <i data-feather='save'></i>
                    {{ isset($articulo) ? 'Actualizar' : 'Guardar' }}
                  </span>
                </button>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      <div class="modal fade" id="addArticulo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="Btnclose"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
              <h1 class="text-center mb-1" id="addNewCardTitle">Categoria</h1>
              <p class="text-center">Crear nueva Categoria</p>
              {!! Form::open(['id' => 'FormCategoria']) !!}
                <div class="col-md-12">
                  <label class="form-label" for="modalAddCardName">Nombre:</label>
                  <input type="text" name="nombreC" class="form-control" placeholder="..." />
                  <span class="text-danger" id="errorNombre"></span>
                </div>
                <div class="col-md-12 col-md-3">
                  <label class="form-label" for="modalAddCardExpiryDate">Descripción</label>
                  <textarea class="form-control" name="descripcionC" placeholder="..."></textarea>
                  <span class="text-danger" id="errorDescripcion"></span>
                </div>
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success me-1 mt-1">Guardar</button>
                  <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                    Cancelar
                  </button>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@push('scripts-vendor')
<script>
  $(document).ready( function () {
      const $seleccionArchivos = document.querySelector("#avatar"),
      $imagenPrevisualizacion = document.querySelector("#avatar-img");

      // Escuchar cuando cambie
      $seleccionArchivos.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const archivos = $seleccionArchivos.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!archivos || !archivos.length) {
          $imagenPrevisualizacion.src = "";
          return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const primerArchivo = archivos[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(primerArchivo);
      // Y a la fuente de la imagen le ponemos el objectURL
      $imagenPrevisualizacion.src = objectURL;
      });
  });
  $(document).ready(function(){
    $('#FormCategoria').submit(function(event){
      event.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        url: "{{ route('categoria.store') }}",
        type: "POST",
        data: formData,
        success: function(response){
          $('#resultado').html(response);
          console.log("Petición exitosa:", response);
          $('#respuesta p').text(response.success);
          $('#respuesta').show();
          $('#addArticulo').modal('hide');
          listar(response.categoria);
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
    });
  });
  function listar(categoria){
    $('#categoria').empty();
    $('#categoria').append('<option>Seleccione...</option>');
    $.each(categoria, function(index, cat){
      $('#categoria').append('<option value="' + cat.id + '">' + cat.nombre + '</option>');
    });
  }
</script>
@endpush