@extends('layout.main')

@section('content')
	<!-- @foreach($champions as $value)
		<br>
		<a href="{{ URL::to('champion', $value->champion) }}">{{$value->champion}}</a>
	@endforeach -->
	<br>
	<!--@foreach($champions as $champion)
		<ul>
	   		<h2><a href="{{ URL::to('champion', $champion->champion) }}">{{$champion->champion}}</a></h2>

	   @foreach($champion->skins as $skin)-->
	    	<!--<li>{{ $skin->skin }}</li>-->
	    	<!--<li><a href="{{ URL::to('skin', $skin->skin) }}">{{$skin->skin}}</a></li>-->
	   <!--@endforeach
	   	</ul>
	   <br>
	@endforeach-->
<?php 

function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


?>

	<div class="container" id="champs">
		<div class="row">
			@foreach($champions as $champion)
				<div class="col-md-3">
					<div class="thumbnail" id="championPage">
					<?php $cleanChamp = clean($champion->champion); ?>
						<a href="{{ URL::to('champion', $champion->champion) }}"><img data-src="holder.js/300x200" src="/img/champion/{{$cleanChamp}}.png" alt="{{$champion->champion}}"></a>
						<div class="caption text-center">
							<h3 class="text-success"><strong>{{$champion->champion}}</strong></h3>
							<p>{{$champion->rp}} RP</p>

							@foreach($champion->skins as $skin)
								<!-- <li>{{ $skin->skin }}</li> -->
								<!-- <li><a href="{{ URL::to('skin', $skin->skin) }}">{{$skin->skin}}</a></li> -->
								<p>
									<a href="{{ URL::to('skin', $skin->skin) }}" class="btn btn-primary btn-block" role="button">
										{{$skin->skin}}
									</a>
								</p>
							@endforeach
						</div>
					</div>
		        </div>
			@endforeach
		</div>
	</div>

@stop