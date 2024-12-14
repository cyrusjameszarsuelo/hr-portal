@extends('welcome')

@section('title', 'Who We Are')

@section('content')



	{{-- 	<div class="background background-filter">
		  <h1 class="u-non-blurred">Who We Are</h1>
		</div> --}}

		<div class="container-fluid py-3">
			<div class="row">
				<div class="col-md-5">
						<img src="https://images.pexels.com/photos/3183172/pexels-photo-3183172.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" style="width: 70%; float: right;">
				</div>
				<div class="offset-md-1 col-md-5 align-self-center ">
					<div class="text-center">
						<h1 style="color: #ee3124">WHO WE ARE</h1>
					</div>
					<hr>
					<span class="about-us">
						<strong>Megawide</strong> is one of the country’s most progressive infrastructure conglomerates with a decisive portfolio in Engineering, Procurement, and Construction (EPC), Airport Infrastructure, Progressive Property Development, and Renewable Energy.
						<br>
						<br>
						It’s revolutionary construction and engineering solutions continue to shape the industry by integrating its comprehensive EPC capabilities with innovative construction support technologies such as precast, formwork systems, and concrete batching.
						<br>
						<br>
						<strong>Megawide</strong> is a strong partner of the Philippine government through the Public-Private Partnership (PPP) program, with projects such as the Mactan-Cebu International Airport, the Parañaque integrated Terminal Exchange, and the PPP for School Infrastructure Project Phases 1 and 2.
					</span>
					<hr>

				</div>
			</div>

        </div>

        

        

         <div class="" style="background-color: #efefef; padding-top: 80px">
            <div class="container">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-3 col-sm-3 col-xs-3 card-mandv wow slideInLeft">
                                 <div class="icon"><i class="material-icons md-36">track_changes</i></div>
                                 <p class="title">OUR MISSION</p>
                                 <p class="text">We will be at the forefront of building a First-World Philippines through engineering excellence and innovation</p>
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-3 card-mandv wow slideInRight">
                                 <div class="icon"><i class="material-icons md-36">remove_red_eye</i></div>
                                 <p class="title">OUR VISION</p>
                                 <p class="text">We will be a First-World Philippines</p>
                              </div>
                           </div>
                           <br>
                        </div>

                        <div class="col-md-6">
                           <div>
                             <video controls height="250" style="background-color: black; margin-top: 10px; width: 100%;">
                                 <source src="{{URL::asset('img/yt-vid.mp4')}}" type="video/mp4">
                             </video>
                         </div>
                        </div>
                     </div>
                     <br>
                     <br>
                     </div>
                  </div>
               </div>

               <div class="background background-filter">
                  <div class="row">
                     <div class="col-4 hover-link">
                        <a href="https://megawide.com.ph/our-business/">
                           <h3 class="u-non-blurred">
                              <i class="fa-solid fa-building "style="font-size: 50px; padding-bottom: 15px"></i>
                              <br>
                              Our Business
                           </h3>
                        </a>
                     </div>
                     <div class="col-4 hover-link">
                        <a href="https://megawide.com.ph/about-us/management-team">
                           <h3 class="u-non-blurred">
                              <i class="fa-solid fa-people-group"  style="font-size: 50px; padding-bottom: 15px"></i>
                              <br>
                              Our Leaders
                           </h3>
                        </a>
                     </div>
                     <div class="col-4 hover-link">
                        <a href="https://megawide.com.ph/wp-content/uploads/2021/03/milestones-2020-scaled.jpg">
                           <h3 class="u-non-blurred">
                              <i class="fa-solid fa-bullseye"  style="font-size: 50px; padding-bottom: 15px"></i>
                              <br>
                              Our Milestones
                           </h3>
                        </a>
                     </div>
                  </div>
               </div>

               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                     <br>
                     <br>
                     <div class="text-center">
                        <h1 style="color: #ee3124">OUR VALUES</h1>
                     </div>
                     <br>

                     <div class="row">
                        <div class="col-md-6">
                           <span class="about-us">
                              <strong><h4>EXCELLENCE</h4></strong>We consistently try to do well in whatever we take on, great or small, because we owe it to ourselves to try and become better in what we do.  
                           </span>
                           <br>
                           <br>
                           <br>
                        </div>

                        <div class="col-md-6">
                           <span class="about-us">
                              <strong><h4>INNOVATION</h4></strong> we do not fear change but embrace it. Taking the chance to reinvent ourselves and our industry. We keep ourselves open to new ideas and fresh perspectives and look for better ways to deliver our output.   
                           </span>
                        </div>

                        <div class="col-md-6">
                           <span class="about-us">
                              <strong><h4>TEAMWORK</h4></strong> We are all on the same team, driven by the same purpose. We help fuel each other’s ideal, support each other’s efforts, and trust each other instead of competing against one another.  
                           </span>
                           <br>
                           <br>
                        </div>

                        <div class="col-md-6">
                           <span class="about-us">
                              <strong><h4>INTEGRITY</h4></strong> We treat our colleagues and partners with honesty and respect as we strive to be good people guided by our own conscience and malasakit.  
                           </span>
                        </div>

                        <div class="col-md-6">
                           <span class="about-us">
                              <strong><h4>MALASAKIT</h4></strong> We are moved to action by the people and ideas that we care deeply about, such as our families, colleagues, and our desire for a better life for ourselves and our fellow Filipinos.
                           </span>
                           <br>
                           <br>

                        </div>

                        <div class="col-md-6">
                           <span class="about-us">
                              <strong><h4>COMMUNITY</h4></strong> Our actions affect the communities that we work with, and so we partner with them to ensure that we can leave lasting positive social impact through our projects.
                           </span>
                        </div>
                        
                     </div>
                  </div>
               </div>

            </div>
         </div>


@endsection