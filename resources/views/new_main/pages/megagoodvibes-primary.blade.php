@extends('main')

@section('title', 'MegaGood Vibes')

@section('page-title', 'MEGAGOOD VIBES')

@section('content')


<div class="container pl-5" style="margin-bottom: 10vw">
	<h6 class="position-relative"><i>Feel good videos of employees on talent, hobbies and interests</i></h6>
	<hr style="border-top: 1px dashed; width: 80%; position: relative;">
	<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> <span>Mega Good Vibes</span></div>
	<br>
	<br>


	<h3 class="position-relative text-center">
		<i>
		Mahilig ka bang mag Tiktok, mag Reels o mag record ng talent and fun videos?
		<br>
		<br>
		It's your time to shine, KaMegawide! MegaGood Vibes is the best platform to upload these videos!
		<br>
		<br>
		More details soon!
		</i>
	</h3>
	<br>
	<br>
	<br>

	<div class="content" style="position: relative;">
		<!-- News With Sidebar Start -->
		<div class="py-3">
			<div class="row">

				<div class="fables-blog-slider py-4 py-lg-5 "> 
					<div class="container">
						<h2 class="fables-main-text-color text-center mt-lg-4 mb-4 mb-lg-5 font-26 bold-font">Sample Videos</h2> 
						<div class="owl-carousel owl-theme nav-slider">

							@foreach($megagoodvibesAll as $key => $megagoodvibesData)
							<div class="text-center"> 
								<div class="image-container zoomOut-effect">
									<a href="/mega-good-vibes/{{$megagoodvibesData->id}}"><img src="{{$megagoodvibesData->thumbnail}}" alt="" class="w-100"></a> 
								</div> 
								<h2 class="font-18 semi-font mt-3 mb-2"><a href="/mega-good-vibes/{{$megagoodvibesData->id}}" class="fables-main-text-color fables-second-hover-color">
								{{ \Carbon\Carbon::parse($megagoodvibesData->created_at)->format('F d, Y') }}</a></h2>
								<p class="fables-fifth-text-color font-14">
									{{str_limit(strip_tags($megagoodvibesData->content), 30, '...')}}
								</p>   
							</div> 
							@endforeach
							
						</div> 
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
		font-size: 1vw;
		color: #000;
	}

	.right-margin {
		margin-left: -2vw;
		margin-right: -8vw;
	}

	.icons-vid {
		font-size: 1.3vw;
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



@endsection

@section('scripts')
<script src="{{asset('js/megagoodvibes.js')}}"></script>
@endsection