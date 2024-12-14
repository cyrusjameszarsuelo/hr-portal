@extends('welcome')

@section('title', 'Covid-19')

@section('content')


<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">Covid 19</h2>
    </div>
</div>  
<!-- /End Header -->
     
<!-- Start Breadcrumbs -->
<div class="fables-light-background-color">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Covid-19</li>
          </ol>
        </nav>
         
    </div>
</div>
<!-- /End Breadcrumbs -->
<img src="{{ asset ('img/covid-19/covidheader.png')}}" alt="" style="width: 100vw;">
<!-- Start page content -->  
    <div class="container">

        <div class="row">
            <div class="col-md-6 mt-5">

                <iframe
                href="{{asset('img/covid-19/HLD. COVID-19 Protocols. 2022 01 10.pdf')}}" target="_blank"
                    src="{{asset('img/covid-19/HLD. COVID-19 Protocols. 2022 01 10.pdf')}}"
                    frameBorder="0"
                    scrolling="auto"
                    height="650px"
                    width="100%"
                    frameborder="no"
                    overflow="hidden"
                ></iframe>
                    
                {{-- <embed src="{{asset('img/covid-19/HLD. COVID-19 Protocols. 2022 01 10.pdf')}}" width="100%" height="800px" /> --}}

            </div>
            <div class="col-md-6">
                
                <div class="row my-3 my-md-5">
                    <div class="col-12 col-6 col-md-4 wow fadeIn mb-4 mb-md-0" data-wow-delay=".3s">
                        <img src="{{asset('img/covid-19/covidimg6.png')}}" alt="" class="w-100">
                    </div>
                    <div class="col-12 col-6 col-md-4 wow fadeIn mb-4 mb-md-0" data-wow-delay=".6s">
                        <img src="{{asset('img/covid-19/covidimg2.png')}}" alt="" class="w-100">
                    </div>
                    <div class="col-12 col-6 col-md-4 wow fadeIn" data-wow-delay=".9s">
                        <img src="{{asset('img/covid-19/covidimg3.png')}}" alt="" class="w-100">
                    </div>
                    <div class="col-12 col-sm-6 col-md-8 mt-4 wow fadeIn" data-wow-delay="1.2s">
                        <div class="position-relative"> 
                              <img src="{{asset('img/covid-19/covidimg1.png')}}" alt="" class="w-100">
                        </div>
                        
                    </div>
                    <div class="col-12 col-sm-4 wow fadeIn" data-wow-delay="1.5s">  
                           <div class="mt-4">
                               <img src="{{asset('img/covid-19/covidimg4.png')}}" alt="" class="w-100"> 
                           </div>
                           <div class="mt-4">
                               <img src="{{asset('img/covid-19/covidimg5.png')}}" alt="" class="w-100"> 
                           </div>
                     </div>
                </div>

            </div>
        </div>


    </div>
    <br>
    <br>
    <br>
<img src="{{ asset ('img/covid-19/covidfooter.png')}}" alt="" style="width: 100vw;">

      
<!-- /End page content -->

@endsection