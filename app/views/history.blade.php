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
								$champLastSale=$champ->last_sale;
								$champSaleStart = $champ->sale_start_date;
								$champSaleEnd = $champ->sale_end_date;
								$rp = ${"count".$ip->ip};

								$sale = saleDate($champLastSale, $champSaleStart, $champSaleEnd, $rp, $today, $day3, $countChamp);

								$interval = saleInterval($champLastSale, $champSaleStart, $champSaleEnd, $today, $day3);
							?>
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

								<td class="text-center">{{$interval}}</td>

								@if ( $sale=="onSaleNow")
									<td class="danger text-center">
										Right Now!
									</td>
								@elseif ($sale=="onNextSale")
									<td class="success text-center">
										Next Sale
									</td>
								@elseif ($sale=="soon")
									<td class="info text-center">
										Soon<sup>TM</sup>
									</td>
								@elseif ($sale=="justPassed")
									<td class="warning text-center">
										Just Passed
									</td>
								@else 
									<td class="text-center">
										{{$sale}}
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