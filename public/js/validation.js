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
          url   : '/net',
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

        });//fin ajax
      }//fin if
  });

  $('.btn-delete').click(function(e){

          e.preventDefault();

          var row=$(this).parents('tr');
          var id = row.data('id');
          var nombrecompany = row.data('nombre');
          var form = $('#form-delete');
          var url = form.attr('action').replace('id',id);
          var data = form.serialize();

          bootbox.dialog({
            message: "Esta seguro que deseas eliminar el registro "+ nombrecompany +"?",
            title: "Confirmación de Eliminacion",
            buttons: {
              success: {
                label: "Aceptar",
                className: "btn-primary",
                callback: function() {
                  row.fadeOut();
                  // console.log(url+' '+data);
                  $.post(url,data, function(result){
                    //  console.log(result);
                    $('.message').html('<p class="alert alert-success">'+result+'</p>').fadeIn().fadeOut(2000, function(){});
                  });
                }
              },
              dismiss: {
                label: "Cancelar",
                className: "btn-primary",
                callback: function() {

                }
              },
            }
          });
  });


  $('#buscar2').unbind('click').bind('click', function(e){

    var domain=$('#url').val();
    var lst=$('#type').val();
    var _token = $('#_token').attr('value');
    var img = '<img src="/img/loading.gif">';
    var iconok = '<span class="glyphicon glyphicon-ok"></span>';
    var iconremove = '<span class="glyphicon glyphicon-remove"></span>';

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
            url   : '/findip',
            type  : 'get',
            data  : {
                '_token'  : _token
            },

            success:function(data){

                var res =jQuery.parseJSON(data);
                //  console.log(res);
                 $.each(res, function(i,val){
                  //  console.log(val);

                   $.ajax({
                     url   : '/findresult',
                     type  : 'get',
                     data  : {
                        'ip'  : val,
                        'id'  : i,
                        'url' : domain,
                        'type': lst
                     },

                     success:function(data){
              // console.log(data);
                       var res2 =jQuery.parseJSON(data);
                      //  console.log(res2);
                      var result='';
                       $.each(res2, function(i2, val2){
                         console.log(val2);
                          if(val2 !== ''){
                         $.each(val2, function(i3, val3){
                              result += val3 + "<br/>";
                              $('.loading').html(img).hide();
                              $("#"+i2).html(result);
                              $('#status'+i).html(iconok);
                         })
                       }
                            // }else{
                            //   $('#msg'+i2).html('No se encontraron registros');
                            //   $('#status'+i2).html(iconremove);
                            // }
                       });
                     },

                     error:function(){
                       console.log('error');
                     }

                   });//fin ajax dentro


                 });


            },

            error:function(){
                alert("Error al recibir la data");
            }

          });//fin ajax
        }//fin if

  });

});
