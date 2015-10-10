<div class="panel panel-default">
  <div class="panel-heading">Crear DNS publico</div>
  <div class="panel-body">

        <div class="form-group">
          {!! Form::label('company', 'Proveedor del Serv. DNS') !!}
          {!! Form::text('company', null, ['class'=>'form-control','placeholder' => 'Ej: Google, Antel, ...']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('ip', 'Ip') !!}
          {!! Form::text('ip', null, ['class' => 'form-control', 'placeholder' => 'Ej: 0.0.0.0']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('country', 'Estado / Pais') !!}
          {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Ej: Montevideo / Uruguay']) !!}
        </div>


    <div class="row">
      <div class="col-md-4">
        {!! Form::submit('Guardar',['class' => 'btn btn-primary'])!!}
        <a class="btn btn-primary" href="{{ url('/adm') }}" role="button">Regresar</a>&nbsp;
      </div>
      <div class="col-md-4">
        <div class="message"></div>
      </div>
    </div>
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" id='_token'/>
  </div>
</div>
