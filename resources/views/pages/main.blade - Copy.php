@extends('welcome')

@section('title', 'Main')

@section('content')
    <!-- Top News Slider Start -->
{{--     <div class="container-fluid py-3">
        <div class="">
            <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
                <div class="d-flex">
                    <img src="img/news-100x100-1.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                    </div>
                </div>
                <div class="d-flex">
                    <img src="img/news-100x100-2.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                    </div>
                </div>
                <div class="d-flex">
                    <img src="img/news-100x100-3.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                    </div>
                </div>
                <div class="d-flex">
                    <img src="img/news-100x100-4.jpg" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="d-flex align-items-center bg-light px-3" style="height: 80px;">
                        <a class="text-secondary font-weight-semi-bold" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Top News Slider End -->


    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <div class="">
            <div class="row">

                <div class="col-lg-6">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                        @foreach($meganews as $meganewsData)

                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="{{ asset ($meganewsData->image)}}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white" href="">{{ $meganewsData->content_type->type }}</a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href="">{{ $meganewsData->created_at }}</a>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="{{ url('content/'.$meganewsData->id) }}">{{ $meganewsData->title }}</a>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row text-center">
                        <div class="container">
                            <div class="my-4 my-md-3 overflow-hidden">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".3s">
                                        <a href="/company-events">
                                            <div class="fables-about-icon-style"> 
                                                <i class="fa-solid fa-calendar-days  fables-second-text-color fa-3x"></i>
                                                <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Company Events </h2>

                                            </div>
                                        </a>
                                    </div>  
                                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".6s">
                                        <a href="/photo-gallery">
                                            <div class="fables-about-icon-style">
                                                <i class="fa-solid fa-photo-film  fables-second-text-color fa-3x"></i>
                                               <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Photo Gallery</h2>
                                            </div>
                                        </a> 
                                    </div>
                                    <div class="col-12 col-md-4 mb-4 mb-md-0 wow fadeInDown" data-wow-delay=".9s">
                                        <a href="#">
                                            <div class="fables-about-icon-style"> 
                                                <i class="fa-solid fa-gifts fables-second-text-color fa-3x"></i>
                                                <h2 class="fables-second-text-color fables-about-icon-head mt-3 mb-2 font-18 semi-font">Holidays </h2>
                                            </div>
                                        </a> 
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="row">
                        <div class="position-relative overflow-hidden mb-3 wow fadeInLeft"  data-wow-delay=".3s" style="height: 80px; margin: 10px 30px; width: 94%;">
                            <img class="img-fluid w-100 h-100" src="https://images.pexels.com/photos/416322/pexels-photo-416322.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" style="object-fit: cover;">
                            <a href="#survey" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                                Survey
                            </a>
                        </div>

                        <div class="position-relative overflow-hidden mb-3 wow fadeInLeft"  data-wow-delay=".6s" style="height: 80px; margin: 10px 30px; width: 94%;">
                            <img class="img-fluid w-100 h-100" src="img/cat-500x80-2.jpg" style="object-fit: cover;">
                            <a href="#blog" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                                Blog
                            </a>
                        </div>

                        <div class="position-relative overflow-hidden mb-3 wow fadeInLeft"  data-wow-delay=".9s" style="height: 80px; margin: 10px 30px; width: 94%;">
                            <img class="img-fluid w-100 h-100" src="{{asset('img/pexels-photo-1181396.jpg')}}" style="object-fit: cover;">
                            <a href="#survey" class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                                Forum
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->

    
    <!-- Featured News Slider Start -->
    <div class="container-fluid py-3">
        <div class="">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0">General Announcements</h3>
                {{-- <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a> --}}
            </div>
            <div class="owl-carousel owl-carousel-2 carousel-item-4 position-relative">
                @foreach($generalAnnouncement as $generalAnnouncementData)

                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid w-100 h-100" src="{{ asset ($generalAnnouncementData->image) }}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-1" style="font-size: 13px; font-weight: 500;">
                            <a class="text-white" >{{ $generalAnnouncementData->content_type->type }}</a>
                            <span class="px-1 text-white">/</span>
                            <a class="text-white" >{{ $generalAnnouncementData->created_at }}</a>
                        </div>
                        <a class="h4 m-0 text-white"  style="cursor: pointer;" data-toggle="modal" data-target="#generalAnnouncementModal" onclick="getGenAnnouncementData('{{ $generalAnnouncementData->title }}', '{{ $generalAnnouncementData->content_type->type }}', '{{ $generalAnnouncementData->created_at }}', '{!! $generalAnnouncementData->content !!}', '{{ $generalAnnouncementData->image }}')">{{ $generalAnnouncementData->title }}
                        </a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->

    <br>
    <!-- Category News Slider Start -->
    <div class="container-fluid">
        <div class="">
            <div class="row">
                <div class="col-lg-6 py-2">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Memorandum and HMO Announcements</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="owl-carousel owl-carousel-1 carousel-item-1 position-relative">
                                @foreach($memorandum as $memorandumData)

                                <div class="position-relative overflow-hidden" style="height: 300px;">
                                    <img class="img-fluid w-100 h-100" src="{{ asset ($memorandumData->image) }}" style="object-fit: cover;">
                                    <div class="overlay">
                                        <div class="mb-1" style="font-size: 13px; font-weight: 500;">
                                            <a class="text-white" >{{ $memorandumData->content_type->type }}</a>
                                            <span class="px-1 text-white">/</span>
                                            <a class="text-white" >{{ $memorandumData->created_at }}</a>
                                        </div>
                                        <a class="h4 m-0 text-white"  style="cursor: pointer;" data-toggle="modal" data-target="#generalAnnouncementModal" onclick="getGenAnnouncementData('{{ $memorandumData->title }}', '{{ $memorandumData->content_type->type }}', '{{ $memorandumData->created_at }}', '{!! $memorandumData->content !!}', '{{ $memorandumData->image }}')">{{ $memorandumData->title }}</a>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="owl-carousel owl-carousel-1 carousel-item-1 position-relative">
                                @foreach($hmoAnnouncement as $hmoAnnouncementData)

                                <div class="position-relative overflow-hidden" style="height: 300px;">
                                    <img class="img-fluid w-100 h-100" src="{{ asset ($hmoAnnouncementData->image) }}" style="object-fit: cover;">
                                    <div class="overlay">
                                        <div class="mb-1" style="font-size: 13px; font-weight: 500;">
                                            <a class="text-white" >{{ $hmoAnnouncementData->content_type->type }}</a>
                                            <span class="px-1 text-white">/</span>
                                            <a class="text-white" >{{ $hmoAnnouncementData->created_at }}</a>
                                        </div>
                                        <a class="h4 m-0 text-white"  style="cursor: pointer;" data-toggle="modal" data-target="#generalAnnouncementModal" onclick="getGenAnnouncementData('{{ $hmoAnnouncementData->title }}', '{{ $hmoAnnouncementData->content_type->type }}', '{{ $hmoAnnouncementData->created_at }}', '{!! $hmoAnnouncementData->content !!}', '{{ $hmoAnnouncementData->image }}')">{{ $hmoAnnouncementData->title }}</a>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6 py-2 ">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Watch Latest Episodes on Stream!</h3>
                    </div>
                   {{--  <div style="text-align:center;padding:1em 0;"> <h2><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/country/ph"><span style="color:gray;">Current local time in</span><br />Philippines</a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=large&timezone=Asia%2FManila" width="100%" height="140" frameborder="0" seamless></iframe> </div> --}}
                   <div class="position-relative"> 
                            <div class="row my-3 overflow-hidden justify-content-center">
                                <div class="col-12 col-sm-6 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay=".4s" data-wow-duration="1.5s">
                                    <div class="image-container zoomIn-effect">
                                        <a target="_blank" href="https://web.microsoftstream.com/channel/542876ac-150d-42ba-b1c5-c3a0523a9ab8">
                                            <img src="{{ asset('img/streams/KB_LOGO.png') }}" width="100%" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay=".8s" data-wow-duration="1.5s">
                                    <div class="image-container zoomIn-effect">
                                        <a target="_blank" href="https://web.microsoftstream.com/channel/16c4c85d-1805-423d-b745-2a1100061eb7">
                                            <img src="{{ asset('img/streams/ed_talks.png') }}" width="100%" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay="1.2s" data-wow-duration="1.5s">
                                    <div class="image-container zoomIn-effect">
                                        <a target="_blank" href="https://web.microsoftstream.com/channel/91f4d200-f0e8-4dd1-944d-9967240c3ddf">
                                            <img src="{{ asset('img/streams/MWTB_LOGO.png') }}" width="100%" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay="1.6s" data-wow-duration="1.5s">
                                    <div class="image-container zoomIn-effect">
                                        <a target="_blank" href="https://web.microsoftstream.com/channel/91f4d200-f0e8-4dd1-944d-9967240c3ddf">
                                            <img src="{{ asset('img/streams/76004FFM_LOGO.png') }}" width="100%" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div> 

                            <div class="my-md-5 text-center">
                                <a target="_blank" href="https://web.microsoftstream.com/channel/91f4d200-f0e8-4dd1-944d-9967240c3ddf" class="btn btn-primary btn-lg  wow fadeInDown fables-btn-rounded">
                                    Click here to visit Official Megawide Stream online!
                                </a>
                            </div> 

                        </div>
                            
                    </div>
                               {{-- <video  style="width: 100%;" controls>
                                    <source src="{{URL::asset('img/megawide-contruction-corporation.mp4')}}" type="video/mp4">
                                </video> --}}
                {{-- <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0"></h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        @foreach($hmoAnnouncement as $hmoAnnouncementData)

                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-4.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;  font-weight: 500;">
                                    <a href="">{{ $hmoAnnouncementData->content_type->type }}</a>
                                    <span class="px-1">/</span>
                                    <span>{{ $hmoAnnouncementData->created_at }}</span>
                                </div>
                                <a class="h4 m-0" href="{{ url('content/'.$meganewsData->id) }}">{{ $hmoAnnouncementData->title }}</a>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Category News Slider End -->

    

    <div class="container-fluid py-3" id="survey">
        <div class="">
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between py-2 px-4 mb-3">
                                        <h3 class="m-0">Survey</h3>
                                        <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-surveys">View All</a>
                                    </div>

                                </div>
                                <div class="card-body">

                                    <div class="d-flex justify-content-between ">
                                        <h6 class="font-14">Question by: {{ isset($survey) ? $survey->created_by : ''}}</h6>
                                        <a class="text-secondary font-14" href="/view-all-surveys">Survey Expiry: {{ isset($survey) ? $survey->end_date : ''}}</a>
                                    </div>
                                    <br>
                                    <h4> {{ isset($survey) ?  $survey->question : ''}}</h4>
                                    <br>
                                    <br>
                                    <form action="/submitSurvey" method="POST">
                                        @csrf
                                        <ul class="list-group">
                                            @if(isset($survey))
                                            @foreach($survey->choices as $choices)
                                            <li class="list-group-item">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="choices_id" value="{{$choices->id}}">
                                                        {{$choices->choice}}
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                        <input type="hidden" name="survey_id" value="{{isset($survey) ? $survey->id : ''}}">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-block btn-sm">
                                        Vote
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="card">
                                <div class="card-header">Survey Results</div>
                                <div class="card-body" >
                                    <input type="hidden" value="{{$jsImplode}}" id="getResultsData">
                                    <div id="piechart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between py-2 px-4 mb-3">
                                        <h3 class="m-0">Timeline</h3>
                                        <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-forum">View All</a>
                                    </div>
                                </div>
                                <br>
                                <div class="container-fluid">
                                    <form action="/submitPost" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img class="rounded-circle" src="https://i.guim.co.uk/img/media/791c139fcb94e1094512b045e939a8ca9dceec75/0_635_4712_4706/master/4712.jpg?width=465&quality=45&auto=format&fit=max&dpr=2&s=850d0cffdfb9434bcea77373896f7d40" width="40px">
                                                </div>

                                                <div class="col-md-11">
                                                    <input class="form-control" type="text" name="title" placeholder="Title">
                                                    <br>
                                                    <textarea class="form-control" name="post" id="exampleFormControlTextarea1" rows="3" placeholder="Questions / Concerns?"></textarea>
                                                </div>

                                                <div class="offset-md-10 col-md-2">
                                                <br>
                                                    <input type="hidden" name="post_type_id" value="1">
                                                    <button type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </form>
                                </div>
                                <div class="container-fluid">
                                    <div  style="overflow:scroll; height:550px;">

                                        @foreach($timeline as $timelineData)
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="p-card bg-white p-2 rounded px-3">
                                                    <div class="d-flex justify-content-between" >
                                                        <div class="d-flex ">
                                                            <img class="rounded-circle" src="{{$timelineData->image}}" width="32px">
                                                            <span class="text-black-50 ml-2">
                                                                <a href="">{{$timelineData->name}}</a> 
                                                                <span class="font-14"><i>{{$timelineData->post_type->name}}</i></span>
                                                            </span>
                                                        </div>
                                                        <span class="badge badge-danger py-1 mb-2"><i class="fa-solid fa-calendar-days"></i> &nbsp;{{Carbon\Carbon::parse($timelineData->created_at)->diffForHumans()}}
                                                        </span>
                                                    </div>
                                                    <div class="ml-3">
                                                    <h5 class="mt-2">{{$timelineData->title}}</h5>
                                                    </div>
                                                    <div class="d-block m-2" style="padding-left: 40px;">
                                                        <span class="d-block mb-2">{{$timelineData->post}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right"  style="margin-bottom: -15px;">
                                                <a href="" type="button" data-toggle="modal" data-target="#timelineModal" onclick="timelineFunction('{{$timelineData->image}}', '{{$timelineData->name}}', '{{$timelineData->post_type->name}}', '{{$timelineData->post}}', '{{Carbon\Carbon::parse($timelineData->created_at)->diffForHumans()}}', '{{$timelineData->title}}', {{$timelineData->id}}, '{{$timelineData->timeline_comments}}')">
                                                    <p>
                                                        <i class="fa-regular fa-comments"></i>
                                                        Comments
                                                    </p>    
                                                </a>
                                            </div>
                                            <hr style="width: 90%">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid py-3" id="blog">
        <div class="">
            <div class="card">
                <div class="card-header text-center">
                    <div class="d-flex align-items-center justify-content-between py-2 px-4 mb-3">
                        <h3 class="m-0">Latest Blog</h3>
                        <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-blogs">View All</a>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="row">   
                        @if(isset($blog))
                            @foreach($blog as $key => $blogData) 
                            @if($key == 0)      
                            <div class="col-12 col-sm-6 col-md-8 mb-4 mb-lg-5"> 
                                <div class="owl-carousel owl-theme default-carousel absolute-dots nav-0">
                                    @foreach($blogData->blog_images as $blog_imageData)
                                    <div class="image-container zoomOut-effect position-relative" style="height: 200px;">
                                        <a href="/blog-details/{{$blogData->id}}"><img src="{{asset('img/blogs/'.$blog_imageData->image)}}" alt="" class="w-100"></a> 
                                    </div>
                                    @endforeach
                                </div>

                                <h2 class="font-18 semi-font mt-3 mb-2"><a href="#" class="fables-main-text-color fables-second-hover-color">{{$blogData->blog_title}}</a></h2>
                                <div class="fables-forth-text-color font-14 mb-2">                                  
                                    <span class="fables-icondata fables-second-text-color mr-1"></span> 
                                    <span class="mr-3"> {{ \Carbon\Carbon::parse($blogData->created_by)->format('d/m/Y') }}</span>
                                    <span class="fables-iconcomment fables-second-text-color mr-1"></span> 
                                    <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color mr-3">0</a> 
                                    <span class=" fables-second-text-color mr-1"><i class="fa fa-regular fa-heart"></i></span> 
                                    <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color">0</a> 
                                </div>
                                <p class="fables-forth-text-color font-14 mb-3">
                                    {{$blogData->content}}
                                </p>
                                <a href="/blog-details/{{$blogData->id}}" class="btn fables-main-text-color fables-second-hover-color font-14 p-0 underline">Read More</a> 
                            </div>
                            @endif
                           @endforeach
                       @endif

                       
                            <div class="col-md-4">
                                <h2 class="position-relative font-23 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Recent Posts</h2>
                                @if(isset($blog))
                                    @foreach($blog as $key => $blogData) 
                                        @if($key >= 1)     
                                        <div class="row mb-4">
                                           <div class="col-4 text-center">
                                               <a href="/blog-details/{{$blogData->id}}"><img src="{{isset($blogData->blog_images[0]->image) ? asset('img/blogs/'.$blogData->blog_images[0]->image) : ''}}" alt="" class="img-fluid position-relative" ></a>
                                           </div>
                                           <div class="col-8 pl-0">
                                               <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color bold-font fables-second-hover-color blog-smaller-head">{{$blogData->blog_title}}</a>
                                               <p class="font-14 mt-1"><i class="fa fa-calendar fables-forth-text-color "></i> {{ \Carbon\Carbon::parse($blogData->created_by)->format('d/m/Y') }}</p>
                                               <a href="/blog-details/{{$blogData->id}}" class="btn fables-main-text-color fables-second-hover-color font-14 p-0 underline">Read More</a> 
                                           </div>
                                        </div>   
                                        <hr>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            
                   </div>
               </div>
           </div>
       </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="timelineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:  #f8f8f8">
                        <div class="col-md-12">

                            <div class="card p-3 mb-2">
                                <div class="d-flex flex-row" id="post_image">
                                    
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row gap-3 align-items-center">
                                    </div>

                                    <div class="d-flex flex-row">
                                        <span class="text-muted fw-normal fs-10" id="post_date"></span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <div class="container mt-3 justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <div class="text-left">
                                    <h4 id="count_comments"></h4>
                                </div>
                                <br>
                                <div id="card_comments">
                                    
                                </div>

                            </div>

                        </div>

                    </div>
                    <form action="/submitCommentTimeline" method="POST">
                    @csrf
                    <div class="container justify-content-center">
                        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Add Comment</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post"></textarea>
                        </div>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="timeline_id" id="timeline_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="generalAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: #e4e4e4;">
                    <div class="container ">
                        <h2 class="text-center" id="titleGeneralAnnouncement" style="color: #ee3124"></h2>
                        <hr style="border: 3px solid #c1c1c1; width: 10%;">
                        <br>
                        <div class="row justify-content-center">

                            <div class="square">
                                <div id="imageGeneralAnnouncement"> </div>
                                <p  id="textGeneralAnnouncement" style="color: black;"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card{
        border:none;
        -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.03);
        }

        .comment-text{
            font-size:12px;
        }

        .fs-10{
            font-size:12px;
        }
        img.img-modal {
            float: left; 
            margin: 0px 50px 20px 20px;
            width: 50%;
        }
        p {
            text-align: justify;
            margin: 10px 20px;
        }
            
    </style>

@endsection

@section('scripts')
    @include('scripts.main')
@endsection