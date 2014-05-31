@extends('layout.main')

@section('content')

@foreach($champions as $champ)
	<?php 

		$date_last_sale = new DateTime($champ->last_sale);
		$today = new DateTime("now");

		$date_last_sale = $date_last_sale->diff($today);

		//echo $champ->status;

		if ($champ->status==1) {
			$champInterval = "Blacklisted (450 IP)";
		} else {
			$champInterval = $date_last_sale->format('%a days since sale');
		}
		$skinInterval = $date_last_sale->format('%a days since sale');

		$skin_date_last_sale = new DateTime();

								//$date_last_sale = new DateTime($champ->last_sale);
								//$today = new DateTime("now");
								//echo $countIP;
								$formula = $countIP*(365/$countChamp);
								$days = round($formula);

								//calculate predicted sale date
								$date_last_sale = new DateTime($champ->last_sale);
								$expected_sale = $date_last_sale->add(new DateInterval('P'.$days.'D'));
								$expected_sale_date = $expected_sale->format("M d \'y");
	?>
	<div class="container" id="champHeader">
		<div class="row">
			<div class="page-header">
				<h1>{{$champ->champion}} <small>{{$champInterval}}</small></h1>
				<h4>Expected Sale Date: 
					@if ($expected_sale<$today)
						<small>Soon<sup>TM</sup></small>
					@else
						<small>{{$expected_sale_date}}</small>
					@endif
				</h4>
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
							<p>{{$champInterval}}</p>
						</div>
					</div>

	@foreach($champ->skins as $skin)

	<?php
		$skin_date_last_sale = new DateTime($skin->date_last_sale);
		$skin_interval = $skin_date_last_sale->diff($today);
		$skinName = str_replace(" ","",$skin->set);
	?>
					<div class="item">
						<a href="{{ URL::to('skin', $skin->skin) }}">
							<img src="{{asset('img/all/'.clean($skin->champion).'_Splash_'.$skinName.'.jpg');}}" alt="Champ">
						</a>
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

	<div class="container" id="hr">
		<div class="row">
			<hr>
		</div>
	</div>

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
									<td>
										<a href="{{ URL::to('skin', $skin->skin) }}">{{$skin->skin}}</a>
									</td>
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