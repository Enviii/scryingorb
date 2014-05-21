<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Scrying Orb</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="stylesheet" href="css/bootstrap-darkly.min.css"> -->
        {{ HTML::style('css/bootstrap-darkly.min.css') }}
        <style>
            body {
                padding-top: 70px;
                padding-bottom: 20px;
            }
.tt-dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
}
.tt-suggestion > p {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #333333;
  white-space: nowrap;
}
.tt-suggestion > p:hover,
.tt-suggestion > p:focus,
.tt-suggestion.tt-cursor p {
  color: #ffffff;
  text-decoration: none;
  outline: 0;
  background-color: #428bca;
}

        </style>
        <!-- <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->
        <!-- <link rel="stylesheet" href="css/main.css"> -->
        {{ HTML::style('css/main.css') }}
        {{ HTML::script('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
    </head>
	<body>
		@include('layout.navigation')
		@yield('content')

        <div class="container" id="footer">
            <div class="row text-center">
                <hr>
                <footer>
                    <p>&copy; Scrying Orb 2014</p>
                </footer>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- <script src="js/main.js"></script> -->
        {{ HTML::script('js/main.js') }}
        {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.2/typeahead.bundle.min.js')}}
        @yield('js')
	</body>
</html>