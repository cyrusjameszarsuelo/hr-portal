@extends('welcome')

@section('title', 'Main')

@section('content')

<div class="container-fluid py-3" >
    <div class="row">
        <div class="col-md-5">
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
                            <div class="container" style=" overflow:auto; height:400px;">
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
                            @if(isset($surveyName))
                                <center><span class="font-18">Thank you for answering the Survey!</span></center>
                            @elseif (isset($survey))
                            <button type="submit" class="btn btn-primary btn-block fables-btn-rounded">
                                Vote
                            </button>
                            @endif
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">MEGANews</h2> 
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

            <div class="d-flex align-items-center justify-content-between py-2 px-4 mt-5">
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

                        <div class="my-md-4 text-center">
                            <a target="_blank" href="https://web.microsoftstream.com/channel/91f4d200-f0e8-4dd1-944d-9967240c3ddf" class="btn btn-primary btn-lg  wow fadeInDown fables-btn-rounded">
                                Click here to visit Official Megawide Stream online!
                            </a>
                        </div> 

                    </div>
                            
                </div>
        </div>
    </div>
    
</div>

    <div class="container-fluid py-3 mt-1" id="communityBoard">
        <div class="row">

            <div class="col-md-7">
                <div class="d-flex align-items-center justify-content-between py-2 px-4 ">
                        <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">Community Board</h2> 
                        <button class="btn btn-primary fables-btn-rounded btn-sm" id="addToBoard" data-toggle="modal" data-target="#addToBoardModal" onclick='document.getElementById("manageCommBoardForm").reset();'>Add to Board</button>
                </div>
                <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                    <div class="container-fluid">
                        <div class="" style="background-image: linear-gradient(#ffffff, #4c4c4c);">   
                            <div style="overflow:scroll; height:520px;" class="body-flipcard">


                                <div class="gallery-filter">
                                    <div class="portfolioFilter my-3 clearfix">
                                        <a href="#" data-filter="*" class="current mr-3">ALL</a>
                                        <a href="#" data-filter=".image" class="fables-forth-text-color mr-3">Images</a>
                                        <a href="#" data-filter=".content" class="fables-forth-text-color mr-3">Content</a>
                                    </div> 
                                    <div class="portfolioContainer row filter-masonry">

                                        @if($community->isEmpty())
                                        <div class="text-center image content mt-5">
                                            <h4 >No Data Found.</h4>
                                        </div>
                                        @endif

                                        @foreach($community as $communityData)
                                        @if ($communityData->image != null)
                                            <div class="image col-12 col-sm-6 col-md-6 mb-2">
                                                <div class="flip">
                                                    <div class="front filter-img-block position-relative" style="background-image: url({{asset('img/community_board/'.$communityData->image)}})">
                                                    </div>
                                                    <div class="back text-center">
                                                       <h3 class="text-white">{{$communityData->title}}</h3>
                                                       <p class="text-white mt-3">{{ str_limit($communityData->content, 150, '...') }}</p>
                                                       <div class="btn-group">

                                                        @if($communityData->link)
                                                            <a href="{{$communityData->link}}" type="button" class="btn btn-dark  btn-sm mt-2">Link</a>
                                                        @endif
                                                        <button class="btn btn-warning mt-2 btn-sm communityBtnView" type="button" data-toggle="modal" data-target="#getCommunityData" data-id="{{$communityData}}">View</button>
                                                        @if(isset($commName))
                                                        <a type="button" class="btn btn-primary btn-sm mt-2" onclick="deleteCommBoard({{$communityData->id}})" data-toggle="modal" data-target="#deleteCommModal" >Delete</a>
                                                        <a type="button" class="btn btn-info btn-sm mt-2 communityBtnEdit"  data-toggle="modal" data-target="#addToBoardModal" data-id="{{$communityData}}">Edit</a>
                                                        @endif
                                                        </div>
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
                                                            <div class="btn-group">
                                                            @if($communityData->link)
                                                                <a href="{{$communityData->link}}" class="btn btn-dark btn-sm">Link</a>
                                                            @endif

                                                            @if(isset($commName))
                                                                <a type="button" class="btn btn-primary btn-sm" onclick="deleteCommBoard({{$communityData->id}})" data-toggle="modal" data-target="#deleteCommModal">Delete</a>
                                                                <a type="button" class="btn btn-info btn-sm communityBtnEdit" data-toggle="modal" data-target="#addToBoardModal" data-id="{{$communityData}}">Edit</a>
                                                            @endif
                                                        </div>
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

            <div class="col-md-5">
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
    <!-- Main News Slider End -->

    <br>

    <div class="container-fluid py-3" id="blog">
        <div class="row">
            <div class="col-md-6">
                
                @include('pages.kamegawide_blogs')

            </div>

            <div class="col-md-6">
                
                @include('pages.kamegawide_convos')

            </div>
        </div>
    </div>


    @include('pages.add_blog')


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

    
@include('pages.deleteForumModal')

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

        .avatar {
            /* Center the content */
            display: inline-block;
            vertical-align: middle;

            /* Used to position the content */
            position: relative;

            /* Colors */
            background-color: #2c3e4f;
            color: #fff;

            /* Rounded border */
            border-radius: 50%;
            height: 38px;
            width: 38px;
        }

        .avatar__letters {
            /* Center the content */
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }
            
    </style>

    

@endsection


@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{asset('assets/custom/js/forum.js')}}"></script>
    <script src="{{asset('assets/custom/js/main.js')}}"></script>
@endsection