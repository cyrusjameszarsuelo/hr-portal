<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::asset ('lib/easing/easing.min.js') }}"></script>
<script src="{{ URL::asset ('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset ('js/main.js') }}"></script>
<script src="{{ URL::asset ('assets/vendor/loadscreen/js/ju-loading-screen.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/jquery-circle-progress/circle-progress.min.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/popper/popper.min.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/jQuery.countdown-master/jquery.countdown.min.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/WOW-master/dist/wow.min.js')}}"></script>
<script src="{{ URL::asset ('assets/custom/js/custom.js')}}"></script>

<script src="{{ URL::asset ('assets/vendor/timeline/timeline.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/timeline/jquery.timelify.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/timeline/modernizr.js')}}"></script>

<script src="{{ URL::asset ('assets/vendor/fancybox-master/jquery.fancybox.min.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/portfolio-filter-gallery/jquery.isotope.min.js')}}"></script>
<script src="{{ URL::asset ('assets/vendor/portfolio-filter-gallery/portfolio-filter-gallery.js')}}"></script>
<script src="{{ asset ('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>



<script>
	$( document ).ready(function() {
	    new WOW().init()
	});	
</script>

<script>
	
	$("#survey_page").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#survey_page").offset().top},
	        'slow');
	});

	$("#community_board_page").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#community_board_page").offset().top},
	        'slow');
	});

	$("#forum_page").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#forum_page").offset().top},
	        'slow');
	});

	$("#blogs_page").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#blogs_page").offset().top},
	        'slow');
	});

	$("#hr_templates").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#hr_templates").offset().top},
	        'slow');
	});

	$("#employee_services").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#employee_services").offset().top},
	        'slow');
	});

	$("#did_you_know").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#did_you_know").offset().top},
	        'slow');
	});

	$("#demographics_page").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#demographics_page").offset().top},
	        'slow');
	});

	$("#megawide_university").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#megawide_university").offset().top},
	        'slow');
	});

	// $("#faqs").click(function() {
	//     $('html,body').animate({
	//         scrollTop: $("#faqs").offset().top},
	//         'slow');
	// });

	$("#general_announcement").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#general_announcement").offset().top},
	        'slow');
	});
</script>




@yield('scripts')
