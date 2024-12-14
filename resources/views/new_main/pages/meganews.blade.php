@extends('main')

@section('title', 'Meganews')

@section('page-title', 'MEGANEWS')

@section('content')
			 
<div class="container pl-5" >
	<h6 class="position-relative"><i>Latest developments about the company and its affiliates</i></h6>
	<hr style="border-top: 1px dashed; width: 80%; position: relative;" class="">
	{{-- <div class="d-flex align-items-center justify-content-between py-2 px-4"> --}}
		<form method="POST" action="/meganews">
		@csrf
		<div class="row">
			<div class="col-md-8">
				<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> <span>Meganews</span></div>
			</div>
			<div class="col-md-3">
				<select name="date_submit" class="position-relative form-control rounded-0" >
		        	@foreach($meganewsDateGroup as $meganewsDateGroupData)
		        		
		        		
				  		<option {{-- {{\Carbon\Carbon::parse($meganewsDateGroupData->created_at)->format('Y-m') == \Carbon\Carbon::parse($meganews->first()->created_at)->format('Y-m') ? 'selected' : ''}} --}} value="{{ \Carbon\Carbon::parse($meganewsDateGroupData->created_at)->format('Y-m') }}">{{$meganewsDateGroupData->month}} {{$meganewsDateGroupData->year}}</option>
				  	@endforeach
				</select>
			</div>
			<div class="col-md-1">
				<button class="btn btn-primary position-relative"><i class="fa-solid fa-magnifying-glass"></i></button>
			</div>
		</div>
		</form>
		
        
    {{-- </div> --}}
	<br>

	<div class="content" style="position: relative;">
		<div style="margin-bottom: 7vw">

			<div class="row">
				@if($meganews)
					@foreach($meganews as $key => $meganewsData)

					@php
						if(count($meganews) == 2 || count($meganews) == 4) {
							$col = 'col-6';
						} else if (count($meganews) == 3) {
							if ($key < 1) {
								$col = 'col-12';
							} else {
								$col = 'col-6';
							}
						} else if (count($meganews) == 5) {
							if ($key < 2) {
								$col = 'col-6';
							} else {
								$col = 'col-4';
							}
						} else if (count($meganews) == 6) {
								$col = 'col-4';
						} else if (count($meganews) == 7) {
							if ($key < 3) {
								$col = 'col-4';
							} else {
								$col = 'col-3';
							}
						} else if (count($meganews) == 8) {
							$col = 'col-3';
						} else {
							$col = 'col-12';
						}
					@endphp
						<div class="{{$col}}">
							<div class="position-relative overflow-hidden" style="height: 300px;">
								<img class="img-fluid" src="{{ $meganewsData->meganews_image->first() ? $meganewsData->meganews_image->first()->image : '' }}" style="object-fit: cover; width: 100% !important; height: 100%;">
								<div class="overlay">
									<a class="h5 m-0 text-white" href="/meganews/{{$meganewsData->id}}">{{ $meganewsData->title }}</a>
								</div>
							</div>
							<br>
						</div>
					@endforeach
				@endif
			</div>

		</div>
	</div>
</div>

{{-- <div class="highlights-2"></div> --}}



<style>

	@font-face {
		font-family: magistral;
		src: url({{asset('fonts/Magistral-Medium.woff')}});
	}

	body {
		overflow-x: hidden;
	}

	p {
		font-size: 1.4vw;
		color: #000;
	}

	p.content {
		font-size: 1.2vw;
		padding: 0px 1.5vw;
		line-height: 2vw;
	}

	.first-image {
		width: 36vw;
		height: 24vw;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
		z-index: 3;
	}


	.bg-left {
		background: linear-gradient(130deg, rgb(255 255 255) 1%, rgb(235 235 235) 20%, rgb(181 181 181 / 52%) 45%);
		width: 50vw;
		height: 100vh;
		position: fixed;
		top: 0px;
		left: 0px;
		clip-path: polygon(0% 50%, 28% 50%, 81% 0%, 0% 0%);
	}

	.bg-right {
		background: linear-gradient(98deg, rgb(242 242 242) 1%, rgb(242 242 242) 20%, rgb(97 97 97) 210%);
		width: 50vw;
		height: 100vh;
		position: fixed;
		top: 0px;
		left: 50vw;
		clip-path: polygon(-353% 85%, 40% 90%, 100% 40%, 100% -21%);
	}

	.highlights-2 {
		background: #f13a3a;
		width: 112vw;
		height: 7vw;
		position: relative;
		z-index: 3;
		bottom: -11vw;
		clip-path: polygon(44% 50%, 8% 50%, 8% 100%, 41% 100%);
	}
</style>

@endsection
