@extends('main')

@section('title', 'Community Board')

@section('page-title', 'COMMUNITY BOARD')

@section('content')



			 
	<div class="container pl-5" style="margin-bottom: 12vw">
		<hr style="border-top: 1px dashed; width: 80%; position: relative;">
		<div class="content" style="position: relative; padding-bottom: 10vw;">
			<div class="container">
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