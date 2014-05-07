@extends('layout.main')

@section('content')
	@foreach($skins as $value)
		{{$value->skin}}
		<pre>{{$value}}</pre>
	@endforeach
@stop