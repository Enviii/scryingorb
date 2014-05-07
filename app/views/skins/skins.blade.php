@extends('layout.main')

@section('content')



	<div class="container" id="champs">
		<div class="row">
			@foreach($skins as $s)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<a href="{{ URL::to('skin', $s->skin) }}"><img data-src="holder.js/300x200" src="" alt=""></a>
						<div class="caption text-center">
							<h3 class="text-success"><strong>{{$s->skin}}</strong></h3>
							<p><a href="{{ URL::to('skin', $s->skin) }}" class="btn btn-primary btn-block" role="button">See History</a></p>
						</div>
					</div>
		        </div>
			@endforeach
		</div>
	</div>



	<!--@foreach($skins as $value)
		<br>
		<?php 
			$skinName=$value->skin;
			$skinName=str_replace(" ", "_", $skinName);
		 ?>
		<a href="{{ URL::to('skin', $skinName) }}">{{$value->skin}}</a> - <a href="{{ URL::to('skin', $value->champion()->first()->champion) }}">{{$value->champion()->first()->champion}}</a>
	@endforeach-->
@stop