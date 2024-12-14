@extends('welcome')

@section('title', 'List of New Hires')

@section('content')
	
	<!-- Start Header -->
	<div class="fables-header fables-after-overlay bg-rules">
		<div class="container"> 
			<h2 class="fables-page-title fables-second-border-color wow fadeInLeft" data-wow-duration="1.5s">New Hires</h2>
		</div>
	</div>  
	<!-- /End Header -->

	<!-- Start Breadcrumbs -->
	<div class="fables-light-background-color">
		<div class="container"> 
			<nav aria-label="breadcrumb">
				<ol class="fables-breadcrumb breadcrumb px-0 py-3">
					<li class="breadcrumb-item"><a href="/home" class="fables-second-text-color">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">List of New Hires</li>
				</ol>tosma@megawide.com.ph
			</nav>  
		</div>
	</div>
	<!-- /End Breadcrumbs -->

	<!-- Start page content -->  
	<div class="container">
		<div class=" my-4 my-lg-5">
			<div class="col">

				@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph' || $user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph')

                <button class="btn btn-primary fables-btn-rounded btn-sm" type="button" data-toggle="modal" data-target="#addNewHire">Add New Hire</button>
				<br>
				<br>
				@endif


				<div class="row overflow-hidden">
					@foreach($newHires as $key => $newHiresData)
					<div class="col-6 col-md-4 mb-4 wow bounceInDown" data-wow-delay=".{{$key}}s" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.{{$key}}s; animation-name: bounceInDown;">
						<div class="card fables-team-block fables-second-hover-text-color fables-team-border fables-second-border-color">
							<div class="image-container shine-effect">
								<a href="#"><img class="w-100" src="{{asset($newHiresData->image)}}" alt="Card image cap"></a> 
							</div>
							<div class="card-body">
								<h5><a href="#" class="font-20 semi-font fables-forth-text-color fables-second-hover-color team-name">{{$newHiresData->name}}</a></h5>
								<p class="font-13 fables-forth-text-color my-1">{{$newHiresData->position}} </p> 

								@if($user['contacts']['mail'] == 'tosma@megawide.com.ph' || $user['contacts']['mail'] == 'wmatias@megawide.com.ph' || $user['contacts']['mail'] == 'cjzarsuelo@megawide.com.ph')
								<ul class="nav fables-team-social-links"> 
			                        {{-- <li><a href="#" target="_blank"><span class="fables-forth-text-color fables-fifth-border-color fables-team-social-icon">Edit</span></a></li>  |  --}}
			                        <li><span class="fables-forth-text-color fables-fifth-border-color " data-toggle="modal" data-target="#deleteHireModal" onclick ="deleteHire({{ $newHiresData->id }})">Delete</span></li>   
			                    </ul>
			                    @endif
			                    
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-12 col-lg-4">
			</div>
		</div>   
	</div>
	<!-- /End page content -->


	<!-- Modal -->
    <div class="modal fade" id="addNewHire" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/addNewHire" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter Title" name="name" value="">
                            </div>

                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" placeholder="Enter Subject" name="position" value="">
                            </div>
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


    <div class="modal fade" id="deleteHireModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
    <script src="{{asset('assets/custom/js/new_hire.js')}}"></script>
@endsection