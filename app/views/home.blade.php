@extends('layout.main')

@section('content')
    <div class="container" id="buttonWell">

	



		<div id="headerButton" class="row">
			

@foreach($champ_sales as $champion)
	<?php 
		$startDate = new DateTime($champion->start_date);
		$endDate = new DateTime($champion->end_date);

		$startDate=$startDate->format("M j");
		$endDate=$endDate->format("M j");
	?>
@endforeach

@foreach($old_champ_sale as $old_champion)
	<?php 
		$old_startDate = new DateTime($old_champion->start_date);
		$old_endDate = new DateTime($old_champion->end_date);

		$old_startDate=$old_startDate->format("M j");
		$old_endDate=$old_endDate->format("M j");
	?>
@endforeach

<!-- 				<div id="lastSale" class="col-lg-6"> 
	<button id="headerButton1" class="btn btn-default btn-lg btn-block">Last Sale <small>({{ $old_startDate." to ".$old_endDate }})</small></button>
</div>

<div id="currentSale" class="col-lg-6">
	<button id="headerButton2" class="btn btn-primary btn-lg btn-block">Current Sale <small>({{ $startDate." to ".$endDate }})</small></button>
</div>
 -->

<!-- <div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ul class="nav nav-tabs nav-justified">
				<li id="headerButton1"><a href="#">Last Sale <br><small>({{ $old_startDate." to ".$old_endDate }})</small></a></li>
				<li id="headerButton2"><a href="#">Current Sale <br><small>({{ $startDate." to ".$endDate }})</small></a></li>
				<li><a href="#">Next Sale <br><small>May 31 to Jun 2</small></a></li>
			</ul>
		</div>
	</div>
</div> -->

<?php 	$today = new DateTime("now");
		$today = $today->format("l"); ?>

@if ($today=="Monday" || $today=="Thursday")
			<div class="col-md-12">
				<div id="lastSale" class="col-xs-4"> 
					<button id="headerButton1" class="btn btn-default btn-block">Last Sale <br><small>({{ $old_startDate." to ".$old_endDate }})</small></button>
				</div>

				<div id="currentSale" class="col-xs-4">
					<button id="headerButton2" class="btn btn-primary btn-block">Current Sale <br><small>({{ $startDate." to ".$endDate }})</small></button>
				</div>

				<div id="nextSale" class="col-xs-4">
					<button id="headerButton3" class="btn btn-default btn-block">Next Sale <br><small>May 31 to Jun 2</small></button>
				</div>
			</div>
@else
			<div class="col-md-12">
				<div id="lastSale" class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-2 col-xs-6"> 
					<button id="headerButton1" class="btn btn-default btn-block">Last Sale <br><small>({{ $old_startDate." to ".$old_endDate }})</small></button>
				</div>

				<div id="currentSale" class="col-md-4 col-md-offset-2 col-sm-4 col-xs-6">
					<button id="headerButton2" class="btn btn-primary btn-block">Current Sale <br><small>({{ $startDate." to ".$endDate }})</small></button>
				</div>
			</div>
@endif
		</div>
	</div> <!-- end buttonWell container -->

	<br>

	<div id="showSelection">
		@include('saleContent')
	</div> <!-- / #showSelection -->
@stop

@section('js')
	<script>
		$( document ).ready(function() {
			$("#headerButton2").addClass("active");

/*			var champName = [];
			$.getJSON( url, function( data ) {

				$.each(data.data, function(k,v){
					//console.log("key: "+k);
					//console.log(k)

					$.each(v, function(key, value){
						//console.log(key);
						if (key=="name") {
							console.log(value); //retrieve names
							
							champName.push(value);
						};

						if (key=="skins") {
							//console.log(value);
							$.each(value, function(key2, value2){
								//console.log(value2);
							});
						};
					});
				});
			});*/

			//champName.push("test");

			

			//hide next button if day meets condition
/*			var weekday = new Date().getDay();

			if ( !( (weekday==1) || (weekday==4) ) ) {
				$("#nextSale").remove();
				console.log("orig");
			} else {
				
				console.log("here");
			}*/

			/*
				Last Button
			*/
			$("#headerButton1").click(function(e){
				$("#headerButton2").removeClass("active");
				$("#headerButton3").removeClass("active");
				$("#headerButton1").addClass("active");
				console.log("clicky1");
				e.preventDefault();

				$.get('header1', function(data){
					$("#showSelection").html(data);
				});
				$('#headerButton').find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				$(this).removeClass('btn-default').addClass('btn-primary');
			});

			/*
				Current Button
			*/
			$("#headerButton2").click(function(e){
				$("#headerButton1").removeClass("active");
				$("#headerButton3").removeClass("active");
				$("#headerButton2").addClass("active");

				console.log("clicky2");
				e.preventDefault();

				$.get('header2', function(data){
					$("#showSelection").html(data);
				});
				$('#headerButton').find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				$(this).removeClass('btn-default').addClass('btn-primary');
			});

			/*
				Next Button
			*/
			$("#headerButton3").click(function(e){
				console.log("clicky2");
				e.preventDefault();

				$.get('header3', function(data){
					$("#showSelection").html(data);
				});
				$('#headerButton').find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				$(this).removeClass('btn-default').addClass('btn-primary');
			});
		});
	</script>
@stop