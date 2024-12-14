@extends('welcome')

@section('title', 'Photo Gallery')

@section('content')

	<!-- Start Header -->
	<div class="fables-header fables-after-overlay">
		<div class="container"> 
			<h2 class="fables-page-title fables-second-border-color">Photo Gallery</h2>
		</div>
	</div>  
	<!-- /End Header -->

	<!-- Start Breadcrumbs -->
	<div class="fables-light-background-color">
		<div class="container"> 
			<nav aria-label="breadcrumb">
				<ol class="fables-breadcrumb breadcrumb px-0 py-3">
					<li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
				</ol>
			</nav> 
		</div>
	</div>
	<!-- /End Breadcrumbs -->

	<!-- Start page content --> 
	<div class="container">
		<div class="row mt-3 mt-lg-5 mb-2">
			<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="text-center">
					<h2 class="fables-main-text-color font-35 bold-font my-3">Engagement Activities</h2>
					{{-- <p class="fables-forth-text-color my-4">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos reiciendis cum aliquid quam, consequatur. quisquam consectetur culpa commodi maxime in harum sunt nam.

					</p> --}}
				</div>
			</div>
		</div>



		<a type="button" class="btn btn-primary fables-btn-rounded" data-toggle="modal" data-target="#addPhotos" >Add Photos</a>
		<br>
		<br>

		<div class="gallery-filter">
			{{-- <div class="portfolioFilter mb-lg-5 clearfix">
				<a href="#" data-filter="*" class="current">ALL</a>
				<a href="#" data-filter=".webDesign" class="fables-forth-text-color">Web design</a>
				<a href="#" data-filter=".appDesign" class="fables-forth-text-color">App design</a>
				<a href="#" data-filter=".brand" class="fables-forth-text-color">Brand</a>
				<a href="#" data-filter=".development" class="fables-forth-text-color">Development</a>
			</div>  --}}
			<div class="portfolioContainer mt-4 mb-lg-5 row filter-masonry"> 

				@foreach($photos as $photoData)
				<div class="drawings places col-sm-6 col-md-3">
					<div class="filter-img-block position-relative mb-3 image-container translate-effect-right" style="border: 2px solid #ee3124">
						<img src="{{$photoData->image}}" alt="image">
						<div class="img-filter-overlay fables-main-color-transparent row m-0">

							@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph' || $user['contacts']['mail'] == '@megawide.com.ph')
							<form action="/deletePhoto/{{$photoData->id}}" method="POST">
								@csrf
								<button type="submit" class="gallery-filter-icon white-color fables-second-hover-color"><i class="fa fa-trash"></i></button>
							</form>
							
							@endif
							<a data-fancybox="gallery" href="{{$photoData->image}}" class="gallery-filter-icon white-color fables-second-hover-color"><span class="fables-iconsearch-icon"></span></a>
						</div>
					</div>
				</div>
				@endforeach
				
				

			</div>
		</div>                  
	</div>

	<!-- /End page content -->

	<div class="modal fade" id="addPhotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
                <form action="/addPhotos" method="POST" enctype="multipart/form-data">
                	@csrf
	    			<div class="modal-body">
	    				<div class="row">
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <label for="exampleInputEmail1">Name <span style="color: red;">*</span></label>
	                                <input type="text" class="form-control" id="title" placeholder="Enter Title" name="name" required>
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
	    			</div>
	    			<div class="modal-footer">
	    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    				<button type="Submit" class="btn btn-primary">Save changes</button>
	    			</div>
    			</form>
    		</div>
    	</div>
    </div>

@endsection