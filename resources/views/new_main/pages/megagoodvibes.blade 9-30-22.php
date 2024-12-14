@extends('main')

@section('title', 'Mega Good Vibes')

@section('page-title', 'MEGA GOOD VIBES')

@section('content')



			 
	<div class="container pl-5" style="margin-bottom: 10vw">
		<hr style="border-top: 1px dashed; width: 80%; position: relative;">
		<br>
		<br>

		<div class="content" style="position: relative; padding-bottom: 8vw;">
			<div class="container">
				<div class="row">

					<div class="col-md-3">
						@if($megagoodvibes->first())
							<div class="quote first-item">
								<p class="text-white ">
										{!!$megagoodvibes->first()->content!!}
								</p>
							</div>
						@endif
						@foreach($megagoodvibes as $key => $megagoodvibesData)
							<div class="quote hide-items items-{{$key}}" hidden>
								<p class="text-white ">
									{!!$megagoodvibesData->content!!}
								</p>
							</div>
						@endforeach
					</div>

					<div class="col-md-9">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
							@foreach($megagoodvibes as $key => $megagoodvibesData)
						    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
							@endforeach
						  </ol>
						  <div class="carousel-inner">
							@foreach($megagoodvibes as $key => $megagoodvibesData)
						    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
						      <div class="position-relative"> 
					                  <img src="{{asset($megagoodvibesData->thumbnail)}}" alt="" style="width: 100%">
					                  <div class="demo-gallery-poster ">
					                    <a data-fancybox="" href="{{$megagoodvibesData->file}}">
					                       <img src="assets/custom/images/play-button.png" alt="play button" class="img-fluid">
					                   </a> 
					                 </div> 
					            </div>
						    </div>
							@endforeach
						  </div>

						  <a class="carousel-control-prev" style="margin-left: 11vw;" href="#carouselExampleControls" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>

						  <a class="carousel-control-next" style="margin-right: 11vw;" href="#carouselExampleControls" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

    <style>

    	body {
    		overflow-x: hidden;
    	}

    	p {
    		font-size: 1.4vw;
    		color: #000;
    	}

    	.right-margin {
    		margin-left: -2vw;
    		margin-right: -8vw;
    	}

    	.quote {
		    background-color: gray;
			    color: white;
			    /* padding: 19px; */
			    margin-left: -20vw;
			    padding-left: 10vw;
			    padding: 20px 20px 20px 13vw;
			    margin-right: -30px;
    	}

        .image-bg-gray {

		    width: 100%;
		    height: 100%;
		    /* transform: scale(1.2); */
		    background-color: #c3c3c3;
		    clip-path: polygon(53% 30%, 26% 100%, 81% 100%, 100% 35%);
		    margin-left: 20%;
		    margin-top: -40vw;
		    position: fixed;
		    background-position: center;
		    background-size: cover;
		    background-repeat: no-repeat;
        }


        .bg-left {
        	background: linear-gradient(132deg, rgb(255 255 255) 28%, rgb(235 235 235) 46%, rgb(181 181 181 / 79%) 54%);
		    width: 50vw;
		    height: 100vh;
		    position: fixed;
		    top: 0px;
		    left: 0px;
		    clip-path: polygon(0% 100%, 59% 87%, 100% 40%, 1% 28%);
        }

        /*.bg-right {
        	background: linear-gradient(355deg, rgb(242 242 242) 1%, rgb(242 242 242) 20%, rgb(97 97 97) 210%);
		    width: 100vw;
		    height: 100vh;
		    position: fixed;
		    top: 0px;
		    left: 23vw;
		    background-image: url(http://cdn.cnn.com/cnnnext/dam/assets/200310023921-dubai-buildings-skyline.jpg);
		    filter: blur(30px);
		    background-position: center;
		    clip-path: polygon(31% 30%, -3% 90%, 99% 82%, 110% 38%);
        }*/

        
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