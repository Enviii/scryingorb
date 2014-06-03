@extends('layout.main')

@section('content')

<div class="container">
	<div class="row">
		<div class="page-header">
			<h1>Skin History</h1>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<ul class="nav nav-tabs nav-justified">
					<li class="active" id="allSkin"><a href="#">All</a></li>
				@foreach($rp_range as $rp)
					<li id="{{$rp->rp}}"><a href="#">{{$rp->rp}}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<br>

<?php 
	$count1820 = count($rp1820);
	$count1350 = count($rp1350);
	$count975 = count($rp975);
	$count750 = count($rp750);
	$count520 = count($rp520);
	$count390 = count($rp390);

	$today = new DateTime("today");
	$day7 = new DateTime("7 days ago");
	$day3 = new DateTime("3 days ago");
?>

<div class="container" id="all">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<p class="text-center">
				Fair warning guys, skin sale estimation dates are relatively vague. There {{$countSkin}} being sold at the moment. Only 3 go on sale in one sale. Sales are calculated by tier, so 975 RP skins take a lot longer to go on sale than 750 RP because the former has a lot more skins in its tier.
			</p>
		</div>

@foreach($rp_range as $rp)

		<div class="col-lg-6 col-md-6 col-sm-6">

			<div class="panel-default panel">
				<div class="panel-heading">
					<h3 class="panel-title text-center">
						@if ($rp->rp==1820)
							{{$rp->rp}} &amp; 3250 RP
						@else
							{{$rp->rp}} RP
						@endif
						<!-- <span class="label label-primary"></span> -->
					</h3>
				</div>

				<table class="table table-bordered table-hover table-condensed">
					<thead>
						<tr>
							<th class="text-center">Skin</th>
							<th class="text-center">Passed Days</th>
							<th class="text-center">Est. Sale Date</th>
						</tr>
					</thead>
					<tbody>

						@foreach(${"rp".$rp->rp} as $skin)
							<?php 
								$interval=null;
								$onSaleNow=null;
								$onNextSale=null;
								$soon=null;
								$justPassed=null;

								/*Check if date column is null before assigning DateTime obj*/
								if ($skin->last_sale==null) {
									$last_sale=null;
								} else {
									$last_sale = new DateTime($skin->last_sale);
								}

								if ($skin->sale_start_date==null) {
									$sale_start_date=null;
								} else {
									$sale_start_date = new DateTime($skin->sale_start_date);
									$sale_start_date_format = $sale_start_date->format("Y-m-d");
								}

								if ($skin->sale_end_date==null) {
									$sale_end_date=null;
								} else {
									$sale_end_date = new DateTime($skin->sale_end_date);
									$sale_end_date_format = $sale_end_date->format("Y-m-d");
								}
								

								/*calculate days since the sale ended*/
								//check if sale_start_date OR sale_end_date is null
								if ($sale_start_date==null || $sale_end_date==null) {
									//use last_sale for days past
									$interval = $last_sale->diff($today);
									$interval = $interval->format('%a days');

									//prediction formula
									if ( ($rp->rp) == "1350") {
										$formula = ${"count".$rp->rp}*(365/(26* 1));
									} elseif ($rp->rp=="975") {
										$formula = ${"count".$rp->rp}*(365/(26* 5));
									} elseif ($rp->rp=="750") {
										$formula = ${"count".$rp->rp}*(365/(26* 2));
									} elseif ($rp->rp=="520") {
										$formula = ${"count".$rp->rp}*(365/(26* 4));
									} else {
										$formula = ${"count".$rp->rp}*(365/$countSkin);
									}

									$days = round($formula);
									//calculate estimated date:
									$expected_sale_date = $last_sale->add(new DateInterval('P'.$days.'D'));

									if ($expected_sale_date<=$today) {
										$soon = true;
									} else {
										$expected_sale_date_format = $expected_sale_date->format("M d \'y");
									}

								} elseif ($sale_start_date<=$today && $sale_end_date>=$today) {
									//if today is between start and end date
									$onSaleNow=true;
									$interval = $sale_start_date->diff($today);
									$interval = $interval->format('%a days');
								} elseif ($sale_start_date>$today) {
									$onNextSale=true;
									$interval = $last_sale->diff($today);
									$interval = $interval->format('%a days');
								} elseif ($sale_end_date > $day3) {
									$justPassed=true;
									$interval = $last_sale->diff($today);
									$interval = $interval->format('%a days');
								} else {
									$interval = $last_sale->diff($today);
									$interval = $interval->format('%a days');
								}
							?>



							<tr>

								<td>
									
									<a href="{{ URL::to('skin', $skin->skin) }}">
										{{$skin->set}}
									</a>
									<a href="{{ URL::to('champion', $skin->champion) }}">
										<span class="champ">{{$skin->champion}}</span>
									</a>
									
								</td>

								<td class="text-center">{{{ $interval }}}</td>

								@if (isset($onSaleNow) && $onSaleNow==true)
									<td class="danger text-center">
										Right Now!
									</td>
								@elseif (isset($onNextSale) && $onNextSale==true)
									<td class="success text-center">
										Next Sale
									</td>
								@elseif (isset($soon) && $soon==true)
									<td class="info text-center">
										Soon<sup>TM</sup>
									</td>
								@elseif (isset($justPassed) && $justPassed==true)
									<td class="warning text-center">
										Just Passed
									</td>
								@else 
									<td class="text-center">
										{{$expected_sale_date_format}}
									</td>
								@endif

							</tr>


						@endforeach

					</tbody>
				</table>
			</div>
		</div>

@endforeach

	</div>
</div>

<div class="container">
	<div class="row">
		<div id="specificRP"></div>
	</div>
</div>

@stop

@section('js')
	<script>
		$( document ).ready(function() {

			@foreach($rp_range as $rp)

				$("#{{$rp->rp}}").click(function(e){
					console.log("clicky2");
					e.preventDefault();

					$.get('/rp/{{$rp->rp}}', function(data){

						$("li").each(function(index){
							$(this).removeClass('active');
						});

						$("#{{$rp->rp}}").addClass('active');
						$("#all").remove();
						$("#specificRP").html(data);
					});
				});

			@endforeach

			$("#allSkin").click(function(e){
				console.log("clicky2");
				e.preventDefault();

				window.location.href="{{ URL::route('skinhistory') }}";

				/*$.get('/rp/all', function(data){

					$("li").each(function(index){
						$(this).removeClass('active');
					});

					$("#allSkin").addClass('active');
					console.log(data);
					//$("#specificRP").html(data);
				});*/
			});

		});
	</script>
@stop