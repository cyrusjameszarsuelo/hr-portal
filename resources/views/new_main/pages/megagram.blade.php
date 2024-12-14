@extends('main')

@section('title', 'MegaGram')

@section('page-title', 'MEGAGRAM')

@section('content')

<div class="container pl-5" >
	<hr style="border-top: 1px dashed; width: 80%; position: relative;" class="">
	<div style="z-index: 5; position: relative;"><a href="/home"><i class="fa fa-home"></i></a> <span> <i class="fa-solid fa-caret-right"></i> <span>Megagram: {{$megagram->id}}</span></div>
	<br>
</div>

<div class="container-fluid m-0 p-0">
	<div class="row m-0 p-0">

		<div class="col-md-6  m-0 p-0 ">
			<h3 class="q-question">{{$megagram ? $megagram->title : ''}}</h3>
			{{-- <img class="avatar-image" src="https://pixy.org/src/32/thumbs350/328668.jpg" alt=""> --}}
			<div class="black-bg"></div>
			<h3 class="megagram-content">
				{!!$megagram ? $megagram->content : ''!!} 
			</h3>
		</div>

		<div class="col-6 m-0 p-0 mb-5">
    		<div class="red-bg"></div>
			<img src="{{asset('img/mactan-cebu-international-airport.jpg')}}" class="megatrivia-image" alt="business">
		</div>
	</div>
	<div class="row">
		<div class="container">
			<form action="{{$like ? '/dislike' : '/like'}}" method="POST" id="like">
				@csrf
					@php
						if($like)
						{
							$icon = 'fa-solid';
						}
						else 
						{
							$icon = 'fa-regular';
						}
					@endphp
				<div class="col-md-7">
					<div class="row " style="margin-top: -6.5vw; font-size: 1.5vw;">
						<div class="col-md-3"><a onclick="document.getElementById('like').submit();" style="cursor: pointer;"><i class="{{$icon}} fa-thumbs-up"></i> Like </a><i>({{$likeCount ? $likeCount : ''}})</i></div>
						<input type="hidden" name="megagram_id" value="{{$megagram->id}}">
						<div class="col-md-9"><a type="button" data-toggle="modal" data-target="#comment_modal"><i class="fa-regular fa-comment"></i> Comment</a></div>
						@if($megagramComments->first())
						<h6 style="margin-top:1vw">
						{{$megagramComments->first()->comment}} - {{substr($megagramComments->first()->user, 0, strpos($megagramComments->first()->user, "@"))}}
						</h6>
						@endif
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- <div class="highlights-2"></div> --}}

<div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Comments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/addComment" method="POST">
				@csrf
			<div class="modal-body">
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="avatar">
                                <div class="avatar__letters">
                                    {{str_replace(' ', '', substr($user['contacts']['displayName'], 0, 1) . substr(substr($user['contacts']['displayName'], strpos($user['contacts']['displayName'], ",")), 1, 2))}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Add Comment"></textarea>
                            <input type="hidden" name="megagram_id" value="{{$megagram->id}}">
                        </div>
                    </div>
                    <hr>

                    @foreach($megagramComments as $megagramCommentsData)
                    <div class="col-md-12">
                        <div class="p-card bg-white p-2 rounded px-3">
                            <div class="d-flex justify-content-between" >
                                <div class="d-flex ">
                                    <div class="avatar">
                                        <div class="avatar__letters">
                                            @if(isset($megagramCommentsData->user))
                                            {{str_replace(' ', '', substr($megagramCommentsData->user, 0, 1) . substr(substr($megagramCommentsData->user, strpos($megagramCommentsData->user, ",")), 1, 2))}}
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <img class="rounded-circle" src="{{$megagramCommentsData->image}}" width="32px"> --}}
                                    <span class="text-black-50 ml-2">
                                        {{$megagramCommentsData->user}} 
                                    </span>
                                </div>
                                <span class="badge badge-danger py-1 mb-2" style="height: 20px"><i class="fa-solid fa-calendar-days"></i> &nbsp;{{Carbon\Carbon::parse($megagramCommentsData->created_at)->diffForHumans()}}
                                </span>
                            </div>
                            <div class="d-block m-1 ml-5" >
                                <span class="d-block mb-1 font-13">{{$megagramCommentsData->comment}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

	body {
		margin: 0;
	}

	input.answer {
		border: 0;
    	-webkit-appearance: none;
    	background: transparent;
    	color: white;
	}

	.avatar-image {
		width: 6vw;
	    border-radius: 100%;
	    margin-left: 15vw;
	    margin-top: 1vw;
	    position: absolute;
	    z-index: 2;
	    border: 5px solid #ee3124;
	}

	.black-bg {
		background: linear-gradient(90deg, rgb(0 0 0) 10%, rgb(65 65 65) 41%, rgb(175 172 172 / 66%) 102%);
	    color: white;
	    font-size: 3vw;
	    width: 48vw;
	    height: 3vw;
	    position: relative;
	    margin-left: 16vw;
	    top: 2vw;
	    clip-path: polygon(0% 100%, 92% 100%, 99% 0%, 0% 0%);
	}

	.q-question {
        background: #ee3124;
	    color: white;
	    font-size: 2vw;
	    margin-top: 1vw;
	    padding-left: 1vw;
	    position: absolute;
	    width: 41vw;
	    margin-left: 16vw;
	    z-index: 2;
	    clip-path: polygon(0% 0%, 91% 0%, 95% 0%, 100% 45%, 95% 100%, 0% 100%, 0% 80%);
	}

	.megatrivia-image {
  	    background: transparent no-repeat center;
	    object-fit: cover;
	    object-position: left;
	    width: 126%;
	    height: 20vw;
	    margin-top: 5vw;
	    margin-left: -11.2vw;
	    clip-path: polygon(0% 100%, 86% 100%, 115% 0%, 31% 0%);
	}

	.megagram-content {
		margin-top: 0vw;
	    background: linear-gradient(163deg, rgb(255 255 255 / 0%) 26%, rgb(235 235 235 / 0%) 52%, rgb(181 181 181 / 49%) 72%);
	    height: 18vw;
	    font-size: 2vw;
	    padding: 4vw 20vw 27px 27px;
	    clip-path: polygon(0% 100%, 67% 100%, 95% 0%, 0% 0%);
	    z-index: 2;
	    position: relative;
	    margin-right: -16vw;
	    padding-left: 16vw;
	    text-indent: 50px;
		/*display: flex;
		justify-content: center;
		align-content: center;
		flex-direction: column;*/
	}

	.red-bg {
        width: 43vw;
	    margin-left: 7vw;
	    margin-top: 5vw;
	    height: 1vw;
	    /* margin-bottom: 0px; */
	    z-index: 1;
	    color: white;
	    background: #ee3124;
	    position: absolute;
	    clip-path: polygon(1% 100%, 100% 100%, 100% 0%, 3% 0%);
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
