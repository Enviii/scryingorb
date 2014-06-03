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
	$day3 = new DateTime("3 days ago");
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
								$interval=null;
								$onSaleNow=null;
								$onNextSale=null;
								$soon=null;
								$justPassed=null;

								/*Check if date column is null before assigning DateTime obj*/
								if ($champ->last_sale==null) {
									$last_sale=null;
								} else {
									$last_sale = new DateTime($champ->last_sale);
								}

								if ($champ->sale_start_date==null) {
									$sale_start_date=null;
								} else {
									$sale_start_date = new DateTime($champ->sale_start_date);
									$sale_start_date_format = $sale_start_date->format("Y-m-d");
								}

								if ($champ->sale_end_date==null) {
									$sale_end_date=null;
								} else {
									$sale_end_date = new DateTime($champ->sale_end_date);
									$sale_end_date_format = $sale_end_date->format("Y-m-d");
								}
								

								/*calculate days since the sale ended*/
								//check if sale_start_date OR sale_end_date is null
								if ($sale_start_date==null || $sale_end_date==null) {
									//use last_sale for days past
									$interval = $last_sale->diff($today);
									$interval = $interval->format('%a days');

									//prediction formula
									$formula = ${"count".$ip->ip}*(365/$countChamp);
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
							<!-- http://gameinfo.na.leagueoflegends.com/en/game-info/champions/{{ clean($champ->champion)}} -->
							<tr>

								<td>
									<a href="{{ URL::to('champion', $champ->champion) }}">
										<span class="champ">{{$champ->champion}}</span>
										
										<a href="http://gameinfo.na.leagueoflegends.com/en/game-info/champions/{{ cleanandlower($champ->champion)}}">
											<span class="super-small"> riot</span>
										</a>

										<span class="super-small"> &#8226; </span>
										
										<a href="http://leagueoflegends.wikia.com/wiki/{{ clean($champ->champion)}}">
											<span class="super-small"> wikia</span>
										</a>

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

	<?php $divCount+=1; ?>

@endforeach

		
	</div>
</div>

















@stop