<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="{!! asset('admin_assets/img/logo.png') !!}" type="image/x-icon" />
<title>HRMS Reset Password</title>
<!-- Bootstrap Core CSS -->
<link href="{!! asset('admin_assets/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<!-- animation CSS -->
<link href="{!! asset('admin_assets/css/animate.css') !!}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{!! asset('admin_assets/css/style.css') !!}" rel="stylesheet">
<!-- color CSS -->
<link href="{!! asset('admin_assets/css/colors/default.css') !!}" id="theme"  rel="stylesheet">

<style>
	.white-box {
		background: #E8E8E8;
		padding: 25px;
		margin-bottom: 30px;
		box-shadow: 1px 1px 8px;
		margin: 20% auto;
	}
</style>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
    <div class="container">
		<div class="row">
			<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="white-box">
						<h3 class="box-title m-b-0">Enter  Password</h3>
						<div class="login-logo" style="text-align: center">
							<img src="{!! asset('admin_assets/img/logo.png') !!}"  style="margin-top: 25px;height:100px;"/>
						</div>
						{!! Form::open(['route' => 'reset.password.enter','class' => 'form-horizontal new-lg-form','id' => 'loginform']) !!}
                        <input type="hidden" name="token" value="{{ request()->token }}">
                        <input type="hidden" name="email" value="{{ request()->email }}">
							@if($errors->any())
								<div class="alert alert-danger alert-dismissible" role="alert">
									@foreach($errors->all() as $error)
										<strong>{!! $error !!}</strong><br>
									@endforeach
								</div>
							@endif

							@if(session()->has('error'))
								<div class="alert alert-danger">
									<p>{!! session()->get('error') !!}</p>
								</div>
							@endif

							@if(session()->has('success'))
								<div class="alert alert-success">
									<p>{!! session()->get('success') !!}</p>
								</div>
							@endif
  
                            <div class="form-group ">
                                <div class="col-xs-12">
                                  <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                </div>
                              </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                  <input class="form-control" name="password_confirmation" type="password" required="" placeholder="Confirm Password">
                                </div>
                              </div>
                            
							<div class="form-group text-center m-t-20">
							  <div class="col-xs-12">
								<button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
							  </div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			<div class="col-md-4"></div>
		</div>
	</div>
                  
  
  
</section>
<!-- jQuery -->
<script src="{!! asset('admin_assets/plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{!! asset('admin_assets/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{!! asset('admin_assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}"></script>

<!--slimscroll JavaScript -->
<script src="{!! asset('admin_assets/js/jquery.slimscroll.js') !!}"></script>
<!--Wave Effects -->
<script src="{!! asset('admin_assets/js/waves.js') !!}"></script>
<!-- Custom Theme JavaScript -->
<script src="{!! asset('admin_assets/js/custom.min.js') !!}"></script>

	{{-- <script>
        $(function () {
            $(document).on("focus", "#backToLogin", function () {
                $( "#recoverform" ).fadeOut( "slow", function() {
                    $('#loginform').css('display','block');

                });
            });

            $(".alert-success").delay(1000).fadeOut("slow");
        });
	</script> --}}
</body>
</html>
