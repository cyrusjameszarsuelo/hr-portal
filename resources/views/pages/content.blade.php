@extends('welcome')

@section('title', 'Content')

@section('content')
	<!-- Start Header -->
    <div class="fables-header fables-after-overlay bg-rules">
        <div class="container"> 
            <h2 class="fables-page-title fables-second-border-color wow fadeInLeft" data-wow-duration="1.5s">{{ $meganewsSingleContent->title }}</h2>
        </div>
    </div>  
    <!-- /End Header -->

    <!-- Start Breadcrumbs -->
    <div class="fables-light-background-color">
        <div class="container"> 
            <nav aria-label="breadcrumb">
                <ol class="fables-breadcrumb breadcrumb px-0 py-3">
                    <li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
                    <li class="breadcrumb-item " aria-current="page">Content</li>
                    <li class="breadcrumb-item active">{{ $meganewsSingleContent->content_type->type }}</li>
                </ol>
            </nav> 
        </div>
    </div>
    <!-- /End Breadcrumbs -->

    <!-- Start page content --> 
    <div class="container"> 
        <div class="my-4 my-lg-4"> 
            <img src="{{ asset ($meganewsSingleContent->image)}}" alt="" class="w-100">
            <br>
            <br>
            <h2 class="font-23 semi-font"><a href="#" class="fables-main-text-color fables-second-hover-color">{{ $meganewsSingleContent->title }}</a></h2>
            <div class="fables-forth-text-color fables-blog-date">                                  
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-10 pt-2">
                        <span class="fables-icondata fables-second-text-color mr-1"></span> 
                        <span class="mr-3"> {{ $meganewsSingleContent->created_at }} </span>
                        {{-- <span class="fables-iconcomment fables-second-text-color mr-1"></span>  --}}
                        {{-- <a href="" class="fables-forth-text-color fables-second-hover-color position-relative z-index">2</a>  --}}
                        <span class="fables-forth-text-color fables-single-tags ml-4">
                            <span class="fables-icontags-light fables-second-text-color"></span> 
                            <a href="#">{{ $meganewsSingleContent->content_type->type }}</a>
                            {{-- <a href="#">JACKETS</a>  --}}
                        </span> 

                    </div>
                    <div class="col-12 col-md-3 col-lg-2 text-right mt-3 mt-md-0 text-center text-md-right">
                        <a class="btn btn-link fables-fifth-border-color fables-forth-hover-backround-color fables-forth-text-color " href= "/editMeganews/{{ $meganewsSingleContent->id }}"></span> Edit Meganews</a>
                    </div>
                </div>

            </div>

            <p class="fables-forth-text-color font-14 my-4">
                {!! $meganewsSingleContent->content !!}
            </p>

            @if($meganewsSingleContent->quote)
            <div class="row">
                <div class="col-sm-10 offset-sm-1">
                    <div class="font-14 fables-main-text-color text-center my-3 italic semi-font"> 
                        <span class="fables-iconquote-left-light mr-3"></span>
                        {!! $meganewsSingleContent->quote !!}
                        <span class="fables-iconquote-right-light ml-3"></span>
                    </div>
                </div>
            </div>
            @endif

        </div>  

        <div class="col-lg-12">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative mb-3 mb-lg-0">
            @if(count($meganewsSingleContent->meganews_image) > 1)
                @foreach($meganewsSingleContent->meganews_image as $mega_image)
                    <div class="position-relative overflow-hidden img-contain image-container zoomIn-effect" style="height: 435px;">
                        <img class="img-fluid h-100" src="{{ $mega_image->image}}" style="object-fit: cover;">
                        <div class="">
                            <div class="mb-1">
                                <a class="text-white" href=""></a>
                                <span class="px-2 text-white"></span>
                                <a class="text-white" href=""></a>
                            </div>
                            <a class="h2 m-0 text-white font-weight-bold" href=""></a>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <br>
        <br>

        <div class="row overflow-hidden">
            <div class="col-12 col-md-4 wow fadeInLeft" data-wow-delay=".8s">
                
                <div class="img-contain image-container zoomIn-effect">
                    <a href="">
                        @if(count($meganewsSingleContent->meganews_image) > 0)
                        <img src="{{ $meganewsSingleContent->meganews_image[0]->image}}" alt="" class="w-100">
                        @else
                        <img src="{{ $meganewsSingleContent->image }}" alt="" class="w-100">
                        @endif
                    </a>
                </div>
                <br>
                <h6 class="fables-second-text-color blog-large-head fables-second-before font-10 semi-font position-relative pl-4">
                {!! $meganewsSingleContent->image_title !!}</h6>
            </div>
            <div class="col-12 col-md-7 col-lg-8 wow fadeInRight" data-wow-delay=".8s">
                <p class="fables-forth-text-color font-14">
                    {!! $meganewsSingleContent->content2 !!}
                </p>

                @if($meganewsSingleContent->quote2)
                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="font-14 fables-main-text-color text-center my-3 italic semi-font"> 
                            <span class="fables-iconquote-left-light mr-3"></span>
                            {!! $meganewsSingleContent->quote2 !!}
                            <span class="fables-iconquote-right-light ml-3"></span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="my-4 my-lg-5">
            <h2 class="fables-main-text-color text-center underline my-4 font-25 semi-font mb-5">Related Articles</h2>  
            <div class="owl-carousel owl-theme fables-main-dots carousel-items-4 mb-0 mb-lg-5">
                @foreach($meganews as $meganewsData)

                    <div> 
                        <div class="image-container zoomIn-effect">
                            <a href="#"><img src="{{ $meganewsData->image}}" alt="" class="w-100"></a> 
                        </div>

                        <div class="fables-forth-text-color font-14  my-2">                                  
                            <span class="fables-icondata fables-second-text-color mr-1"></span> 
                            <span class="mr-3">{{$meganewsData->created_at}}</span>
                            {{-- <span class="fables-iconcomment fables-second-text-color mr-1"></span>  --}}
                            {{-- <a href="" class="fables-forth-text-color fables-second-hover-color position-relative z-index">2</a>  --}}
                        </div>
                        <h2 class="font-18 semi-font"><a href="{{ url('content/'.$meganewsData->id) }}" class="fables-main-text-color fables-second-hover-color">{{ $meganewsData->title }}</a></h2> 
                        <a href="{{ url('content/'.$meganewsData->id) }}" class="btn fables-second-text-color fables-main-hover-color font-14 p-0 my-3">Read More <i class="fas fa-chevron-right"></i></a>  
                    </div>

                @endforeach
                
            </div>
        </div>

    </div>  
    <!-- /End page content -->
@endsection