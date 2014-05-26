		<div class="container" id="champs">
			<div class="row">
				@foreach($champ_sales as $champion)

					<div class="col-sm-4 col-md-4">
						<div class="thumbnail">
							<a href="{{ URL::to('champion', $champion->champion) }}">
								<img src="{{$champion->image}}" alt="{{$champion->champion}}">
							</a>
							<div class="caption text-center">
								<a href="{{ URL::to('champion', $champion->champion) }}">
									<h4 class="text-success">
										<strong>{{$champion->champion}}</strong>
									</h4>
								</a>
								<p><span class="text-info">Last Sale:</span><br> {{$champion->champ->last_sale}}
								<?php
									$subDays = new DateTime($champion->champ->last_sale);
									$today = new DateTime("now");
									
									$interval = $subDays->diff($today);
									echo "<small>(".$interval->format('%R%a days').")</small>";
								?>
								</p>
								<p><strike>{{$champion->original_price}}</strike> {{$champion->sale_price}} RP</p>
								<p><a href="{{ URL::to('champion', $champion->champion) }}" class="btn btn-primary btn-block" role="button">History</a></p>
							</div>
						</div>
			        </div>
				@endforeach
			</div>
		</div>

		<div class="container" id="skins">
			<div class="row">
				@foreach($skin_sales as $skin)
					<div class="col-sm-12 col-md-10 col-md-offset-1">
						<div class="thumbnail">
							<a href="{{ URL::to('skin', $skin->skin) }}">
								<img id="skin" src="{{$skin->image}}" alt="{{$skin->image}}">
							</a>
							<div class="caption text-center">
								<a href="{{ URL::to('champion', $champion->champion) }}">
									<h4 class="text-success">
										<strong>{{$skin->skin}}</strong>
									</h4>
								</a>
								<p><span class="text-info">Last Sale:</span><br> {{$skin->skinBelongsTo->date_last_sale}}
<?php
									$subDays = new DateTime($skin->skinBelongsTo->date_last_sale);
									$today = new DateTime("now");
									
									$interval = $subDays->diff($today);
									echo "<small>(".$interval->format('%R%a days').")</small>";
?>
								</p>
								<p>
									<strike>
										{{$skin->original_price}}
									</strike>
									 {{$skin->sale_price}} RP
								</p>
								<p>
									<a href="{{ URL::to('skin', $skin->skin) }}" class="btn btn-primary btn-block" role="button">
										History
									</a>
								</p>
							</div>
						</div>
					</div>

				@endforeach
			</div>
		</div>