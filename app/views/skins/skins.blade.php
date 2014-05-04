@extends('layout.main')

@section('content')
	@foreach($skins as $value)
		<br>
		<?php 
			$skinName=$value->skin;
			$skinName=str_replace(" ", "_", $skinName);
		 ?>
		<a href="{{ URL::to('skin', $skinName) }}">{{$value->skin}}</a>
	@endforeach
@stop