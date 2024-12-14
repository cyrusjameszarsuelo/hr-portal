@extends('welcome')

@section('title', 'List of Blogs')

@section('content')
	
	<!-- Start Header -->
	<div class="fables-header fables-after-overlay bg-rules">
		<div class="container"> 
			<h2 class="fables-page-title fables-second-border-color wow fadeInLeft" data-wow-duration="1.5s">Meganews</h2>
		</div>
	</div>  
	<!-- /End Header -->

	<!-- Start Breadcrumbs -->
	<div class="fables-light-background-color">
		<div class="container"> 
			<nav aria-label="breadcrumb">
				<ol class="fables-breadcrumb breadcrumb px-0 py-3">
					<li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Meganews</li>
				</ol>
			</nav>  
		</div>
	</div>
	<!-- /End Breadcrumbs -->

	<!-- Start page content -->  
	<div class="container">
		<div class="row my-4 my-lg-5">
			<div class="col-12 col-lg-8">

				@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph')
				<a type="button" class="btn btn-primary fables-btn-rounded" data-toggle="modal" data-target="#addMeganews" onclick='document.getElementById("manageMeganewsForm").reset();'>Add Meganews</a>
				<br>
				<br>
				@endif
				<div id="blogsFilter">
					@foreach($meganews as $meganewsData)
					<div class="mb-4 mb-lg-5 wow fadeIn" data-wow-delay=".3s">
						<div class="row">
							<div class="col-12 col-sm-5">
								<div class="image-container zoomIn-effect">
									<a href=""><img src="

										@if($meganewsData->image != null)

											{{asset($meganewsData->image )}}

										@else 

											{{asset('img/meganews/default-blog-image.jpg')}}

										@endif

									" alt="image alt text"></a>
								</div>
							</div>
							<div class="col-12 col-sm-7">
								<h2 class="font-18 semi-font mt-3 mt-sm-0 mb-2"><a href="/content/{{$meganewsData->id}}" class="fables-main-text-color fables-second-hover-color" id="blog_title">{{$meganewsData->title}}</a></h2>
								<div class="fables-forth-text-color font-14 my-2">                                  
									<span class="fables-icondata fables-second-text-color mr-1"></span> 
									<span class="mr-3">{{Carbon\Carbon::parse($meganewsData->created_at)->diffForHumans()}}</span>
									<span class="fables-iconcomment fables-second-text-color mr-1"></span> 
									<a href="/content/{{$meganewsData->id}}" class="fables-forth-text-color fables-second-hover-color position-relative z-index">
										   
									</a> 
								</div>
								<p class="fables-forth-text-color font-14 mb-3">
									  {!! str_limit($meganewsData->content, 300, '...') !!}
								</p>
								<a href="/content/{{$meganewsData->id}}" class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color">Read More</a>

								@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph')

								<a href="/editMeganews/{{$meganewsData->id}}" class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color">Edit</a>
								<a class="btn fables-second-text-color underline fables-main-hover-text-color p-0 fables-main-hover-color" type="button" data-toggle="modal" data-target="#deleteMeganewsModal" onclick ="deleteMeganews('{{ $meganewsData->title }}', {{ $meganewsData->id }})">Delete</a>
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
						@foreach($meganews as $key => $meganewsData)
							@if($key < 5)
							<div class="col-12 col-md-6 col-lg-12">
								<div class="row mb-4">
									<div class="col-4">
										<a href="/content/{{$meganewsData->id}}"><img src=" 
										@if($meganewsData->image != null)

											{{asset($meganewsData->image )}}

										@else 

											{{asset('img/meganews/default-blog-image.jpg')}}

										@endif

										" class="img-fluid w-100" alt="image alt text"></a>
									</div>
									<div class="col-8 pl-0">
										<a href="/content/{{$meganewsData->id}}" class="fables-main-text-color bold-font fables-second-hover-color">{{$meganewsData->title}}</a>
										<p class="fables-forth-text-color fables-blog-date-cat font-14 mt-1">{{Carbon\Carbon::parse($meganewsData->created_at)->diffForHumans()}}</p>
									</div>
								</div>
							</div>
							@endif
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

	<div class="modal fade" id="addMeganews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Add Meganews</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
                <form action="/addMeganews" method="POST" enctype="multipart/form-data" id="manageMeganewsForm">
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
	                                <label for="exampleInputEmail1">Quote </label>
	                                <input type="text" class="form-control" id="quote" placeholder="Enter Quote" name="quote" >
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label for="exampleInputEmail1">Quote 2 </label>
	                                <input type="text" class="form-control" id="quote2" placeholder="Enter Quote 2" name="quote2" >
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label for="exampleInputFile">Image</label>
	                                <input type="file" multiple class="form-control" id="image" name="image[]" required>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label for="exampleInputEmail1">Image Title <span style="color: red;">*</span></label>
	                                <input type="text" class="form-control" id="image_title" placeholder="Enter Image Title" name="image_title" required>
	                            </div>
	                        </div>
	                    </div>
	                    
	                    <div class="form-group">
	                        <label for="exampleFormControlTextarea1">Content <span style="color: red;">*</span></label>
	                        <textarea class="form-control " id="contentKey1" rows="3" name="content" required ></textarea>
	                    </div>

	                    <div class="form-group">
	                        <label for="exampleFormControlTextarea1">Content 2</label>
	                        <textarea class="form-control " id="contentKey2" rows="3" name="content2" ></textarea>
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

    <div class="modal fade" id="deleteMeganewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
    

@endsection

@section('scripts')
    <script src="{{asset('assets/custom/js/meganews.js')}}"></script>
@endsection