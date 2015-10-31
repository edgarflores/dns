$(document).ready(function(){

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

                  $.post(url,data, function(result){

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


  $('#buscar').unbind('click').bind('click', function(e){

    var domain=$('#url').val();
    var lst=$('#type').val();
    var _token = $('#_token').attr('value');
    var img = '<img src="/img/loading.gif">';
    var iconok = '<span class="glyphicon glyphicon-ok" style="color: #41ad74"></span>';
    var iconremove = '<span class="glyphicon glyphicon-remove" style="color: #d93217"></span>';
    var form = $('#form-getip');
    var urlip = form.attr('action');
    var methodip = form.attr('method');
    var formr = $('#form-getresult');
    var urlr = formr.attr('action');
    var methodr = form.attr('method');


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
            url   : urlip,
            type  : methodip,
            data  : {
                '_token'  : _token
            },

            success:function(data){

                var res =jQuery.parseJSON(data);
                 $.each(res, function(i,val){

                   $.ajax({
                     url   : urlr,
                     type  : methodr,
                     data  : {
                        'ip'  : val,
                        'id'  : i,
                        'url' : domain,
                        'type': lst
                     },

                     success:function(data){

                      var res2 =jQuery.parseJSON(data);
                      var result='';
                       $.each(res2, function(i2, val2){
                          if(val2.length !== 0){
                             $.each(val2, function(i3, val3){
                                  result += val3 + "<br/>";
                                  $("#"+i2).html(result);
                                  $('#status'+i).html(iconok);
                                  $(".marcador"+i2).attr({'fill':'#41ad74'});
                             })
                          }else{
                            $('#msg'+i2).html('No se encontraron registros');
                            $('#status'+i2).html(iconremove);
                          }
                        $('#loading'+i2).html(img).hide();
                       });
                     },

                     error:function(){
                       console.log('Error obteniendo datos');
                     }

                   });


                 });


            },

            error:function(){
                console.log("Error al recibir la data");
            }

          });
        }

  });

  var formmk =  $('#form-getmarker');
  var url = formmk.attr('action');
  var methodmk = formmk.attr('method');
  var latLng='latLng: ';

  $.ajax({
    url   : url,
    type  : methodmk,
    data  : ' ',

    success:function(data){

      var marcadores = jQuery.parseJSON(data);
      var markers=[];

      $.each(marcadores, function(imar, vmar){
          var pointall={};
          var point=[];

          point.push(vmar.coordx);
          point.push(vmar.coordy);
          pointall.name=vmar.company;
          pointall.latLng=point;
          markers.push(pointall);
        }),

      $('#world-map').vectorMap({
        map: 'world_mill',
        scaleColors: ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        markerStyle: {
          initial: {
            fill: '#F8E23B',
            stroke: '#383f47'
          }
        },
        backgroundColor: '#323f59',
         markers:markers,
        });
    },

    error:function(){
      console.log('no trajo datos');
    }

  });


});
