@extends('layoutg')

@section('body-content')
	<p class="message"></p>
			<div class="panel panel-default">
				<div class="panel-heading">Listado de DNS's publicos <a href='/create' class="navbar-right"> <span class="glyphicon glyphicon-plus-sign"></span></a></div>
				<div class="panel-body">
					<table class="table table-hover">
					  <thead class="text-center">
            <tr>
              <td><strong>#</strong></td>
              <td><strong>Proveedor de Serv. DNS</strong></td>
              <td><strong>Ip</strong></td>
              <td><strong>Estado / Pais</strong></td>
							<td><strong>Opciones</strong></td>
					  </tr>
					  </thead>
            <tbody>
              @foreach($dnslist as $dnslst)
							<tr data-id='{{$dnslst->id}}' data-nombre='{{$dnslst->company}}'>
                <td>{{$dnslst->id}}</td>
                <td>{{$dnslst->company}}</td>
                <td>{{$dnslst->ip}}</td>
                <td>{{$dnslst->country}}</td>
								<td class="text-center">
										<a href="{{ url('/edit',$dnslst) }}" ><span class="glyphicon glyphicon-edit" aria-hidden="true" title="Editar"></a>
										<a href="#!" class="btn-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true" title="Eliminar" style="color: #d93217"></a>
								</td>
              </tr>
              @endforeach
            </tbody>
					</table>
				</div>
			</div>
			{!! Form::open(['url' => ['/destroy','id'], 'method'=>'DELETE', 'id'=>'form-delete']) !!}
			{!! Form::close() !!}
@stop
