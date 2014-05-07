@extends('layout.main')

@section('content')
    <div class="container" id="buttonWell">
		<div id="headerButton" class="row">
			<div id="headerButton" class="col-sm-6 col-md-4">
				<button id="headerButton1" class="btn btn-default btn-lg btn-block">Last Week</button>
			</div>

			<div id="headerButton" class="col-sm-6 col-md-4">
				<button id="headerButton2" class="btn btn-primary btn-lg btn-block">This Week</button>
			</div>

			<div id="headerButton" class="col-sm-6 col-md-4">
				<button id="headerButton3" class="btn btn-default btn-lg btn-block">Next Week</button>
			</div>

			<!-- <div id="headerButton" class="col-sm-6 col-md-3">
				<button id="headerButton" class="btn btn-default btn-lg btn-block">Bundles</button>
			</div> -->
		</div>
	</div> <!-- end buttonWell container -->

	<br>

	<div class="container" id="champs">
		<div class="row">
			@foreach($champ_sales as $champion)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<a href="{{ URL::to('champion', $champion->champion) }}"><img data-src="holder.js/300x200" src="{{$champion->image}}" alt="{{$champion->champion}}"></a>
						<div class="caption text-center">
							<h3 class="text-success"><strong>{{$champion->champion}}</strong></h3>
							<p><strike>{{$champion->original_price}}</strike> {{$champion->sale_price}} RP</p>
							<p><a href="{{ URL::to('champion', $champion->champion) }}" class="btn btn-primary btn-block" role="button">See History</a></p>
						</div>
					</div>
		        </div>
			@endforeach
		</div>
	</div>

	<div class="container" id="skins">
		<div class="row">
			@foreach($skin_sales as $skin)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<a href="{{ URL::to('skin', $skin->skin) }}"><img id="skin" data-src="holder.js/300x200" src="{{$skin->image}}" alt="{{$skin->image}}"></a>
						<div class="caption text-center">
							<h3 class="text-success"><strong>{{$skin->skin}}</strong></h3>
							<p><strike>{{$skin->original_price}}</strike> {{$skin->sale_price}} RP</p>
							<p><a href="{{ URL::to('skin', $skin->skin) }}" class="btn btn-primary btn-block" role="button">See History</a></p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

@section('js')
	<script>
		$( document ).ready(function() {
			// $("#headerButton1").click(function(){
			// 	$.ajax({url:"demo_test.txt",success:function(result){
			// 		$("#div1").html(result);
			// 	}});
			// });
		});
	</script>
@stop