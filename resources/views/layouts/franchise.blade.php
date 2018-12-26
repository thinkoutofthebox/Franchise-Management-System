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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
   <!--Dynamic StyleSheets added from a view would be pasted here-->
   @yield('styles')
</head>
<body>
    <section class="admin-layout-main">
		<aside class="admin-sidebar">
			<div class="logoImg">
				<img src="{{ asset('images/radix_logo.png') }}">
			</div>
			<div class="navs" id='admin-nav'>
				<ul class="nav-stacked">
					<li>
						<a href="{{url('/franchise')}}" class="{{Route::current()->getName()=='franchise'?'active':''}}"><i class="active"></i> Dashboard</a>
					</li>
					@if(auth()->user()->is_approved)
					<li>
						<a href="{{url('/student-enquiry')}}" class="{{Route::current()->getName()=='student-enquiry'?'active':''}}"><i class=""></i> Student Enquiry</a>
					</li>
					<li>
						<a href="{{url('/student-request-demo')}}" class="{{Route::current()->getName()=='student-request-demo'?'active':''}}"><i class=""></i> Request Demo</a>
					</li>
					<li>
						<a href="{{url('/student-registration-form')}}" class="{{Route::current()->getName()=='student-registration-form'?'active':''}}"><i class=""></i> Fee Receipt</a>
					</li>
					<!-- <li>
						<a href="{{url('/students-lead-list')}}" class="{{Route::current()->getName()=='students-lead-list'?'active':''}}"><i class=""></i> Students Lead List</a>
					</li> -->
					<li>
						<a href="{{url('/students-list')}}" class="{{Route::current()->getName()=='students-list'?'active':''}}"><i class=""></i> Students List</a>
					</li>
					<li>
						<a href="{{url('/request-batch')}}" class="{{Route::current()->getName()=='request-batch'?'active':''}}"><i class=""></i> Request Batch </a>
					</li>
					<li>
						<a href="{{url('/batch-list')}}" class="{{Route::current()->getName()=='batch-list'?'active':''}}"><i class=""></i> Batch List </a>
					</li>
					<li>
						<a href="{{url('/report-form')}}" class="{{Route::current()->getName()=='report-form'?'active':''}}"><i class=""></i> Reports </a>
					</li>
					@endif

				</ul>
			</div>
			<div class="admin-profile dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	<div class="profileImg">
				    		<img src="{{ asset('images/avtar.png') }}" alt="avtar">
			    		</div>
			    		<div class="usr-name">{{auth()->user()->name}}</div>
				    	<div class="caret"></div>
			  	</button>
				<ul class="dropdown-menu">
					<li class="nav-item dropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </a>
	                </li>
				    <li class="nav-item dropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
	                </li>
				</ul>
			</div>
		</aside>
	    	<div id="app" class="admin-content">
			 <div class="loading"></div>
			@yield('pageheader')
		        <main class="py-4">
						@if (session('success'))
							<div class="alert alert-success text-center messageBox">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Success!</strong> {{session('success')}}
							</div>
						@endif
						@if (session('info'))
							<div class="alert alert-info text-center messageBox">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Info!</strong> {{session('info')}}
							</div>
						@endif
						@if (session('warning'))
							<div class="alert alert-warning text-center messageBox">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Warning!</strong> {{session('warning')}}
							</div>
						@endif
						@if (session('danger'))
							<div class="alert alert-danger text-center messageBox">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Danger!</strong> {{session('danger')}}
							</div>
						@endif
           			@yield('content')
        		</main>
	    	</div>
	</section>
	 <script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
	 <script src="{{ asset('js/radix.js') }}" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function(){
            $(".alert-success,alert-info,.alert-warning,.alert-danger").fadeTo(3500, 2000).slideUp(2000, function(){
                $(".alert-success,alert-info,.alert-warning,.alert-danger").fadeOut(2000);
            });
        });
    </script>
	<!--Dynamic StyleSheets added from a view would be pasted here-->
	@yield('scripts')
</body>
</html>
