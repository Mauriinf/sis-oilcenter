let $doctor, $date, $especialidad, $horas;
let iRadio;

const AlertHoraError = `<div class="alert alert-danger" role="alert">
    <div class="alert-body">
    <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el médico en el día seleccionado.
    </div>
</div>`;

$(function () {
  $especialidad = $('#especialidad');
  $doctor = $('#doctor');
  $date = $('#date');
  $horas = $("#horas");
  const especialidadId = $especialidad.val();
    $.ajax({
        type:'GET',
        url:"/especialidades/"+especialidadId+"/doctores",
        data:{ },
        dataType: 'html',
        success:function(html){
            $doctor.html(html);
            cargarHoras();
        }
    });
  $especialidad.change(() => {
    $.ajax({
        type:'GET',
        url:"/especialidades/"+especialidadId+"/doctores",
        data:{ },
        dataType: 'html',
        success:function(html){
            $doctor.html(html);
            cargarHoras();
        }
    });

  });

  $doctor.change(cargarHoras);
  $date.change(cargarHoras);
});
function cargarHoras() {
    $bloque_dia = $('#bloque_dia');
    let id_bloque_dia=$bloque_dia.val();
    $fec_ini = $('#fec_ini');
    let fec_ini=$fec_ini.val();
    $fec_fin = $('#fec_fin');
    let fec_fin=$fec_fin.val();
    $cit_fech = $('#cit_fech');
    let cit_fech=$cit_fech.val();
	const selectedDate = $date.val();
	const doctorId = $doctor.val();
    $.ajax({
        type:'GET',
        url:`/calendario/horas?date=${selectedDate}&doctor_id=${doctorId}`,
        dataType: 'json',
        success:function(data){
            if (data.errors) {
                let html = '<div class="alert alert-danger" role="alert"><div class="alert-body"><ul>';
                $.each( data.errors, function( key, value ) {//mostrar la lista de errores
                    html+='<li>'+value+'</li>';
                });
                html+='</ul></div></div>';
                $("#horas").html(html);
            } else {
                if(data.NoHoras){
                    $("#horas").html(AlertHoraError);
                }else{
                    let html = '';
                    iRadio=0;
                    let manana=[];
                    let tarde=[];
                    let noche=[];
                    //bloque seleccionado
                    var todayDate = new Date().toISOString().slice(0, 10);

                    if(selectedDate===cit_fech){
                        const ini = new Date(todayDate+' ' + fec_ini);
                        const primer_tur = new Date(todayDate+' ' + '12:00');
                        const segundo_tur = new Date(todayDate+' ' + '18:00');
                        let ini_fin=new Map();
                        ini_fin['id_dia_bloque'] = id_bloque_dia;
                        ini_fin['inicio'] = fec_ini;
                        ini_fin['fin'] = fec_fin;
                        if(ini<primer_tur){
                            manana.push(ini_fin);
                        }else{
                            if(ini<segundo_tur){
                                tarde.push(ini_fin);
                            }else{
                                noche.push(ini_fin);
                            }
                        }
                    }
                    //fin bloque seleccionado
                    $.each( data.OK, function( key, value ) {
                        todayDate = new Date().toISOString().slice(0, 10);
                        const inicio = new Date(todayDate+' ' + value.inicio);
                        const primer_turno = new Date(todayDate+' ' + '12:00');
                        const segundo_turno = new Date(todayDate+' ' + '18:00');
                        ini_fin=new Map();
                        ini_fin['id_dia_bloque'] = value.id_bloque_dia;
                        ini_fin['inicio'] = value.inicio;
                        ini_fin['fin'] = value.fin;
                        if(inicio<primer_turno){
                            manana.push(ini_fin);
                        }else{
                            if(inicio<segundo_turno){
                                tarde.push(ini_fin);
                            }else{
                                noche.push(ini_fin);
                            }
                        }
                    });
                    html+=`<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="mb-1">
                            <label for="address">Mañana</label>`;
                    $.each( manana, function( key, value ) {
                        if(selectedDate===cit_fech && id_bloque_dia===value.id_dia_bloque){
                            html+=`<div class="input-group">
                                        <div class="input-group-text">
                                            <div class="form-check">
                                                <input type="radio" value="${value.id_dia_bloque}" class="form-check-input" name="id_bloque" id="interval${iRadio}" onclick="asignar_valor('${value.inicio}')" checked />
                                                <label class="form-check-label" for="interval${iRadio++}">${value.inicio} - ${value.fin}</label>
                                            </div>
                                        </div>
                                    </div>`;
                            iRadio++;
                        }else{
                            html+=`<div class="input-group">
                                        <div class="input-group-text">
                                            <div class="form-check">
                                                <input type="radio" value="${value.id_dia_bloque}" class="form-check-input" name="id_bloque" id="interval${iRadio}" onclick="asignar_valor('${value.inicio}')" />
                                                <label class="form-check-label" for="interval${iRadio++}">${value.inicio} - ${value.fin}</label>
                                            </div>
                                        </div>
                                    </div>`;
                            iRadio++;
                        }
                    });
                    html+=`</div></div>`;
                    html+=`<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="mb-1">
                            <label for="address">Tarde</label>`;
                    $.each( tarde, function( key, value ) {
                        if(selectedDate===cit_fech && id_bloque_dia===value.id_dia_bloque){
                            html+=`<div class="input-group">
                                        <div class="input-group-text">
                                            <div class="form-check">
                                                <input type="radio" value="${value.id_dia_bloque}" class="form-check-input" name="id_bloque" id="interval${iRadio}" onclick="asignar_valor('${value.inicio}')" checked/>
                                                <label class="form-check-label" for="interval${iRadio++}">${value.inicio} - ${value.fin}</label>
                                            </div>
                                        </div>
                                    </div>`;
                            iRadio++;
                        }else{
                            html+=`<div class="input-group">
                                        <div class="input-group-text">
                                            <div class="form-check">
                                                <input type="radio" value="${value.id_dia_bloque}" class="form-check-input" name="id_bloque" id="interval${iRadio}" onclick="asignar_valor('${value.inicio}')" />
                                                <label class="form-check-label" for="interval${iRadio++}">${value.inicio} - ${value.fin}</label>
                                            </div>
                                        </div>
                                    </div>`;
                            iRadio++;
                        }
                    });
                    html+=`</div></div> `;
                    html+=`<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="mb-1">
                            <label for="address">Noche</label>`;
                    $.each( noche, function( key, value ) {
                        if(selectedDate===cit_fech && id_bloque_dia===value.id_dia_bloque){
                            html+=`<div class="input-group">
                                        <div class="input-group-text">
                                            <div class="form-check">
                                                <input type="radio" value="${value.id_dia_bloque}" class="form-check-input" name="id_bloque" id="interval${iRadio}" onclick="asignar_valor('${value.inicio}')" checked />
                                                <label class="form-check-label" for="interval${iRadio++}">${value.inicio} - ${value.fin}</label>
                                            </div>
                                        </div>
                                    </div>`;
                            iRadio++;
                        }else{
                            html+=`<div class="input-group">
                                        <div class="input-group-text">
                                            <div class="form-check">
                                                <input type="radio" value="${value.id_dia_bloque}" class="form-check-input" name="id_bloque" id="interval${iRadio}" onclick="asignar_valor('${value.inicio}')" />
                                                <label class="form-check-label" for="interval${iRadio++}">${value.inicio} - ${value.fin}</label>
                                            </div>
                                        </div>
                                    </div>`;
                            iRadio++;
                        }
                    });
                    html+=`</div></div>`;
                    $("#horas").html(html);
                }
            }
        }
    });
}
function asignar_valor(hora){
    document.getElementById("hora").value =hora;
}
