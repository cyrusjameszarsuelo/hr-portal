                <div class="d-flex align-items-center justify-content-between py-2 px-4 " id="community_board_page">
                    <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-3">Community Board</h2> 
                    <button class="btn btn-primary fables-btn-rounded btn-sm" id="addToBoard" data-toggle="modal" data-target="#addToBoardModal" onclick='document.getElementById("manageCommBoardForm").reset();'>Add to Board</button>
                </div>
                <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                    <div class="container-fluid">
                        <div class="" style="background-image: linear-gradient(#ffffff, #4c4c4c);">   
                            <div style="overflow:scroll; height:800px;" class="body-flipcard">


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
                                                    @if(stripos($communityData->image, 'mp4') !== FALSE)
                                                    <div class="front filter-img-block position-relative">
                                                        <video width="320" height="240" >
                                                          <source src="{{$communityData->image}}" type="video/mp4">
                                                        </video>
                                                    </div>
                                                    @else
                                                    <div class="front filter-img-block position-relative" style="background-image: url('{{$communityData->image}}'); background-position: top !important">
                                                    </div>
                                                    @endif

                                                    
                                                    <div class="back text-center">
                                                       <h3 class="text-white">{{ str_limit($communityData->title, 30, '...') }}</h3>
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
                            <form action="/storeCommunityBoard" method="POST" enctype="multipart/form-data" id="manageCommBoardForm">
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
                                                <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Link</label>
                                                <input type="text" class="form-control" id="link" placeholder="Enter Title" name="link">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Image/Video</label>
                                                <input type="file" class="form-control" id="exampleInputFile" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Content <span style="color: red;">*</span></label>
                                        <textarea class="form-control" id="content" rows="3" name="content" required></textarea>
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

                <div class="modal fade" id="deleteCommModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header bg-danger justify-content-center">
                                <h5 class="modal-title text-white " id="exampleModalLongTitle"><i class="fa-solid fa-triangle-exclamation fa-lg "></i> Are you sure to delete this?</h5>
                            </div>
                            <form method="POST" id="deleteForm">
                                <div class="modal-footer" style="display: block;">
                                    <div class="row">
                                        @csrf
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                                        </div>
                                    </div>
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
                                    <h2 class="text-center" id="titleCommunityBoard" style="color: #ee3124"></h2>
                                    <hr style="border: 3px solid #c1c1c1; width: 10%;">
                                    <br>
                                    <div class="row justify-content-center">

                                        <div class="square">
                                            <div id="imageCommunityBoard"> </div>
                                            <p class="modalp" id="textCommunityBoard" style="color: black;"></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>