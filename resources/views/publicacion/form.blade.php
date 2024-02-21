@extends('vuexy.layouts.default', ['activePage' => 'publicacion'])
@section('title','Nuevo Publicacion')
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
          {!! Form::open(['route' => isset($publicacion) ? ['publicacion.update', $publicacion->id] : 'publicacion.store', 'method' => isset($publicacion) ? 'PUT' : 'POST', 'enctype' => 'multipart/form-data']) !!}
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Publicaciones</h4>
            </div>
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                      <label for="titulo" class="form-label">Titulo:</label>
                      <input type="text" name="titulo" class="form-control @if($errors->has('titulo')) border border-danger @endif" placeholder="Titulo" value="{{ isset($publicacion) ? $publicacion->titulo : old('titulo') }}">
                      @error('titulo') <span class="text-danger">* {{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="estado" class="form-label">Estado:</label>
                      <select class="form-select @if($errors->has('estado')) border border-danger @endif" name="estado" id="estado">
                        <option value="Activo">Activo</option>   
                        <option value="Inactivo">Inactivo</option>   
                      </select>
                    </div>
                    <div class="mb-3">
                      <a href="#" class="me-25">
                        <img src="{{ isset($publicacion) ? asset('imagenes/publicacion/' . $publicacion->imagen) : asset('images/product.png') }}" id="avatar-img" class="uploadedAvatar rounded mx-75" alt="profile image" height="130" width="130"/>
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
            <div class="card-footer">
              <div class="form-group ">
                <a class="btn btn-secondary float-md-start" href="javascript:history.back(-1);" title="Ir la página anterior" class="fa fa-hand-o-left">Volver</a>
                <button type="submit" class="btn btn-success float-md-end {{ isset($publicacion) ? 'btn-warning': ''}}">
                  <span>
                    <i data-feather='save'></i>
                    {{ isset($publicacion) ? 'Actualizar' : 'Guardar' }}
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
</script>
@endpush