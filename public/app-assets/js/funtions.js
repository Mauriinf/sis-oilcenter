function headCsfr(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}
$(document).ready( function () {
    $(document).on("submit" ,"#formAdd", function(e){
        headCsfr();
        e.preventDefault(e);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
        }).done(function (data) {
            if($.isEmptyObject(data.errors)) {
                console.log(data);
                if(data[0]==='OK'){
                    Swal.fire({
                        type: "success",
                        title: "¡Registrado Correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Ok"

                    });
                    $('#modal-agregar').modal('hide');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data[0]
                    });
                }
                $(".print-error-msg").css('display','none');//ocultar div de errores
            } else {
                printErrorMsg(data,1);
            }
            $('#tdLista').DataTable().ajax.reload();
        });
    });

function printErrorMsg (msg,accion) {
    if(accion==1){
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg.errors, function( key, value ) {//mostrar la lista de errores
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
    else{
        $(".print-error-msg-edit").find("ul").html('');
        $(".print-error-msg-edit").css('display','block');
        $.each( msg.errors, function( key, value ) {//mostrar la lista de errores
            $(".print-error-msg-edit").find("ul").append('<li>'+value+'</li>');
        });
    }
}
    $(document).on("submit" ,"#formDelete", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            cache: false,
            dataType: 'html',
            success:function(html){
                if(html=='1')
                    {
                        Swal.fire({
                            type: "success",
                            title: "¡Eliminado Correctamente!",

                        });
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "No se pudo eliminar el registro"
                        });
                    }
                    $('#modal-eliminar').modal('hide');
                    $('#tdLista').DataTable().ajax.reload();
            }
        });
    });
    $(document).on("submit" ,"#formEdit", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
        }).done(function (data) {
            if($.isEmptyObject(data.errors)) {
                if(data[0]==='OK'){
                    Swal.fire({
                        type: "success",
                        title: "¡Editado Correctamente!"
                    });
                    $('#modal-editar').modal('hide');

                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data[0]
                    });
                }
                $(".print-error-msg-edit").css('display','none');//ocultar div de errores
            } else {
                printErrorMsg(data,2);
            }
            $('#tdLista').DataTable().ajax.reload();
        });
    });

});
