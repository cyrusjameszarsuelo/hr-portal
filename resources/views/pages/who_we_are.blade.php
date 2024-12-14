@extends('welcome')

@section('title', 'Who We Are')

@section('content')


   <!-- Start Header -->
   <div class="fables-header fables-after-overlay bg-rules">
       <div class="container"> 
            <h2 class="fables-page-title fables-second-border-color wow fadeInLeft" data-wow-duration="1.5s">WHO WE ARE</h2>
       </div>
   </div>  
   <!-- /End Header -->
        
   <!-- Start Breadcrumbs -->
   <div class="fables-light-gary-background">
       <div class="container"> 
           <nav aria-label="breadcrumb">
             <ol class="fables-breadcrumb breadcrumb px-0 py-3">
               <li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Who We Are</li>
             </ol>
           </nav> 
       </div>
   </div>
   <!-- /End Breadcrumbs -->

   <div class="fables-bussiness-section bg-rules">
    <div class="container-fluid">
        <div class="row overflow-hidden">  
            <div class=" py-3 py-lg-0 col-sm-6 offset-sm-6 p-sm-0"> 
                <div class="fables-bussiness-caption p-4" >
                    {{-- <h2 class="fables-second-text-color my-0 font-30 font-weight-bold position-relative z-index wow fadeInRight" data-wow-duration="2s">Our business experties Provide you the great value</h2> --}}
                    <div class="fables-forth-text-color position-relative z-index  mt-4 mb-5  wow fadeInRight" data-wow-duration="2s">
                        <strong>Megawide</strong> is one of the country’s most progressive infrastructure conglomerates with a decisive portfolio in Engineering, Procurement, and Construction (EPC), Airport Infrastructure, Progressive Property Development, and Renewable Energy.
                        <br>
                        <br>
                        It’s revolutionary construction and engineering solutions continue to shape the industry by integrating its comprehensive EPC capabilities with innovative construction support technologies such as precast, formwork systems, and concrete batching.
                        <br>
                        <br>
                        <strong>Megawide</strong> is a strong partner of the Philippine government through the Public-Private Partnership (PPP) program, with projects such as the Mactan-Cebu International Airport, the Parañaque integrated Terminal Exchange, and the PPP for School Infrastructure Project Phases 1 and 2.
                    </div>
                </div>
            </div>
      </div>
    </div>
</div>


<div class="container">
            <div class="my-4 my-md-5 overflow-hidden">
               
                <div class="text-center mb-5 wow fadeInDown" data-wow-delay="1s">
                    <h2 class="fables-second-text-color mt-3 font-30 font-weight-bold text-center">Our Values</h2> 
                </div> 
                    
                <div class="row">
                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".2s">
                        <div class="fables-about-icon-style"> 
                            <span class="fables-iconmobileApp-icon fables-second-text-color fa-3x"></span>
                            <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Excellence</h2>
                            <span class="fables-title-border fables-second-background-color"></span>
                            <div class="fables-forth-text-color mt-3 font-14">
                                We consistently try to do well in whatever we take on, great or small, because we owe it to ourselves to try and become better in what we do.  
                            </div>

                        </div>
                    </div>  
                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".4s">
                       <div class="fables-about-icon-style">
                           <span class="fables-icondevelopment-icon fables-second-text-color fa-3x"></span>
                           <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Innovation</h2>
                           <span class="fables-title-border fables-second-background-color"></span>
                           <div class="fables-forth-text-color mt-3 font-14">
                                we do not fear change but embrace it. Taking the chance to reinvent ourselves and our industry. We keep ourselves open to new ideas and fresh perspectives and look for better ways to deliver our output.   
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".6s">
                       <div class="fables-about-icon-style"> 
                            <span class="fables-iconwebDesign-icon fables-second-text-color fa-3x"></span>
                           <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Teamwork</h2>
                           <span class="fables-title-border fables-second-background-color"></span>
                            <div class="fables-forth-text-color mt-3 font-14">
                                e are all on the same team, driven by the same purpose. We help fuel each other’s ideal, support each other’s efforts, and trust each other instead of competing against one another.
                            </div>
                        </div> 
                    </div>
                </div>

                <br>
                <br>
                <br>

                <div class="row">
                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".8s">
                        <div class="fables-about-icon-style"> 
                            <span class="fables-iconmobileApp-icon fables-second-text-color fa-3x"></span>
                            <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Integrity</h2>
                            <span class="fables-title-border fables-second-background-color"></span>
                            <div class="fables-forth-text-color mt-3 font-14">
                                We treat our colleagues and partners with honesty and respect as we strive to be good people guided by our own conscience and malasakit.  
                            </div>

                        </div>
                    </div>  
                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay="1s">
                       <div class="fables-about-icon-style">
                           <span class="fables-icondevelopment-icon fables-second-text-color fa-3x"></span>
                           <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Malasakit</h2>
                           <span class="fables-title-border fables-second-background-color"></span>
                           <div class="fables-forth-text-color mt-3 font-14">
                                We are moved to action by the people and ideas that we care deeply about, such as our families, colleagues, and our desire for a better life for ourselves and our fellow Filipinos.
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay="1.2s">
                       <div class="fables-about-icon-style"> 
                            <span class="fables-iconwebDesign-icon fables-second-text-color fa-3x"></span>
                           <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Community</h2>
                           <span class="fables-title-border fables-second-background-color"></span>
                            <div class="fables-forth-text-color mt-3 font-14">
                                Our actions affect the communities that we work with, and so we partner with them to ensure that we can leave lasting positive social impact through our projects.
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
       </div>
      <br>
      <br>
   <!-- Start page content --> 
   <div class="container"> 
      
      <div class="row overflow-hidden"> 
         <div class="col-12 col-md-6">
            <div class="image-container translate-effect-right">
               <img src="https://megawide.com.ph/wp-content/uploads/2020/12/equipment-and-transportation-1.jpg" alt="Fables Template" class="img-fluid">
            </div>
         </div>
         <div class="col-12 col-md-6 mt-4 mt-md-0">
            <span class="fables-iconrocket-icon fables-second-text-color fa-3x"></span>
            <h2 class="font-30 font-weight-bold fables-second-text-color my-4 d-inline-block d-lg-block wow fadeInRight" data-wow-duration="1.5s">Our Mission</h2>
            <div class="fables-vision-detail fables-forth-text-color wow fadeInRight" data-wow-duration="1.5s">
               We will be at the forefront of building a First-World Philippines through engineering excellence and innovation
            </div>
            <br>
            <br>
            <br>
            <span class="fables-iconvision-icon fables-second-text-color fa-4x"></span>
            <h2 class="font-30 font-weight-bold fables-second-text-color my-4 d-inline-block d-lg-block wow fadeInRight" data-wow-duration="1.5s">Our Vision</h2>
            <div class="fables-vision-detail fables-forth-text-color wow fadeInRight" data-wow-duration="1.5s">
               We will be a First-World Philippines
            </div>
         </div>
      </div>

   </div>

   <div class="fables-counter-section fables-after-overlay my-3 my-md-5 pt-4 pb-0 py-md-5 bg-rules">
      <div class="container">
         <div class="row">
            <div class="col-6 col-md-4">
                <div class="fables-counter">
                    <div class="fables-about-icon-style icon-rotate"> 
                        <i class="fa-solid fa-building  fables-second-text-color fa-3x icon"></i>
                        <a href="https://megawide.com.ph/our-business/" target="_blank"><h2 class="fables-second-text-color text-white fables-about-icon-head mb-2 font-18 semi-font">Our Business</h2></a>
                    </div>
               </div>
            </div>
            <div class="col-6 col-md-4">
               <div class="fables-counter">
                  <div class="fables-about-icon-style icon-rotate"> 
                     <i class="fa-solid fa-people-group  fables-second-text-color fa-3x icon"></i>
                     <a href="https://megawide.com.ph/about-us/management-team/" target="_blank"><h2 class="fables-second-text-color text-white fables-about-icon-head mb-2 font-18 semi-font">Our Leaders</h2></a>
                 </div>
               </div>
            </div>
            <div class="col-6 col-md-4">
               <div class="fables-counter">
                    <div class="fables-about-icon-style icon-rotate"> 
                        <i class="fa-solid fa-trophy  fables-second-text-color fa-3x icon"></i>
                        <a href="https://megawide.com.ph/wp-content/uploads/2021/03/milestones-2020-scaled.jpg" target="_blank"><h2 class="fables-second-text-color text-white fables-about-icon-head mb-2 font-18 semi-font">Our Milestones</h2></a>
                    </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="container-fluid"> 
      <div class="row overflow-hidden">
         <div class="col-12 col-md-12">
            <div class="position-relative"> 
                  <img src="{{asset('img/bg-image-for-about.jpg')}}" alt="" class="w-100">
                  <div class="demo-gallery-poster ">
                    <a data-fancybox href="{{URL::asset('img/yt-vid.mp4')}}">
                       <img src="assets/custom/images/play-button.png" alt="play button" class="img-fluid">
                   </a> 
                 </div> 
            </div> 
         </div>
         
      </div> 
   </div>    
</div> 
   <!-- /End page content -->

<style>
    .icon-rotate > i.icon  {
      transition: transform .4s ease-in-out;
      background: none;
    }
    .icon-rotate > i.icon:hover {
      transform: rotate(20deg);
    }
</style>

@endsection