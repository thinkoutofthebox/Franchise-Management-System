<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Radix') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/loginregister.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
   <!--Dynamic StyleSheets added from a view would be pasted here-->
   @yield('styles')
</head>
<body>
<div class="loading"></div>
<header class="container-sm radixlogoImg">
	<img src="{{ asset('images/radixEdusystemLogo.png') }}" alt="Rdix Edusystems"/>
</header>
<?php 
$query_string = ['tab', 'login'];
if (!empty($_SERVER['QUERY_STRING'])) {
  $query_string = explode('=', $_SERVER['QUERY_STRING']);
} 
?>
<section class="container-sm login-regBg">
	<div class="tabContainer">
		<ul  class="nav nav-pills nav-justified" role="tablist">
			<li class="nav-item">
        			<a href="#LoginDiv" id="LoginLink" class="{{$query_string[1] == 'login'?'active':''}}" data-toggle="tab" onclick="updateURL('login');">Login</a>
			</li>
			<li class="nav-item"><a href="#RegisterDiv" id="RegisterLink" class="{{$query_string[1] == 'register'?'active':''}}" data-toggle="tab" onclick="updateURL('register');">Register</a>
			</li>
		</ul>	
	</div>
	<div class="login-reg-form-containter">		
		<div class="form-wrappper tab-content clearfix">
		    @yield('content')
		</div>
	</div>
</section>
	 <script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type=text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function(){
            $(".alert-success,alert-info,.alert-warning,.alert-danger").fadeTo(3500, 2000).slideUp(2000, function(){
                $(".alert-success,alert-info,.alert-warning,.alert-danger").fadeOut(2000);
            });
       });
	function updateURL(tabname) {
      		if (history.pushState) {
          		var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab='+tabname;
          		window.history.pushState({path:newurl},'',newurl);
      		}
    	}
    </script>
	<!--Dynamic StyleSheets added from a view would be pasted here-->
	@yield('scripts')
</body>
</html>
