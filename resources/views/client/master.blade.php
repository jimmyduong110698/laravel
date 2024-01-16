<!doctype html>
<html lang="en">

<!-- Mirrored from themetum.com/tf/etherino/etherino-light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 11:28:07 GMT -->
<head>
	@include('client.partials.head')
	<!-- End CSS File  -->  
</head>

<body>
	<input type="hidden" name="check_auth" id="check_auth" value="@php if (Auth::check()) {echo "true";} else {echo "false";} @endphp">
	<button id="clear" style="display: none"></button>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader-wrapper">
			<div class="spinner"></div>
		</div>
	</div>
	<!-- Preloader-end --> 
	
<div class="mim_tm_all_wrap" data-magic-cursor="" data-color="crimson">
 
 	<!-- Start Header -->

  @include('client.partials.header')
	<!-- end header  -->
	<!-- header banner  -->
  {{-- @include('client.partials.banner') --}}
	<!-- end header banner  -->

	@include('client.partials.popup')
  @yield('content')


  @include('client.partials.footer')
	<!-- end footer area -->
	<!-- Back to Top
	============================================= --> 
	<a id="back-to-top" class="rounded-circle" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)">
		<i class='bx bxs-chevron-up'></i>
	</a> 
	
	<!-- CURSOR -->
	<div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
	<!-- /CURSOR -->	
</div>	<!-- Mouse Cursor Animation End --> 	
	
  <!-- Start JS File -->	
  @include('client.partials.script')
   <!-- End JS File --> 
</body>


<!-- Mirrored from themetum.com/tf/etherino/etherino-light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 11:28:49 GMT -->
</html>	

  