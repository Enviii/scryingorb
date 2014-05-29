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
		<div class="col-md-10 col-md-offset-1">
			<p class="text-center">
				Fair warning guys, skin sale estimation dates are relatively vague. There {{$countSkin}} being sold at the moment. Only 3 go on sale in one sale. Sales are calculated by tier, so 975 RP skins take a lot longer to go on sale than 750 RP because the former has a lot more skins in its tier.
			</p>
		</div>
		

<?php 
	$count1820 = count($rp1820);
	$count1350 = count($rp1350);
	$count975 = count($rp975);
	$count750 = count($rp750);
	$count520 = count($rp520);
	$count390 = count($rp390);

	$today = new DateTime("now");
	$day7 = new DateTime("7 days ago");
	$day3 = new DateTime("4 days");
?>

@foreach($rp_range as $rp)

		<div class="col-lg-6 col-md-6 col-sm-6">

			<div class="panel-default panel">
				<div class="panel-heading">
					<h3 class="panel-title text-center">{{$rp->rp}} RP
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

								$date_last_sale = new DateTime($skin->date_last_sale);

								
								

								//$interval = $date_last_sale->diff($today);


								//echo ${"count".$ip->ip};

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

								

								if ($skin->date_last_sale_2==null) {
									$interval = $date_last_sale->diff($today);
									//echo "<br>";
									//echo $skin->id." date_last_sale ".$date_last_sale->format('Y-m-d')."<br>";

									//is null, ignore this shit
									//echo $skin->date_last_sale_2."<br>";

									$expected_sale = $date_last_sale->add(new DateInterval('P'.$days.'D'));
									if ($expected_sale<$today) {
										$soon=true;
										
									}
									$recently=false;
									$onsale=false;

									$expected_sale_date = $expected_sale->format("M d \'y");

								} else {

									$date_last_sale_2 = new DateTime($skin->date_last_sale_2);
									//on sale within the past 7 days
									if ($date_last_sale_2 <= $today && $date_last_sale_2 >= $day7) {
										$soon=false;
										$recently=true;
										$onsale=false;
										$interval= $date_last_sale_2->diff($today);
										//echo $skin->skin." ".$skin->date_last_sale_2."<br>";

										//echo "3 days later: ".$day3->format("Y-m-d")."<br>";
										//echo "7 day: ".$day7->format("Y-m-d");

									} elseif ($date_last_sale_2 <= $day3 && $date_last_sale_2 >= $today) {
										$onsale=true;
										$soon=false;
										$recently=false;
										$interval= $date_last_sale_2->diff($today);

										//echo $skin->skin." ".$skin->date_last_sale_2."<br>";
									}

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

								<td class="text-center">{{$interval->format('%a')}}</td>

								@if ($skin->status==2)
									<td class="info text-center">
										Blacklisted

								@elseif ($soon==true)

									<td class="success text-center">
										Soon<sup>TM</sup>
								@elseif ($recently==true)

									<td class="warning text-center">
										Just Passed
								@elseif ($onsale==true)

									<td class="danger text-center">
										Right Now!
								@else 
									<td class="text-center">
										{{$expected_sale_date}}
								@endif

								</td>

							</tr>









					@endforeach

					</tbody>
				</table>
			</div>
		</div>

@endforeach

	</div>
</div>

@stop