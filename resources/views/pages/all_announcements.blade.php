@extends('welcome')

@section('title', 'List of Announcements')

@section('content')
	
	<!-- Start Header -->
	<div class="fables-header fables-after-overlay bg-rules" style="background-image: url('https://images.pexels.com/photos/7859934/pexels-photo-7859934.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');">
		<div class="container"> 
			<h2 class="fables-page-title fables-second-border-color wow fadeInLeft" data-wow-duration="1.5s">List of Announcements</h2>
		</div>
	</div>  
	<!-- /End Header -->

	<!-- Start Breadcrumbs -->
	<div class="fables-light-background-color">
		<div class="container"> 
			<nav aria-label="breadcrumb">
				<ol class="fables-breadcrumb breadcrumb px-0 py-3">
					<li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
					<li class="breadcrumb-item"><a href="/human-resources" class="fables-second-text-color">Human-Resources</a></li>
					<li class="breadcrumb-item active" aria-current="page">List of Announcements</li>
				</ol>
			</nav>  
		</div>
	</div>
	<!-- /End Breadcrumbs -->

	<!-- Start page content -->  
	<div class="container">
		<div class="row my-4 my-lg-5">
			<div class="col-12 col-lg-8">

				@if($user['mail'] == 'tosma@megawide.com.ph' || $user['mail'] == 'wmatias@megawide.com.ph' || $user['mail'] == 'cjzarsuelo@megawide.com.ph')

				<a type="button" class="btn btn-primary fables-btn-rounded" id="addAnnouncementID" data-toggle="modal" data-target="#addAnnouncement" onclick='document.getElementById("manageAnnouncementForm").reset();'>Add Announcement</a>
				<br>
				<br>

				@endif

				<div id="blogsFilter">
					@foreach($announcements as $announcementData)
					<div class="mb-4 mb-lg-5 wow fadeIn" data-wow-delay=".3s">
						<div class="row">
							<div class="col-12 col-sm-5">
								<div class="image-container zoomIn-effect">
									@if(isset($announcementData->announcements_images->first()->image))
										@if(stripos($announcementData->announcements_images->first()->image, '.pdf') !== FALSE)
											<embed src="{{$announcementData->announcements_images->first()->image}}" width="100%" style="height: 30vw;" />
												{{-- <a href="#" target=”_blank”>{{$announcementData->announcements_images->first()->image}}</a> --}}
										@else

										<a href="#"><img src="

												{{asset($announcementData->announcements_images->first()->image )}}
											" alt="image alt text"></a>
										@endif
									@endif
									
								</div>
							</div>
							<div class="col-12 col-sm-7">
								<h2 class="font-18 semi-font mt-3 mt-sm-0 mb-2"><a href="#" class="fables-main-text-color fables-second-hover-color" id="blog_title">{{$announcementData->title}}</a></h2>
								<div class="fables-forth-text-color font-14 my-2">                                  
									<span class="fables-icondata fables-second-text-color mr-1"></span> 
									<span class="mr-3">{{Carbon\Carbon::parse($announcementData->created_at)->diffForHumans()}}</span> 
								</div>
								<p class="fables-forth-text-color font-14 mb-3">
									{!!  str_limit($announcementData->content != null ? $announcementData->content : 'No Content' , 300, '...') !!}
								</p>
								<br>
								<a class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color" type="button" data-toggle="modal" data-target="#generalAnnouncementModal"  onclick='getSubData({{ $announcementData }})'>View</a>

								@if($user['mail'] == 'tosma@megawide.com.ph' || $user['mail'] == 'wmatias@megawide.com.ph' || $user['mail'] == 'cjzarsuelo@megawide.com.ph')

								<a class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color" type="button" data-toggle="modal" data-target="#addAnnouncement" onclick='editAnnouncement({{ $announcementData }})'>Edit</a>
								<a class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color" type="button" data-toggle="modal" data-target="#deleteAnnouncementModel" onclick="deleteAnnouncement( {{ $announcementData->id }})">Delete</a>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-12 col-lg-4">
				{{-- <div class="fables-blog-search">
					<form method="POST">
						<div class="row">
							<div class="col-12 col-sm-9 col-md-8 mb-3 mb-md-0">
								<div class="input-icon">
									<span class="fables-iconsearch-icon fables-input-icon font-14"></span>
									<input type="text" name="search" id="searchInput" class="form-control rounded-0 py-2 width-100">
								</div>
							</div>
							<div class="col-12 col-sm-3 col-md-4 pl-md-0">
								<button type="button" id="searchBlog" class="btn fables-second-background-color rounded-0 text-white font-15 semi-font py-2 btn-block">Search</button>
							</div>
						</div> 

					</form>
				</div> --}}
				<div class="mt-4">
					<h2 class="position-relative font-23 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Recent Posts</h2> 
					<div class="row">
						@foreach($allAnnouncements as $key => $allAnnouncementsData)
						<div class="col-12 col-md-6 col-lg-12 mb-0">
							<div class="row mb-2">
								<div class="col-4">
									<a href="#"><img src="
										@if(isset($allAnnouncementsData->announcements_images->first()->image))

											{{asset($allAnnouncementsData->announcements_images->first()->image)}}

										@else 

											{{asset('img/blogs/default-blog-image.jpg')}}

										@endif
									" class="img-fluid h-60" alt="image alt text"></a>
								</div>
								<div class="col-8 pl-0">
									<a href="#" class="fables-main-text-color bold-font fables-second-hover-color">{{$allAnnouncementsData->title}}</a>
									<br>
									<a href="#" class="fables-main-text-color font-12 fables-second-hover-color">
										<span>{{$allAnnouncementsData->content_type->type}}</span></a>
									<p class="fables-forth-text-color fables-blog-date-cat font-14 mt-1">{{Carbon\Carbon::parse($allAnnouncementsData->created_at)->diffForHumans()}}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="text-right">
						{{-- <a href="#" class="btn fables-second-text-color underline fables-main-text-color font-14"> More</a> --}}
					</div>
					<hr>
				</div>

				<div class="mt-4">
					<h2 class="position-relative font-23 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Tags</h2>
					<ul class="nav fables-blog-cat-list fables-forth-text-color fables-second-hover-color-link fables-blog-cat-tags">
						<li><a href="/view-all-meganews">Meganews</a></li>
						<li><a href="/view-all-announcements/2">General Announcements</a></li>
						<li><a href="/view-all-announcements/3">Memorandum</a></li>
						<li><a href="/view-all-announcements/4">HMO Announcement</a></li>
						<li><a href="/view-all-blogs">Blogs</a></li>
					</ul> 
				</div>
			</div>
		</div>   
	</div>
	<!-- /End page content -->

	<div class="d-flex justify-content-center">
        {!! $announcements->links() !!}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="generalAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
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

    <div class="modal fade" id="addAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
                <form action="/addAnnouncement" method="POST" enctype="multipart/form-data" id="manageAnnouncementForm">
                	@csrf
	    			<div class="modal-body">
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
	                                <label for="exampleInputEmail1">Content Type</label>
	                                <select name="content_type_id" class="form-control"  id="contentType">
	                                	<option disabled> -- Select Content Type -- </option>
	                                	@foreach($contentType as $contentTypeData)
	                                	<option value="{{$contentTypeData->id}}">{{$contentTypeData->type}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label for="exampleInputFile">Image</label>
	                                <input type="file" multiple class="form-control" id="image" name="image[]">
	                            </div>
	                        </div>
	                    </div>
	                    
	                    <div class="form-group">
	                        <label for="exampleFormControlTextarea1">Content </label>
	                        <textarea class="form-control" id="content" rows="3" name="content" ></textarea>
	                    </div>
	    			</div>
	    			<div class="modal-footer">
	    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    				<button type="Submit" class="btn btn-primary">Save changes</button>
	    			</div>
    			</form>
    		</div>
    	</div>
    </div>

    <div class="modal fade" id="deleteAnnouncementModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content ">
    			<div class="modal-header bg-danger justify-content-center">
    				<h5 class="modal-title text-white " id="exampleModalLongTitle"><i class="fa-solid fa-triangle-exclamation fa-lg "></i> Are you sure to delete this <span id="deleteName"></span>?</h5>
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
    

@endsection

@section('scripts')
    <script src="{{asset('assets/custom/js/human_resources.js')}}"></script>
@endsection