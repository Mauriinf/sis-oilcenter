function init(){
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    const form_bpaciente = document.getElementById('form-bpaciente');
    form_bpaciente.addEventListener('submit', buscar, false);
}

function buscar(e){
	e.preventDefault();

    const container = document.getElementById('modal_buscar_paciente');
    const myModal = new bootstrap.Modal(container);


    let ci = e.target.elements['ci'].value;

    let url = `/curaciones/buscar-paciente/${ci}`;

    let nombres = document.getElementById('nombres');
    let paterno = document.getElementById('paterno');
    let materno = document.getElementById('materno');
    let paciente = document.getElementById('paciente');

    $.ajax({
        url: url,
        type: 'get',
        data: {},
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            nombres.value = data.nombres;
            paterno.value = data.paterno;
            materno.value = data.materno;
            paciente.value = data.id;
            myModal.hide();
        }
    });
}


$( document ).ready(function() {
    init();
});

