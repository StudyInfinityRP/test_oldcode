<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ __('Warning !') }}</title>
	<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
</head>
<body>


	<br>
	<div class="container">
		<h3 class="text-danger"><i class="fa fa-warning"></i> {{ __('Warning') }}</h3>
		<hr>
		<p class="text-info">{{ __('You tried to update the domain which is invalid !') }} 
		<h4>{{ __('You can use this project only in single domain for multiple domain please check License standard') }}.</h4>
		
		<div class="text-muted text-center">&copy; {{ date('Y') }} | {{ __('All rights reserved') }} | {{ config('app.name') }}</div>
	</div>
	<!-- jQuery 3.5.4 -->
	<script src="{{url('js/jquery.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		  }, false);
		})();
	</script>
</body>
</html>