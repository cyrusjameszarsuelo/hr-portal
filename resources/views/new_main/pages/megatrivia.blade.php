@extends('main')

@section('title', 'Mega Trivia')

@section('page-title', 'MEGATRIVIA')

@section('content')

<div class="container pl-5" >
	<h6 class="position-relative"><i>Interactive Q & A about the company and its affiliates</i></h6>
	<hr style="border-top: 1px dashed; width: 80%; position: relative;" class="">
	<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> <span>Megatrivia</span></div>

	<br>
</div>

<div class="container-fluid m-0 p-0">
	<div class="row m-0 p-0">
		<div class="col-7 m-0 p-0 mb-5">
			@if($megatrivia)
				<img src="{{$megatrivia->image}}" class="megatrivia-image" alt="business">
			@endif
			<br>
			<br>
			<h4 class="position-relative ml-4">
				<strong><i>Be the first to answer this week's trivia question and win a special prize!</i></strong>
			</h4>
		</div>
		<div class="col-md-5  m-0 p-0 ">
			@if($megatrivia)
			<h3 class="megatrivia-question">{{ html_entity_decode(strip_tags($megatrivia->content)) }}</h3>
			<h1 class="q-question">Q</h1>

			
			
				<form method="POST" action="/submitAnswer">
					@csrf
					<h2 class="a-question">A &nbsp;&nbsp;&nbsp; 
						@if($megatriviaAnswer)
						@php $disabled = 'disabled' @endphp
							<input type="text" name="megatrivia_answer" class="answer" id="userAnswered" onclick="userHasAnswered()">
						@else 
						@php $disabled = '' @endphp
							<input type="text" name="megatrivia_answer" class="answer" id="userAnswered" autocomplete="off">
						@endif
						<input type="submit" {{$disabled}} class="btn btn-primary" />
						
					</h2>
					<input type="hidden" name="user_answer" value="{{$user['contacts']['mail']}}">
					<input type="hidden" name="megatrivia_id" value="{{$megatrivia->id}}">
				</form>
			@endif

			<div class=" position-relative" style="margin: 0.8vw">
				<a href="/megatrivia/all-mega-trivia"><h5>See other <strong>MEGATRIVIA</strong></h5></a>
				{{-- <hr style="width: 5vw; float: left; border: solid 1px #ee3124;"> --}}
			</div>
		</div>
	</div>
</div>

{{-- <div class="highlights-2"></div> --}}



<style>

	body {
		margin: 0;
	}

	input.answer {
		border: 0;
    	-webkit-appearance: none;
    	background: transparent;
    	color: white;
    	width: 27vw;
	}

	.q-question {
		background-color: #ee3124;
		margin-left: -4vw;
		color: white;
		font-size: 3vw;
		margin-top: -22.7vw;
		padding-left:  0.6vw;
	}

	.a-question {
		/*background-color: #000;*/
		background: linear-gradient(90deg, rgb(0 0 0) 9%, rgb(65 65 65) 9%, rgb(175 172 172 / 66%) 102%);
		margin-left: -4vw;
		color: white;
		font-size: 3vw;
		margin-top: 12vw;
		padding-left:  0.6vw;
		position: relative;
	}

	.megatrivia-image {
	  	background: transparent no-repeat center;
	  	background-size: cover;
    	object-fit: cover;
    	object-position: center;
    	width: 100%;
    	height: 22vw;
    	margin-top: 0vw;
	}

	.megatrivia-question {
		margin-top: 0vw;
		background: linear-gradient(177deg, rgb(255 255 255) 1%, rgb(235 235 235) 20%, rgb(181 181 181 / 66%) 45%);
		height: 22vw;
		font-size: 2vw;
		padding: 27px 12vw 27px 27px;
		clip-path: polygon(0% 102%, 28% 130%, 100% 0%, 0% 0%);
		/*display: flex;
		justify-content: center;
		align-content: center;
		flex-direction: column;*/
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
		background: linear-gradient(98deg, rgb(242 242 242) 1%, rgb(242 242 242) 20%, rgb(97 97 97) 210%);
		width: 50vw;
		height: 100vh;
		position: fixed;
		top: 0px;
		left: 50vw;
		clip-path: polygon(-353% 85%, 40% 90%, 100% 40%, 100% -21%);
	}*/

</style>

@endsection

@section('scripts')
	<script src="{{asset('js/megatrivia.js')}}"></script>
	@if ($megatriviaAnswer != null) {
		@if(trim(strtolower($megatriviaAnswer->megatrivia_answer)) == trim(strtolower($megatrivia->answer)) && $megatriviaAnswer->user_answer == $user['contacts']['mail'])
			<script>
				$(document).ready(function() {
				  Swal.fire({
				    position: 'top-end',
				    icon: 'success',
				    title: ' Correct! You won a special prize! Claim it from Justin of CCAB or Joy of HR',
				    showConfirmButton: false,
				    timer: 5000
				  })
				});

				$("#userAnswered").attr("disabled", "disabled");
			</script>
		@endif
	@endif

	@if ($megatriviaAnswerUser != null) {
		@if (trim(strtolower($megatriviaAnswerUser->megatrivia_answer)) != trim(strtolower($megatrivia->answer)) && $megatriviaAnswerUser->user_answer == $user['contacts']['mail'])
		<script>
			$(document).ready(function() {
			  Swal.fire({
			    position: 'top-end',
			    icon: 'error',
			    title: 'Incorrect! Try again next week.',
			    showConfirmButton: false,
			    timer: 5000
			  })
			});

			$("#userAnswered").attr("disabled", "disabled");
		</script>
		@endif
	@endif

	<script>
		function userHasAnswered() {
			Swal.fire({
			    position: 'top-end',
			    icon: 'error',
			    title: 'Sorry, you are unable to answer, someone answered correctly',
			    showConfirmButton: false,
			    timer: 5000
			  });

			$("#userAnswered").attr("disabled", "disabled");
		}
	</script>
@endsection
