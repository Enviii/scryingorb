@extends('layout.main')

@section('content')

<?php 

$divCount=0;
?>

	<div class="container" id="champs">
		<div class="row">


			@foreach($champions as $champion)

				@if ($divCount % 4 == 0)
					<div class="clearfix visible-md visible-lg"></div>
				@endif

				@if ($divCount % 3 ==0)
					<div class="clearfix visible-sm"></div>
				@endif

				@if ($divCount % 2 ==0)
					<div class="clearfix visible-xs"></div>
				@endif

				<div class="col-md-3 col-sm-4 col-xs-6">

					<div class="thumbnail" id="championPage">
					<?php $cleanChamp = clean($champion->champion); ?>
						<a href="{{ URL::to('champion', $champion->champion) }}"><img data-src="holder.js/300x200" src="/img/champion/{{$cleanChamp}}.png" alt="{{$champion->champion}}"></a>
						<div class="caption text-center">
							<a href="{{ URL::to('champion', $champion->champion) }}">
								<h3 class="text-success"><strong>{{$champion->champion}}</strong></h3>
							</a>
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

				<?php $divCount+=1; ?>
			@endforeach


		</div>
	</div>

@stop