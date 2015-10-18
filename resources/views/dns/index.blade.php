@extends('layout')

@section('content')
  @include('dns.contenedores.table')

  {!! Form::open(['url' => ['/getip'], 'method'=>'GET', 'id'=>'form-getip']) !!}
  {!! Form::close() !!}

  {!! Form::open(['url' => ['/getresult'], 'method'=>'GET', 'id'=>'form-getresult']) !!}
  {!! Form::close() !!}
@stop

@section('map')
  @include('dns.contenedormapa.contentmap')
@stop
