@extends('welcome')

@section('title', 'Holidays')

@section('content')

	<!-- Start page content --> 
	<div class="container">   
		<br>
		<center> <h2>List of Holidays for Year {{ now()->year }}</h2> </center>
		<hr style="width: 10%; border: solid 2px gray;">
		<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> <span>Holidays</span></div>
		<div id="cd-timeline" class="blog-timeline">
			<span class="fables-second-background-color line"></span>

		</div>
		{{-- <div class="text-center my-5">
			<a href="" class="btn fables-second-background-color white-color fables-main-hover-background-color px-5 py-2 white-color-hover">Load More</a>
		</div>  --}}
	</div>
	<!-- /End page content -->


@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{URL::asset('assets/custom/js/holidays.js')}}"></script>
@endsection