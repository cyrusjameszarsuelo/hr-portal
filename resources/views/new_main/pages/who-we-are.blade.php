@extends('main')

@section('title', 'Who We Are')

@section('page-title', 'WHO WE ARE')

@section('content')
			 
		<div class="container pl-5" >
			<hr style="border-top: 1px dashed; width: 80%; position: relative;" class="">
			<br>

				<div class="content" style="position: relative;">
					<div class="container">

						<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6">
								
							</div>
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
    		width: 100%;
    		height: 100%;
    		background-size: cover;
		    background-repeat: no-repeat;
		    /*position: absolute;*/
		    background-position: center;
    		transform: scale(1.09);
    		right: -3vw;
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

        /*.bg-right {
        	background: linear-gradient(98deg, rgb(242 242 242) 1%, rgb(242 242 242) 20%, rgb(97 97 97) 210%);
		    width: 50vw;
		    height: 100vh;
		    position: fixed;
		    top: 0px;
		    left: 50vw;
		    clip-path: polygon(-353% 85%, 40% 90%, 100% 40%, 100% -21%);
        }*/

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

@endsection
