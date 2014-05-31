<?php 
	
	$today = new DateTime("today");
	$day7 = new DateTime("7 days ago");
	$day3 = new DateTime("4 days");

	$rpSkinCount = count($rpSpecific);

?>


		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

			<div class="panel-default panel">
				<div class="panel-heading">
					<h3 class="panel-title text-center">
						
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

						@foreach($rpSpecific as $skin)
							<?php 
								$date_last_sale = new DateTime($skin->date_last_sale);

								if ( ($skin->rp) == "1350") {
									$formula = $rpSkinCount*(365/(26* 1));
								} elseif ($skin->rp=="975") {
									$formula = $rpSkinCount*(365/(26* 5));
								} elseif ($skin->rp=="750") {
									$formula = $rpSkinCount*(365/(26* 2));
								} elseif ($skin->rp=="520") {
									$formula = $rpSkinCount*(365/(26* 4));
								} else {
									$formula = $rpSkinCount*(365/$countSkin);
								}

								$days = round($formula);

								if ($skin->date_last_sale_2==null) {
									$interval = $date_last_sale->diff($today);

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

									$date_last_sale_2 = new DateTime($skin->date_last_sale_2);
									//on sale within the past 7 days
									if ($date_last_sale_2 < $today && $date_last_sale_2 >= $day7) {
										$soon=false;
										$recently=true;
										$onsale=false;
										$interval= $date_last_sale_2->diff($today);
									} elseif ($date_last_sale_2 <= $day3 && $date_last_sale_2 >= $today) {
										$onsale=true;
										$soon=false;
										$recently=false;
										$interval= $date_last_sale_2->diff($today);
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

