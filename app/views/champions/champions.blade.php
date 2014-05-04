@extends('layout.main')

@section('content')
	Champion Page.
	@foreach($champions as $value)
		<br>
		<a href="{{ URL::to('champion', $value->champion) }}">{{$value->champion}}</a>
	@endforeach
@stop