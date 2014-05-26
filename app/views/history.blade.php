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
		
<?php $divCount=2; ?>

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
								$today = new DateTime("now");

								$interval = $date_last_sale->diff($today);

								//echo ${"count".$ip->ip};

								//prediction formula
								$formula = ${"count".$ip->ip}*(365/$countChamp);
								$days = round($formula);

								//calculate predicted sale date
								$expected_sale = $date_last_sale->add(new DateInterval('P'.$days.'D'));
								$expected_sale_date = $expected_sale->format("M d");

								//$intervalExpected = $expected_sale->diff($today);
								//$intervalExpected->format('%a')


							?>
							<!-- http://gameinfo.na.leagueoflegends.com/en/game-info/champions/{{ clean($champ->champion)}} -->
							<tr>

								<td>
									<a href="{{ URL::to('champion', $champ->champion) }}">
										{{$champ->champion}}
									</a>
								</td>

								<td class="text-center">{{$interval->format('%a')}}</td>

								@if ($expected_sale<$today)
									<td class="success text-center">
										Soon
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

	<?php $divCount+=1; ?>

@endforeach

		
	</div>
</div>

















@stop