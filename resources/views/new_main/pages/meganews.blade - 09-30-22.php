@extends('main')

@section('title', 'Meganews')

@section('page-title', 'MEGA NEWS')

@section('content')
			 
		<div class="container pl-5" >
			<hr style="border-top: 1px dashed; width: 80%; position: relative;" class="">
			<br>

				<div class="content" style="position: relative;">
					<div class="container">

						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
					    	@foreach($meganews as $key => $meganewsData)
						    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
								@endforeach
						  </ol>
						  <div class="carousel-inner">
					    	@foreach($meganews as $key => $meganewsData)
						    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
						      <div class="row">
										<div class="col-md-5">
											<h1 style="font-size: 2.7vw;">{!!str_limit($meganewsData->title, 40, '...')!!}</h1>
											<br>

											<div class="row">
												<div class="col-md-11">
													<p>

														{{str_limit(strip_tags($meganewsData->content), 200, '...')}}

													</p>
													<br>
													<a href="#content-main" class="float-right"><strong><h5 class="fables-second-text-color">READ MORE</h5></strong></a>
												</div>
											</div>
										</div>

										<div class="col-md-7">
											@if($meganewsData->meganews_image->first())
											<div style="background-image: url({{ $meganewsData->meganews_image->first()->image }});" class="first-image">
											</div>
											@endif
										</div>

									</div>
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

						
						<br>
						<br>
						<br>
						<br>
						<hr style="border-top: 6px solid #ee3124; margin: 11vw 18vw 5vw -88vw;"  id="content-main">
						@if($meganews->first())
						<div class="first-item">
							<h2 class="text-center">{{$meganewsData->first()->title}}</h2>
							<div class="row" style="margin: 3vw 0 8vw 0;">
								<div class="col-md-4">
									<p class="content ">
										{{-- {{strip_tags(html_entity_decode($meganewsData->first()->content))}} --}}
											{!!$meganews->first()->content!!}
									</p>
								</div>

								<div class="offset-md-2 col-md-6 text-right">
										@foreach($meganews->first()->meganews_image as $image)
											<img src="{{$image->image}}" style="width: 100%" alt="">
										@endforeach
								</div>
							</div>
						</div>
						@endif


						@foreach($meganews as $key => $meganewsData)
							<div class="items-{{$key}} hide-items " hidden>
							<h2 class="text-center">{{$meganewsData->title}}</h2>
								<div class="row items-{{$key}}" style="margin: 3vw 0 8vw 0;">
									<div class="col-md-4">
										<p class="content ">
											{{-- {{strip_tags(html_entity_decode($meganewsData->first()->content))}} --}}
											{!!$meganewsData->content!!}
										</p>
									</div>

									<div class="offset-md-2 col-md-6 text-right">
										@foreach($meganewsData->meganews_image as $image)
											<img src="{{$image->image}}" style="width: 100%" alt="">
										@endforeach
									</div>
								</div>
							</div>
						@endforeach

						
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
		    /* background-size: cover; */
		    width: 112vw;
		    height: 7vw;
		    position: relative;
		    z-index: 3;
		    bottom: -11vw;
		    clip-path: polygon(44% 50%, 8% 50%, 8% 100%, 41% 100%);
		}
    </style>

    <script>
    	window.onload = function() {
	    	$('#carouselExampleControls').on('slide.bs.carousel', function (e) {
				  // get the index of the slide
				  var index = $('.carousel-item').index(e.relatedTarget);
				  $('.hide-items').attr('hidden', true);
				  $(".items-" + index).attr('hidden', false);
				  $(".first-item").attr('hidden', true);
				})
	    }
    </script>	

@endsection
