@extends('layout.main')

@section('content')
    <div class="container" id="buttonWell">
		<div id="headerButton" class="row">

@foreach($champ_sales as $champion)
	<?php 
		$startDate = new DateTime($champion->start_date);
		$endDate = new DateTime($champion->end_date);

		$startDate=$startDate->format("j M");
		$endDate=$endDate->format("j M");
		//echo $startDate." to ".$endDate;
	?>
@endforeach

			<div id="lastSale" class="col-sm-6 col-md-4 col-md-offset-1">
				<button id="headerButton1" class="btn btn-default btn-lg btn-block">Last Sale</button>
			</div>

			<div id="currentSale" class="col-sm-6 col-md-4 col-md-offset-2">
				<button id="headerButton2" class="btn btn-primary btn-lg btn-block">Current Sale <small>({{ $startDate." to ".$endDate }})</small></button>
			</div>
<?php
/*				$today = new DateTime("now");
				$today = $today->format("l");
				if ($today=="Monday" || $today=="Thursday") { */
?>
					<div id="nextSale" class="col-sm-6 col-md-4">
						<button id="headerButton3" class="btn btn-default btn-lg btn-block">Next Sale</button>
					</div>
<?php 			//}
?>

			<!-- <div id="headerButton" class="col-sm-6 col-md-3">
				<button id="headerButton" class="btn btn-default btn-lg btn-block">Bundles</button>
			</div> -->
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






var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};



var champions = {{$champions}};
var skins = {{$skins}};
 
$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'champion',
  displayKey: 'value',
  source: substringMatcher(champions)
},
{
  name: 'skin',
  displayKey: 'value',
  source: substringMatcher(skins)
}
);

$('.typeahead').bind('typeahead:selected', function(obj, datum, name) {      
        //alert(JSON.stringify(obj)); // object
        // outputs, e.g., {"type":"typeahead:selected","timeStamp":1371822938628,"jQuery19105037956037711017":true,"isTrigger":true,"namespace":"","namespace_re":null,"target":{"jQuery19105037956037711017":46},"delegateTarget":{"jQuery19105037956037711017":46},"currentTarget":
        //alert(JSON.stringify(datum)); // contains datum value, tokens and custom fields
        // outputs, e.g., {"redirect_url":"http://localhost/test/topic/test_topic","image_url":"http://localhost/test/upload/images/t_FWnYhhqd.jpg","description":"A test description","value":"A test value","tokens":["A","test","value"]}
        // in this case I created custom fields called 'redirect_url', 'image_url', 'description'   
/*        console.log(obj);
        console.log(datum.value);*/

        //console.log(name);

        if (name=="skin") {
	        urlTo = "{{ URL::to('skin', 'here') }}";
			urlTo = urlTo.replace('here', datum.value);

			window.location=urlTo;
        } else {
	        urlTo = "{{ URL::to('champion', 'here') }}";
			urlTo = urlTo.replace('here', datum.value);

			window.location=urlTo;
        }
});




































			var weekday = new Date().getDay();

			if ( !( (weekday==1) || (weekday==4) ) ) {
				$("#nextSale").remove();
				console.log("orig");
			} else {
				
				console.log("here");
			}

			console.log(weekday);

			$("#headerButton1").click(function(e){
				console.log("clicky1");
				e.preventDefault();

				$.get('header1', function(data){
					$("#showSelection").html(data);
				});
				$('#headerButton').find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				$(this).removeClass('btn-default').addClass('btn-primary');
			});

			$("#headerButton2").click(function(e){
				console.log("clicky2");
				e.preventDefault();

				$.get('header2', function(data){
					//return data;
					//console.log(data);
					
					$("#showSelection").html(data);
				});
				$('#headerButton').find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				$(this).removeClass('btn-default').addClass('btn-primary');
			});

			$("#headerButton3").click(function(e){
				console.log("clicky2");
				e.preventDefault();

				$.get('header3', function(data){
					//return data;
					//console.log(data);
					
					$("#showSelection").html(data);
				});
				$('#headerButton').find(".btn-primary").removeClass("btn-primary").addClass("btn-default");
				$(this).removeClass('btn-default').addClass('btn-primary');
			});
		});
	</script>
@stop