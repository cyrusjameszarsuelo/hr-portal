@extends('main')

@section('title', 'Meganews')

@section('page-title', 'MEGANEWS')

@section('content')



			 
	<div class="container pl-5" style="margin-bottom: 12vw">
		<hr style="border-top: 1px dashed; width: 80%; position: relative;">
		<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> </span> <a href="/meganews">Meganews </a></div>
		<div class="content" style="position: relative; padding-bottom: 10vw;">
			<div class="container">
				<div class=" text-center mt-5">
					<h3>News: {{$meganews->title}}</h3>
				</div>
				<br>
				<br>
				<br>
				<div class="row">
					<div class="col-md-6">
						<p>{!!$meganews->content!!}</p>
					</div>
					<div class="col-md-6">
						@if(count($meganews->meganews_image) < 3)
							@foreach($meganews->meganews_image as $imageData)
								<img src="{{$imageData->image}}" alt="" style="width: 100%; margin-bottom: 2vw">
							@endforeach
						@else
							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									@foreach($meganews->meganews_image as $key => $imageData)
									<li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
									@endforeach
								</ol>
								<div class="carousel-inner">
									@foreach($meganews->meganews_image as $key => $imageData)
									<div class="carousel-item {{$key == 0 ? 'active' : ''}}">
										<img src="{{$imageData->image}}" alt="" style="width: 100%; margin-bottom: 2vw">
									</div>

									@endforeach
								</div>

								<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>

								<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

    <style>

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

        
    </style>

    

@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{URL::asset('assets/custom/js/holidays.js')}}"></script>
@endsection