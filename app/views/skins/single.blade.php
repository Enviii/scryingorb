@extends('layout.main')

@section('content')
	@foreach($skins as $skin)
<!-- 		{{$skin->skin}}
<pre>{{$skin}}</pre> -->

<?php 
		$date_last_sale = new DateTime($skin->date_last_sale);
		$today = new DateTime("now");

		$interval = $date_last_sale->diff($today);

		$skin_date_last_sale = new DateTime();

		$skinName = str_replace(" ","",$skin->set);

		
?>

		<div class="container">
			<div class="row">
				<div class="page-header">
					<h1>{{$skin->skin}} <small>{{$interval->format('%a days since sale')}} - {{$skin->rp}} RP</small></h1>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<img src="{{asset('img/all/'.clean($skin->champion).'_Splash_'.$skinName.'.jpg');}}" alt="" class="img-responsive">
			</div>
		</div>


	@endforeach
@stop