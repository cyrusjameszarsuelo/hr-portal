@extends('main')

@section('title', 'Our Company')

@section('page-title', 'OUR COMPANY')

@section('content')
			 
		<div class="container pl-5">
			<div style="z-index: 5; position: relative; "><a href="/home"><i class="fa fa-home"></i></a> <span > <i class="fa-solid fa-caret-right"></i> </span> Our Company </div>
			<hr style="border-top: 1px dashed; width: 80%; position: relative; " class="">
			<br>

				<div class="content" style="position: relative;  margin-bottom: 5vw;">
					<div class="container">

						<h1 class="who-we-are">
							WHO <br> WE <br> ARE
						</h1>

						<h1 class="what-we-do">
							WHAT <br> WE <br> DO
						</h1>

						<div class="row">
							<div class="col-md-6">
								<img class="our-company-image" src="{{asset('img/megawide-building.png')}}" alt="">
							</div>
							<div class="col-md-6">
								{{-- <h3 style="font-family: gotham;">
									WHO WE ARE
								</h3> --}}
								<p style="font-family: gotham-medium; font-size: 1.1vw; padding-bottom: 2.6vw;">
									We are one of the most innovative infrastructure conglomerates in the country. Our portfolio includes Engineering, Procurement, and Construction (EPC) and Transport-related infrastructure.
									{{-- <a href="#what-we-do"><b class="fables-second-text-color">READ MORE</b></a> --}}
								</p>
								<ul>
									<li><a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">CONSTRUCTION</a></li>
									<li><a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">PRECAST AND CONSTRUCTION SOLUTIONS</a></li>
									<li><a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">AIRPORT</a></li>
									<li><a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">LANDPORT</a></li>
									<li><a href="https://megawide.com.ph/our-business/#engineering-procurement-construction">INFRASTRUCTURE MODERNIZATION</a></li>
								</ul>
								<a href="/our-company/details" class="float-right" style="font-family: gotham"><b class="fables-second-text-color"> <i class="fa fa-caret-right font-20"></i> READ MORE</b></a>
							</div>
						</div>

						<br>
						<br>
						<br>
				</div>
		</div>

	

    <style>

    	@font-face {
        font-family: gotham-medium;
        src: url({{asset('fonts/GothamMedium.ttf')}});
      }

    	body {
    		overflow: hidden;
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

    	li {
    		font-family: gotham;
    		list-style: square;
    		font-size: 1.2vw;
    		padding-bottom: 23px;
    	}

    	.who-we-are {
    		position: fixed;
		    z-index: 4;
		    background: #ee3124;
		    width: 9vw;
		    color: white;
		    margin-left: 338px;
		    margin-top: -40px;
		    height: 11vw;
		    text-align: end;
		    font-family: 'gotham-medium';
		    font-size: 2vw;
		    padding: 12px;
    	}

    	.what-we-do {
    		position: fixed;
		    z-index: 4;
		    background: #ee3124;
		    width: 9vw;
		    color: white;
		    margin-left: 338px;
		    margin-top: 8vw;
		    height: 11vw;
		    text-align: end;
		    font-family: 'gotham-medium';
		    font-size: 2vw;
		    padding: 12px;
    	}

    	.separator-row {
    		background-color: #ee3124;;
		    color: white;
		    padding: 20px 20px;
		    margin: 0 -10vw 0 -18vw;
		    clip-path: polygon(0% 100%, 90% 100%, 100% 0%, 0% 0%);
		    position: relative;
  			left: auto;
    	}

    	.title-company {
        background-color: #ee3124;
		    width: 45%;
		    color: white;
		    padding: 5px 0% 5px 15%;
		    margin-left: -7vw;
    	}

    	.title-company-values {
		    background-color: #ee3124;
		    width: 24%;
		    color: white;
		    padding: 5px 0% 5px 10%;
		    margin-left: -7vw;
    	}

    	li.separator {
    		font-size: 17px;
    		font-weight: 500;
    	}

    	.vl-separator {
        border-left: 2px solid white;
		    height: 114%;
		    position: absolute;
		    margin-left: 91%;
		    margin-top: -109px;
    	}

    	.bottom-bg-photo {
    		background-image: url(http://localhost:8000/img/team-megawide.png);
		    background-position: center;
		    background-size: contain;
		    width: 53vw;
		    height: 32vw;
		    position: relative;
		    clip-path: polygon(0% 100%, 100% 100%, 100% 0%, 0% 0%);
		    box-shadow: 38px 39px 63px 148px white inset;
		    margin-top: -36vw;
		    margin-left: 45vw;
		    /* border-radius: 24vw; */
		    background-repeat: no-repeat;
    	}

    	.first-image {
    		width: 100%;
    		height: 97%;
    		background-size: cover;
		    background-repeat: no-repeat;
		    /*position: absolute;*/
		    background-position: center;
    		transform: scale(1.09);
    		right: -3vw;
    		z-index: 3;
    	}

    	.our-company-image {
		    top: 143px;
		    left: 0px;
		    position: fixed;
		    width: 50%;
		    clip-path: polygon(0% 100%, 60% 100%, 95% 0%, 0% 0%);

    	}


        /*.bg-left {
    		background-image: url({{asset('img/megawide-building.png')}});
		    background-position: center;
		    background-size: auto;
		    width: 50vw;
		    height: 47vw;
		    position: absolute;
		    bottom: 0px;
		    left: 0px;
		    clip-path: polygon(0% 100%, 60% 100%, 95% 0%, 0% 0%);
		    background-repeat: no-repeat;
        }*/

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
