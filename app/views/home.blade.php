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

			<div id="lastSale" class="col-sm-6 col-md-4"> 
				<button id="headerButton1" class="btn btn-default btn-lg btn-block">Last Sale <small>({{ $old_startDate." to ".$old_endDate }})</small></button>
			</div>

			<div id="currentSale" class="col-sm-6 col-md-4">
				<button id="headerButton2" class="btn btn-primary btn-lg btn-block">Current Sale <small>({{ $startDate." to ".$endDate }})</small></button>
			</div>
<?php
				$today = new DateTime("now");
				$today = $today->format("l");
				if ($today=="Monday" || $today=="Thursday") { 
?>
					<div id="nextSale" class="col-sm-6 col-md-4">
						<button id="headerButton3" class="btn btn-default btn-lg btn-block">Next Sale</button>
					</div>
<?php 			}
?>

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