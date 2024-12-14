@extends('main')

@section('title', 'Megatrivia')

@section('page-title', 'MEGATRIVIA')

@section('content')

	<div class="container pl-5" style="margin-bottom: 12vw">
		<hr style="border-top: 1px dashed; width: 80%; position: relative;">
		<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> </span> <span><a href="/mega-trivia">Megatrivia</a></span> <span> <i class="fa-solid fa-caret-right"></i> </span> <span>All Megatrivia</span></div>
		<div class="content" style="position: relative; padding-bottom: 10vw;">
			<div class="container mt-5">
				<div class="row">
					@foreach($megatrivia as $megatriviaData)
						<div class="col-12 col-md-4 mb-4 mb-md-5 wow fadeIn" data-wow-delay=".6s">  
							<div class="image-container zoomIn-effect">
								<a href="#"><img src="{{$megatriviaData->image}}" alt=""></a> 
							</div>

							<div class="above-date py-2 py-lg-3 fables-fifth-text-color float-left w-100 d-md-none d-lg-block">
								<div class="float-left font-13">
									<span class="fables-iconcalender"></span> {{ \Carbon\Carbon::parse($megatriviaData->created_at)->format('F d, Y') }}  
								</div> 
							</div>
							<h2 class="font-weight-bold font-20 my-2"><a href="#" class="fables-main-text-color fables-second-hover-color">{{$megatriviaData->title}}</a></h2>

							<p class="fables-forth-text-color font-14">
								{{strip_tags($megatriviaData->content)}}
							</p>
							<br>
							<p class="fables-forth-text-color font-14">
								Answer: <strong>{{ $megatriviaAnswerUser->first() ? $megatriviaData->answer : ''}}</strong>
								<br>
								By: 
								@foreach($megatriviaAnswerUser as $megatriviaAnswerUserData)
									@if(strtolower($megatriviaData->answer) == strtolower($megatriviaAnswerUserData->megatrivia_answer))
										{{$megatriviaAnswerUserData->user_answer}}
									@endif
								@endforeach
							</p>
						</div>
					@endforeach
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