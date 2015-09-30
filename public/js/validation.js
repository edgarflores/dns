$(document).ready(function(){
  $('#buscar').unbind('click').bind('click', function(e){
    // console.log('estamos aqui');
    var domain=$('#url').val();
    var lst=$('#type').val();
    var img = '<img src="/img/loading.gif">';


    if(domain){
      console.log(domain+' '+lst);
      $('#buscar').prop('disabled',true);

      $(document).ajaxStart(function(){
          $('.loading').html(img).show();
       }).ajaxStop(function(){
          $('.loading').html(img).hide();
       });

      $.ajax({
        url   : '/show',
        type  : 'GET',
        data  : {
            'url' : domain,
            'type': lst
        },

        success:function(data){
            // console.log(data);
            var res =jQuery.parseJSON(data);
            console.log(res.result);

            var res1="";
            jQuery.each(res.result, function(i, val) {
                res1 += val + "<br/>";
            });
            $('#res1').html(res1);

            var res2="";
            jQuery.each(res.result2, function(i, val) {
                res2 += val + "<br/>";
            });
            $('#res2').html(res2);

            var res3="";
            jQuery.each(res.result3, function(i, val) {
                res3 += val + "<br/>";
            });
            $('#res3').html(res3);

            var res4="";
            jQuery.each(res.result4, function(i, val) {
                res4 += val + "<br/>";
            });
            $('#res4').html(res4);

            var res5="";
            jQuery.each(res.result5, function(i, val) {
                res5 += val + "<br/>";
            });
            $('#res5').html(res5);

            var res6="";
            jQuery.each(res.result6, function(i, val) {
                res6 += val + "<br/>";
            });
            $('#res6').html(res6);

            var res7="";
            jQuery.each(res.result7, function(i, val) {
                res7 += val + "<br/>";
            });
            $('#res7').html(res7);

            $('#buscar').prop('disabled',false);
        },

        error:function(){
            alert("Error al recibir la data");
        }

      });
    }
  });

});
