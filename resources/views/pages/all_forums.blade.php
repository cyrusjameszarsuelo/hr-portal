@extends('welcome')

@section('title', 'List of Forum')

@section('content')

<div class="container-fluid mt-5 mb-5">

    <div>
        <button class="btn btn-primary fables-btn-rounded"  data-toggle="modal" data-target="#exampleModal">
            Add Queries
        </button>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-md-9">
            
            <div class="row mt-1">
                @foreach($timeline as $key => $timelineData)
                <div class="col-md-12 wow fadeInLeft" data-wow-delay=".{{$key}}s">
                    <div class="p-card p-2 rounded px-3 card-forum">
                        <div class="d-flex justify-content-between mt-2">
                            <div class="d-flex ">
                                {{-- <img class="rounded-circle" src="{{$timelineData->image}}" width="32px"> --}}
                                @if(isset($timelineData->name))
                                <div class="avatar">
                                    <div class="avatar__letters">
                                        {{str_replace(' ', '', substr($timelineData->name, 0, 1) . substr(substr($timelineData->name, strpos($timelineData->name, ",")), 1, 2))}}
                                    </div>
                                </div>
                                @endif
                                <span class="text-black-50 ml-2 font-20">{{$timelineData->name}}</span>
                            </div>
                            <span class="badge badge-danger py-1 mb-2" style="height: 20px">{{Carbon\Carbon::parse($timelineData->created_at)->diffForHumans()}}
                            </span>
                        </div>
                        
                        <div class="d-block m-2" style="padding-left: 40px;">
                            <h5 class="mt-2 mb-2">{{$timelineData->title}}</h5>
                            <span class="d-block mb-3" style="color: black">{{$timelineData->post}}</span>
                        </div>
                        <div class="text-right" >
                            <p>
                                @if(isset($forumName))
                                <a href="/editForum/{{$timelineData->id}}" type="button" >
                                <i class="fa-regular fa-pen-to-square"></i>
                                Edit</a> | 

                                <a href="#" type="button" data-toggle="modal" data-target="#deleteForumModal" onclick="deleteForum('{{$timelineData->title}}', {{$timelineData->id}})">
                                <i class="fa-regular fa-trash-can"></i>
                                Delete</a> | 
                                @endif

                                <a type="button" class="fables-first-text-color ">
                                <i class="fa-regular fa-comments"></i>
                                Comments ({{count($timelineData->timeline_comments)}})
                                </a>
                            </p>    
                        </div>

                        <form action="/submitCommentTimeline" method="POST">
                        @csrf
                        <div class="container justify-content-center">
                            
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Add Comment</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="post"></textarea>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-sm fables-btn-rounded ">Submit</button>
                                <input type="hidden" name="timeline_id" value="{{$timelineData->id}}">
                            </div>
                        </div>
                        </form>


                        <div class="{{count($timelineData->timeline_comments) != 0 ? 'scrollable_div' : '' }}" >
                            @foreach($timelineData->timeline_comments as $comment)
                            <div class="card p-3 mb-2 ml-5">
                                <div class="d-flex flex-row">
                                    {{-- <img src="{{$comment->image}}"  height="40" width="40" class="rounded-circle"> --}}
                                    <div class="avatar">
                                        <div class="avatar__letters">
                                            @if(isset($timelineData->name))
                                            {{str_replace(' ', '', substr($timelineData->name, 0, 1) . substr(substr($timelineData->name, strpos($timelineData->name, ",")), 1, 2))}}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column ms-2" style="margin: 0px 15px">
                                        <h6 class="mb-1 text-primary">{{$comment->name}}</h6>
                                        <p class="comment-text">{{$comment->post}}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row gap-3 align-items-center">
                                    </div>

                                    <div class="d-flex flex-row">
                                        <span class="text-muted fw-normal fs-10">{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {!! $timeline->links() !!}
            </div>
        </div>

        <div class="col-md-3  wow fadeInRight">
            
            <div class="card">
                <div class="card-header">Forum History</div>

                <div class="card-body">
                    @foreach($timelineHistory as $timelineHistoryData)
                    <div class="d-flex justify-content-between">
                        <div class="d-flex ">
                            <img class="rounded-circle" src="{{$timelineHistoryData->image}}" width="25vw">
                            <span class="text-black-50 font-12 ml-2 mt-1">{{$timelineHistoryData->name}}</span>
                        </div>
                        
                    </div>
                    <span class="m-4 "><i class="font-11">{{$timelineHistoryData->action}}</i> - <strong style="color: black" class="font-12">{{ isset($timelineHistoryData->timeline) ? $timelineHistoryData->timeline->title : ''}}</strong></span>
                    <br>
                    <div class="text-right">
                    <span class="py-1 font-11">{{Carbon\Carbon::parse($timelineHistoryData->created_at)->diffForHumans()}}
                    </span>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
	

                
        

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Query</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/submitPost" method="POST">
            @csrf
            <div class="modal-body" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Text</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="post_type_id" value="1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card-forum{
        background-color: #e5e5e5 !important;
        margin-bottom: 20px !important;
    }

    .scrollable_div {
        overflow:auto; 
        height:270px;
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

@include('pages.deleteForumModal')

@section('scripts')
    <script src="{{asset('assets/custom/js/forum.js')}}"></script>
	@include('scripts/all_forum_scripts')
@endsection