$(document).ready(function(){

  $('#buscar').unbind('click').bind('click', function(e){

    var domain=$('#url').val();
    var lst=$('#type').val();
    var _token = $('#_token').attr('value');
    var img = '<img src="/img/loading.gif">';

    if(domain){
    $(document).ajaxStart(function(){
        $('.result').html('');
        $('.status').html('');
        $('.msg').html('');
        $('.loading').html(img).show();
        $('#buscar').prop('disabled',true);
        $('.status').html('<span class="glyphicon glyphicon-record"></span>');
     }).ajaxStop(function(){
        $('.loading').html(img).hide();
        $('#buscar').prop('disabled',false);
     });

      $.ajax({
        url   : '/search',
        type  : 'POST',
        data  : {
            'url'     : domain,
            'type'    : lst,
            '_token'  : _token
        },

        success:function(data){
            var res =jQuery.parseJSON(data);
            // console.log(res);
            var result='';
            var icon='';
            $.each(res, function(i, val){
              if(val.length !== 0){
                $.each(val, function(i2, val2){
                  result += val2 + "<br/>";
                  icon = '<span class="glyphicon glyphicon-ok"></span>';

                  $("#"+i).html(result);
                  $('#status'+i).html(icon);
                });
                  result='';
              }else{
                icon = '<span class="glyphicon glyphicon-remove"></span>';
                $('#msg'+i).html('No se encontraron registros');
                $('#status'+i).html(icon);
              }
            });
        },

        error:function(){
            alert("Error al recibir la data");
        }

      });
    }//fin if
  });



});
