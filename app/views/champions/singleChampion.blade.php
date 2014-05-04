@extends('layout.sub')

@section('content')
	@foreach($champions as $value)
		{{$value->champion}}
		<pre>{{$value}}</pre>
	@endforeach
@stop