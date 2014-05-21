<div class="navbar navbar-inverse navbar-fixed-top">
	<!-- navbar-collapse collapse navbar-inverse-collapse -->
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ URL::route('home') }}"><strong>Scrying Orb</strong></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ URL::route('home') }}">Home</a></li>
				<li><a href="{{ URL::route('skin') }}">Skins</a></li>
				<li><a href="{{ URL::route('champion') }}">Champions</a></li>
				<li><a href="#salehistory">Sale History</a></li>
				<li><a href="#predictionhistory">Prediction History</a></li>
			</ul>
			<form class="navbar-form navbar-right" id="the-basics">
				<input type="text" class="form-control col-lg-8 typeahead" placeholder="Champs/Skins">
			</form>
		</div><!--/.navbar-collapse -->
	</div>
</div>