@extends('layoutg')

@section('body-content')
  {!! Form::open(['url' => '/store', 'method'=>'POST'])!!}
    @include('dns.contenedores.fields')
  {!! Form::close()!!}
@endsection
