@extends('layoutg')

@section('body-content')
  {!! Form::model($result,['url' => ['/store',$result], 'method'=>'PUT'])!!}
    @include('dns.contenedores.fields')
  {!! Form::close()!!}
@endsection
