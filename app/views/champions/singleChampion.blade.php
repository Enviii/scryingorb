@extends('layout.main')

@section('content')

@foreach($champions as $champ)
	<?php 

		$date_last_sale = new DateTime($champ->last_sale);
		$today = new DateTime("now");

		$interval = $date_last_sale->diff($today);

		$skin_date_last_sale = new DateTime();
	?>
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1>{{$champ->champion}} <small>{{$interval->format('%a days since sale')}}</small></h1>
			</div>
		</div>
	</div>

	@foreach($champ->skins as $skin)
		<!-- 		<pre>
		{{$skin}}
		</pre> 
		<br>
		{{asset('img/all/'.$skin->champion.'_Splash_'.$skin->set.'.jpg');}}-->

		
	@endforeach


	<div class="container">
		<div class="row">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active" id="classic"></li>

	<?php $n=1; ?>
	@foreach($champ->skins as $skin)

					<li data-target="#carousel-example-generic" data-slide-to="{{$n}}" id="{{$skin->skin}}"></li>

		<?php $n++; ?>
	@endforeach

				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<img src="{{asset('img/all/'.clean($skin->champion).'_Splash_Classic.jpg');}}" alt="Champ">
						<div class="carousel-caption">
						<h2 class="text-success">{{$champ->champion}}</h2>
						<p>{{$interval->format('%a days ago')}}</p>
						</div>
					</div>

	@foreach($champ->skins as $skin)

	<?php
		$skin_date_last_sale = new DateTime($skin->date_last_sale);
		$skin_interval = $skin_date_last_sale->diff($today);

	?>
					<div class="item">
						<img src="{{asset('img/all/'.clean($skin->champion).'_Splash_'.str_replace(" ", "", $skin->set).'.jpg');}}" alt="Champ">
						<div class="carousel-caption">
						<h2 class="text-success">{{$skin->skin}}</h2>
						<p>{{$skin_interval->format('%a days since sale')}}</p>
						</div>
					</div>
	@endforeach


				</div>

			 	<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		</div>
	</div>

	<br>
	<hr>
	<br>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{$champ->champion}} Skin Sales</h3>
					</div>

					<table class="table table-bordered">
						<thead>
						<tr>
							<th>Skin</th>
							<th>Price</th>
							<th>Last Sale</th>
						</tr>
						</thead>
						<tbody>
							@foreach($champ->skins as $skin)
								<tr>
									<td>{{$skin->skin}}</td>
									<td>{{$skin->rp}}</td>
									<td>{{$skin->date_last_sale}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					

				</div>

			</div>
		</div>
	</div>

















@endforeach


	<!-- @foreach($champions as $value)
		{{$value->champion}}

		<pre>{{$value}}</pre>
	@endforeach -->
	<!-- <pre>{{$champions}}</pre> -->
@stop