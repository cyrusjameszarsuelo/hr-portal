@extends('main')

@section('title', 'MegaGood Vibes')

@section('page-title', 'MEGAGOOD VIBES')

@section('content')

			 
	<div class="container pl-5" style="margin-bottom: 10vw">
		<h6 class="position-relative"><i>Feel good videos of employees on talent, hobbies and interests</i></h6>
		<hr style="border-top: 1px dashed; width: 80%; position: relative;">
		<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> <span>Mega Good Vibes</span></div>
		<br>
		<br>

		<div class="content" style="position: relative;">
			<!-- News With Sidebar Start -->
		    <div class="py-3">
	            <div class="row">
	                <div class="col-lg-8">
	                    <div class="position-relative" style="z-index: 3;"> 
                              <img src="{{$megagoodvibes->thumbnail}}" alt="" class="w-100">
                              <div class="demo-gallery-poster fables-main-gradient">
                                <a data-fancybox href="{{$megagoodvibes->file}}">
                                   <img src="{{ asset ('assets/custom/images/play-button.png')}}" alt="play button" class="img-fluid">
                               </a> 
                             </div> 
                        </div> 
	                    <!-- News Detail End -->

	                    <div class="bg-light overlay position-relative" style="background: none; display: block; height: 20vw;">
	                            
	                            <div class="mb-1">
	                                <h3 >{{$megagoodvibes->title}}</h3>
	                                <p>{!!$megagoodvibes->content!!}</p>
	                            </div>
	                            <br>
	                            <br>
	                            <hr>
	                            <div class="mb-1">
	                            	<div class="row">
	                            		<div class="col-md-8">
	                            			<div class="icons-vid">
	                        				<form >
				                            	<a type="button" id="likeAjax"><i id="likeIcon" class="{{$megagoodvibesLike ? 'fa-solid' : 'fa-regular'}} fa-thumbs-up"></i><span> Like &nbsp;&nbsp;&nbsp;</span></a>
				                            	<span><i class="fa-regular fa-comment"></i> Comment</span>
				                            </form>
			                            	</div>
	                            		</div>
	                            		<div class="float-right">
	                            			<span>{{ \Carbon\Carbon::parse($megagoodvibes->created_at)->format('F d, Y') }}</span>
	                            		</div>
	                            	</div>
	                            </div>
	                            <hr>
	                        </div>

	                    <!-- Comment List Start -->
	                    <div class="bg-light mb-3" style="padding: 30px;">
	                        <h3 class="mb-4" ><span id="comment_count">{{$megagoodvibesComments->count()}}</span> Comment</h3>
	                        <div id="comment_section">
	                        	@foreach($megagoodvibesComments as $megagoodvibesCommentsData)
	                        	<div class="media mb-4">
		                            <div class="media-body">
		                                <h6><strong>{{$megagoodvibesCommentsData->user}}</strong> - <small><i>{{ \Carbon\Carbon::parse($megagoodvibesCommentsData->created_at)->format('l m/d/Y, H:i:s') }}</i></small></h6>
		                                <br>
		                                <p>{{$megagoodvibesCommentsData->comment}}</p>
		                            </div>
		                        </div>
	                        	<hr>
		                        @endforeach
	                        </div>
	                    </div>
	                    <!-- Comment List End -->

	                    <!-- Comment Form Start -->
	                    <div class="bg-light mb-3" style="padding: 30px;">
	                        <h3 class="mb-4">Leave a comment</h3>
	                        <form >
								<input type="hidden" id="megagoodvibes_id" name="megagoodvibes_id" value="{{$megagoodvibes->id}}">
	                            <div class="form-group">
	                                <label for="comment">Message *</label>
	                                <textarea id="comment" cols="30" rows="5" class="form-control"></textarea>
	                            </div>
	                            <div class="form-group mb-0">
                                	<button type="button" id="addCommentAjax" class="btn btn-primary font-weight-semi-bold py-2 px-3">Leave a comment</button>
	                            </div>
	                        </form>
	                    </div>
	                    <!-- Comment Form End -->

	                    
	                </div>

	                <div class="col-lg-4 pt-3 pt-lg-0">

	                    <!-- Popular News Start -->
	                    <div class="pb-3">
	                    	<div class="bg-light py-2 px-4 mb-3">
	                            <h3 class="m-0">Other Videos</h3>
	                        </div>
							@foreach($megagoodvibesAll as $key => $megagoodvibesData)
    							{{-- @if($key != 0) --}}
			                        <div class="d-flex mb-3">
			                            <img src="{{$megagoodvibesData->thumbnail}}" style="width: 100px; height: 100px; object-fit: cover;">
			                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
			                                <div class="mb-1" style="font-size: 13px;">
			                                    <span>{{ \Carbon\Carbon::parse($megagoodvibesData->created_at)->format('F d, Y') }}</span>
			                                </div>
			                                <a class="h6 m-0" href="/mega-good-vibes/{{$megagoodvibesData->id}}">{{str_limit(strip_tags($megagoodvibesData->content), 30, '...')}}</a>
			                            </div>
			                        </div>
			                    {{-- @endif --}}
	                       	@endforeach
	                    </div>
	                    <!-- Popular News End -->

	                </div>
	            </div>
		    </div>
		</div>
	</div>

    <style>

    	body {
    		overflow-x: hidden;
    	}

    	p {
    		font-size: 1vw;
    		color: #000;
    	}

    	.right-margin {
    		margin-left: -2vw;
    		margin-right: -8vw;
    	}

    	.icons-vid {
    		font-size: 1.3vw;
    	}

    	.quote {
		    background-color: gray;
			    color: white;
			    /* padding: 19px; */
			    margin-left: -20vw;
			    padding-left: 10vw;
			    padding: 20px 20px 20px 13vw;
			    margin-right: -30px;
    	}

        .image-bg-gray {

		    width: 100%;
		    height: 100%;
		    /* transform: scale(1.2); */
		    background-color: #c3c3c3;
		    clip-path: polygon(53% 30%, 26% 100%, 81% 100%, 100% 35%);
		    margin-left: 20%;
		    margin-top: -40vw;
		    position: fixed;
		    background-position: center;
		    background-size: cover;
		    background-repeat: no-repeat;
        }


        .bg-left {
        	background: linear-gradient(132deg, rgb(255 255 255) 28%, rgb(235 235 235) 46%, rgb(181 181 181 / 79%) 54%);
		    width: 50vw;
		    height: 100vh;
		    position: fixed;
		    top: 0px;
		    left: 0px;
		    clip-path: polygon(0% 100%, 59% 87%, 100% 40%, 1% 28%);
        }

        /*.bg-right {
        	background: linear-gradient(355deg, rgb(242 242 242) 1%, rgb(242 242 242) 20%, rgb(97 97 97) 210%);
		    width: 100vw;
		    height: 100vh;
		    position: fixed;
		    top: 0px;
		    left: 23vw;
		    background-image: url(http://cdn.cnn.com/cnnnext/dam/assets/200310023921-dubai-buildings-skyline.jpg);
		    filter: blur(30px);
		    background-position: center;
		    clip-path: polygon(31% 30%, -3% 90%, 99% 82%, 110% 38%);
        }*/

        
    </style>

    

@endsection

@section('scripts')
	<script src="{{asset('js/megagoodvibes.js')}}"></script>
@endsection