function init(){
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

  $('.bloque').click($(this), seleccionar);
}

function seleccionar(bloque){
    let bdia = parseInt(bloque.target.dataset.bd);
    
    $.ajax({
        url: `/bloque-dia/config-agenda/${bdia}`,
        type: 'GET',
        data: {},
        contentType: false,
        processData: false,
  
        success: function(data)
        {
            if(data == 'ACTIVO')
                bloque.target.classList.add('bg-success', 'text-light');
            else
                bloque.target.classList.remove('bg-success', 'text-light');
        }
      });
}

init();
