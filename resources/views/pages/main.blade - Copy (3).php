@extends('welcome')

@section('title', 'Main')

@section('content')

<div class="container-fluid py-3" id="communityBoard">
    <div class="row">
        <div class="col-md-6">
            
            <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                <div class="col-12 py-2 col-md-12 ">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">Community Board</h2> 
                </div>
            </div>
            <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                <div class="container-fluid">
                    <div class="" style="background-image: linear-gradient(#ffffff, #4c4c4c);">   
                        <div style="overflow:scroll; height:430px;" class="body-flipcard">

                            <button class="btn btn-primary fables-btn-rounded" data-toggle="modal" data-target="#addToBoardModal">Add to Board</button>

                            <div class="gallery-filter">
                                <div class="portfolioFilter my-3 clearfix">
                                    <a href="#" data-filter="*" class="current mr-3">ALL</a>
                                    <a href="#" data-filter=".image" class="fables-forth-text-color mr-3">Images</a>
                                    <a href="#" data-filter=".content" class="fables-forth-text-color mr-3">Content</a>
                                </div> 
                                <div class="portfolioContainer row filter-masonry"> 

                                    @foreach($community as $communityData)

                                    @if ($communityData->image != null)
                                        <div class="image col-12 col-sm-6 col-md-6 mb-2">
                                            <div class="flip">
                                                <div class="front filter-img-block position-relative" style="background-image: url({{asset('img/community_board/'.$communityData->image)}})">
                                                </div>
                                                <div class="back text-center">
                                                   <h3 class="text-white">{{$communityData->title}}</h3>
                                                   <p class="text-white mt-3">{{ str_limit($communityData->content, 150, '...') }}</p>

                                                    @if($communityData->link)
                                                        <a href="{{$communityData->link}}" type="button" class="btn btn-primary  btn-sm mt-2">Go to link</a>
                                                    @endif
                                                    <button class="btn btn-dark mt-2 btn-sm" type="button" data-toggle="modal" data-target="#getCommunityData" onclick="getCommunityData('{{$communityData->title}}', '{{$communityData->created_at}}', '{{$communityData->content}}', '{{asset('img/community_board/'.$communityData->image)}}')">View</button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="content col-12 col-sm-6 col-md-6 mb-2">
                                            <div class="card filter-img-block position-relative">
                                                <div class="card-header" style="color: black">
                                                    {{$communityData->title}}
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title" >{{$communityData->content}}</h6>
                                                    @if($communityData->link)
                                                        <a href="{{$communityData->link}}" class="btn btn-primary btn-sm">Go to link</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @endforeach

                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">MEGAnews</h2> 
                <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-meganews">View All</a>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mt-1 mb-lg-0">
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
            </div>
        </div>
    </div>
    
</div>

    <div class="container-fluid py-3 mt-5">
        <div class="row">

            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">MEGAnews</h2> 
                    <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-meganews">View All</a>
                </div>
                <div class="col-md-12">
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

            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Stream</h2> 
                </div>
                <div class="row">
                   <div class="position-relative"> 
                        <div class="row my-3 overflow-hidden justify-content-center">
                            <div class="col-12 col-sm-3 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay=".4s" data-wow-duration="1.5s">
                                <div class="image-container zoomIn-effect">
                                    <a target="_blank" href="https://web.microsoftstream.com/channel/542876ac-150d-42ba-b1c5-c3a0523a9ab8">
                                        <img src="{{ asset('img/streams/KB_LOGO.png') }}" style="width: 100%;" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay=".8s" data-wow-duration="1.5s">
                                <div class="image-container zoomIn-effect">
                                    <a target="_blank" href="https://web.microsoftstream.com/channel/16c4c85d-1805-423d-b745-2a1100061eb7">
                                        <img src="{{ asset('img/streams/ed_talks.png') }}" style="width: 100%;" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay="1.2s" data-wow-duration="1.5s">
                                <div class="image-container zoomIn-effect">
                                    <a target="_blank" href="https://web.microsoftstream.com/channel/91f4d200-f0e8-4dd1-944d-9967240c3ddf">
                                        <img src="{{ asset('img/streams/MWTB_LOGO.png') }}" style="width: 100%;" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-lg-3 text-center mb-4 mb-lg-0 wow fadeInDown" data-wow-delay="1.6s" data-wow-duration="1.5s">
                                <div class="image-container zoomIn-effect">
                                    <a target="_blank" href="https://web.microsoftstream.com/channel/91f4d200-f0e8-4dd1-944d-9967240c3ddf">
                                        <img src="{{ asset('img/streams/76004FFM_LOGO.png') }}" style="width: 100%;" alt="">
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
            </div>

        </div>
    </div>
    <!-- Main News Slider End -->

    <br>

    
    
    <div class="container-fluid py-3" id="survey">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-between py-2 px-4">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Survey</h2> 
                    <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-surveys">View All</a>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                            <div class="card-header">Survey Results: {{ isset($survey) ?  $survey->question : ''}}</div>
                            <div class="card-body" >
                                <input type="hidden" value="{{$jsImplode}}" id="getResultsData">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                            <div class="card-body">

                                <div class="d-flex justify-content-between ">
                                    <h6 class="font-14">Question by: {{ isset($survey) ? $survey->created_by : ''}}</h6>
                                    <a class="text-secondary font-14" href="/view-all-surveys">Survey Expiry: {{ isset($survey) ? Carbon\Carbon::parse($survey->end_date)->diffForHumans() : ''}}</a>
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
                                <button type="submit" class="btn btn-primary btn-block fables-btn-rounded">
                                    Vote
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                            <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Forum</h2> 
                            <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-forum">View All</a>
                        </div>
                        <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                            <div class="container-fluid mt-4">
                                <form action="/submitPost" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img class="rounded-circle" src="https://i.guim.co.uk/img/media/791c139fcb94e1094512b045e939a8ca9dceec75/0_635_4712_4706/master/4712.jpg?width=465&quality=45&auto=format&fit=max&dpr=2&s=850d0cffdfb9434bcea77373896f7d40" width="40px">
                                            </div>

                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="title" placeholder="Title">
                                                <br>
                                                <textarea class="form-control" name="post" id="exampleFormControlTextarea1" rows="3" placeholder="Questions / Concerns?"></textarea>
                                            </div>

                                            <div class="offset-md-9 col-md-2">
                                            <br>
                                                <input type="hidden" name="post_type_id" value="1">
                                                <button type="submit" class="btn btn-primary btn-md fables-btn-rounded">
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
                                                <div class="ml-5">
                                                <h5 class="mt-2 font-15">{{$timelineData->title}}</h5>
                                                </div>
                                                <div class="d-block m-1 ml-5" >
                                                    <span class="d-block mb-1 font-13">{{$timelineData->post}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right"  style="margin-bottom: -15px;">
                                            <a href="" type="button" data-toggle="modal" data-target="#timelineModal" onclick="timelineFunction('{{$timelineData->image}}', '{{$timelineData->name}}', '{{$timelineData->post_type->name}}', '{{$timelineData->post}}', '{{Carbon\Carbon::parse($timelineData->created_at)->diffForHumans()}}', '{{$timelineData->title}}', {{$timelineData->id}}, '{{$timelineData->timeline_comments}}')">
                                                <p class="mb-2 mr-4">
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

    



    <div class="container-fluid py-3" id="blog">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Blogs</h2> 
                    <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-blogs">View All</a>
                </div>
                <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                    <div class="container-fluid mt-4">
                        <div class="row">   
                            @if(isset($blog))
                                @foreach($blog as $key => $blogData) 
                                    @if($key == 0)      
                                    <div class="col-12 col-sm-12 col-md-8 mb-1 mb-lg-4"> 
                                            <img src=" 
                                            @if($blogData->blog_images->first() != null)

                                                {{asset('img/blogs/'. $blogData->blog_images->first()->image )}}

                                            @else 

                                                {{asset('img/blogs/default-blog-image.jpg')}}

                                            @endif

                                            " alt="" class="img-fluid">

                                        <h2 class="font-18 semi-font mt-3 mb-2"><a href="#" class="fables-main-text-color fables-second-hover-color">{{$blogData->blog_title}}</a></h2>
                                        <div class="fables-forth-text-color font-14 mb-2">                                  
                                            <span class="fables-icondata fables-second-text-color mr-1"></span> 
                                            <span class="mr-3"> {{ \Carbon\Carbon::parse($blogData->created_by)->format('d/m/Y') }}</span>
                                            <span class="fables-iconcomment fables-second-text-color mr-1"></span> 
                                            <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color mr-3">{{count($blogData->blog_comments)}}</a> 
                                            <span class=" fables-second-text-color mr-1"><i class="fa fa-regular fa-heart"></i></span> 
                                            <a href="/blog-details/{{$blogData->id}}" class="fables-main-text-color fables-second-hover-color">0</a> 
                                        </div>
                                        <p class="fables-forth-text-color font-14 mb-3">
                                            {{ str_limit($blogData->content, 200, '...') }}
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


            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Events & Holidays</h2> 
                </div>
                <div class="fables-testimonial fables-after-overlay fables-about-caption bg-rules" style="background-image: url({{ asset ('img/Silhouette-At-Work.jpg')}});">
                   <div class="container">
                       <div class="row">
                           <div class="position-relative z-index col-12 text-center" > 

                                <div class="row">

                                    <div class="col-12 col-md-12 mb-3 wow fadeInLeft mt-6" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                        <div class="border  fables-second-border-color ">
                                            <div class="row text-center text-lg-left icon-rotate  mt-4">
                                                <div class="col-12 col-lg-12 mb-3 mb-md-0 text-center icon">
                                                    <i class="fa-solid fa-calendar-days fables-third-text-color fa-3x"></i>
                                                </div>
                                                <div class="col-12 col-lg-12 text-center text-title mb-4">
                                                    <a href="/company-events"><h2 class="fables-third-text-color  fables-second-hover-color font-20 semi-font my-2 mb-lg-3 about-block-heading">Company Events</h2></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 mb-6 wow fadeInLeft mt-3" data-wow-delay=".9s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                        <div class="border  fables-second-border-color ">
                                            <div class="row text-center text-lg-left icon-rotate mt-4">
                                                <div class="col-12 col-lg-12 mb-3 mb-md-0 text-center icon">
                                                    <i class="fa-solid fa-gifts fables-third-text-color fa-3x"></i>
                                                </div>
                                                <div class="col-12 col-lg-12 text-center  text-title mb-4">
                                                    <a href="/holidays"><h2 class="fables-third-text-color  fables-second-hover-color font-20 semi-font my-2 mb-lg-3 about-block-heading">Holidays</h2></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                           </div> 
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
    <div class="modal fade" id="getCommunityData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p class="modalp" id="textGeneralAnnouncement" style="color: black;"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addToBoardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Board</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/storeCommunityBoard" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <label class="font-11" for="">Required (<span style="color: red;">*</span>)</label>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="link">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <input type="file" class="form-control" id="exampleInputFile" name="image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Content <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        img.img-modal {
            float: left; 
            margin: 0px 50px 20px 20px;
            width: 50%;
        }
        p.modalp {
            text-align: justify;
            margin: 10px 20px;
        }

        .icon-rotate > div.icon  {
          transition: transform .4s ease-in-out;
          background: none;
        }
        .icon-rotate > div.icon:hover {
          transform: rotate(20deg);
        }
            
    </style>

@endsection

@section('scripts')
    @include('scripts.main')
@endsection