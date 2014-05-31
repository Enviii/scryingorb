@extends('layout.main')

@section('content')

<div class="container">
	<div class="row">
		<div class="page-header">
			<h1>Sale History</h1>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		
<?php 

	$today = new DateTime("today");
	$day7 = new DateTime("7 days ago");
	$day3 = new DateTime("4 days");
	$divCount=2; 

	/*echo "day 7 is ".$day7->format("m-d");
	echo "<br>";
	echo "day 3 is ".$day3->format("m-d");*/

?>

@foreach($ip_range as $ip)

	@if ($divCount == 4)
		<div class="clearfix visible-lg visible-md visible-sm"></div>
	@endif

		<div class="col-lg-6 col-md-6 col-sm-6">

			<div class="panel-default panel">
				<div class="panel-heading">
					<h3 class="panel-title text-info">{{$ip->ip}} IP</h3>
				</div>

				<table class="table table-bordered table-hover table-condensed">
					<thead>
						<tr>
							<th class="text-center">Champion</th>
							<th class="text-center">Passed Days</th>
							<th class="text-center">Est. Sale Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach(${"ip".$ip->ip} as $champ)
							<?php 
								/*Calculate passed days and estimated sale dates*/

								$date_last_sale = new DateTime($champ->last_sale);

								$test2 = new DateTime($champ->last_sale_2);
/*								if ($test2 == $today ) {
									echo " is today <br>";
								} else {
									echo " is not today <br>";
								}*/
								//echo ${"count".$ip->ip};

								//prediction formula
								$formula = ${"count".$ip->ip}*(365/$countChamp);
								$days = round($formula);

								//calculate predicted sale date
								/*$expected_sale = $date_last_sale->add(new DateInterval('P'.$days.'D'));
								$expected_sale_date = $expected_sale->format("M d");*/

								//$intervalExpected = $expected_sale->diff($today);
								//$intervalExpected->format('%a')

								if ($champ->last_sale_2==null) {
									$interval = $date_last_sale->diff($today);
									//echo "<br>";
									//echo $skin->id." date_last_sale ".$date_last_sale->format('Y-m-d')."<br>";

									//is null, ignore this shit
									//echo $skin->date_last_sale_2."<br>";

									$expected_sale = $date_last_sale->add(new DateInterval('P'.$days.'D'));
									if ($expected_sale<$today) {
										$soon=true;
									} else {
										$soon=false;
									}
									$recently=false;
									$onsale=false;

									$expected_sale_date = $expected_sale->format("M d \'y");

								} else {

									$date_last_sale_2 = new DateTime($champ->last_sale_2);


/*								if ($date_last_sale_2 >= $day7) {
									echo $champ->champion." is today <br>";
								} else {
									echo $champ->champion." is not today <br>";
								}*/

									//on sale within the past 7 days. g>
									if ($date_last_sale_2 < $today && $date_last_sale_2 >= $day7) {
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
							<!-- http://gameinfo.na.leagueoflegends.com/en/game-info/champions/{{ clean($champ->champion)}} -->
							<tr>

								<td>
									<a href="{{ URL::to('champion', $champ->champion) }}">
										<span class="champ">{{$champ->champion}}</span>
									</a>
								</td>

								<td class="text-center">{{$interval->format('%a')}}</td>
									@if ($champ->status==1 || $champ->status==2)
										<td class="info text-center">Blacklisted
									@elseif ($soon==true)
										<td class="success text-center">Soon<sup>TM</sup>
									@elseif ($recently==true)
										<td class="warning text-center">Just Passed
									@elseif ($onsale==true)
										<td class="danger text-center">Right Now!
									@else 
										<td class="text-center">{{$expected_sale_date}}
									@endif
								</td>

							</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	<?php $divCount+=1; ?>

@endforeach

		
	</div>
</div>

















@stop