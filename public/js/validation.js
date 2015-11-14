$(document).ready(function(){

  $('form').bind("keypress", function(e) {
    if (e.keyCode == 13) {
      e.preventDefault();
      return false;
    }
  });

  var d='';
  var lst='';
  var h = window.location.hash.substr(1);

  if(h){
    var ah = h.toString().split('/');
    $('#url').val(ah[1]);
    $('#type').val(ah[0]);
    frmaction();
  }

var main = $('#main');
var loc = [];
var pos = {};

var formmk =  $('#form-getmarker');
var url = formmk.attr('action');
var methodmk = formmk.attr('method');
var latLng='latLng: ';

    main.find('tr').each(function(i, mark) {
        loc.push({
            id: $(mark).data('id'),
            latitude: $(mark).data('coordx'),
            longitude: $(mark).data('coordy'),
            location: $(mark).data('location'),
            provider: $(mark).data('company'),
            result: $(mark).find('div.result'),
            status: $(mark).find('div.status')
        });
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

$('#buscar').unbind('click').bind('click',frmaction);

function frmaction(){

     d=$('#url').val().replace(/.*?:\/\//g, "");
      d = d.replace(/\/(.*)/,"");
      $('#url').val(d);

    lst=$('#type').val();
    var partition = lst+'/'+d;
      window.location.hash = partition;
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


    if(d){
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
                        'ip'  : val.ip,
                        'id'  : val.id,
                        'url' : d,
                        'type': lst
                     },
                     dataType: 'html',

                     success:function(data){
                      var res2 =jQuery.parseJSON(data);
                      var result='';

                       $.each(res2, function(i2, val2){
                            if(val2.length!=0 && val2!='error'){
                             $.each(val2, function(i3, val3){
                                  result += val3 + "<br/>";
                                  $("#"+i2).html(result);
                                  $('#status'+i2).html(iconok);
                                  pos.markers[val.count].element.config.style.initial.image = '/img/ok.svg';
                             })
                            }else{
                              $('#msg'+i2).html('record not found.');
                              $('#status'+i2).html(iconremove);
                              pos.markers[val.count].element.config.style.initial.image = '/img/remove.svg';
                            }
                            pos.reset();
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
}

  $.ajax({
    url   : url,
    type  : methodmk,
    data  : ' ',

    success:function(data){

      var marcadores = jQuery.parseJSON(data);
      var marcador=[];

      $.each(marcadores, function(imar, vmar){
          var pointall={};
          var point=[];

          point.push(vmar.coordx);
          point.push(vmar.coordy);
          pointall.name=vmar.company;
          pointall.latLng=point;
          marcador.push(pointall);
        }),

        $('#world-map').vectorMap({
              map: 'world_mill',
              scaleColors: ['#C8EEFF', '#0071A4'],
              normalizeFunction: 'polynomial',
              hoverOpacity: 0.7,
              hoverColor: false,
              regionStyle: {
                    initial: {
                        fill: "#eee",
                        stroke: "gray",
                        "stroke-width": 0.5,
                        "stroke-opacity": 0.7
                    },
                    hover: {
                        "fill-opacity": 1,
                        cursor: "default"
                    }
                },
                markerStyle: {
                    initial: {
                        fill: "#FFBF00",
                        stroke: "#000000",
                        "stroke-width": 0.5
                    },
                    hover: {
                        "stroke-width": 1.25
                    }
                },
                onMarkerTipShow: function(event, tip, code) {
                    var html = '<div class="location"><i class="flag flag-'+loc[code].countryCode+'"></i> '+loc[code].location+'</div>';
                    html += '<div class="provider">'+loc[code].provider+'</div>';
                    if (loc[code].result.text()) {
                        html += '<div class="result">'+loc[code].result.html()+'</div>';
                    }
                    tip.html(html);
                },
                onRegionTipShow: function(event, tip, code) {
                    event.preventDefault();
                }
            });

            pos = $("#world-map").vectorMap('get', 'mapObject');

            $.each(loc, function(i, server) {
                pos.addMarker(i, {
                    latLng: [server.latitude, server.longitude]
                });
            });
    },

    error:function(){
      console.log('no trajo datos');
    }

  });

});
