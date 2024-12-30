                <div class="d-flex align-items-center justify-content-between py-2 px-4 " id="forum_page">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Ask HR</h2> 
                    <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-forum">View All</a>
                </div>
                <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                    <div class="container-fluid mt-4">
                        <form action="/submitPost" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="avatar">
                                            <div class="avatar__letters">
                                                {{str_replace(' ', '', substr($user['displayName'], 0, 1) . substr(substr($user['displayName'], strpos($user['displayName'], ",")), 1, 2))}}
                                            </div>
                                        </div>
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
                    <div class="">
                        <div  style="overflow:auto; height:725px;">

                            @foreach($timeline as $timelineData)
                            <div class="col-md-12">

                                <div class="col-md-12">
                                    <div class="p-card bg-white p-2 rounded px-3">
                                        <div class="d-flex justify-content-between" >
                                            <div class="d-flex ">
                                                <div class="avatar">
                                                    <div class="avatar__letters">
                                                        @if(isset($timelineData->name))
                                                        {{str_replace(' ', '', substr($timelineData->name, 0, 1) . substr(substr($timelineData->name, strpos($timelineData->name, ",")), 1, 2))}}
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <img class="rounded-circle" src="{{$timelineData->image}}" width="32px"> --}}
                                                <span class="text-black-50 ml-2">
                                                    <a href="">{{$timelineData->name}}</a> 
                                                    <span class="font-14"><i>{{$timelineData->post_type->name}}</i></span>
                                                </span>
                                            </div>
                                            <span class="badge badge-danger py-1 mb-2" style="height: 20px"><i class="fa-solid fa-calendar-days"></i> &nbsp;{{Carbon\Carbon::parse($timelineData->created_at)->diffForHumans()}}
                                            </span>
                                        </div>
                                        <div class="ml-5">
                                        <h5 class=" font-15">{{$timelineData->title}}</h5>
                                        </div>
                                        <div class="d-block m-1 ml-5" >
                                            <span class="d-block mb-1 font-13">{{$timelineData->post}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right"  style="margin-bottom: -15px;">
                                    @if(isset($forumName))
                                        <a href="/editForum/{{$timelineData->id}}" type="button" >
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Edit</a> | 

                                        <a href="#" type="button" data-toggle="modal" data-target="#deleteForumModal" onclick="deleteForum('{{$timelineData->title}}', {{$timelineData->id}})">
                                        <i class="fa-regular fa-trash-can"></i>
                                        Delete</a> | 
                                    @endif
                                    <a href="" type="button" data-toggle="modal" data-target="#timelineModal" class="timelineBtn" data-id="{{$timelineData}}" data-text="{{$timelineData->timeline_comments}}">
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

                @include('pages.deleteForumModal')
