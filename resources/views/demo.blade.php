<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HexaTrade Demo</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.body{
    		margin: auto;
    		width: 200px;
    	}
    	.body .button {
    		width: 150px;
    		align-items: center;
    	}
    	.body .button a{
    		text-decoration: none;
		    text-align: center;
		    padding: 15px 40px 10px 43px;
		    font-weight: 700;
		    text-transform: uppercase;
    	}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <h4>
                      This is demo version change not working..
                   </h4>
                </div>
               

            </div>
        </nav>
         <div class="body">
          	<button class="button"><a class="navbar-brand" href="{{ url('/admin') }}">
                  Back
            </a></button>
         </div>
    </div>

    <!-- Scripts -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>


