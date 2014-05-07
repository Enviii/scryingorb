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
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- <script src="js/main.js"></script> -->
        {{ HTML::script('js/main.js') }}
        @yield('js')
	</body>
</html>