@extends('layout.main')

@section('content')

<?php 
	$today = new DateTime("today");
	$day3 = new DateTime("3 days ago");
?>

@foreach($champions as $champ)
	<?php 
		$champLastSale=$champ->last_sale;
		$champSaleStart = $champ->sale_start_date;
		$champSaleEnd = $champ->sale_end_date;
		$rp = $countIP;

		$sale = saleDate($champLastSale, $champSaleStart, $champSaleEnd, $rp, $today, $day3, $countChamp);

		$interval = saleInterval($champLastSale, $champSaleStart, $champSaleEnd, $today, $day3);
	?>
	<div class="container" id="champHeader">
		<div class="row">
			<div class="page-header">
				<h1>{{$champ->champion}} <small>{{$interval}}</small></h1>
				<h4>Expected Sale Date: 
					@if ( $sale=="onSaleNow")
						<span class="text-danger">
							Right Now!
						</span>
					@elseif ($sale=="onNextSale")
						<span class="text-success">
							Next Sale
						</span>
					@elseif ($sale=="soon")
						<span class="text-info">
							Soon<sup>TM</sup>
						</span>
					@elseif ($sale=="justPassed")
						<span class="text-warning">
							Just Passed
						</span>
					@else 
						{{$sale}}
					@endif
				</h4>
			</div>
		</div>
	</div>

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
							<p>{{$interval}}</p>
						</div>
					</div>

					@foreach($champ->skins as $skin)

						<?php
							$skin_date_last_sale = new DateTime($skin->last_sale);
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
									<td>{{$skin->last_sale}}</td>
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