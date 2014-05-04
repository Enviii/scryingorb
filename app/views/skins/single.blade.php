@extends('layout.sub')

@section('content')
	@foreach($skins as $value)
		{{$value->skin}}
		<pre>{{$value}}</pre>
	@endforeach
@stop