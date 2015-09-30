{!! Form::open(['url' => '/show', 'method'=>'get', 'class'=>'form-inline'])!!}
<div class="form-group">
     {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'www.dominio.com','id'=>'url']) !!}
     {!! Form::select('type', ['A'=>'A', 'AAAA'=>'AAAA', 'CNAME'=>'CNAME', 'MX'=>'MX', 'NS'=>'NS', 'PTR'=>'PTR', 'SOA'=>'SOA', 'SRV'=>'SRV', 'TXT'=>'TXT'],null,['class'=>'form-control','id'=>'type']) !!}
     {!! Form::button('Buscar', ['class' => 'btn btn-primary', 'id'=>'buscar']) !!}
</div>
{!! Form::close()!!}<br>
